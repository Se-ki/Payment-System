<?php
namespace App\Helper;

class PS
{
    public static function addHyphenAfterFourNumbers($input)
    {
        // Remove any existing hyphens
        $input = str_replace('-', '', $input);

        // Split the string into chunks of four numbers
        $chunks = str_split($input, 4);

        // Add hyphen after every chunk
        $result = implode('-', $chunks);

        return $result;
    }

    public static function studentYearLevel($year_level)
    {
        if ($year_level == 1) {
            return $year_level . "st year";
        } else if ($year_level == 2) {
            return $year_level . "nd year";
        } else if ($year_level == 3) {
            return $year_level . "rd year";
        } else {
            return $year_level . "th year";
        }
    }
}
