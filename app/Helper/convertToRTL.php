<?php

namespace App\Helper;

function convertToRTL($text)
{
    // Remove spaces before and after the text
    $text = trim($text);

    // Reverse the character order to ensure RTL flow
    $text = implode('', array_reverse(mb_str_split($text)));

    return $text;
}