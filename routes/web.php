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
Route::get('/api/v1/tibaasili/registration/traditional', [AdminController::class,'registrationIndex'])->name('traditional-citizen');
Route::get('/api/v1/tibaasili/registration/traditional/noncitizen', [AdminController::class,'traditionalNonCitizenIndex'])->name('traditional-noncitizen');
Route::get('/api/v1/tibaasili/registration/alternatively/citizen', [AdminController::class,'alternativelyCitizenIndex'])->name('alternatively-citizen');
Route::get('/api/v1/tibaasili/registration/alternatively/noncitizen', [AdminController::class,'alternativelyNonCitizenIndex'])->name('alternatively-noncitizen');
Route::get('/api/v1/tibaasili/registration/massage/citizen', [AdminController::class,'massageCitizenIndex'])->name('massage-citizen');
Route::get('/api/v1/tibaasili/registration/traditioner/medicine/seller', [AdminController::class,'medicineSeller'])->name('traditional-medicine-seller');
Route::get('/api/v1/tibaasili/registration/assistant/alternative', [AdminController::class,'assistantAlternativeIndex'])->name('assistant-alternatively');
Route::get('/api/v1/tibaasili/registration/assistant/traditional', [AdminController::class,'assistantTraditionalIndex'])->name('assistant-traditional');
Route::get('/api/v1/tibaasili/medicine/shrine', [AdminController::class,'traditionalMedicineShrineIndex'])->name('traditional-medicine-shrine');
Route::get('/api/v1/tibaasili/medicine/clinic', [AdminController::class,'traditionalMedicineClinicIndex'])->name('traditional-medicine-clinic');
Route::get('/api/v1/tibaasili/alternatively/medicine/clinic', [AdminController::class,'alternativelyMedicineClinicIndex'])->name('alternatively-medicine-clinic');
Route::get('/api/v1/tibaasili/traditional/medicine/health/center', [AdminController::class,'traditionalMedicineHealthCentreIndex'])->name('traditional-medicine-health-centre');
Route::get('/api/v1/tibaasili/alternatively/medicine/health/center', [AdminController::class,'alternativelyMedicineHealthCentre'])->name('alternatively-medicine-health-centre');
Route::get('/api/v1/tibaasili/traditional/medicine/hospital', [AdminController::class,'traditionalMedicineHospital'])->name('traditional-medicine-hospital');
Route::get('/api/v1/tibaasili/alternative/medicine/hospital', [AdminController::class,'alternativeMedicineHospital'])->name('alternative-medicine-hospital');
Route::get('/api/v1/tibaasili/traditional/medicine/store', [AdminController::class,'traditionalMedicineStore'])->name('traditional-medicine-store');
Route::get('/api/v1/tibaasili/registration/traditional/medicine', [AdminController::class,'registrationTraditionalMedicine'])->name('registration-traditional-medicine');
Route::get('/api/v1/tibaasili/registration/alternative/medicine', [AdminController::class,'registrationAlternativeMedicine'])->name('registration-alternative-medicine');
Route::get('/api/v1/tibaasili/enlisting/traditional/medicine', [AdminController::class,'enlistingTraditionalMedicines'])->name('enlisting-traditional-medicines');
Route::get('/api/v1/tibaasili/importing/medicine', [AdminController::class,'importingMedicines'])->name('importing-medicines');
Route::get('/api/v1/tibaasili/exporting/medicine', [AdminController::class,'exportingMedicines'])->name('exporting-medicines');
Route::get('/api/v1/tibaasili/licencing', [AdminController::class,'licencingIndex'])->name('licensing');










Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/api/v1/tibaasili/admin', [AdminController::class,'index'])->name('dashboard');
    Route::get('/api/v1/tibaasili/user/feedback/admin', [AdminController::class,'contactUs'])->name('contact-us-admin');
    Route::get('/api/v1/tibaasili/contactus/callback', [AdminController::class,'contactUsCallBack'])->name('get-feedback-route');
    Route::get('/api/v1/tibaasili/read/feedback', [AdminController::class,'readFeedBack'])->name('read-feedback');
    Route::get('/api/v1/tibaasili/feedback/count', [AdminController::class,'contactUsCount'])->name('feedback-count');

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


