<?php

use App\Http\Controllers\v1\AdminController;
use App\Http\Controllers\v1\UserController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', [AdminController::class,'welcome'])->name('welcome');
Route::get('/api/v1/tibaasili/login', [AdminController::class,'loginPage'])->name('login');
Route::post('/api/v1/tibaasili/auth', [AdminController::class,'authUser'])->name('auth-user');
Route::post('/api/v1/tibaasili/validate/user', [AdminController::class,'validateUser'])->name('validate-user');
Route::post('/api/v1/tibaasili/contact-us/form', [AdminController::class,'processContactUs'])->name('contact-form');
/*
 * Public pages: [route name => [clean URL, old /api/v1/tibaasili URL, controller method]].
 * The old URLs redirect permanently (301) so Google moves its index to the new ones.
 */
$publicPages = [
    'about-us'                             => ['/about-us', 'about-us', 'aboutUs'],
    'mission-vision'                       => ['/mission-vision', 'mission', 'missionIndex'],
    'council-members'                      => ['/council-members', 'council/member', 'councilMemberIndex'],
    'management-team'                      => ['/management-team', 'management/team', 'managementTeamIndex'],
    'contact-us'                           => ['/contact-us', 'contact-us', 'contactUsIndex'],
    'traditional-citizen'                  => ['/registration/traditional-citizen', 'registration/traditional', 'registrationIndex'],
    'traditional-noncitizen'               => ['/registration/traditional-noncitizen', 'registration/traditional/noncitizen', 'traditionalNonCitizenIndex'],
    'alternatively-citizen'                => ['/registration/alternative-citizen', 'registration/alternatively/citizen', 'alternativelyCitizenIndex'],
    'alternatively-noncitizen'             => ['/registration/alternative-noncitizen', 'registration/alternatively/noncitizen', 'alternativelyNonCitizenIndex'],
    'massage-citizen'                      => ['/registration/massage-citizen', 'registration/massage/citizen', 'massageCitizenIndex'],
    'traditional-medicine-seller'          => ['/registration/traditional-medicine-seller', 'registration/traditioner/medicine/seller', 'medicineSeller'],
    'assistant-alternatively'              => ['/registration/assistant-alternative', 'registration/assistant/alternative', 'assistantAlternativeIndex'],
    'assistant-traditional'                => ['/registration/assistant-traditional', 'registration/assistant/traditional', 'assistantTraditionalIndex'],
    'traditional-medicine-shrine'          => ['/facilities/traditional-medicine-shrine', 'medicine/shrine', 'traditionalMedicineShrineIndex'],
    'traditional-medicine-clinic'          => ['/facilities/traditional-medicine-clinic', 'medicine/clinic', 'traditionalMedicineClinicIndex'],
    'alternatively-medicine-clinic'        => ['/facilities/alternative-medicine-clinic', 'alternatively/medicine/clinic', 'alternativelyMedicineClinicIndex'],
    'traditional-medicine-health-centre'   => ['/facilities/traditional-medicine-health-centre', 'traditional/medicine/health/center', 'traditionalMedicineHealthCentreIndex'],
    'alternatively-medicine-health-centre' => ['/facilities/alternative-medicine-health-centre', 'alternatively/medicine/health/center', 'alternativelyMedicineHealthCentre'],
    'traditional-medicine-hospital'        => ['/facilities/traditional-medicine-hospital', 'traditional/medicine/hospital', 'traditionalMedicineHospital'],
    'alternative-medicine-hospital'        => ['/facilities/alternative-medicine-hospital', 'alternative/medicine/hospital', 'alternativeMedicineHospital'],
    'traditional-medicine-store'           => ['/facilities/traditional-medicine-store', 'traditional/medicine/store', 'traditionalMedicineStore'],
    'registration-traditional-medicine'    => ['/medicines/traditional-registration', 'registration/traditional/medicine', 'registrationTraditionalMedicine'],
    'registration-alternative-medicine'    => ['/medicines/alternative-registration', 'registration/alternative/medicine', 'registrationAlternativeMedicine'],
    'enlisting-traditional-medicines'      => ['/medicines/enlisting-traditional', 'enlisting/traditional/medicine', 'enlistingTraditionalMedicines'],
    'importing-medicines'                  => ['/medicines/importing', 'importing/medicine', 'importingMedicines'],
    'exporting-medicines'                  => ['/medicines/exporting', 'exporting/medicine', 'exportingMedicines'],
    'licensing'                            => ['/publications', 'publication', 'licencingIndex'],
    'library'                              => ['/library', 'library', 'libraryIndex'],
];

foreach ($publicPages as $name => [$path, $oldPath, $method]) {
    Route::get($path, [AdminController::class, $method])->name($name);
    Route::permanentRedirect('/api/v1/tibaasili/' . $oldPath, $path);
}

Route::get('/news/{contentKey}', [AdminController::class,'moreDetailsPage'])->name('more-details');
Route::get('/api/v1/tibaasili/more/details/{contentKey}', fn ($contentKey) => redirect()->route('more-details', $contentKey, 301));

Route::get('/sitemap.xml', function () use ($publicPages) {
    $urls = [['loc' => url('/'), 'lastmod' => null, 'priority' => '1.0']];
    foreach ($publicPages as [$path]) {
        $urls[] = ['loc' => url($path), 'lastmod' => null, 'priority' => '0.8'];
    }

    // News, announcements, events and videos posted from the dashboard.
    $posts = DB::table('habari_mpya')
        ->select('uuid', 'updated_at', 'created_at')
        ->where('status', '=', 'active')
        ->whereIn('category', ['habari', 'taarifa', 'matukio', 'video'])
        ->orderBy('id', 'desc')
        ->get();
    foreach ($posts as $post) {
        $urls[] = [
            'loc' => route('more-details', $post->uuid),
            'lastmod' => \Carbon\Carbon::parse($post->updated_at ?? $post->created_at)->toAtomString(),
            'priority' => '0.6',
        ];
    }

    $xml = '<?xml version="1.0" encoding="UTF-8"?>';
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
    foreach ($urls as $u) {
        $xml .= '<url><loc>' . e($u['loc']) . '</loc>';
        if ($u['lastmod']) {
            $xml .= '<lastmod>' . $u['lastmod'] . '</lastmod>';
        }
        $xml .= '<priority>' . $u['priority'] . '</priority></url>';
    }
    $xml .= '</urlset>';

    return response($xml, 200)->header('Content-Type', 'text/xml');
});

Route::group(['middleware' => ['auth']], function () {
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

    Route::group(['middleware' => ['admin']], function () {
        Route::get('/api/v1/tibaasili/users', [UserController::class,'index'])->name('users');
        Route::get('/api/v1/tibaasili/users/callback', [UserController::class,'usersCallBack'])->name('users-callback');
        Route::post('/api/v1/tibaasili/users/store', [UserController::class,'store'])->name('users-store');
        Route::post('/api/v1/tibaasili/users/status', [UserController::class,'toggleStatus'])->name('users-toggle-status');
        Route::post('/api/v1/tibaasili/users/role', [UserController::class,'toggleRole'])->name('users-toggle-role');
        Route::post('/api/v1/tibaasili/users/password', [UserController::class,'resetPassword'])->name('users-reset-password');
    });
});


