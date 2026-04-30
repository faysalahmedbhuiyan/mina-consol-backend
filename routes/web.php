<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

Route::get('/migrate', function () {
    Artisan::call('migrate', ['--force' => true]);
    return 'Migration done';
});
Route::get('/', function () {
    return response()->json([
        'status' => true,
        'message' => 'Backend is running',
    ]);
});
