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
    if(\Illuminate\Support\Facades\Auth::check())
        return redirect()->route('dashboard');
    return view('template');
})->name('home');

Route::get('/logout', function (){
    abort(404);
});

Route::get('/dashboard', ['\App\Http\Controllers\UserController', 'index'] )
    ->name('dashboard')
    ->middleware('auth', 'contractAuth');
Route::post('/transfer', ['\App\Http\Controllers\TransferController', 'transfer'] )
    ->name('transfer')
    ->middleware('auth', 'contractAuth');
Route::get('/transfer', function () {
    return redirect()->route('home');
})->name('transfer')->middleware('auth', 'contractAuth');
Route::get('/continueTransfer', ['\App\Http\Controllers\TransferController', 'continueTransfer'] )
    ->name('continueTransfer')
    ->middleware('auth', 'contractAuth', 'checkCode');

Route::get('/contract', ['\App\Http\Controllers\Auth\ContractController', 'index'])->name('contract');
Route::get('/contractVerifed', ['\App\Http\Controllers\Auth\ContractVerificatedController', 'verifed'])->name('verifed');

Route::get('/operationCheck', ['\App\Http\Controllers\OperationCheckController', 'verifedOperation'])->name('operationCheck');
Route::post('/operationCheckCode', ['\App\Http\Controllers\OperationCheckController', 'checkCode'])->name('operationCheckCode');



Route::post('/checkCode', ['\App\Http\Controllers\Auth\ContractVerificatedController', 'checkCode'])->name('checkCode');
Route::get('/checkCode', function () {
    return redirect()->route('home');
})->name('checkCode');


// Админка
$groupData=[
    'middleware'=>'costumAuth',
    'namespace'=>'\App\Http\Controllers\Admin',
    'prefix'=>'admin/', // то что будет в строке url после имени сайта
];
Route::group($groupData, function(){
    // admin->user
    Route::post('user/search','UserController@search')->name('admin.user.search');
    Route::resource('user', 'UserController')
        ->names('admin.user');

    //transfer
    Route::resource('transfer', 'TransferController')
        ->names('admin.transfer');
});

// login admin
Route::get('admin/login', ['\App\Http\Controllers\Admin\LoginController', 'index'] )->name('admin.login.index');
Route::post('admin/login', ['\App\Http\Controllers\Admin\LoginController', 'authenticate'] )->name('admin.login');
Route::get('admin/logout', ['\App\Http\Controllers\Admin\LoginController', 'logout'] )->name('admin.logout');



require __DIR__.'/auth.php';
