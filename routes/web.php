<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Route::get('userVerification/{token}', 'UserVerificationController@approve')->name('userVerification');
Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Book Category
    Route::delete('book-categories/destroy', 'BookCategoryController@massDestroy')->name('book-categories.massDestroy');
    Route::resource('book-categories', 'BookCategoryController');

    // Book List
    Route::delete('book-lists/destroy', 'BookListController@massDestroy')->name('book-lists.massDestroy');
    Route::post('book-lists/media', 'BookListController@storeMedia')->name('book-lists.storeMedia');
    Route::post('book-lists/ckmedia', 'BookListController@storeCKEditorImages')->name('book-lists.storeCKEditorImages');
    Route::resource('book-lists', 'BookListController');

    // Book Tag
    Route::delete('book-tags/destroy', 'BookTagController@massDestroy')->name('book-tags.massDestroy');
    Route::resource('book-tags', 'BookTagController');

    // System Settings
    Route::delete('system-settings/destroy', 'SystemSettingsController@massDestroy')->name('system-settings.massDestroy');
    Route::post('system-settings/media', 'SystemSettingsController@storeMedia')->name('system-settings.storeMedia');
    Route::post('system-settings/ckmedia', 'SystemSettingsController@storeCKEditorImages')->name('system-settings.storeCKEditorImages');
    Route::post('system-settings/custom_edit', 'SystemSettingsController@custom_edit')->name('system-settings.custom_edit');
    Route::resource('system-settings', 'SystemSettingsController');

    // Question
    Route::delete('questions/destroy', 'QuestionController@massDestroy')->name('questions.massDestroy');
    Route::resource('questions', 'QuestionController');

    // Laravel Passport
    Route::delete('laravel-passports/destroy', 'LaravelPassportController@massDestroy')->name('laravel-passports.massDestroy');
    Route::resource('laravel-passports', 'LaravelPassportController');

    // Book Loans
    Route::delete('book-loans/destroy', 'BookLoansController@massDestroy')->name('book-loans.massDestroy');
    Route::resource('book-loans', 'BookLoansController');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
