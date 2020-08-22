<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ClienteUser extends Pivot
{
    protected $table = 'cliente_user';
}
