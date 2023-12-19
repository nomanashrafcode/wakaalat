<?php



use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\ContactController;
use App\Http\Controllers\Client\AppointmentController;
use App\Http\Controllers\Client\ProfileController;
use App\Http\Controllers\Client\PaymentController;
use App\Http\Controllers\Client\MessageController;
use App\Http\Controllers\Client\MeetingController;
use App\Http\Controllers\Client\PaypalController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;




use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\Auth\AdminForgotPasswordController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BlogCommentController;
use App\Http\Controllers\Admin\FeatureController;


use App\Http\Controllers\Admin\HomeSectionController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ServiceFaqController;
use App\Http\Controllers\Admin\ServiceVideoController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\DepartmentFaqController;
use App\Http\Controllers\Admin\DepartmentVideoController;




use App\Http\Controllers\Admin\FaqCategoryController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\LawyerController;
use App\Http\Controllers\Admin\ConditionPrivacyController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\ContactInformationController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\WorkController;
use App\Http\Controllers\Admin\WorkFaqController;
use App\Http\Controllers\Admin\DayController;
use App\Http\Controllers\Admin\PaymentAccountController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\ManagePageController;
use App\Http\Controllers\Admin\SliderContentController;
use App\Http\Controllers\Admin\EmailConfigurationController;
use App\Http\Controllers\Admin\SubscriberContentController;
use App\Http\Controllers\Admin\SubscriberController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\AdminAppointmentController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\CustomePageController;
use App\Http\Controllers\Admin\OverviewController;
use App\Http\Controllers\Admin\AdminPaymentController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\NavbarController;
use App\Http\Controllers\Admin\TextController;
use App\Http\Controllers\Admin\BannerImageController;
use App\Http\Controllers\Admin\ValidationTextController;
use App\Http\Controllers\Admin\AdminMeetingController;
use App\Http\Controllers\Admin\CustomPaginatorController;


use App\Http\Controllers\Lawyer\Auth\LawyerLoginController;
use App\Http\Controllers\Lawyer\Auth\LawyerForgotPasswordController;
use App\Http\Controllers\Lawyer\LawyerProfileController;
use App\Http\Controllers\Lawyer\LawyerDashboardController;
use App\Http\Controllers\Lawyer\LeaveController;
use App\Http\Controllers\Lawyer\LawyerAppointmentController;
use App\Http\Controllers\Lawyer\LawyerMessageController;
use App\Http\Controllers\Lawyer\LawyerMeetingController;
use App\Http\Controllers\Lawyer\ZoomCredentialController;
use App\Http\Controllers\Lawyer\LawyerScheduleController;


use Illuminate\Support\Facades\Route;





Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/about-us',[HomeController::class,'aboutUs']);
Route::get('/faq',[HomeController::class,'Faq']);
Route::get('/blog',[HomeController::class,'blog']);
Route::get('/blog-details/{slug}',[HomeController::class,'blogDetails']);
Route::get('/blog-category/{slug}',[HomeController::class,'blogCategory']);
Route::post('comment-store',[HomeController::class,'commentStore']);
Route::get('/contact-us',[HomeController::class,'contactUs']);
Route::get('/lawyers',[HomeController::class,'lawyer']);
Route::get('/lawyer-details/{slug}',[HomeController::class,'lawyerDetails']);
Route::get('/search-lawyer',[HomeController::class,'searchLawyer']);

Route::get('/department',[HomeController::class,'department']);
Route::get('/department-details/{slug}',[HomeController::class,'departmentDetails']);
Route::get('/service',[HomeController::class,'service']);
Route::get('/service-details/{slug}',[HomeController::class,'serviceDetails']);
Route::get('/testimonial',[HomeController::class,'testimonial']);
Route::get('/terms-condition',[HomeController::class,'termsCondition']);
Route::get('/privacy-policy',[HomeController::class,'privacyPolicy']);
Route::post('contact-message',[ContactController::class,'message']);
Route::get('custom-page/{slug}',[HomeController::class,'customePage']);
// ajax request for appointment
Route::get('get-appointment/',[AppointmentController::class,'getAppointment']);
Route::get('get-department-doctor/{id}',[AppointmentController::class,'getDepartmentLawyer']);
//appointment add to cart
Route::post('create-appointment',[AppointmentController::class,'createAppointment']);
Route::get('remove-appointment/{id}',[AppointmentController::class,'removeAppointment']);
// Subscribe us
Route::post('subscribe-us',[HomeController::class,'subscribeUs']);
Route::get('subscription-verify/{token}',[HomeController::class,'subscriptionVerify'])->name('subscription.verify');




