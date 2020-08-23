<?php

namespace App\Services;

use App\Repositories\ConversationRepository;
use App\Services\Abstracts\BaseService;
use App\Services\Contracts\UpsertServiceInterface;

final class ConversationService extends BaseService implements UpsertServiceInterface
{
    public function __construct()
    {
        $this->repository = new ConversationRepository();
    }

    public function index()
    {
        return $this->repository
            ->with(['department', 'channel'])
            ->orderBy('created_at')
            ->all();
    }

    public function upsert(array $params, array $values = [])
    {
        return $this->repository->upsert($params, $values);
    }

    public function getStatusList(): array
    {
        return $this->repository->getStatusList();
    }

    public function getStatusWithJoin(bool $shift = false): string
    {
        $statuses = $this->repository->getStatusList();

        $keys = array_keys($statuses);

        if (!!$shift) {
            array_shift($keys);
        }

        return implode(',', $keys);
    }
}
