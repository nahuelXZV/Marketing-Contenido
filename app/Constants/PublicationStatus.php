<?php

namespace App\Constants;

class PublicationStatus
{
    const DRAFT = 'Borrador';
    const PENDING = 'Pendiente';
    const ACCEPTED = 'Aceptado';
    const ACTIVE = 'Activo';
    const REJECTED = 'Rechazado';

    public static function getAll()
    {
        return [
            self::DRAFT,
            self::PENDING,
            self::ACCEPTED,
            self::ACTIVE,
            self::REJECTED
        ];
    }
}
