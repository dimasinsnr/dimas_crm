<?php

use Illuminate\Support\Facades\Route;
use Modules\User\Controllers\UserController;

Route::prefix('user')->middleware('auth')->group(function () {
    $actions = ['storeData', 'deleteData', 'comboHakAkses', 'updateHakakses'];
    Route::get('/', [UserController::class, 'index'])->name('hakakses.index');
    Route::get('initTable', [UserController::class, 'initTable']);
    foreach ($actions as $action) {
        Route::post($action, [UserController::class, $action]);
    }
});