<?php

namespace App\Helper;

use App\Models\LoginUser;
use App\Models\Payment;
use App\Models\StudentBalancePayment;
use App\Models\StudentPaymentRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Number;

class PS
{
    public static function addHyphenAfterFourNumbers($input)
    {
        $input = str_replace('-', '', $input);
        $chunks = str_split($input, 4);
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
    public static function totalStudent()
    {
        return count(LoginUser::where('role_id', 1)->get());
    }

    public static function totalPayments()
    {
        $paid_amount = StudentPaymentRecord::all();
        $balance = StudentBalancePayment::all();
        $total = $balance->sum('sbp_paid_amount') + $paid_amount->sum('spr_amount');
        return Number::currency($total, in: 'PHP', locale: 'ph');
    }

    public static function totalCollectAmount()
    {
        $payments = Payment::all();
        return Number::currency($payments->sum('amount'), in: 'PHP', locale: 'ph');
    }

    public static function totalStudentPayments()
    {
        $payments = Payment::all();
        return count($payments);
    }

    public function getTheFirstLetterInMiddleName($middlename = null)
    {
        $words = explode(" ", $middlename);
        $acronym = "";

        foreach ($words as $w) {
            $acronym .= mb_substr($w, 0, 1);
        }
    }
    public static function generateCode()
    {
        $uniqueIdentifier = str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
        $currentDate = now()->format('Ymd');
        return $currentDate . $uniqueIdentifier;
    }

    public static function abortIfInvalidSemesterAndYear($filters, $year)
    {
        if (isset($filters['semester']) && $filters['semester'] >= 3 || isset($filters['semester']) && $filters['semester'] <= 0 || isset($filters['year']) && !isset($year)) {
            abort(404);
        }
    }
}
