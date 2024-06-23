<?php

namespace App\Constants;


class AdSetOptimizationGoalValues
{
    const IMPRESSIONS = 'IMPRESSIONS';
    const REACH = 'REACH';

    public static function getAll()
    {
        return [
            self::IMPRESSIONS,
            self::REACH,
        ];
    }
}
