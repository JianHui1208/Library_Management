<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin'], function () {

    Route::group(['middleware' => ['auth:api', 'scope:view-user']], function () {
        Route::GET('/user', function (Request $request) {
            return $request->user();
        });

    });

    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Book Category
    Route::apiResource('book-categories', 'BookCategoryApiController');

    // Book List
    Route::apiResource('book-lists', 'BookListApiController');

    // Book Tag
    Route::apiResource('book-tags', 'BookTagApiController');

    // System Settings
    Route::post('system-settings/media', 'SystemSettingsApiController@storeMedia')->name('system-settings.storeMedia');
    Route::apiResource('system-settings', 'SystemSettingsApiController');

    // Question
    Route::apiResource('questions', 'QuestionApiController');

    // Book Loans
    Route::apiResource('book-loans', 'BookLoansApiController');
});
