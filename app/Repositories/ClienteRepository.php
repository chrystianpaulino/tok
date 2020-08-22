<?php

namespace App\Repositories;

use App\Models\Cliente;

final class ClienteRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = new Cliente();
    }
}
