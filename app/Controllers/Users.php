<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Users extends BaseController
{
    public function users()
    {
        $userModel = new \App\Models\Users();
        $users = $userModel->findAll();
        // Load Organizations model
        $organizationModel = new \App\Models\Organizations();

        // Replace organization_id with organization_name for each user
        foreach ($users as &$user) {
            if (isset($user['organization_id']) && $user['organization_id']) {
            $org = $organizationModel->find($user['organization_id']);
            $user['organization'] = $org ? $org['organization_name'] : null;
            } else {
            $user['organization'] = null;
            }
            unset($user['organization_id']);
        }
        unset($user);
        return view('admin/profile', ['users' => $users]);
    }

    public function create_user()
    {
        $data = $this->request->getPost();
        $userModel = new \App\Models\Users();
        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }
        if ($userModel->insert($data)) {
            session()->setFlashdata('notif-success', 'User created successfully.');
        } else {
            session()->setFlashdata('notif-error', 'Failed to create user: ' . implode(', ', $userModel->errors()));
        }
        $users = $userModel->findAll();
        return view('admin/profile', ['users' => $users]);
    }

    public function add_officer()
    {
        helper(['form', 'url']);
        $student_number = $this->request->getPost('student_number');
        $password = $this->request->getPost('password');
        $studentsModel = new \App\Models\Students();
        $usersModel    = new \App\Models\Users();
        $student = $studentsModel->where('student_number', $student_number)->first();
        if (! $student) {
            return redirect()->back()->with('notif-error', 'Student not found.');
        }
        $data = [
            'first_name'     => $student['first_name'],
            'middle_name'    => $student['middle_name'],
            'last_name'      => $student['last_name'],
            'email'          => $student['email'],
            'image_url'      => $student['image_url'],
            'organization_id'   => $student['organization_id'] ?? null,
            'role'           => 'officer',
            'password'       => password_hash($password, PASSWORD_DEFAULT),
            'is_active'      => 1,
            'created_at'     => date('Y-m-d H:i:s'),
        ];
        $usersModel->insert($data);
        return redirect()->back()->with('notif-success', 'Officer account created successfully.');
    }

    public function add_admin()
    {
        helper(['form', 'url']);
        $usersModel = new \App\Models\Users();
        $organizationModel = new \App\Models\Organizations();

        $data = [
            'first_name'   => $this->request->getPost('first_name'),
            'middle_name'  => $this->request->getPost('middle_name'),
            'last_name'    => $this->request->getPost('last_name'),
            'email'        => $this->request->getPost('email'),
            'organization_id' => $this->request->getPost('organization_id'),
            'role'         => 'admin',
            'is_active'    => 1,
            'created_at'   => date('Y-m-d H:i:s'),
        ];

        // Handle profile image upload
        $image = $this->request->getFile('image_url');
        if ($image && $image->isValid() && !$image->hasMoved()) {
            $newName = $image->getRandomName();
            $image->move(ROOTPATH . 'public/users', $newName);
            $data['image_url'] = '/users/' . $newName;
        }

        // Password and confirm password
        $password = $this->request->getPost('password');
        $password_confirm = $this->request->getPost('password_confirm');
        if (!$password || $password !== $password_confirm) {
            return redirect()->back()->with('notif-error', 'Passwords do not match.');
        }
        $data['password'] = password_hash($password, PASSWORD_DEFAULT);

        if ($usersModel->insert($data)) {
            return redirect()->back()->with('notif-success', 'Admin account created successfully.');
        } else {
            return redirect()->back()->with('notif-error', 'Failed to create admin: ' . implode(', ', $usersModel->errors()));
        }
    }
    
    public function retrieve_users()
    {
        $userModel = new \App\Models\Users();
        $users = $userModel->findAll();
        return $this->response->setJSON(['users' => $users]);
    }

    public function update_users($id)
    {
        $userModel = new \App\Models\Users();
        $data = $this->request->getPost();

        unset($data['created_at']);

        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        if ($userModel->update($id, $data)) {
            session()->setFlashdata('notif-success', 'User updated successfully.');
        } else {
            session()->setFlashdata('notif-error', 'Failed to update user: ' . implode(', ', $userModel->errors()));
        }

        $users = $userModel->findAll();
        return view('admin/profile', ['users' => $users]);
    }

    public function deactivate_user($id)
    {
        $userModel = new \App\Models\Users();
        if ($userModel->update($id, ['is_active' => 0])) {
            session()->setFlashdata('notif-success', 'User deactivated successfully.');
        } else {
            session()->setFlashdata('notif-error', 'Failed to deactivate user: ' . implode(', ', $userModel->errors()));
        }

        $users = $userModel->findAll();
        return view('admin/profile', ['users' => $users]);
    }

    public function activate_user($id)
    {
        $userModel = new \App\Models\Users();
        if ($userModel->update($id, ['is_active' => 1])) {
            session()->setFlashdata('notif-success', 'User activated successfully.');
        } else {
            session()->setFlashdata('notif-error', 'Failed to activate user: ' . implode(', ', $userModel->errors()));
        }

        $users = $userModel->findAll();
        return view('admin/profile', ['users' => $users]);
    }
}
