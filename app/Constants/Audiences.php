<?php

namespace App\Constants;

class Audiences
{
    const NIÑOS = 'Niños y Niñas';
    const ADOLESCENTES = 'Adolescentes y Jóvenes';
    const ADULTOS = 'Adultos';
    const ADULTOS_MAYORES = 'Adultos Mayores';
    const TODOS = 'Todos';

    public static function getAudiences()
    {
        return [
            self::NIÑOS,
            self::ADOLESCENTES,
            self::ADULTOS,
            self::ADULTOS_MAYORES,
            self::TODOS,
        ];
    }

    public static function getAgeRanges()
    {
        return [
            self::NIÑOS => '0-12',
            self::ADOLESCENTES => '13-18',
            self::ADULTOS => '19-59',
            self::ADULTOS_MAYORES => '60+',
            self::TODOS => '0+',
        ];
    }
}
