<?php

use App\Http\Controllers\LinkController;
use Illuminate\Support\Facades\Route;

Route::controller(LinkController::class)->group(function () {
    Route::post('/', 'create');
    Route::get('/{link}', 'show')->name('link.get');
});
