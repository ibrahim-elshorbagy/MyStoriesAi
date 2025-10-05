<?php

use App\Http\Controllers\Api\Agents\AgentSettingsController;
use App\Http\Controllers\Api\Agents\ReportAgentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PreferencesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\Settings\UserSettingsController;
use App\Http\Controllers\User\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [HomeController::class, 'home'])->name('home');

// Static Pages
Route::get('/page/{id}', [UserController::class, 'staticPage'])->name('static-page');

Route::get('/dashboard', function () {
  return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->prefix('/dashboard')->group(function () {

  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
  Route::post('/profile/image', [ProfileController::class, 'uploadProfileImage'])->name('profile.image.update');

});
// User preferences routes
Route::any('/locale', [PreferencesController::class, 'changeLocale'])->name('locale.change');

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';

