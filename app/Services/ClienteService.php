<?php

namespace App\Services;

use App\Repositories\ClienteRepository;
use App\Repositories\UserRepository;
use App\Services\Abstracts\BaseService;

final class ClienteService extends BaseService
{
    public function __construct()
    {
        $this->repository       = new ClienteRepository();
        $this->userRepository   = new UserRepository();
    }

    public function store(array $params)
    {
        $user   = $this->userRepository->create($params);
        $cliente = $this->repository->create($params);
//        dd($user, $cliente);
        \Bouncer::assign('client')->to($user);
//        $user->clientes()->attach($cliente->id);
        return $cliente;
    }
}
