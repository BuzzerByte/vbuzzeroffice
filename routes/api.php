<?php

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Laravue\Faker;
use \App\Laravue\JsonResponse;
use \App\Laravue\Acl;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::namespace('Api')->group(function() {
    Route::post('auth/login', 'AuthController@login');
    Route::group(['middleware' => 'auth:sanctum'], function () {
        // Auth routes
        Route::get('auth/user', 'AuthController@user');
        Route::post('auth/logout', 'AuthController@logout');

        Route::get('/user', function (Request $request) {
            return new UserResource($request->user());
        });

        // Api resource routes
        Route::apiResource('roles', 'RoleController')->middleware('permission:' . Acl::PERMISSION_PERMISSION_MANAGE);
        Route::apiResource('users', 'UserController')->middleware('permission:' . Acl::PERMISSION_USER_MANAGE);
        Route::apiResource('permissions', 'PermissionController')->middleware('permission:' . Acl::PERMISSION_PERMISSION_MANAGE);

        // Custom routes
        Route::put('users/{user}', 'UserController@update');
        Route::get('users/{user}/permissions', 'UserController@permissions')->middleware('permission:' . Acl::PERMISSION_PERMISSION_MANAGE);
        Route::put('users/{user}/permissions', 'UserController@updatePermissions')->middleware('permission:' .Acl::PERMISSION_PERMISSION_MANAGE);
        Route::get('roles/{role}/permissions', 'RoleController@permissions')->middleware('permission:' . Acl::PERMISSION_PERMISSION_MANAGE);
        
        Route::apiResource('clients','ClientController')->middleware('permission:'.\App\Laravue\Acl::PERMISSION_PERMISSION_MANAGE);
        Route::get('clients/{clients}/permissions', 'ClientController@permissions')->middleware('permission:' . \App\Laravue\Acl::PERMISSION_PERMISSION_MANAGE);
        Route::apiResource('vendors','VendorController')->middleware('permission:'.\App\Laravue\Acl::PERMISSION_PERMISSION_MANAGE);
        Route::apiResource('applications','ApplicationController')->middleware('permission:'.\App\Laravue\Acl::PERMISSION_PERMISSION_MANAGE);
        Route::apiResource('attendances','AttendanceController')->middleware('permission:'.\App\Laravue\Acl::PERMISSION_PERMISSION_MANAGE);
        Route::apiResource('awards','AwardController')->middleware('permission:'.\App\Laravue\Acl::PERMISSION_PERMISSION_MANAGE);
        Route::apiResource('cateogories','CategoryController')->middleware('permission:'.\App\Laravue\Acl::PERMISSION_PERMISSION_MANAGE);
        Route::apiResource('commencements','CommencementController')->middleware('permission:'.\App\Laravue\Acl::PERMISSION_PERMISSION_MANAGE);
        Route::apiResource('contactdetails','ContactDetailController')->middleware('permission:'.\App\Laravue\Acl::PERMISSION_PERMISSION_MANAGE);
        Route::apiResource('departments','DepartmentController')->middleware('permission:'.\App\Laravue\Acl::PERMISSION_PERMISSION_MANAGE);
        Route::apiResource('dependents','DependentController')->middleware('permission:'.\App\Laravue\Acl::PERMISSION_PERMISSION_MANAGE);
        Route::apiResource('deposits','DepositController')->middleware('permission:'.\App\Laravue\Acl::PERMISSION_PERMISSION_MANAGE);
        Route::apiResource('emergencycontacts','EmergencyContactController')->middleware('permission:'.\App\Laravue\Acl::PERMISSION_PERMISSION_MANAGE);
        Route::apiResource('holidays','HolidayController')->middleware('permission:'.\App\Laravue\Acl::PERMISSION_PERMISSION_MANAGE);
        Route::apiResource('inventories','InventoryController')->middleware('permission:'.\App\Laravue\Acl::PERMISSION_PERMISSION_MANAGE);
        Route::apiResource('jobcategories','JobCategoryController')->middleware('permission:'.\App\Laravue\Acl::PERMISSION_PERMISSION_MANAGE);
        Route::apiResource('jobhistories','JobHistoryController')->middleware('permission:'.\App\Laravue\Acl::PERMISSION_PERMISSION_MANAGE);
        Route::apiResource('jobtitles','JobTitleController')->middleware('permission:'.\App\Laravue\Acl::PERMISSION_PERMISSION_MANAGE);
        Route::apiResource('leavetypes','LeaveTypeController')->middleware('permission:'.\App\Laravue\Acl::PERMISSION_PERMISSION_MANAGE);
        Route::apiResource('orders','OrderController')->middleware('permission:'.\App\Laravue\Acl::PERMISSION_PERMISSION_MANAGE);
        Route::apiResource('paygrades','PayGradeController')->middleware('permission:'.\App\Laravue\Acl::PERMISSION_PERMISSION_MANAGE);
        Route::apiResource('payments','PaymentController')->middleware('permission:'.\App\Laravue\Acl::PERMISSION_PERMISSION_MANAGE);
        Route::apiResource('purchases','PurchaseController')->middleware('permission:'.\App\Laravue\Acl::PERMISSION_PERMISSION_MANAGE);
        Route::apiResource('purchaseproducts','PurchaseProductController')->middleware('permission:'.\App\Laravue\Acl::PERMISSION_PERMISSION_MANAGE);
        Route::apiResource('quotations','QuotationController')->middleware('permission:'.\App\Laravue\Acl::PERMISSION_PERMISSION_MANAGE);
        Route::apiResource('quotationproducts','QuotationProductController')->middleware('permission:'.\App\Laravue\Acl::PERMISSION_PERMISSION_MANAGE);
        Route::apiResource('reimbursements','ReimbursementController')->middleware('permission:'.\App\Laravue\Acl::PERMISSION_PERMISSION_MANAGE);
        Route::apiResource('salaries','SalaryController')->middleware('permission:'.\App\Laravue\Acl::PERMISSION_PERMISSION_MANAGE);
        Route::apiResource('salarycomponents','SalaryComponentController')->middleware('permission:'.\App\Laravue\Acl::PERMISSION_PERMISSION_MANAGE);
        Route::apiResource('saleproducts','SaleProductController')->middleware('permission:'.\App\Laravue\Acl::PERMISSION_PERMISSION_MANAGE);
        Route::apiResource('statuses','StatusController')->middleware('permission:'.\App\Laravue\Acl::PERMISSION_PERMISSION_MANAGE);
        Route::apiResource('subordinates','SubordinateController')->middleware('permission:'.\App\Laravue\Acl::PERMISSION_PERMISSION_MANAGE);
        Route::apiResource('supervisors','SupervisorController')->middleware('permission:'.\App\Laravue\Acl::PERMISSION_PERMISSION_MANAGE);
        Route::apiResource('taxes','TaxController')->middleware('permission:'.\App\Laravue\Acl::PERMISSION_PERMISSION_MANAGE);
        Route::apiResource('terminations','TerminationController')->middleware('permission:'.\App\Laravue\Acl::PERMISSION_PERMISSION_MANAGE);
        Route::apiResource('userattachments','UserAttachmentController')->middleware('permission:'.\App\Laravue\Acl::PERMISSION_PERMISSION_MANAGE);
        Route::apiResource('vendors','VendorController')->middleware('permission:'.\App\Laravue\Acl::PERMISSION_PERMISSION_MANAGE);
        Route::apiResource('withdrawals','WithdrawalController')->middleware('permission:'.\App\Laravue\Acl::PERMISSION_PERMISSION_MANAGE);
        Route::apiResource('workingdays','WorkingDayController')->middleware('permission:'.\App\Laravue\Acl::PERMISSION_PERMISSION_MANAGE);
        Route::apiResource('workshifts','WorkShiftController')->middleware('permission:'.\App\Laravue\Acl::PERMISSION_PERMISSION_MANAGE);
    
    });
});

