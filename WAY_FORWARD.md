# School Management System (College) — Complete Way Forward

## 1. Core Goal

Role-based system where:
- **Students** → register, book units (courses), view updates/results
- **Lecturers** → manage units, grades, announcements
- **Super Admin** → control everything (users, units, assignments, approvals, reports)

---

## 2. Users & Roles

| Role | Capabilities |
|------|--------------|
| **Student** | Register/login, view units, book/drop units, timetable, announcements, results, profile |
| **Lecturer** | Login, manage assigned units, upload materials, grade students, post announcements, attendance (optional) |
| **Super Admin** | Manage students/lecturers, create units, assign lecturers, approve registrations, reports, academic calendar, settings |

---

## 3. System Modules & Implementation Map

### 3.1 Authentication Module
- [x] Add `role` to users (enum: `student`, `lecturer`, `super_admin`) — **Done**
- [x] Middleware: `EnsureUserHasRole` (alias `role`) — **Done**
- [ ] Install Laravel Breeze: `php artisan breeze:install` (Blade/Livewire/Inertia)
- [ ] Role-based redirect after login (dashboard per role)
- [ ] Password reset (Breeze), optional email verification

**Role-based redirect after login (once Breeze is installed):**  
In `app/Http/Responses/LoginResponse.php` (Breeze) or in the controller that handles login success, redirect by role, e.g.  
`match ($request->user()->role) { UserRole::SuperAdmin => redirect()->route('admin.dashboard'), UserRole::Lecturer => redirect()->route('lecturer.dashboard'), default => redirect()->route('student.dashboard') }`.

**Files:** `app/Enums/UserRole.php`, `app/Http/Middleware/EnsureUserHasRole.php`

---

### 3.2 Student Management Module (Admin)
- [ ] Student profile: reg_no, phone, programme, year, avatar (optional)
- [ ] CRUD: add/edit/delete students (admin only)
- [ ] Student enrollment status (active/suspended/graduated)
- [ ] List/filter/search students

**Tables:** `students` (user_id, reg_no, programme, year_of_study, status, etc.)  
**Controllers:** `Admin/StudentController`  
**Views:** `admin/students/index`, `create`, `edit`, `show`

---

### 3.3 Lecturer Management Module (Admin)
- [ ] Lecturer profile: employee_id, phone, department, etc.
- [ ] CRUD lecturers (admin only)
- [ ] Assign units to lecturers (pivot: unit_lecturer)
- [ ] List/filter lecturers and their units

**Tables:** `lecturers` (user_id, employee_id, department, etc.), `unit_lecturer` (unit_id, lecturer_id, semester)  
**Controllers:** `Admin/LecturerController`, `Admin/UnitAssignmentController`  
**Views:** `admin/lecturers/*`, assign-units UI

---

### 3.4 Unit/Course Management (Admin)
- [ ] Create/edit/delete units: code, name, description, semester, capacity, credits
- [ ] Assign lecturers to units (with semester)
- [ ] Academic calendar: semesters, start/end dates
- [ ] Unit status (active/archived)

**Tables:** `units`, `semesters` (optional), `unit_lecturer`  
**Controllers:** `Admin/UnitController`  
**Views:** `admin/units/*`

---

### 3.5 Unit Booking System (Core – Student)
- [ ] Student views **available units** (by semester, not yet full)
- [ ] Book/select unit (enrollment) — prevent duplicate, check capacity
- [ ] Drop unit (within deadline if you add it)
- [ ] My units / My timetable view

**Tables:** `unit_bookings` or `enrollments` (student_id, unit_id, semester, status, booked_at)  
**Controllers:** `Student/UnitBookingController`, `Student/DashboardController`  
**Policies:** ensure student can only book for self; prevent over-capacity and duplicates

---

### 3.6 Academic Management
- [ ] **Timetable:** slots per unit (day, time, room) — table `timetable_slots` or `schedules`
- [ ] **Results/Grades:** lecturer enters grades per unit per student — table `grades` (enrollment_id or student_id+unit_id, score, grade, semester)
- [ ] **Attendance (optional):** `attendance` table (session/date, enrollment_id, status)

