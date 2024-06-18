<?php
/**
 * Created by PhpStorm .
 * User: trungphuna .
 * Date: 4/22/23 .
 * Time: 5:16 PM .
 */


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend;
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


Route::group(['namespace' => 'Backend','prefix' => 'auth'], function () {
    Route::get('login', [Backend\AuthController::class, 'login'])->name('get_admin.login');
    Route::post('login', [Backend\AuthController::class, 'postLogin']);
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::group(['namespace' => 'Backend','prefix' => 'admin','middleware' => 'check.login.admin'], function (){
    Route::get('',[Backend\HomeController::class,'index'])->name('get_admin.home')->middleware('permission:full');
    Route::get('dashboard/ajax',[Backend\HomeController::class,'loadDataDashboard'])->name('get_admin.dashboard.ajax');
    Route::get('logout',[Backend\AuthController::class,'logout'])->name('get_admin.logout');
    Route::get('setting',[Backend\SettingController::class,'index'])->name('get_admin.setting');
    Route::post('setting',[Backend\SettingController::class,'createOrUpdate']);
    Route::group(['prefix' => 'category'], function (){
        Route::get('',[Backend\CategoryController::class,'index'])->name('get_admin.category.index')->middleware('permission:full|category_index');
        Route::get('create',[Backend\CategoryController::class,'create'])->name('get_admin.category.create')->middleware('permission:full|category_create');
        Route::post('create',[Backend\CategoryController::class,'store'])->name('get_admin.category.store')->middleware('permission:full|category_create');

        Route::get('update/{id}',[Backend\CategoryController::class,'edit'])->name('get_admin.category.update')->middleware('permission:full|category_update');
        Route::post('update/{id}',[Backend\CategoryController::class,'update'])->name('get_admin.category.update');
        Route::get('delete/{id}',[Backend\CategoryController::class,'delete'])->name('get_admin.category.delete')->middleware('permission:full|category_delete');
    });
    Route::group(['prefix' => 'supplier'], function (){
        Route::get('',[Backend\SupplierController::class,'index'])->name('get_admin.supplier.index')->middleware('permission:full|supplier_index');
        Route::get('create',[Backend\SupplierController::class,'create'])->name('get_admin.supplier.create')->middleware('permission:full|supplier_create');
        Route::post('create',[Backend\SupplierController::class,'store'])->name('get_admin.supplier.store')->middleware('permission:full|supplier_create');

        Route::get('update/{id}',[Backend\SupplierController::class,'edit'])->name('get_admin.supplier.update')->middleware('permission:full|supplier_update');
        Route::post('update/{id}',[Backend\SupplierController::class,'update'])->name('get_admin.supplier.update');
        Route::get('delete/{id}',[Backend\SupplierController::class,'delete'])->name('get_admin.supplier.delete')->middleware('permission:full|supplier_delete');
    });
    Route::group(['prefix' => 'menu'], function (){
        Route::get('',[Backend\MenuController::class,'index'])->name('get_admin.menu.index')->middleware('permission:full|menu_index');
        Route::get('create',[Backend\MenuController::class,'create'])->name('get_admin.menu.create')->middleware('permission:full|menu_create');
        Route::post('create',[Backend\MenuController::class,'store'])->name('get_admin.menu.store')->middleware('permission:full|menu_create');

        Route::get('update/{id}',[Backend\MenuController::class,'edit'])->name('get_admin.menu.update')->middleware('permission:full|menu_update');
        Route::post('update/{id}',[Backend\MenuController::class,'update'])->name('get_admin.menu.update');
        Route::get('delete/{id}',[Backend\MenuController::class,'delete'])->name('get_admin.menu.delete')->middleware('permission:full|menu_delete');
    });
    Route::group(['prefix' => 'article'], function (){
        Route::get('',[Backend\ArticleController::class,'index'])->name('get_admin.article.index')->middleware('permission:full|article_index');
        Route::get('create',[Backend\ArticleController::class,'create'])->name('get_admin.article.create')->middleware('permission:full|article_create');
        Route::post('create',[Backend\ArticleController::class,'store'])->name('get_admin.article.store')->middleware('permission:full|article_create');

        Route::get('update/{id}',[Backend\ArticleController::class,'edit'])->name('get_admin.article.update')->middleware('permission:full|article_update');
        Route::post('update/{id}',[Backend\ArticleController::class,'update'])->name('get_admin.article.update');
        Route::get('delete/{id}',[Backend\ArticleController::class,'delete'])->name('get_admin.article.delete')->middleware('permission:full|article_delete');
    });
    Route::group(['prefix' => 'tag'], function (){
        Route::get('',[Backend\TagsController::class,'index'])->name('get_admin.tag.index')->middleware('permission:full|tag_index');
        Route::get('create',[Backend\TagsController::class,'create'])->name('get_admin.tag.create')->middleware('permission:full|tag_create');
        Route::post('create',[Backend\TagsController::class,'store'])->name('get_admin.tag.store')->middleware('permission:full|tag_create');

        Route::get('update/{id}',[Backend\TagsController::class,'edit'])->name('get_admin.tag.update')->middleware('permission:full|tag_update');
        Route::post('update/{id}',[Backend\TagsController::class,'update'])->name('get_admin.tag.update');
        Route::get('delete/{id}',[Backend\TagsController::class,'delete'])->name('get_admin.tag.delete')->middleware('permission:full|tag_delete');
    });
    Route::group(['prefix' => 'warehouse'], function (){
        Route::get('',[Backend\WarehouseController::class,'index'])->name('get_admin.warehouse.index')->middleware('permission:full|warehouse_index');
        Route::get('create',[Backend\WarehouseController::class,'create'])->name('get_admin.warehouse.create')->middleware('permission:full|warehouse_create');
        Route::post('create',[Backend\WarehouseController::class,'store'])->name('get_admin.warehouse.store')->middleware('permission:full|warehouse_create');

        Route::get('update/{id}',[Backend\WarehouseController::class,'edit'])->name('get_admin.warehouse.update')->middleware('permission:full|warehouse_update');
        Route::post('update/{id}',[Backend\WarehouseController::class,'update'])->name('get_admin.warehouse.update');
        Route::get('delete/{id}',[Backend\WarehouseController::class,'delete'])->name('get_admin.warehouse.delete')->middleware('permission:full|warehouse_delete');
        Route::get('view/{id}',[Backend\WarehouseController::class,'view'])->name('get_admin.warehouse.view')->middleware('permission:full|warehouse_view');
        Route::get('export',[Backend\WarehouseController::class,'export'])->name('get_admin.warehouse.export')->middleware('permission:full|warehouse_index');
    });
    Route::group(['prefix' => 'slide'], function (){
        Route::get('',[Backend\SlideController::class,'index'])->name('get_admin.slide.index')->middleware('permission:full|slide_index');
        Route::get('create',[Backend\SlideController::class,'create'])->name('get_admin.slide.create')->middleware('permission:full|slide_create');
        Route::post('create',[Backend\SlideController::class,'store'])->name('get_admin.slide.store')->middleware('permission:full|slide_create');

        Route::get('update/{id}',[Backend\SlideController::class,'edit'])->name('get_admin.slide.update')->middleware('permission:full|slide_update');
        Route::post('update/{id}',[Backend\SlideController::class,'update'])->name('get_admin.slide.update');
        Route::get('delete/{id}',[Backend\SlideController::class,'delete'])->name('get_admin.slide.delete')->middleware('permission:full|slide_delete');
    });
    Route::group(['prefix' => 'product'], function (){
        Route::get('',[Backend\ProductController::class,'index'])->name('get_admin.product.index')->middleware('permission:full|product_index');
        Route::get('export',[Backend\ProductController::class,'export'])->name('get_admin.product.export')->middleware('permission:full|product_index');
        Route::get('create',[Backend\ProductController::class,'create'])->name('get_admin.product.create')->middleware('permission:full|product_create');
        Route::post('create',[Backend\ProductController::class,'store'])->name('get_admin.product.store')->middleware('permission:full|product_create');

        Route::get('update/{id}',[Backend\ProductController::class,'edit'])->name('get_admin.product.update')->middleware('permission:full|product_update');
        Route::post('update/{id}',[Backend\ProductController::class,'update'])->name('get_admin.product.update')->middleware('permission:full|product_update');
        Route::get('delete/{id}',[Backend\ProductController::class,'delete'])->name('get_admin.product.delete')->middleware('permission:full|product_delete');
        Route::get('delete-image/{id}',[Backend\ProductController::class,'deleteImage'])->name('get_admin.product.delete_image')->middleware('permission:full|product_delete_image');
    });
    Route::group(['prefix' => 'product-option'], function (){
        Route::get('',[Backend\ProductOptionController::class,'index'])->name('get_admin.product_option.index')->middleware('permission:full|product_option_index');
        Route::get('create',[Backend\ProductOptionController::class,'create'])->name('get_admin.product_option.create')->middleware('permission:full|product_option_create');
        Route::post('create',[Backend\ProductOptionController::class,'store'])->name('get_admin.product_option.store')->middleware('permission:full|product_option_create');

        Route::get('update/{id}',[Backend\ProductOptionController::class,'edit'])->name('get_admin.product_option.update')->middleware('permission:full|product_option_update');
        Route::post('update/{id}',[Backend\ProductOptionController::class,'update'])->name('get_admin.product_option.update')->middleware('permission:full|product_option_update');
        Route::get('delete/{id}',[Backend\ProductOptionController::class,'delete'])->name('get_admin.product_option.delete')->middleware('permission:full|product_option_delete');
        Route::get('delete-image/{id}',[Backend\ProductOptionController::class,'deleteImage'])->name('get_admin.product_option.delete_image')->middleware('permission:full|product_option_delete_image');
    });
    Route::group(['prefix' => 'location'], function (){
        Route::get('district',[Backend\LocationController::class,'district'])->name('get_admin.location.district');
        Route::get('ward',[Backend\LocationController::class,'ward'])->name('get_admin.location.ward');
    });
    Route::group(['prefix' => 'user'], function (){
        Route::get('',[Backend\UserController::class,'index'])->name('get_admin.user.index')->middleware('permission:full|user_index');
        Route::get('create',[Backend\UserController::class,'create'])->name('get_admin.user.create')->middleware('permission:full|user_create');
        Route::post('create',[Backend\UserController::class,'store'])->name('get_admin.user.store')->middleware('permission:full|user_store');

        Route::get('update/{id}',[Backend\UserController::class,'edit'])->name('get_admin.user.update')->middleware('permission:full|user_update');
        Route::post('update/{id}',[Backend\UserController::class,'update'])->name('get_admin.user.update')->middleware('permission:full|user_update');
        Route::get('delete/{id}',[Backend\UserController::class,'delete'])->name('get_admin.user.delete')->middleware('permission:full|user_delete');
    });
    Route::group(['prefix' => 'order'], function (){
        Route::get('',[Backend\OrderController::class,'index'])->name('get_admin.order.index')->middleware('permission:full|order_index');
        Route::get('create',[Backend\OrderController::class,'create'])->name('get_admin.order.create')->middleware('permission:full|order_create');
        Route::post('create',[Backend\OrderController::class,'store'])->name('get_admin.order.store')->middleware('permission:full|order_create');

        Route::get('show/{id}',[Backend\OrderController::class,'show'])->name('get_admin.order.show')->middleware('permission:full|order_show');
        Route::get('update/{id}',[Backend\OrderController::class,'edit'])->name('get_admin.order.update')->middleware('permission:full|order_update');
        Route::post('update/{id}',[Backend\OrderController::class,'update'])->name('get_admin.order.update')->middleware('permission:full|order_update');
        Route::get('delete/{id}',[Backend\OrderController::class,'delete'])->name('get_admin.order.delete')->middleware('permission:full|order_delete');
    });

    Route::group(['prefix' => 'page'], function (){
        Route::get('',[Backend\PageController::class,'index'])->name('get_admin.page.index')->middleware('permission:full|page_index');
        Route::get('create',[Backend\PageController::class,'create'])->name('get_admin.page.create')->middleware('permission:full|page_create');
        Route::post('create',[Backend\PageController::class,'store'])->name('get_admin.page.store')->middleware('permission:full|page_create');

        Route::get('show/{id}',[Backend\PageController::class,'show'])->name('get_admin.page.show')->middleware('permission:full|page_show');
        Route::get('update/{id}',[Backend\PageController::class,'edit'])->name('get_admin.page.update')->middleware('permission:full|page_update');
        Route::post('update/{id}',[Backend\PageController::class,'update'])->name('get_admin.page.update')->middleware('permission:full|page_update');
        Route::get('delete/{id}',[Backend\PageController::class,'delete'])->name('get_admin.page.delete')->middleware('permission:full|page_delete');
    });

    Route::group(['prefix' => 'permission'], function (){
        Route::get('',[Backend\PermissionController::class,'index'])->name('get_admin.permission.index');
        Route::get('create',[Backend\PermissionController::class,'create'])->name('get_admin.permission.create');
        Route::post('create',[Backend\PermissionController::class,'store'])->name('get_admin.permission.store');

        Route::get('update/{id}',[Backend\PermissionController::class,'edit'])->name('get_admin.permission.update');
        Route::post('update/{id}',[Backend\PermissionController::class,'update'])->name('get_admin.permission.update');
        Route::get('delete/{id}',[Backend\PermissionController::class,'delete'])->name('get_admin.permission.delete');
    });

    Route::group(['prefix' => 'role'], function (){
        Route::get('',[Backend\RoleController::class,'index'])->name('get_admin.role.index');
        Route::get('create',[Backend\RoleController::class,'create'])->name('get_admin.role.create');
        Route::post('create',[Backend\RoleController::class,'store'])->name('get_admin.role.store');

        Route::get('update/{id}',[Backend\RoleController::class,'edit'])->name('get_admin.role.update');
        Route::post('update/{id}',[Backend\RoleController::class,'update'])->name('get_admin.role.update');
        Route::get('delete/{id}',[Backend\RoleController::class,'delete'])->name('get_admin.role.delete');
    });

    Route::group(['prefix' => 'profile'], function (){
        Route::get('',[Backend\ProfileController::class,'index'])->name('get_admin.profile.index');
        Route::post('update/{id}',[Backend\ProfileController::class,'updateProfile'])->name('post_admin.profile.update');
        Route::get('update-password',[Backend\ProfileController::class,'updatePassword'])->name('get_admin.profile.update_password');
        Route::post('update-password/{id}',[Backend\ProfileController::class,'processUpdatePassword'])->name('post_admin.profile.update_password');
    });
});

