<?php

namespace App\Constants;


class AdSetOptimizationGoalValues
{
    const IMPRESSIONS = 'IMPRESSIONS';
    const LANDING_PAGE_VIEWS = 'LANDING_PAGE_VIEWS';
    const LEAD_GENERATION = 'LEAD_GENERATION';
    const NONE = 'NONE';
    const OFFSITE_CONVERSIONS = 'OFFSITE_CONVERSIONS';
    const PAGE_LIKES = 'PAGE_LIKES';
    const POST_ENGAGEMENT = 'POST_ENGAGEMENT';
    const PROFILE_VISIT = 'PROFILE_VISIT';
    const QUALITY_CALL = 'QUALITY_CALL';
    const QUALITY_LEAD = 'QUALITY_LEAD';
    const REACH = 'REACH';
    const VALUE = 'VALUE';

    public static function getAll()
    {
        return [
            self::IMPRESSIONS,
            self::LANDING_PAGE_VIEWS,
            self::LEAD_GENERATION,
            self::NONE,
            self::OFFSITE_CONVERSIONS,
            self::PAGE_LIKES,
            self::POST_ENGAGEMENT,
            self::PROFILE_VISIT,
            self::QUALITY_CALL,
            self::QUALITY_LEAD,
            self::REACH,
            self::VALUE,
        ];
    }
}
