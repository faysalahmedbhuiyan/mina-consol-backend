<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

Route::get('/', function () {
    return response()->json([
        'status' => true,
        'message' => 'Backend is running',
    ]);
});

Route::get('/clear', function () {
    Artisan::call('optimize:clear');
    return 'Cache cleared';
});

Route::get('/migrate', function () {
    Artisan::call('migrate', ['--force' => true]);
    return 'Migration done';
});

Route::get('/storage-link', function () {
    Artisan::call('storage:link');
    return 'Storage linked';
});

Route::get('/debug', function () {
    return [
        'db' => config('database.default'),
        'app_env' => config('app.env'),
    ];
});