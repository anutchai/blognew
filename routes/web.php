<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/admin', function () {
    return view('admin');
});

Route::get('/account', function () {
    return view('account');
});

Route::get('/signup', function () {
    return view('signup');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin');
    })->name('dashboard');

    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');

    Route::get('/projects', function () {
        return view('projects');
    })->name('projects');

    Route::get('/project-add', function () {
        return view('project.add');
    })->name('project-add');

    Route::get('/project-edit/{id}', function ($id) {
        return view('project.edit',compact('id'));
    })->name('project-edit');

    Route::get('/project-view', function () {
        return view('project.view');
    })->name('project-view');
});
