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

function slugPreserveLevel($string)
{
    $string = preg_replace_callback('/\(L\d+\)/', function ($matches) {
        return '-' . strtoupper(trim($matches[0], '()'));
    }, $string);

    return Str::slug($string);
}


function formatRoleName($slug) {

    $slug = preg_replace('/-L(\d+)/', ' (L$1)', $slug);

    $slug = str_replace('-', ' ', $slug);

    return preg_replace_callback('/\b[a-z]/', function ($match) {
        return strtoupper($match[0]);
    }, $slug);
}
