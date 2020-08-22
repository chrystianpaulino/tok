<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ClientUser extends Pivot
{
    protected $table = 'cliente_user';
}
