<?php

use Illuminate\Support\Facades\Route;
use Modules\Produk\Controllers\ProdukController;

Route::prefix('produk')->middleware('auth')->group(function () {
    $actions = ['storeData', 'deleteData',];
    Route::get('/', [ProdukController::class, 'index'])->name('hakakses.index');
    Route::get('initTable', [ProdukController::class, 'initTable']);
    foreach ($actions as $action) {
        Route::post($action, [ProdukController::class, $action]);
    }
});