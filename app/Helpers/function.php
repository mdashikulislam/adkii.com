<?php


function formatDate($date, string $format = 'd-M-Y H:i:s'): string
{
    return \Illuminate\Support\Carbon::parse($date)->format($format);
}

/**
 * @throws \Random\RandomException
 */
function generateOtpCode($length = 6): int
{
    $min = 10 ** ($length - 1);
    $max = (10 ** $length) - 1;

    return random_int($min, $max);
}
