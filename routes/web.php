<?php

use App\Livewire\Admin\ManageInstansi;
use App\Livewire\B2BSolution;
use App\Livewire\Blog;
use App\Livewire\BlogShow;
use App\Livewire\Contact;
use App\Livewire\CourseList;
use App\Livewire\CoursePackageDetail;
use App\Livewire\DetailProgram;
use App\Livewire\HomePage;
use App\Livewire\ItemDetail;
use App\Livewire\KitDetail;
use App\Livewire\MitraInstansi;
use App\Livewire\PortfolioGallery;
use App\Livewire\Shop;
use App\Livewire\WorkshopDetail;
use App\Livewire\WorkshopPage;
use Illuminate\Support\Facades\Route;

// Route::view('/', 'welcome');
Route::get('/', HomePage::class)->name('home');

Route::get('/programs/{slug}', DetailProgram::class)->name('program.detail');
Route::get('/programs/{slug}/{course_slug}', CoursePackageDetail::class)->name('program.course.detail');

Route::get('/b2b-solution', B2BSolution::class)->name('b2b.solution');
Route::get('/mitra-instanasi', MitraInstansi::class)->name('b2b.institution');

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

Route::view('manage-settings', 'manage-settings')
    ->middleware(['auth', 'verified', 'admin'])
    ->name('manage.settings');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
