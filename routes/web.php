<?php

use Illuminate\Support\Facades\Route;

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


/* artisan command */
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return 'cache clear';
});
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return 'config:cache';
});
Route::get('/view-cache', function() {
    $exitCode = Artisan::call('view:cache');
    return 'view:cache';
});
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return 'view:clear';
});
/* artisan command */


Route::get('/', 'Frontend\FrontendController@index')->name('index');
Route::get('/about', 'Frontend\AboutController@about')->name('about');
Route::get('/policy', 'Frontend\AboutController@policy')->name('policy');
Route::get('/terms/condition', 'Frontend\AboutController@terms')->name('terms.condition');
Route::get('/faq', 'Frontend\AboutController@faq')->name('faq');
Route::get('/contact', 'Frontend\AboutController@contact')->name('contact');
Route::get('/author/list', 'Frontend\AboutController@authorList')->name('author.list');
Route::get('/category/list', 'Frontend\AboutController@categoryList')->name('category.list');
Route::get('/publisher/list', 'Frontend\AboutController@publisherList')->name('publisher.list');

Route::get('/search/book', 'Frontend\FrontendController@search_book');
Route::get('/search/auhtor', 'Frontend\FrontendController@search_author');
Route::get('/search/publisher', 'Frontend\FrontendController@search_publisher');
Route::post('/search/all', 'Frontend\FrontendController@search_all')->name('search.all');



Route::get('/{product_slug}', 'Frontend\ProductController@ProductDetails')->name('product.details');

Route::get('/book/category/{category_slug}', 'Frontend\ProductController@categoryFilter')->name('book.category');
Route::post('/book/category/filter/author', 'Frontend\ProductController@categoryFilterbyauthor')->name('book.category.filter.author');

Route::get('/book/author/{author_slug}', 'Frontend\ProductController@authorFilter')->name('book.author');
Route::post('/book/author/filter/author', 'Frontend\ProductController@authorFilterbyauthor')->name('book.author.filter.author');


Route::get('/book/publisher/{publisher_slug}', 'Frontend\ProductController@publisherFilter')->name('book.publisher');
Route::post('/book/publisher/filter/publisher', 'Frontend\ProductController@publisherFilterbypublisher')->name('book.publisher.filter.publisher');

Route::post('/get/district/subdistrict','Frontend\CartController@districtRelationData')->name('get.district.subdistrict');
Route::post('/get/subdistrict/union','Frontend\CartController@districtRelationDataUnion')->name('get.subdistrict.union');

Route::get('/book/last-one-year-best-sale-products', 'Frontend\ProductController@lastOneYearBestSaleProducts')->name('book.last.one.year.best.sale.products');
Route::post('/book/last-one-year-best-sale-products/filter/author', 'Frontend\ProductController@lastOneYearBestSaleProductsFilterbyauthor')->name('book.last.one.year.best.sale.products.filter.author');

Route::get('/weekly-top-author/list', 'Frontend\AboutController@weeklyTopAuthorList')->name('weekly.top.author.list');


//coupon
Route::post('/checkout/coupon/store/service', 'Frontend\OrderController@coupon_store')->name('checkout.coupon.store');
Route::post('/checkout/coupon/destroy', 'Frontend\OrderController@coupon_destroy')->name('checkout.coupon.destroy');

Route::get('/add/cart/', 'Frontend\CartController@viewCart')->name('add.cart');
Route::get('/checkout/set/delivery/charge/{charge}', 'Frontend\CartController@delCharge');


Route::post('/add/cart/', 'Frontend\CartController@ProductAddCart')->name('add.cart.submit');
Route::post('/cart/qty/update/{id}', 'Frontend\CartController@quantityUpdate')->name('cart.qty.update');
Route::get('/cart/remove/{rowId}', 'Frontend\CartController@cartRemove')->name('cart.remove');
Route::get('/cart/clear/', 'Frontend\CartController@clearCart')->name('cart.clear');
Route::get('/add/wishlist/{id}', 'Frontend\WishlistController@wishlistAdd' )->name('add.wishlist');
Route::get('/remove/wishlist/{id}', 'Frontend\WishlistController@wishlistRemove' )->name('remove.wishlist');
Route::get('/blog/list', 'Frontend\BlogController@index')->name('blog.list');
Route::get('/blog-details/{slug}', 'Frontend\BlogController@details')->name('blog-details');

Route::get('/user/login','Frontend\FrontendController@login')->name('user.login');
Route::post('/user/login-check','Frontend\FrontendController@loginCheck')->name('user.login.check');
Route::get('/user/registration','Frontend\FrontendController@registration')->name('user.registration');
Route::post('/registration-check','Frontend\FrontendController@register')->name('user.register.check');
Route::get('/get-verification-code/{id}', 'Frontend\VerificationController@getVerificationCode')->name('get-verification-code');
Route::post('/get-verification-code-store', 'Frontend\VerificationController@verification')->name('get-verification-code.store');
Route::get('/check-verification-code', 'Frontend\VerificationController@CheckVerificationCode')->name('check-verification-code');
Route::get('refer/{code}','Frontend\FrontendController@referCode')->name('registration.refer.code');




//reset Password
Route::get('user/reset-password','Frontend\FrontendController@getPhoneNumber')->name('user.reset.password');
Route::post('user/otp-store','Frontend\FrontendController@checkPhoneNumber')->name('phone.check');
Route::post('user/change-password','Frontend\FrontendController@otpStore')->name('otp.store');
Route::post('user/new-password/update/{id}','Frontend\FrontendController@passwordUpdate')->name('reset.password.update');


Route::group(['middleware'=>['auth','user']], function (){

Route::post('/user/order/submit', 'Frontend\CartController@orderSubmit')->name('user.order.submit');

Route::get('/user/dashboard','Frontend\UsarDashboardController@dashboard')->name('user.dashboard');

//user profile
Route::get('/user/profile','Frontend\UsarDashboardController@profile')->name('profile');
Route::post('/user/update','Frontend\UsarDashboardController@updateProfile')->name('user.update');

//user password
Route::get('/user/password','Frontend\UsarDashboardController@password')->name('password');
Route::post('/user/password/reset','Frontend\UsarDashboardController@updatePass')->name('update.password');

//user order
Route::get('/user/order','Frontend\OrderController@order')->name('user.order');
Route::get('/user/order-details/{id}','Frontend\OrderController@orderDetails')->name('user.order-details');
Route::get('order-product/status-change/{id}','Frontend\OrderController@OrderProductChangeStatus')->name('order-product.status');

Route::get('/user/wishlist', 'Frontend\WishlistController@wishlist')->name('user.wishlist');
Route::post('/user/order/review', 'Frontend\OrderController@reviewStore')->name('user.order.review.store');


// SSLCOMMERZ Start
Route::get('/user/pay', 'PublicSslCommerzPaymentController@index')->name('user.pay');
Route::POST('/user/success', 'PublicSslCommerzPaymentController@success');
Route::POST('/user/fail', 'PublicSslCommerzPaymentController@fail');
Route::POST('/user/cancel', 'PublicSslCommerzPaymentController@cancel');
Route::POST('/user/ipn', 'PublicSslCommerzPaymentController@ipn');
//SSLCOMMERZ END




});



Route::group(['middleware'=>['protectedroute','user']], function (){

Route::get('/user/checkout', 'Frontend\CartController@checkout')->name('user.checkout');

});

Auth::routes();










