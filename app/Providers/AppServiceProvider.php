<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::before(function ($user, string $ability) {
            if ($user->effectiveType() === 'admin') {
                return true;
            }
            return null;
        });

        $permissions = [
            'students.view', 'students.create', 'students.edit', 'students.delete',
            'lecturers.view', 'lecturers.create', 'lecturers.edit', 'lecturers.delete',
            'units.view', 'units.create', 'units.edit', 'units.delete',
            'bookings.manage', 'results.view', 'grades.manage',
            'announcements.view', 'announcements.create',
            'timetable.manage', 'reports.view',
            'roles.manage', 'permissions.manage', 'settings.manage',
        ];
        foreach ($permissions as $permission) {
            Gate::define($permission, function ($user) use ($permission) {
                return $user->hasPermission($permission);
            });
        }
    }
}
