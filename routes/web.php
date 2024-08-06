<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\WebController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Web\AthleteController;
use App\Http\Controllers\Web\CollectionController;
use App\Http\Controllers\Web\AnnouncementController;



Route::get("/", [WebController::class, "home"])->name("home");

Route::get("/login", [LoginController::class, "login"])->name("login");


Route::get(
    "/announcements",
    [AnnouncementController::class, "list"]
)->name("announcements.list");
Route::get(
    "/announcements/{id}",
    [AnnouncementController::class, "show"]
)->name("announcements.show");


Route::get(
    "/athletes",
    [AthleteController::class, "list"]
)->name("athletes.list");


Route::get(
    "/collections",
    [CollectionController::class, "list"]
)->name("collections.list");
