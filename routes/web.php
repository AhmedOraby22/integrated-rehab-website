<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminServiceHighlightController;
use App\Http\Controllers\AdminSiteSettingController;
use App\Http\Controllers\AdminTestimonialMediaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/locations', [PageController::class, 'locations'])->name('locations');
Route::get('/insurance', [PageController::class, 'insurance'])->name('insurance');

Route::prefix('testimonials')->name('testimonials.')->group(function () {
    Route::get('/reviews', [PageController::class, 'testimonialReviews'])->name('reviews');
    Route::get('/pictures', [PageController::class, 'testimonialPictures'])->name('pictures');
    Route::get('/videos', [PageController::class, 'testimonialVideos'])->name('videos');
    Route::get('/audio', [PageController::class, 'testimonialAudio'])->name('audio');
});

Route::get('/contact', [ContactController::class, 'create'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/csrf-token', function () {
    return response()->json(['token' => csrf_token()]);
})->name('csrf-token');
Route::post('/chat/message', [ChatController::class, 'store'])->name('chat.store');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
    Route::get('/register', [AdminAuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AdminAuthController::class, 'register'])->name('register.submit');

    Route::middleware('admin')->group(function () {
        Route::get('/', [AdminAuthController::class, 'dashboard'])->name('dashboard');
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

        Route::get('/service-highlights', [AdminServiceHighlightController::class, 'edit'])->name('service-highlights.edit');
        Route::put('/service-highlights', [AdminServiceHighlightController::class, 'update'])->name('service-highlights.update');

        Route::get('/site-settings', [AdminSiteSettingController::class, 'edit'])->name('site-settings.edit');
        Route::put('/site-settings', [AdminSiteSettingController::class, 'update'])->name('site-settings.update');

        Route::get('/testimonials/{type}', [AdminTestimonialMediaController::class, 'index'])
            ->whereIn('type', ['picture', 'video', 'audio'])
            ->name('testimonial-media.index');
        Route::post('/testimonials/{type}', [AdminTestimonialMediaController::class, 'store'])
            ->whereIn('type', ['picture', 'video', 'audio'])
            ->name('testimonial-media.store');
        Route::put('/testimonials/media/{media}', [AdminTestimonialMediaController::class, 'update'])
            ->name('testimonial-media.update');
        Route::delete('/testimonials/media/{media}', [AdminTestimonialMediaController::class, 'destroy'])
            ->name('testimonial-media.destroy');
    });
});
