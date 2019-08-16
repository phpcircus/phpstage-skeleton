<?php

// Home
Route::redirect('/', '/dashboard');
Route::get('/dashboard', Home\Index::class)->name('dashboard');

// About
Route::get('about', About\Index::class)->name('about');

// Authentication and Registration
// Auth - Login
Route::group(['middleware' => ['guest'], 'as' => 'login.', 'prefix' => 'login'], function ($router) {
    $router->get('/', Auth\Login\ShowForm::class)->name('form');
    $router->post('/', Auth\Login\ProcessLogin::class)->name('attempt');
});
Route::post('/logout', Auth\Logout\ProcessLogout::class)->middleware('auth')->name('logout');

// Auth - Register
Route::group(['middleware' => ['guest'], 'as' => 'register.', 'prefix' => 'register'], function ($router) {
    $router->get('/', Auth\Register\ShowForm::class)->name('form');
    $router->post('/', Auth\Register\ProcessRegistration::class)->name('attempt');
});

// Password Reset
Route::group(['middleware' => ['guest'], 'as' => 'password.', 'prefix' => 'password'], function ($router) {
    $router->get('/reset', Auth\PasswordResetRequest\ShowForm::class)->name('request.form');
    $router->post('/email', Auth\PasswordResetRequest\SendEmail::class)->name('request.email');
    $router->get('/reset/{token}', Auth\PasswordReset\ShowForm::class)->name('reset');
    $router->post('/reset', Auth\PasswordReset\UpdatePassword::class)->name('update');
});

/*
 * Email Verification
 *
 * Middleware is defined inside the constructor of each Action.
 * ['auth', 'signed', 'throttle']
 */
Route::group(['as' => 'verification.', 'prefix' => 'email'], function ($router) {
    $router->get('/verify', Auth\EmailVerification\ShowVerification::class)->name('notice');
    $router->get('/verify/{id}', Auth\EmailVerification\Verify::class)->name('verify');
    $router->get('/resend ', Auth\EmailVerification\ResendVerify::class)->name('resend');
});

// Users
Route::group(['middleware' => ['auth'], 'as' => 'users.', 'prefix' => 'users'], function ($router) {
    $router->get('/', User\ListUsers::class)->name('list');
    $router->get('/create', User\CreateUser::class)->name('create');
    $router->post('/', User\StoreUser::class)->name('store');
    $router->delete('/{user}', User\DeleteUser::class)->name('destroy');
    $router->get('/{user}/edit', User\EditUser::class)->name('edit');
    $router->put('/{user}', User\UpdateUser::class)->name('update');
    $router->put('/{user}/restore', User\RestoreUser::class)->name('restore');
});
