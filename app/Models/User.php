<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => UserRole::class,
        ];
    }

    public function student(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Student::class);
    }

    public function lecturer(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Lecturer::class);
    }

    public function roleRelation(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function announcements(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Announcement::class);
    }

    public function profile(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(UserProfile::class);
    }

    public function isStudent(): bool
    {
        if ($this->role_id && $this->roleRelation) {
            return $this->roleRelation->isStudentType();
        }
        return $this->role === UserRole::Student;
    }

    public function isLecturer(): bool
    {
        if ($this->role_id && $this->roleRelation) {
            return $this->roleRelation->isLecturerType();
        }
        return $this->role === UserRole::Lecturer;
    }

    public function isSuperAdmin(): bool
    {
        if ($this->role_id && $this->roleRelation) {
            return $this->roleRelation->type === 'admin' && $this->roleRelation->slug === 'super_admin';
        }
        return $this->role === UserRole::SuperAdmin;
    }

    /** Resolve dashboard type: admin | lecturer | student */
    public function effectiveType(): string
    {
        if ($this->role_id && $this->roleRelation) {
            return $this->roleRelation->type;
        }
        return match ($this->role) {
            UserRole::SuperAdmin => 'admin',
            UserRole::Lecturer => 'lecturer',
            UserRole::Student => 'student',
        };
    }

    public function hasPermission(string $permissionSlug): bool
    {
        if ($this->isSuperAdmin() || $this->effectiveType() === 'admin') {
            return true;
        }
        if ($this->role_id && $this->roleRelation) {
            return $this->roleRelation->hasPermission($permissionSlug);
        }
        return false;
    }

    public function canAccess(string $permissionSlug): bool
    {
        return $this->hasPermission($permissionSlug);
    }

    public function roleLabel(): string
    {
        if ($this->role_id && $this->roleRelation) {
            return $this->roleRelation->name;
        }
        return $this->role->label();
    }
}
