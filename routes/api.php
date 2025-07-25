<?php

use App\Http\Controllers\FamilyMemberController;
use App\Http\Controllers\HeadOfFamilyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::apiResource('user', UserController::class);
Route::get('/user/all/paginated', [UserController::class, 'getAllPaginated']);

Route::apiResource('head-of-family', HeadOfFamilyController::class);
Route::get('/head-of-family/all/paginated', [HeadOfFamilyController::class, 'getAllPaginated']);

Route::apiResource('family-member', FamilyMemberController::class);
Route::get('/family-member/all/paginated', [FamilyMemberController::class, 'getAllPaginated']);