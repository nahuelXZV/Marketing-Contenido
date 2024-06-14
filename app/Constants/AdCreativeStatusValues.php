<?php

namespace App\Constants;

class AdCreativeStatusValues
{
    const ACTIVE = 'ACTIVE';
    const DELETED = 'DELETED';
    const IN_PROCESS = 'IN_PROCESS';
    const WITH_ISSUES = 'WITH_ISSUES';

    public static function getAll()
    {
        return [
            self::ACTIVE,
            self::DELETED,
            self::IN_PROCESS,
            self::WITH_ISSUES,
        ];
    }
}
