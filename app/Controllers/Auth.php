<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Auth extends BaseController
{
    // LOGIN PAGE
    public function login()
    {
        return view('login');
    }

    // REGISTRATION PAGE
    public function register()
    {
        $orgModel = new \App\Models\Organizations();
        $orgResults = $orgModel->select('organization_name')->findAll();
        $organizations = ['' => 'Select organization'];
        foreach ($orgResults as $org) {
            $name = $org['organization_name'];
            $nameFormatted = ucwords(str_replace('_', ' ', strtolower($name)));
            $organizations[$name] = $nameFormatted;
        }
        return view('register', ['organizations' => $organizations]);
    }

    // AUTHENTICATION
    public function signin()
    {
        helper(['form']);
        $userModel = new \App\Models\Users();
        $studentModel = new \App\Models\Students();
        $organizationModel = new \App\Models\Organizations();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Try to find user in Users table
        $user = $userModel->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            if (isset($user['is_active']) && !$user['is_active']) {
                return redirect()->to('/login')->with('error', 'Your account is not active.');
            }
            session()->set([
                'user_id'      => $user['user_id'],
                'email'        => $user['email'],
                'first_name'   => $user['first_name'],
                'middle_name'  => $user['middle_name'],
                'last_name'    => $user['last_name'],
                'image_url'    => $user['image_url'],
                'organization' => $organizationModel->select('organization_name')->where('organization_id', $user['organization_id'])->first()['organization_name'],
                'role'         => $user['role'],
                'isLoggedIn'   => true
            ]);

            // Redirect based on role
            switch ($user['role']) {
                case 'admin':
                    return redirect()->to('/admin');
                case 'officer':
                    return redirect()->to('/officer');
                case 'student':
                    return redirect()->to('/student');
                default:
                    session()->remove(['user_id', 'email', 'role', 'first_name', 'last_name', 'middle_name', 'image_url', ' organization', 'isLoggedIn']);
                    return redirect()->to('/login')->with('error', 'Unknown role.');
            }
        } else {
            // Try to find user in Students table
            $student = $studentModel->where('email', $email)->first();
            if ($student && password_verify($password, $student['password'])) {
                if (isset($student['is_enrolled']) && !$student['is_enrolled']) {
                    return redirect()->to('/login')->with('error', 'You are no longer enrolled.');
                }
                $organization_id = $student['organization_id'];
                $orgModel = new \App\Models\Organizations();
                $organization = $orgModel->find($organization_id);
                session()->set([
                    'student_id'      => $student['student_id'],
                    'student_number'      => $student['student_number'],
                    'email'        => $student['email'],
                    'first_name'   => $student['first_name'],
                    'middle_name'  => $student['middle_name'] ?? null,
                    'last_name'    => $student['last_name'],
                    'image_url'    => $student['image_url'] ?? "/no-profile.png",
                    'organization' => $organization['organization_name'] ?? null,
                    'course'      => $student['course'],
                    'year_level'   => $student['year_level'],
                    'role'         => 'student',
                    'isLoggedIn'   => true
                ]);
                return redirect()->to('/student');
            } else {
                return redirect()->to('/login')->with('error', 'Invalid credentials. Try again.');
            }
        }
    }

    // LOGOUT
    public function logout()
    {
        session()->setFlashdata('success', 'You have been logged out successfully.');
        session()->remove(['user_id', 'email', 'role', 'first_name', 'last_name', 'middle_name', 'image_url', ' organization', 'isLoggedIn']);
        return redirect()->to('/login');
    }
}
