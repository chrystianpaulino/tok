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
        $invite    = sha1(Carbon::now()->format('HuYisdmisumYsdH'));
        $clienteId = '';
        $base_url  = url('/invitation/' . $clienteId . '/' . $invite);
        return response()->json($base_url);
    }

    public function index()
    {
        return response()->json($this->service->index());
    }

    public function store(Request $request)
    {
        // TODO: CRIAR USUÁRIO AQUI E DEPOIS DESIGNAR ROLE DE AGENTE?
        $user = $request->user();
        \Bouncer::assign('agente')->to($user);
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $result = $this->service->update($request->all(), $id);
        return response()->json($result);
    }
}
