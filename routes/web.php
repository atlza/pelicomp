<?php

use App\Http\Controllers\Authenticate;
use App\Http\Controllers\Front;

use App\Http\Controllers\User\Brands;
use App\Http\Controllers\User\Offers;
use App\Http\Controllers\User\Products;
use App\Http\Controllers\User\Shops;
use App\Http\Controllers\User\Users;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [Front::class, 'home'])->name('home');
Route::get('/about', [Front::class, 'about'])->name('about');


Route::controller(Authenticate::class)->group(function () {
    Route::get('/login/{token}', [Authenticate::class, 'authWithToken'])->name('signin-token');
    Route::get('/login', [Authenticate::class, 'signin'])->name('signin');

    Route::post('/login', [Authenticate::class, 'authenticate'])->name('signin-authenticate');
});

Route::group(['middleware' => ['role:inactive']], function () {
    Route::get('/waiting', [Front::class, 'waiting'])->name('waiting');
});

Route::group(['middleware' => ['role:super admin|admin|contributor']], function () {
    Route::get('/brands', [Brands::class, 'brands'])->name('manage-brands');
    Route::post('/brands', [Brands::class, 'add'])->name('manage-brand-add');

    Route::get('/products', [Products::class, 'all'])->name('manage-products');
    Route::post('/products', [Products::class, 'add'])->name('manage-products-add');

    Route::post('/offer', [Offers::class, 'add'])->name('manage-offer-add');
});

Route::group(['middleware' => ['role:admin|super admin']], function () {
    Route::get('/shops', [Shops::class, 'shops'])->name('manage-shops');
    Route::post('/shops', [Shops::class, 'add'])->name('manage-shops-add');

    Route::get('/users', [Users::class, 'users'])->name('manage-users');
    Route::post('/users', [Users::class, 'edit'])->name('manage-users-edit');
});
