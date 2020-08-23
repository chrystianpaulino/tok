<?php

namespace App\Repositories;

use App\Models\Conversation;
use App\Repositories\Abstracts\BaseRepository;
use Illuminate\Support\Facades\Log;

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

    public function upsert(array $params, array $values = [])
    {
        Log::info("A");
        $conversation = Conversation::where($params)->first();

        if (empty($conversation)) {
            Log::info("B");
            $params = array_merge($params, $values);
            return Conversation::create($params);
        }

        $conversation->touch();
        Log::info("C");

        return $conversation;
    }
}
