<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\HallsController;
use App\Http\Controllers\Admin\StaffsController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\StaffRoleController;
use App\Http\Controllers\Admin\PartnersController;
use App\Http\Controllers\Admin\PartnerRoleController;
use App\Http\Controllers\Admin\GalleryImageController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\EventStaffsController;

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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', function () {
    return redirect('/login');
});

//Route::view('/dashboard', 'admin.dashboard.index');


//Route::view('/admin', 'admin.dashboard.index');

Auth::routes(['register' => false]);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::group(['prefix' => 'cities'], function () {
        Route::get('/', [CityController::class, 'index'])->name('cities.index');
        Route::get('/create', [CityController::class, 'create'])->name('cities.create');
        Route::get('/{city}/edit', [CityController::class, 'edit'])->name('cities.edit');
        Route::post('/create', [CityController::class, 'store'])->name('cities.store');
        Route::put('/{City}', [CityController::class, 'update'])->name('cities.update');
        Route::get('/{city}', [CityController::class, 'destroy'])->name('cities.destroy');
    });

    //Galleries
    Route::get('galleries', [GalleryController::class, 'index'])->name('galleries.index');
    Route::get('galleries/create', [GalleryController::class, 'create'])->name('galleries.create');
    Route::get('galleries/{gallery}/edit', [GalleryController::class, 'edit'])->name('galleries.edit');
    Route::post('/galleries', [GalleryController::class, 'store'])->name('galleries.store');
    Route::get('galleries/{gallery}', [GalleryController::class, 'show'])->name('galleries.show');
    Route::Delete('galleries/{gallery}', [GalleryController::class, 'destroy'])->name('galleries.destroy');
    Route::Put('galleries/{gallery}', [GalleryController::class, 'update'])->name('galleries.update');
    Route::post('galleries/images/upload', [GalleryImageController::class, 'upload'])->name('gallery.images.upload');
    Route::get('galleries/images/{image}/delete', [GalleryImageController::class, 'delete'])->name('gallery.images.delete');


    //HALLS
    //    Route::group(['prefix' => 'halls'], function () {
    ////        Route::get('/', [HallController::class, 'index'])->name('halls.index');
    ////        Route::get('/create', [HallController::class, 'create'])->name('halls.create');
    //    });
    //    Route::get('/halls', function () {
    //        return view('admin.halls.index');
    //    });

    Route::resource('halls', HallsController::class);

    //staffs
    Route::resource('staffs', StaffsController::class);

    //Roles
    Route::resource('roles', RoleController::class);

    //staff-roles
    Route::resource('staff-roles', StaffRoleController::class);

    //partners
    Route::resource('partners', PartnersController::class);
    //partner-roles
    Route::resource('partner-roles', PartnerRoleController::class);

    //events
    Route::resource('events', EventController::class);
    //EventStaffs Route
    Route::resource('eventstaffs', EventStaffsController::class);

//    Route::get('eventstaffs', [EventStaffsController::class, 'index'])->name('eventstaffs.index');

    //settings
    Route::get('settings', [SettingsController::class, 'index'])->name('admin.settings');
    Route::post('settings', [SettingsController::class, 'update'])->name('admin.settings.update');
});

//Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
//
//Route::group(['prefix' => 'cities'], function () {
//    Route::get('/', [CityController::class, 'index'])->name('cities.index');
//    Route::get('/create', [CityController::class, 'create'])->name('cities.create');
//    Route::get('/{city}/edit', [CityController::class, 'edit'])->name('cities.edit');
//    Route::post('/create', [CityController::class, 'store'])->name('cities.store');
//    Route::put('/{City}', [CityController::class, 'update'])->name('cities.update');
//    Route::get('/{city}', [CityController::class, 'destroy'])->name('cities.destroy');
//});




// Gaallery routes
//Route::group(['prefix' => 'galleries'], function () {
//   Route::get('/', [GalleryController::class, 'index'])->name('galleries.index');
//   Route::get('/create', [GalleryController::class, 'create'])->name('galleries.create');
//   Route::post('/create', [GalleryController::class, 'store'])->name('galleries.store');
//   Route::get('/{gallery}/edit', [GalleryController::class, 'edit'])->name('galleries.edit');
//   Route::put('/{gallery}', [GalleryController::class, 'update'])->name('galleries.update');
//   Route::delete('/{gallery}', [GalleryController::class, 'destroy'])->name('galleries.destroy');
//});

//Galleries Route


//Route::resource('galleries', GalleryController::class)->middleware('auth');
//Route::get('galleries/{gallery}', [GalleryController::class, 'destroy'])->middleware('auth')->name('galleries.destroy');



//halls route

// staffs route

//Route::get('staffs/{staff}', [StaffsController::class, 'destroy'])->middleware('auth')->name('staffs.destroy');

//roles route

//Route::get('roles/{role}', [RoleController::class, 'destroy'])->middleware('auth')->name('roles.destroy');

//staff-roles Route

//Route::get('staff-roles/{staff-role}', [StaffRoleController::class, 'destroy'])->middleware('auth')->name('staff-role.destroy');

//partner-role route

//require('admin.php');



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
