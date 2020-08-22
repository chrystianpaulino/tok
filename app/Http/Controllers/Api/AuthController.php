<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void php artisan passport:keys
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['register', 'login']);
    }

    public function register(Request $request)
    {

        // TODO: PADRAO AGENTE ?

        try{
            $request->validate([
                'name'      => 'required|max:55',
                'email'     => 'email|required|unique:users',
                'password'  => 'required|confirmed'
            ]);

            $avatar = '';
            if($request->avatar){
                $avatar = $this->uploadAvatarUser($request->get('avatar'));
            }

            $user = User::create([
                'name'      => $request->get('name'),
                'email'     => $request->get('email'),
                'password'  => bcrypt($request->get('password')),
                'avatar'    => $avatar
            ]);

            $success['token']   = $user->createToken('authToken')->accessToken;
            $success['user']    = $user;

            // TODO: UTILIZAR ESTE PADRAO NESTA CLASSE?
            // \Bouncer::assign('agent')->to($user);

            return response()->json(['success' => $success], 200);

        }catch (\Exception $exception){
            Log::info($exception->getMessage());
            return response()->json(['error' => $exception->getMessage()], 401);
        }

    }

    public function login(Request $request)
    {

        try {

            $data = $request->validate([
                'email'     => 'email|required',
                'password'  => 'required',
            ]);

            if(!Auth::attempt($data)){
                throw new \Exception('E-mail/Senha inválido(s)');
            }

            $success['token']   = Auth::user()->createToken('authToken')->accessToken;
            $success['user']    = Auth::user();

            $role =  Auth::user()->roles()->get();

            if(count($role)){
                $user['user']['type'] = $role[0];
            }

            return response()->json(['success' => $success], 200);

        }catch (\Exception $exception){
            return response()->json(['error' => $exception->getMessage()], 401);
        }

    }

    public function logout(Request $request) {

        try {
            if(!Auth::user()){
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
        }catch (\Exception $exception){
            return response()->json(['error' => 'Erro ao Deslogar'], 500);
        }

    }

    public  function user(Request $request)
    {
        try {
            $user = $request->user();

            if($user->get('avatar')){
                $user->avatar = \Storage::disk('public')->url($user->avatar);
            }

            $success['user'] = $user;
            $success['type'] = $user->roles()->first() ?? null;


            return response()->json(['success' => $success], 200);
        }catch (\Exception $exception){
            DB::rollBack();
            Log::info($exception->getMessage());
            return response()->json(['error' => $exception->getMessage()], 401);
        }

    }

    private function uploadAvatarUser($image)
    {
        $image_64   = $image; //  base64 encoded data
        $extension  = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];   // .jpg .png .pdf
        $replace    = substr($image_64, 0, strpos($image_64, ',')+1);
        $image      = str_replace($replace, '', $image_64);
        $image      = str_replace(' ', '+', $image);
        $imageName  = 'users/'.Str::random(10).'.'.$extension;
        \Storage::disk('public')->put($imageName, base64_decode($image));
        return $imageName;
    }

}
