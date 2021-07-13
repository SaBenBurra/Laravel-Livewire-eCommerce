<?php

use Illuminate\Support\Facades\Route;

function getCurrentRouteName()
{
    return Route::currentRouteName();
}