//Patient profile section
Route::group(['as'=> 'client.', 'prefix' => 'client'],function (){
    Route::get('dashboard',[ProfileController::class,'dashboard'])->name('dashboard');
    Route::get('account',[ProfileController::class,'account'])->name('account');
    Route::get('appointment',[ProfileController::class,'appointments'])->name('appointment');
    Route::get('show-appointment/{id}',[ProfileController::class,'showAppointment'])->name('show-appointment');
    Route::get('download-doc/{file}',[ProfileController::class,'downloadFile'])->name('download-doc');
    Route::get('order',[ProfileController::class,'orders'])->name('order');
    Route::post('update-profile',[ProfileController::class,'updateProfile'])->name('update.profile');
    Route::get('change-password',[ProfileController::class,'changePassword'])->name('change.password');
    Route::post('store-change-password',[ProfileController::class,'storePassword'])->name('update.password');


    Route::get('show-order/{id}',[ProfileController::class,'showOrder'])->name('show-order');



    Route::get('payment',[PaymentController::class,'payment'])->name('payment');
    Route::post('stripe-payment',[PaymentController::class,'stripePayment'])->name('stripe.payment');
    Route::post('bank-payment',[PaymentController::class,'bankPayment'])->name('bank.payment');
    Route::post('razorpay-payment',[PaymentController::class,'razorPay'])->name('razorpay-payment');
    Route::post('flutterwave-payment',[PaymentController::class,'flutterwave'])->name('flutterwave-payment');

    Route::post('store-paypal',[PaypalController::class,'store']);
    Route::get('paypal-payment-success',[PaypalController::class,'paymentSuccess']);
    Route::get('paypal-payment-cancled',[PaypalController::class,'paymentCancled']);

    Route::post('paystack-payment',[PaymentController::class,'paystackPayment'])->name('paystack-payment');
    Route::get('mollie-payment/',[PaymentController::class,'molliePayment'])->name('mollie-payment');
    Route::get('/mollie-payment-success', [PaymentController::class, 'molliePaymentSuccess'])->name('mollie-payment-success');
    Route::get('/pay-with-instamojo', [PaymentController::class, 'payWithInstamojo'])->name('pay-with-instamojo');
    Route::get('/instamojo-response', [PaymentController::class, 'instamojoResponse'])->name('instamojo-response');

    Route::post('/pay-with-paymongo', [PaymentController::class, 'payWithPaymongo'])->name('pay-with-paymongo');
    Route::get('/pay-with-grab-pay', [PaymentController::class, 'payWithPaymongoGrabPay'])->name('pay-with-grab-pay');
    Route::get('/pay-with-gcash', [PaymentController::class, 'payWithPaymongoGcash'])->name('pay-with-gcash');
    Route::get('/paymongo-payment-success', [PaymentController::class, 'paymongoPaymentSuccess'])->name('paymongo-payment-success');
    Route::get('/paymongo-payment-cancled', [PaymentController::class, 'paymongoPaymentCancled'])->name('paymongo-payment-cancled');



    Route::get('message',[MessageController::class,'index'])->name('message');
    route::get('message-box/{slug}',[MessageController::class,'messagebox'])->name('message.box');
    route::get('get-message/{id}',[MessageController::class,'getmessage'])->name('get.message');
    route::get('send-message',[MessageController::class,'sendmessage'])->name('send.message');


    Route::get('/meeting-history', [MeetingController::class,'meetingHistory'])->name('meeting-history');
    Route::get('/upcomming-meeting', [MeetingController::class,'upCommingMeeting'])->name('upcomming-meeting');

});


