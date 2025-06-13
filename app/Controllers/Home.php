<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function results($organization_id = null)
    {
        $role = session()->get('role');
        $organizationModel = new \App\Models\Organizations();
        $electionModel = new \App\Models\Election();
        $candidatesModel = new \App\Models\Candidates();
        $studentsModel = new \App\Models\Students();
        $ballotModel = new \App\Models\Ballots();

        // Determine organization_id based on role
        if ($role === 'admin') {
            // Admin can select any organization
            $organizations = $organizationModel->findAll();
            if (!$organization_id && !empty($organizations)) {
                $organization_id = $organizations[0]['organization_id'];
            }
        } else {
            // Officer or student: get org from session
            $organization_name = session()->get('organization');
            $organization = $organizationModel->where('organization_name', $organization_name)->first();
            $organization_id = $organization['organization_id'] ?? null;
            $organizations = [];
        }

        $positions = [];
        $total_students = 0;
        if ($organization_id) {
            // Get the total number of students in this organization
            $total_students = $studentsModel->where('organization_id', $organization_id)->countAllResults();
            // Get the latest/ongoing election for the org
            $now = date('Y-m-d H:i:s');
            $election = $electionModel
                ->where('organization_id', $organization_id)
                ->orderBy('start_date', 'DESC')
                ->first();
            if ($election) {
                $election_id = $election['election_id'];
                // Get all candidates for this election, grouped by position
                $builder = $candidatesModel->builder();
                $builder->select('candidates.candidate_id, candidates.position, students.first_name, students.middle_name, students.last_name')
                    ->join('students', 'students.student_id = candidates.student_id')
                    ->where('candidates.election_id', $election_id)
                    ->where('candidates.is_qualified', 1);
                $candidates = $builder->get()->getResultArray();
                // Get vote counts
                $voteCounts = $ballotModel->select('candidate_id, COUNT(*) as votes')
                    ->where('election_id', $election_id)
                    ->groupBy('candidate_id')
                    ->findAll();
                $voteMap = [];
                $totalVotesPerPosition = [];
                foreach ($voteCounts as $vc) {
                    $voteMap[$vc['candidate_id']] = (int)$vc['votes'];
                }
                // Group by position
                foreach ($candidates as $cand) {
                    $fullName = $cand['first_name'] .
                        ($cand['middle_name'] ? ' ' . $cand['middle_name'] : '') .
                        ' ' . $cand['last_name'];
                    $votes = $voteMap[$cand['candidate_id']] ?? 0;
                    $positions[$cand['position']][] = [
                        'name' => $fullName,
                        'votes' => $votes
                    ];
                    $totalVotesPerPosition[$cand['position']] = ($totalVotesPerPosition[$cand['position']] ?? 0) + $votes;
                }
                // Calculate percent for each candidate
                foreach ($positions as $pos => &$cands) {
                    $total = $totalVotesPerPosition[$pos] ?: 1;
                    foreach ($cands as &$c) {
                        $c['percent'] = round(($c['votes'] / $total) * 100);
                    }
                }
            }
        }
        return view('admin/results', [
            'positions' => $positions,
            'organizations' => $organizations,
            'selected_organization_id' => $organization_id,
            'role' => $role,
            'total_students' => $total_students
        ]);
    }
    // HOME PAGE BEFORE LOGIN
    public function home()
    {
        $campaigns = [
            ['image' => 'https://via.placeholder.com/150'],
            ['image' => 'https://via.placeholder.com/150'],
            ['image' => 'https://via.placeholder.com/150'],
            ['image' => 'https://via.placeholder.com/150'],
        ];
        return view('home', ['campaigns' => $campaigns]);
    }

    public function unauthorized()
    {
        return view('unauthorized');
    }
}
