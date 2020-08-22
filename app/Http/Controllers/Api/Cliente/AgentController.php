<?php

namespace App\Http\Controllers\Api\Cliente;

use App\Http\Controllers\Controller;
use App\Services\AgentService;

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
}
