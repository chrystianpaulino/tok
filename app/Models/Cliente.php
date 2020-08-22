<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use SoftDeletes;

    protected $table = 'clientes';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'nome',
    ];

    public function channel()
    {
        $this->hasOne(Channel::class);
    }
}
