<?php


use App\Models\FuelSlip;
use chillerlan\QRCode\QRCode;
use App\Repositories\Encryptor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\FuelSlipController;
use App\Http\Controllers\PrintSlipController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('home', [HomeController::class, 'index'])->name('home');

Auth::routes(['register' => false, 'reset' => false]);

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function () {
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');

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
    Route::get('fuel-slip/{id}', [FuelSlipController::class, 'show'])->name('fuel-slip.show');
    Route::delete('fuel-slip/delete/{id}', [FuelSlipController::class, 'destroy'])->name('fuel-slip.delete');

    Route::get('print-slip', [PrintSlipController::class, 'print']);
    Route::get('print-slip/{id}', [PrintSlipController::class, 'printSlip'])->name('print-slip');
});


