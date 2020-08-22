<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Silber\Bouncer\Database\HasRolesAndAbilities;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, SoftDeletes, UuidTrait, HasRolesAndAbilities;

    public    $incrementing = false;
    protected $keyType      = 'string';

    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function clientes()
    {
        $this->belongsToMany(Cliente::class, 'cliente_user', 'user_id', 'cliente_id');
    }

    public function conversations()
    {
        $this->belongsToMany(Conversation::class, UserConversation::class);
    }
}
