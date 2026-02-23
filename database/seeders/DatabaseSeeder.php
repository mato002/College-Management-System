<?php

namespace Database\Seeders;

use App\Models\Announcement;
use App\Models\Enrollment;
use App\Models\Grade;
use App\Models\Lecturer;
use App\Models\Role;
use App\Models\Student;
use App\Models\Unit;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database with full demo data.
     */
    public function run(): void
    {
        $this->call(RolePermissionSeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(SemesterSeeder::class);

        $superAdminRole = Role::where('slug', 'super_admin')->first();
        $studentRole = Role::where('slug', 'student')->first();
        $lecturerRole = Role::where('slug', 'lecturer')->first();

        // --- Super Admin ---
        $admin = User::factory()->superAdmin()->create([
            'name' => 'Super Admin',
            'email' => 'admin@school.test',
        ]);
        if ($superAdminRole) {
            $admin->update(['role_id' => $superAdminRole->id]);
        }

        // --- Students (6 total; first one is the main test login) ---
        $studentsData = [
            ['name' => 'Test Student', 'email' => 'student@school.test', 'reg_no' => 'STU001', 'programme' => 'Computer Science', 'year' => 1],
            ['name' => 'Jane Wanjiku', 'email' => 'jane.wanjiku@school.test', 'reg_no' => 'STU002', 'programme' => 'Computer Science', 'year' => 1],
            ['name' => 'Peter Ochieng', 'email' => 'peter.ochieng@school.test', 'reg_no' => 'STU003', 'programme' => 'Computer Science', 'year' => 2],
            ['name' => 'Mary Akinyi', 'email' => 'mary.akinyi@school.test', 'reg_no' => 'STU004', 'programme' => 'Information Technology', 'year' => 1],
            ['name' => 'James Kipchoge', 'email' => 'james.kipchoge@school.test', 'reg_no' => 'STU005', 'programme' => 'Information Technology', 'year' => 2],
            ['name' => 'Grace Muthoni', 'email' => 'grace.muthoni@school.test', 'reg_no' => 'STU006', 'programme' => 'Computer Science', 'year' => 1],
        ];
        $students = [];
        foreach ($studentsData as $i => $data) {
            $u = User::factory()->create(['name' => $data['name'], 'email' => $data['email']]);
            if ($studentRole) {
                $u->update(['role_id' => $studentRole->id]);
            }
            $students[] = Student::create([
                'user_id' => $u->id,
                'reg_no' => $data['reg_no'],
                'programme' => $data['programme'],
                'year_of_study' => $data['year'],
                'status' => 'active',
            ]);
            UserProfile::updateOrCreate(
                ['user_id' => $u->id],
                [
                    'phone' => '+2547000000' . str_pad((string)(10 + $i), 2, '0', STR_PAD_LEFT),
                    'date_of_birth' => '200' . (5 - ($i % 3)) . '-0' . (($i % 9) + 1) . '-15',
                    'gender' => $i % 2 === 0 ? 'male' : 'female',
                    'nationality' => 'Kenyan',
                    'address_line1' => 'P.O. Box ' . (100 + $i) . ', Campus',
                    'city' => ['Kisumu', 'Nairobi', 'Nakuru', 'Mombasa', 'Eldoret', 'Kakamega'][$i % 6],
                    'country' => 'Kenya',
                    'emergency_contact_name' => 'Guardian ' . $data['reg_no'],
                    'emergency_contact_phone' => '+25471100000' . $i,
                ]
            );
        }

        // --- Lecturers (2 total) ---
        $lecturersData = [
            ['name' => 'Test Lecturer', 'email' => 'lecturer@school.test', 'emp_id' => 'EMP001', 'dept' => 'Computing', 'title' => 'Dr.'],
            ['name' => 'Prof. Samuel Otieno', 'email' => 'samuel.otieno@school.test', 'emp_id' => 'EMP002', 'dept' => 'Computing', 'title' => 'Prof.'],
        ];
        $lecturers = [];
        foreach ($lecturersData as $i => $data) {
            $u = User::factory()->lecturer()->create(['name' => $data['name'], 'email' => $data['email']]);
            if ($lecturerRole) {
                $u->update(['role_id' => $lecturerRole->id]);
            }
            $lecturers[] = Lecturer::create([
                'user_id' => $u->id,
                'employee_id' => $data['emp_id'],
                'department' => $data['dept'],
                'title' => $data['title'],
            ]);
            UserProfile::updateOrCreate(
                ['user_id' => $u->id],
                [
                    'phone' => '+25470000002' . $i,
                    'date_of_birth' => '198' . (3 + $i) . '-06-10',
                    'gender' => $i === 0 ? 'female' : 'male',
                    'nationality' => 'Kenyan',
                    'address_line1' => 'Staff Quarters, Main Campus',
                    'city' => 'Kakamega',
                    'country' => 'Kenya',
                    'emergency_contact_name' => 'Next of Kin',
                    'emergency_contact_phone' => '+254700000020',
                ]
            );
        }
        $lecturer1 = $lecturers[0];
        $lecturer2 = $lecturers[1];
        $lecturer1User = User::where('email', 'lecturer@school.test')->first();
        $lecturer2User = User::where('email', 'samuel.otieno@school.test')->first();

        // --- Units ---
        $unit1 = Unit::create(['code' => 'CS101', 'name' => 'Introduction to Programming', 'description' => 'Basic programming concepts using PHP.', 'semester' => '2025-1', 'capacity' => 40, 'credits' => 3, 'status' => 'active']);
        $unit2 = Unit::create(['code' => 'CS102', 'name' => 'Database Systems', 'description' => 'Relational databases and SQL.', 'semester' => '2025-1', 'capacity' => 40, 'credits' => 3, 'status' => 'active']);
        $unit3 = Unit::create(['code' => 'CS201', 'name' => 'Data Structures', 'description' => 'Lists, trees, graphs and algorithms.', 'semester' => '2025-2', 'capacity' => 35, 'credits' => 4, 'status' => 'active']);
        $unit4 = Unit::create(['code' => 'CS202', 'name' => 'Web Development', 'description' => 'HTML, CSS, JavaScript and Laravel.', 'semester' => '2025-2', 'capacity' => 35, 'credits' => 4, 'status' => 'active']);
        $unit5 = Unit::create(['code' => 'CS301', 'name' => 'Software Engineering', 'description' => 'Design patterns, testing, deployment.', 'semester' => '2025-2', 'capacity' => 30, 'credits' => 4, 'status' => 'active']);

        $lecturer1->units()->attach([$unit1->id, $unit2->id, $unit3->id], ['semester' => '2025-1']);
        $lecturer1->units()->attach([$unit3->id, $unit4->id], ['semester' => '2025-2']);
        $lecturer2->units()->attach([$unit5->id], ['semester' => '2025-2']);
        $lecturer2->units()->attach([$unit2->id], ['semester' => '2025-1']);

        // --- Enrollments (spread students across units) ---
        $enrollments2025_1 = [];
        $semester = '2025-1';
        foreach ([$unit1->id, $unit2->id] as $unitId) {
            foreach ([0, 1, 2, 3, 4, 5] as $idx) {
                $enrollments2025_1[] = Enrollment::create([
                    'student_id' => $students[$idx]->id,
                    'unit_id' => $unitId,
                    'semester' => $semester,
                    'status' => 'enrolled',
                    'enrolled_at' => now()->subDays(20 - $idx),
                ]);
            }
        }
        foreach ([$unit3->id, $unit4->id] as $unitId) {
            foreach ([0, 1, 2] as $idx) {
                Enrollment::create([
                    'student_id' => $students[$idx]->id,
                    'unit_id' => $unitId,
                    'semester' => '2025-2',
                    'status' => 'enrolled',
                    'enrolled_at' => now()->subDays(5),
                ]);
            }
        }
        Enrollment::create(['student_id' => $students[2]->id, 'unit_id' => $unit5->id, 'semester' => '2025-2', 'status' => 'enrolled', 'enrolled_at' => now()->subDays(3)]);

        // --- Grades for 2025-1 enrollments (so results/grades pages have data) ---
        $scoreToGrade = function ($score) {
            if ($score >= 70) return ['A', $score];
            if ($score >= 60) return ['B', $score];
            if ($score >= 50) return ['C', $score];
            if ($score >= 40) return ['D', $score];
            return ['E', $score];
        };
        foreach ($enrollments2025_1 as $enr) {
            $score = rand(42, 92);
            [$grade, $s] = $scoreToGrade($score);
            Grade::create([
                'enrollment_id' => $enr->id,
                'score' => $s,
                'grade' => $grade,
                'semester' => $semester,
                'entered_by' => $lecturer1User->id,
            ]);
        }

        // --- Announcements (global + unit) ---
        Announcement::create([
            'title' => 'Opening of New Semester',
            'body' => 'The new semester will commence on 1st March. All students are required to report by that date.',
            'user_id' => $admin->id,
            'scope' => Announcement::SCOPE_GLOBAL,
            'type' => Announcement::TYPE_NOTICE,
        ]);
        Announcement::create([
            'title' => 'First Programming Lab Session',
            'body' => 'CS101 lab will be held on Wednesday 10:00am in Lab 1. Ensure you have PHP and Composer installed.',
            'user_id' => $lecturer1User->id,
            'unit_id' => $unit1->id,
            'scope' => Announcement::SCOPE_UNIT,
            'type' => Announcement::TYPE_NEWS,
        ]);
        Announcement::create([
            'title' => 'Exam Timetable Published',
            'body' => 'The end-of-semester exam timetable is now available on the portal. Check your units and venues.',
            'user_id' => $admin->id,
            'scope' => Announcement::SCOPE_GLOBAL,
            'type' => Announcement::TYPE_NEWS,
        ]);
        Announcement::create([
            'title' => 'CS102 Database Lab',
            'body' => 'This week we will use MySQL and Laravel migrations. Bring your laptops.',
            'user_id' => $lecturer1User->id,
            'unit_id' => $unit2->id,
            'scope' => Announcement::SCOPE_UNIT,
            'type' => Announcement::TYPE_NOTICE,
        ]);
        Announcement::create([
            'title' => 'Software Engineering Project Groups',
            'body' => 'CS301: Please form groups of 3–4 and submit your group list by Friday.',
            'user_id' => $lecturer2User->id,
            'unit_id' => $unit5->id,
            'scope' => Announcement::SCOPE_UNIT,
            'type' => Announcement::TYPE_NOTICE,
        ]);
    }
}
