<?php

use Illuminate\Support\Facades\Route;
// added


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

Auth::routes();

// GUEST
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// ************************************************************************************************
// ADMIN
Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function(){
    // 
    Route::get('/dashboard',[App\Http\Controllers\Admin\DashboardController::class, 'index']);
    

    Route::get('/users',[App\Http\Controllers\Admin\AdminController::class,'index']);
    Route::get('/add-admin',[App\Http\Controllers\Admin\AdminController::class,'createAdmin']);
    Route::get('/add-eka',[App\Http\Controllers\Admin\AdminController::class,'createEka']);
    Route::post('/store-eka-user',[App\Http\Controllers\Admin\AdminController::class, 'storeUser']);
    Route::post('/store-admin-user',[App\Http\Controllers\Admin\AdminController::class,'storeUser']);
    Route::get('/edit/{user_id}',[App\Http\Controllers\Admin\AdminController::class,'editUser']);

    Route::get('/profile/{user_id}',[App\Http\Controllers\Admin\AdminController::class, 'editUser']);
        
    
});



// ************************************************************************************************
// KEY ACTOR
Route::prefix('key_actor')->middleware(['auth', 'isKeyActor'])->group(function(){
    // 
    Route::get('/dashboard',[App\Http\Controllers\KeyActor\DashboardController::class, 'index']);
    Route::get('/profile/{user_id}',[App\Http\Controllers\KeyActor\KeyActorController::class, 'editUser']);
   
   
    Route::get('/feed', [App\Http\Controllers\KeyActor\FeedController::class, 'index']);
    Route::get('/add-feed', [App\Http\Controllers\KeyActor\FeedController::class, 'create']);
    Route::post('/store-feed', [App\Http\Controllers\KeyActor\FeedController::class, 'storeFeed']);

    Route::get('/material', [App\Http\Controllers\KeyActor\MaterialController::class, 'index']);
    Route::get('/add-material', [App\Http\Controllers\KeyActor\MaterialController::class, 'create']);
    Route::post('/store-material', [App\Http\Controllers\KeyActor\MaterialController::class, 'storeMaterial']);
    
});


// ************************************************************************************************
// TARGET ACTOR
Route::prefix('target_actor')->middleware(['auth', 'isTargetActor'])->group(function(){
    // 
    Route::get('/dashboard',[App\Http\Controllers\TargetActor\DashboardController::class, 'index']);
});


