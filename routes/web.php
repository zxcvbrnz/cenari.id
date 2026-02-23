<?php

use App\Livewire\B2BSolution;
use App\Livewire\CourseList;
use App\Livewire\CoursePackageDetail;
use App\Livewire\DetailProgram;
use App\Livewire\HomePage;
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

Route::get('/portfolio-gallery', PortfolioGallery::class)->name('portfolio.gallery');

Route::get('/shop', Shop::class)->name('shop');

Route::get('/course-packages', CourseList::class)->name('course.packages');

Route::get('/workshops', WorkshopPage::class)->name('workshops');
Route::get('/workshops/{slug}', WorkshopDetail::class)->name('workshop.detail');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';