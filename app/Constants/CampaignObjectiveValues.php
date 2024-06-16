<?php

namespace App\Constants;


class CampaignObjectiveValues
{

    const APP_INSTALLS = 'APP_INSTALLS';
    const BRAND_AWARENESS = 'BRAND_AWARENESS';
    const CONVERSIONS = 'CONVERSIONS';
    const EVENT_RESPONSES = 'EVENT_RESPONSES';
    const LEAD_GENERATION = 'LEAD_GENERATION';
    const LINK_CLICKS = 'LINK_CLICKS';
    const LOCAL_AWARENESS = 'LOCAL_AWARENESS';
    const MESSAGES = 'MESSAGES';
    const OFFER_CLAIMS = 'OFFER_CLAIMS';
    const OUTCOME_APP_PROMOTION = 'OUTCOME_APP_PROMOTION';
    const OUTCOME_AWARENESS = 'OUTCOME_AWARENESS';
    const OUTCOME_ENGAGEMENT = 'OUTCOME_ENGAGEMENT';
    const OUTCOME_LEADS = 'OUTCOME_LEADS';
    const OUTCOME_SALES = 'OUTCOME_SALES';
    const OUTCOME_TRAFFIC = 'OUTCOME_TRAFFIC';
    const PAGE_LIKES = 'PAGE_LIKES';
    const POST_ENGAGEMENT = 'POST_ENGAGEMENT';
    const REACH = 'REACH';
    const STORE_VISITS = 'STORE_VISITS';

    public static function getAll()
    {
        return [
            self::APP_INSTALLS,
            self::BRAND_AWARENESS,
            self::CONVERSIONS,
            self::EVENT_RESPONSES,
            self::LEAD_GENERATION,
            self::LINK_CLICKS,
            self::LOCAL_AWARENESS,
            self::MESSAGES,
            self::OFFER_CLAIMS,
            self::OUTCOME_APP_PROMOTION,
            self::OUTCOME_AWARENESS,
            self::OUTCOME_ENGAGEMENT,
            self::OUTCOME_LEADS,
            self::OUTCOME_SALES,
            self::OUTCOME_TRAFFIC,
            self::PAGE_LIKES,
            self::POST_ENGAGEMENT,
            self::REACH,
            self::STORE_VISITS,
        ];
    }
}
