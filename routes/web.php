<?php
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ImageCategoryController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\LeadNewsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/dashboard', function () {
    return view('backend.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('subcategories', SubCategoryController::class);
    Route::resource('news', NewsController::class);
    Route::resource('location', LocationController::class);
    Route::resource('image-category', ImageCategoryController::class);
    Route::get('Top-lead-news', [LeadNewsController::class, 'TopLead'])->name('Top-lead-news');
    Route::get('lead-news', [LeadNewsController::class, 'lead'])->name('lead-news');
});

 Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
     \UniSharp\LaravelFilemanager\Lfm::routes();
 });








require __DIR__.'/auth.php';
