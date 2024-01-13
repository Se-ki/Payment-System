<?php

namespace App\Helper;

use Illuminate\Support\Facades\Auth;

class AuthMiddleware
{
    public static function checkRoles(int|string $search, array $array)
    {
        return Auth::check() && in_array($search, $array);
    }
}
