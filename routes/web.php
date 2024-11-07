<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\GroupRoleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::resource('groups', GroupController::class);
    Route::resource('users', UserController::class);
    Route::resource('groups/{group}/posts', PostController::class);
    Route::resource('posts/{post}/comments', CommentController::class);

    Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('group-role/{group}', [GroupRoleController::class, 'edit'])->name('groups.role.edit');
    Route::post('group-role/{group}', [GroupRoleController::class, 'update'])->name('groups.role.update');


    Route::post('group-join', [\App\Http\Controllers\GroupJoinController::class, 'store'])->name('group-join.store');
    Route::put('group-join/{groupJoin}', [\App\Http\Controllers\GroupJoinController::class, 'update'])->name('group-join.update');


    Route::get('my-groups', [GroupController::class, 'myGroups'])->name('my-groups');
    Route::put('change-password/{user}', [UserController::class, 'changePassword'])->name('users.change-password');

    Route::post('upload', [\App\Http\Controllers\MediaController::class, 'upload'])->name('upload');
});

require __DIR__.'/auth.php';
