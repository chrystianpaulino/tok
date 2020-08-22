<?php

namespace App\Repositories;

use App\Models\Channel;

final class AgentRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = new Channel();
    }
}
