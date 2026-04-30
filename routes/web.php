<?php

use App\Livewire\AddressManager;
use App\Livewire\Admin\ManageInstansi;
use App\Livewire\B2BSolution;
use App\Livewire\Blog;
use App\Livewire\BlogShow;
use App\Livewire\Contact;
use App\Livewire\CourseList;
use App\Livewire\CoursePackageDetail;
use App\Livewire\CourseRegister;
use App\Livewire\DetailProgram;
use App\Livewire\HomePage;
use App\Livewire\InstitutionPartner;
use App\Livewire\ItemDetail;
use App\Livewire\KitDetail;
use App\Livewire\LearningList;
use App\Livewire\MitraInstansi;
use App\Livewire\OrderIndex;
use App\Livewire\OrderShow;
use App\Livewire\PortfolioGallery;
use App\Livewire\SchoolPartner;
use App\Livewire\Shop;
use App\Livewire\UserProfile;
use App\Livewire\WorkshopDetail;
use App\Livewire\WorkshopPage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MidtransCallbackController;
use App\Livewire\PaymentFinish;

// Route::view('/', 'welcome');
Route::get('/', HomePage::class)->name('home');

Route::get('/programs/{slug}', DetailProgram::class)->name('program.detail');
Route::get('/programs/{slug}/{course_slug}', CoursePackageDetail::class)->name('program.course.detail');
Route::get('/programs/{slug}/{course_slug}/register', CourseRegister::class)->middleware(['auth', 'check.profile'])->name('program.course.detail.register');

Route::get('/b2b-solution', B2BSolution::class)->name('b2b.solution');
Route::get('/b2b-solution/form', SchoolPartner::class)->name('b2b.solution.form');

Route::get('/mitra-instanasi', MitraInstansi::class)->name('b2b.institution');
Route::get('/mitra-instanasi/form', InstitutionPartner::class)->name('b2b.institution.form');

Route::get('/portfolio-gallery', PortfolioGallery::class)->name('portfolio.gallery');

Route::get('/shop', Shop::class)->name('shop');
Route::get('/shop/kit/{id}', KitDetail::class)->name('kit.detail');
Route::get('/shop/item/{id}', ItemDetail::class)->name('item.detail');

Route::get('/blog', Blog::class)->name('blog.index');
Route::get('/blog/{slug}', BlogShow::class)->name('blog.show');

Route::get('/course-packages', CourseList::class)->name('course.packages');

Route::get('/workshops', WorkshopPage::class)->name('workshops');
Route::get('/workshops/{slug}', WorkshopDetail::class)->name('workshop.detail');

Route::get('/contact-us', Contact::class)->name('contact.us');

Route::get('/course-packages-user/list', LearningList::class)->name('course.packages.user.list')->middleware(['auth']);

Route::get('/profile/address', AddressManager::class)->name('profile.address')->middleware(['auth']);

Route::get('/shop/order', OrderIndex::class)->name('order.index')->middleware(['auth']);

Route::get('/shop/order/{id}', OrderShow::class)->name('order.show')->middleware(['auth']);

Route::get('/payment-finish', PaymentFinish::class)->name('payment.finish')->middleware(['auth']);

Route::post('/api/midtrans-callback', [MidtransCallbackController::class, 'handle']);

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified', 'admin'])
    ->name('dashboard');

Route::view('manage-program', 'manage-program')
    ->middleware(['auth', 'verified', 'admin'])
    ->name('manage.program');

Route::view('manage-portfolio', 'manage-portfolio')
    ->middleware(['auth', 'verified', 'admin'])
    ->name('manage.portfolio');

Route::view('manage-blog', 'manage-blog')
    ->middleware(['auth', 'verified', 'admin'])
    ->name('manage.blog');

Route::view('manage-workshop', 'manage-workshop')
    ->middleware(['auth', 'verified', 'admin'])
    ->name('manage.workshop');

Route::view('manage-agenda', 'manage-agenda')
    ->middleware(['auth', 'verified', 'admin'])
    ->name('manage.agenda');

Route::view('manage-shop', 'manage-shop')
    ->middleware(['auth', 'verified', 'admin'])
    ->name('manage.shop');

Route::view('manage-enrollment', 'manage-enrollment')
    ->middleware(['auth', 'verified', 'admin'])
    ->name('manage.enrollment');

Route::view('manage-settings', 'manage-settings')
    ->middleware(['auth', 'verified', 'admin'])
    ->name('manage.settings');

// if (Auth::user()->role == 'admin') {
//     Route::view('profile', 'profile')
//         ->middleware(['auth'])
//         ->name('profile');
// } else {
//     Route::get('/profile', UserProfile::class)->name('user-profile');
// }

// web.php
Route::get('/profile', function () {
    if (Auth::user()->role === 'admin') {
        return view('profile'); // View admin
    }
    return app()->make(UserProfile::class)(); // Panggil Livewire Component
})->middleware(['auth'])->name('profile');

require __DIR__ . '/auth.php';