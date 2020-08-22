<?php

namespace App\Http\Controllers\Api\Master;

use App\Http\Controllers\Controller;
use App\Repositories\ClienteRepository;

class ClienteController extends Controller
{
    private $repository;

    public function __construct(ClienteRepository $repository)
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
