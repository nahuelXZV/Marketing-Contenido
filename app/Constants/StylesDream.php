<?php

namespace App\Constants;

class StylesDream
{
    const SYNTHWAVE = 'Synthwave';
    const UKIYOE = 'Ukiyoe';
    const NO_STYLE = 'No Style';
    const STEAMPUNK = 'Steampunk';
    const FANTASY_ART = 'Fantasy Art';
    const VIBRANT = 'Vibrant';
    const HD = 'HD';
    const PASTEL = 'Pastel';
    const PSYCHIC = 'Psychic';
    const DARK_FANTASY = 'Dark Fantasy';
    const MYSTICAL = 'Mystical';
    const FESTIVE = 'Festive';
    const FLEMISH_BAROQUE = 'Flemish Baroque';
    const ETCHING = 'Etching';
    const SALVADOR_DALI = 'Salvador Dali';
    const WATERCOLOR = 'Watercolor';
    const REALISTIC = 'Realistic';
    const VAN_GOGH = 'Van Gogh';
    const THROWBACK = 'Throwback';
    const INK = 'Ink';
    const SURREAL = 'Surreal';
    const DALL_E = 'DALL-E';


    public static function getStyles()
    {
        return [
            self::SYNTHWAVE,
            self::UKIYOE,
            self::NO_STYLE,
            self::STEAMPUNK,
            self::FANTASY_ART,
            self::VIBRANT,
            self::HD,
            self::PASTEL,
            self::PSYCHIC,
            self::DARK_FANTASY,
            self::MYSTICAL,
            self::FESTIVE,
            self::FLEMISH_BAROQUE,
            self::ETCHING,
            self::SALVADOR_DALI,
            self::WATERCOLOR,
            self::REALISTIC,
            self::VAN_GOGH,
            self::THROWBACK,
            self::INK,
            self::SURREAL,
            self::DALL_E,
        ];
    }


    public static function getStylesArray()
    {
        return [
            self::SYNTHWAVE => 1,
            self::UKIYOE => 2,
            self::NO_STYLE => 3,
            self::STEAMPUNK => 4,
            self::FANTASY_ART => 5,
            self::VIBRANT => 6,
            self::HD => 7,
            self::PASTEL => 8,
            self::PSYCHIC => 9,
            self::DARK_FANTASY => 10,
            self::MYSTICAL => 11,
            self::FESTIVE => 12,
            self::FLEMISH_BAROQUE => 13,
            self::ETCHING => 14,
            self::SALVADOR_DALI => 15,
            self::WATERCOLOR => 16,
            self::REALISTIC => 17,
            self::VAN_GOGH => 18,
            self::THROWBACK => 19,
            self::INK => 20,
            self::SURREAL => 21,
            self::DALL_E => 22,
        ];
    }

    public static function getStyleId($style)
    {
        $styles = self::getStylesArray();
        return $styles[$style];
    }
}
