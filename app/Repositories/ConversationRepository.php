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
}
