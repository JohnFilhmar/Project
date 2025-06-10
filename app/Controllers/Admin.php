<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Admin extends BaseController
{
    public function campaigns()
    {
        $campaigns = [
            [
                'id' => 1,
                'title' => 'Tech for Good',
                'details' => 'Empowering students to use technology for social impact and community development.',
                'image' => 'https://images.unsplash.com/photo-1461749280684-dccba630e2f6?auto=format&fit=crop&w=800&q=80',
                'partylist' => 'Innovators United',
                'date_added' => '2024-01-05',
            ],
            [
                'id' => 2,
                'title' => 'Green Campus Initiative',
                'details' => 'Promoting sustainability and environmental awareness across the campus.',
                'image' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=800&q=80',
                'partylist' => 'Eco Warriors',
                'date_added' => '2024-02-10',
            ],
            [
                'id' => 3,
                'title' => 'Community Outreach',
                'details' => 'Engaging students in outreach programs to help local communities.',
                'image' => '',
                'partylist' => 'Helping Hands',
                'date_added' => '2024-03-15',
            ],
            [
                'id' => 4,
                'title' => 'Digital Literacy Drive',
                'details' => 'Workshops and seminars to improve digital skills among students.',
                'image' => 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&w=800&q=80',
                'partylist' => 'Tech Savvy',
                'date_added' => '2024-04-01',
            ],
            [
                'id' => 5,
                'title' => 'Mental Health Awareness',
                'details' => 'Campaign to support mental health and well-being for all students.',
                'image' => 'https://images.unsplash.com/photo-1503676382389-4809596d5290?auto=format&fit=crop&w=800&q=80',
                'partylist' => 'Mind Matters',
                'date_added' => '2024-04-20',
            ],
            [
                'id' => 6,
                'title' => 'Sports for All',
                'details' => 'Encouraging participation in sports and physical activities.',
                'image' => 'https://images.unsplash.com/photo-1517649763962-0c623066013b?auto=format&fit=crop&w=800&q=80',
                'partylist' => 'Active Youth',
                'date_added' => '2024-05-05',
            ],
        ];
        return view('admin/campaigns', ['campaigns' => $campaigns]);
    }

    public function campaign_lists()
    {
        $campaigns = [
            [
                'id' => 1,
                'title' => 'Tech for Good',
                'details' => 'Empowering students to use technology for social impact and community development.',
                'image' => 'https://images.unsplash.com/photo-1461749280684-dccba630e2f6?auto=format&fit=crop&w=800&q=80',
                'partylist' => 'Innovators United',
                'date_added' => '2024-01-05',
            ],
            [
                'id' => 2,
                'title' => 'Green Campus Initiative',
                'details' => 'Promoting sustainability and environmental awareness across the campus.',
                'image' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=800&q=80',
                'partylist' => 'Eco Warriors',
                'date_added' => '2024-02-10',
            ],
            [
                'id' => 3,
                'title' => 'Community Outreach',
                'details' => 'Engaging students in outreach programs to help local communities.',
                'image' => '',
                'partylist' => 'Helping Hands',
                'date_added' => '2024-03-15',
            ],
            [
                'id' => 4,
                'title' => 'Digital Literacy Drive',
                'details' => 'Workshops and seminars to improve digital skills among students.',
                'image' => 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&w=800&q=80',
                'partylist' => 'Tech Savvy',
                'date_added' => '2024-04-01',
            ],
            [
                'id' => 5,
                'title' => 'Mental Health Awareness',
                'details' => 'Campaign to support mental health and well-being for all students.',
                'image' => 'https://images.unsplash.com/photo-1503676382389-4809596d5290?auto=format&fit=crop&w=800&q=80',
                'partylist' => 'Mind Matters',
                'date_added' => '2024-04-20',
            ],
            [
                'id' => 6,
                'title' => 'Sports for All',
                'details' => 'Encouraging participation in sports and physical activities.',
                'image' => 'https://images.unsplash.com/photo-1517649763962-0c623066013b?auto=format&fit=crop&w=800&q=80',
                'partylist' => 'Active Youth',
                'date_added' => '2024-05-05',
            ],
        ];
        return view('admin/campaign_lists', ['campaigns' => $campaigns]);
    }

    public function results()
    {
        return view('admin/results');
    }

    public function candidates()
    {
        $positions = [
            'Governor' => [
                ['name' => 'Alice Johnson', 'votes' => 120, 'percent' => 60],
                ['name' => 'Bob Smith', 'votes' => 95, 'percent' => 40],
            ],
            'Vice Governor Internal' => [
                ['name' => 'Carol Lee', 'votes' => 110, 'percent' => 55],
                ['name' => 'David Kim', 'votes' => 90, 'percent' => 45],
            ],
            'Vice Governor External' => [
                ['name' => 'Eve Adams', 'votes' => 130, 'percent' => 65],
                ['name' => 'Frank Wright', 'votes' => 70, 'percent' => 35],
            ],
            'Secretary' => [
                ['name' => 'Grace Lin', 'votes' => 140, 'percent' => 70],
                ['name' => 'Helen Cruz', 'votes' => 60, 'percent' => 30],
            ],
            'Treasurer' => [
                ['name' => 'Ian Torres', 'votes' => 125, 'percent' => 62],
                ['name' => 'Jake Evans', 'votes' => 75, 'percent' => 38],
            ],
            'Auditor 1' => [
                ['name' => 'Karen Young', 'votes' => 100, 'percent' => 50],
                ['name' => 'Leo Park', 'votes' => 100, 'percent' => 50],
            ],
            'Auditor 2' => [
                ['name' => 'Mona Diaz', 'votes' => 110, 'percent' => 55],
                ['name' => 'Nate Reed', 'votes' => 90, 'percent' => 45],
            ],
            'Peace Officer' => [
                ['name' => 'Olivia Fox', 'votes' => 135, 'percent' => 67],
                ['name' => 'Paul Grant', 'votes' => 65, 'percent' => 33],
            ],
            'Muse' => [
                ['name' => 'Quinn Lee', 'votes' => 120, 'percent' => 60],
                ['name' => 'Rita Chan', 'votes' => 80, 'percent' => 40],
            ],
            'Escort' => [
                ['name' => 'Sam Cruz', 'votes' => 140, 'percent' => 70],
                ['name' => 'Tom Yu', 'votes' => 60, 'percent' => 30],
            ],
        ];
        $candidateQuotes = [
            'Alice Johnson' => 'Dedicated to progress and unity.',
            'Bob Smith' => 'Committed to serving the people.',
            'Carol Lee' => 'Passionate about student welfare.',
            'David Kim' => 'Focused on inclusive leadership.',
            'Eve Adams' => 'Driven by innovation and results.',
            'Frank Wright' => 'Ready to make a difference.',
            'Grace Lin' => 'Organized for your success.',
            'Helen Cruz' => 'Your voice, your secretary.',
            'Ian Torres' => 'Transparency and trust in finance.',
            'Jake Evans' => 'Accountability at every step.',
            'Karen Young' => 'Ensuring fairness for all.',
            'Leo Park' => 'Integrity in every audit.',
            'Mona Diaz' => 'Committed to honest reporting.',
            'Nate Reed' => 'Your reliable auditor.',
            'Olivia Fox' => 'Peace and order above all.',
            'Paul Grant' => 'Safety is my priority.',
            'Quinn Lee' => 'Inspiring creativity and joy.',
            'Rita Chan' => 'Bringing grace to every event.',
            'Sam Cruz' => 'Leading with confidence.',
            'Tom Yu' => 'Supportive and dependable.',
        ];
        $candidatesList = [];
        foreach ($positions as $position => $candidates) {
            foreach ($candidates as $candidate) {
                $name = $candidate['name'];
                $candidatesList[] = [
                    'name' => $name,
                    'position' => $position,
                    'image' => '/no-profile.png',
                    'quote' => $candidateQuotes[$name] ?? '',
                ];
            }
        }
        return view('admin/candidates', ['candidatesList' => $candidatesList]);
    }
    public function candidate_lists()
    {
        $positions = [
            'Governor' => [
                ['name' => 'Alice Johnson', 'votes' => 120, 'percent' => 60],
                ['name' => 'Bob Smith', 'votes' => 95, 'percent' => 40],
            ],
            'Vice Governor Internal' => [
                ['name' => 'Carol Lee', 'votes' => 110, 'percent' => 55],
                ['name' => 'David Kim', 'votes' => 90, 'percent' => 45],
            ],
            'Vice Governor External' => [
                ['name' => 'Eve Adams', 'votes' => 130, 'percent' => 65],
                ['name' => 'Frank Wright', 'votes' => 70, 'percent' => 35],
            ],
            'Secretary' => [
                ['name' => 'Grace Lin', 'votes' => 140, 'percent' => 70],
                ['name' => 'Helen Cruz', 'votes' => 60, 'percent' => 30],
            ],
            'Treasurer' => [
                ['name' => 'Ian Torres', 'votes' => 125, 'percent' => 62],
                ['name' => 'Jake Evans', 'votes' => 75, 'percent' => 38],
            ],
            'Auditor 1' => [
                ['name' => 'Karen Young', 'votes' => 100, 'percent' => 50],
                ['name' => 'Leo Park', 'votes' => 100, 'percent' => 50],
            ],
            'Auditor 2' => [
                ['name' => 'Mona Diaz', 'votes' => 110, 'percent' => 55],
                ['name' => 'Nate Reed', 'votes' => 90, 'percent' => 45],
            ],
            'Peace Officer' => [
                ['name' => 'Olivia Fox', 'votes' => 135, 'percent' => 67],
                ['name' => 'Paul Grant', 'votes' => 65, 'percent' => 33],
            ],
            'Muse' => [
                ['name' => 'Quinn Lee', 'votes' => 120, 'percent' => 60],
                ['name' => 'Rita Chan', 'votes' => 80, 'percent' => 40],
            ],
            'Escort' => [
                ['name' => 'Sam Cruz', 'votes' => 140, 'percent' => 70],
                ['name' => 'Tom Yu', 'votes' => 60, 'percent' => 30],
            ],
        ];
        $candidateQuotes = [
            'Alice Johnson' => 'Dedicated to progress and unity.',
            'Bob Smith' => 'Committed to serving the people.',
            'Carol Lee' => 'Passionate about student welfare.',
            'David Kim' => 'Focused on inclusive leadership.',
            'Eve Adams' => 'Driven by innovation and results.',
            'Frank Wright' => 'Ready to make a difference.',
            'Grace Lin' => 'Organized for your success.',
            'Helen Cruz' => 'Your voice, your secretary.',
            'Ian Torres' => 'Transparency and trust in finance.',
            'Jake Evans' => 'Accountability at every step.',
            'Karen Young' => 'Ensuring fairness for all.',
            'Leo Park' => 'Integrity in every audit.',
            'Mona Diaz' => 'Committed to honest reporting.',
            'Nate Reed' => 'Your reliable auditor.',
            'Olivia Fox' => 'Peace and order above all.',
            'Paul Grant' => 'Safety is my priority.',
            'Quinn Lee' => 'Inspiring creativity and joy.',
            'Rita Chan' => 'Bringing grace to every event.',
            'Sam Cruz' => 'Leading with confidence.',
            'Tom Yu' => 'Supportive and dependable.',
        ];
        $candidatesList = [];
        $id = 1;
        foreach ($positions as $position => $candidates) {
            foreach ($candidates as $candidate) {
                $name = $candidate['name'];
                $candidatesList[] = [
                    'id' => $id++,
                    'name' => $name,
                    'position' => $position,
                    'image' => '/no-profile.png',
                    'quote' => $candidateQuotes[$name] ?? '',
                ];
            }
        }
        return view('admin/candidate_lists', ['candidatesList' => $candidatesList]);
    }

    public function ballots()
    {
        $ballots = [
            [
                'organization' => 'Acme Corp',
                'created_at' => '2024-06-01 10:30:00'
            ],
            [
                'organization' => 'Beta Group',
                'created_at' => '2024-06-02 14:15:00'
            ],
            [
                'organization' => 'Gamma LLC',
                'created_at' => '2024-06-03 09:45:00'
            ]
        ];
        return view('admin/ballots', ['ballots' => $ballots]);
    }

    public function studentLists()
    {
        $yearLevels = ['1' => '1st Year', '2' => '2nd Year', '3' => '3rd Year', '4' => '4th Year'];
        $courses = ['BSIT' => 'BSIT', 'BSCS' => 'BSCS', 'BSBA' => 'BSBA', 'BSA' => 'BSA'];
        $organizationsList = ['JPCS', 'SC', 'GDSC'];

        $students = [];

        for ($i = 1; $i <= 20; $i++) {
            $student_number = '2023-' . str_pad($i, 4, '0', STR_PAD_LEFT);
            $first = "Student{$i}";
            $last = "Lastname{$i}";
            $course = array_rand($courses);
            $year_level = rand(1, 4);
            $org_count = rand(1, 2);
            $org_selection = array_rand(array_flip($organizationsList), $org_count);
            $organizations = is_array($org_selection) ? implode(', ', $org_selection) : $org_selection;

            $students[$student_number] = [
                'full_name' => "$first $last",
                'email' => strtolower($first) . "@school.edu.ph",
                'course' => $course,
                'year_level' => $year_level,
                'organizations' => $organizations,
            ];
        }

        // Filtering section
        $selectedYearLevel = $this->request->getGet('year_level');
        $selectedCourse = $this->request->getGet('course');
        $selectedOrganization = $this->request->getGet('organization');

        if ($selectedYearLevel) {
            $students = array_filter($students, fn($s) => $s['year_level'] == $selectedYearLevel);
        }
        if ($selectedCourse) {
            $students = array_filter($students, fn($s) => $s['course'] == $selectedCourse);
        }
        if ($selectedOrganization) {
            $students = array_filter($students, fn($s) => str_contains($s['organizations'], $selectedOrganization));
        }

        return view('admin/student_lists', [
            'students' => $students,
            'yearLevels' => $yearLevels,
            'courses' => $courses,
            'organizations' => array_combine($organizationsList, $organizationsList),
            'selectedYearLevel' => $selectedYearLevel,
            'selectedCourse' => $selectedCourse,
            'selectedOrganization' => $selectedOrganization,
        ]);
    }

    public function profile()
    {
        // NOTIFICATION POP-UP
        session()->setFlashdata('notif', 'You have navigated to the profile window!');
        return view('admin/profile', [
            'fullname'   => 'adminuser',
            'email'      => 'admin@example.com',
            'role'       => 'Administrator',
            'created_at' => '2024-01-15 10:23:45',
            'last_login' => '2024-06-10 14:05:12',
            'organization' => 'Tech University',
            'profile_image_url' => 'https://via.placeholder.com/150',
        ]);
    }

    public function profile_election()
    {
        return view('admin/profile');
    }
    public function profile_organization()
    {
        return view('admin/profile', [
            'organizations' => [
                1001 => [
                    'organization_name' => 'Red Cross Youth',
                    'date_created' => '2022-09-15',
                    'status' => 'active'
                ],
                1002 => [
                    'organization_name' => 'Rotaract',
                    'date_created' => '2021-11-10',
                    'status' => 'inactive'
                ],
                1003 => [
                    'organization_name' => 'JPCS',
                    'date_created' => '2023-01-05',
                    'status' => 'active'
                ],
                1004 => [
                    'organization_name' => 'ACSS',
                    'date_created' => '2022-05-20',
                    'status' => 'inactive'
                ],
                1005 => [
                    'organization_name' => 'GDSC',
                    'date_created' => '2023-03-12',
                    'status' => 'active'
                ],
                1006 => [
                    'organization_name' => 'SC',
                    'date_created' => '2021-08-30',
                    'status' => 'active'
                ],
                1007 => [
                    'organization_name' => 'None',
                    'date_created' => '2020-12-01',
                    'status' => 'inactive'
                ],
            ],
        ]);
    }
    public function profile_position()
    {
        return view('admin/profile', [
            'positions' => [
                'Red Cross Youth' => [
                    [
                        'position_no' => 1,
                        'position_name' => 'President',
                        'position_is_active' => true
                    ],
                    [
                        'position_no' => 2,
                        'position_name' => 'Vice President',
                        'position_is_active' => true
                    ],
                ],
                'Rotaract' => [
                    [
                        'position_no' => 1,
                        'position_name' => 'Chairperson',
                        'position_is_active' => false
                    ],
                ],
                'JPCS' => [
                    [
                        'position_no' => 1,
                        'position_name' => 'Secretary',
                        'position_is_active' => true
                    ],
                ],
                'GDSC' => [
                    [
                        'position_no' => 1,
                        'position_name' => 'Lead',
                        'position_is_active' => true
                    ],
                ],
                'SC' => [
                    [
                        'position_no' => 1,
                        'position_name' => 'Treasurer',
                        'position_is_active' => false
                    ],
                ],
            ]
        ]);
    }
    public function profile_officers()
    {
        return view('admin/profile', [
            'officers' => [
                [
                    'full_name' => 'John Smith',
                    'organization' => 'Red Cross Youth',
                    'email' => 'john.smith@school.edu.ph',
                    'profile_image' => 'https://randomuser.me/api/portraits/men/1.jpg'
                ],
                [
                    'full_name' => 'Jane Johnson',
                    'organization' => 'Rotaract',
                    'email' => 'jane.johnson@school.edu.ph',
                    'profile_image' => 'https://randomuser.me/api/portraits/women/2.jpg'
                ],
                [
                    'full_name' => 'Michael Williams',
                    'organization' => 'JPCS',
                    'email' => 'michael.williams@school.edu.ph',
                    'profile_image' => ''
                ],
                [
                    'full_name' => 'Emily Brown',
                    'organization' => 'GDSC',
                    'email' => 'emily.brown@school.edu.ph',
                    'profile_image' => 'https://randomuser.me/api/portraits/women/3.jpg'
                ],
                [
                    'full_name' => 'Daniel Garcia',
                    'organization' => 'SC',
                    'email' => 'daniel.garcia@school.edu.ph',
                    'profile_image' => ''
                ],
            ]
        ]);
    }
}
