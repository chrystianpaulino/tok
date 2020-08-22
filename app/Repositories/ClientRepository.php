<?php

namespace App\Repositories;

use App\Models\Client;
use App\Repositories\Abstracts\BaseRepository;

final class ClientRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = new Client();
    }
}
