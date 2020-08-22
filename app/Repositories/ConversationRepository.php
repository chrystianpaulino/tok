<?php

namespace App\Repositories;

use App\Models\Conversation;

final class ConversationRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = new Conversation();
    }
}
