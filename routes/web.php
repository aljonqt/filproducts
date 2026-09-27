<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PageController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\FilbizInquiryController;
use App\Http\Controllers\FilbizUpgradeController;
use App\Http\Controllers\ResidentialInquiryController;
use App\Http\Controllers\ResidentialUpgradeController;

use App\Http\Middleware\EnsurePrivacyAccepted;


/*
|--------------------------------------------------------------------------
| PUBLIC PAGES
|--------------------------------------------------------------------------
*/

Route::get('/', [PageController::class, 'home'])->name('home');

Route::get('/news', [PageController::class, 'news'])->name('news');

Route::get('/complaint', [PageController::class, 'complaint'])->name('complaint');

Route::get('/faq', [PageController::class, 'faq'])->name('faq');

Route::get('/about', [PageController::class, 'about'])->name('about');

Route::get('/branches', [PageController::class, 'branch'])->name('branch');



Route::get('/data-privacy', function () {
    return view('inquiry.data-privacy');
})->name('data.privacy');


Route::post('/data-privacy/accept', function () {

    session([
        'privacy_accepted' => true
    ]);

    $redirect = session()->pull(
        'privacy_redirect',
        route('application.type')
    );

    return redirect($redirect);

})->name('data.privacy.accept');


Route::middleware(EnsurePrivacyAccepted::class)->group(function () {


    Route::get('/application-type', function () {
        return view('inquiry.application-type');
    })->name('application.type');


    Route::get('/residential-inquiry',
        [ResidentialInquiryController::class, 'inquiry']
    )->name('residential.inquiry');


    Route::post('/residential-inquiry',
        [ResidentialInquiryController::class, 'submit']
    )->name('residential.inquiry.submit');


    Route::get('/residential-upgrade',
        [ResidentialUpgradeController::class, 'upgrade']
    )->name('residential.upgrade');


    Route::post('/residential-upgrade',
        [ResidentialUpgradeController::class, 'submit']
    )->name('residential.upgrade.submit');


    Route::get('/filbiz-inquiry',
        [FilbizInquiryController::class, 'inquiry']
    )->name('filbiz.inquiry');


    Route::post('/filbiz-inquiry',
        [FilbizInquiryController::class, 'submit']
    )->name('filbiz.submit');


    Route::get('/filbiz-upgrade',
        [FilbizUpgradeController::class, 'upgrade']
    )->name('filbiz.upgrade');


    Route::post('/filbiz-upgrade',
        [FilbizUpgradeController::class, 'submit']
    )->name('filbiz.upgrade.submit');

});



Route::get('/maintenance', function () {
    return view('inquiry.maintenance');
})->name('maintenance');


Route::post('/complaint-submit',
    [ComplaintController::class, 'submit']
)->name('complaint.submit');

