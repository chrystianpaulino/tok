<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, SoftDeletes, UuidTrait;

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
        $this->belongsToMany(Cliente::class, ClienteUser::class);
    }

    public function conversations()
    {
        $this->belongsToMany(Conversation::class, UserConversation::class);
    }
}
