<?php

namespace App\Constants;

class AdSetBillingEventValues
{
    const IMPRESSIONS = 'IMPRESSIONS';
    const LINK_CLICKS = 'LINK_CLICKS';
    const LISTING_INTERACTION = 'LISTING_INTERACTION';
    const OFFER_CLAIMS = 'OFFER_CLAIMS';
    const PAGE_LIKES = 'PAGE_LIKES';
    const POST_ENGAGEMENT = 'POST_ENGAGEMENT';
    const PURCHASE = 'PURCHASE';
    const THRUPLAY = 'THRUPLAY';

    public static function getAll()
    {
        return [
            self::IMPRESSIONS,
            self::LINK_CLICKS,
            self::LISTING_INTERACTION,
            self::OFFER_CLAIMS,
            self::PAGE_LIKES,
            self::POST_ENGAGEMENT,
            self::PURCHASE,
            self::THRUPLAY,
        ];
    }
}
