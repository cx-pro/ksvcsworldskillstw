<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\WebController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Web\AthleteController;
use App\Http\Controllers\Web\CollectionController;
use App\Http\Controllers\Web\AnnouncementController;

require __DIR__ . '/auth.php';
require __DIR__ . '/api.php';
require __DIR__ . '/admin.php';

Route::get("/", [WebController::class, "home"])->name("home");

Route::get("/login", [AuthController::class, "login"])->name("login");
Route::get("/logout", [AuthController::class, "logout"])->name("logout");
Route::get("/register", [AuthController::class, "register"])->name("register");
Route::get("/forgot-password", [AuthController::class, "forgot_password"])->name("forgot_password");


Route::get("/announcements", [AnnouncementController::class, "list"])->name("announcements.list");
Route::get("/announcements/{id}", [AnnouncementController::class, "show"])->name("announcements.show");


Route::get("/athletes", [AthleteController::class, "list"])->name("athletes.list");


Route::get("/collections", [CollectionController::class, "list"])->name("collections.list");
