<?php

use Illuminate\Support\Facades\Route;
use Modules\Customer\Controllers\CustomerController;

Route::prefix('customer')->middleware('auth')->group(function () {
    $actions = ['storeData', 'deleteData', 'comboProduk', 'ajukanCustomer', 'getHistoryApproval', 'onApprove', 'onReject'];
    Route::get('/', [CustomerController::class, 'index'])->name('customer.index');
    Route::get('initTable', [CustomerController::class, 'initTable']);
    Route::get('initTableMember', [CustomerController::class, 'initTableMember']);
    foreach ($actions as $action) {
        Route::post($action, [CustomerController::class, $action]);
    }
});

Route::prefix('member')->middleware('auth')->group(function () {
    Route::get('/', [CustomerController::class, 'indexMember'])->name('customer.indexMember');
});