<?php

namespace App\Services;

use App\Repositories\ChannelDepartmentRepository;
use App\Repositories\DepartmentRepository;
use App\Services\Abstracts\BaseService;

final class DepartmentService extends BaseService
{
    public function __construct()
    {
        $this->repository             = new DepartmentRepository();
        $this->channelPivotRepository = new ChannelDepartmentRepository();
    }
}
