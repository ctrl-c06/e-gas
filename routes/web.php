<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\FuelSlipController;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;


Route::get('/', function () {
    $qrcode = (new QRCode())->render("Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.");
    echo "<img src='$qrcode'>";
    // return redirect()->route('login');
});

Route::get('home', [HomeController::class, 'index'])->name('home');

Auth::routes(['register' => false, 'reset' => false]);

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function () {
    Route::get('/', [AccountController::class, 'index'])->name('admin.list');
    Route::get('create', [AccountController::class, 'create'])->name('admin.create');
    Route::post('create', [AccountController::class, 'store'])->name('admin.store');
    Route::get('edit/{id}', [AccountController::class, 'edit'])->name('admin.edit');
    Route::put('edit/{id}', [AccountController::class, 'update'])->name('admin.update');

    Route::get('fuel-slips', [FuelSlipController::class, 'list'])->name('fuel-slip.list');
    Route::get('fuel-slip', [FuelSlipController::class, 'index'])->name('fuel-slip.index');
    Route::get('fuel-slip/create', [FuelSlipController::class, 'create'])->name('fuel-slip.create');
    Route::post('fuel-slip/create', [FuelSlipController::class, 'store'])->name('fuel-slip.store');
    Route::get('fuel-slip/edit/{id}', [FuelSlipController::class, 'edit'])->name('fuel-slip.edit');
    Route::put('fuel-slip/edit/{id}', [FuelSlipController::class, 'update'])->name('fuel-slip.update');
    Route::delete('fuel-slip/delete/{id}', [FuelSlipController::class, 'destroy'])->name('fuel-slip.delete');
});


