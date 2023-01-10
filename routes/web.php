<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes(['verify' => true]);

// GUEST
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// ************************************************************************************************
// ADMIN
Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function(){
    // 
    Route::get('/dashboard',[App\Http\Controllers\Admin\DashboardController::class, 'index']);
    
    Route::get('/users',[App\Http\Controllers\Admin\AdminController::class,'index']);
    Route::get('/add-user', [App\Http\Controllers\Admin\AdminController::class,'createUser']);
    Route::get('/add-admin',[App\Http\Controllers\Admin\AdminController::class,'createAdmin']);
    Route::get('/add-eka',[App\Http\Controllers\Admin\AdminController::class,'createEka']);
    Route::post('/store-target-user',[App\Http\Controllers\Admin\AdminController::class, 'storeUser']);
    Route::post('/store-eka-user',[App\Http\Controllers\Admin\AdminController::class, 'storeEka']);
    Route::post('/store-admin-user',[App\Http\Controllers\Admin\AdminController::class,'storeAdmin']);
    Route::get('/edit/{user_id}',[App\Http\Controllers\Admin\AdminController::class,'editUser']);
    Route::put('/update_user/{user_id}',[App\Http\Controllers\Admin\AdminController::class, 'updateUser']);
    Route::put('/update_admin/{user_id}',[App\Http\Controllers\Admin\AdminController::class, 'updateAdmin']);
    Route::put('/update_eka/{user_id}',[App\Http\Controllers\Admin\AdminController::class, 'updateEka']);

    Route::get('/profile/{user_id}',[App\Http\Controllers\Admin\AdminController::class, 'editProfile']);
    Route::get('/delete/{user_id}', [App\Http\Controllers\Admin\AdminController::class,'deleteUser']);

    Route::get('/search', [App\Http\Controllers\Admin\AdminController::class, 'searchUsers']);
    Route::get('/filter',[App\Http\Controllers\Admin\AdminController::class,'filter']);


    Route::get('/ticketreports',[App\Http\Controllers\Admin\AdminController::class,'ticketreports']);
});



