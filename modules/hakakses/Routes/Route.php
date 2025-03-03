<?php

use Illuminate\Support\Facades\Route;
use Modules\Hakakses\Controllers\HakaksesController;

Route::prefix('hakakses')->middleware('auth')->group(function () {
    $actions = ['storeData', 'deleteData', 'controlHakakses', 'updateHakakses'];
    Route::get('/', [HakaksesController::class, 'index'])->name('hakakses.index');
    Route::get('initTable', [HakaksesController::class, 'initTable']);
    foreach ($actions as $action) {
        Route::post($action, [HakaksesController::class, $action]);
    }
});