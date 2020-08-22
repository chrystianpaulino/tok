<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Services\Abstracts\BaseService;

final class UserService extends BaseService
{
    public function __construct()
    {
        $this->repository = new UserRepository();
    }
}
