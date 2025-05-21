<?php

use App\Http\Controllers\v1\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AdminController::class,'welcome'])->name('welcome');
Route::get('/api/v1/tibaasili/login', [AdminController::class,'loginPage'])->name('login');
Route::post('/api/v1/tibaasili/auth', [AdminController::class,'authUser'])->name('auth-user');
Route::post('/api/v1/tibaasili/validate/user', [AdminController::class,'validateUser'])->name('validate-user');
Route::post('/api/v1/tibaasili/contact-us/form', [AdminController::class,'processContactUs'])->name('contact-form');
Route::get('/api/v1/tibaasili/more/details/{contentKey}', [AdminController::class,'moreDetailsPage'])->name('more-details');
Route::get('/api/v1/tibaasili/about-us', [AdminController::class,'aboutUs'])->name('about-us');
Route::get('/api/v1/tibaasili/mission', [AdminController::class,'missionIndex'])->name('mission-vision');
Route::get('/api/v1/tibaasili/council/member', [AdminController::class,'councilMemberIndex'])->name('council-members');
Route::get('/api/v1/tibaasili/management/team', [AdminController::class,'managementTeamIndex'])->name('management-team');
Route::get('/api/v1/tibaasili/contact-us', [AdminController::class,'contactUsIndex'])->name('contact-us');
Route::get('/api/v1/tibaasili/registration', [AdminController::class,'registrationIndex'])->name('registration');
Route::get('/api/v1/tibaasili/licencing', [AdminController::class,'licencingIndex'])->name('licensing');










Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/api/v1/tibaasili/admin', [AdminController::class,'index'])->name('dashboard');
    Route::get('/api/v1/tibaasili/top/navbar/callback', [AdminController::class,'topNavbarCallBack'])->name('top-navbar-callback');
    Route::get('/api/v1/tibaasili/slider/section/callback', [AdminController::class,'sliderSectionCallBack'])->name('slider-callback-route');
    Route::get('/api/v1/tibaasili/content/section/callback', [AdminController::class,'contentSectionCallBack'])->name('get-content-section-route');

    Route::post('/api/v1/tibaasili/content/pages', [AdminController::class,'pagesContent'])->name('pages-content-route');
    Route::post('/api/v1/tibaasili/content/form', [AdminController::class,'contentForm'])->name('content-section-route');
    Route::post('/api/v1/tibaasili/slider/form', [AdminController::class,'sliderForm'])->name('slider-route');
    Route::post('/api/v1/tibaasili/navbar/form', [AdminController::class,'navbarForm'])->name('navbar-route');
    Route::post('/api/v1/tibaasili/top/navbar/remove', [AdminController::class,'removeData'])->name('remove-top-navbar-data');
    Route::post('/api/v1/tibaasili/logout', [AdminController::class,'logout'])->name('log-out');
});


