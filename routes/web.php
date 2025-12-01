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
if (app()->environment('production')) {
    Route::view('/', 'maintenance');
}

Route::controller(PageController::class)->group(function () {
    if (!app()->environment('production')) {
        Route::get('/', 'home');
    }
    Route::get('/nosotros', 'show')->defaults('slug', 'nosotros');
    Route::get('/contacto', 'show')->defaults('slug', 'contacto');
    Route::get('/bolsa', 'show')->defaults('slug', 'bolsa');
    Route::get('/terminos', 'show')->defaults('slug', 'terminos');
    Route::get('/privacidad', 'show')->defaults('slug', 'privacidad');
    Route::get('/fest', 'show')->defaults('slug', 'fest');
});

Route::controller(ProductController::class)->group(function () {
    Route::get('/vinos', 'index');
    Route::get('/vinos/{categoria}/{slug}', 'show')->name('products.show');
});

Route::controller(CategoryController::class)->group(function () {
    Route::get('/categorias', 'index');
    Route::get('/categorias/{slug}', 'show');
});

Route::controller(PromotionPublicController::class)->group(function () {
    Route::get('/promociones', 'index');
});

Route::controller(CartController::class)->group(function () {
    Route::get('/carrito', 'index');
    Route::post('/carrito/agregar', 'store');
    Route::post('/carrito/actualizar', 'update');
    Route::post('/carrito/eliminar', 'destroy');
});

Route::controller(CheckoutController::class)->group(function () {
    Route::get('/checkout', 'index');
    Route::post('/checkout', 'store');
    Route::post('/checkout/stripe', 'createStripeSession');
    Route::get('/checkout/success', 'success');
    Route::get('/checkout/cancel', 'cancel');
});

Route::controller(ContactController::class)->group(function () {
    Route::post('/contacto', 'store');
});

Route::controller(JobApplicationController::class)->group(function () {
    Route::post('/bolsa', 'store');
});

Route::controller(SitemapController::class)->group(function () {
    Route::get('/sitemap.xml', 'index');
});

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
