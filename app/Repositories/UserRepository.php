<?php

namespace App\Repositories;

use App\Models\User;

final class UserRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = new User();
    }
}
