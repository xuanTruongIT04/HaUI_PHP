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

Route::get('/home', 'DashboardController@show')->name('home');

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

// Định tuyến controller Dashboard

Route::middleware('auth', "verified")->group(function () {

    // ========================DASHBOARD===========================
    Route::get("/admin", "DashboardController@show")->name("dashboard.show");

    Route::get("/dashboard", "DashboardController@show")->name("dashboard.show");

    // ========================ROLES===========================
    Route::get("/admin/stage/list", "AdminStageController@list")->name("admin.stage.list");

    Route::get("/admin/stage/add", "AdminStageController@add")->name("admin.stage.add");
    Route::post("/admin/stage/store", "AdminStageController@store")->name("admin.stage.store");

    Route::get("/admin/stage/edit/{id}", "AdminStageController@edit")->name("admin.stage.edit");
    Route::post("/admin/stage/update/{id}", "AdminStageController@update")->name("admin.stage.update");

    Route::get("/admin/stage/delete/{id}", "AdminStageController@delete")->name("admin.stage.delete");

    Route::get("/admin/stage/restore/{id}", "AdminStageController@restore")->name("admin.stage.restore");

    Route::get("/admin/stage/action", "AdminStageController@action")->name("admin.stage.action");

    // ========================PRODUCT===========================
    Route::get("/admin/product/list", "AdminProductController@list")->name("admin.product.list");

    Route::get("/admin/product/add", "AdminProductController@add")->name("admin.product.add");
    Route::post("/admin/product/store", "AdminProductController@store")->name("admin.product.store");

    Route::get("/admin/product/edit/{id}", "AdminProductController@edit")->name("admin.product.edit");
    Route::post("/admin/product/update/{id}", "AdminProductController@update")->name("admin.product.update");

    Route::get("/admin/product/delete/{id}", "AdminProductController@delete")->name("admin.product.delete");

    Route::get("/admin/product/restore/{id}", "AdminProductController@restore")->name("admin.product.restore");

    Route::get("/admin/product/action", "AdminProductController@action")->name("admin.product.cat.action");

    // ========================DEFECTIVE PRODUCT===========================
    Route::get("/admin/defectiveProduct/list", "AdminDefectiveProductController@list")->name("admin.defectiveProduct.list");

    Route::get("/admin/defectiveProduct/edit/{id}", "AdminDefectiveProductController@edit")->name("admin.defectiveProduct.edit");
    Route::post("/admin/defectiveProduct/update/{id}", "AdminDefectiveProductController@update")->name("admin.defectiveProduct.update");

    Route::get("/admin/defectiveProduct/delete/{id}", "AdminDefectiveProductController@delete")->name("admin.defectiveProduct.delete");

    Route::get("/admin/defectiveProduct/restore/{id}", "AdminDefectiveProductController@restore")->name("admin.defectiveProduct.restore");

    Route::get("/admin/defectiveProduct/action", "AdminDefectiveProductController@action")->name("admin.defectiveProduct.cat.action");

    // ========================PRODUCT===========================
    Route::get("/admin/material/list", "AdminMaterialController@list")->name("admin.material.list");

    Route::get("/admin/material/add", "AdminMaterialController@add")->name("admin.material.add");
    Route::post("/admin/material/store", "AdminMaterialController@store")->name("admin.material.store");

    Route::get("/admin/material/edit/{id}", "AdminMaterialController@edit")->name("admin.material.edit");
    Route::post("/admin/material/update/{id}", "AdminMaterialController@update")->name("admin.material.update");

    Route::get("/admin/material/delete/{id}", "AdminMaterialController@delete")->name("admin.material.delete");

    Route::get("/admin/material/restore/{id}", "AdminMaterialController@restore")->name("admin.material.restore");

    Route::get("/admin/material/action", "AdminMaterialController@action")->name("admin.material.cat.action");

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

    Route::get("/admin/image/action", "AdminImageController@action")->name("admin.image.action");

    // ========================PRODUCTION PLAN===========================
    Route::get("/admin/productionPlan/list", "AdminProductionPlanController@list")->name("admin.productionPlan.list");

    Route::get("/admin/productionPlan/add", "AdminProductionPlanController@add")->name("admin.productionPlan.add");
    Route::post("/admin/productionPlan/store", "AdminProductionPlanController@store")->name("admin.productionPlan.store");

    Route::get("/admin/productionPlan/edit/{id}", "AdminProductionPlanController@edit")->name("admin.productionPlan.edit");
    Route::post("/admin/productionPlan/update/{id}", "AdminProductionPlanController@update")->name("admin.productionPlan.update");

    Route::get("/admin/productionPlan/delete/{id}", "AdminProductionPlanController@delete")->name("admin.productionPlan.delete");

    Route::get("/admin/productionPlan/restore/{id}", "AdminProductionPlanController@restore")->name("admin.productionPlan.restore");

    Route::get("/admin/productionPlan/action", "AdminProductionPlanController@action")->name("admin.productionPlan.action");
    // ========================WAREHOUSES===========================

    Route::get("/admin/warehouse/list", "AdminWarehouseController@list")->name("admin.warehouse.list");

    Route::get("/admin/warehouse/add", "AdminWarehouseController@add")->name("admin.warehouse.add");
    Route::post("/admin/warehouse/store", "AdminWarehouseController@store")->name("admin.warehouse.store");

    Route::get("/admin/warehouse/edit/{id}", "AdminWarehouseController@edit")->name("admin.warehouse.edit");
    Route::post("/admin/warehouse/update/{id}", "AdminWarehouseController@update")->name("admin.warehouse.update");

    Route::get("/admin/warehouse/delete/{id}", "AdminWarehouseController@delete")->name("admin.warehouse.delete");

    Route::get("/admin/warehouse/restore/{id}", "AdminWarehouseController@restore")->name("admin.warehouse.restore");

    Route::get("/admin/warehouse/action", "AdminWarehouseController@action")->name("admin.warehouse.action");

    // Code by Nguyen Van Tho
    // ==========Work shift============
    Route::get("/admin/workShift/list", "AdminWorkShiftController@list")->name("admin.workshift.list");
    Route::get("/admin/workShift/add", "AdminWorkShiftController@add")->name("admin.workshift.add");
    Route::post("/admin/workShift/store", "AdminWorkShiftController@store")->name("admin.workshift.store");
    Route::get("/admin/workShift/edit/{id}", "AdminWorkShiftController@edit")->name("admin.workshift.edit");
    Route::post("/admin/workShift/update/{id}", "AdminWorkShiftController@update")->name("admin.workshift.update");
    Route::get("/admin/workShift/delete/{id}", "AdminWorkShiftController@delete")->name("admin.workshift.delete");

    // ============Salary==============
    Route::get("/admin/salary/list", "AdminSalaryController@list")->name("admin.salary.list");
    Route::get("/admin/salary/add", "AdminSalaryController@add")->name("admin.salary.add");
    Route::post("/admin/salary/store", "AdminSalaryController@store")->name("admin.salary.store");
    Route::get("/admin/salary/edit/{id}", "AdminSalaryController@edit")->name("admin.salary.edit");
    Route::post("/admin/salary/update/{id}", "AdminSalaryController@update")->name("admin.salary.update");
    Route::get("/admin/salary/delete/{id}", "AdminSalaryController@delete")->name("admin.salary.delete");

    // ============Workers=============
    Route::get("/admin/worker/list", "AdminWorkerController@list")->name("admin.worker.list");
    Route::get("/admin/worker/add", "AdminWorkerController@add")->name("admin.worker.add");
    Route::post("/admin/worker/store", "AdminWorkerController@store")->name("admin.worker.store");
    Route::get("/admin/worker/edit/{id}", "AdminWorkerController@edit")->name("admin.worker.edit");
    Route::post("/admin/worker/update/{id}", "AdminWorkerController@update")->name("admin.worker.update");
    Route::get("/admin/worker/delete/{id}", "AdminWorkerController@delete")->name("admin.worker.delete");

    // ===========Department===========
    Route::get("/admin/department/list", "AdminDepartmentController@list")->name("admin.department.list");
    Route::get("/admin/department/add", "AdminDepartmentController@add")->name("admin.department.add");
    Route::post("/admin/department/store", "AdminDepartmentController@store")->name("admin.department.store");
    Route::get("/admin/department/edit/{id}", "AdminDepartmentController@edit")->name("admin.department.edit");
    Route::post("/admin/department/update/{id}", "AdminDepartmentController@update")->name("admin.department.update");
    Route::get("/admin/department/delete/{id}", "AdminDepartmentController@delete")->name("admin.department.delete");

    //===========Production team=======
    Route::get("/admin/productionTeam/list", "AdminProductionTeamController@list")->name("admin.productionTeam.list");
    Route::get("/admin/productionTeam/add", "AdminProductionTeamController@add")->name("admin.productionTeam.add");
    Route::post("/admin/productionTeam/store", "AdminProductionTeamController@store")->name("admin.productionTeam.store");
    Route::get("/admin/productionTeam/edit/{id}", "AdminProductionTeamController@edit")->name("admin.productionTeam.edit");
    Route::post("/admin/productionTeam/update/{id}", "AdminProductionTeamController@update")->name("admin.productionTeam.update");
    Route::get("/admin/productionTeam/delete/{id}", "AdminProductionTeamController@delete")->name("admin.productionTeam.delete");

    // ========== Equipment production ============
    Route::get("/admin/productionEquipment/list", "AdminProductionEquipmentController@list")->name("admin.productionEquipment.list");
    Route::get("/admin/productionEquipment/add", "AdminProductionEquipmentController@add")->name("admin.productionEquipment.add");
    Route::post("/admin/productionEquipment/store", "AdminProductionEquipmentController@store")->name("admin.productionEquipment.store");
    Route::get("/admin/productionEquipment/edit/{id}", "AdminProductionEquipmentController@edit")->name("admin.productionEquipment.edit");
    Route::post("/admin/productionEquipment/update/{id}", "AdminProductionEquipmentController@update")->name("admin.productionEquipment.update");
    Route::get("/admin/productionEquipment/delete/{id}", "AdminProductionEquipmentController@delete")->name("admin.productionEquipment.delete");
});