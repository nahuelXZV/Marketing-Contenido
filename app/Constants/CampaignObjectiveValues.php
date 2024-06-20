<?php

namespace App\Constants;


class CampaignObjectiveValues
{
    const OUTCOME_APP_PROMOTION = 'OUTCOME_APP_PROMOTION';
    const OUTCOME_AWARENESS = 'OUTCOME_AWARENESS';
    const OUTCOME_ENGAGEMENT = 'OUTCOME_ENGAGEMENT';
    const OUTCOME_LEADS = 'OUTCOME_LEADS';
    const OUTCOME_SALES = 'OUTCOME_SALES';
    const OUTCOME_TRAFFIC = 'OUTCOME_TRAFFIC';


    public static function getAll()
    {
        return [
            self::OUTCOME_APP_PROMOTION,
            self::OUTCOME_AWARENESS,
            self::OUTCOME_ENGAGEMENT,
            self::OUTCOME_LEADS,
            self::OUTCOME_SALES,
            self::OUTCOME_TRAFFIC,
        ];
    }
}
