<?php

namespace App\Constants;

class StateCustomer
{
    const ACTIVE = 'Activo';
    const INACTIVE = 'Inactivo';

    public static function getStates()
    {
        return [
            self::ACTIVE,
            self::INACTIVE,
        ];
    }
}
