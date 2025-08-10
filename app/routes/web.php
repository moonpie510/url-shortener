<?php

use App\Http\Controllers\ClickHouseController;
use App\Http\Controllers\LinkController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(LinkController::class)->prefix('links')->as('links.')->group(function () {
    Route::post('/', 'create');
    Route::get('/{link}', 'show')->name('show');
});

Route::controller(ClickHouseController::class)->prefix('clickhouse')->group(function () {
    Route::get('/', 'saveData');
});
