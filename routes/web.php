<?php
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
  

Route::get('/cache-clear', function() {
   return "hello";
});

Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return "View Cleard: ".$exitCode;
});

Route::get('/route-cache', function() {
    $exitCode = Artisan::call('route:cache');
    return "Route Cached: ".$exitCode;
});

Route::get('/route-clear', function() {
    $exitCode = Artisan::call('route:clear');
    return "Route Cache Cleared: ".$exitCode;
});

Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return "Config Cached: ".$exitCode;
});

Route::get('/config-clear', function() {
    $exitCode = Artisan::call('config:clear');
    return "Config Cache Cleared: ".$exitCode;
});

 
Route::get('/', 'FrontendController@index')->name('home');
Auth::routes(); 
 

//Admin Activity after login as admin
Route::group(['prefix' => 'bdrentz-admin',  'middleware' => 'auth:admin'], function(){ 
 	
	//Admin Controll
    Route::get('/', 'AdminController@dashboard')->name('dashboard');     
    Route::resource('admin','AdminController');
     
    //Category
    Route::resource('categories', 'CategoryController');

    //Course 
    Route::post('courses/rmfimg', 'CourseController@removeFeatureImages')->name('courses.rmfimg'); 
    Route::resource('courses', 'CourseController');
     
    //Course Type
    Route::resource('course-types', 'CtypeController');

    //Location
    Route::resource('locations', 'LocationController');
   
    //Instructor
    Route::resource('quotations', 'QuotationController');
   
    //Instructor
    Route::resource('instructors', 'InstructorController');

    //Instructor
    Route::get('bookings/invoice/{id}', 'BookingController@pdfDownload')->name('bookings.invoice');
    Route::get('bookings/list', 'BookingController@list')->name('bookings.list');   
    Route::resource('bookings', 'BookingController');
 
    //Comment
    Route::resource('comments', 'CommentController');  

    //News
    Route::resource('news', 'NewsController');

    //Galleries
    Route::resource('galleries', 'GalleryController');
 
    //Widget
    Route::resource('widgets', 'WidgetController');
 
    //Roule Controll
	Route::resource('roles','RoleController');

    //Manage Users
    Route::resource('users','UserController');

    //Manage Users
    Route::resource('countries','CountryController'); 
    
    //Manage CarBrand
    Route::resource('languages','LanguageController');
 
    //Post Controll
    Route::get('posts/create/{type?}', [ 'as' => 'posts.create', 'uses' => 'PostController@create']); 
    Route::resource('posts', 'PostController', ['except' => 'create']);
    
  
    //Page Controll
    Route::post('pages/rmfimg', 'PageController@removeFeatureImages')->name('pages.rmfimg'); 
    Route::resource('pages','PageController');
    //EQUIPMENTS
    Route::resource('equipments','EquipmentsController');
    Route::post('/get_eqv_data', 'QuotationController@getEqvData')->name('get_eqv_data');


    //settings Controll
    Route::resource('settings','SettingsController');

    //Check Exist Entry
    Route::post('/check-exist', 'SettingsController@checkExist')->name('check-exist');


    /// Menu Manager 
    Route::get('menus/{id?}', 'MenuController@list')->name('admin.menu-list');
    Route::post('menu-items', 'MenuController@items')->name('admin.menu-items');
    Route::post('edit-menu-item', 'MenuController@menuItem')->name('admin.edit-menu-item');
    Route::post('store-menu-item', 'MenuController@store')->name('admin.store-menu-item'); 
    Route::post('delete-menu-item', 'MenuController@destroyItem')->name('admin.delete-menu-item');
    Route::post('save-menu-order', 'MenuController@saveMenuOrder')->name('admin.save-menu-order'); 
    //Route::resource('menus', 'MenuController');
 
    //File Manager
    Route::group(['prefix' => 'media-file', 'middleware' => ['web', 'auth']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
});


//Customer Dashboard
Route::group(['prefix'=>'dashboard', 'as'=>'customers.', 'middleware'=>'auth'], function(){ 
    Route::get('/', 'ProfileController@index')->name('dashboard');
    Route::get('/bestellungen', 'ProfileController@bestellungen')->name('bestellungen');  
    Route::get('/adressen', 'ProfileController@adressen')->name('adressen'); 


    Route::get('/konto-details', 'ProfileController@kontoDetails')->name('konto-details');
    Route::post('/konto-details/{user}', 'ProfileController@kontoUpdate')->name('konto-update');

    Route::get('/kennwort-andern', 'ProfileController@kennwortAndern')->name('kennwort-andern');
    Route::post('/update-pass', 'ProfileController@updatePass')->name('update-pass');
});
 

/*  
===========  User Functional  Route   =============*/    
//Admin Login
Route::get('/bdrentz-login/admin', 'Auth\LoginController@showAdminLoginForm')->name('admin-login');
Route::post('/bdrentz-login/admin', 'Auth\LoginController@adminLogin');

/*
//Register Admin
Route::get('/bdrentz-register/admin', 'Auth\RegisterController@showAdminRegisterForm')->name('admin-register');
Route::post('/bdrentz-register/admin', 'Auth\RegisterController@createAdmin');*/

/*
//Customer Login
Route::get('/bdrentz-login/vendor', 'Auth\LoginController@showVendorLoginForm')->name('vendor-login');
Route::post('/bdrentz-login/vendor', 'Auth\LoginController@vendorLogin');

//Register Customer
Route::get('/bdrentz-register/vendor', 'Auth\RegisterController@showVendorRegisterForm')->name('vendor-register');
Route::post('/bdrentz-register/vendor', 'Auth\RegisterController@createVendor');*/

//User Registration section
Route::get('/customers/register', 'Auth\RegisterController@showUserRegisterForm')->name('customers-register');
Route::post('/customers/register', 'Auth\RegisterController@createUsers')->name('customers-register');
 

Route::get('/login', 'Auth\LoginController@showUsersLoginForm')->name('login');  
Route::post('/login', 'Auth\LoginController@userLogin')->name('login'); 
Route::match(['get', 'post'], '/logout','Auth\LogoutController@logout')->name('logout'); 

//user verify with code
Route::get('/verify-account/{enc?}', 'Auth\RegisterController@verifyForm')->name('verify-account'); 
Route::post('/verify-account', 'Auth\RegisterController@activeAccount')->name('verify-account'); 

//Active Account
Route::get('/customers/activate-account', 'ProfileController@activeAccountForm')->name('activate-account');  

Route::post('/customers/activate-account', 'ProfileController@activeAccount')->name('activate-account'); 

//password reset 
Route::post('/customers/reset-password', 'Auth\ForgotPasswordController@sedResetLink')->name('reset-password'); 

/*  
===========  Frontend  Route   =============*/   
Route::get('/tanzkurse', 'FrontendController@tanzkurse')->name('tanzkurse');
Route::get('/tanzkurse/{slug}', 'FrontendController@singleTanzkurse')->name('single_tanzkurse');

Route::get('/courses', 'FrontendController@courses')->name('courses');
Route::get('/courses/{slug}', 'FrontendController@singleCourse')->name('single_course');

Route::post('/ajax-curse', 'FrontendController@ajaxCourse')->name('ajax_curse');

Route::get('/courses/{slug}', 'FrontendController@singleCourse')->name('single_course');

Route::post('/kasse-process', 'FrontendController@kasseProcess')->name('kasse.process');
Route::get('/kasse', 'FrontendController@kasse')->name('kasse');

//place order
Route::post('/place-order', 'FrontendController@placeOrder')->name('place-order');
Route::get('/success-order/{enc?}', 'FrontendController@successOrder')->name('success-order');

//send mail
Route::get('/sendmail', 'FrontendController@sendmail')->name('sendmail');
Route::get('/invoice-mail', 'FrontendController@invoiceMail')->name('invoice-mail');
Route::get('/pdf', 'FrontendController@pdftest')->name('pdf');

//voucher mail
Route::post('/voucher-mail', 'FrontendController@danceVoucherMail')->name('voucher-mail');
//news popup
Route::post('/newspop', 'FrontendController@newspop')->name('newspop');

//gallerypop
Route::get('/gallerypop/{id}', 'FrontendController@gallerypop')->name('gallerypop');



// pages
Route::get('/{page}', 'FrontendController@pages')->name('pages');