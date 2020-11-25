<?php
use App\Project;
// use Symfony\Component\Routing\Route;

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
// ========== Customers ===========

$Customers = 'HomeController@';

Route::get('/', $Customers .'index')->name('trangchu'); 
Route::get('/formLogin', $Customers .'formLogin')->name('formLogin');
Route::get('/formRegistration', $Customers .'formRegistration')->name('formRegistration');
Route::get('/trang-chu', $Customers.'index')->name('trangchu');
Route::get('/detail-products/{products_id}/{brand_id}', $Customers.'detail_products');
Route::get('/products-list/{category_id}', $Customers.'products');
Route::get('/products-list-brand/{category_id}/{brand_id}', $Customers .'list_products_brand')->name('list_products_brand');
Route::get('/logout', $Customers.'logout')->name('customers_logout');
Route::get('/cart/{products_id}', $Customers.'cart')->name('cart');
Route::get('/list-cart', $Customers.'listCart')->name('listCart');
Route::get('/blog', $Customers. 'blog')->name('blog');




Route::post('/search', $Customers .'search')->name('search');
Route::post('/search-price', $Customers .'search_price')->name('search_price');
Route::post('/login', $Customers .'login')->name('login');
Route::post('/registration', $Customers .'registration')->name('registration');
Route::post('/save-cmt/{products_id}/{brand_id}', $Customers .'Comments')->name('comments');


//============ ADMIN ============
$prefix = "admin";
$prefixConTrollerName = 'AdminController@';
Route::prefix('admin')->group(function () use($prefixConTrollerName) {
    Route::get('/', $prefixConTrollerName .'admin_login')->name('admin_login');
    Route::get('/login', $prefixConTrollerName .'admin_login')->name('admin_login');
    Route::get('/logout', $prefixConTrollerName .'logout')->name('logout');
    Route::get('/add', $prefixConTrollerName .'add')->name('add');

    Route::post('/dashboard', $prefixConTrollerName .'index');
   
    // if (!isset(Session::has('admin_name'))) {
    // }
    // dashboard <=> Category
    $prefixDashboard = 'dashboard';
    $prefixName      = 'CategoryController@';
    Route::prefix($prefixDashboard)->group(function () use($prefixName) {
        Route::get('/', $prefixName .'all_category');
        Route::get('/add-category', $prefixName .'add_category')->name('add_category');
        Route::get('/all-category', $prefixName .'all_category')->name('dashboard');
        Route::get('/unactive/{category_id}', $prefixName .'unactive')->name('unactive');
        Route::get('/active/{category_id}', $prefixName .'active')->name('active');
        Route::get('/edit-category/{category_id}', $prefixName .'edit_category')->name('edit-category');
        Route::get('/delete-category/{category_id}', $prefixName .'delete_category')->name('delete-category');

        Route::post('/save-category', $prefixName .'save_category');
        Route::post('/update-category/{category_id}', $prefixName .'update_category');
    
    
    });

        //========= Brand ================
        $prefixNameBrand = 'dashboard';
        $BrandController = 'BrandController@';
        Route::prefix($prefixNameBrand)->group(function () use($BrandController) {
            Route::get('list-brand/{category_id}', $BrandController .'list_brand')->where(['category_id'=> '[0-9]' ])->name('list-brand');
            Route::get('edit-brand/{brand_id}', $BrandController .'edit_brand')->name('edit-brand');
            Route::get('add-brand/{category_id}', $BrandController .'add_brand')->name('add-brand');
            Route::get('delete-brand/{category_id}/{brand_id}', $BrandController .'delete_brand')->name('delete-brand');
            Route::get('/unactive-brand/{category_id}/{brand_id}', $BrandController .'unactive')->name('unactive-brand');
            Route::get('/active-brand/{category_id}/{brand_id}', $BrandController .'active')->name('active-brand');

            Route::post('/update-brand/{category_id}/{brand_id}', $BrandController .'update_brand')->name('update-brand');
            Route::post('/save-brand/{category_id}', $BrandController .'save_brand');
        });


        //=============== Products =====================
        $prefixNameProducts = 'dashboard';
        $ProductsController = 'ProductsController@';
        Route::prefix($prefixNameProducts)->group(function () use($ProductsController) {
            Route::get('list-products/{brand_id}/{category_id}', $ProductsController .'list_products')->name('list-products');
            Route::get('edit-products/{brand_id}/{products_id}/{category_id}', $ProductsController .'edit_products');
            Route::get('add-products/{brand_id}/{category_id}', $ProductsController .'add_products');
            Route::get('delete-products/{products_id}/{brand_id}/{category_id}', $ProductsController .'delete_products')->name('delete-products');

            Route::post('/update-products/{products_id}/{brand_id}/{category_id}', $ProductsController .'update_products');
            Route::post('/save-products/{brand_id}/{category_id}', $ProductsController .'save_products');
        });


    // ====================== Users =========================

    $prefixNameUser  = 'dashboard';
    $usersController = 'UsersController@';
    Route::prefix($prefixNameUser)->group(function () use($usersController) {
        Route::get('/list-users', $usersController. 'listUsers')->name('listUsers');
    });

    // ====================== Admin Cart =================
    $prefixCart = 'dashboard';
    $adminCartController = 'adminCartController@';
    Route::prefix($prefixCart)->group(function () use($adminCartController) {
        Route::get('/list-cart', $adminCartController. 'listCartMana')->name('listCartMana');
        Route::get('/detail-cart/{id_orders}', $adminCartController. 'detailCartMana')->name('detailCartMana');
        Route::get('/delete-detailCart/{id_detail}', $adminCartController. 'deleteDetailCart')->name('deleteDetailCart');
        Route::get('/delete-Orders/{id_orders}', $adminCartController. 'deleteOrders')->name('deleteOrders');
        Route::get('doanh-thu', $adminCartController. 'doanhThu')->name('doanhThu');
       



        Route::post('/search-cart', $adminCartController. 'searchCart')->name('searchCart');
        Route::post('/searchDoanhThu', $adminCartController. 'searchDoanhThu')->name('searchDoanhThu');
    });

    // ===================== Comments =======================
    $prefixComments = 'dashboard';
    $CommentsController = 'CommentsController@';
    Route::get('list-comments', $CommentsController. 'listComments')->name('listComments');
    Route::get('unComments/{id}', $CommentsController. 'unComments')->name('unComments');
    Route::get('activeComments/{id}', $CommentsController. 'activeComments')->name('activeComments');
    Route::get('deleteComments/{id}', $CommentsController. 'deleteComments')->name('deleteComments');

    Route::post('searchComments', $CommentsController. 'searchComments')->name('searchComments');    
  
});




//======================= FACEBOOK ====================

Route::get('/redirect/{social}', 'SocialAuthController@redirect');
Route::get('/callback/{social}', 'SocialAuthController@callback');


// ======================= CART ======================

$cart = 'CartController@';

Route::get('/add-cart/{products_id}', $cart .'addCart')->name('addCart');
Route::get('/list-cart', $cart .'listCart')->name('listCart');
Route::get('/delete-cart/{products_id}', $cart .'deleteCart');
Route::post('/update-cart', $cart .'updateCart')->name('updateCart');
Route::post('/payment}', $cart .'payment')->name('payment');

