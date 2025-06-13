<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Candidates extends BaseController
{
    // reusable function to get the candidates
    private function getCandidateLists()
    {
        $candidatesModel = new \App\Models\Candidates();
        $studentsModel = new \App\Models\Students();
        $organizationsModel = new \App\Models\Organizations();

        $session = session();
        if ($session->get('role') === 'officer') {
            $organization = $session->get('organization');
            $candidates = $candidatesModel->findAll();
            $filteredCandidates = [];
            foreach ($candidates as $candidate) {
                $student = $studentsModel->find($candidate['student_id']);
                if ($student && isset($student['organization_id'])) {
                    $org = $organizationsModel->select('organization_name')->where('organization_id', $student['organization_id'])->first();
                    $studentOrgName = $org && isset($org['organization_name']) ? $org['organization_name'] : '';
                    if ($studentOrgName == $organization) {
                        $filteredCandidates[] = $candidate;
                    }
                }
            }
            $candidates = $filteredCandidates;
        } else {
            $candidates = $candidatesModel->findAll();
        }
        $candidateLists = [];
        foreach ($candidates as $candidate) {
            $student = $studentsModel->find($candidate['student_id']);
            if (!$student || !is_array($student)) {
                continue;
            }
            if (!isset($student['is_candidate']) || $student['is_candidate'] != 1) {
                continue;
            }
            if (!isset($student['is_enrolled']) || $student['is_enrolled'] != 1) {
                continue;
            }
            if (!isset($candidate['is_qualified']) || !$candidate['is_qualified']) {
                continue;
            }
            $org = $organizationsModel->select('organization_name')->where('organization_id', $student['organization_id'])->first();
            $studentOrgName = $org && isset($org['organization_name']) ? $org['organization_name'] : '';
            $candidateLists[] = [
                'student_id' => $student['student_id'],
                'candidate_id' => $candidate['candidate_id'],
                'image_url' => isset($candidate['candidate_image']) ? $candidate['candidate_image'] : '/no-profile.png',
                'full_name' => trim(($student['first_name'] ?? '') . ' ' . ($student['last_name'] ?? '')),
                'organization' => $studentOrgName,
                'alyas' => $candidate['alyas'] ?? '',
                'position' => $candidate['position'] ?? '',
                'campaign_message' => $candidate['campaign_message'] ?? '',
                'partylist' => $candidate['partylist'] ?? '',
                'is_qualified' => $candidate['is_qualified'] ?? '',
                'date_created' => $candidate['date_created'] ?? '',
            ];
        }
        return $candidateLists;
    }
    public function candidates()
    {
        return view('admin/candidates', ['candidateLists' => $this->getCandidateLists()]);
    }
    public function retrieve_candidates()
    {
        return $this->response->setJSON(['candidateLists' => $this->getCandidateLists()]);
    }
    public function candidate_lists()
    {
        return view('admin/candidate_lists', ['candidateLists' => $this->getCandidateLists()]);
    }
    public function create_candidate($student_id)
    {
        $candidatesModel = new \App\Models\Candidates();
        $studentsModel = new \App\Models\Students();
        $student = $studentsModel->find($student_id);
        if (!$student) {
            return redirect()->back()->withInput()->with('notif-error', 'Student not found.');
        }
        $existingCandidate = $candidatesModel
            ->where('student_id', $student_id)
            ->orderBy('candidate_id', 'DESC')
            ->first();
        if ($existingCandidate && isset($existingCandidate['is_qualified']) && !$existingCandidate['is_qualified']) {
            return redirect()->back()->withInput()->with('notif-error', 'Student disqualified and needs to appeal to an admin.');
        }
        if (isset($student['is_candidate']) && $student['is_candidate']) {
            return redirect()->back()->withInput()->with('notif-error', 'Student is already a candidate.');
        }
        $validation = \Config\Services::validation();
        $validation->setRules([
            'alyas' => 'required|max_length[100]',
            'position' => 'required|max_length[100]',
            'campaign_message' => 'permit_empty|max_length[500]',
            'partylist' => 'permit_empty|max_length[100]',
            'image_file' => 'permit_empty|is_image[image_file]|max_size[image_file,2048]'
        ]);
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('notif-error', implode(' ', $validation->getErrors()));
        }
        $data = [
            'student_id' => $student_id,
            'alyas' => $this->request->getPost('alyas'),
            'position' => $this->request->getPost('position'),
            'campaign_message' => $this->request->getPost('campaign_message'),
            'partylist' => $this->request->getPost('partylist'),
        ];
        $image = $this->request->getFile('image_file');
        if ($image && $image->isValid() && !$image->hasMoved()) {
            $originalName = $image->getClientName();
            $uploadPath = ROOTPATH . '/candidates/' . $originalName;
            if (file_exists($uploadPath)) {
                return redirect()->back()->withInput()->with('notif-error', 'Image file already exists.');
            }
            $image->move(ROOTPATH . 'public/candidates', $originalName);
            $data['candidate_image'] = '/candidates/' . $originalName;
        }
        $allowedFields = $candidatesModel->allowedFields;
        $filteredData = array_intersect_key($data, array_flip($allowedFields));
        if ($candidatesModel->insert($filteredData)) {
            // Update the student's is_candidate field to 1
            $studentsModel->update($student_id, ['is_candidate' => 1]);
            return redirect()->to('/candidate/candidate_lists')->with('notif-success', 'Candidate created successfully.');
        } else {
            return redirect()->back()->withInput()->with('notif-error', 'Failed to create candidate.');
        }
    }
    public function disqualify_candidate($candidate_id)
    {
        $candidatesModel = new \App\Models\Candidates();
        $studentsModel = new \App\Models\Students();
        $candidate = $candidatesModel->find($candidate_id);
        if ($candidate) {
            $updateCandidate = $candidatesModel->update($candidate_id, ['is_qualified' => 0]);
            $updateStudent = $studentsModel->update($candidate['student_id'], ['is_candidate' => 0]);
            if ($updateCandidate && $updateStudent) {
                return redirect()->back()->with('notif-success', 'Candidate disqualified successfully.');
            } else {
                return redirect()->back()->with('notif-error', 'Failed to disqualify candidate.');
            }
        } else {
            return redirect()->back()->with('notif-error', 'Candidate not found.');
        }
    }
}
