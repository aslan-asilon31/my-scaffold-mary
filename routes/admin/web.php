<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', \App\Livewire\Pages\AuthenticationResources\Login::class)->name('login');


Route::group(['middleware' => 'auth'], function () {

    // Contents
    Route::get('/meta-property-groups', \App\Livewire\Pages\Admin\Contents\MetaPropertyGroupResources\MetaPropertyGroupList::class);

    Route::get('/meta-properties', \App\Livewire\Pages\Admin\Contents\MetaPropertyResources\MetaPropertyList::class);

    // Route::get('/products', \App\Livewire\Pages\Admin\Contents\ProductResources\ProductList::class);
    Route::get('/products', \App\Livewire\Pages\Admin\Contents\ProductResources\ProductList::class)->name('products.list');
    Route::get('/products/create', \App\Livewire\Pages\Admin\Contents\ProductResources\ProductCrud::class)->name('products.create');
    Route::get('/products/edit/{id}', \App\Livewire\Pages\Admin\Contents\ProductResources\ProductCrud::class)->name('products.edit');
    Route::get('/products/show/{id}/{readonly}', \App\Livewire\Pages\Admin\Contents\ProductResources\ProductCrud::class)->where('readonly', 'readonly')->name('products.show');

    // Route::get('/product-brands', \App\Livewire\Pages\Admin\Contents\ProductBrandResources\ProductBrandList::class);
    // Route::get('/product-brands', \App\Livewire\Pages\Admin\Contents\ProductBrandResources\ProductBrandList::class)->name('product_brands.list');
    // Route::get('/product-brands/create', \App\Livewire\Pages\Admin\Contents\ProductBrandResources\ProductBrandCrud::class)->name('product_brands.create');
    // Route::get('/product-brands/edit/{id}', \App\Livewire\Pages\Admin\Contents\ProductBrandResources\ProductBrandCrud::class)->name('product_brands.edit');
    // Route::get('/product-brands/show/{id}/{readonly}', \App\Livewire\Pages\Admin\Contents\ProductBrandResources\ProductBrandCrud::class)->where('readonly', 'readonly')->name('product_brands.show');
    
    Route::get('/product-contents/edit/{id}/metas', \App\Livewire\Pages\Admin\Contents\ProductContentResources\ProductContentMetaCrud::class);
    Route::get('/product-contents/edit/{id}/displays', \App\Livewire\Pages\Admin\Contents\ProductContentResources\ProductContentDisplayCrud::class);
    Route::get('/product-contents/edit/{id}/videos', \App\Livewire\Pages\Admin\Contents\ProductContentResources\ProductContentVideoCrud::class);
    Route::get('/product-contents/edit/{id}/specifications', \App\Livewire\Pages\Admin\Contents\ProductContentResources\ProductContentSpecificationCrud::class);
    Route::get('/product-contents/edit/{id}/features', \App\Livewire\Pages\Admin\Contents\ProductContentResources\ProductContentFeatureCrud::class);
    Route::get('/product-contents/edit/{id}/qnas', \App\Livewire\Pages\Admin\Contents\ProductContentResources\ProductContentQnaCrud::class);
    Route::get('/product-contents/edit/{id}/reviews', \App\Livewire\Pages\Admin\Contents\ProductContentResources\ProductContentReviewCrud::class);
    Route::get('/product-contents/edit/{id}/review-images', \App\Livewire\Pages\Admin\Contents\ProductContentResources\ProductContentReviewImageCrud::class);

    Route::get('/product-contents', \App\Livewire\Pages\Admin\Contents\ProductContentResources\ProductContentList::class);
    Route::get('/product-contents/create', \App\Livewire\Pages\Admin\Contents\ProductContentResources\ProductContentCrud::class);
    Route::get('/product-contents/edit/{id}', \App\Livewire\Pages\Admin\Contents\ProductContentResources\ProductContentCrud::class);
    Route::get('/product-contents/edit/{id}/readonly', \App\Livewire\Pages\Admin\Contents\ProductContentResources\ProductContentCrud::class);
    Route::get('/product-content-metas/edit/{id}', \App\Livewire\Pages\Admin\Contents\ProductContentResources\ProductContentMetaCrud::class);
    Route::get('/product-content-displays/edit/{id}', \App\Livewire\Pages\Admin\Contents\ProductContentResources\ProductContentDisplayCrud::class);
    Route::get('/product-content-videos/edit/{id}', \App\Livewire\Pages\Admin\Contents\ProductContentResources\ProductContentVideoCrud::class);
    Route::get('/product-content-specifications/edit/{id}', \App\Livewire\Pages\Admin\Contents\ProductContentResources\ProductContentSpecificationCrud::class);
    Route::get('/product-content-features/edit/{id}', \App\Livewire\Pages\Admin\Contents\ProductContentResources\ProductContentFeatureCrud::class);
    Route::get('/product-content-qnas/edit/{id}', \App\Livewire\Pages\Admin\Contents\ProductContentResources\ProductContentQnaCrud::class);
    Route::get('/product-content-reviews/edit/{id}', \App\Livewire\Pages\Admin\Contents\ProductContentResources\ProductContentReviewCrud::class);
   
    Route::get('/product-category-firsts', \App\Livewire\Pages\Admin\Contents\ProductCategoryFirstResources\ProductCategoryFirstList::class)->name('product_category_firsts.list');
    Route::get('/product-category-firsts/create', \App\Livewire\Pages\Admin\Contents\ProductCategoryFirstResources\ProductCategoryFirstCrud::class)->name('product_category_firsts.create');
    Route::get('/product-category-firsts/edit/{id}', \App\Livewire\Pages\Admin\Contents\ProductCategoryFirstResources\ProductCategoryFirstCrud::class)->name('product_category_firsts.edit');
    Route::get('/product-category-firsts/show/{id}/{readonly}', \App\Livewire\Pages\Admin\Contents\ProductCategoryFirstResources\ProductCategoryFirstCrud::class)->where('readonly', 'readonly')->name('product_category_firsts.show');

    Route::get('/product-brands', \App\Livewire\Pages\Admin\Contents\ProductBrandResources\ProductBrandList::class)->name('product_brands.list');
    Route::get('/product-brands/create', \App\Livewire\Pages\Admin\Contents\ProductBrandResources\ProductBrandCrud::class)->name('product_brands.create');
    Route::get('/product-brands/edit/{id}', \App\Livewire\Pages\Admin\Contents\ProductBrandResources\ProductBrandCrud::class)->name('product_brands.edit');
    Route::get('/product-brands/show/{id}/{readonly}', \App\Livewire\Pages\Admin\Contents\ProductBrandResources\ProductBrandCrud::class)->where('readonly', 'readonly')->name('product_brands.show');

    Route::get('/product-category-seconds', \App\Livewire\Pages\Admin\Contents\ProductCategorySecondResources\ProductCategorySecondList::class)->name('product_category_seconds.list');
    Route::get('/product-category-seconds/create', \App\Livewire\Pages\Admin\Contents\ProductCategorySecondResources\ProductCategorySecondCrud::class)->name('product_category_seconds.create');
    Route::get('/product-category-seconds/edit/{id}', \App\Livewire\Pages\Admin\Contents\ProductCategorySecondResources\ProductCategorySecondCrud::class)->name('product_category_seconds.edit');
    Route::get('/product-category-seconds/show/{id}/{readonly}', \App\Livewire\Pages\Admin\Contents\ProductCategorySecondResources\ProductCategorySecondCrud::class)->where('readonly', 'readonly')->name('product_category_seconds.show');


    // Generals
    Route::get('/dashboards', \App\Livewire\Pages\Admin\Generals\DashboardResources\DashboardList::class)->name('dashboard');

    Route::get('/marketplaces', \App\Livewire\Pages\Admin\Generals\MarketplaceResources\MarketplaceList::class);
    Route::get('/marketplaces/create', \App\Livewire\Pages\Admin\Generals\MarketplaceResources\MarketplaceCrud::class)->name('marketplaces.create');
    Route::get('/marketplaces/edit/{id}', \App\Livewire\Pages\Admin\Generals\MarketplaceResources\MarketplaceCrud::class)->name('marketplaces.edit');
    Route::get('/marketplaces/show/{id}/{readonly}', \App\Livewire\Pages\Admin\Generals\MarketplaceResources\MarketplaceCrud::class)->where('readonly', 'readonly')->name('products.show');

    Route::get('/employees', \App\Livewire\Pages\Admin\Generals\EmployeeResources\EmployeeList::class);
    Route::get('/employees/create', \App\Livewire\Pages\Admin\Generals\EmployeeResources\EmployeeCrud::class);
    Route::get('/employees/edit/{id}', \App\Livewire\Pages\Admin\Generals\EmployeeResources\EmployeeCrud::class)->name('employees.edit');
    Route::get('/employees/show/{id}/{readonly}', \App\Livewire\Pages\Admin\Generals\EmployeeResources\EmployeeCrud::class)->where('readonly', 'readonly')->name('employees.show');
    
    Route::get('/employee-accounts', \App\Livewire\Pages\Admin\Generals\EmployeeAccountResources\EmployeeAccountList::class);
    Route::get('/employee-accounts/create', \App\Livewire\Pages\Admin\Generals\EmployeeAccountResources\EmployeeAccountCrud::class);
    Route::get('/employee-accounts/edit/{id}', \App\Livewire\Pages\Admin\Generals\EmployeeAccountResources\EmployeeAccountCrud::class)->name('employee-accounts.edit');
    Route::get('/employee-accounts/show/{id}/{readonly}', \App\Livewire\Pages\Admin\Generals\EmployeeAccountResources\EmployeeAccountCrud::class)->where('readonly', 'readonly')->name('employee-accounts.show');

    Route::get('/positions', \App\Livewire\Pages\Admin\Generals\PositionResources\PositionList::class);
    Route::get('/positions/create', \App\Livewire\Pages\Admin\Generals\PositionResources\PositionCrud::class);
    Route::get('/positions/edit/{id}', \App\Livewire\Pages\Admin\Generals\PositionResources\PositionCrud::class)->name('positions.edit');
    Route::get('/positions/show/{id}/{readonly}', \App\Livewire\Pages\Admin\Generals\PositionResources\PositionCrud::class)->where('readonly', 'readonly')->name('positions.show');

    Route::get('/pages', \App\Livewire\Pages\Admin\Generals\PageResources\PageList::class);
    Route::get('/pages/create', \App\Livewire\Pages\Admin\Generals\PageResources\PageCrud::class);
    Route::get('/pages/edit/{id}', \App\Livewire\Pages\Admin\Generals\PageResources\PageCrud::class)->name('pages.edit');
    Route::get('/pages/show/{id}/{readonly}', \App\Livewire\Pages\Admin\Generals\PageResources\PageCrud::class)->where('readonly', 'readonly')->name('pages.show');


    Route::get('/permissions', \App\Livewire\Pages\Admin\Generals\PermissionResources\PermissionList::class);
    Route::get('/permissions/edit/{id}', \App\Livewire\Pages\Admin\Generals\PermissionResources\PermissionCrud::class)->name('pages.edit');
    Route::get('/permissions/show/{id}/{readonly}', \App\Livewire\Pages\Admin\Generals\PermissionResources\PermissionCrud::class)->where('readonly', 'readonly')->name('pages.show');

    // Sales 
    Route::get('/customers', \App\Livewire\Pages\Admin\Sales\CustomerResources\CustomerList::class);
    Route::get('/customers/create', \App\Livewire\Pages\Admin\Sales\CustomerResources\CustomerCrud::class);
    Route::get('/customers/edit/{id}', \App\Livewire\Pages\Admin\Sales\CustomerResources\CustomerCrud::class)->name('customer.edit');
    Route::get('/customers/show/{id}/{readonly}', \App\Livewire\Pages\Admin\Sales\CustomerResources\CustomerCrud::class)->where('readonly', 'readonly')->name('customer.show');

    Route::get('/sales-orders', \App\Livewire\Pages\Admin\Sales\SalesOrderResources\SalesOrderList::class);
    Route::get('/sales-orders/create', \App\Livewire\Pages\Admin\Sales\SalesOrderResources\SalesOrderCrud::class);
    // Route::get('/sales-orders/update/{slug}', \App\Livewire\Pages\Admin\Sales\SalesOrderResources\SalesOrderCrud::class)->name('sales-order.edit');
    // Route::get('/sales-orders/update/{id}', \App\Livewire\Pages\Admin\Sales\SalesOrderResources\SalesOrderCrud::class)->name('sales-order.edit');
    // Route::get('/sales-orders/update/{id}/{slug}', \App\Livewire\Pages\Admin\Sales\SalesOrderResources\SalesOrderCrud::class)->name('sales-order.edit');
    Route::get('/sales-orders/update/{id}', \App\Livewire\Pages\Admin\Sales\SalesOrderResources\SalesOrderCrud::class)->name('sales-order.edit');
    
    Route::get('/sales-orders/edit/{id}', \App\Livewire\Pages\Admin\Sales\SalesOrderResources\SalesOrderCrud::class)->name('sales-order.edit');

    Route::get('/sales-orders/show/{id}/{readonly}', \App\Livewire\Pages\Admin\Sales\SalesOrderResources\SalesOrderCrud::class)->where('readonly', 'readonly')->name('sales-order.show');
    Route::get('/sales-orders/activate/{id}/{value}', \App\Livewire\Pages\Admin\Sales\SalesOrderResources\SalesOrderCrud::class)
    ->where('readonly', 'readonly')
    ->name('sales-order.show');

    Route::get('/category-recommendations', \App\Livewire\Pages\Admin\Contents\CategoryRecommendationResources\CategoryRecommendationList::class)->name('category_recommendations.list');
    Route::get('/category-recommendations/create', \App\Livewire\Pages\Admin\Contents\CategoryRecommendationResources\CategoryRecommendationCrud::class)->name('category_recommendations.create');
    Route::get('/category-recommendations/edit/{id}', \App\Livewire\Pages\Admin\Contents\CategoryRecommendationResources\CategoryRecommendationCrud::class)->name('category_recommendations.edit');
    Route::get('/category-recommendations/show/{id}/{readonly}', \App\Livewire\Pages\Admin\Contents\CategoryRecommendationResources\CategoryRecommendationCrud::class)->where('readonly', 'readonly')->name('category_recommendations.show');

    Route::get('/unauthorized', function () {
        return view('components/unauthorized-page');
    })->name('unauthorized');

});

