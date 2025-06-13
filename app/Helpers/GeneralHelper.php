<?php

namespace App\Helpers;

class GeneralHelper
{
    public static function greetingByTime()
    {
        $hour = now()->format('H');

        if ($hour >= 5 && $hour < 12) {
            return 'Selamat pagi';
        } elseif ($hour >= 12 && $hour < 15) {
            return 'Selamat siang';
        } elseif ($hour >= 15 && $hour < 18) {
            return 'Selamat sore';
        } else {
            return 'Selamat malam';
        }
    }
}
