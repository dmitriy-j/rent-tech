<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\LandlordController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SearchController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
// Главная страница
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::get('/search/results', [SearchController::class, 'results'])->name('search.results');
Route::get('/equipment/{id}', [HomeController::class, 'equipment'])->name('equipment');
Route::get('/order/{id}', [HomeController::class, 'order'])->name('order');
Route::get('/order/{id}/confirm', [HomeController::class, 'orderConfirm'])->name('order.confirm');
Route::get('/order/{id}/cancel', [HomeController::class, 'orderCancel'])->name('order.cancel');
Route::get('/order/{id}/pay', [HomeController::class, 'orderPay'])->name('order.pay');
Route::get('/order/{id}/success', [HomeController::class, 'orderSuccess'])->name('order.success');
Route::get('/order/{id}/fail', [HomeController::class, 'orderFail'])->name('order.fail');
Route::get('/order/{id}/refund', [HomeController::class, 'orderRefund'])->name('order.refund');

Route::get('/about', [HomeController::class, 'about'])->name('about');

// Аутентификация
Auth::routes();

// Личный кабинет арендатора
    oute::prefix('tenant')->middleware(['auth', 'role:tenant'])->group(function () {
    Route::get('/dashboard', [TenantController::class, 'dashboard'])->name('tenant.dashboard');
    Route::get('/orders', [TenantController::class, 'orders'])->name('tenant.orders');
    Route::get('/balance/deposit', [BalanceController::class, 'depositForm'])->name('tenant.balance.deposit');
    Route::post('/balance/deposit', [BalanceController::class, 'processDeposit'])->name('tenant.balance.process');
    Route::get('/balance/confirm', [BalanceController::class, 'confirmDeposit'])->name('tenant.balance.confirm');
    Route::resource('rentals', RentalController::class);
    Route::resource('documents', DocumentController::class);


    // ... другие роуты для арендатора
});

// Личный кабинет арендодателя
Route::prefix('landlord')->middleware(['auth', 'role:landlord'])->group(function () {
    Route::get('/equipment', [LandlordController::class, 'equipment'])->name('landlord.equipment');
    Route::get('/orders', [LandlordController::class, 'orders'])->name('landlord.orders');
    Route::get('/dashboard', [LandlordController::class, 'dashboard'])->name('landlord.dashboard');
    Route::resource('equipment', EquipmentController::class);
    Route::resource('orders', OrderController::class);

    // ... другие роуты для арендодателя
});

// Админ-панель
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/bank-statements', [AdminController::class, 'bankStatements'])->name('admin.bank-statements');
    // ... другие роуты для админа
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
