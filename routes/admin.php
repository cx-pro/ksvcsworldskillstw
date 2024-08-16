<?php

use App\Http\Controllers\Admin\AnnouncementCategoryController;
use App\Http\Controllers\Admin\HardDeleteController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminRequired;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AthleteController;
use App\Http\Controllers\Admin\CollectionController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\AnnouncementController;

Route::middleware(AdminRequired::class)->prefix("admin")->group(function () {

    Route::get("/index", [AdminController::class, "home"])->name("admin.home");

    Route::get("/users", [UserController::class, "list"])->name("admin.users.list");
    Route::get("/users/create", [UserController::class, "create"])->name("admin.users.create");
    Route::post("/users/store", [UserController::class, "store"])->name("admin.users.store");
    Route::get("/users/{id}/edit", [UserController::class, "edit"])->name("admin.users.edit");
    Route::post("/users/{id}/update", [UserController::class, "update"])->name("admin.users.update");
    Route::get("/users/{id}/destory", [UserController::class, "destory"])->name("admin.users.destory");

    Route::get("/roles", [RoleController::class, "list"])->name("admin.roles.list");
    Route::get("/roles/create", [RoleController::class, "create"])->name("admin.roles.create");
    Route::post("/roles/store", [RoleController::class, "store"])->name("admin.roles.store");
    Route::get("/roles/{id}/edit", [RoleController::class, "edit"])->name("admin.roles.edit");
    Route::post("/roles/{id}/update", [RoleController::class, "update"])->name("admin.roles.update");
    Route::get("/roles/{id}/destory", [RoleController::class, "destory"])->name("admin.roles.destory");

    Route::get("/permissions", [PermissionController::class, "list"])->name("admin.permissions.list");
    Route::get("/permissions/create", [PermissionController::class, "create"])->name("admin.permissions.create");
    Route::post("/permissions/store", [PermissionController::class, "store"])->name("admin.permissions.store");
    Route::get("/permissions/{id}/edit", [PermissionController::class, "edit"])->name("admin.permissions.edit");
    Route::post("/permissions/{id}/update", [PermissionController::class, "update"])->name("admin.permissions.update");
    Route::post("/permissions/update_levels", [PermissionController::class, "update_levels"])->name("admin.permissions.update_levels");
    Route::get("/permissions/{id}/destory", [PermissionController::class, "destory"])->name("admin.permissions.destory");


    Route::get("/announcements/create", [AnnouncementController::class, "create"])->name("admin.announcements.create");
    Route::post("/announcements/store", [AnnouncementController::class, "store"])->name("admin.announcements.store");
    Route::get("/announcements/{id}/edit", [AnnouncementController::class, "edit"])->name("admin.announcements.edit");
    Route::post("/announcements/{id}/update", [AnnouncementController::class, "update"])->name("admin.announcements.update");
    Route::get("/announcements/{id}/destory", [AnnouncementController::class, "destory"])->name("admin.announcements.destory");


    Route::get("/announcements_categorie/list", [AnnouncementCategoryController::class, "list"])->name("admin.announcement_categories.list");
    Route::get("/announcements_categorie/create", [AnnouncementCategoryController::class, "create"])->name("admin.announcement_categories.create");
    Route::post("/announcement_categories/store", [AnnouncementCategoryController::class, "store"])->name("admin.announcement_categories.store");
    Route::get("/announcement_categories/{id}/edit", [AnnouncementCategoryController::class, "edit"])->name("admin.announcement_categories.edit");
    Route::post("/announcement_categories/{id}/update", [AnnouncementCategoryController::class, "update"])->name("admin.announcement_categories.update");
    Route::get("/announcement_categories/{id}/destory", [AnnouncementCategoryController::class, "destory"])->name("admin.announcement_categories.destory");


    Route::get("/athletes/create", [AthleteController::class, "create"])->name("admin.athletes.create");
    Route::post("/athletes/store", [AthleteController::class, "store"])->name("admin.athletes.store");
    Route::get("/athletes/{id}/edit", [AthleteController::class, "edit"])->name("admin.athletes.edit");
    Route::post("/athletes/{id}/update", [AthleteController::class, "update"])->name("admin.athletes.update");
    Route::get("/athletes/{id}/destory", [AthleteController::class, "destory"])->name("admin.athletes.destory");


    Route::get("/collections/create", [CollectionController::class, "create"])->name("admin.collections.create");
    Route::post("/collections/store", [CollectionController::class, "store"])->name("admin.collections.store");
    Route::get("/collections/{id}/edit", [CollectionController::class, "edit"])->name("admin.collections.edit");
    Route::post("/collections/{id}/update", [CollectionController::class, "update"])->name("admin.collections.update");
    Route::get("/collections/{id}/destory", [CollectionController::class, "destory"])->name("admin.collections.destory");


    Route::get("/hard_deletes", [HardDeleteController::class, "list"])->name("admin.hard_deletes.list");
    Route::post("/hard_deletes/users", [HardDeleteController::class, "users"])->name("admin.hard_deletes.users");
    Route::post("/hard_deletes/athletes", [HardDeleteController::class, "athletes"])->name("admin.hard_deletes.athletes");
    Route::post("/hard_deletes/announcements", [HardDeleteController::class, "announcements"])->name("admin.hard_deletes.announcements");
});
