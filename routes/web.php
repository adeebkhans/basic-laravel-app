<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

// Redirect the homepage to the tasks list
Route::redirect('/', '/tasks');

Route::resource('tasks', TaskController::class);