<?php

namespace App\Repositories;

use App\Models\ChannelDepartment;
use App\Repositories\Abstracts\BaseRepository;

final class ChannelDepartmentRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = new ChannelDepartment();
    }
}