// ************************************************************************************************
// KEY ACTOR
Route::prefix('key_actor')->middleware(['auth', 'isKeyActor', ])->group(function(){
    // 
    Route::get('/dashboard',[App\Http\Controllers\KeyActor\DashboardController::class, 'index']);
    Route::get('/profile/{user_id}',[App\Http\Controllers\KeyActor\KeyActorController::class, 'editUser']);
    Route::put('/update/{user_id}',[App\Http\Controllers\KeyActor\KeyActorController::class, 'update']);
   
   
    Route::get('/feed', [App\Http\Controllers\KeyActor\FeedController::class, 'index']);
    Route::get('/add-feed', [App\Http\Controllers\KeyActor\FeedController::class, 'create']);
    Route::post('/store-feed', [App\Http\Controllers\KeyActor\FeedController::class, 'storeFeed']);
    Route::get('/edit-feed/{id}', [App\Http\Controllers\KeyActor\FeedController::class, 'editFeed']);
    Route::put('/updatefeed/{id}', [App\Http\Controllers\KeyActor\FeedController::class,'updateFeed']);

    Route::delete('/deletefeedcover/{id}', [App\Http\Controllers\KeyActor\FeedController::class,'deleteFeedCover']);
    Route::delete('/deletefeedfile/{id}', [App\Http\Controllers\KeyActor\FeedController::class,'deleteFeedFile']);
    Route::delete('/deletefeed/{id}', [App\Http\Controllers\KeyActor\FeedController::class, 'deleteFeed'] );
    
    Route::get('/search-feed', [App\Http\Controllers\KeyActor\FeedController::class, 'searchFeeds']);
    Route::get('/filter-feeds', [App\Http\Controllers\KeyActor\FeedController::class, 'filterFeeds']);

    Route::get('/material', [App\Http\Controllers\KeyActor\MaterialController::class, 'index']);
    Route::get('/add-material', [App\Http\Controllers\KeyActor\MaterialController::class, 'create']);
    Route::post('/store-material', [App\Http\Controllers\KeyActor\MaterialController::class, 'storeMaterial']);

    Route::get('/managematerialfile/{id}', [App\Http\Controllers\KeyActor\MaterialController::class,'manageMaterialFile']);
    Route::post('/storematerialfile', [App\Http\Controllers\KeyActor\MaterialController::class,'storeMaterialFile'] );
    Route::get('/editmaterialfile/{id}', [App\Http\Controllers\KeyActor\MaterialController::class, 'editMaterialFile']);
    Route::put('/updatematerialfile/{id}', [App\Http\Controllers\KeyActor\MaterialController::class, 'updateMaterialFile']);
    Route::put('/updatematerial/{id}', [App\Http\Controllers\KeyActor\MaterialController::class,'updateMaterial']);
    Route::delete('/deletematerial/{id}', [App\Http\Controllers\KeyActor\MaterialController::class,'deleteMaterial']);
    Route::delete('/deletematerialfile/{id}', [App\Http\Controllers\KeyActor\MaterialController::class,'deleteMaterialFiles'] );

    Route::get('/search-module', [App\Http\Controllers\KeyActor\MaterialController::class, 'searchMaterials']);
    Route::get('/filter-module', [App\Http\Controllers\KeyActor\MaterialController::class, 'filterMaterials']);

    Route::get('/report/viewreport', [App\Http\Controllers\KeyActor\ReportController::class, 'viewReport']);
    Route::get('/report/edit-report/{id}', [App\Http\Controllers\KeyActor\ReportController::class, 'editReport']);
    Route::put('/report/updatereport/{id}', [App\Http\Controllers\KeyActor\ReportController::class,'updateReport']);

    Route::get('/search-report', [App\Http\Controllers\KeyActor\ReportController::class, 'searchReport']);
    Route::get('/filter-report', [App\Http\Controllers\KeyActor\ReportController::class, 'filterReport']);
});


// ************************************************************************************************
// TARGET ACTOR
Route::prefix('target_actor')->middleware(['auth', 'isTargetActor'])->group(function(){
    // 
    Route::get('/dashboard',[App\Http\Controllers\TargetActor\DashboardController::class, 'index']);
    Route::get('/profile/{user_id}',[App\Http\Controllers\TargetActor\TargetActorController::class, 'editUser']);
    Route::put('/update/{user_id}',[App\Http\Controllers\TargetActor\TargetActorController::class, 'update']);
    Route::get('/view-feed/{id}', [App\Http\Controllers\TargetActor\DashboardController::class, 'viewFeed']);
    Route::get('/view-mat/{id}', [App\Http\Controllers\TargetActor\DashboardController::class, 'viewMaterial']);
    Route::get('/managematerialfile/{id}', [App\Http\Controllers\TargetActor\DashboardController::class,'manageMaterialFile']);
    Route::get('/editmaterialfile/{id}', [App\Http\Controllers\TargetActor\DashboardController::class, 'editMaterialFile']);
    Route::get('/downloadmaterialfile/{file}', [App\Http\Controllers\TargetActor\DashboardController::class,'downloadMaterial']);
    Route::get('/submitreport', [App\Http\Controllers\TargetActor\DashboardController::class, 'submitReport']);
    Route::post('/submitreport', [App\Http\Controllers\TargetActor\DashboardController::class, 'upload']);
    Route::get('/viewreport', [App\Http\Controllers\TargetActor\DashboardController::class, 'viewReport']);
    Route::get('/viewspec/{id}', [App\Http\Controllers\TargetActor\DashboardController::class, 'specreport']);
    Route::get('/viewlegit', [App\Http\Controllers\TargetActor\DashboardController::class, 'legitreports']);





});


