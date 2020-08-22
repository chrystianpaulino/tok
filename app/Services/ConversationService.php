<?php

namespace App\Services;

use App\Repositories\ConversationRepository;

final class ConversationService extends BaseService
{
    public function __construct()
    {
        $this->repository = new ConversationRepository();
    }
}
