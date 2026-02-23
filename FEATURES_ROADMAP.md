# Enterprise Features Roadmap

Phased implementation plan for making the College Management System production-ready.

---

## Phase 1: Access & Configuration

### 1. Role & Permission Management ⭐ ✅ Implemented
- **Role permission control** — who can do what (permission checks via Gates in AppServiceProvider; `$user->hasPermission('slug')`).
- **Custom roles** — Dean, HOD, Registrar (DB roles with type: admin|lecturer|student for dashboard redirect).
- **Permission assignment UI** — Admin → System Settings → Roles & Permissions: list roles, edit role and assign permissions (checkboxes).
- **Feature access control** — Middleware `role:admin` allows any admin-type role; Gates defined for all permission slugs.
- **DB:** `roles`, `permissions`, `role_permission` pivot; `users.role_id` (nullable). Run `RolePermissionSeeder` to seed roles/permissions and sync existing users.

### 2. System Settings Panel ✅ Implemented
- Admin → General: application name, max units per semester (saved to `settings` table).
- **DB:** `settings` (key, value). Seeded by `SettingSeeder`.
- **UI:** Admin → Settings → General (form to save). Max units enforced in unit booking.

---

## Phase 2: Notifications & Communication

### 3. Real-Time Notifications System ✅ Foundation in place
- Unit registration success alerts (UnitRegisteredNotification sent when student enrolls).
- In-app notification bell in header (link to `/notifications` with badge count); mark as read / mark all read.
- **DB:** Laravel `notifications` table (migrated).
- **Next:** Grade upload and announcement notifications; optional email channel; optional WebSockets.

### 4. Email System Integration
- Email verification (Laravel built-in).
- Password reset email (Breeze default).
- Registration confirmation, result release, announcement broadcast.
- **Config:** `.env` mail settings; queue for bulk emails.

### 5. Messaging System
- Student ↔ Lecturer messaging; admin announcements; support requests.
- **DB:** `conversations`, `messages`, optional `message_reads`.

---

## Phase 3: Academic Structure & Rules

### 6. Academic Calendar System ✅ Implemented
- **DB:** `semesters` table (name, slug, start_date, end_date, registration_deadline, exam_start, exam_end, is_current). Seeded by `SemesterSeeder`.
- Admin → Academic Calendar (view dates); Semesters (edit registration deadline, set current semester).
- Unit booking blocked after `registration_deadline` for that semester. Max units per semester from Settings.

### 7. Unit Booking Rules & Validation
- Max units per semester, unit prerequisites, capacity limit, waitlist, conflict detection (time clashes).
- **DB:** `unit_prerequisites` (unit_id, prerequisite_unit_id); config for max_units_per_semester; timetable_slots for conflict check.

### 8. Course / Program Structure
- Departments, Programs (IT, Business), course levels (Year 1–4), curriculum (required vs optional units).
- **DB:** `departments`, `programs`, `program_units` (program_id, unit_id, is_required, year/level).

### 9. Multi-Semester / Multi-Year Support
- Academic years, semester switching, student progression.
- **DB:** `academic_years`, `semesters`; enrollments/grades linked to semester/year.

---

## Phase 4: Learning & Assessment

### 10. Assignment Submission System
- Students: submit assignments, upload files.
- Lecturers: review, grade, feedback comments.
- **DB:** `assignments` (unit_id, title, due_date), `assignment_submissions` (assignment_id, enrollment_id, file_path, submitted_at, grade, feedback).

### 11. GPA & Academic Progress Calculation
- Automatic GPA (from grades table), pass/fail logic, academic warnings, performance tracking.
- **Logic:** Service class using grades; store GPA snapshot on enrollment or separate `academic_records` table.

### 12. File Management System
- Store learning materials; organized structure; size limits; secure downloads (signed URLs or auth middleware).
- **DB:** Store path in `materials` or `unit_materials`; files in `storage/app/`.

---

## Phase 5: Reporting & Analytics

### 13. Analytics Dashboard (Admin) ✅ Implemented
- Admin dashboard: Chart.js bar charts for unit enrollment and students by year; top units list.
- **Tech:** Chart.js 4.x via CDN; data passed from DashboardController.

### 14. PDF Report Generation
- Student transcript, unit registration slip, performance reports, enrollment reports, timetable PDF.
- **Tech:** Laravel DomPDF or Snappy (wkhtmltopdf); Blade templates for layout.

### 15. Audit Logs ⭐ ✅ Implemented
- **DB:** `activity_logs` (user_id, action, subject_type, subject_id, description, old_values, new_values, ip_address, user_agent).
- Grade updates logged from Lecturer GradeController. Admin → Reports → Activity Log (paginated list).

---

## Phase 6: Operations & Polish

### 16. Backup & Restore System
- Database backup (mysqldump or Laravel backup package), restore, backup scheduling.
- **Tech:** spatie/laravel-backup or custom artisan commands.

### 17. Advanced Search & Filtering
- Search students, filter units, filter results; smart filtering on index pages.
- **Implementation:** Query scopes, request()->get('q'), filter form in Blade.

### 18. Mobile Responsive UI
- Ensure layouts work on phone, tablet, laptop (Tailwind responsive classes, sidebar collapse).

### 19. Performance Optimization
- Pagination for all tables; caching (config, settings); lazy loading; query optimization (eager load, indexes).

### 20. Security Hardening
- CSRF (Laravel default), input validation, XSS prevention (Blade escaping), SQL (Eloquent), rate limiting (throttle login), secure file upload (validation, store outside public).

---

## Implementation Order (Recommended)

1. **Role & Permission Management** — Foundation for feature access.
2. **Notifications (in-app + DB)** — High visibility; observers for enrollment, grades, announcements.
3. **Email integration** — Verification, password reset, registration/result/announcement emails.
4. **Academic Calendar** — Drives booking deadlines and semester logic.
5. **Unit Booking Rules** — Max units, prerequisites, conflict detection.
6. **Analytics Dashboard** — Chart.js on admin dashboard.
7. **PDF Reports** — Transcript, registration slip.
8. **Audit Logs** — Activity logging for critical actions.
9. **System Settings** — Central place for app name, registration window, etc.
10. Then: Program structure, assignments, GPA, messaging, file management, backup, search, responsive, performance, security.

---

## Database Migrations (New / Planned)

| Feature            | Tables / Columns |
|--------------------|------------------|
| Roles & Permissions | `roles`, `permissions`, `role_permission`, `users.role_id` |
| Notifications      | `notifications` (Laravel) or `user_notifications` |
| Academic Calendar  | `semesters`, `academic_years` (or extend existing) |
| Booking Rules      | `unit_prerequisites`, settings for max_units |
| Programs           | `departments`, `programs`, `program_units` |
| Assignments        | `assignments`, `assignment_submissions` |
| Audit              | `activity_log` |
| Settings           | `settings` (key-value) |
| Messaging          | `conversations`, `messages` |

This document is the single source of truth for enterprise features. Implement in phases and tick items in WAY_FORWARD.md or here as done.
