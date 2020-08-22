<?php

namespace App\Models;

use App\ClienteUser;
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
        $this->hasMany(Channel::class);
    }

    public function users()
    {
        $this->belongsToMany(User::class, ClienteUser::class);
    }
}
