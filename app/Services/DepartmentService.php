<?php

namespace App\Services;

use App\Repositories\DepartmentRepository;

final class DepartmentService extends BaseService
{
    public function __construct()
    {
        $this->repository = new DepartmentRepository();
    }
}
