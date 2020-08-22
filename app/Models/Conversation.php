<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conversation extends Model
{
    use SoftDeletes, UuidTrait;

    public    $incrementing = false;
    protected $keyType      = 'string';

    protected $table = 'conversations';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'channel_id',
        'department_id',
        'cliente_id',
        'name',
        'cpf',
        'telefone',
        'status',
    ];

    protected $appends = ['statusFormatted'];

    public static $status = [
        '01' => 'Esperando Atendimento',
        '02' => 'Em Atendimento',
        '03' => 'Finalizada'
    ];

    public function getStatusFormattedAttribute()
    {
        return [
            'codigo' => $this->status ? $this->status : '01',
            'titulo' => self::$status[$this->status ? $this->status : '01'],
        ];
    }

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
