<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ClienteUser extends Pivot
{
    protected $table = 'cliente_user';
}
