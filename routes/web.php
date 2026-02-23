<?php

use App\Http\Controllers\Admin\ActivityLogController as AdminActivityLogController;
use App\Http\Controllers\Admin\AcademicController as AdminAcademicController;
use App\Http\Controllers\Admin\AnnouncementController as AdminAnnouncementController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\LecturerController as AdminLecturerController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;
use App\Http\Controllers\Admin\RoleController as AdminRoleController;
use App\Http\Controllers\Admin\ResultController as AdminResultController;
use App\Http\Controllers\Admin\StudentController as AdminStudentController;
use App\Http\Controllers\Admin\SystemSettingController as AdminSystemSettingController;
use App\Http\Controllers\Admin\UnitBookingController as AdminUnitBookingController;
use App\Http\Controllers\Admin\UnitController as AdminUnitController;
use App\Http\Controllers\Admin\UnitLecturerController as AdminUnitLecturerController;
use App\Http\Controllers\Lecturer\AnnouncementController as LecturerAnnouncementController;
use App\Http\Controllers\Lecturer\AttendanceController as LecturerAttendanceController;
use App\Http\Controllers\Lecturer\DashboardController as LecturerDashboard;
use App\Http\Controllers\Lecturer\GradeController as LecturerGradeController;
use App\Http\Controllers\Lecturer\MaterialController as LecturerMaterialController;
use App\Http\Controllers\Lecturer\MessageController as LecturerMessageController;
use App\Http\Controllers\Lecturer\TimetableController as LecturerTimetableController;
use App\Http\Controllers\Lecturer\UnitController as LecturerUnitController;
use App\Http\Controllers\Lecturer\StudentController as LecturerStudentController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Student\AnnouncementController as StudentAnnouncementController;
use App\Http\Controllers\Student\DashboardController as StudentDashboard;
use App\Http\Controllers\Student\MaterialController as StudentMaterialController;
use App\Http\Controllers\Student\MessageController as StudentMessageController;
use App\Http\Controllers\Student\MyUnitController as StudentMyUnitController;
use App\Http\Controllers\Student\ResultController as StudentResultController;
use App\Http\Controllers\Student\TimetableController as StudentTimetableController;
use App\Http\Controllers\Student\UnitBookingController as StudentUnitBookingController;
use Illuminate\Support\Facades\Route;

Route::get('/', \App\Http\Controllers\LandingController::class)->name('landing');

Route::prefix('/')->name('public.')->group(function () {
    Route::get('about', [\App\Http\Controllers\PublicController::class, 'about'])->name('about');
    Route::get('departments', [\App\Http\Controllers\PublicController::class, 'departments'])->name('departments');
    Route::get('departments/{slug}', [\App\Http\Controllers\PublicController::class, 'department'])->name('departments.show');
    Route::get('programs', [\App\Http\Controllers\PublicController::class, 'programs'])->name('programs');
    Route::get('programs/{slug}', [\App\Http\Controllers\PublicController::class, 'program'])->name('programs.show');
    Route::get('courses', [\App\Http\Controllers\PublicController::class, 'courses'])->name('courses');
    Route::get('courses/{unit}', [\App\Http\Controllers\PublicController::class, 'course'])->name('courses.show');
    Route::get('admissions', [\App\Http\Controllers\PublicController::class, 'admissions'])->name('admissions');
    Route::get('staff', [\App\Http\Controllers\PublicController::class, 'staff'])->name('staff');
    Route::get('news', [\App\Http\Controllers\PublicController::class, 'news'])->name('news');
    Route::get('news/{announcement}', [\App\Http\Controllers\PublicController::class, 'newsShow'])->name('news.show');
    Route::get('events', [\App\Http\Controllers\PublicController::class, 'events'])->name('events');
    Route::get('events/{slug}', [\App\Http\Controllers\PublicController::class, 'event'])->name('events.show');
    Route::get('contact', [\App\Http\Controllers\PublicController::class, 'contact'])->name('contact');
    Route::post('contact', [\App\Http\Controllers\PublicController::class, 'submitContact'])->name('contact.submit');
    Route::get('faq', [\App\Http\Controllers\PublicController::class, 'faq'])->name('faq');
});

