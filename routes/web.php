<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Models\StepByLanguageOrFramework;
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
    $model = StepByLanguageOrFramework::find(1);
    $users = \User::all();
    return redirect(route('step_by_language_or_framework',$model));
});


Route::get('/step_by_language_or_framework/{stepByLanguageOrFramework}', function (StepByLanguageOrFramework $stepByLanguageOrFramework) {
    return $stepByLanguageOrFramework->name;
})->name('step_by_language_or_framework');