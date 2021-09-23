<?php

use App\Http\Controllers\CareerController;
use App\Http\Controllers\DetailPageController;

use App\Http\Controllers\Front\FrontEndController;


use App\Http\Controllers\Front\SubscriberController;
use App\Http\Controllers\SubscribeController;

use App\Http\Controllers\WelcomeController;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;


Route::get('/locale/{locale}', function ($locale) {
    $validLocale = in_array($locale, ['en', 'np']);
    if ($validLocale) {
        App::setLocale($locale);
        session(['locale' => $locale]);
    }
    redirect()->back();
})->name('setLanguage');

Route::get('/', [FrontEndController::class, 'home'])->name('index');




Route::get('/verifiy-email/{verificationCode}', [CareerController::class, 'careerVerification'])->name('career-verification');
Route::post('/contact-form', [FrontEndController::class, 'contactStore'])->name('contactStore');
// Route::get('/subscribe', [SubscriberController::class, 'store'])->name('subscriberStore');
Route::get('/career/{slug}', [CareerController::class, 'careerDetails'])->name('front.careerDetails');
Route::post('/add-career/{slug}', [CareerController::class, 'careerAdd'])->name('careerAdd');
// Route::get('/{page}', [FrontEndController::class, 'page'])->name('page');
Route::post('{slug}', [DetailPageController::class, 'detailpage'])->name('detailpage');
Route::post('/search-data', [FrontEndController::class, 'blogsearchdata'])->name('blog.blogsearchdata');
Route::get('/blog', [FrontEndController::class, 'featch_data']);

 Route::get('/email', [SubscribeController::class, 'sendmail'])->name('sendmail');


//    Route::get('detail/{slug}', [FrontEndController::class, 'singledetail'])->name('singledetail');
// Route::get('services/{slug}', [FrontEndController::class, 'singleservice'])->name('singleservice')->where('slug', '[\w\d\-\_]+');


// Route::get('services', [FrontEndController::class, 'serviceslist'])->name('serviceslist');

Route::get('/team', [FrontEndController::class, 'teampage'])->name('teampage');


Route::get('{slug}', [FrontEndController::class, 'singleservice'])->name('singleservice');


//  Route::post('/welcome', [WelcomeController::class, 'store'])->name('welcome.store');





// Route::get('services/details/{slug}', [DetailController::class, 'servicedata'])->name('show_details');