Route::get('/dashboard', function () {
    $type = auth()->user()->effectiveType();
    return match ($type) {
        'admin' => redirect()->route('admin.dashboard'),
        'lecturer' => redirect()->route('lecturer.dashboard'),
        default => redirect()->route('student.dashboard'),
    };
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/biodata', [ProfileController::class, 'updateBiodata'])->name('profile.biodata.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/logout-other-devices', [ProfileController::class, 'logoutOtherDevices'])->name('profile.logout-other-devices');
    Route::delete('/profile/sessions/{id}', [ProfileController::class, 'revokeSession'])->name('profile.sessions.revoke');
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.read-all');
    Route::get('/search', [SearchController::class, 'index'])->name('search');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', AdminDashboard::class)->name('dashboard');
    Route::resource('students', AdminStudentController::class);
    Route::resource('lecturers', AdminLecturerController::class);
    Route::resource('units', AdminUnitController::class);
    Route::get('units/{unit}/assign-lecturers', [AdminUnitLecturerController::class, 'edit'])->name('units.assign.edit');
    Route::put('units/{unit}/assign-lecturers', [AdminUnitLecturerController::class, 'update'])->name('units.assign.update');

    // Unit Booking Management
    Route::get('bookings', [AdminUnitBookingController::class, 'index'])->name('bookings.index');
    Route::get('bookings/reports', [AdminUnitBookingController::class, 'reports'])->name('bookings.reports');

    // Academic Management
    Route::get('academic/calendar', [AdminAcademicController::class, 'calendar'])->name('academic.calendar');
    Route::get('academic/semesters', [AdminAcademicController::class, 'semesters'])->name('academic.semesters');
    Route::get('academic/timetable', [AdminAcademicController::class, 'timetable'])->name('academic.timetable');
    Route::get('academic/departments', [AdminAcademicController::class, 'departments'])->name('academic.departments');
    Route::get('academic/programs', [AdminAcademicController::class, 'programs'])->name('academic.programs');

    // Results & Grading
    Route::get('results', [AdminResultController::class, 'index'])->name('results.index');
    Route::get('results/grades', [AdminResultController::class, 'grades'])->name('results.grades');
    Route::get('results/settings', [AdminResultController::class, 'settings'])->name('results.settings');
    Route::get('results/reports', [AdminResultController::class, 'reports'])->name('results.reports');

    // Announcements
    Route::resource('announcements', AdminAnnouncementController::class);

    // Reports & Analytics
    Route::get('reports/students', [AdminReportController::class, 'students'])->name('reports.students');
    Route::get('reports/enrollment', [AdminReportController::class, 'enrollment'])->name('reports.enrollment');
    Route::get('reports/lecturers', [AdminReportController::class, 'lecturers'])->name('reports.lecturers');
    Route::get('reports/analytics', [AdminReportController::class, 'analytics'])->name('reports.analytics');

    Route::get('activity-log', [AdminActivityLogController::class, 'index'])->name('activity-log.index');

    // System Settings
    Route::get('settings/general', [AdminSystemSettingController::class, 'general'])->name('settings.general');
    Route::put('settings/general', [AdminSystemSettingController::class, 'updateGeneral'])->name('settings.general.update');
    Route::get('settings/email', [AdminSystemSettingController::class, 'email'])->name('settings.email');
    Route::get('settings/permissions', [AdminSystemSettingController::class, 'permissions'])->name('settings.permissions');
    Route::get('settings/backup', [AdminSystemSettingController::class, 'backup'])->name('settings.backup');

    // Roles & Permissions (enterprise)
    Route::get('roles', [AdminRoleController::class, 'index'])->name('roles.index');
    Route::get('roles/{role}/edit', [AdminRoleController::class, 'edit'])->name('roles.edit');
    Route::put('roles/{role}', [AdminRoleController::class, 'update'])->name('roles.update');
});

Route::middleware(['auth', 'role:student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/', StudentDashboard::class)->name('dashboard');
    Route::get('my-units', [StudentMyUnitController::class, 'index'])->name('my-units.index');
    Route::get('units', [StudentUnitBookingController::class, 'index'])->name('units.index');
    Route::post('units', [StudentUnitBookingController::class, 'store'])->name('units.store');
    Route::delete('units/{unit}', [StudentUnitBookingController::class, 'destroy'])->name('units.destroy');
    Route::get('results', [StudentResultController::class, 'index'])->name('results.index');
    Route::get('timetable', [StudentTimetableController::class, 'index'])->name('timetable.index');
    Route::get('materials', [StudentMaterialController::class, 'index'])->name('materials.index');
    Route::get('announcements', [StudentAnnouncementController::class, 'index'])->name('announcements.index');
    Route::get('messages', [StudentMessageController::class, 'index'])->name('messages.index');
});

Route::middleware(['auth', 'role:lecturer'])->prefix('lecturer')->name('lecturer.')->group(function () {
    Route::get('/', LecturerDashboard::class)->name('dashboard');
    Route::get('units', [LecturerUnitController::class, 'index'])->name('units.index');
    Route::get('units/{unit}', [LecturerUnitController::class, 'show'])->name('units.show');
    Route::get('students', [LecturerStudentController::class, 'index'])->name('students.index');
    Route::get('grades', [LecturerGradeController::class, 'index'])->name('grades.index');
    Route::get('grades/{enrollment}/edit', [LecturerGradeController::class, 'edit'])->name('grades.edit');
    Route::put('grades/{enrollment}', [LecturerGradeController::class, 'update'])->name('grades.update');
    Route::get('materials', [LecturerMaterialController::class, 'index'])->name('materials.index');
    Route::get('attendance', [LecturerAttendanceController::class, 'index'])->name('attendance.index');
    Route::get('announcements', [LecturerAnnouncementController::class, 'index'])->name('announcements.index');
    Route::get('announcements/create', [LecturerAnnouncementController::class, 'create'])->name('announcements.create');
    Route::post('announcements', [LecturerAnnouncementController::class, 'store'])->name('announcements.store');
    Route::get('timetable', [LecturerTimetableController::class, 'index'])->name('timetable.index');
    Route::get('messages', [LecturerMessageController::class, 'index'])->name('messages.index');
});

require __DIR__.'/auth.php';
