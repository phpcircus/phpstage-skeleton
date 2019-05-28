<?php

use App\Models\User;
use Illuminate\Support\Facades\Artisan;

Artisan::command('create:admin', function () {
    $this->comment('creating admin account...');
    $admin = User::create([
        'name' => config('auth.admin.name'),
        'email' => config('auth.admin.email'),
        'password' => bcrypt(config('auth.admin.name')),
        'email_verified_at' => now(),
        'is_admin' => 1,
    ]);
    $this->comment("Admin account for {$admin->name} successfully created.");
})->describe('Create the default administrator account.');
