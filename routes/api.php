<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PingController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;

Route::get('/ping', [PingController::class, "ping"]);

Route::middleware("auth:sanctum")->post('/tasks', [TaskController::class, "store"]);
Route::middleware("auth:sanctum")->get('/tasks', [TaskController::class, "index"]);
Route::middleware("auth:sanctum")->get('/tasks/{id}', [TaskController::class, "index_id"]);


Route::post('/users', [UserController::class, "store"]);

Route::post('/login', [LoginController::class, "login"]);
