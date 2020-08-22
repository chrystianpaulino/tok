<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes, UuidTrait;

    protected $table = 'departments';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'status',
        'cliente_id'
    ];

    public function cliente()
    {
        $this->belongsTo(Client::class);
    }

    public function channels()
    {
        $this->belongsToMany(Channel::class, ChannelDepartment::class);
    }
}
