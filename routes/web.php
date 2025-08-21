<?php

use App\Models\Article;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RevisorController;
use App\Http\Controllers\GoogleAuthController;
use Laravel\Fortify\Http\Controllers\NewPasswordController;
use Laravel\Fortify\Http\Controllers\PasswordResetLinkController;


Route::get('/', [PublicController::class,'homepage'])->name('homepage');
Route::get('/about-us', [PublicController::class, 'about'])->name('about');
Route::get('/workwithus', [PublicController::class,  'work'])->name('work');
Route::get('/contact', [PublicController::class, 'contact'])->name('contact');
Route::get('/privacy' , [ PublicController::class , 'privacy'])->name('privacy');

Route::post('/mail/contactmail', [PublicController::class, 'contactmail'])->name('sendemail');


Route::post('/lingua/{lang}', [PublicController::class, 'setLanguage'])->name('setLocale');


Route::get('/revisor/index', [RevisorController::class, 'index'])->middleware('isRevisor')->name('revisor.index');
Route::patch('/accept/{article}', [RevisorController::class, 'accept'])->name('accept');
Route::patch('/reject/{article}', [RevisorController::class, 'reject'])->name('reject');

Route::get('/revisor/request', [RevisorController::class, 'becomeRevisor'] )->middleware('auth')->name('become.revisor');
Route::get('/make/revisor/{user}', [RevisorController::class, 'makeRevisor'])->name('make.revisor');


Route::get('/search/article', [PublicController::class, 'searchArticles'])->name('article.search');

Route::resource('article' , ArticleController::class);

Route::get('/category/{category}', [ArticleController::class, 'byCategory'])->name('byCategory');


Route::get('/login/google', [GoogleAuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/login/google/callback', [GoogleAuthController::class, 'handleGoogleCallback']);

Route::get('/my-articles', [ArticleController::class, 'myArticles'])->name('article.my')->middleware('auth');


/*carrello*/
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'view'])->name('cart.view');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

/*profilo utente */

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    
});


/*password dimenticataa*/
Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->middleware(['guest'])->name('password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->middleware(['guest'])->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->middleware(['guest'])->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])->middleware(['guest'])->name('password.update');


/*chatGpt*/

Route::match(['get', 'post'], '/chat', [ChatController::class, 'chat'])->name('chatGpt');
/*goback*/
Route::get('/revisor/rejected', [RevisorController::class, 'rejected'])->name('revisor.rejected');
Route::patch('/revisor/goback/{article}', [RevisorController::class, 'revertToRevision'])->name('revisor.goback');

