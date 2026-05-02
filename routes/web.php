<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

Route::get('/migrate', function () {
    Artisan::call('migrate', ['--force' => true]);
    return 'Migration done';
});
Route::get('/storage-link', function () {
    Artisan::call('storage:link');
    return 'Storage linked';
});
Route::get('/', function () {
    return response()->json([
        'status' => true,
        'message' => 'Backend is running',
    ]);
});
Route::get('/debug', function () {
    return [
        'app_key' => config('app.key'),
        'db' => config('database.default'),
        'db_path' => config('database.connections.sqlite.database'),
        'storage_writable' => is_writable(storage_path()),
        'cache_writable' => is_writable(base_path('bootstrap/cache')),
    ];
});