**Tables:** `timetable_slots`, `grades`, optionally `attendance`  
**Controllers:** `Lecturer/GradeController`, `Lecturer/AttendanceController`, `Student/ResultController`  
**Views:** timetable view (student + lecturer), grades entry (lecturer), results view (student)

---

### 3.7 Announcements & Updates
- [ ] Lecturers post announcements per unit
- [ ] Admin posts system-wide notices
- [ ] Students see announcements for their enrolled units + global

**Tables:** `announcements` (title, body, author_id, unit_id nullable, scope: unit|global, created_at)  
**Controllers:** `AnnouncementController` (resource), filter by role and unit  
**Views:** list/detail for students; create/edit for lecturer and admin

---

### 3.8 Reports & Analytics (Admin)
- [ ] Student performance (per unit, per programme)
- [ ] Unit enrollment stats (per unit, per semester)
- [ ] Lecturer activity (units taught, students graded)
- [ ] Export (CSV/PDF) optional

**Controllers:** `Admin/ReportController`  
**Views:** `admin/reports/*` (dashboard charts, tables)

---

## 4. Suggested Implementation Order

1. **Foundation (this repo)**
   - Roles on `users`, `students`, `lecturers` tables
   - `units`, `unit_lecturer`, `enrollments` (unit bookings), `announcements`, `grades`, `timetable_slots`
   - All models and relationships

2. **Auth & access**
   - Breeze install, role-based redirect, role middleware

3. **Super Admin**
   - Dashboard, student CRUD, lecturer CRUD, unit CRUD, assign lecturers to units, approve registrations (if you add approval flow)

4. **Unit booking (student)**
   - Available units, book/drop, my units, timetable view

5. **Lecturer**
   - My units, upload materials (files table + storage), grades, announcements, attendance (optional)

6. **Announcements**
   - Create/list for lecturer and admin; list for student (by unit + global)

7. **Reports**
   - Basic stats and lists; then charts/exports if needed

---

## 5. Tech Stack (Current)

- **Backend:** Laravel 12, PHP 8.2
- **Auth:** Laravel Breeze (to be installed)
- **DB:** MySQL (XAMPP) — configure in `.env`
- **Frontend:** Blade (or Livewire/Inertia per Breeze choice)

---

## 6. Next Commands (After Foundation)

```bash
# Run migrations (foundation tables + role on users)
php artisan migrate

# Seed first Super Admin + optional test student & lecturer
php artisan db:seed
# Default admin: admin@school.test / password

# Install auth scaffolding when ready (choose one stack)
php artisan breeze:install blade
# or: php artisan breeze:install livewire
# or: php artisan breeze:install react
```

---

## 7. File Structure (Target)

```
app/
├── Enums/
│   └── UserRole.php
├── Http/Middleware/
│   └── EnsureUserHasRole.php
├── Models/
│   ├── User.php
│   ├── Student.php
│   ├── Lecturer.php
│   ├── Unit.php
│   ├── Enrollment.php      # unit booking
│   ├── Grade.php
│   ├── Announcement.php
│   └── TimetableSlot.php   # optional
├── Http/Controllers/
│   ├── Admin/
│   │   ├── DashboardController.php
│   │   ├── StudentController.php
│   │   ├── LecturerController.php
│   │   ├── UnitController.php
│   │   └── ReportController.php
│   ├── Student/
│   │   ├── DashboardController.php
│   │   └── UnitBookingController.php
│   └── Lecturer/
│       ├── DashboardController.php
│       ├── GradeController.php
│       └── AnnouncementController.php
database/migrations/
├── ..._add_role_to_users_table.php
├── ..._create_students_table.php
├── ..._create_lecturers_table.php
├── ..._create_units_table.php
├── ..._create_unit_lecturer_table.php
├── ..._create_enrollments_table.php
├── ..._create_grades_table.php
├── ..._create_announcements_table.php
└── ..._create_timetable_slots_table.php
```

This document is the single source of truth for the **complete way forward**. Implement in the order above and tick items as you go.
