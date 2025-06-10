<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Admin extends BaseController
{
    public function index()
    {
        return view('admin/campaigns');
    }

    public function results()
    {
        return view('admin/results');
    }

    public function candidates()
    {
        return view('admin/candidates');
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
