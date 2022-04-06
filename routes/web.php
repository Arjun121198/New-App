<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Middleware\AuthCheck;
use App\Http\Middleware\AdminAuthCheck;
use App\Http\Middleware\Login;

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
Route::middleware([AuthCheck::class])->group(function () {
    Route::get('/user-dashboard', [AuthController::class, 'userDashboard']);

});
Route::middleware([AdminAuthCheck::class])->group(function () {
    Route::get('/admin-dashboard', [AuthController::class, 'adminDashboard'])->name('dashboard');
    Route::post('/approve', [AuthController::class, 'approve']);
    Route::post('/decline', [AuthController::class, 'decline']);
    Route::post('/adminadduser', [AuthController::class, 'adminAddUser']);
});
Route::get('/login', [AuthController::class, 'login'])->middleware([Login::class]);
Route::get('/register', [AuthController::class, 'register']);
Route::post('/registeruser', [AuthController::class, 'registerUser']);
Route::post('/loginuser', [AuthController::class, 'loginUser']);
Route::get('/userlogout', [AuthController::class, 'userLogout']);
Route::get('/adminlogout', [AuthController::class, 'adminLogout']);
Route::get('/customer', [CustomerController::class, 'customer']);
Route::post('/addcustomer', [CustomerController::class, 'addCustomer']);

Route::get('/customerview', [CustomerController::class, 'customerView']);
Route::post('/customernew', [CustomerController::class, 'customerNew']);
