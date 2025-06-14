<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Admin extends BaseController
{
    public function profile()
    {
        return view('admin/profile');
    }

    public function update_profile_image()
    {
        $userModel = new \App\Models\Users();
        $image = $this->request->getFile('profile_image');
        $userId = session()->get('user_id');
        $user = $userModel->find($userId);
        if ($image && $image->isValid() && !$image->hasMoved()) {
            $newName = $image->getRandomName();
            // Delete old image if it exists
            if (!empty($user['image_url']) && file_exists(FCPATH . $user['image_url'])) {
                unlink(FCPATH . $user['image_url']);
            }
            $image->move(ROOTPATH . 'public/users', $newName);
            $data = ['image_url' => '/users/' . $newName];
            if ($userModel->update($userId, $data)) {
                session()->setFlashdata('notif-success', 'Profile image updated successfully.');
                session()->set('image_url', $data['image_url']);
            } else {
                session()->setFlashdata('notif-error', 'Failed to update profile image: ' . implode(', ', $userModel->errors()));
            }
        } else {
            session()->setFlashdata('notif-error', 'Invalid image file.');
        }
        return redirect()->back();
    }

    public function update_profile()
    {
        $userModel = new \App\Models\Users();
        $data = $this->request->getPost();
        $userId = session()->get('user_id');
        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }
        if ($userModel->update($userId, $data)) {
            session()->setFlashdata('notif-success', 'User updated successfully.');
            // Update session data if necessary
            session()->set('first_name', $data['first_name']);
            session()->set('last_name', $data['last_name']);
            session()->set('email', $data['email']);
            session()->set('organization_id', $data['organization_id'] ?? null);
        
        } else {
            session()->setFlashdata('notif-error', 'Failed to update user: ' . implode(', ', $userModel->errors()));
        }
        return redirect()->back();
    }

}
