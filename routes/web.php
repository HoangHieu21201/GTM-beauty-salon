<?php

use Illuminate\Support\Facades\Route;

// Client Routes
Route::get('/', function () {
    return view('client.pages.home');
});

// Admin Routes
Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.pages.dashboard');
    });

    Route::get('/dashboard', function () {
        return view('admin.pages.dashboard');
    });

    Route::get('/analytics', function () {
        return view('admin.pages.analytics');
    });

    Route::get('/posts', function () {
        return view('admin.pages.posts.index');
    });

    Route::get('/posts/create', function () {
        return view('admin.pages.posts.create');
    });

    Route::get('/posts/{id}/edit', function () {
        return view('admin.pages.posts.edit');
    });

    Route::get('/clinics', function () {
        return view('admin.pages.clinics.index');
    });

    Route::get('/clinics/create', function () {
        return view('admin.pages.clinics.create');
    });

    Route::get('/clinics/{id}/edit', function () {
        return view('admin.pages.clinics.edit');
    });

    Route::get('/categories', function () {
        return view('admin.pages.categories.index');
    });

    Route::get('/comments', function () {
        return view('admin.pages.comments.index');
    });

    Route::get('/users', function () {
        return view('admin.pages.users.index');
    });
});
