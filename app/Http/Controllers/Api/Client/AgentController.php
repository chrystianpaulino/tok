<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Services\AgentService;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    private $service;

    public function __construct(AgentService $service)
    {
        $this->service = $service;
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
