<?php

namespace App\Constants;

class ContractStatus
{
    const PENDING = 'Pendiente';
    const ACTIVE = 'Activo';
    const INACTIVE = 'Inactivo';
    const CANCELLED = 'Cancelado';
    const FINISHED = 'Finalizado';

    public static function getContractStatus()
    {
        return [
            self::PENDING,
            self::CANCELLED,
            self::ACTIVE,
            self::INACTIVE,
            self::FINISHED
        ];
    }
}
