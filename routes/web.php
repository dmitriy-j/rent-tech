<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\LandlordController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Tenant\DocumentController;
use App\Http\Controllers\Tenant\BalanceController;
use App\Http\Controllers\Landlord\EquipmentController as LandlordEquipmentController;
use App\Http\Controllers\Landlord\OrderController as LandlordOrderController;
use App\Http\Controllers\Tenant\RentalController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Auth\RegisterController;


// Главная страница
Route::get('/', [HomeController::class, 'index'])->name('home');

// Публичные страницы
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contacts', [HomeController::class, 'contacts'])->name('contacts');
Route::get('/pages/{slug}', [PageController::class, 'show'])->name('page.show');

// Поиск
Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::get('/search/results', [SearchController::class, 'results'])->name('search.results');

// Работа с техникой и заказами
Route::get('/equipment/{id}', [HomeController::class, 'showEquipment'])->name('equipment.show');
Route::prefix('order')->group(function () {
Route::get('/{id}', [HomeController::class, 'showOrder'])->name('order.show');
Route::get('/{id}/confirm', [HomeController::class, 'confirmOrder'])->name('order.confirm');
Route::get('/{id}/cancel', [HomeController::class, 'cancelOrder'])->name('order.cancel');
Route::get('/{id}/pay', [HomeController::class, 'payOrder'])->name('order.pay');
Route::get('/{id}/success', [HomeController::class, 'orderSuccess'])->name('order.success');
Route::get('/{id}/fail', [HomeController::class, 'orderFail'])->name('order.fail');
Route::get('/{id}/refund', [HomeController::class, 'refundOrder'])->name('order.refund');
});

// Аутентификация
require __DIR__.'/auth.php';



// Отдельный вход в админ-панель
Route::get('/adm', [AdminController::class, 'showLoginForm'])->name('admin.login.form');
Route::post('/adm', [AdminController::class, 'login'])->name('admin.login');

// Перенаправление со старого URL регистрации
Route::get('/register', function () {
    return redirect()->route('register.role');
})->name('register');

// Многошаговая регистрация
Route::get('/register/role', [RegisterController::class, 'showRoleSelectionForm'])->name('register.role');
Route::post('/register/role', [RegisterController::class, 'processRoleSelection'])->name('register.role.process');
Route::get('/register/{role}', [RegisterController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register/{role}', [RegisterController::class, 'register'])->name('register.process');


// Личный кабинет арендатора
Route::prefix('tenant')->middleware(['auth', 'role:tenant'])->group(function () {
Route::get('/dashboard', [TenantController::class, 'dashboard'])->name('tenant.dashboard');
Route::get('/orders', [TenantController::class, 'orders'])->name('tenant.orders');

// Управление балансом
Route::prefix('balance')->group(function () {
Route::get('/deposit', [BalanceController::class, 'depositForm'])->name('tenant.balance.deposit');
Route::post('/deposit', [BalanceController::class, 'processDeposit'])->name('tenant.balance.process');
Route::get('/confirm', [BalanceController::class, 'confirmDeposit'])->name('tenant.balance.confirm');
});

// Документы
Route::get('/documents', [DocumentController::class, 'index'])->name('tenant.documents');

// Аренда
Route::resource('rentals', RentalController::class);
});

// Личный кабинет арендодателя
Route::prefix('landlord')->middleware(['auth', 'role:landlord'])->group(function () {
Route::get('/dashboard', [LandlordController::class, 'dashboard'])->name('landlord.dashboard');
Route::get('/orders', [LandlordController::class, 'orders'])->name('landlord.orders');

// Управление техникой
Route::resource('equipment', LandlordEquipmentController::class);

// Управление заказами
Route::resource('orders', LandlordOrderController::class);
});

// Админ-панель
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/bank-statements', [AdminController::class, 'bankStatements'])->name('admin.bank-statements');
});
