<?php

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
    return view('template');
})->name('home');

Route::get('/dashboard', ['\App\Http\Controllers\UserController', 'index'] )->name('dashboard')->middleware('auth');
Route::post('/transfer', ['\App\Http\Controllers\TransferController', 'transfer'] )->name('transfer')->middleware('auth');



Route::get('/contract', ['\App\Http\Controllers\Auth\ContractController', 'index'])->name('contract');
Route::post('/contractVerifed', ['\App\Http\Controllers\Auth\ContractVerificatedController', 'verifed'])->name('verifed');
Route::get('/contractVerifed', function () {
    return redirect()->route('home');
})->name('verifed');

Route::post('/checkCode', ['\App\Http\Controllers\Auth\ContractVerificatedController', 'checkCode'])->name('checkCode');
//Route::get('/checkCode', function () {
//    return redirect()->route('home');
//})->name('checkCode');


// Админка
$groupData=[
    'middleware'=>'costumAuth',
    'namespace'=>'\App\Http\Controllers\admin',
    'prefix'=>'admin/', // то что будет в строке url после имени сайта
];
Route::group($groupData, function(){
    // admin->user
    Route::post('user/search','UserController@search')->name('admin.user.search');
    Route::resource('user', 'UserController')
        ->names('admin.user');

});

// login admin
Route::get('admin/login', ['\App\Http\Controllers\Admin\LoginController', 'index'] )->name('admin.login.index');
Route::post('admin/login', ['\App\Http\Controllers\Admin\LoginController', 'authenticate'] )->name('admin.login');
Route::get('admin/logout', ['\App\Http\Controllers\Admin\LoginController', 'logout'] )->name('admin.logout');



require __DIR__.'/auth.php';
