<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserConversation extends Pivot
{
    protected $table = 'user_conversation';
}
