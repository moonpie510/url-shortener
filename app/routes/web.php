<?php

use App\Http\Controllers\LinkController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(LinkController::class)->prefix('links')->as('links.')->group(function () {
    Route::post('/', 'create');
    Route::get('/{link}', 'show')->name('show');
});

Route::get('/test', function () {
    dd(gethostname());
});
