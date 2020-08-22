<?php

namespace App\Services;

use App\Repositories\ClienteRepository;
use App\Services\Abstracts\BaseService;

final class ClienteService extends BaseService
{
    public function __construct()
    {
        $this->repository = new ClienteRepository();
    }
}
