<?php

namespace App\Http\Controllers\Api\Cliente;

use App\Http\Controllers\Controller;
use App\Services\ConversationService;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    private $service;

    public function __construct(ConversationService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return response()->json($this->service->index());
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required',
            'telefone'      => 'required',
            'cpf'           => 'required',
            'department_id' => 'required',
            'channel_id'    => 'required',
        ]);

        $result = $this->service->upsert($request->all());
        return response()->json($result);
    }

    public function update(Request $request, $id)
    {
        $status = $this->service->getStatusWithJoin(true);

        $request->validate([
            'agente_id' => 'required',
            'status'    => 'required|in:' . $status,
        ]);

        $result = $this->service->update($request->all(), $id);
        return response()->json($result);
    }
}
