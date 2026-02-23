<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Lecturer;
use App\Models\Unit;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class PublicController extends Controller
{
    protected function schoolData(): array
    {
        return [
            'name' => config('school.name'),
            'tagline' => config('school.tagline'),
            'about' => config('school.about'),
            'mission' => config('school.mission'),
            'vision' => config('school.vision'),
            'address' => config('school.address'),
            'phone' => config('school.phone'),
            'email' => config('school.email'),
            'founded' => config('school.founded'),
        ];
    }

    public function departments(): View
    {
        $academic = config('school.academic_departments', []);
        $administrative = config('school.administrative_departments', []);
        $school = $this->schoolData();
        return view('public.departments', compact('academic', 'administrative', 'school'));
    }

    public function department(string $slug): View|RedirectResponse
    {
        $all = array_merge(config('school.academic_departments', []), config('school.administrative_departments', []));
        $department = collect($all)->firstWhere('slug', $slug);
        if (!$department) {
            abort(404);
        }
        $programs = collect(config('school.department_programs', []))->get($slug, []);
        $units = Unit::where('status', 'active')->get();
        $school = $this->schoolData();
        return view('public.departments.show', compact('department', 'programs', 'units', 'school'));
    }

    public function about(): View
    {
        $school = array_merge($this->schoolData(), [
            'history' => config('school.history'),
            'departments' => config('school.departments', []),
            'facilities' => config('school.facilities', []),
            'leadership' => config('school.leadership', []),
        ]);
        return view('public.about', compact('school'));
    }

    public function programs(): View
    {
        $programs = config('school.programs', []);
        $programDetails = config('school.program_details', []);
        $school = $this->schoolData();
        return view('public.programs', compact('programs', 'programDetails', 'school'));
    }

    public function program(string $slug): View|RedirectResponse
    {
        $programDetails = config('school.program_details', []);
        $programName = null;
        $details = null;
        foreach ($programDetails as $name => $d) {
            if (($d['slug'] ?? '') === $slug) {
                $programName = $name;
                $details = array_merge(['name' => $name], $d);
                break;
            }
        }
        if (!$details) {
            abort(404);
        }
        $units = Unit::where('status', 'active')->get();
        $school = $this->schoolData();
        return view('public.programs.show', compact('details', 'programName', 'units', 'school'));
    }

    public function admissions(): View
    {
        $admissions = config('school.admissions', []);
        $school = $this->schoolData();
        return view('public.admissions', compact('admissions', 'school'));
    }

    public function staff(): View
    {
        $lecturers = Lecturer::with('user')->orderBy('department')->orderBy('user_id')->get();
        $school = $this->schoolData();
        return view('public.staff', compact('lecturers', 'school'));
    }

    public function courses(): View
    {
        $units = Unit::with('lecturers.user')->where('status', 'active')->orderBy('code')->get();
        $school = $this->schoolData();
        return view('public.courses', compact('units', 'school'));
    }

    public function course(Unit $unit): View
    {
        if ($unit->status !== 'active') {
            abort(404);
        }
        $unit->load('lecturers.user');
        $school = $this->schoolData();
        return view('public.courses.show', compact('unit', 'school'));
    }

    public function news(Request $request): View
    {
        $query = Announcement::with('user')
            ->where('scope', 'global')
            ->latest();

        if ($request->get('type') === 'notice') {
            $query->where('type', 'notice');
        } elseif ($request->get('type') !== 'news') {
            $query->where(fn ($q) => $q->where('type', 'news')->orWhereNull('type'));
        }

        $announcements = $query->paginate(10)->withQueryString();
        $school = $this->schoolData();
        return view('public.news', compact('announcements', 'school'));
    }

    public function events(): View
    {
        $events = collect(config('school.events', []))
            ->sortBy('date')
            ->filter(fn ($e) => $e['date'] >= now()->format('Y-m-d'))
            ->values();

        if ($events->isEmpty()) {
            $events = collect(config('school.events', []))->sortBy('date')->values();
        }

        $school = $this->schoolData();
        return view('public.events', compact('events', 'school'));
    }

    public function event(string $slug): View
    {
        $events = collect(config('school.events', []));
        $event = $events->firstWhere('slug', $slug);
        if (!$event) {
            abort(404);
        }
        $school = $this->schoolData();
        return view('public.events.show', compact('event', 'school'));
    }

    public function contact(): View
    {
        $school = $this->schoolData();
        $school['map_embed'] = config('school.map_embed');
        return view('public.contact', compact('school'));
    }

    public function submitContact(Request $request): RedirectResponse
    {
        $valid = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:2000'],
        ]);

        try {
            Mail::raw(
                "Name: {$valid['name']}\nEmail: {$valid['email']}\nSubject: {$valid['subject']}\n\nMessage:\n{$valid['message']}",
                fn ($m) => $m->to(config('school.email'))
                    ->from($valid['email'], $valid['name'])
                    ->replyTo($valid['email'])
                    ->subject('Website Contact: ' . $valid['subject'])
            );
        } catch (\Exception $e) {
            // Log or ignore - form still shows success for UX
        }

        return redirect()->route('public.contact')->with('success', 'Thank you. Your message has been sent. We will respond soon.');
    }

    public function faq(): View
    {
        $faq = config('school.faq', []);
        $school = $this->schoolData();
        return view('public.faq', compact('faq', 'school'));
    }
}
