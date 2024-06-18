<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend;
use App\Http\Controllers\User;

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
Route::group(['namespace' => 'Frontend'], function (){

    Route::get('dang-nhap',[Frontend\AuthController::class,'login'])->name('get.login');
    Route::get('send-email-kich-hoat-tai-khoan',[Frontend\AuthController::class,'resendVerifyAccount'])->name('get.resend.verify_account');
    Route::get('kich-hoat-tai-khoan',[Frontend\AuthController::class,'verifyAccount'])->name('get.verify_account');
    Route::post('dang-nhap',[Frontend\AuthController::class,'postLogin'])->name('post.login');
    Route::get('dang-xuat',[Frontend\AuthController::class,'logout'])->name('get.logout');
    Route::get('quen-mat-khau',[Frontend\AuthController::class,'restartPassword'])->name('get.restart_password');
    Route::post('quen-mat-khau',[Frontend\AuthController::class,'checkRestartPassword']);

    Route::get('thong-bao-cap-khau-moi',[Frontend\AuthController::class,'alertNewPassword'])->name('get.alert_new_password');
    Route::get('mat-khau-moi',[Frontend\AuthController::class,'newPassword'])->name('get.new_password');
    Route::post('mat-khau-moi',[Frontend\AuthController::class,'processNewPassword']);

    Route::get('dang-ky',[Frontend\AuthController::class,'register'])->name('get.register');
    Route::get('lien-he',[Frontend\ContactController::class,'index'])->name('get.contact');
    Route::post('dang-ky',[Frontend\AuthController::class,'postRegister'])->name('post.register');

    Route::get('gioi-thieu',[Frontend\PageStaticController::class,'about'])->name('get.about');
    Route::get('chinh-sach-bao-hanh',[Frontend\PageStaticController::class,'policy'])->name('get.policy');

    Route::get('',[Frontend\HomeController::class,'index'])->name('get.home');
    Route::get('san-pham.html',[Frontend\ProductController::class,'index'])->name('get.product');
    Route::get('san-pham-si.html',[Frontend\ProductController::class,'productWholesale'])->name('get.product.wholesale');

    Route::get('c/{slug}',[Frontend\CategoryController::class,'index'])->name('get.category.item');
    Route::get('p/{id}-{slug}',[Frontend\ProductDetailController::class,'index'])->name('get.product.item');


    Route::get('bai-viet.html',[Frontend\BlogController::class,'index'])->name('get.blog');
    Route::get('bai-viet/{slug}-{id}',[Frontend\ArticleController::class,'index'])
        ->name('get.article.detail')
        ->where(['slug' => '[a-z-0-9-]+', 'id' => '[0-9]+',]);

    Route::get('tags/{slug}-{id}',[Frontend\ArticleController::class,'tagDetail'])
        ->name('get.tag.detail')
        ->where(['slug' => '[a-z-0-9-]+', 'id' => '[0-9]+',]);
    Route::get('m/{slug}-{id}',[Frontend\MenuController::class,'getListsArticle'])
        ->name('get.menu.detail')
        ->where(['slug' => '[a-z-0-9-]+', 'id' => '[0-9]+',]);

    Route::get('don-hang-cua-ban',[Frontend\OrderController::class,'index'])->name('get.order'); // gio hang
    Route::get('don-hang-cua-ban/{id}',[Frontend\OrderController::class,'detail'])->name('get.order.detail'); // chi tiết
    Route::get('order/update-status/{id}',[Frontend\OrderController::class,'updateStatus'])->name('get.order.update_status'); // chi tiết
    Route::get('vote/{transactionID}/{id}',[Frontend\VoteController::class,'create'])->name('get.vote.create'); // đánh giá
    Route::post('vote/{transactionID}/{id}',[Frontend\VoteController::class,'store']);

    Route::get('don-hang',[Frontend\ShoppingCartController::class,'index'])->name('get.shopping.list'); // gio hang
    Route::get('callback/pay-online',[Frontend\ShoppingCartController::class,'payOnline'])->name('get.callback.payment_online'); // xử lý callback tt online
    Route::get('thong-bao-thanh-toan',[Frontend\ShoppingCartController::class,'paymentSuccess'])->name('get.alert_payment'); // thông báo thành công
    Route::post('don-hang',[Frontend\ShoppingCartController::class,'postPay']);
    Route::post('dat-don-si/{productId}',[Frontend\ShoppingCartController::class,'postOrderWholesale'])->name('post.order.wholesale');
    Route::get('add/{id}',[Frontend\ShoppingCartController::class,'add'])->name('get.shopping.add'); // thêm giỏ hàng
    Route::get('delete/{id}',[Frontend\ShoppingCartController::class,'delete'])->name('get.shopping.delete'); // xoá sp trong gi hàng
    Route::get('update/{id}',[Frontend\ShoppingCartController::class,'update'])->name('ajax_get.shopping.update'); // cập nhật

    Route::group(['prefix' => 'location'], function (){
        Route::get('district',[Frontend\LocationController::class,'district'])->name('get.location.district');
        Route::get('ward',[Frontend\LocationController::class,'ward'])->name('get.location.ward');
    });

    Route::group(['prefix' => 'ghn'], function (){
        Route::get('shipping-order',[Frontend\LocationController::class,'shippingOrder'])->name('get.ghn.shipping_order');
    });
});


Route::group(['namespace' => 'User','prefix' => 'tai-khoan'], function (){
    Route::get('update-password',[User\AccountController::class,'updatePassword'])->name('get_user.profile.update_password');
    Route::post('update-password',[User\AccountController::class,'processUpdatePassword'])->name('post_user.profile.update_password');
    Route::get('',[User\AccountController::class,'account'])->name('get.account');
    Route::post('',[User\AccountController::class,'updateProfile']);
});

Route::post('image-upload', [\App\Http\Controllers\ImageUploadController::class, 'storeImage'])->name('image.upload');