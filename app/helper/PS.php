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

    public static function studentYearLevel($year)
    {
        if ($year === 1) {
            return $year . "st year";
        } else if ($year === 2) {
            return $year . "nd year";
        } else if ($year === 3) {
            return $year . "rd year";
        } else {
            return $year . "th year";
        }
    }
}
