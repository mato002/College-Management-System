<?php

return [
    'name' => env('SCHOOL_NAME', env('APP_NAME', 'College Management System')),
    'tagline' => env('SCHOOL_TAGLINE', 'Excellence in Education'),
    'about' => env('SCHOOL_ABOUT', 'A leading institution committed to providing quality education and fostering academic excellence. We prepare students for success through innovative programs and dedicated faculty.'),
    'history' => env('SCHOOL_HISTORY', 'Founded in 1990, our institution has grown from a small college to a recognized center of learning. Over the years we have graduated thousands of students who now contribute to various sectors.'),
    'mission' => env('SCHOOL_MISSION', 'To provide accessible, high-quality education that empowers students to achieve their full potential and contribute meaningfully to society.'),
    'vision' => env('SCHOOL_VISION', 'To be a model institution recognized for academic excellence, innovative research, and community engagement.'),
    'address' => env('SCHOOL_ADDRESS', '123 Education Avenue, Campus District'),
    'phone' => env('SCHOOL_PHONE', '+1 (555) 123-4567'),
    'email' => env('SCHOOL_EMAIL', 'info@school.edu'),
    'founded' => env('SCHOOL_FOUNDED', '1990'),
    'map_embed' => env('SCHOOL_MAP_EMBED', null), // Google Maps embed URL if needed

    'programs' => [
        env('SCHOOL_PROGRAM_1', 'Business & Economics'),
        env('SCHOOL_PROGRAM_2', 'Computer Science & IT'),
        env('SCHOOL_PROGRAM_3', 'Engineering'),
        env('SCHOOL_PROGRAM_4', 'Arts & Humanities'),
    ],

    'program_details' => [
        'Business & Economics' => ['slug' => 'business-economics', 'duration' => '4 years', 'credits' => 120, 'requirements' => 'KCSE C+ or equivalent', 'description' => 'Comprehensive training in business administration, economics, accounting, and entrepreneurship. Graduates are equipped for careers in management, finance, and enterprise development.'],
        'Computer Science & IT' => ['slug' => 'computer-science', 'duration' => '4 years', 'credits' => 120, 'requirements' => 'KCSE C+ with B in Maths', 'description' => 'Software development, systems analysis, networking, and IT infrastructure. Prepares students for roles in technology and digital innovation.'],
        'Engineering' => ['slug' => 'engineering', 'duration' => '5 years', 'credits' => 150, 'requirements' => 'KCSE B with B+ in Maths & Physics', 'description' => 'Civil, electrical, mechanical, and electronics engineering. Hands-on technical training aligned with industry standards.'],
        'Arts & Humanities' => ['slug' => 'arts-humanities', 'duration' => '4 years', 'credits' => 120, 'requirements' => 'KCSE C+ or equivalent', 'description' => 'Liberal arts, languages, social sciences, and creative disciplines. Builds critical thinking and communication skills.'],
    ],

    'admissions' => [
        'process' => [
            'Submit online application',
            'Provide academic transcripts',
            'Pay application fee',
            'Attend interview (if required)',
            'Receive offer letter',
        ],
        'requirements' => 'Minimum KCSE C+ or equivalent qualification. Specific programs may have additional requirements.',
        'fees' => [
            'application_fee' => 'KSh 2,000',
            'tuition_per_year' => 'KSh 120,000 - 180,000 (varies by program)',
        ],
        'intake_dates' => ['September', 'January', 'May'],
    ],

    'departments' => ['Computing', 'Business', 'Engineering', 'Arts & Humanities', 'Sciences'],

    'social' => [
        'facebook' => env('SCHOOL_FACEBOOK', '#'),
        'twitter' => env('SCHOOL_TWITTER', '#'),
        'instagram' => env('SCHOOL_INSTAGRAM', '#'),
        'whatsapp' => env('SCHOOL_WHATSAPP', '#'),
    ],

    'academic_departments' => [
        ['name' => 'Agriculture & Environmental Studies', 'slug' => 'agriculture', 'icon' => 'leaf', 'description' => 'Training in agriculture, environmental science, and sustainable practices for food security and environmental conservation.'],
        ['name' => 'Applied Sciences', 'slug' => 'sciences', 'icon' => 'beaker', 'description' => 'Applied mathematics, physics, chemistry and laboratory sciences supporting technical and engineering programmes.'],
        ['name' => 'Building and Civil Engineering', 'slug' => 'building', 'icon' => 'building', 'description' => 'Construction technology, structural engineering, surveying, and civil infrastructure development.'],
        ['name' => 'Business & Entrepreneurship Studies', 'slug' => 'business', 'icon' => 'briefcase', 'description' => 'Business administration, accounting, entrepreneurship, and management for industry and enterprise.'],
        ['name' => 'Computing & Informatics', 'slug' => 'computing', 'icon' => 'monitor', 'description' => 'Computer science, information technology, software development, and digital systems.'],
        ['name' => 'Electrical & Electronics Engineering', 'slug' => 'electrical', 'icon' => 'chip', 'description' => 'Electrical power, electronics, automation, and control systems engineering.'],
        ['name' => 'Health Sciences', 'slug' => 'health', 'icon' => 'heart', 'description' => 'Nursing, public health, laboratory technology, and allied health sciences.'],
        ['name' => 'Hospitality, Institutional Management Fashion & Design', 'slug' => 'hospitality', 'icon' => 'academic-cap', 'description' => 'Hospitality management, tourism, culinary arts, and fashion design.'],
        ['name' => 'Mechanical and Automotive Engineering', 'slug' => 'mechanical', 'icon' => 'cog', 'description' => 'Mechanical engineering, automotive technology, and manufacturing systems.'],
    ],

    'administrative_departments' => [
        ['name' => 'Enterprises', 'slug' => 'enterprises', 'description' => 'Institutional enterprises, income-generating projects, and industry partnerships.'],
        ['name' => 'Career Services', 'slug' => 'career', 'description' => 'Career guidance, internship placements, and employer linkages for graduates.'],
        ['name' => 'Guidance and Counselling', 'slug' => 'counselling', 'description' => 'Student counselling, wellness programmes, and pastoral support.'],
        ['name' => 'Games and Sports', 'slug' => 'sports', 'description' => 'Sports, athletics, and recreational activities for students and staff.'],
        ['name' => 'Examinations', 'slug' => 'examinations', 'description' => 'Examination administration, moderation, and certification.'],
        ['name' => 'Quality Assurance', 'slug' => 'quality', 'description' => 'Quality assurance, curriculum review, and institutional accreditation.'],
        ['name' => 'Finance and Accounts', 'slug' => 'finance', 'description' => 'Financial management, fee payment, and bursary administration.'],
        ['name' => 'Town Campus', 'slug' => 'town-campus', 'description' => 'Satellite campus operations and programmes offered at Town Campus.'],
        ['name' => 'Maturu Campus', 'slug' => 'maturu-campus', 'description' => 'Satellite campus operations and programmes offered at Maturu Campus.'],
    ],

    'department_programs' => [
        'computing' => ['Computer Science & IT', 'Information Technology'],
        'business' => ['Business & Economics'],
        'electrical' => ['Engineering'],
        'mechanical' => ['Engineering'],
        'building' => ['Engineering'],
        'sciences' => ['Engineering', 'Computer Science & IT'],
        'agriculture' => ['Agriculture'],
        'health' => ['Health Sciences'],
        'hospitality' => ['Hospitality & Tourism'],
    ],

    'downloads' => [
        ['label' => 'Prospectus', 'url' => '#'],
        ['label' => 'Fee Structure', 'url' => '#'],
        ['label' => 'Application Form', 'url' => '#'],
        ['label' => 'Student Portal', 'url' => '/login'],
    ],

    'facilities' => [
        'Modern library with digital resources',
        'Computer labs and IT support',
        'Student accommodation',
        'Sports and recreation facilities',
        'Cafeteria and dining',
        'Health center',
    ],

    'leadership' => [
        ['name' => 'Dr. Jane Mwangi', 'role' => 'Principal', 'department' => 'Office of the Principal'],
        ['name' => 'Prof. James Otieno', 'role' => 'Deputy Principal (Academic)', 'department' => 'Academic Affairs'],
        ['name' => 'Dr. Mary Wambui', 'role' => 'Registrar', 'department' => 'Registry'],
    ],

    'events' => [
        ['slug' => 'open-day-2025', 'title' => 'Open Day', 'date' => '2025-03-15', 'type' => 'Event', 'description' => 'Visit our campus, tour facilities, meet lecturers, and learn about our programmes. Ideal for prospective students and parents.'],
        ['slug' => 'career-fair-2025', 'title' => 'Career Fair', 'date' => '2025-04-20', 'type' => 'Event', 'description' => 'Meet employers, explore career opportunities, and network with industry professionals.'],
        ['slug' => 'graduation-2025', 'title' => 'Annual Graduation', 'date' => '2025-07-25', 'type' => 'Ceremony', 'description' => 'Graduation ceremony for the class of 2025. Celebrate the achievements of our graduates.'],
        ['slug' => 'tech-innovation-seminar', 'title' => 'Tech Innovation Seminar', 'date' => '2025-05-10', 'type' => 'Seminar', 'description' => 'Industry experts discuss emerging technology trends and digital transformation.'],
    ],

    'faq' => [
        ['q' => 'How do I apply for admission?', 'a' => 'Complete the online application form, submit your academic transcripts, and pay the application fee. You will receive confirmation within 2 weeks.'],
        ['q' => 'What are the tuition fees?', 'a' => 'Tuition varies by program. Contact the admissions office for the current fee structure. Scholarships and payment plans are available.'],
        ['q' => 'When does the next intake start?', 'a' => 'We have three intakes per year: September, January, and May. Application deadlines are typically 2 months before each intake.'],
        ['q' => 'How can I access the student portal?', 'a' => 'Once registered, use your student ID and password to log in at the Student Portal. Click "Log in" from the homepage.'],
        ['q' => 'Where can I view my results?', 'a' => 'Log in to the student portal and navigate to Results. Results are published after each semester.'],
        ['q' => 'How do I register for units?', 'a' => 'Log in to the portal during the registration period, go to Unit Booking, and select your units for the semester.'],
    ],
];