// patient custom auth route
Route::get('register',[RegisterController::class,'userRegisterPage'])->name('register');
Route::post('register',[RegisterController::class,'storeRegister'])->name('register');
Route::get('user-verify/{token}',[RegisterController::class,'userVerify'])->name('user.verify');
Route::get('login',[LoginController::class,'userLoginPage'])->name('login');
Route::post('login',[LoginController::class,'storeLogin'])->name('login');
Route::get('logout',[LoginController::class,'userLogout'])->name('logout');
Route::get('forget-password',[ForgotPasswordController::class,'forgetPassword'])->name('forget.password');
Route::post('send-forget-password',[ForgotPasswordController::class,'sendForgetEmail'])->name('send.forget.password');
Route::get('reset-password/{token}',[ForgotPasswordController::class,'resetPassword'])->name('reset.password');
Route::post('store-reset-password/{token}',[ForgotPasswordController::class,'storeResetData'])->name('store.reset.password');


// admin routes
Route::group(['as'=> 'admin.', 'prefix' => 'admin'],function (){
    // login route
    Route::get('login',[AdminLoginController::class,'adminLoginForm'])->name('login');
    Route::post('login',[AdminLoginController::class,'storeLoginInfo'])->name('login');
    Route::post('register',[AdminLoginController::class,'register'])->name('register');
    Route::get('/logout',[AdminLoginController::class,'adminLogout'])->name('logout');
    Route::get('forget-password',[AdminForgotPasswordController::class,'forgetPassword'])->name('forget.password');
    Route::post('send-forget-password',[AdminForgotPasswordController::class,'sendForgetEmail'])->name('send.forget.password');
    Route::get('reset-password/{token}',[AdminForgotPasswordController::class,'resetPassword'])->name('reset.password');
    Route::post('store-reset-password/{token}',[AdminForgotPasswordController::class,'storeResetData'])->name('store.reset.password');

    // manage admin profile
    Route::get('profile',[AdminProfileController::class,'profile'])->name('profile');
    Route::post('update-profile',[AdminProfileController::class,'updateProfile'])->name('update.profile');

    //admin Dashboard
    Route::get('/',[DashboardController::class,'index'])->name('dashboard');
    Route::get('dashboard',[DashboardController::class,'index'])->name('dashboard');

    // manage location and status
    Route::resource('location', LocationController::class);
    Route::get('location-status/{id}',[LocationController::class,'changeStatus'])->name('location.status');

    // manage blog category
    Route::resource('blog-category', BlogCategoryController::class);
    Route::get('blog-category-status/{id}',[BlogCategoryController::class,'changeStatus'])->name('blog.category.status');

    // manage blog,images,status
    Route::resource('blog', BlogController::class);
    Route::get('blog-status/{id}',[BlogController::class,'changeStatus'])->name('blog.status');
    // Blog comment
    Route::get('blog-comment',[BlogCommentController::class,'allComments'])->name('blog-comment');
    Route::get('delete-blog-comment/{id}',[BlogCommentController::class,'deleteComment'])->name('delete.blog.comment');
    Route::get('blog-comment-status/{id}',[BlogCommentController::class,'changeStatus'])->name('blog.comment.status');


    // manage feature and status
    Route::resource('feature', FeatureController::class);
    Route::get('feature-status/{id}',[FeatureController::class,'changeStatus'])->name('feature.status');

    Route::resource('home-section', HomeSectionController::class);
    Route::get('home-section-status/{id}',[HomeSectionController::class,'changeStatus'])->name('home.section.status');

    // service,status,video, faq and image section
    Route::resource('service', ServiceController::class);
    Route::get('service-status/{id}',[ServiceController::class,'changeStatus'])->name('service.status');
    Route::get('/faq-by-service/{serviceId}',[ServiceFaqController::class,'faqByService'])->name('faq.by.service');
    Route::resource('faq-service', ServiceFaqController::class);
    Route::get('service-faq-status/{id}',[ServiceFaqController::class,'changeStatus'])->name('service.faq.status');
    Route::resource('service-video', ServiceVideoController::class);
    Route::get('service-video-status/{id}',[ServiceVideoController::class,'changeStatus'])->name('service.video.status');
    Route::get('service-images/{serviceId}',[ServiceController::class,'images'])->name('service.images');
    Route::get('delete-service-image/{imageId}',[ServiceController::class,'deleteImage'])->name('delete.service.image');
    Route::post('service-image-store/{serviceId}',[ServiceController::class,'storeImage'])->name('service.image.store');

    // department, faq, video and image
    Route::resource('department', DepartmentController::class);
    Route::get('department-status/{id}',[DepartmentController::class,'changeStatus'])->name('department.status');
    Route::get('/faq-by-department/{departmentId}',[DepartmentFaqController::class,'faqByDepartment'])->name('faq.by.department');
    Route::resource('faq-department', DepartmentFaqController::class);
    Route::get('department-faq-status/{id}',[DepartmentFaqController::class,'changeStatus'])->name('department.faq.status');
    Route::resource('department-video',DepartmentVideoController::class);
    Route::get('department-video-status/{id}',[DepartmentVideoController::class,'changeStatus'])->name('department.video.status');
    Route::get('department-images/{departmentId}',[DepartmentController::class,'images'])->name('department.images');
    Route::post('department-image-store/{departmentId}',[DepartmentController::class,'storeImage'])->name('department.image.store');
    Route::post('department-thumbnail/{departmentId}',[DepartmentController::class,'thumbnailImage'])->name('department.thumbnail.image');
    Route::get('delete-department-thumbnail/{departmentId}',[DepartmentController::class,'deleteThumbnail'])->name('delete.department.thumbnail');
    Route::get('delete-department-image/{imageId}',[DepartmentController::class,'deleteImage'])->name('delete.department.image');


    // Faq category and faq
    Route::resource('faq-category', FaqCategoryController::class);
    Route::get('faq-category-status/{id}',[FaqCategoryController::class,'changeStatus'])->name('faq.category.status');
    Route::get('faq-by-category/{slug}',[FaqController::class,'index'])->name('faq.category');
    Route::resource('faq',FaqController::class);
    Route::get('faq-status/{id}',[FaqController::class,'changeStatus'])->name('faq.status');

    // manage testimonial and status
    Route::resource('testimonial', TestimonialController::class);
    Route::get('testimonial-status/{id}',[TestimonialController::class,'changeStatus'])->name('testimonial.status');

    // manage about section
    Route::resource('about', AboutController::class);
    Route::post('update-about/{id}', [AboutController::class,'updateAbout'])->name('update.about.section');
    Route::post('update-mission/{id}', [AboutController::class,'updateMission'])->name('update.mission.section');
    Route::post('update-vision/{id}', [AboutController::class,'updateVision'])->name('update.vision.section');


    Route::post('store-about-image/{id}', [AboutController::class,'storeImage'])->name('store.about.image');


    // manage Doctor
    Route::resource('lawyer', LawyerController::class);
    Route::get('lawyer-status/{id}',[LawyerController::class,'changeStatus'])->name('lawyer.status');

    // Terms-condition and privacy-policy
    Route::resource('terms-privacy', ConditionPrivacyController::class);

    // manage contact us section
    Route::resource('contact-us', ContactUsController::class);
    Route::get('contact-message',[ContactUsController::class,'message'])->name('contact.message');
    Route::resource('contact-information',ContactInformationController::class);

    // manage slider
    Route::resource('slider', SliderController::class);
    Route::get('slider-status/{id}',[SliderController::class,'changeStatus'])->name('slider.status');
    Route::get('slider-content',[SliderContentController::class,'index'])->name('slider.content');
    Route::post('slider-content-update/{id}',[SliderContentController::class,'update'])->name('slider.content.update');



    // manage Schedule
    Route::resource('schedule',ScheduleController::class);
    Route::get('schedule-status/{id}',[ScheduleController::class,'changeStatus'])->name('schedule.status');

    // manage work section
    Route::resource('work', WorkController::class);
    Route::resource('work-faq', WorkFaqController::class);
    Route::get('work-faq-status/{id}', [WorkFaqController::class,'changeStatus'])->name('work.faq.status');


    // manage day
    Route::resource('day',DayController::class);

    // payment Account information
    Route::resource('payment-account',PaymentAccountController::class);
    Route::post('razorpay-update/{id}',[PaymentAccountController::class,'razorpayUpdate'])->name('razorpay-update');
    Route::post('stripe-update/{id}',[PaymentAccountController::class,'stripeUpdate'])->name('stripe-update');
    Route::post('bank-update/{id}',[PaymentAccountController::class,'bankUpdate'])->name('bank-update');
    Route::post('flutterwave-update/{id}',[PaymentAccountController::class,'flutterwaveUpdate'])->name('flutterwave-update');
    Route::post('paystack-update/{id}',[PaymentAccountController::class,'paystackUpdate'])->name('paystack-update');
    Route::post('mollie-update/{id}',[PaymentAccountController::class,'updateMollie'])->name('mollie-update');
    Route::post('instamojo-update/{id}',[PaymentAccountController::class,'updateInstamojo'])->name('instamojo-update');
    Route::post('paymongo-update/{id}',[PaymentAccountController::class,'updateIPaymongo'])->name('paymongo-update');

    // setting
    Route::resource('settings',SettingsController::class);
    Route::get('comment-setting',[SettingsController::class,'blogCommentSetting'])->name('comment.setting');
    Route::post('update-comment-setting',[SettingsController::class,'updateCommentSetting'])->name('update.comment.setting');
    Route::get('cookie-consent-setting',[SettingsController::class,'cookieConsentSetting'])->name('cookie.consent.setting');
    Route::post('update-cookie-consent',[SettingsController::class,'updateCookieConsentSetting'])->name('update.cookie.consent.setting');
    Route::get('captcha-setting',[SettingsController::class,'captchaSetting'])->name('captcha.setting');
    Route::post('update-captcha-setting',[SettingsController::class,'updateCaptchaSetting'])->name('update.captcha.setting');

    Route::get('livechat-setting',[SettingsController::class,'livechatSetting'])->name('livechat.setting');
    Route::post('update-livechat-setting',[SettingsController::class,'updateLivechatSetting'])->name('update.livechat.setting');

    Route::get('preloader-setting',[SettingsController::class,'preloaderSetting'])->name('preloader.setting');
    Route::post('preloader-update/{id}',[SettingsController::class,'preloaderUpdate'])->name('preloader.update');

    Route::get('database-generate',[SettingsController::class,'database_generate'])->name('database-generate');
    Route::get('database-regenerate',[SettingsController::class,'database_regenerate'])->name('database-regenerate');

    Route::get('google-analytic-setting',[SettingsController::class,'googleAnalytic'])->name('google.analytic.setting');
    Route::post('google-analytic-update',[SettingsController::class,'googleAnalyticUpdate'])->name('google.analytic.update');
    Route::get('theme-color',[SettingsController::class,'themeColor'])->name('theme-color');
    Route::post('theme-color-update',[SettingsController::class,'themeColorUpdate'])->name('theme-color.update');

    Route::get('email-template',[SettingsController::class,'emailTemplate'])->name('email.template');
    Route::get('email-template-edit/{id}',[SettingsController::class,'editEmail'])->name('email-edit');
    Route::post('email-template-update/{id}',[SettingsController::class,'updateEmail'])->name('email.update');



    Route::get('email-configuration',[EmailConfigurationController::class,'index'])->name('email-configuration');
    Route::post('update-email-configuraion',[EmailConfigurationController::class,'update'])->name('update-email-configuraion');



    // clear database
    Route::get('clear-database',[SettingsController::class,'clearDatabase'])->name('clear.database');
    Route::get('clear-all',[SettingsController::class,'destroyDatabase'])->name('clear.all.data');




    //  Manage Pages
    Route::get('home-page',[ManagePageController::class,'homePage'])->name('home.page');
    Route::post('home-page-update',[ManagePageController::class,'homePageUpdate'])->name('home.page.update');
    Route::get('about-us-page',[ManagePageController::class,'aboutUs'])->name('aboutus.page');
    Route::post('about-us-page-update',[ManagePageController::class,'aboutUsUpdate'])->name('aboutus.page.update');
    Route::get('lawyer-page',[ManagePageController::class,'lawyer'])->name('lawyer-page');
    Route::post('lawyer-page-update',[ManagePageController::class,'lawyerUpdate'])->name('lawyer.page.update');
    Route::get('department-page',[ManagePageController::class,'department'])->name('department-page');
    Route::post('department-page-update',[ManagePageController::class,'departmentUpdate'])->name('department.page.update');
    Route::get('service-page',[ManagePageController::class,'service'])->name('service-page');
    Route::post('service-page-update',[ManagePageController::class,'serviceUpdate'])->name('service.page.update');
    Route::get('testimonial-page',[ManagePageController::class,'testimonial'])->name('testimonial.page');
    Route::post('testimonial-page-update',[ManagePageController::class,'testimonialUpdate'])->name('testimonial.page.update');
    Route::get('faq-page',[ManagePageController::class,'faq'])->name('faq.page');
    Route::post('faq-page-update',[ManagePageController::class,'faqUpdate'])->name('faq.page.update');
    Route::get('blog-page',[ManagePageController::class,'blog'])->name('blog.page');
    Route::post('blog-page-update',[ManagePageController::class,'blogUpdate'])->name('blog.page.update');
    Route::get('contactus-page',[ManagePageController::class,'contactUs'])->name('contactus.page');
    Route::post('contactus-page-update',[ManagePageController::class,'contactUsUpdate'])->name('contactus.page.update');

    Route::get('subscribe-content',[SubscriberContentController::class,'index'])->name('subscriber.content');
    Route::post('subscribe-content-update/{id}',[SubscriberContentController::class,'Update'])->name('subscriber.content.update');
    Route::get('subscriber',[SubscriberController::class,'index'])->name('subscriber');
    Route::get('subscriber-delete/{id}',[SubscriberController::class,'delete'])->name('subscriber.delete');
    Route::get('subscriber-email',[SubscriberController::class,'emailTemplate'])->name('subscriber.email');
    Route::post('send-subscriber-email',[SubscriberController::class,'sendMail'])->name('send.subscriber.mail');


    // manage partner
    Route::resource('partner', PartnerController::class);
    Route::get('partner-status/{id}', [PartnerController::class,'changeStatus'])->name('partner.status');

    // order
    Route::get('pending-order',[OrderController::class,'pendingOrder'])->name('pending.order');
    Route::get('show-order/{id}',[OrderController::class,'showOrder'])->name('show.order');
    Route::get('all-order',[OrderController::class,'allOrder'])->name('all.order');
    Route::get('payment-accept/{id}',[OrderController::class,'paymentAccept'])->name('payment.accept');
    Route::get('cancle-order/{id}',[OrderController::class,'cancleOrder'])->name('cancle.order');
    Route::get('cancle-order-payment',[OrderController::class,'cancleOrderPayment'])->name('canceled.order.payment');

    // appointment
    Route::get('all-appointment',[AdminAppointmentController::class,'allAppointment'])->name('all.appointment');
    Route::get('appointment-show/{id}',[AdminAppointmentController::class,'show'])->name('appointment-show');
    Route::get('download-doc/{file}',[AdminAppointmentController::class,'downloadFile'])->name('download-doc');

    // patients
    Route::get('clients',[ClientController::class,'index'])->name('clients');
    Route::get('client-show/{id}',[ClientController::class,'show'])->name('client.show');
    Route::get('client-search',[ClientController::class,'search'])->name('client.search');
    Route::get('client-status/{id}',[ClientController::class,'changeStatus'])->name('client.status');
    Route::get('client-delete/{id}',[ClientController::class,'delete'])->name('client.delete');


    // custome page
    Route::resource('custom-page',CustomePageController::class);
    Route::get('custom-page-status/{id}', [CustomePageController::class,'changeStatus'])->name('custom.page.status');

    // overview
    Route::resource('overview',OverviewController::class);
    Route::get('overview-status/{id}', [OverviewController::class,'changeStatus'])->name('overview.status');

     // manage payment
     Route::get('payment',[AdminPaymentController::class,'payment'])->name('payment');
     Route::get('payment-search',[AdminPaymentController::class,'paymentSearch'])->name('payment.search');

    //  admin
    Route::resource('admin-list',AdminController::class);
    Route::get('admin-status/{id}', [AdminController::class,'changeStatus'])->name('admin.status');

    // check notification
    Route::get('view-order-notify',[OrderController::class,'viewOrderNotify'])->name('view.order.notify');
    Route::get('view-message-notify',[OrderController::class,'viewMessageNotify'])->name('view.message.notify');


    Route::get('setup-navbar',[NavbarController::class,'index'])->name('setup.navbar');
    Route::post('update-navbar',[NavbarController::class,'update'])->name('update.navigation');
    Route::get('setup-text',[TextController::class,'index'])->name('setup.text');
    Route::post('update-text',[TextController::class,'update'])->name('update.text');

    // manage banner image
    Route::get('banner-image',[BannerImageController::class,'index'])->name('banner.image');
    Route::post('about-banner',[BannerImageController::class,'aboutBanner'])->name('about.banner');
    Route::post('about-us-bg',[BannerImageController::class,'aboutUsBg'])->name('about_us_bg');
    Route::post('subscribe-us-banner',[BannerImageController::class,'subscribe'])->name('subscribe.us.banner');
    Route::post('doctor-banner',[BannerImageController::class,'doctor'])->name('doctor.banner');
    Route::post('service-banner',[BannerImageController::class,'service'])->name('service.banner');
    Route::post('department-banner',[BannerImageController::class,'department'])->name('department.banner');
    Route::post('testimonial-banner',[BannerImageController::class,'testimonial'])->name('testimonial.banner');
    Route::post('faq-banner',[BannerImageController::class,'faq'])->name('faq.banner');
    Route::post('contact-banner',[BannerImageController::class,'contact'])->name('contact.banner');
    Route::post('profile-banner',[BannerImageController::class,'profile'])->name('profile.banner');
    Route::post('login-banner',[BannerImageController::class,'login'])->name('login.banner');
    Route::post('payment-banner',[BannerImageController::class,'payment'])->name('payment.banner');
    Route::post('overview-banner',[BannerImageController::class,'overview'])->name('overview.banner');
    Route::post('custom_page-banner',[BannerImageController::class,'custom_page'])->name('custom_page.banner');
    Route::post('blog-banner',[BannerImageController::class,'blog'])->name('blog.banner');
    Route::post('admin_login-banner',[BannerImageController::class,'admin_login'])->name('admin_login.banner');
    Route::post('doctor_login-banner',[BannerImageController::class,'doctor_login'])->name('doctor_login.banner');
    Route::post('privacy_and_policy-banner',[BannerImageController::class,'privacy_and_policy'])->name('privacy_and_policy.banner');
    Route::post('terms_and_condition-banner',[BannerImageController::class,'terms_and_condition'])->name('terms_and_condition.banner');

    Route::post('default-profile',[BannerImageController::class,'defaultProfile'])->name('default.profile');
    Route::get('login-image',[BannerImageController::class,'loginImageIndex'])->name('login.image');
    Route::get('profile-image',[BannerImageController::class,'profileImageIndex'])->name('profile.image');


    Route::get('validation-errors',[ValidationTextController::class,'index'])->name('validation.errors');
    Route::post('update-validation-text',[ValidationTextController::class,'update'])->name('update.validation.text');

    Route::get('notification-text',[ValidationTextController::class,'notification'])->name('notification.text');
    Route::post('update-notification-text',[ValidationTextController::class,'updateNotification'])->name('update.notification.text');

    Route::get('/zoom-meeting', [AdminMeetingController::class,'meetingHistory'])->name('zoom-meeting');


    Route::resource('pagination', CustomPaginatorController::class);
    Route::post('pagination-update', [CustomPaginatorController::class,'update'])->name('pagination-update');

});


