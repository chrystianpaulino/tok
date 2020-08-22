<?php

namespace App\Repositories;

use App\Models\Department;

final class DepartmentRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = new Department();
    }
}
