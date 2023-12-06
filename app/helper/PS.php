<?php
namespace App\Helper;

use Illuminate\Support\Facades\Auth;

class PS {
    public static function addHyphenAfterFourNumbers($input) {
        $input = str_replace('-', '', $input);
        $chunks = str_split($input, 4);
        $result = implode('-', $chunks);
        return $result;
    }

    public static function studentYearLevel($year_level) {
        if($year_level == 1) {
            return $year_level."st year";
        } else if($year_level == 2) {
            return $year_level."nd year";
        } else if($year_level == 3) {
            return $year_level."rd year";
        } else {
            return $year_level."th year";
        }
    }

    public static function checkIfCollectorOrAdmin() {
        if(Auth::user()->role_type_id !== 2 && Auth::user()->role_type_id !== 3) {
            return true;
        }
    }
}
