<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Students extends BaseController
{
    public function students()
    {
        $studentModel = new \App\Models\Students();
        $organizationsModel = new \App\Models\Organizations();
        $role = session()->get('role');
        if ($role == 'officer') {
            $orgName = session()->get('organization');
            $org = $organizationsModel->select('organization_id')->where('organization_name', $orgName)->first();
            $orgId = $org ? $org['organization_id'] : null;
            $students = $studentModel->where('organization_id', $orgId)->findAll();
        } else {
            $students = $studentModel->findAll();
        }
        $yearLevels = [];
        $courses = [];
        $organizationsSet = [];
        foreach ($students as $student) {
            if (isset($student['year_level'])) {
                $yearLevels[$student['year_level']] = $student['year_level'] . ($student['year_level'] == 1 ? 'st' : ($student['year_level'] == 2 ? 'nd' : ($student['year_level'] == 3 ? 'rd' : 'th'))) . ' Year';
            }
            if (isset($student['course'])) {
                $courses[$student['course']] = $student['course'];
            }
            if (isset($student['organization_id'])) {
                foreach (array_map('trim', explode(',', $student['organization_id'])) as $org) {
                    if ($org !== '') {
                        $organizationsSet[$org] = true;
                    }
                }
            }
        }
        ksort($yearLevels);
        ksort($courses);
        $organizationsList = array_keys($organizationsSet);
        sort($organizationsList);
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
            $students = array_filter($students, function($s) use ($selectedOrganization) {
                $orgs = array_map('trim', explode(',', $s['organization_id']));
                return in_array($selectedOrganization, $orgs);
            });
        }
        // Add organization names to each student for the 'organizations' key
        foreach ($students as &$student) {
            if (isset($student['organization_id'])) {
                $orgIds = array_map('trim', explode(',', $student['organization_id']));
                $orgNames = [];
                foreach ($orgIds as $orgId) {
                    if ($orgId !== '') {
                        $org = $organizationsModel->select('organization_name')->where('organization_id', $orgId)->first();
                        if ($org && isset($org['organization_name'])) {
                            $orgNames[] = $org['organization_name'];
                        }
                    }
                }
                $student['organizations'] = implode(', ', $orgNames);
                $student['organization'] = isset($orgNames[0]) ? $orgNames[0] : '';
            } else {
                $student['organizations'] = '';
                $student['organization'] = '';
            }
        }
        unset($student); // break reference
        // Build organizations array as [organization_id => organization_name]
        $organizations = [];
        if (!empty($organizationsList)) {
            $orgs = $organizationsModel->select(['organization_id', 'organization_name'])
                ->whereIn('organization_id', $organizationsList)
                ->findAll();
            foreach ($orgs as $org) {
                $organizations[$org['organization_id']] = $org['organization_name'];
            }
        }
        return view('admin/student_lists', [
            'students' => $students,
            'yearLevels' => $yearLevels,
            'courses' => $courses,
            'organizations' => $organizations,
            'is_candidate' => false,
            'selectedYearLevel' => $selectedYearLevel,
            'selectedCourse' => $selectedCourse,
            'selectedOrganization' => $selectedOrganization,
        ]);
    }

    public function create_student()
    {
        $studentsModel = new \App\Models\Students();
        $student_number = $this->request->getPost('student_number');
        $first_name = trim($this->request->getPost('first_name'));
        $middle_name = trim($this->request->getPost('middle_name'));
        $last_name = trim($this->request->getPost('last_name'));
        $phone_number = $this->request->getPost('phone_number');
        $password = password_hash($student_number . '-' . preg_replace('/\s+/', '', $last_name), PASSWORD_DEFAULT);

        $exists = $studentsModel
            ->where('student_number', $student_number)
            ->orGroupStart()
                ->where('first_name', $first_name)
                ->where('middle_name', $middle_name)
                ->where('last_name', $last_name)
            ->groupEnd()
            ->first();
        if ($exists) {
            session()->setFlashdata('notif-error', 'Student already exists.');
            return redirect()->to('/students/student_lists');
        }
        if ($phone_number) {
            $phoneExists = $studentsModel->where('phone_number', $phone_number)->first();
            if ($phoneExists) {
                session()->setFlashdata('notif-error', 'Phone number already exists.');
                return redirect()->to('/students/student_lists');
            }
        }
        $imageFile = $this->request->getFile('image_file');
        $image_url = null;
        if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
            $originalName = $imageFile->getClientName();
            $imageFile->move(FCPATH . 'students', $originalName);
            $image_url = '/students/' . $originalName;
        }
        $organization_id = $this->request->getPost('organization_id');
        $data = [
            'student_number' => $student_number,
            'first_name' => $first_name,
            'middle_name' => $middle_name,
            'last_name' => $last_name,
            'year_level' => $this->request->getPost('year_level'),
            'course' => $this->request->getPost('course'),
            'sex' => $this->request->getPost('sex'),
            'email' => $this->request->getPost('email'),
            'phone_number' => $phone_number,
            'image_url' => $image_url,
            'organization_id' => $organization_id,
            'password' => $password,
        ];
        if ($studentsModel->insert($data)) {
            session()->setFlashdata('notif-success', 'Student added successfully.');
        } else {
            session()->setFlashdata('notif-error', 'Failed to add student.');
        }
        return redirect()->to('/students/student_lists');
    }

    public function retrieve_students()
    {
        $studentsModel = new \App\Models\Students();
        $organizationsModel = new \App\Models\Organizations();
        $students = $studentsModel->findAll();
        foreach ($students as &$student) {
            $org = $organizationsModel->select('organization_name')->where('organization_id', $student['organization_id'])->first();
            $student['organization'] = $org && isset($org['organization_name']) ? $org['organization_name'] : '';
        }
        return $this->response->setJSON([
            'status' => 'success',
            'data' => $students,
        ]);
    }

    public function search_student($query)
    {
        $studentsModel = new \App\Models\Students();
        $organizationsModel = new \App\Models\Organizations();
        $students = $studentsModel->like('student_number', $query)
            ->orLike('first_name', $query)
            ->orLike('middle_name', $query)
            ->orLike('last_name', $query)
            ->findAll();
        foreach ($students as &$student) {
            $org = $organizationsModel->select('organization_name')->where('organization_id', $student['organization_id'])->first();
            $student['organization'] = $org && isset($org['organization_name']) ? $org['organization_name'] : '';
        }
        return $this->response->setJSON([
            'status' => 'success',
            'data' => $students,
        ], JSON_PRETTY_PRINT);
    }

    public function update_student($student_id)
    {
        $studentsModel = new \App\Models\Students();
        $organizationsModel = new \App\Models\Organizations();
        $fromDatabase = $studentsModel->find($student_id);
        $student_number = $this->request->getPost('student_number');
        $existingStudent = $studentsModel
            ->where('student_number', $student_number)
            ->where('student_id !=', $student_id)
            ->first();
        if ($existingStudent) {
            session()->setFlashdata('notif-error', 'Student number already exists.');
            return redirect()->to('/students/student_lists');
        }
        $imageFile = $this->request->getFile('image_file');
        $image_url = $fromDatabase['image_url'];
        if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
            $newName = uniqid('student_') . '.' . $imageFile->getExtension();
            $imageFile->move(FCPATH . 'students', $newName);
            $image_url = '/students/' . $newName;
            if ($fromDatabase['image_url'] && $fromDatabase['image_url'] !== $image_url) {
                $oldImagePath = FCPATH . ltrim($fromDatabase['image_url'], '/');
                if (is_file($oldImagePath)) {
                    @unlink($oldImagePath);
                }
            }
        }
        $organization_id = $this->request->getPost('organization_id');
        $org = $organizationsModel->select('organization_name')->where('organization_id', $organization_id)->first();
        if (!$org || !isset($org['organization_name'])) {
            session()->setFlashdata('notif-error', 'Invalid organization.');
            return redirect()->to('/students/student_lists');
        }
        $data = [
            'student_number' => $student_number,
            'first_name' => $this->request->getPost('first_name'),
            'middle_name' => $this->request->getPost('middle_name'),
            'last_name' => $this->request->getPost('last_name'),
            'year_level' => $this->request->getPost('year_level'),
            'course' => $this->request->getPost('course'),
            'sex' => $this->request->getPost('sex'),
            'email' => $this->request->getPost('email'),
            'image_url' => $image_url,
            'organization_id' => $organization_id,
        ];
        if ($studentsModel->update($student_id, $data)) {
            session()->setFlashdata('notif-success', 'Student updated successfully.');
        } else {
            session()->setFlashdata('notif-error', 'Failed to update student.');
        }
        return redirect()->to('/students/student_lists');
    }

    public function deactivate_all_students()
    {
        $studentsModel = new \App\Models\Students();
        if ($studentsModel->where('is_enrolled', true)->update(null, ['is_enrolled' => false])) {
            session()->setFlashdata('notif-success', 'All students deactivated successfully.');
        } else {
            session()->setFlashdata('notif-error', 'Failed to deactivate all students.');
        }
        return redirect()->to('/students/student_lists');
    }

    public function deactivate_student($student_id)
    {
        $studentsModel = new \App\Models\Students();
        if ($studentsModel->update($student_id, ['is_enrolled' => false])) {
            session()->setFlashdata('notif-success', 'Student deactivated successfully.');
        } else {
            session()->setFlashdata('notif-error', 'Failed to deactivate student.');
        }
        return redirect()->to('/students/student_lists');
    }

    public function activate_student($student_id)
    {
        $studentsModel = new \App\Models\Students();
        if ($studentsModel->update($student_id, ['is_enrolled' => true])) {
            session()->setFlashdata('notif-success', 'Student activated successfully.');
        } else {
            session()->setFlashdata('notif-error', 'Failed to activate student.');
        }
        return redirect()->to('/students/student_lists');
    }
}
