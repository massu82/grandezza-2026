<?php

use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\PromotionController as AdminPromotionController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\Admin\LeadController as AdminLeadController;
use App\Http\Controllers\Admin\CandidateController as AdminCandidateController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PromotionPublicController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\OrderController as UserOrderController;
use App\Http\Controllers\User\SupportController as UserSupportController;
use Illuminate\Support\Facades\Route;

/**
 * Rutas públicas
 */
Route::get('/', [HomeController::class, 'index']);
Route::get('/vinos', [ProductController::class, 'index']);
Route::get('/vinos/{categoria}/{slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('/categorias', [CategoryController::class, 'index']);
Route::get('/categorias/{slug}', [CategoryController::class, 'show']);
Route::get('/promociones', [PromotionPublicController::class, 'index']);

Route::get('/carrito', [CartController::class, 'index']);
Route::post('/carrito/agregar', [CartController::class, 'store']);
Route::post('/carrito/actualizar', [CartController::class, 'update']);
Route::post('/carrito/eliminar', [CartController::class, 'destroy']);

Route::get('/checkout', [CheckoutController::class, 'index']);
Route::post('/checkout', [CheckoutController::class, 'store']);

Route::get('/nosotros', [PageController::class, 'show'])->defaults('slug', 'nosotros');
Route::get('/contacto', [PageController::class, 'show'])->defaults('slug', 'contacto');
Route::post('/contacto', [ContactController::class, 'store']);
Route::get('/bolsa', [PageController::class, 'show'])->defaults('slug', 'bolsa');
Route::post('/bolsa', [JobApplicationController::class, 'store']);
Route::get('/terminos', [PageController::class, 'show'])->defaults('slug', 'terminos');
Route::get('/privacidad', [PageController::class, 'show'])->defaults('slug', 'privacidad');

Route::get('/sitemap.xml', [SitemapController::class, 'index']);

/**
 * Rutas de administración
 */
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::patch('products/{product}/inline', [AdminProductController::class, 'inlineUpdate'])->name('products.inline');
    Route::get('products/{product}/duplicate', [AdminProductController::class, 'duplicate'])->name('products.duplicate');
    Route::resource('products', AdminProductController::class);
    Route::resource('categories', AdminCategoryController::class);
    Route::resource('promotions', AdminPromotionController::class);
    Route::resource('pages', AdminPageController::class);
    Route::resource('orders', AdminOrderController::class)->only(['index', 'show', 'update']);
    Route::resource('leads', AdminLeadController::class)->only(['index', 'show', 'destroy']);
    Route::resource('candidates', AdminCandidateController::class)->only(['index', 'show', 'destroy']);
    Route::get('settings', [AdminSettingController::class, 'index'])->name('settings.index');
    Route::put('settings', [AdminSettingController::class, 'update'])->name('settings.update');
});

/**
 * Panel de usuario
 */
Route::middleware('auth')->prefix('panel')->name('panel.')->group(function () {
    Route::get('/', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('/orders', [UserOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [UserOrderController::class, 'show'])->name('orders.show');
    Route::get('/soporte', [UserSupportController::class, 'create'])->name('support.create');
    Route::post('/soporte', [UserSupportController::class, 'store'])->name('support.store');
    Route::get('/perfil', function () {
        return redirect()->route('profile.edit');
    })->name('profile');
});

// Alias para compatibilidad con navegación Breeze
Route::middleware('auth')->get('/dashboard', function () {
    return redirect()->route('panel.dashboard');
})->name('dashboard');

// Alias para vista de perfil (compatibilidad navegación Breeze)
Route::middleware('auth')->get('/perfil', function () {
    return redirect('/user/profile');
})->name('profile.edit');

require __DIR__.'/auth.php';
