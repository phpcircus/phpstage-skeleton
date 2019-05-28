<?php

// Home
Route::redirect('/', '/home');
Route::get('/home', Home\Index::class)->name('home');

// About
Route::get('about', About\Index::class)->name('about');

// Authentication and Registration
// Auth - Login
Route::get('/login', Auth\Login\ShowForm::class)->middleware('guest')->name('login.form');
Route::post('/login', Auth\Login\ProcessLogin::class)->middleware('guest')->name('login.attempt');
Route::post('/logout', Auth\Logout\ProcessLogout::class)->middleware('auth')->name('logout');

// Auth - Register
Route::get('/register', Auth\Register\ShowForm::class)->middleware('guest')->name('register.form');
Route::post('/register', Auth\Register\ProcessRegistration::class)->middleware('guest')->name('register.attempt');

// Password Reset
Route::get('/password/reset', Auth\PasswordResetRequest\ShowForm::class)->middleware('guest')->name('password.request.form');
Route::post('/password/email', Auth\PasswordResetRequest\SendEmail::class)->middleware('guest')->name('password.request.email');
Route::get('/password/reset/{token}', Auth\PasswordReset\ShowForm::class)->middleware('guest')->name('password.reset');
Route::post('/password/reset', Auth\PasswordReset\UpdatePassword::class)->middleware('guest')->name('password.update');

/*
 * Email Verification
 *
 * Middleware is defined inside the constructor of each Action.
 * ['auth', 'signed', 'throttle']
 */
Route::get('email/verify', Auth\EmailVerification\ShowVerification::class)->name('verification.notice');
Route::get('email/verify/{id}', Auth\EmailVerification\Verify::class)->name('verification.verify');
Route::get('email/resend ', Auth\EmailVerification\ResendVerify::class)->name('verification.resend');

// Users
Route::get('users', User\ListUsers::class)->middleware('auth')->name('users');
Route::get('users/create', User\CreateUser::class)->middleware('auth')->name('users.create');
Route::post('users', User\StoreUser::class)->middleware('auth')->name('users.store');
Route::delete('users/{user}', User\DeleteUser::class)->middleware('auth', 'selfdelete.prevent')->name('users.destroy');
Route::get('users/{user}/edit', User\EditUser::class)->middleware('auth')->name('users.edit');
Route::put('users/{user}', User\UpdateUser::class)->middleware('auth')->name('users.update');
Route::put('users/{user}/restore', User\RestoreUser::class)->middleware('auth')->name('users.restore');
