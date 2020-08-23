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
        ]);

        $result = $this->service->store($request->all());
        return response()->json($result);
    }

    public function update(Request $request, $id)
    {
        $result = $this->service->update($request->all(), $id);
        return response()->json($result);
    }
}
