<?php

// app/Helpers/Numbers.php
if (!function_exists('formatNumber')) {
    function formatNumber($number) {
        if ($number >= 1000 && $number < 1000000) {
            return number_format($number / 1000, 1) . 'K';
        } elseif ($number >= 1000000) {
            return number_format($number / 1000000, 1) . 'M';
        } else {
            return $number;
        }
    }
}