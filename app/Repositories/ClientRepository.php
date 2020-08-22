<?php

namespace App\Repositories;

use App\Models\Client;

final class ClientRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = new Client();
    }
}
