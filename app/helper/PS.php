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
}
