<?php

use App\Http\Controllers\GiftController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\RawMaterialController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StocksController;
use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\UnitController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Models\Purchase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

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
    return redirect(route('admin-index'));
})->middleware('auth');

Auth::routes();

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.index');
    })->name('admin-index');

    Route::get('/page', [UsersController::class, 'index'])->name('admin-page');
    Route::get('/create', [UsersController::class, 'create'])->name('admin-create');
    Route::post('/store', [UsersController::class, 'store'])->name('admin-store');
    Route::get('/edit/{id}', [UsersController::class, 'edit'])->name('admin-edit');
    Route::put('/update/{id}', [UsersController::class, 'update'])->name('admin-update');

    Route::post('/status', [UsersController::class, 'status'])->name('status');

    Route::get('/supplier', [SuppliersController::class, 'index'])->name('supplier');
    Route::get('/supplier/create', [SuppliersController::class, 'create'])->name('supplier.create');
    Route::post('/supplier/store', [SuppliersController::class, 'store'])->name('supplier.store');
    Route::get('/supplier/edit/{id}', [SuppliersController::class, 'edit'])->name('supplier.edit');
    Route::put('/supplier/update/{id}', [SuppliersController::class, 'update'])->name('supplier.update');

    Route::post('/supplier/status', [SuppliersController::class, 'status'])->name('supplier.status');

    Route::get('/item', [GiftController::class, 'index'])->name('gift');
    Route::get('/item/create', [GiftController::class, 'create'])->name('gift.create');
    Route::post('/item/store', [GiftController::class, 'store'])->name('gift.store');
    Route::get('/item/edit/{id}', [GiftController::class, 'edit'])->name('gift.edit');
    Route::put('/item/update/{id}', [GiftController::class, 'update'])->name('gift.update');

    Route::post('/gift.status', [GiftController::class, 'status'])->name('gift.status');

    Route::get('/unit', [UnitController::class, 'index'])->name('unit');
    Route::get('/unit/create', [UnitController::class, 'create'])->name('unit.create');
    Route::post('/unit/store', [UnitController::class, 'store'])->name('unit.store');
    Route::get('/unit/edit/{id}', [UnitController::class, 'edit'])->name('unit.edit');
    Route::put('/unit/update/{id}', [UnitController::class, 'update'])->name('unit.update');

    Route::post('/unit/status', [UnitController::class, 'status'])->name('unit.status');

    Route::get('/raw-material', [RawMaterialController::class, 'index'])->name('raw-material');
    Route::get('/raw-material/create', [RawMaterialController::class, 'create'])->name('raw-material.create');
    Route::post('/raw-material/store', [RawMaterialController::class, 'store'])->name('raw-material.store');
    Route::get('/raw-material/edit/{id}', [RawMaterialController::class, 'edit'])->name('raw-material.edit');
    Route::put('/raw-material/update/{id}', [RawMaterialController::class, 'update'])->name('raw-material.update');

    Route::post('/raw-material/status', [RawMaterialController::class, 'status'])->name('raw-material.status');

    Route::resource('product', ProductController::class);
    Route::post('/product/fetch-raw-materials', [ProductController::class, 'rawMaterials'])->name('product.raw-materials');
    Route::post('/product/status', [ProductController::class, 'status'])->name('product.status');

    Route::get('/material/index',[PurchaseController::class,'material_index'])->name('material-index');
    Route::post('/purchase/material/store', [PurchaseController::class, 'materialStore'])->name('purchase.materialStore');

    Route::get('/item/index',[PurchaseController::class,'item_index'])->name('item-index');
    Route::post('/purchase/item/store', [PurchaseController::class, 'itemStore'])->name('purchase.itemStore');

    Route::get('/purchase/material',[PurchaseController::class,'material'])->name('purchase-material');
    Route::get('purchase/item',[PurchaseController::class,'item'])->name('purchase-item');

    Route::get('stocks/material',[StocksController::class,'material_index'])->name('material-stock');
    Route::get('stocks/item',[StocksController::class,'item_index'])->name('item-stock');
    
    Route::get('stocks/material/detail',[StocksController::class,'material_detail'])->name('material-detail');
    Route::get('stocks/material/detail/{id}',[StocksController::class,'material_detail_id'])->name('material-detail-id');

    Route::get('stocks/item/detail',[StocksController::class,'item_detail'])->name('item-detail');
    Route::get('stocks/material/item/{id}',[StocksController::class,'item_detail_id'])->name('item-detail-id');
    // Route::get('stocks/item',[StocksController::class,'item_index'])->name('item-stock');

    Route::get('stocks/details',[StocksController::class,'stock_details'])->name('stock-details');

    Route::get('/signin', function () {
        return view('admin.signin');
    })->name('signin');

    Route::get('/signup', function () {
        return view('admin.signup');
    })->name('signup');

    Route::get('/table', function () {
        return view('admin.tables');
    })->name('table');
});



// Route::get('/gift', function () {
//     return view('admin.gift');
// })->name('gift');




Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('migrate', function () {
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('migrate');
});


Route::get('/storage-link', function(){
    $target = storage_path('app/public');
    $link = public_path('/storage');
    echo symlink($target, $link);
    // echo "symbolic link created successfully";
});

// Route::get('/test',function(){
//     $purchase = Purchase::find(8);
//     $purchase->modal;
//     return $purchase;
// });
