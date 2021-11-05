<?php

use App\Http\Controllers\ExportController;
use App\Http\Controllers\PromoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DueController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MetaController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SLiderController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HotDealsController;
use App\Http\Controllers\PurchaseController;

use App\Http\Controllers\ShippingController;
use App\Http\Controllers\PromotionController;

use App\Http\Controllers\VariationController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\TransactionController;

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');

    //Profile
    Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
        Route::get('admin-profile-edit/{id}', [UserController::class, 'adminProfileEdit'])->name('edit');
        Route::post('admin-profile-update/{id}', [UserController::class, 'adminProfileUpdate'])->name('update');
    });

    //Brand
    Route::group(['prefix' => 'brand', 'as' => 'brand.'], function () {
        Route::get('/show', [BrandController::class, 'show'])->name('show');
        Route::get('/list', [BrandController::class, 'list'])->name('list');
        Route::get('create', [BrandController::class, 'create'])->name('create');
        Route::post('store', [BrandController::class, 'store'])->name('store');
        Route::get('edit/{id}', [BrandController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [BrandController::class, 'update'])->name('update');
        Route::post('delete', [BrandController::class, 'delete'])->name('delete');
        Route::post('delete', [ProductController::class, 'delete'])->name('delete');

    });
    Route::get('export', [ExportController::class, 'export'])->name('export');
    Route::post('import', [ExportController::class, 'import'])->name('import');

    //Category
    Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
        Route::get('/show', [CategoryController::class, 'show'])->name('show');
        Route::get('/list', [CategoryController::class, 'list'])->name('list');
        Route::get('create', [CategoryController::class, 'create'])->name('create');
        Route::post('check/subCategory', [CategoryController::class, 'checkSubCategory'])->name('check.subCategory');
        Route::post('store', [CategoryController::class, 'store'])->name('store');
        Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [CategoryController::class, 'update'])->name('update');
        Route::post('delete', [CategoryController::class, 'delete'])->name('delete');
    });

    //Unit
    Route::group(['prefix' => 'unit', 'as' => 'unit.'], function () {
        Route::get('/show', [UnitController::class, 'show'])->name('show');
        Route::get('/list', [UnitController::class, 'list'])->name('list');
        Route::get('create', [UnitController::class, 'create'])->name('create');
        Route::post('store', [UnitController::class, 'store'])->name('store');
        Route::get('edit/{id}', [UnitController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [UnitController::class, 'update'])->name('update');
        Route::post('delete', [UnitController::class, 'delete'])->name('delete');
    });




            //    ----------------------------Hotdeals-----------------------------
            Route::get('/hotdeals', [HotDealsController::class, 'index'])->name('hotdeals');

        // Route::get('/hotdeals',[HotDealsController::class, 'index'])->name('hotdeals');
        Route::get('/hotdeals-add',[HotDealsController::class,'add'])->name('hotdeals.add');
        Route::get('/hotdeals-list', [HotDealsController::class, 'list'])->name('hotdeals.list');
        Route::post('/hotdeals-insert', [HotDealsController::class, 'save_deals'])->name('deal.insert');
        Route::post('/dealsShow',[HotDealsController::class,'showDeals'])->name('hotdeals.show');
        Route::get('/dealsEdit/{id}',[HotDealsController::class,'edit'])->name('hotdeals.edit');
        Route::post('/dealsUpdate/{id}',[HotDealsController::class,'update'])->name('hotdeals.update');
        Route::post('/dealsDelete',[HotDealsController::class,'delete'])->name('hotdeals.delete');
        Route::get('/hotdeals/show-deal-product/{id}', [HotDealsController::class,'showDealProduct'])->name('hotdeals.showProduct');
        Route::get('/hotdeals/hot-products/{id}', [HotDealsController::class,'hotProduct'])->name('hotdeals.hotProduct');
        Route::get('/hotdeals/add-product/{id?}', [HotDealsController::class,'addProduct'])->name('hotdeals.addProduct');
        Route::post('hotdeals/add-product',[HotDealsController::class,'productInsert'])->name('hotdeals.productInsert');

        //Promotions
        Route::get('/promotion',[PromotionController::class, 'index'])->name('promotion');
        Route::get('/promotion-list', [PromotionController::class,'list'])->name('promotion.list');
        Route::get('/promotion-create', [PromotionController::class, 'create'])->name('promotion.create');
        Route::post('/promotion-insert', [PromotionController::class, 'store'])->name('promotion.insert');
        Route::post('/promotion-update', [PromotionController::class, 'store'])->name('promotion.update');
        Route::get('/promotion/edit/{id}', [PromotionController::class, 'edit'])->name('promotion.edit');
        Route::get('/promotion/product/{id}', [PromotionController::class,'promoProduct'])->name('promotion.promoProduct');
        Route::post('/promotion-productInsert', [PromotionController::class,'promoProductInsert'])->name('promotion.productInsert');
        Route::get('/promotion/show-product/{id}', [PromotionController::class,'showProduct'])->name('promotion.showProduct');

        //Promo
        Route::get('/promo',[PromoController::class, 'index'])->name('promo');
        Route::get('/promo-list', [PromoController::class,'list'])->name('promo.list');
        Route::get('/promo-create', [PromoController::class, 'create'])->name('promo.create');
        Route::post('/promo-insert', [PromoController::class, 'store'])->name('promo.insert');
        Route::post('/promo-update', [PromoController::class, 'store'])->name('promo.update');
        Route::get('/promo/edit/{id}', [PromoController::class, 'edit'])->name('promo.edit');


        //Meta data
        // Route::get('/meta',[PromotionController::class, 'show'])->name('meta');
        // Route::get('/meta-list', [PromotionController::class,'list'])->name('meta.list');
        // Route::get('/promotion-create', [PromotionController::class, 'create'])->name('promotion.create');
        // Route::post('/promotion-insert', [PromotionController::class, 'store'])->name('promotion.insert');
        // Route::post('/promotion-update', [PromotionController::class, 'store'])->name('promotion.update');
        // Route::get('/promotion/edit/{id}', [PromotionController::class, 'edit'])->name('promotion.edit');
        // Route::get('/promotion/product/{id}', [PromotionController::class,'promoProduct'])->name('promotion.promoProduct');
        // Route::post('/promotion-productInsert', [PromotionController::class,'promoProductInsert'])->name('promotion.productInsert');
        // Route::get('/promotion/show-product/{id}', [PromotionController::class,'showProduct'])->name('promotion.showProduct');


         //Unit
    Route::group(['prefix' => 'meta', 'as' => 'meta.'], function () {
        Route::get('/show', [MetaController::class, 'show'])->name('show');
        Route::get('/list', [MetaController::class, 'list'])->name('list');
        Route::get('create', [MetaController::class, 'create'])->name('create');
        Route::post('store', [MetaController::class, 'store'])->name('store');
        Route::get('edit/{id}', [MetaController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [MetaController::class, 'update'])->name('update');
        Route::post('delete', [MetaController::class, 'delete'])->name('delete');
    });

    //Testimonial
    Route::group(['prefix' => 'testimonial', 'as' => 'testimonial.'], function () {
        Route::get('/show', [TestimonialController::class, 'show'])->name('show');
        Route::get('/list', [TestimonialController::class, 'list'])->name('list');
        Route::get('create', [TestimonialController::class, 'create'])->name('create');
        Route::post('store', [TestimonialController::class, 'store'])->name('store');
        Route::get('edit/{id}', [TestimonialController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [TestimonialController::class, 'update'])->name('update');
        Route::post('delete', [TestimonialController::class, 'delete'])->name('delete');
    });



          //Banner
    Route::group(['prefix' => 'banner', 'as' => 'banner.'], function () {
        Route::get('/show', [BannerController::class, 'index'])->name('show');
        Route::post('/list', [BannerController::class, 'showBanner'])->name('list');
        Route::get('create', [BannerController::class, 'create'])->name('create');
        // Route::post('check/subCategory', [BannerController::class, 'checkSubCategory'])->name('check.subCategory');
        Route::post('store', [BannerController::class, 'store'])->name('store');
        Route::get('edit/{id}', [BannerController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [BannerController::class, 'update'])->name('update');
        Route::post('delete', [BannerController::class, 'delete'])->name('delete');
    });



        // //            ------------------------------Banner-------------------------------------
        // Route::get('/banner','BannerController@index')->name('banner');
        // //Route::get('/addBanner','BannerController@add')->name('banner.add');
        // Route::post('/showBanner','BannerController@showBanner')->name('banner.show');
        // //Route::post('/bannerInsert','BannerController@insert')->name('banner.insert');
        // Route::get('/banner/edit/{id}','BannerController@edit')->name('banner.edit');
        // Route::post('/banner/update','BannerController@update')->name('banner.update');
        // Route::post('/banner-delete', 'BannerController@delete')->name('banner.delete');

        //     ------------------------------Banner End-------------------------------------





    //Variation
    Route::group(['prefix' => 'variation', 'as' => 'variation.'], function () {
        Route::get('/show', [VariationController::class, 'index'])->name('show');
        Route::post('/variation-submit', [VariationController::class, 'variationSubmit'])->name('submit');
        Route::post('/get-variation-value', [VariationController::class, 'variationValue'])->name('value');
        Route::post('/edit-variation-data', [VariationController::class, 'editVariationData'])->name('edit');
        Route::get('/add-variation', [VariationController::class, 'addVariation'])->name('add');
    });

    //Product
    Route::group(['prefix' => 'product', 'as' => 'product.'], function () {
        Route::get('/show', [ProductController::class, 'show'])->name('show');
        Route::get('/list', [ProductController::class, 'list'])->name('list');
        Route::get('create', [ProductController::class, 'create'])->name('create');
        Route::post('store', [ProductController::class, 'store'])->name('store');
        Route::get('edit/{id}', [ProductController::class, 'edit'])->name('edit');
        // Route::get('detail/{id}', [ProductController::class, 'detail'])->name('detail');
        Route::post('update/{id}', [ProductController::class, 'update'])->name('update');
        Route::post('delete', [ProductController::class, 'delete'])->name('delete');
        Route::post('productImage/delete', [ProductController::class, 'productImageDelete'])->name('productImage.delete');
        Route::post('search', [ProductController::class, 'productSearch'])->name('search');

        //Product Variation
        Route::post('variation/addNew', [ProductController::class, 'variationAddNew'])->name('variation.addNew');
        Route::post('variation/type/change', [ProductController::class, 'variationTypeChange'])->name('variationTypeChange');
        Route::post('variation/type/change2', [ProductController::class, 'variationTypeChange2'])->name('variationTypeChange2');
        Route::post('variation/store', [ProductController::class, 'variationStore'])->name('variation.store');
        Route::post('variation/ajax/show', [ProductController::class, 'variationAjax'])->name('variation.ajax.show');
        Route::post('variation/ajax/edit', [ProductController::class, 'variationAjaxEdit'])->name('variation.ajax.edit');
        Route::post('variation/update', [ProductController::class, 'variationUpdate'])->name('variation.update');
        Route::get('variation/image/delete/{id}', [ProductController::class, 'variationImageDelete'])->name('variation.image.delete');
        Route::post('variation/status', [ProductController::class, 'variationStatusChange'])->name('variation.status');

        //Product Category
        Route::post('find/subCategory', [ProductController::class, 'findSubCategory'])->name('find.subCategory');
    });

    //Purchase
    Route::group(['prefix' => 'purchase', 'as' => 'purchase.'], function () {
        Route::get('/show', [PurchaseController::class, 'index'])->name('show');
        Route::get('/add', [PurchaseController::class, 'add'])->name('add');
        Route::post('list', [PurchaseController::class, 'list'])->name('list');
        Route::post('edit', [PurchaseController::class, 'edit'])->name('edit.modal');
        Route::post('edit-stock', [PurchaseController::class, 'editStock'])->name('edit.stock.modal');
        Route::post('store', [PurchaseController::class, 'store'])->name('store');
        Route::post('edit-stock-update', [PurchaseController::class, 'editStockUpdate'])->name('editStockUpdate');
        Route::post('batch', [PurchaseController::class, 'skuWithBatch'])->name('batch');
        Route::post('batch-delete', [PurchaseController::class, 'batchDelete'])->name('delete');
        Route::post('batch-edit', [PurchaseController::class, 'editBatch'])->name('editBatch');
    });

    // Order
    Route::group(['prefix' => 'order', 'as' => 'order.'], function () {
        Route::get('/add', [OrderController::class, 'add'])->name('add');
        Route::post('list', [OrderController::class, 'list'])->name('list');
        Route::post('batch', [OrderController::class, 'addToOrder'])->name('batch');
        Route::post('/remove-item', [OrderController::class, 'removeItem'])->name('remove.item');
        Route::post('/edit-item', [OrderController::class, 'editItem'])->name('edit.item');
        Route::post('/upadate-quantity', [OrderController::class, 'updateQuantity'])->name('update.quantity');
        Route::post('/discount', [OrderController::class, 'discount'])->name('discount');
        Route::post('/order-submit', [OrderController::class, 'orderInsert'])->name('insert');
        Route::get('/show', [OrderController::class, 'index'])->name('index');
        Route::post('/order-list', [OrderController::class, 'list'])->name('list');
        Route::get('/order-details/{id}', [OrderController::class, 'details'])->name('details');
        Route::post('/order-status', [OrderController::class, 'orderStatus'])->name('orderStatus');
        // Route::get('/order-edit/{id}', [OrderController::class, 'orderEdit'])->name('orderEdit');
        // Route::post('/order-update', [OrderController::class, 'orderUpdate'])->name('orderUpdate');

        Route::post('/add-product', [OrderController::class, 'showAddProductModal'])->name('showAddProductModal');
        Route::post('/get-product-info', [OrderController::class, 'getProductInfo'])->name('getProductInfo');
        Route::post('variation/color/choose',[OrderController::class,'colorSizeChoose'])->name('colorSizeChoose');
        Route::post('/insert-order-item', [OrderController::class, 'insertItem'])->name('insertItem');

        Route::post('/edit-ordered-product-quantity', [OrderController::class, 'editOrderItemQuantity'])->name('editOrderItemQuantity');
        Route::post('/update-order-item-quantity', [OrderController::class, 'updateItemQuantity'])->name('updateItemQuantity');
        Route::post('delete-order-item', [OrderController::class, 'deleteOrderItem'])->name('deleteItem');

        Route::post('/order-status-change', [OrderController::class, 'orderStatusChange'])->name('statusChangeSubmit');
        Route::post('/order-return-modal', [OrderController::class, 'returnModal'])->name('returnModal');
        Route::post('/order-return', [OrderController::class, 'singleReturn'])->name('singleReturn');
        Route::get('/order-invoice/{orderId}', [OrderController::class, 'invoiceDownload'])->name('download');
    });

    //Order due
    Route::group(['prefix' => 'due', 'as' => 'due.'], function () {
        Route::get('/due', [DueController::class, 'index'])->name('index');
        Route::get('/list', [DueController::class, 'DueList'])->name('list');
    });

    //User
    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
        Route::post('customer/search', [UserController::class, 'customerSearch'])->name('customer.search');
        Route::post('customer-data', [UserController::class, 'customerData'])->name('customer.data');
        Route::post('customer-store', [UserController::class, 'customerStore'])->name('customer.store');
        Route::get('user', [UserController::class, 'index'])->name('index');
        Route::get('create-user', [UserController::class, 'create'])->name('create');
        Route::post('store-user', [UserController::class, 'store'])->name('store');
        Route::post('user-list', [UserController::class, 'userList'])->name('list');
        Route::post('role-change', [UserController::class, 'changeRole'])->name('roleChange');
        Route::post('password-change', [UserController::class, 'changeUserPassword'])->name('passwordChange');
        Route::get('customer', [UserController::class, 'customer'])->name('customer');
        Route::post('customer-list', [UserController::class, 'customerList'])->name('customer.list');
        Route::post('membership-status', [UserController::class, 'membershipStatus'])->name('customer.membershipStatus');
    });

    //Variation
    Route::group(['prefix' => 'role', 'as' => 'role.'], function () {
        Route::get('/show', [RoleController::class, 'index'])->name('show');
        Route::get('permission-details/{id}', [RoleController::class, 'permissonDetails'])->name('permisson.details');
        Route::post('/role-permission-submit', [RoleController::class, 'permissionSubmit'])->name('permisson.submit');
        Route::get('/add', [RoleController::class, 'roleAdd'])->name('add');
        Route::post('/insertadd', [RoleController::class, 'roleInsert'])->name('save');

        // Route::post('/get-variation-value',[VariationController::class,'variationValue'])->name('value');
        // Route::post('/edit-variation-data',[VariationController::class,'editVariationData'])->name('edit');
        // Route::get('/add-variation',[VariationController::class,'addVariation'])->name('add');
    });

    //Report
    Route::group(['prefix' => 'report', 'as' => 'report.'], function () {
        Route::get('/sale', [ReportController::class, 'sale'])->name('sale');
        Route::post('/saleReport', [ReportController::class, 'saleReport'])->name('saleReport');

        Route::get('/stock', [ReportController::class, 'stock'])->name('stock');
        Route::post('/stockReport', [ReportController::class, 'stockReport'])->name('stockReport');

        Route::get('/product', [ReportController::class, 'product'])->name('product');
        Route::post('/productReport', [ReportController::class, 'productReport'])->name('productReport');
        Route::get('/productDetail/{id}', [ReportController::class, 'productDetail'])->name('product.detail');
        Route::post('/productReportDetail', [ReportController::class, 'productReportDetail'])->name('productReportDetail');

        Route::get('/customer', [ReportController::class, 'customer'])->name('customer');
        Route::post('/customerReport', [ReportController::class, 'customerReport'])->name('customerReport');
        Route::get('/customerDetail/{id}', [ReportController::class, 'customerDetail'])->name('customer.detail');
        Route::post('/customerReportDetail', [ReportController::class, 'customerReportDetail'])->name('customerReportDetail');


        Route::get('/category', [ReportController::class, 'category'])->name('category');
        Route::post('/categoryReport', [ReportController::class, 'categoryReport'])->name('categoryReport');

        Route::get('/store', [ReportController::class, 'store'])->name('store');
        Route::post('/storeReport', [ReportController::class, 'storeReport'])->name('storeReport');

        Route::get('/vendor', [ReportController::class, 'vendor'])->name('vendor');
        Route::post('/vendorReport', [ReportController::class, 'vendorReport'])->name('vendorReport');
        Route::get('/vendorDetail/{id}', [ReportController::class, 'vendorDetail'])->name('vendor.detail');
        Route::post('/vendorReportDetail', [ReportController::class, 'vendorReportDetail'])->name('vendorReportDetail');

        Route::get('/transaction', [ReportController::class, 'transaction'])->name('transaction');
        Route::post('/transactionReport', [ReportController::class, 'transactionReport'])->name('transactionReport');

        Route::get('/collection', [ReportController::class, 'collection'])->name('collection');
        Route::post('/collectionReport', [ReportController::class, 'collectionReport'])->name('collectionReport');

    });

    //Transaction
    Route::group(['prefix' => 'transaction', 'as' => 'transaction.'], function () {
        Route::post('payment', [TransactionController::class, 'addPayment'])->name('payment');
        Route::post('customer-data', [TransactionController::class, 'savePayment'])->name('save.payment');
        // Route::post('add-transaction', [TransactionController::class, 'orderTransaction'])->name('store');
        // Route::post('customer-store', [TransactionController::class,'customerStore'])->name('customer.store');
    });

    //Settings
    Route::group(['prefix' => 'setting', 'as' => 'setting.'], function () {
        Route::get('setting', [SettingController::class, 'index'])->name('index');
        Route::get('setting/{id}', [SettingController::class, 'edit'])->name('edit');
        Route::get('update-status', [SettingController::class, 'changeStatus'])->name('changeStatus');
        Route::patch('update-setting', [SettingController::class, 'update'])->name('update');
    });

    //Settings
    Route::group(['prefix' => 'membership', 'as' => 'membership.'], function () {
        Route::get('/membership', [MembershipController::class, 'membership'])->name('membership');
        Route::post('/membershipList', [MembershipController::class, 'membershipList'])->name('list');
        Route::get('/membershipDetail/{id}', [MembershipController::class, 'membershipDetail'])->name('detail');
        Route::post('/membershipDetail/show', [MembershipController::class, 'membershipDetailShow'])->name('detail.show');
    });


    //store
    Route::group(['as' => 'store.'], function () {
        Route::get('store', [StoreController::class, 'index'])->name('index');
        Route::post('store-list',[StoreController::class,'StoreList'])->name('list');
        Route::post('store-store',[StoreController::class,'store'])->name('store');
        Route::get('store-add',[StoreController::class,'create'])->name('add');
        Route::get('store-edit/{id}',[StoreController::class,'edit'])->name('edit');
    });

    //vendor
    Route::group(['prefix'=>'ven','as' => 'vendor.'], function () {
        Route::get('vendor', [VendorController::class, 'index'])->name('index');
        Route::post('vendor-list',[VendorController::class,'vendorLsit'])->name('list');
        Route::post('vendor-store',[VendorController::class,'vendorStore'])->name('store');
        Route::get('vendor-add',[VendorController::class,'createVendor'])->name('add');
        Route::get('vendor-edit/{id}',[VendorController::class,'vendorEdit'])->name('edit');
        Route::post('vendor-delete',[VendorController::class,'vendorDelete'])->name('delete');

    });

    //Slider
     Route::group(['prefix'=>'slider','as' => 'slider.'], function () {
        Route::get('slider', [SLiderController::class, 'index'])->name('index');
        Route::post('slider-list',[SLiderController::class,'List'])->name('list');
        Route::get('slider-add', [SLiderController::class,'add'])->name('add');
        Route::post('slider-add',[SLiderController::class,'store'])->name('store');
        Route::get('slider-edit/{id}', [SLiderController::class,'edit'])->name('edit');
        Route::post('delete', [SLiderController::class, 'delete'])->name('delete');
    });

    //page
    Route::group(['prefix'=>'page','as' => 'page.'], function () {
        Route::get('page', [PageController::class, 'index'])->name('index');
        Route::post('page-list',[PageController::class,'pageList'])->name('list');
        Route::get('page-add', [PageController::class,'add'])->name('add');
        Route::post('page-add',[PageController::class,'store'])->name('store');
        Route::get('page-edit/{id}', [PageController::class,'edit'])->name('edit');
        Route::post('page-update/{id}', [PageController::class, 'update'])->name('update');
    });

     //Menu
     Route::group(['prefix'=>'menu','as' => 'menu.'], function () {
        Route::get('menu', [MenuController::class, 'index'])->name('index');
        Route::post('menu-list',[MenuController::class,'list'])->name('list');
        Route::get('menu-add', [MenuController::class,'add'])->name('add');
        Route::post('menu-add',[MenuController::class,'store'])->name('store');
        // Route::get('slider-edit/{id}', [SLiderController::class,'edit'])->name('edit');
        Route::get('edit/{id}', [MenuController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [MenuController::class, 'update'])->name('update');
        Route::post('delete', [MenuController::class, 'delete'])->name('delete');
    });

     //Menu
     Route::group(['prefix'=>'shipping','as' => 'shipping.'], function () {
        Route::get('shipping', [ShippingController::class, 'index'])->name('index');
        Route::get('shipping-edit/{id}', [ShippingController::class, 'edit'])->name('edit');
        Route::post('shipping-list',[ShippingController::class,'list'])->name('list');
        Route::get('shipping-add', [ShippingController::class,'create'])->name('add');
        Route::post('shipping-add',[ShippingController::class,'store'])->name('store');
        Route::post('/shipping-change-status',[ShippingController::class,'shippingChangeStatus'])->name('change.status');
    });
});

Auth::routes();

//Route::get('/dash', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
