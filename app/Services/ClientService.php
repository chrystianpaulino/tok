<?php

namespace App\Services;

use App\Repositories\ClientRepository;

final class ClientService extends BaseService
{
    public function __construct()
    {
        $this->repository = new ClientRepository();
    }
}
