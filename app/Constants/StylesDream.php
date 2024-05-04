<?php

namespace App\Constants;

class StylesDream
{
    /*
1 - Synthwave

2 - Ukiyoe

3 - No Style

4 - Steampunk

5 - Fantasy Art

6 - Vibrant

7 - HD

8 - Pastel

9 - Psychic

10 - Dark Fantasy

11 - Mystical

12 - Festive

13 - Flemish Baroque

14 - Etching

15 - Salvador Dali

16 - Watercolor

17 - Realistic

18 - Van Gogh

19 - Throwback

20 - Ink

21 - Surreal */
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
        ];
    }

    public static function getStyleId($style)
    {
        $styles = self::getStylesArray();
        return $styles[$style];
    }
}
