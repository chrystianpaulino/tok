<?php

namespace App\Http\Controllers\Api\Cliente;

use App\Http\Controllers\Controller;
use App\Services\ChannelService;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    private $service;

    public function __construct(ChannelService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return response()->json($this->service->index());
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name'       => 'required',
                'cliente_id' => 'required'
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

    public function destroy($id)
    {
        try {
            $this->service->destroy($id);
            return response()->json(['message' => 'Channel excluído com sucesso']);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 400);
        }
    }

}
