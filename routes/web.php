<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectAdminController;
use App\Http\Controllers\Admin\CertificateAdminController;
use App\Http\Controllers\Admin\EducationAdminController;
use App\Http\Controllers\Admin\ExperienceAdminController;
use App\Http\Controllers\Admin\ProfileAdminController;
use App\Http\Controllers\Admin\HeroRoleAdminController;
use App\Http\Controllers\Admin\HeroBadgeAdminController;
use App\Http\Controllers\Admin\SkillAdminController;
use App\Http\Controllers\Admin\MessageAdminController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::post('/contact', [PortfolioController::class, 'sendContact'])->name('portfolio.contact');

/*
|--------------------------------------------------------------------------
| Admin Authentication Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    /* Protected Admin Routes */
    Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        // Profile Management
        Route::get('/profile', [ProfileAdminController::class, 'index'])->name('profile.index');
        Route::put('/profile', [ProfileAdminController::class, 'update'])->name('profile.update');

        // Hero Typewriter Roles Management
        Route::get('/roles', [HeroRoleAdminController::class, 'index'])->name('roles.index');
        Route::post('/roles', [HeroRoleAdminController::class, 'store'])->name('roles.store');
        Route::delete('/roles/{role}', [HeroRoleAdminController::class, 'destroy'])->name('roles.destroy');

        // Hero Floating Badges Management
        Route::get('/badges', [HeroBadgeAdminController::class, 'index'])->name('badges.index');
        Route::post('/badges', [HeroBadgeAdminController::class, 'store'])->name('badges.store');
        Route::delete('/badges/{badge}', [HeroBadgeAdminController::class, 'destroy'])->name('badges.destroy');

        // Skills & Technologies Management
        Route::get('/skills', [SkillAdminController::class, 'index'])->name('skills.index');
        Route::post('/skills', [SkillAdminController::class, 'store'])->name('skills.store');
        Route::put('/skills/{skill}', [SkillAdminController::class, 'update'])->name('skills.update');
        Route::delete('/skills/{skill}', [SkillAdminController::class, 'destroy'])->name('skills.destroy');

        // Messages (Pesan Masuk dari Pengunjung)
        Route::get('/messages', [MessageAdminController::class, 'index'])->name('messages.index');
        Route::get('/messages/{message}', [MessageAdminController::class, 'show'])->name('messages.show');
        Route::put('/messages/{message}/read', [MessageAdminController::class, 'markAsRead'])->name('messages.markAsRead');
        Route::delete('/messages/{message}', [MessageAdminController::class, 'destroy'])->name('messages.destroy');

        // CRUD Projects
        Route::resource('projects', ProjectAdminController::class);

        // CRUD Certificates
        Route::resource('certificates', CertificateAdminController::class);

        // CRUD Education (SMP, SMK, Kuliah)
        Route::resource('education', EducationAdminController::class);

        // CRUD Experience (Pengalaman Kerja & Karir)
        Route::get('experience/{experience}/attachments', [ExperienceAdminController::class, 'attachments'])->name('experience.attachments');
        Route::post('experience/{experience}/attachments', [ExperienceAdminController::class, 'storeAttachment'])->name('experience.attachments.store');
        Route::delete('experience/attachments/{attachment}', [ExperienceAdminController::class, 'destroyAttachment'])->name('experience.attachments.destroy');
        Route::resource('experience', ExperienceAdminController::class);
    });
});
