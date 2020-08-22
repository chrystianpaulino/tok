<?php

namespace App\Services;

use App\Repositories\ConversationRepository;
use App\Services\Abstracts\BaseService;

final class ConversationService extends BaseService
{
    public function __construct()
    {
        $this->repository = new ConversationRepository();
    }
    
    public function index()
    {
        return $this->repository->orderBy('created_at')->all();
    }
}
