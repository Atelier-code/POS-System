<?php

use App\Http\Controllers\Sessions;
use Illuminate\Support\Facades\Route;



Route::group(['middleware' => 'guest',], function () {
    Route::get('/', [Sessions::class, 'index'])->name('login');
    Route::post('/', [Sessions::class, 'login'])->name('login');
});

