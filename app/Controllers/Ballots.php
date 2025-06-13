<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Ballots extends BaseController
{
    public function ballots()
    {
        if (session()->get('role') == 'student') {
            $organization_name = session()->get('organization');
            $organizationModel = new \App\Models\Organizations();
            $organization = $organizationModel->where('organization_name', $organization_name)->first();
            $candidates = [];
            if ($organization) {
                $organization_id = $organization['organization_id'];
                $electionModel = new \App\Models\Election();
                $now = date('Y-m-d H:i:s');
                $election = $electionModel
                    ->where('organization_id', $organization_id)
                    ->where("CONCAT(start_date, ' ', start_time) <=", $now)
                    ->where("CONCAT(end_date, ' ', end_time) >=", $now)
                    ->first();
                if ($election) {
                    $election_id = $election['election_id'];
                    $candidatesModel = new \App\Models\Candidates();
                    $studentsModel = new \App\Models\Students();
                    $builder = $candidatesModel->builder();
                    $builder->select('candidates.candidate_id, candidates.position, students.first_name, students.middle_name, students.last_name')
                        ->join('students', 'students.student_id = candidates.student_id')
                        ->where('candidates.is_qualified', 1)
                        ->where('candidates.election_id', $election_id);
                    $query = $builder->get();
                    foreach ($query->getResultArray() as $row) {
                        $fullName = $row['first_name'] .
                            ($row['middle_name'] ? ' ' . $row['middle_name'] : '') .
                            ' ' . $row['last_name'];
                        $candidates[$row['position']][] = [
                            'id' => $row['candidate_id'],
                            'name' => $fullName,
                        ];
                    }
                }
            }
            return view('student/ballots', ['candidates' => $candidates]);
        }

        // For admin/officer: fetch all elections with organization, status, dates, and counts
        $db = \Config\Database::connect();
        $builder = $db->table('election_schedule');
        $builder->select('
            election_schedule.election_id,
            organizations.organization_name,
            election_schedule.title,
            election_schedule.start_date,
            election_schedule.start_time,
            election_schedule.end_date,
            election_schedule.end_time,
            COUNT(DISTINCT candidates.position) as positions_count,
            COUNT(candidates.candidate_id) as candidates_count
        ');
        $builder->join('organizations', 'organizations.organization_id = election_schedule.organization_id');
        $builder->join('candidates', 'candidates.election_id = election_schedule.election_id', 'left');
        $builder->groupBy('election_schedule.election_id');
        $elections = $builder->get()->getResultArray();

        // Add status (Upcoming, Ongoing, Ended)
        $now = date('Y-m-d H:i:s');
        foreach ($elections as &$election) {
            $start = $election['start_date'] . ' ' . $election['start_time'];
            $end = $election['end_date'] . ' ' . $election['end_time'];
            if ($now < $start) {
                $election['status'] = 'Upcoming';
            } elseif ($now > $end) {
                $election['status'] = 'Ended';
            } else {
                $election['status'] = 'Ongoing';
            }
        }

        return view('admin/ballots', ['elections' => $elections]);
    }
    public function retrieve_ballots()
    {
        $ballotModel = new \App\Models\Ballots();
        $ballot = $ballotModel->findAll();

        if ($ballot) {
            return $this->response
            ->setJSON(['ballots' => $ballot]);
        }
    }
    public function add_candidate_to_ballot($candidate_id)
    {
        // using the candidate_id, update the candidate's field election_id to the 
    }
    public function create_ballot()
    {
        $data = $this->request->getPost();
        $candidates = $data['candidates'] ?? [];
        if (empty($candidates)) {
            return redirect()->back()->with('notif-error', 'Candidates are required to create a ballot.');
        }
        $organization_name = session()->get('organization');
        if (!$organization_name) {
            return redirect()->back()->with('notif-error', 'Organization not found in session.');
        }
        $organizationModel = new \App\Models\Organizations();
        $organization = $organizationModel->where('organization_name', $organization_name)->first();
        if (!$organization) {
            return redirect()->back()->with('notif-error', 'Organization not found.');
        }
        $organization_id = $organization['organization_id'];
        $electionModel = new \App\Models\Election();
        $schedule = $electionModel->where('organization_id', $organization_id)->first();
        if (!$schedule) {
            return redirect()->back()->with('notif-error', 'Election schedule not found for the organization.');
        }
        $candidatesModel = new \App\Models\Candidates();
        foreach ($candidates as $candidate) {
            $parts = explode('|', $candidate);
            $candidate_id = $parts[0];
            $candidateData = [
                'election_id' => $schedule['election_id'],
            ];
            $candidatesModel->update($candidate_id, $candidateData);
        }
        return redirect()->back()->with('notif-success', 'Ballot created successfully.');
    }
    public function has_election_schedule()
    {
        $organization_name = session()->get('organization');
        if (!$organization_name) {
            return $this->response->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED)
                ->setJSON(['message' => 'Organization not found in session']);
        }

        $organizationModel = new \App\Models\Organizations();
        $organization = $organizationModel->where('organization_name', $organization_name)->first();
        if (!$organization) {
            return $this->response->setStatusCode(ResponseInterface::HTTP_NOT_FOUND)
                ->setJSON(['message' => 'Organization not found']);
        }
        $organization_id = $organization['organization_id'];
        $electionModel = new \App\Models\Election();
        $schedule = $electionModel->where('organization_id', $organization_id)->first();

        if ($schedule) {
            return $this->response->setJSON(['hasSchedule' => true, 'schedule' => $schedule]);
        } else {
            return $this->response->setJSON(['hasSchedule' => false]);
        }
    }

    public function count_votes()
    {
        $ballotModel = new \App\Models\Ballots();
        $candidatesModel = new \App\Models\Candidates();
        $votes = $ballotModel->select('candidate_id, COUNT(*) as vote_count')
            ->groupBy('candidate_id')
            ->findAll();

        if (!$votes) {
            return $this->response->setJSON(['message' => 'No votes found']);
        }

        $results = [];
        foreach ($votes as $vote) {
            $candidate = $candidatesModel->find($vote['candidate_id']);
            if ($candidate) {
                $results[] = [
                    'candidate_id' => $vote['candidate_id'],
                    'name' => $candidate['name'],
                    'vote_count' => $vote['vote_count']
                ];
            }
        }

        return $this->response->setJSON(['results' => $results]);
    }
    
}
