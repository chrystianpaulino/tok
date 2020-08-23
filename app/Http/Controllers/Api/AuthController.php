<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ClienteUser;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    private $service;

    public function __construct(UserService $service)
    {
        $this->middleware('auth')->except(['register', 'login']);
        $this->service = $service;
    }

    public function register(Request $request)
    {
        // TODO: PADRAO AGENTE ?

        try {

            DB::beginTransaction();

            $request->validate([
                'name'       => 'required|max:55',
                'email'      => 'email|required|unique:users',
                'password'   => 'required|confirmed',
                'cliente_id' => 'required|exists:clientes,id',
            ]);

            if ($request->avatar) {
                $avatar = $this->service->uploadAvatarUser($request->get('avatar'));
            }

            $user = User::create([
                'name'     => $request->get('name'),
                'email'    => $request->get('email'),
                'password' => $request->get('password'),
                'avatar'   => $avatar ?? '',
            ]);

            ClienteUser::create([
                'cliente_id' => $request->get('cliente_id'),
                'user_id'    => $user->id,
            ]);

            $success['token'] = $user->createToken('authToken')->accessToken;
            $success['user']  = $user;

            // TODO: UTILIZAR ESTE PADRAO NESTA CLASSE?
            // \Bouncer::assign('agent')->to($user);

            DB::commit();
            return response()->json(['success' => $success], 200);

        } catch (\Exception $exception) {
            DB::rollBack();
            Log::info($exception->getMessage());
            return response()->json(['error' => $exception->getMessage()], 401);
        }
    }

    public function login(Request $request)
    {
        try {
            $data = $request->validate([
                'email'    => 'email|required',
                'password' => 'required',
            ]);

            Auth::attempt($data);

            if (!Auth::attempt($data)) {
                throw new \Exception('E-mail ou senha inválido(s)');
            }

            $success['token'] = Auth::user()->createToken('authToken')->accessToken;
            $success['user']  = Auth::user();

            $role = Auth::user()->roles()->get();

            if (count($role)) {
                $success['user']['type'] = $role[0]->name;
            } else {
                $success['user']['type'] = 'agent';
            }

            return response()->json(['success' => $success], 200);

        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 401);
        }

    }

    public function logout(Request $request)
    {

        try {
            if (!Auth::user()) {
                return response()->json(['error' => 'Usuário não encontrado'], 404);
            }

            $token = Auth::user()->token();
            $token->revoke();

            DB::table('oauth_access_tokens')
                ->where('user_id', Auth::user()->id)
                ->update([
                    'revoked' => true
                ]);

            return response()->json(['success' => 'Deslogado com Sucesso'], 200);
        } catch (\Exception $exception) {
            return response()->json(['error' => 'Erro ao Deslogar'], 500);
        }

    }

    public function user(Request $request)
    {
        try {
            $user = $request->user();

            if ($user->get('avatar')) {
                $user->avatar = \Storage::disk('public')->url($user->avatar);
            }

            $success['user'] = $user;
            $success['type'] = $user->roles()->first() ?? null;

            return response()->json(['success' => $success], 200);
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::info($exception->getMessage());
            return response()->json(['error' => $exception->getMessage()], 401);
        }

    }
}
