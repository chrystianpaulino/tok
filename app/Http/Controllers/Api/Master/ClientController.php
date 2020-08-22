<?php

namespace App\Http\Controllers\Api\Master;

use App\Http\Controllers\Controller;
use App\Services\ClientService;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    private $service;

    public function __construct(ClientService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        try {
            $index = $this->service->index();
            return response()->json($index);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 400);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nome'  => 'required',
            ]);
            $store = $this->service->store($request->all());
            return response()->json($store);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $update = $this->service->update($request->all(), $id);
            return response()->json($update);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 400);
        }
    }

    public function destroy($id)
    {
        try {
            $this->service->destroy($id);
            return response()->json(['message' => 'Cliente excluído com sucesso']);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 400);
        }
    }
}
