<?php

namespace App\Constants;


class AdCampaignDeliveryEstimateOptimizationGoalValues
{

    const CONVERSATIONS = 'CONVERSATIONS';
    const DERIVED_EVENTS = 'DERIVED_EVENTS';
    const ENGAGED_USERS = 'ENGAGED_USERS';
    const EVENT_RESPONSES = 'EVENT_RESPONSES';
    const IMPRESSIONS = 'IMPRESSIONS';
    const IN_APP_VALUE = 'IN_APP_VALUE';
    const LANDING_PAGE_VIEWS = 'LANDING_PAGE_VIEWS';
    const LEAD_GENERATION = 'LEAD_GENERATION';
    const LINK_CLICKS = 'LINK_CLICKS';
    const NONE = 'NONE';
    const OFFSITE_CONVERSIONS = 'OFFSITE_CONVERSIONS';
    const PAGE_LIKES = 'PAGE_LIKES';
    const POST_ENGAGEMENT = 'POST_ENGAGEMENT';
    const QUALITY_LEAD = 'QUALITY_LEAD';
    const REACH = 'REACH';
    const REMINDERS_SET = 'REMINDERS_SET';
    const SUBSCRIBERS = 'SUBSCRIBERS';
    const THRUPLAY = 'THRUPLAY';
    const VALUE = 'VALUE';

    public static function getAll()
    {
        return [
            self::CONVERSATIONS,
            self::DERIVED_EVENTS,
            self::ENGAGED_USERS,
            self::EVENT_RESPONSES,
            self::IMPRESSIONS,
            self::IN_APP_VALUE,
            self::LANDING_PAGE_VIEWS,
            self::LEAD_GENERATION,
            self::LINK_CLICKS,
            self::NONE,
            self::OFFSITE_CONVERSIONS,
            self::PAGE_LIKES,
            self::POST_ENGAGEMENT,
            self::QUALITY_LEAD,
            self::REACH,
            self::REMINDERS_SET,
            self::SUBSCRIBERS,
            self::THRUPLAY,
            self::VALUE,
        ];
    }
}
