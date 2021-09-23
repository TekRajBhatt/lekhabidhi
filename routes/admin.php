<?php

use App\Http\Controllers\Admin\ApplicationController;
use App\Http\Controllers\Admin\AppSettingController;
use App\Http\Controllers\Admin\BlogController;
// use App\Http\Controllers\Admin\CareerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CategorySeederController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DesignationController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\ImageCropController;
use App\Http\Controllers\Admin\MediaLibraryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UserLogController;
use App\Http\Controllers\Admin\WordpressBackupController;
use App\Http\Controllers\AppNoticeController;
use App\Http\Controllers\ComplimentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\HoroscopeController;
use App\Http\Controllers\Admin\TextController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\ContainerController;
use App\Http\Controllers\Front\FrontEndController;
use App\Http\Controllers\GalleryCategoryController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\NoticeController;

use App\Http\Controllers\Admin\InformationController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\TestimonialController;


use App\Http\Controllers\Admin\MarketingController;
use App\Http\Controllers\Admin\CommitController;
use App\Http\Controllers\Admin\StepController;
use App\Http\Controllers\Admin\BusinessController;
use App\Http\Controllers\Admin\WorkController;
use App\Http\Controllers\Admin\SatisfyController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\WebsiteController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\DetailController;
use App\Http\Controllers\Admin\TouchController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\SubscribeController;






use App\Models\Category;
use App\Models\Horoscope;
use App\Models\Slider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

