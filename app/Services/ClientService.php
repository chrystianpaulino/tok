<?php

namespace App\Services;

use App\Repositories\ClientRepository;
use App\Services\Abstracts\BaseService;

final class ClientService extends BaseService
{
    public function __construct()
    {
        $this->repository = new ClientRepository();
    }
}
