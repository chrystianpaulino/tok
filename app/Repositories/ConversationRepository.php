<?php

namespace App\Repositories;

use App\Models\Conversation;
use App\Repositories\Abstracts\BaseRepository;

final class ConversationRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = new Conversation();
    }

    public function getStatusList(): array
    {
        return Conversation::$status;
    }

    public function updateOrCreate(array $params, array $values = [])
    {
        return Conversation::updateOrCreate($params, $values);
    }
}
