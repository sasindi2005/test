<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Main rescue team page
Route::get('/rescue-team', function () {
    return view('rescue-team');
});

// Rescue team section routes
Route::prefix('rescue')->group(function () {
    Route::get('/dashboard', function () {
        return view('rescue-team');
    })->name('rescue.dashboard');
    
    Route::get('/reports', function () {
        return view('rescue-reports');
    })->name('rescue.reports');
    
    Route::get('/assignments', function () {
        return view('rescue-assignments');
    })->name('rescue.assignments');
    
    Route::get('/animals', function () {
        return view('rescue-animals');
    })->name('rescue.animals');
    
    Route::get('/adoptions', function () {
        return view('rescue-adoptions');  // Make sure blade file name matches
    })->name('rescue.adoptions');

});
Route::get('/adoption', [AdoptionController::class, 'index']);
// REMOVE THIS DUPLICATE:
// Route::get('/animals', function () {
//     return view('animals');
// });
Route::get('/register',[AuthController::class,'showRegister'])->name('register');
Route::post('/register',[AuthController::class,'register'])->name('register.post');
Route::get('/login',[AuthController::class,'showLogin'])->name('login');
Route::post('/login',[AuthController::class,'login'])->name('login.post');
Route::get('/logout',[AuthController::class,'logout'])->name('logout');
Route::get('/rescue/dashboard', function(){
    return "Welcome Rescue Team!";
})->middleware('auth');
