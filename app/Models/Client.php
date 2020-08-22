<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes, UuidTrait;

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
        $this->belongsToMany(User::class, ClientUser::class);
    }
}