Route::get('two-factor-recovery', [UserController::class, 'recovery'])->middleware('guest');
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'verified']], function () {
    Route::get('text', [TextController::class, 'index'])->name('text.index');
    Route::post('text', [TextController::class, 'update'])->name('text.update');
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::match(['get', 'post'], 'logout', [UserController::class, 'logout'])->name('user.logout');
//    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('profile', ProfileController::class);
    Route::resource('wordpressbackup', WordpressBackupController::class);
    Route::post('/ajax-upload', [ImageCropController::class, 'ajaxImageUpload'])->name('ajaxImageUpload');
    Route::post('/crop-image', [ImageCropController::class, 'uploadCropImage'])->name('uploadCropImage');
    Route::get('/settings/advertisement', [AppSettingController::class, 'editAdvertisemntDetail']);
    Route::post('/settings/advertisement', [AppSettingController::class, 'updateAdvertisemntDetail'])->name("settings.advertisement");
    // Route::get('profile', [UserController::class, 'profile'])->name('profile')->middleware('password.confirm');
    Route::put('{id}/changepassword', [UserController::class, 'updatePassword'])->name('update-password');
    // Route::get('setting/sms', [AppSettingController::class, 'smsApi'])->name('smsApi.index')->middleware('password.confirm');
    // Route::post('setting/sms', [AppSettingController::class, 'smsApiSave'])->name('smsApi.store');
    // Route::put('setting/sms/{id}/update', [AppSettingController::class, 'smsApiUpdate'])->name('smsApi.update');
    Route::resource('setting', AppSettingController::class)->middleware('password.confirm');

    Route::resource('slider', SliderController::class);
    Route::get('application', [ApplicationController::class, 'index'])->name('application.index');
    Route::get('application/{id}', [ApplicationController::class, 'show'])->name('application.show');
    Route::post('download-application/{id}', [ApplicationController::class, 'download'])->name('application.download');

   // Route::resource('career', CareerController::class);

//    Route::get('career', CareerController::class, 'index')->name('career.index');
    Route::resource('feature', FeatureController::class);
    // Route::resource('compliment', ComplimentController::class);
    Route::resource('appnotice', AppNoticeController::class);
    Route::get('clear-log', [UserLogController::class, 'ClearAll'])->name('clear-log');
    Route::get('user-log', UserLogController::class)->name('user-log.index');
  //  Route::post('update', [MenuController::class, 'updateMenuOrder'])->name('update.menu');

  //  Route::get('additional-menu/{id}', [MenuController::class, 'additional_menu'])->name('menu.additonal');
  //  Route::resource('menu', MenuController::class)->middleware('password.confirm');
    Route::resource('categoryseedding', CategorySeederController::class);
    Route::resource('team', TeamController::class);
    Route::resource('horoscope', HoroscopeController::class);

    Route::resource('designations', DesignationController::class);
    Route::post('updateDesignation', [DesignationController::class, 'updateDesignationOrder'])->name('update.designation');
    Route::get('designation/original/order', [DesignationController::class, 'resetorder'])->name('designation.resetorder');

    Route::resource('medialibrary', MediaLibraryController::class);

    Route::post('slider/changeStatus', [SliderController::class, 'changeStatus'])->name('slider.changeStatus');
    Route::post('slider/changedisplayhome', [SliderController::class, 'changedisplayhome'])->name('slider.changedisplayhome');
    Route::post('client/changeStatus', [ClientController::class, 'changeStatus'])->name('client.changeStatus');
    Route::post('client/changedisplayhome', [ClientController::class, 'changedisplayhome'])->name('client.changedisplayhome');


    Route::post('container/changeStatus', [ContainerController::class, 'changeStatus'])->name('container.changeStatus');
    Route::post('blog/changeStatus', [BlogController::class, 'changeStatus'])->name('blog.changeStatus');
    Route::post('blog/changeStatus', [BlogController::class, 'changeStatus'])->name('blog.changeStatus');
    Route::post('blog/changedisplayhome', [BlogController::class, 'changedisplayhome'])->name('blog.changedisplayhome');
    Route::post('team/changeStatus', [TeamController::class, 'changeStatus'])->name('team.changeStatus');
    Route::post('faq/changeStatus', [FaqController::class, 'changeStatus'])->name('faq.changeStatus');
    Route::post('faq/changedisplayhome', [FaqController::class, 'changedisplayhome'])->name('faq.changedisplayhome');
    Route::post('video/changeStatus', [VideoController::class, 'changeStatus'])->name('video.changeStatus');
    Route::post('video/changedisplayhome', [VideoController::class, 'changedisplayhome'])->name('video.changedisplayhome');
    // Route::view('medias', 'admin.mediaLibrary.medialibrary')->name('admin.media.list');
    Route::resource('gallery', GalleryController::class);
    Route::resource('gallerycategory', GalleryCategoryController::class);
    Route::resource('notice', NoticeController::class);
    Route::post('notice/changeStatus', [NoticeController::class, 'changeStatus'])->name('notice.changeStatus');
    Route::post('gallery/changeStatus', [GalleryController::class, 'changeStatus'])->name('gallery.changeStatus');
    Route::post('blogcategory/changeStatus', [CategoryController::class, 'changeStatus'])->name('blogcategory.changeStatus');
    Route::post('gallery/removeimage', [GalleryController::class, 'removeimage'])->name('gallery.removeimage');

    Route::resource('information', InformationController::class);
    Route::post('service/changeStatus', [InformationController::class, 'changeStatus'])->name('service.changeStatus');
    Route::post('service/changedisplayhome', [InformationController::class, 'changedisplayhome'])->name('service.changedisplayhome');
    Route::resource('marketing', MarketingController::class);
    Route::post('marketing/changeStatus', [MarketingController::class, 'changeStatus'])->name('marketing.changeStatus');
    Route::post('marketing/changedisplayhome', [MarketingController::class, 'changedisplayhome'])->name('marketing.changedisplayhome');
    Route::resource('commit', CommitController::class);
    Route::post('commit/changeStatus', [CommitController::class, 'changeStatus'])->name('commit.changeStatus');
    Route::post('commit/changedisplayhome', [CommitController::class, 'changedisplayhome'])->name('commit.changedisplayhome');
    Route::resource('step', StepController::class);
    Route::post('step/changeStatus', [StepController::class, 'changeStatus'])->name('step.changeStatus');
    Route::post('step/changedisplayhome', [StepController::class, 'changedisplayhome'])->name('step.changedisplayhome');
    Route::resource('business', BusinessController::class);
    Route::post('business/changeStatus', [BusinessController::class, 'changeStatus'])->name('business.changeStatus');
    Route::resource('testimonial', TestimonialController::class);
    Route::post('testimonial/changeStatus',[TestimonialController::class,'changeStatus'])->name('testimonial.changeStatus');
    Route::post('testimonial/changedisplayhome',[TestimonialController::class,'changedisplayhome'])->name('testimonial.changedisplayhome');
    Route::resource('work', WorkController::class);
    Route::post('work/changeStatus',[WorkController::class,'changeStatus'])->name('work.changeStatus');
    Route::post('work/changedisplayhome',[WorkController::class,'changedisplayhome'])->name('work.changedisplayhome');
    Route::resource('satisfy', SatisfyController::class);
    Route::post('satisfy/changeStatus',[SatisfyController::class,'changeStatus'])->name('satisfy.changeStatus');
    Route::post('satisfy/changedisplayhome',[SatisfyController::class,'changedisplayhome'])->name('satisfy.changedisplayhome');
    Route::resource('plan', PlanController::class);
    Route::post('plan/changeStatus',[PlanController::class,'changeStatus'])->name('plan.changeStatus');
    Route::post('plan/changedisplayhome',[PlanController::class,'changedisplayhome'])->name('plan.changedisplayhome');
    Route::resource('website', WebsiteController::class);
    Route::post('website/changeStatus',[WebsiteController::class,'changeStatus'])->name('website.changeStatus');
    Route::post('website/changedisplayhome',[WebsiteController::class,'changedisplayhome'])->name('website.changedisplayhome');
    Route::resource('partner', PartnerController::class);
    Route::post('partner/changeStatus',[PartnerController::class,'changeStatus'])->name('partner.changeStatus');
    Route::post('partner/changedisplayhome',[PartnerController::class,'changedisplayhome'])->name('partner.changedisplayhome');
    Route::resource('touch', TouchController::class);

  //  Route::get('/welcome', [WelcomeController::class, 'index'])->name('welcome.index');
  //  Route::resource('welcome', WelcomeController::class);

    Route::resource('subscribe', SubscribeController::class);
  //  Route::get('subscribe', [SubscribeController::class, 'index'])->name('subscribe.index');

    Route::resource('detail', DetailController::class);
    Route::post('detail/changeStatus',[DetailController::class,'changeStatus'])->name('detail.changeStatus');

    Route::resource('team', TeamController::class);
    Route::post('team/changeStatus',[TeamController::class,'changeStatus'])->name('team.changeStatus');
    Route::post('team/changedisplayhome', [TeamController::class, 'changedisplayhome'])->name('team.changedisplayhome');


    // new routes for menu

    Route::resource('menu', MenuController::class);


});


// Route::post('subscribe', [SubscribeController::class, 'store'])->name('subscribe.store');


// new routes for menu

Route::post('updateMenu', [MenuController::class, 'updateMenuOrder'])->name('updateMenuOrder');



Route::get('/content/{slug}', [SliderController::class, 'sliderDetail'])->name('sliderDetail');


Route::group(['prefix' => 'rider', 'middleware' => ['auth']], function () {
    return 'hello';
});
Route::get('sitemap', [FrontEndController::class, 'sitemap'])->name('sitemap');

Route::get('feed', [FrontEndController::class, 'feed'])->name('feed');

// New Added code

// Route::get('details/display', [DetailController::class, 'display'])->name('front.display');
// Route::get('team/display', [TeamController::class, 'display'])->name('team.display');

// Route::get('services/details/{slug}', [DetailController::class, 'display'])->name('show_details');








