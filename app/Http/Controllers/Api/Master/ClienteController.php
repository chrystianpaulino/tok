<?php

namespace App\Http\Controllers\Api\Master;

use App\Http\Controllers\Controller;
use App\Services\ClienteService;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    private $service;

    public function __construct(ClienteService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        try {
            $result = $this->service->index();
            return response()->json($result);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 400);
        }
    }

    public function store(Request $request)
    {
        // TODO: AO CRIAR CLIENTE, TAMBÉM TEMOS QUE ALIMENTAR A TABELA CLIENTE_USER;
        try {
            $request->validate([
                'name'      => 'required',
                'email'     => 'email|required',
                'password'  => 'required',
            ]);

            $result = $this->service->store($request->all());
            return response()->json($result);
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
