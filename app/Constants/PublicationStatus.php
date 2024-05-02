<?php

namespace App\Constants;

class PublicationStatus
{
    const DRAFT = 'Borrador';
    const PENDING = 'Pendiente';
    const ACEPPTED = 'Aceptado';
    const REJECTED = 'Rechazado';

    public static function getCampaignStatus()
    {
        return [
            self::DRAFT,
            self::PENDING,
            self::ACEPPTED,
            self::REJECTED
        ];
    }
}
