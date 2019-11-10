<?php

use App\Http\Actions;

// Home
Route::redirect('/', '/dashboard');
Route::get('/dashboard', Actions\Home\Index::class)->name('dashboard');

// About
Route::get('about', Actions\About\Index::class)->name('about');

// Authentication and Registration
// Auth - Login
Route::group(['middleware' => ['guest'], 'as' => 'login.', 'prefix' => 'login'], function ($router) {
    $router->get('/', Actions\Auth\Login\ShowForm::class)->name('form');
    $router->post('/', Actions\Auth\Login\ProcessLogin::class)->name('attempt');
});
Route::post('/logout', Actions\Auth\Logout\ProcessLogout::class)->middleware('auth')->name('logout');

// Auth - Register
Route::group(['middleware' => ['guest'], 'as' => 'register.', 'prefix' => 'register'], function ($router) {
    $router->get('/', Actions\Auth\Register\ShowForm::class)->name('form');
    $router->post('/', Actions\Auth\Register\ProcessRegistration::class)->name('attempt');
});

// Password Reset
Route::group(['middleware' => ['guest'], 'as' => 'password.', 'prefix' => 'password'], function ($router) {
    $router->get('/reset', Actions\Auth\PasswordResetRequest\ShowForm::class)->name('request.form');
    $router->post('/email', Actions\Auth\PasswordResetRequest\SendEmail::class)->name('request.email');
    $router->get('/reset/{token}', Actions\Auth\PasswordReset\ShowForm::class)->name('reset');
    $router->post('/reset', Actions\Auth\PasswordReset\UpdatePassword::class)->name('update');
});

//
// Email Verification
//
// Middleware is defined inside the constructor of each Action.
// ['auth', 'signed', 'throttle']
//
Route::group(['as' => 'verification.', 'prefix' => 'email'], function ($router) {
    $router->get('/verify', Actions\Auth\EmailVerification\ShowVerification::class)->name('notice');
    $router->get('/verify/{id}', Actions\Auth\EmailVerification\Verify::class)->name('verify');
    $router->get('/resend ', Actions\Auth\EmailVerification\ResendVerify::class)->name('resend');
});

// Users
Route::group(['middleware' => ['auth'], 'as' => 'users.', 'prefix' => 'users'], function ($router) {
    $router->get('/', Actions\User\ListUsers::class)->middleware(['can:listUsers'])->name('list');
    $router->get('/create', Actions\User\CreateUser::class)->middleware(['can:administerUsers'])->name('create');
    $router->post('/', Actions\User\StoreUser::class)->middleware(['can:administerUsers'])->name('store');
    $router->delete('/{user}', Actions\User\DeleteUser::class)->middleware(['can:administerUsers'])->name('destroy');
    $router->get('/{user}/edit', Actions\User\EditUser::class)->middleware(['can:updateUser,user'])->name('edit');
    $router->put('/{user}', Actions\User\UpdateUser::class)->middleware(['can:updateUser,user'])->name('update');
    $router->put('/{user}/restore', Actions\User\RestoreUser::class)->middleware(['can:administerUsers'])->name('restore');
});
