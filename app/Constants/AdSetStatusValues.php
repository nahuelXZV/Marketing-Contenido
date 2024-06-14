<?php

namespace App\Constants;

class AdSetStatusValues
{
    const ACTIVE = 'ACTIVE';
    const ARCHIVED = 'ARCHIVED';
    const DELETED = 'DELETED';
    const PAUSED = 'PAUSED';

    public static function getAll()
    {
        return [
            self::ACTIVE,
            self::ARCHIVED,
            self::DELETED,
            self::PAUSED,
        ];
    }
}
