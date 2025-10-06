<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Management\UserManagementController;
use App\Http\Controllers\Admin\SiteSetting\SiteSettingsController;
use App\Http\Controllers\Admin\SiteSetting\StaticPagesController;
use App\Http\Controllers\Admin\SiteSetting\StaticPagesCategoryController;
use App\Http\Controllers\Admin\SiteSetting\FaqController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware(['auth'])->group(function () {
  // Allow impersonated users to return to admin
  Route::post('/admin/return-to-admin', [AdminController::class, 'returnToAdmin'])->name('admin.return_to_admin');
});

Route::middleware(['auth', 'role:admin'])->prefix('/dashboard')->group(function () {
  // Admin impersonation routes
  Route::post('/admin/login-as/{user}', [AdminController::class, 'loginAs'])->name('admin.login_as');

  // Site Settings routes
  Route::get('/admin/site-settings', [SiteSettingsController::class, 'index'])->name('admin.site-settings.index');
  Route::post('/admin/site-settings', [SiteSettingsController::class, 'update'])->name('admin.site-settings.update');

  // User Management routes
  Route::get('/admin/users', [UserManagementController::class, 'index'])->name('admin.users.index');
  Route::post('/admin/users', [UserManagementController::class, 'store'])->name('admin.users.store');
  Route::put('/admin/users/{user}', [UserManagementController::class, 'update'])->name('admin.users.update');
  Route::delete('/admin/users/{user}', [UserManagementController::class, 'destroy'])->name('admin.users.destroy');

  // User Management bulk actions
  Route::patch('/admin/users/bulk/block', [UserManagementController::class, 'bulkBlock'])->name('admin.users.bulk.block');
  Route::patch('/admin/users/bulk/unblock', [UserManagementController::class, 'bulkUnblock'])->name('admin.users.bulk.unblock');
  Route::delete('/admin/users/bulk/delete', [UserManagementController::class, 'bulkDelete'])->name('admin.users.bulk.delete');

  // Static Pages Management
  Route::get('/admin/static-pages', [StaticPagesController::class, 'index'])->name('admin.static-pages.index');
  Route::get('/admin/static-pages/create', [StaticPagesController::class, 'create'])->name('admin.static-pages.create');
  Route::post('/admin/static-pages', [StaticPagesController::class, 'store'])->name('admin.static-pages.store');
  Route::get('/admin/static-pages/{staticPage}/edit', [StaticPagesController::class, 'edit'])->name('admin.static-pages.edit');
  Route::put('/admin/static-pages/{staticPage}', [StaticPagesController::class, 'update'])->name('admin.static-pages.update');
  Route::delete('/admin/static-pages/{staticPage}', [StaticPagesController::class, 'destroy'])->name('admin.static-pages.destroy');

  // Static Pages bulk actions
  Route::patch('/admin/static-pages/bulk/publish', [StaticPagesController::class, 'bulkPublish'])->name('admin.static-pages.bulk.publish');
  Route::patch('/admin/static-pages/bulk/archive', [StaticPagesController::class, 'bulkArchive'])->name('admin.static-pages.bulk.archive');
  Route::delete('/admin/static-pages/bulk/delete', [StaticPagesController::class, 'bulkDelete'])->name('admin.static-pages.bulk.delete');

  // Static Pages Categories Management
  Route::get('/admin/static-pages-categories', [StaticPagesCategoryController::class, 'index'])->name('admin.static-pages-categories.index');
  Route::post('/admin/static-pages-categories', [StaticPagesCategoryController::class, 'store'])->name('admin.static-pages-categories.store');
  Route::put('/admin/static-pages-categories/{staticPageCategory}', [StaticPagesCategoryController::class, 'update'])->name('admin.static-pages-categories.update');
  Route::delete('/admin/static-pages-categories/{staticPageCategory}', [StaticPagesCategoryController::class, 'destroy'])->name('admin.static-pages-categories.destroy');

  // Static Pages Categories bulk actions
  Route::delete('/admin/static-pages-categories/bulk/delete', [StaticPagesCategoryController::class, 'bulkDelete'])->name('admin.static-pages-categories.bulk.delete');

  // FAQ Management
  Route::get('/admin/faq', [FaqController::class, 'index'])->name('admin.faq.index');
  Route::get('/admin/faq/create', [FaqController::class, 'create'])->name('admin.faq.create');
  Route::post('/admin/faq', [FaqController::class, 'store'])->name('admin.faq.store');
  Route::get('/admin/faq/{faq}/edit', [FaqController::class, 'edit'])->name('admin.faq.edit');
  Route::put('/admin/faq/{faq}', [FaqController::class, 'update'])->name('admin.faq.update');
  Route::delete('/admin/faq/{faq}', [FaqController::class, 'destroy'])->name('admin.faq.destroy');

  // FAQ bulk actions
  Route::delete('/admin/faq/bulk/delete', [FaqController::class, 'bulkDelete'])->name('admin.faq.bulk.delete');

});
