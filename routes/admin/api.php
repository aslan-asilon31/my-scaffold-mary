<?php

use Illuminate\Support\Facades\Route;



use App\Http\Controllers\Api\UserController;  
use App\Http\Controllers\Api\AuthController;  
use App\Http\Controllers\Api\contents\ProductController;  
use App\Http\Controllers\Api\contents\ProductCategoryFirstController;  
use App\Http\Controllers\Api\generals\MarketplaceController;
use App\Http\Controllers\Api\generals\EmployeeController;
use App\Http\Controllers\Api\generals\PositionController;
use App\Http\Controllers\Api\generals\PageController;
use App\Http\Controllers\Api\generals\PermissionController;

use App\Http\Controllers\Api\contents\MetaPropertyGroupController;
use App\Http\Controllers\Api\contents\MetaPropertyController;
use App\Http\Controllers\Api\contents\ProductBrandController;
use App\Http\Controllers\Api\contents\ProductContentController;
use App\Http\Controllers\Api\contents\CategoryRecommendationController;

use App\Http\Controllers\Api\sales\CustomerController;
use App\Http\Controllers\Api\sales\ProductSalesController;
use App\Http\Controllers\Api\CompanyController;



    // Route::apiResource('api/products', ProductController::class,'index');

    // Route::get('api/product-category-firsts', [ProductCategoryFirstController::class, 'index'])->name('product_category_firsts.list');

    // Route::get('api/employees', EmployeeResources\EmployeeController::class,'index');

    // Route::group(['prefix' => 'api', 'middleware' => 'auth'], function () {

    Route::get('api/companies', [CompanyController::class,'index'])->name('companies.list');




    // Contents
    Route::get('api/meta-property-groups',[MetaPropertyGroupController::class,'index']);

    Route::get('api/meta-properties', [MetaPropertyController::class,'index']);


    Route::get('api/product-brands', [ProductBrandController::class,'index']);
    Route::get('api/product-brands', [ProductBrandController::class,'index'])->name('product_brands.list');
    Route::post('api/product-brands/store', [ProductBrandController::class,'store'])->name('products.store');
    Route::get('api/product-brands/create', [ProductBrandController::class,'index'])->name('product_brands.create');
    Route::get('api/product-brands/edit/{id}', [ProductBrandController::class,'index'])->name('product_brands.edit');
    Route::get('api/product-brands/show/{id}/{readonly}', [ProductBrandController::class,'index'])->where('readonly', 'readonly')->name('product_brands.show');
    



    Route::get('api/product-contents/edit/{id}/metas', [ProductContentMetaController::class,'index']);
    Route::get('api/product-contents/edit/{id}/displays', [ProductContentDisplayController::class,'index']);
    Route::get('api/product-contents/edit/{id}/videos', [ProductContentVideoController::class,'index']);
    Route::get('api/product-contents/edit/{id}/specifications', [ProductContentSpecificationController::class,'index']);
    Route::get('api/product-contents/edit/{id}/features', [ProductContentFeatureController::class,'index']);
    Route::get('api/product-contents/edit/{id}/qnas', [ProductContentQnaController::class,'index']);
    Route::get('api/product-contents/edit/{id}/reviews', [ProductContentReviewController::class,'index']);
    Route::get('api/product-contents/edit/{id}/review-images', [ProductContentReviewImageController::class,'index']);

    Route::get('api/product-contents', [ProductContentController::class,'']);
    Route::get('api/product-contents/create', [ProductContentController::class,'']);
    Route::get('api/product-contents/edit/{id}', [ProductContentController::class,'']);
    Route::get('api/product-contents/edit/{id}/readonly', [ProductContentController::class,'']);
    Route::get('api/product-content-metas/edit/{id}', [ProductContentMetaController::class,'']);
    Route::get('api/product-content-displays/edit/{id}', [ProductContentDisplayController::class,'']);
    Route::get('api/product-content-videos/edit/{id}', [ProductContentVideoController::class,'']);
    Route::get('api/product-content-specifications/edit/{id}', [ProductContentSpecificationController::class,'']);
    Route::get('api/product-content-features/edit/{id}', [ProductContentFeatureController::class,'']);
    Route::get('api/product-content-qnas/edit/{id}', [ProductContentQnaController::class,'']);
    Route::get('api/product-content-reviews/edit/{id}', [ProductContentReviewController::class,'']);
   
    Route::get('api/product-category-firsts', [ProductCategoryFirstController::class,''])->name('product_category_firsts.list');
    Route::get('api/product-category-firsts/create', [ProductCategoryFirstController::class,''])->name('product_category_firsts.create');
    Route::get('api/product-category-firsts/edit/{id}', [ProductCategoryFirstController::class,''])->name('product_category_firsts.edit');
    Route::get('api/product-category-firsts/show/{id}/{readonly}', [ProductCategoryFirstController::class,''])->where('readonly', 'readonly')->name('product_category_firsts.show');

    Route::get('api/product-category-seconds', [ProductCategorySecondController::class,''])->name('product_category_seconds.list');
    Route::get('api/product-category-seconds/create', [ProductCategorySecondController::class,''])->name('product_category_seconds.create');
    Route::get('api/product-category-seconds/edit/{id}', [ProductCategorySecondController::class,''])->name('product_category_seconds.edit');
    Route::get('api/product-category-seconds/show/{id}/{readonly}', [ProductCategorySecondController::class,''])->where('readonly', 'readonly')->name('product_category_seconds.show');


    // Generals
    Route::get('api/dashboards', [DashboardController::class,'index'])->name('dashboard');

    Route::get('api/marketplaces', [MarketplaceController::class,'index']);
    Route::get('api/marketplaces/create', [MarketplaceController::class,'index'])->name('marketplaces.create');
    Route::get('api/marketplaces/edit/{id}', [MarketplaceController::class,'index'])->name('marketplaces.edit');
    Route::get('api/marketplaces/show/{id}/{readonly}', [MarketplaceController::class,'index'])->where('readonly', 'readonly')->name('products.show');

    Route::get('api/employees', [EmployeeController::class,'index']);
    Route::get('api/employees/create', [EmployeeController::class,'index']);
    Route::get('api/employees/edit/{id}', [EmployeeController::class,'index'])->name('employees.edit');
    Route::get('api/employees/show/{id}/{readonly}', [EmployeeController::class,'index'])->where('readonly', 'readonly')->name('employees.show');
    
    Route::get('api/employee-accounts', [EmployeeAccountController::class,'index']);
    Route::get('api/employee-accounts/create', [EmployeeAccountController::class,'index']);
    Route::get('api/employee-accounts/edit/{id}', [EmployeeAccountController::class,'index'])->name('employee-accounts.edit');
    Route::get('api/employee-accounts/show/{id}/{readonly}', [EmployeeAccountController::class,'index'])->where('readonly', 'readonly')->name('employee-accounts.show');

    Route::get('api/positions', [PositionController::class,'index']);
    Route::get('api/positions/create', [PositionController::class,'index']);
    Route::get('api/positions/edit/{id}', [PositionController::class,'index'])->name('positions.edit');
    Route::get('api/positions/show/{id}/{readonly}', [PositionController::class,'index'])->where('readonly', 'readonly')->name('positions.show');

    Route::get('api/pages', [PageController::class,'index']);
    Route::get('api/pages/create', [PageController::class,'index']);
    Route::get('api/pages/edit/{id}', [PageController::class,'index'])->name('pages.edit');
    Route::get('api/pages/show/{id}/{readonly}', [PageController::class,'index'])->where('readonly', 'readonly')->name('pages.show');


    Route::get('api/permissions', [PermissionController::class,'index']);
    Route::get('api/permissions/edit/{id}', [PermissionController::class,'index'])->name('pages.edit');
    Route::get('api/permissions/show/{id}/{readonly}', [PermissionController::class,'index'])->where('readonly', 'readonly')->name('pages.show');

    // Sales 
    Route::get('api/customers', [CustomerController::class,'index']);
    Route::get('api/customers/create', [CustomerController::class,'index']);
    Route::get('api/customers/edit/{id}', [CustomerController::class,'index'])->name('customer.edit');
    Route::get('api/customers/show/{id}/{readonly}', [CustomerController::class,'index'])->where('readonly', 'readonly')->name('customer.show');
    Route::post('api/customers/store', [CustomerController::class,'store'])->name('customer.store');


    Route::get('api/sales-orders', [SalesOrderController::class,'index']);
    Route::get('api/sales-orders/create', [SalesOrderController::class,'index']);
    // Route::get('api/sales-orders/update/{slug}', \App\Livewire\Pages\Admin\Sales\SalesOrderResources\SalesOrderController::class,'index')->name('sales-order.edit');
    // Route::get('api/sales-orders/update/{id}', \App\Livewire\Pages\Admin\Sales\SalesOrderResources\SalesOrderController::class,'index')->name('sales-order.edit');
    // Route::get('api/sales-orders/update/{id}/{slug}', \App\Livewire\Pages\Admin\Sales\SalesOrderResources\SalesOrderController::class,'index')->name('sales-order.edit');
    Route::get('api/sales-orders/update/{id}', [SalesOrderController::class,'index'])->name('sales-order.edit');
    
    Route::get('api/sales-orders/edit/{id}', [SalesOrderController::class,'index'])->name('sales-order.edit');

    Route::get('api/sales-orders/show/{id}/{readonly}', [SalesOrderController::class,'index'])->where('readonly', 'readonly')->name('sales-order.show');
    Route::get('api/sales-orders/activate/{id}/{value}', [SalesOrderController::class,'index'])
    ->where('readonly', 'readonly')
    ->name('sales-order.show');

    Route::get('api/category-recommendations', [CategoryRecommendationController::class,'index'])->name('category_recommendations.list');
    Route::get('api/category-recommendations/create', [CategoryRecommendationController::class,'index'])->name('category_recommendations.create');
    Route::get('api/category-recommendations/edit/{id}', [CategoryRecommendationController::class,'index'])->name('category_recommendations.edit');
    Route::get('api/category-recommendations/show/{id}/{readonly}', [CategoryRecommendationController::class,'index'])->where('readonly', 'readonly')->name('category_recommendations.show');


// });


Route::post('api/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);
Route::post('api/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('api/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);
});