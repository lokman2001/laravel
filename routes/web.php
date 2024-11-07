<?php


use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\userController;
use App\Http\Controllers\ajaxController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrderController;
use App\Http\Middleware\adminMdware;
use App\Http\Middleware\userMdware;


$namespace = 'App\Http\Controllers';


//auth

Route::redirect('/','loginPage');
Route::get('loginPage', [AuthController::class,'loginPage'])->name('auth#login');
Route::get('registerPage', [AuthController::class,'registerPage'])->name('auth#register');






Route::get('/dashboard',[AuthController::class,'authdashboard'])->name('dashboard');

Route::middleware('adminMdware')->prefix('admin')->group(function(){

    Route::get('/dashboard',[adminController::class, 'dashboard'])->name('admin#dashboard');
    //profile
    Route::get('/profile' , [adminController::class, 'profile'])->name('admin#profile');
    Route::get('/profile/edit' , [adminController::class, 'editprofile'])->name('admin#profile.edit');
    Route::post('/profile/update' , [adminController::class, 'updateprofile'])->name('admin#profile.update');
     //contact
    Route::get('/inbox' , [ContactController::class, 'inbox'])->name('admin#inbox');
    Route::get('/inbox/delete/{id}' , [ContactController::class, 'delete'])->name('admin#inbox.delete');
    //adminList
    Route::get('/back' , [adminController::class, 'back'])->name('admin#back');
    Route::get('/adminList' , [adminController::class, 'adminList'])->name('admin#admin.list');
    Route::get('/adminList/personalDetails/{id}' , [adminController::class, 'personalDetails'])->name('admin#admin.list.personalDetails');
    Route::get('/adminList/addAdmin' , [adminController::class, 'roleChange'])->name('admin#admin.addAdmin');
    Route::get('/adminList/addAdmin/change/{id}' , [adminController::class, 'change'])->name('admin#admin.addAdmin.change');
    Route::get('/adminList/remove/{id}' , [adminController::class, 'remove'])->name('admin#admin.addAdmin.remove');

    //change pwd
    Route::get('changePassword', [AuthController::class,'adminchangePasswordView'])->name('admin#password.changePage');
    Route::post('changePassword', [AuthController::class,'adminchangePassword'])->name('admin#password.change');

    //category
    Route::get('/category/list',[CategoryController::class, 'list'])->name('admin#category.list');
    Route::get('/category/createPage',[CategoryController::class, 'createPage'])->name('admin#category.list.createPage');
    Route::post('/category/createPage/create',[CategoryController::class, 'addIntoList'])->name('admin#category.list.create');
    Route::get('/category/list/delete/{id}',[CategoryController::class ,'deleteCategory'])->name('admin#category.list.delete');
    Route::get('/category/list/editPage/{id}',[CategoryController::class ,'editCategoryPage'])->name('admin#category.list.editPage');
    Route::post('/category/list/editPage/update',[CategoryController::class ,'updateCategory'])->name('admin#category.list.update');

    //product
    Route::get('/product/list',[ProductController::class, 'list'])->name('admin#product.list');
    Route::get('/product/list/detail/{id}',[ProductController::class, 'detailPage'])->name('admin#product.list.detail');
    Route::get('/product/list/editPage/{id}',[ProductController::class, 'editPage'])->name('admin#product.list.editPage');
    Route::post('/product/list/editPage/update',[ProductController::class, 'update'])->name('admin#product.list.editPage.update');
    Route::get('/product/list/createPage',[ProductController::class, 'createPage'])->name('admin#product.list.createPage');
    Route::post('/product/list/createPage',[ProductController::class, 'create'])->name('admin#product.list.create');
    Route::get('/product/list/delete/{id}',[ProductController::class, 'delete'])->name('admin#product.list.delete');

    //order
    Route::get('/order/list/{status}',[OrderController::class, 'adminlist'])->name('admin#order.list');
    Route::get('/order/list/detail/{id}',[OrderController::class, 'adminListDetail'])->name('admin#order.list.detail');


});

Route::middleware('userMdware')->prefix('user')->group(function(){
    //home
    Route::get('/dashboard',[userController::class, 'dashboard'])->name('user#dashboard');
    Route::get('/dashboard/pizzaDetail/{id}',[userController::class, 'pizzaDetail'])->name('user#pizza.detail');
    //cart list
    Route::get('/dashboard/cartList',[CartController::class, 'list'])->name('user#cartList');
    Route::post('/dashboard/addtoCart',[CartController::class, 'addtoCart'])->name('user#addtocart');
    //order list
    Route::get('/dashboard/orderList',[OrderController::class , 'userlist'])->name('user#orderList');
    Route::get('/dashboard/orderList/detail/{id}',[OrderController::class , 'userlistDetail'])->name('user#order.detail');
    //contact
    Route::get('/contact',[ContactController::class, 'page'])->name('user#contact');
    //profile
    Route::get('/profile',[userController::class, 'profile'])->name('user#profile');
    Route::get('/profile/edit' , [userController::class, 'editprofile'])->name('user#profile.edit');
    Route::post('/profile/update' , [userController::class, 'updateprofile'])->name('user#profile.update');
    //change pwd
    Route::get('changePassword', [AuthController::class,'userchangePasswordView'])->name('user#password.changePage');
    Route::post('changePassword', [AuthController::class,'userchangePassword'])->name('user#password.change');

});

Route::group(['prefix' => 'ajax'],function(){

    Route::get('/getProductData',[ajaxController::class,'pizzaData'])->name('ajax#pizzaData');
    Route::get('/getProductDataByCategory',[ajaxController::class,'pizzaDataFilterByCategory']);
    Route::get('/orderlist',[ajaxController::class,'orderlist']);
    Route::get('/cartlist/clear',[ajaxController::class,'clearCartList']);
    Route::get('/order/status/change',[ajaxController::class,'statusChange']);
    Route::get('/badgeData',[ajaxController::class,'badgeData']);
    Route::get('/ratingStar',[ajaxController::class,'rating']);
    Route::get('/Suggestion',[ajaxController::class,'Suggestion']);

});

