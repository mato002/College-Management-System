<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['name' => 'Super Admin', 'slug' => 'super_admin', 'type' => 'admin', 'is_system' => true, 'description' => 'Full system access'],
            ['name' => 'Lecturer', 'slug' => 'lecturer', 'type' => 'lecturer', 'is_system' => true, 'description' => 'Teaching staff'],
            ['name' => 'Student', 'slug' => 'student', 'type' => 'student', 'is_system' => true, 'description' => 'Registered student'],
            ['name' => 'Dean', 'slug' => 'dean', 'type' => 'admin', 'is_system' => false, 'description' => 'Faculty dean'],
            ['name' => 'Head of Department', 'slug' => 'hod', 'type' => 'admin', 'is_system' => false, 'description' => 'Department head'],
            ['name' => 'Registrar', 'slug' => 'registrar', 'type' => 'admin', 'is_system' => false, 'description' => 'Academic registrar'],
        ];

        foreach ($roles as $r) {
            Role::updateOrCreate(['slug' => $r['slug']], $r);
        }

        $permissions = [
            ['name' => 'View Students', 'slug' => 'students.view', 'group' => 'students'],
            ['name' => 'Create Students', 'slug' => 'students.create', 'group' => 'students'],
            ['name' => 'Edit Students', 'slug' => 'students.edit', 'group' => 'students'],
            ['name' => 'Delete Students', 'slug' => 'students.delete', 'group' => 'students'],
            ['name' => 'View Lecturers', 'slug' => 'lecturers.view', 'group' => 'lecturers'],
            ['name' => 'Create Lecturers', 'slug' => 'lecturers.create', 'group' => 'lecturers'],
            ['name' => 'Edit Lecturers', 'slug' => 'lecturers.edit', 'group' => 'lecturers'],
            ['name' => 'Delete Lecturers', 'slug' => 'lecturers.delete', 'group' => 'lecturers'],
            ['name' => 'View Units', 'slug' => 'units.view', 'group' => 'units'],
            ['name' => 'Create Units', 'slug' => 'units.create', 'group' => 'units'],
            ['name' => 'Edit Units', 'slug' => 'units.edit', 'group' => 'units'],
            ['name' => 'Delete Units', 'slug' => 'units.delete', 'group' => 'units'],
            ['name' => 'Manage Bookings', 'slug' => 'bookings.manage', 'group' => 'bookings'],
            ['name' => 'View Results', 'slug' => 'results.view', 'group' => 'results'],
            ['name' => 'Manage Grades', 'slug' => 'grades.manage', 'group' => 'results'],
            ['name' => 'View Announcements', 'slug' => 'announcements.view', 'group' => 'announcements'],
            ['name' => 'Create Announcements', 'slug' => 'announcements.create', 'group' => 'announcements'],
            ['name' => 'Manage Timetable', 'slug' => 'timetable.manage', 'group' => 'academic'],
            ['name' => 'View Reports', 'slug' => 'reports.view', 'group' => 'reports'],
            ['name' => 'Manage Roles', 'slug' => 'roles.manage', 'group' => 'settings'],
            ['name' => 'Manage Permissions', 'slug' => 'permissions.manage', 'group' => 'settings'],
            ['name' => 'System Settings', 'slug' => 'settings.manage', 'group' => 'settings'],
        ];

        foreach ($permissions as $p) {
            Permission::updateOrCreate(['slug' => $p['slug']], $p);
        }

        $superAdmin = Role::where('slug', 'super_admin')->first();
        $lecturerRole = Role::where('slug', 'lecturer')->first();
        $studentRole = Role::where('slug', 'student')->first();

        if ($superAdmin) {
            $superAdmin->permissions()->sync(Permission::pluck('id'));
        }
        if ($lecturerRole) {
            $lecturerRole->permissions()->sync(
                Permission::whereIn('slug', [
                    'units.view', 'units.edit', 'grades.manage', 'results.view',
                    'announcements.view', 'announcements.create', 'timetable.manage',
                ])->pluck('id')
            );
        }
        if ($studentRole) {
            $studentRole->permissions()->sync(
                Permission::whereIn('slug', ['units.view', 'announcements.view', 'results.view'])->pluck('id')
            );
        }

        // Sync existing users' role_id from legacy role column
        User::whereNull('role_id')->chunkById(100, function ($users) {
            foreach ($users as $user) {
                $slug = match ($user->role->value ?? null) {
                    'super_admin' => 'super_admin',
                    'lecturer' => 'lecturer',
                    'student' => 'student',
                    default => 'student',
                };
                $role = Role::where('slug', $slug)->first();
                if ($role) {
                    $user->update(['role_id' => $role->id]);
                }
            }
        });
    }
}
