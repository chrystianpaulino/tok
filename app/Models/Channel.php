<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Channel extends Model
{
    use SoftDeletes, UuidTrait;

    public    $incrementing = false;
    protected $keyType      = 'string';

    protected $table = 'channels';

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

    public function departments()
    {
        $this->belongsToMany(Department::class, ChannelDepartment::class);
    }
}
