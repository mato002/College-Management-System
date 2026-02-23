<?php

namespace App\Enums;

enum UserRole: string
{
    case Student = 'student';
    case Lecturer = 'lecturer';
    case SuperAdmin = 'super_admin';

    public function label(): string
    {
        return match ($this) {
            self::Student => 'Student',
            self::Lecturer => 'Lecturer',
            self::SuperAdmin => 'Super Admin',
        };
    }

    public function isStudent(): bool
    {
        return $this === self::Student;
    }

    public function isLecturer(): bool
    {
        return $this === self::Lecturer;
    }

    public function isSuperAdmin(): bool
    {
        return $this === self::SuperAdmin;
    }
}
