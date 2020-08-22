<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ClienteUser extends Pivot
{
    public $timestamps  = false;
    protected $table    = 'cliente_user';
}