// doctor routes
Route::group(['as'=> 'lawyer.', 'prefix' => 'lawyer'],function (){
    // login route
    Route::get('login',[LawyerLoginController::class,'lawyerLoginForm']);
    Route::post('login',[LawyerLoginController::class,'storeLoginInfo'])->name('login');
    Route::get('/logout',[LawyerLoginController::class,'lawyerLogout'])->name('logout');
    Route::get('forget-password',[LawyerForgotPasswordController::class,'forgetPassword'])->name('forget.password');
    Route::post('send-forget-password',[LawyerForgotPasswordController::class,'sendForgetEmail'])->name('send.forget.password');
    Route::get('reset-password/{token}',[LawyerForgotPasswordController::class,'resetPassword'])->name('reset.password');
    Route::post('store-reset-password/{token}',[LawyerForgotPasswordController::class,'storeResetData'])->name('store.reset.password');


    // manage lawyer profile
    Route::get('profile',[LawyerProfileController::class,'profile'])->name('profile');
    Route::post('update-profile',[LawyerProfileController::class,'updateProfile'])->name('update.profile');
    Route::post('change-password',[LawyerProfileController::class,'changePassword'])->name('change.password');
    Route::post('update-prescription',[LawyerProfileController::class,'prescriptionContactUpdate'])->name('update.prescription');

    // dashbaord
    Route::get('/',[LawyerDashboardController::class,'index'])->name('dashboard');
    Route::get('dashboard',[LawyerDashboardController::class,'index'])->name('dashboard');
    Route::resource('leave', LeaveController::class);

    Route::get('today-appointment',[LawyerAppointmentController::class,'todayAppointment'])->name('today.appointment');
    Route::get('new-appointment',[LawyerAppointmentController::class,'newAppointment'])->name('new.appointment');
    Route::get('all-appointment',[LawyerAppointmentController::class,'allAppointment'])->name('all.appointment');
    Route::get('meet/{id}',[LawyerAppointmentController::class,'meet'])->name('meet');
    Route::post('meeting-store/{id}',[LawyerAppointmentController::class,'meetingStore'])->name('meeting-store');
    Route::get('already-meet/{id}',[LawyerAppointmentController::class,'alreadyMeet'])->name('already-meet');
    Route::get('edit-prescription/{id}',[LawyerAppointmentController::class,'editPresciption'])->name('edit-prescription');
    Route::post('prescription-update/{id}',[LawyerAppointmentController::class,'updatePresciption'])->name('prescription-update');
    Route::get('prescription-doc-delete/{id}',[LawyerAppointmentController::class,'deleteDoc'])->name('prescription-doc-delete');
    Route::get('download-doc/{file}',[LawyerAppointmentController::class,'downloadFile'])->name('download-doc');


    // doctor payment
    Route::get('payment-history',[LawyerAppointmentController::class,'paymentHistory'])->name('payment.history');
    Route::get('search-payment-history',[LawyerAppointmentController::class,'searchPaymentHistory'])->name('search.payment.history');
    // doctor schedule
    Route::get('schedule',[LawyerScheduleController::class,'index'])->name('schedule');



    // search-doctor-appointment using ajax
    Route::get('search-appointment',[LawyerAppointmentController::class,'searchAppointment'])->name('search.appointment');
    Route::get('search-particular-appointment',[LawyerAppointmentController::class,'searchParticulerAppointment'])->name('search.particuler.appointment');


    Route::get('message',[LawyerMessageController::class,'index'])->name('message.index');
    Route::get('message-box/{id}',[LawyerMessageController::class,'messagebox'])->name('message.box');
    Route::get('get-message/{id}',[LawyerMessageController::class,'getmessage'])->name('get.message');
    Route::get('send-message',[LawyerMessageController::class,'sendmessage'])->name('send.message');



    Route::get('/zoom-meetings', [LawyerMeetingController::class,'index'])->name('zoom-meetings');
    Route::get('/create-zoom-meeting', [LawyerMeetingController::class,'createForm'])->name('create-zoom-meeting');
    Route::post('/store-zoom-meeting', [LawyerMeetingController::class,'store'])->name('store-zoom-meeting');
    Route::get('/edit-zoom-meeting/{id}', [LawyerMeetingController::class,'editForm'])->name('edit-zoom-meeting');
    Route::post('/update-zoom-meeting/{id}', [LawyerMeetingController::class,'updateMeeting'])->name('update-zoom-meeting');
    Route::get('/delete-zoom-meeting/{id}', [LawyerMeetingController::class,'destroy'])->name('delete-zoom-meeting');
    Route::get('/callback-zoom-meeting', [LawyerMeetingController::class,'callback_zoom_meeting'])->name('callback-zoom-meeting');


    Route::get('/zoom', [LawyerMeetingController::class,'store'])->name('zoom');

    Route::get('/zoom-credential', [ZoomCredentialController::class,'index'])->name('zoom-credential');
    Route::post('/store-zoom-credential', [ZoomCredentialController::class,'store'])->name('store-zoom-credential');
    Route::post('/update-zoom-credential/{id}',[ZoomCredentialController::class,'update'])->name('update-zoom-credential');


    Route::get('/meeting-history', [LawyerMeetingController::class,'meetingHistory'])->name('meeting-history');
    Route::get('/upcomming-meeting', [LawyerMeetingController::class,'upCommingMeeting'])->name('upcomming-meeting');

});
