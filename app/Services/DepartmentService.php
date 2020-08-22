<?php

namespace App\Services;

use App\Repositories\ChannelDepartmentRepository;
use App\Repositories\DepartmentRepository;
use App\Services\Abstracts\BaseService;
use Illuminate\Support\Facades\DB;

final class DepartmentService extends BaseService
{
    public function __construct()
    {
        $this->repository             = new DepartmentRepository();
        $this->channelPivotRepository = new ChannelDepartmentRepository();
    }

    public function store(array $params)
    {
        DB::transaction(function () use ($params) {
            $department = $this->repository->create($params);

            $this->channelPivotRepository->create([
                'channel_id'    => $params['channel_id'],
                'department_id' => $department->id,
            ]);

            return $department;
        });
    }
}
