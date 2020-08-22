<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ChannelDepartment extends Pivot
{
    protected $table = 'channel_department';
}
