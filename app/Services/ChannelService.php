<?php

namespace App\Services;

use App\Repositories\ChannelRepository;

final class ChannelService extends BaseService
{
    public function __construct()
    {
        $this->repository = new ChannelRepository();
    }
}
