<?php

namespace App\Http\Controllers\Api\Cliente;

use App\Http\Controllers\Controller;
use App\Services\AgentService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    private $service;

    public function __construct(AgentService $service)
    {
        $this->service = $service;
    }

    public function invite()
    {
        // TODO: MELHOR MANEIRA DE SCOPAR CLIENTE_ID, POIS EM TUDO UTILIZA
        try {
            $invite     = sha1(Carbon::now()->format('HuYisdmisumYsdH'));
            $clienteId  = '';
            $base_url   = url('/invitation/'.$clienteId.'/'.$invite);
            return response()->json($base_url);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 400);
        }
    }

    public function index()
    {
        try {
            return response()->json($this->service->index());
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 400);
        }
    }

    public function store(Request $request)
    {
        // TODO: CRIAR USUÁRIO AQUI E DEPOIS DESIGNAR ROLE DE AGENTE?
        try {
            $user = $request->user();
            \Bouncer::assign('agent')->to($user);

            /*$request->validate([
                'name' => 'required',
            ]);

            $result = $this->service->store($request->all());*/
            return response()->json($user);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $result = $this->service->update($request->all(), $id);
            return response()->json($result);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 400);
        }
    }

}