// Fake APIs
Route::get('/table/list', function () {
    $rowsNumber = mt_rand(20, 30);
    $data = [];
    for ($rowIndex = 0; $rowIndex < $rowsNumber; $rowIndex++) {
        $row = [
            'author' => Faker::randomString(mt_rand(5, 10)),
            'display_time' => Faker::randomDateTime()->format('Y-m-d H:i:s'),
            'id' => mt_rand(100000, 100000000),
            'pageviews' => mt_rand(100, 10000),
            'status' => Faker::randomInArray(['deleted', 'published', 'draft']),
            'title' => Faker::randomString(mt_rand(20, 50)),
        ];

        $data[] = $row;
    }

    return response()->json(new JsonResponse(['items' => $data]));
});

Route::get('/orders', function () {
    $rowsNumber = 8;
    $data = [];
    for ($rowIndex = 0; $rowIndex < $rowsNumber; $rowIndex++) {
        $row = [
            'order_no' => 'LARAVUE' . mt_rand(1000000, 9999999),
            'price' => mt_rand(10000, 999999),
            'status' => Faker::randomInArray(['success', 'pending']),
        ];

        $data[] = $row;
    }

    return response()->json(new JsonResponse(['items' => $data]));
});

Route::get('/articles', function () {
    $rowsNumber = 10;
    $data = [];
    for ($rowIndex = 0; $rowIndex < $rowsNumber; $rowIndex++) {
        $row = [
            'id' => mt_rand(100, 10000),
            'display_time' => Faker::randomDateTime()->format('Y-m-d H:i:s'),
            'title' => Faker::randomString(mt_rand(20, 50)),
            'author' => Faker::randomString(mt_rand(5, 10)),
            'comment_disabled' => Faker::randomBoolean(),
            'content' => Faker::randomString(mt_rand(100, 300)),
            'content_short' => Faker::randomString(mt_rand(30, 50)),
            'status' => Faker::randomInArray(['deleted', 'published', 'draft']),
            'forecast' => mt_rand(100, 9999) / 100,
            'image_uri' => 'https://via.placeholder.com/400x300',
            'importance' => mt_rand(1, 3),
            'pageviews' => mt_rand(10000, 999999),
            'reviewer' => Faker::randomString(mt_rand(5, 10)),
            'timestamp' => Faker::randomDateTime()->getTimestamp(),
            'type' => Faker::randomInArray(['US', 'VI', 'JA']),

        ];

        $data[] = $row;
    }

    return response()->json(new JsonResponse(['items' => $data, 'total' => mt_rand(1000, 10000)]));
});

