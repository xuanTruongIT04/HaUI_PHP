<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
  return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
  \UniSharp\LaravelFilemanager\Lfm::routes();
});

// Định tuyến controller Dashboard

Route::middleware('auth', "verified")->group(function () {

  // ========================DASHBOARD===========================
  Route::get("/admin", "DashboardController@show")->name("dashboard.show");

  Route::get("/dashboard", "DashboardController@show")->name("dashboard.show");

  // ========================PRODUCT===========================
  Route::get("/admin/product/list", "AdminProductController@list")->name("admin.product.list");

  Route::get("/admin/product/add", "AdminProductController@add")->name("admin.product.add");
  Route::post("/admin/product/store", "AdminProductController@store")->name("admin.product.store");

  Route::get("/admin/product/edit/{id}", "AdminProductController@edit")->name("admin.product.edit");
  Route::post("/admin/product/update/{id}", "AdminProductController@update")->name("admin.product.update");

  Route::get("/admin/product/delete/{id}", "AdminProductController@delete")->name("admin.product.delete");

  Route::get("/admin/product/restore/{id}", "AdminProductController@restore")->name("admin.product.restore");

  Route::get("/admin/product/action", "AdminProductController@action")->name("admin.product.cat.action");

  // ========================ORDERS===========================
  Route::get("/admin/order/list", "AdminOrderController@list")->name("admin.order.list");

  Route::get("/admin/order/edit/{id}", "AdminOrderController@edit")->name("admin.order.edit");
  Route::post("/admin/order/update/{id}", "AdminOrderController@update")->name("admin.order.update");

  Route::get("/admin/order/detail/{id}", "AdminOrderController@detail")->name("admin.order.detail");
  Route::post("/admin/order/detail/update/{id}", "AdminOrderController@detailUpdate")->name("admin.order.detail.update");

  Route::get("/admin/order/delete/{id}", "AdminOrderController@delete")->name("admin.order.delete");

  Route::get("/admin/order/restore/{id}", "AdminOrderController@restore")->name("admin.order.restore");

  Route::get("/admin/order/action", "AdminOrderController@action")->name("admin.order.action");

  // ========================CUSTOMERS===========================
  Route::get("/admin/customer/list", "AdminCustomerController@list")->name("admin.customer.list");

  Route::get("/admin/customer/edit/{id}", "AdminCustomerController@edit")->name("admin.customer.edit");
  Route::post("/admin/customer/update/{id}", "AdminCustomerController@update")->name("admin.customer.update");

  Route::get("/admin/customer/delete/{id}", "AdminCustomerController@delete")->name("admin.customer.delete");

  Route::get("/admin/customer/restore/{id}", "AdminCustomerController@restore")->name("admin.customer.restore");

  Route::get("/admin/customer/action", "AdminCustomerController@action")->name("admin.customer.action");

  // ========================USER===========================
  Route::get("/admin/user/list", "AdminUserController@list")->name("admin.user.list");

  Route::get("/admin/user/add", "AdminUserController@add")->name("admin.user.add");
  Route::post("/admin/user/store", "AdminUserController@store")->name("admin.user.store");

  Route::get("/admin/user/edit/{id}", "AdminUserController@edit")->name("admin.user.edit");
  Route::post("/admin/user/update/{id}", "AdminUserController@update")->name("admin.user.update");

  Route::get("/admin/user/delete/{id}", "AdminUserController@delete")->name("admin.user.delete");

  Route::get("/admin/user/restore/{id}", "AdminUserController@restore")->name("admin.user.restore");

  Route::get("/admin/user/action", "AdminUserController@action")->name("admin.user.action");

  // ========================ROLES===========================
  Route::get("/admin/role/list", "AdminRoleController@list")->name("admin.role.list");

  Route::get("/admin/role/add", "AdminRoleController@add")->name("admin.role.add");
  Route::post("/admin/role/store", "AdminRoleController@store")->name("admin.role.store");

  Route::get("/admin/role/edit/{id}", "AdminRoleController@edit")->name("admin.role.edit");
  Route::post("/admin/role/update/{id}", "AdminRoleController@update")->name("admin.role.update");

  Route::get("/admin/role/delete/{id}", "AdminRoleController@delete")->name("admin.role.delete");

  Route::get("/admin/role/restore/{id}", "AdminRoleController@restore")->name("admin.role.restore");

  Route::get("/admin/role/action", "AdminRoleController@action")->name("admin.role.action");

  // ========================IMAGES===========================
  Route::get("/admin/image/list", "AdminImageController@list")->name("admin.image.list");

  Route::get("/admin/image/add", "AdminImageController@add")->name("admin.image.add");
  Route::post("/admin/image/store", "AdminImageController@store")->name("admin.image.store");

  Route::get("/admin/image/addMulti/{id}", "AdminImageController@addMulti")->name("admin.image.addMulti");
  Route::post("/admin/image/storeMulti/{id}", "AdminImageController@storeMulti")->name("admin.image.storeMulti");

  Route::get("/admin/image/edit/{id}", "AdminImageController@edit")->name("admin.image.edit");
  Route::post("/admin/image/update/{id}", "AdminImageController@update")->name("admin.image.update");

  Route::get("/admin/image/delete/{id}", "AdminImageController@delete")->name("admin.image.delete");

  Route::get("/admin/image/restore/{id}", "AdminImageController@restore")->name("admin.image.restore");

  // Name là tham số truyền vào của route, mỗi 1 url có 1 name
  Route::get("/admin/image/action", "AdminImageController@action")->name("admin.image.action");


  Route::get("/admin/productionPlant/list", "AdminProductionPlantController@list");


  // Code by Nguyen Van Tho
  // ==========Work shift============
  Route::get("/admin/workShift/list", "AdminWorkShiftController@list")->name("admin.workshift.list");
  Route::get("/admin/workShift/add", "AdminWorkShiftController@add")->name("admin.workshift.add");
  Route::post("/admin/workShift/store", "AdminWorkShiftController@store")->name("admin.workshift.store");
  Route::get("/admin/workShift/edit/{id}", "AdminWorkShiftController@edit")->name("admin.workshift.edit");
  Route::post("/admin/workShift/update/{id}", "AdminWorkShiftController@update")->name("admin.workshift.update");
  Route::get("/admin/workShift/delete/{id}", "AdminWorkShiftController@delete")->name("admin.workshift.delete");

  // ============Salary==============
  // ============Workers=============
  // ===========Department===========
  //===========Production team=======
});
