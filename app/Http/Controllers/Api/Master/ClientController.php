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
            $result = $this->service->index();
            return response()->json($result);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 400);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
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
