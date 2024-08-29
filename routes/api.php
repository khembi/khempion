<?php

use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;

Route::controller(QuestionController::class)->prefix('question')->group(function () {
    Route::get('/', 'index');
    Route::get('/{id}', 'show');
});