Route::get('articles/{id}', function ($id) {
    $article = [
        'id' => $id,
        'display_time' => Faker::randomDateTime()->format('Y-m-d H:i:s'),
        'title' => Faker::randomString(mt_rand(20, 50)),
        'author' => Faker::randomString(mt_rand(5, 10)),
        'comment_disabled' => Faker::randomBoolean(),
        'content' => Faker::randomString(mt_rand(100, 300)),
        'content_short' => Faker::randomString(mt_rand(30, 50)),
        'status' => Faker::randomInArray(['deleted', 'published', 'draft']),
        'forecast' => mt_rand(100, 9999) / 100,
        'image_uri' => 'https://via.placeholder.com/400x300',
        'importance' => mt_rand(1, 3),
        'pageviews' => mt_rand(10000, 999999),
        'reviewer' => Faker::randomString(mt_rand(5, 10)),
        'timestamp' => Faker::randomDateTime()->getTimestamp(),
        'type' => Faker::randomInArray(['US', 'VI', 'JA']),

    ];

    return response()->json(new JsonResponse($article));
});

Route::get('articles/{id}/pageviews', function ($id) {
    $pageviews = [
        'PC' => mt_rand(10000, 999999),
        'Mobile' => mt_rand(10000, 999999),
        'iOS' => mt_rand(10000, 999999),
        'android' => mt_rand(10000, 999999),
    ];
    $data = [];
    foreach ($pageviews as $device => $pageview) {
        $data[] = [
            'key' => $device,
            'pv' => $pageview,
        ];
    }

    return response()->json(new JsonResponse(['pvData' => $data]));
});
