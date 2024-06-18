<?php

use App\Http\Controllers\Authenticate;
use App\Http\Controllers\Front;

use App\Http\Controllers\User\Brands;
use App\Http\Controllers\User\Offers;
use App\Http\Controllers\User\Products;
use App\Http\Controllers\User\shops;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/signin', [Front::class, 'signin'])->name('signin');
Route::get('/', [Front::class, 'home'])->name('home');


Route::controller(Authenticate::class)->group(function () {
    Route::get('/login/{token}', [Authenticate::class, 'authWithToken'])->name('signin-token');
    Route::get('/login', [Authenticate::class, 'signin'])->name('signin');

    Route::post('/login', [Authenticate::class, 'authenticate'])->name('signin-authenticate');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/brands', [Brands::class, 'brands'])->name('connected-brands');
    Route::post('/brands', [Brands::class, 'add'])->name('connected-brand-add');

    Route::get('/products', [Products::class, 'all'])->name('connected-products');
    Route::get('/products/{id}', [Products::class, 'view'])->name('connected-product-view');
    Route::post('/products', [Products::class, 'add'])->name('connected-products-add');

    Route::get('/shops', [shops::class, 'shops'])->name('connected-shops');
    Route::post('/shops', [Shops::class, 'add'])->name('connected-shops-add');

    Route::post('/offer', [Offers::class, 'add'])->name('connected-offer-add');
});
