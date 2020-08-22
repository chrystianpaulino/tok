<?php

namespace App\Services;

use App\Repositories\UserRepository;

final class UserService extends BaseService
{
    public function __construct()
    {
        $this->repository = new UserRepository();
    }
}
