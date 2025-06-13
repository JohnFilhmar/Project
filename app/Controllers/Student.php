<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Student extends BaseController
{
    public function profile()
    {
        return view('/student/profile', [
            'first_name' => session()->get('first_name'),
            'last_name' => session()->get('last_name'),
            'student_id' => session()->get('student_id'),
            'student_number' => session()->get('student_number'),
            'organization' => session()->get('organization'),
            'email' => session()->get('email'),
            'course' => session()->get('course'),
            'year_level' => session()->get('year_level'),
            'image_url' => session()->get('image_url') ?? '/public/no-profile.png'
        ]);
    }

    public function submit_votes()
    {
        $data = $this->request->getPost();
        $votes = $data['votes'] ?? [];

        if (empty($votes)) {
            return redirect()->back()->with('notif-error', 'No votes submitted');
        }

        $student_id = session()->get('student_id');
        $organization_name = session()->get('organization');
        if (!$student_id || !$organization_name) {
            // return $this->response->setJSON([
            //     'student_id' => $student_id,
            //     'organization' => $organization_name
            // ], JSON_PRETTY_PRINT);
            return redirect()->back()->with('notif-error', 'Session error: missing student or organization');
        }

        $organizationModel = new \App\Models\Organizations();
        $organization = $organizationModel->where('organization_name', $organization_name)->first();
        if (!$organization) {
            return redirect()->back()->with('notif-error', 'Organization not found');
        }
        $organization_id = $organization['organization_id'];

        $electionModel = new \App\Models\Election();
        $now = date('Y-m-d H:i:s');
        $election = $electionModel
            ->where('organization_id', $organization_id)
            ->where("CONCAT(start_date, ' ', start_time) <=", $now)
            ->where("CONCAT(end_date, ' ', end_time) >=", $now)
            ->first();
        if (!$election) {
            return redirect()->back()->with('notif-error', 'No ongoing election for your organization');
        }
        $election_id = $election['election_id'];

        $ballotModel = new \App\Models\Ballots();
        $candidatesModel = new \App\Models\Candidates();

        // Flatten votes array (votes[position][])
        $candidate_ids = [];
        foreach ($votes as $position_votes) {
            foreach ((array)$position_votes as $cid) {
                $candidate_ids[] = $cid;
            }
        }

        // Check and insert votes
        foreach ($candidate_ids as $candidate_id) {
            $candidate = $candidatesModel
                ->where('candidate_id', $candidate_id)
                ->where('is_qualified', 1)
                ->where('election_id', $election_id)
                ->first();
            if ($candidate) {
                $ballotModel->insert([
                    'voter_id' => $student_id,
                    'candidate_id' => $candidate_id,
                    'election_id' => $election_id
                ]);
            }
        }
        return redirect()->to('/student')->with('notif-success', 'Votes submitted successfully');
    }
    
}
