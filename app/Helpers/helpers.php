<?php

use Illuminate\Support\Facades\Route;

function getCurrentRouteName()
{
    return Route::currentRouteName();
}

function SEO($value)
{
    if ($value) {
        $content = trim($value);
        $toChange = array("ç", "Ç", "ğ", "Ğ", "ı", "İ", "ö", "Ö", "ş", "Ş", "ü", "Ü");
        $changed = array("c", "c", "g", "g", "i", "i", "o", "o", "s", "s", "u", "u");
        $content = str_replace($toChange, $changed, $content);
        $content = mb_strtolower($content, "UTF-8");
        $content = preg_replace("/[^a-z0-9]/", "-", $content);
        $content = preg_replace("/-+/", "-", $content);
        $content = trim($content, "-");
        return $content;
    } else {
        return null;
    }
}
