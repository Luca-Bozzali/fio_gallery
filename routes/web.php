<?php

use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicController::class, 'homepage'])->name('homepage');
Route::get('/Work', [PublicController::class, 'work'])->name('work');
Route::get('/Work/{album:slug}', [PublicController::class, 'workAlbum'])->name('work.album');
Route::get('/Personal', [PublicController::class, 'personal'])->name('personal');
Route::get('/Personal/{album:slug}', [PublicController::class, 'personalAlbum'])->name('personal.album');
Route::get('/About', [PublicController::class, 'about'])->name('about');
Route::get('/Contact', [PublicController::class, 'contact'])->name('contact');
