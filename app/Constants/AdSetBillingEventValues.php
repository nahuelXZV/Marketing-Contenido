<?php

namespace App\Constants;

class AdSetBillingEventValues
{

    const APP_INSTALLS = 'APP_INSTALLS';
    const CLICKS = 'CLICKS';
    const IMPRESSIONS = 'IMPRESSIONS';
    const LINK_CLICKS = 'LINK_CLICKS';
    const LISTING_INTERACTION = 'LISTING_INTERACTION';
    const NONE = 'NONE';
    const OFFER_CLAIMS = 'OFFER_CLAIMS';
    const PAGE_LIKES = 'PAGE_LIKES';
    const POST_ENGAGEMENT = 'POST_ENGAGEMENT';
    const PURCHASE = 'PURCHASE';
    const THRUPLAY = 'THRUPLAY';

    public static function getAll()
    {
        return [
            self::APP_INSTALLS,
            self::CLICKS,
            self::IMPRESSIONS,
            self::LINK_CLICKS,
            self::LISTING_INTERACTION,
            self::NONE,
            self::OFFER_CLAIMS,
            self::PAGE_LIKES,
            self::POST_ENGAGEMENT,
            self::PURCHASE,
            self::THRUPLAY,
        ];
    }
}
