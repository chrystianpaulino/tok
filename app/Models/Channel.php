<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Channel extends Model
{
    use SoftDeletes;

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
