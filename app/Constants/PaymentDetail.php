<?php

namespace App\Constants;

class PaymentDetail
{
    const CASH = 'Efectivo';
    const CARD = 'Tarjeta';
    const TRANSFER = 'Transferencia';
    const CHECK = 'Cheque';
    const OTHER = 'Otro';

    public static function getPaymentDetail()
    {
        return [
            self::CASH,
            self::CARD,
            self::TRANSFER,
            self::CHECK,
            self::OTHER,
        ];
    }
}
