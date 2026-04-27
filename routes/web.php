<?php

use App\Http\Controllers\Dashboard\BeneficiaryController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\FeedbackController as DashboardFeedbackController;
use App\Http\Controllers\Dashboard\KitchenController;
use App\Http\Controllers\Dashboard\MenuController;
use App\Http\Controllers\Dashboard\MenuLogsController;
use App\Http\Controllers\Dashboard\RecepientController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


// Route::view('/offline', 'offline');
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'role:admin|kitchen'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::post('/feedback-send/{slug}', [FeedbackController::class, 'store'])->name('feedbackSend');
});
Route::middleware(['auth', 'role:kitchen'])->group(function () {

    Route::get('/recipient', [RecepientController::class, 'index'])->name('recipient');
    Route::get('/recipient/destroy/{id}', [RecepientController::class, 'destroy'])->name('recipientDestroy');
    Route::get('/recipient/create', [RecepientController::class, 'create'])->name('recipientCreate');
    Route::get('/recipient/edit/{id}', [RecepientController::class, 'edit'])->name('recipientEdit');
    Route::post('/recipient/update/{id}', [RecepientController::class, 'update'])->name('recipientUpdate');
    Route::post('/recipient/store', [RecepientController::class, 'store'])->name('recipientStore');

    Route::get('/beneficiary', [BeneficiaryController::class, 'index'])->name('beneficiary');
    Route::get('/beneficiary/destroy/{id}', [BeneficiaryController::class, 'destroy'])->name('beneficiaryDestroy');
    Route::get('/beneficiary/create', [BeneficiaryController::class, 'create'])->name('beneficiaryCreate');
    Route::get('/beneficiary/edit/{id}', [BeneficiaryController::class, 'edit'])->name('beneficiaryEdit');
    Route::post('/beneficiary/update/{id}', [BeneficiaryController::class, 'update'])->name('beneficiaryUpdate');
    Route::post('/beneficiary/store', [BeneficiaryController::class, 'store'])->name('beneficiaryStore');

    Route::get('/menu', [MenuController::class, 'index'])->name('menu');
    Route::get('/menu/destroy/{slug}', [MenuController::class, 'destroy'])->name('menuDestroy');
    Route::get('/menu/create', [MenuController::class, 'create'])->name('menuCreate');
    Route::get('/menu/edit/{slug}', [MenuController::class, 'edit'])->name('menuEdit');
    Route::post('/menu/update/{slug}', [MenuController::class, 'update'])->name('menuUpdate');
    Route::post('/menu/store', [MenuController::class, 'store'])->name('menuStore');
    Route::post('/menu/status/{slug}', [MenuController::class, 'status'])->name('menuStatusUpdate');

    Route::get('/penilaian', [DashboardFeedbackController::class, 'index'])->name('penilaian');
    Route::get('/penilaian/detail/{id}/{menu}', [DashboardFeedbackController::class, 'detail'])->name('penilaianDetail');

    Route::get('/menu-logs', [MenuLogsController::class, 'index'])->name('menuLogs');
    Route::get('/menu-logs/destroy/{id}', [MenuLogsController::class, 'destroy'])->name('menuLogsDestroy');
});
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/users/destroy/{id}', [UserController::class, 'destroy'])->name('usersDestroy');
    Route::get('/users/create', [UserController::class, 'create'])->name('usersCreate');
    Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('usersEdit');
    Route::post('/users/update/{id}', [UserController::class, 'update'])->name('usersUpdate');
    Route::post('/users/store', [UserController::class, 'store'])->name('usersStore');

    Route::get('/kitchen', [KitchenController::class, 'index'])->name('kitchen');
    Route::get('/kitchen/destroy/{slug}', [KitchenController::class, 'destroy'])->name('kitchenDestroy');
    Route::get('/kitchen/create', [KitchenController::class, 'create'])->name('kitchenCreate');
    Route::get('/kitchen/edit/{slug}', [KitchenController::class, 'edit'])->name('kitchenEdit');
    Route::post('/kitchen/update/{slug}', [KitchenController::class, 'update'])->name('kitchenUpdate');
    Route::post('/kitchen/store', [KitchenController::class, 'store'])->name('kitchenStore');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
