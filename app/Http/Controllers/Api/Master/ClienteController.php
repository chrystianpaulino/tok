<?php

namespace App\Http\Controllers\Api\Master;

use App\Http\Controllers\Controller;
use App\Http\Managers\ValorNfseManager;
use App\Models\Cliente;
use App\Repositories\ClienteRepository;

class ClienteController extends Controller
{
    protected $clienteRepository;

    public function __construct() {
        $this->clienteRepository = new ClienteRepository();
    }

    public function index()
    {
        try {
            return response()->json($this->clienteRepository->all());
        }catch (\Exception $exception){
            return response()->json($exception->getMessage(), 400);
        }
    }
}
