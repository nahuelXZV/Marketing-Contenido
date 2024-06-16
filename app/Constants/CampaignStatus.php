<?php

namespace App\Constants;

class CampaignStatus
{
    const DRAFT = 'Borrador';
    const CANCELLED = 'Cancelado';
    const FINISHED = 'Finalizado';
    const PENDING = 'Pendiente';
    const ACCEPTED = 'Aceptado';
    const ACTIVE = 'Activo';
    const INACTIVE = 'Inactivo';

    public static function getCampaignStatus()
    {
        return [
            self::DRAFT,
            self::PENDING,
            self::CANCELLED,
            self::ACCEPTED,
            self::ACTIVE,
            self::INACTIVE,
            self::FINISHED
        ];
    }
}
