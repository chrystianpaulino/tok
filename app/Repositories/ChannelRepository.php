<?php

namespace App\Repositories;

use App\Models\Channel;

final class ChannelRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = new Channel;
    }
}
