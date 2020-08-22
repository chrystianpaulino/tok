<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conversation extends Model
{
    use SoftDeletes, UuidTrait;

    protected $table = 'conversations';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'channel_id',
        'cpf',
        'telefone',
        'status',
    ];

    public function cliente()
    {
        $this->belongsTo(Client::class);
    }

    public function department()
    {
        $this->belongsTo(Department::class);
    }

    public function channel()
    {
        $this->belongsTo(Channel::class);
    }
}
