<?php

namespace Database\Seeders;

use App\Models\Semester;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SemesterSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();
        $semesters = [
            [
                'name' => 'Semester 1',
                'slug' => 'semester_1',
                'start_date' => $now->copy()->month(9)->startOfMonth(),
                'end_date' => $now->copy()->month(12)->endOfMonth(),
                'registration_deadline' => $now->copy()->month(9)->endOfMonth(),
                'is_current' => true,
            ],
            [
                'name' => 'Semester 2',
                'slug' => 'semester_2',
                'start_date' => $now->copy()->addYear()->month(1)->startOfMonth(),
                'end_date' => $now->copy()->addYear()->month(5)->endOfMonth(),
                'registration_deadline' => $now->copy()->addYear()->month(2)->endOfMonth(),
                'is_current' => false,
            ],
        ];
        foreach ($semesters as $s) {
            Semester::updateOrCreate(['slug' => $s['slug']], $s);
        }
    }
}
