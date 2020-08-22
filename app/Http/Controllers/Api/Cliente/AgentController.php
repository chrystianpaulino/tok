<?php

namespace App\Http\Controllers\Api\Cliente;

use App\Http\Controllers\Controller;
use App\Repositories\AgentRepository;

class AgentController extends Controller
{
    private $repository;

    public function __construct(AgentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        try {
            return response()->json($this->repository->all());
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 400);
        }
    }
}
