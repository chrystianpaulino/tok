<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Channel extends Model
{
    use SoftDeletes, UuidTrait;

    protected $table = 'clientes';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'status'
    ];

    public function cliente()
    {
        $this->belongsTo(Cliente::class);
    }
}
