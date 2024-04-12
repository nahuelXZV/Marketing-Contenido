<?php

namespace App\Constants;

class ContractType
{
    const SERVICE = 'Servicio';
    const PRODUCT = 'Producto';

    public static function getContractType()
    {
        return [
            self::SERVICE,
            self::PRODUCT,
        ];
    }
}
