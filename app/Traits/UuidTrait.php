<?php

namespace App\Traits;

use Ramsey\Uuid\Uuid;

trait UuidTrait
{
    public static function bootUuidTrait()
    {
        static::creating(function ($model) {
            $model->incrementing = false;

            $model->id = Uuid::uuid4();
        });
    }
}