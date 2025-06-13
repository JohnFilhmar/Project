<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Admin extends BaseController
{
    public function profile()
    {
        // NOTIFICATION POP-UP
        session()->setFlashdata('notif', 'You have navigated to the profile window!');
        return view('admin/profile');
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
