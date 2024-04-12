<?php

namespace App\Constants;

class PaymentStatus
{
    const PAID = 'Pagado';
    const PENDING = 'Pendiente';

    public static function getPaymentStatus()
    {
        return [
            self::PAID,
            self::PENDING,
        ];
    }
}
