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

use App\Http\Controllers\BillController;
use App\Http\Controllers\ExpenseTypeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('expenses');
    }

    return view('auth.login');
});

//Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::resource('expenses', BillController::class)->except(['show', 'create']);
    Route::resource('/expensetypes', ExpenseTypeController::class);
    Route::resource('/users', UserController::class);

    Route::get('/api/getTranslation/{key}', function ($key) {
        return __($key);
    });
});
