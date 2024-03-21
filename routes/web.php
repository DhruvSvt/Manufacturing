<?php

use App\Http\Controllers\GiftController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\RawMaterialController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HeadquartersController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\PackingController;
use App\Http\Controllers\PackingStockController;
use App\Http\Controllers\PartyPaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductionCreateController;
use App\Http\Controllers\ReturnController;
use App\Http\Controllers\SaleInvoiceController;
use App\Http\Controllers\SampleController;
use App\Http\Controllers\StockAlertController;
use App\Http\Controllers\StocksController;
use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\UnitController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Models\Brand;
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
    Route::get('/index', [IndexController::class, 'detailsOnIndex'])->name('admin-index');

    // --------------------- User ---------------------
    Route::get('/page', [UsersController::class, 'index'])->name('admin-page');
    Route::get('/create', [UsersController::class, 'create'])->name('admin-create');
    Route::post('/store', [UsersController::class, 'store'])->name('admin-store');
    Route::get('/edit/{id}', [UsersController::class, 'edit'])->name('admin-edit');
    Route::put('/update/{id}', [UsersController::class, 'update'])->name('admin-update');

    Route::post('/status', [UsersController::class, 'status'])->name('status');

    // --------------------- Supplier ---------------------
    Route::get('/supplier', [SuppliersController::class, 'index'])->name('supplier');
    Route::get('/supplier/create', [SuppliersController::class, 'create'])->name('supplier.create');
    Route::post('/supplier/store', [SuppliersController::class, 'store'])->name('supplier.store');
    Route::get('/supplier/edit/{id}', [SuppliersController::class, 'edit'])->name('supplier.edit');
    Route::put('/supplier/update/{id}', [SuppliersController::class, 'update'])->name('supplier.update');

    Route::post('/supplier/status', [SuppliersController::class, 'status'])->name('supplier.status');

    // --------------------- Gift ---------------------
    Route::get('/item', [GiftController::class, 'index'])->name('gift');
    Route::get('/item/create', [GiftController::class, 'create'])->name('gift.create');
    Route::post('/item/store', [GiftController::class, 'store'])->name('gift.store');
    Route::get('/item/edit/{id}', [GiftController::class, 'edit'])->name('gift.edit');
    Route::put('/item/update/{id}', [GiftController::class, 'update'])->name('gift.update');

    Route::post('/gift.status', [GiftController::class, 'status'])->name('gift.status');

    // --------------------- Unit ---------------------
    Route::get('/unit', [UnitController::class, 'index'])->name('unit');
    Route::get('/unit/create', [UnitController::class, 'create'])->name('unit.create');
    Route::post('/unit/store', [UnitController::class, 'store'])->name('unit.store');
    Route::get('/unit/edit/{id}', [UnitController::class, 'edit'])->name('unit.edit');
    Route::put('/unit/update/{id}', [UnitController::class, 'update'])->name('unit.update');

    Route::post('/unit/status', [UnitController::class, 'status'])->name('unit.status');

    // --------------------- raw-material ---------------------
    Route::get('/raw-material', [RawMaterialController::class, 'index'])->name('raw-material');
    Route::get('/raw-material/create', [RawMaterialController::class, 'create'])->name('raw-material.create');
    Route::post('/raw-material/store', [RawMaterialController::class, 'store'])->name('raw-material.store');
    Route::get('/raw-material/edit/{id}', [RawMaterialController::class, 'edit'])->name('raw-material.edit');
    Route::put('/raw-material/update/{id}', [RawMaterialController::class, 'update'])->name('raw-material.update');

    Route::post('/raw-material/status', [RawMaterialController::class, 'status'])->name('raw-material.status');

    // --------------------- brand --------------------
    Route::get('/brand', [BrandController::class, 'index'])->name('brand');
    Route::post('/brand/store', [BrandController::class, 'store'])->name('brand.store');
    Route::put('/brand/update/{id}', [BrandController::class, 'update'])->name('brand.update');
    Route::post('/brand/status', [BrandController::class, 'status'])->name('brand.status');

    // --------------------- headquarter ---------------------
    Route::get('/headquarter', [HeadquartersController::class, 'index'])->name('headquarters');
    Route::post('/headquarter/store', [HeadquartersController::class, 'store'])->name('headquarter.store');
    Route::put('/headquarter/update/{id}', [HeadquartersController::class, 'update'])->name('headquarter.update');
    Route::post('/headquarter/status', [HeadquartersController::class, 'status'])->name('headquarter.status');
    // Route::put('/brand/update/{id}', [BrandController::class, 'update'])->name('brand.update');

    // --------------------- Product routes ---------------------
    Route::resource('product', ProductController::class);
    Route::post('/product/fetch-raw-materials', [ProductController::class, 'rawMaterials'])->name('product.raw-materials');
    Route::post('/product/status', [ProductController::class, 'status'])->name('product.status');

    // --------------------- Employee routes ---------------------
    Route::resource('employee', EmployeeController::class);
    Route::post('employee/status', [EmployeeController::class, 'status'])->name('employee.status');

    // --------------------- Purchase routes ---------------------
    Route::get('/purchase/material', [PurchaseController::class, 'material_fetch'])->name('material-fetch');
    Route::get('purchase/item', [PurchaseController::class, 'item_fetch'])->name('item-fetch');
    Route::get('purchase/product', [PurchaseController::class, 'product_fetch'])->name('product-fetch');
    // Route::get('purchase/other', [PurchaseController::class, 'other'])->name('purchase-other');

    Route::get('/purchase/material/create', [PurchaseController::class, 'material'])->name('purchase-material');
    Route::get('purchase/item/create', [PurchaseController::class, 'item'])->name('purchase-item');
    Route::get('purchase/product/create', [PurchaseController::class, 'product'])->name('purchase-product');
    Route::get('purchase/other/create', [PurchaseController::class, 'other'])->name('purchase-other');

    Route::post('/purchase/material/store', [PurchaseController::class, 'materialStore'])->name('purchase.materialStore');
    Route::post('/purchase/item/store', [PurchaseController::class, 'itemStore'])->name('purchase.itemStore');
    Route::post('purchase/product/store', [PurchaseController::class, 'productStore'])->name('purchase.productStore');
    Route::post('purchase/product/other', [PurchaseController::class, 'otherStore'])->name('purchase.otherStore');

    // --------------------- stocks routes ---------------------
    Route::get('stocks/material', [StocksController::class, 'material_index'])->name('material-stock');
    Route::get('stocks/item', [StocksController::class, 'item_index'])->name('item-stock');

    Route::get('stocks/material/detail', [StocksController::class, 'material_detail'])->name('material-detail');
    Route::get('stocks/material/detail/{id}', [StocksController::class, 'material_detail_id'])->name('material-detail-id');

    Route::get('stocks/item/detail', [StocksController::class, 'item_detail'])->name('item-detail');
    Route::get('stocks/item/detail/{id}', [StocksController::class, 'item_detail_id'])->name('item-detail-id');
    // Route::get('stocks/item',[StocksController::class,'item_index'])->name('item-stock');

    Route::get('stocks/product/detail', [StocksController::class, 'product_detail'])->name('product-detail');
    Route::get('stocks/product/detail/{id}', [StocksController::class, 'product_detail_id'])->name('product-detail-id');

    Route::get('stocks/details', [StocksController::class, 'stock_details'])->name('stock-details');

    // --------------------- sample ---------------------
    Route::resource('sample', SampleController::class);
    Route::get('sample/detail/{id}', [SampleController::class, 'sample_detail_id'])->name('sample-detail-id');

    // --------------------- production routes ---------------------
    Route::get('production/create', [ProductionCreateController::class, 'create'])->name('production-create');
    Route::post('production/final/store', [ProductionCreateController::class, 'store'])->name('production.store');

    Route::get('production/proccess', [ProductionCreateController::class, 'proccess'])->name('production-proccess');
    Route::put('production/update/{id}', [ProductionCreateController::class, 'update'])->name('finish-good.update');
    Route::post('/production/status', [ProductionCreateController::class, 'status'])->name('production.status');

    Route::get('production/complete', [ProductionCreateController::class, 'complete'])->name('production-complete');
    Route::get('production/pdf/{id}', [ProductionCreateController::class, 'pdf_generate'])->name('print-production');
    Route::get('product/pdf/{id}', [ProductionCreateController::class, 'pdf_product'])->name('print-product');

    // Final production routes
    Route::get('production/final', [ProductionCreateController::class, 'final_create'])->name('production-final-create');
    Route::post('production/final', [ProductionCreateController::class, 'final_store'])->name('production.final.store');

    // --------------------- Issue Challan routes ---------------------
    // Gift
    Route::get('gift/challan', [IssueController::class, 'gift_index'])->name('gift-challan');
    Route::get('gift/create', [IssueController::class, 'gift_create'])->name('gift-create');
    Route::post('/gift/challan/store', [IssueController::class, 'gift_store'])->name('gift-store');

    // Sample-challan
    Route::get('sample-challan', [IssueController::class, 'sample'])->name('sample-challan');
    Route::post('/sample-challan/store', [IssueController::class, 'sample_store'])->name('sample-challan-store');

    // Raw-Material
    Route::get('raw-material/challan', [IssueController::class, 'raw_material_index'])->name('raw-material-challan');

    // Good
    Route::get('complete-good/challan', [IssueController::class, 'complete_good'])->name('complete-good-challan');


    // --------------------- Return Routes ---------------------
    Route::get('good/return', [ReturnController::class, 'good_return'])->name('good-return');
    Route::get('good/return/create', [ReturnController::class, 'good_return_create'])->name('good-return-create');
    Route::post('good/return/store', [ReturnController::class, 'good_return_store'])->name('good-return-store');
    Route::get('good/return/pdf/{id}', [ReturnController::class, 'print'])->name('print-return');

    // --------------------- Sales Routes ---------------------
    Route::resource('sale', SaleInvoiceController::class);
    Route::get('sale/print/{id}', [SaleInvoiceController::class, 'print'])->name('print-sale');

    // --------------------- Payment Routes ---------------------
    Route::resource('payment', PartyPaymentController::class);

    // --------------------- Packing Routes ---------------------
    Route::resource('packing', PackingController::class);
    Route::post('packing/store', [PackingController::class, 'store'])->name('packing.store');
    Route::post('/packing', [PackingController::class, 'status'])->name('packing.status');

    // --------------------- Packing Stock Routes ---------------------
    Route::resource('packing-stock', PackingStockController::class);
    Route::get('packing-stock/detail/{id}', [PackingStockController::class, 'packingStockDetail'])->name('packing-detail');

    // --------------------- Tour Routes ---------------------
    Route::resource('tour', TourController::class);
    Route::get('/tour-product/{id}',[TourController::class, 'product_fetch'])->name('tour.product');

    // --------------------- Sell Goods Challan ---------------------
    // Route::get('finish-good/issue', [IssueController::class, 'finish_good_index'])->name('finish-good-challan');
    // Route::post('/finish-good/issue/store', [IssueController::class, 'finish_good_store'])->name('finish-good-store');
    // Route::put('/gift/issue', [IssueController::class, 'issue_gift'])->name('gift.issue');

    // Stock Alert routes
    Route::get('stock-alert', [StockAlertController::class, 'index'])->name('stock-alert');

    Route::get('/signin', function () {
        return view('admin.signin');
    })->name('signin');

    Route::get('/signup', function () {
        return view('admin.signup');
    })->name('signup');

    Route::get('/table', function () {
        return view('admin.tables');
    })->name('table');

    Route::get('/chart/material', function () {
        return view('admin.reports.report-material');
    })->name('material-chart');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('migrate', function () {
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('migrate');
});


Route::get('/storage-link', function () {
    $target = storage_path('app/public');
    $link = public_path('/storage');
    echo symlink($target, $link);
    // echo "symbolic link created successfully";
});
