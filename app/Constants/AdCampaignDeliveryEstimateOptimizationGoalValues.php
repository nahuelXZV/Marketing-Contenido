<?php

namespace App\Constants;


class AdCampaignDeliveryEstimateOptimizationGoalValues
{

    const AD_RECALL_LIFT = 'AD_RECALL_LIFT';
    const APP_INSTALLS = 'APP_INSTALLS';
    const APP_INSTALLS_AND_OFFSITE_CONVERSIONS = 'APP_INSTALLS_AND_OFFSITE_CONVERSIONS';
    const CONVERSATIONS = 'CONVERSATIONS';
    const DERIVED_EVENTS = 'DERIVED_EVENTS';
    const ENGAGED_USERS = 'ENGAGED_USERS';
    const EVENT_RESPONSES = 'EVENT_RESPONSES';
    const IMPRESSIONS = 'IMPRESSIONS';
    const IN_APP_VALUE = 'IN_APP_VALUE';
    const LANDING_PAGE_VIEWS = 'LANDING_PAGE_VIEWS';
    const LEAD_GENERATION = 'LEAD_GENERATION';
    const LINK_CLICKS = 'LINK_CLICKS';
    const MEANINGFUL_CALL_ATTEMPT = 'MEANINGFUL_CALL_ATTEMPT';
    const MESSAGING_APPOINTMENT_CONVERSION = 'MESSAGING_APPOINTMENT_CONVERSION';
    const MESSAGING_PURCHASE_CONVERSION = 'MESSAGING_PURCHASE_CONVERSION';
    const NONE = 'NONE';
    const OFFSITE_CONVERSIONS = 'OFFSITE_CONVERSIONS';
    const PAGE_LIKES = 'PAGE_LIKES';
    const POST_ENGAGEMENT = 'POST_ENGAGEMENT';
    const PROFILE_VISIT = 'PROFILE_VISIT';
    const QUALITY_CALL = 'QUALITY_CALL';
    const QUALITY_LEAD = 'QUALITY_LEAD';
    const REACH = 'REACH';
    const REMINDERS_SET = 'REMINDERS_SET';
    const SUBSCRIBERS = 'SUBSCRIBERS';
    const THRUPLAY = 'THRUPLAY';
    const VALUE = 'VALUE';
    const VISIT_INSTAGRAM_PROFILE = 'VISIT_INSTAGRAM_PROFILE';

    public static function getAll()
    {
        return [
            self::AD_RECALL_LIFT,
            self::APP_INSTALLS,
            self::APP_INSTALLS_AND_OFFSITE_CONVERSIONS,
            self::CONVERSATIONS,
            self::DERIVED_EVENTS,
            self::ENGAGED_USERS,
            self::EVENT_RESPONSES,
            self::IMPRESSIONS,
            self::IN_APP_VALUE,
            self::LANDING_PAGE_VIEWS,
            self::LEAD_GENERATION,
            self::LINK_CLICKS,
            self::MEANINGFUL_CALL_ATTEMPT,
            self::MESSAGING_APPOINTMENT_CONVERSION,
            self::MESSAGING_PURCHASE_CONVERSION,
            self::NONE,
            self::OFFSITE_CONVERSIONS,
            self::PAGE_LIKES,
            self::POST_ENGAGEMENT,
            self::PROFILE_VISIT,
            self::QUALITY_CALL,
            self::QUALITY_LEAD,
            self::REACH,
            self::REMINDERS_SET,
            self::SUBSCRIBERS,
            self::THRUPLAY,
            self::VALUE,
            self::VISIT_INSTAGRAM_PROFILE,
        ];
    }
}
