<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('register', [\App\Http\Controllers\AuthController::class, 'register']);
Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [\App\Http\Controllers\AuthController::class, 'user']);
    Route::post('logout', [\App\Http\Controllers\AuthController::class, 'logout']);
    Route::resource('roles', 'App\Http\Controllers\RolesController')->middleware('permission:roles');
    Route::resource('users', 'App\Http\Controllers\UsersController')->middleware('permission:users');
    Route::resource('permissions', 'App\Http\Controllers\PermissionsController')->middleware('permission:permissions');
    Route::resource('permission_roles', 'App\Http\Controllers\PermissionRolesController')->middleware('permission:permission_roles');
    Route::resource('role_users', 'App\Http\Controllers\RoleUsersController')->middleware('permission:role_users');
    Route::resource('languages', 'App\Http\Controllers\LanguagesController')->middleware('permission:languages');
    Route::resource('step_by_language_or_frameworks', 'App\Http\Controllers\StepByLanguageOrFrameworksController')->middleware('permission:step_by_language_or_frameworks');
});

Route::get('steps_by_languages/{id}', [\App\Http\Controllers\StepByLanguageOrFrameworksController::class, 'getStepsByLanguage'])->name("steps_by_languages");
Route::get('steps_by_frameworks/{id}', [\App\Http\Controllers\StepByLanguageOrFrameworksController::class, 'getStepsByFramework'])->name("steps_by_frameworks");