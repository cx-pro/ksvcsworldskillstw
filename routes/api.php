<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::prefix('api')->group(function () {
    Route::post("/clear-msg", [ApiController::class, "clearMsg"])->name("api.clear_msg");
    Route::post("/set-theme", [ApiController::class, "setTheme"])->name("api.set_theme");
});
