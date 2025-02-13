<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\VideoChatController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::post('/send-message', [MessageController::class, 'index'])->name('message');
Route::post('/send-group-message', [MessageController::class, 'sendGroupMessage'])->name('group-message');
Route::post('/create-group', [MessageController::class, 'createGroup'])->name('create-group');
Route::post('/add-member', [MessageController::class, 'addMember'])->name('add-member');
Route::post('/upload', [MessageController::class, 'upload'])->name('upload-file');

Route::get('/video-chat', function () {
    // fetch all users apart from the authenticated user
    $users = User::where('id', '<>', Auth::id())->get();
    return view('video-chat', ['users' => $users]);
});

// Endpoints to call or receive calls.
Route::post('/video/call-user', [VideoChatController::class, 'callUser']);
Route::post('/video/accept-call', [VideoChatController::class, 'acceptCall']);
Route::get('/msg-history/{from}/{to}', [HomeController::class, 'msgHistory'])->name('msgHistory');
