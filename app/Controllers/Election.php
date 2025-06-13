<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Election as ElectionModel;

class Election extends BaseController
{
    public function profile_election()
    {
        return view('admin/profile');
    }

    public function create_election()
    {
        $electionModel = new ElectionModel();
        $data = $this->request->getPost();

        // Validate date/time logic
        if (
            $data['start_date'] > $data['end_date'] ||
            ($data['start_date'] === $data['end_date'] && $data['start_time'] >= $data['end_time'])
        ) {
            return redirect()->back()->with('notif-error', 'Invalid date or time range.');
        }

        // Check for duplicate title
        if ($electionModel->where('title', $data['title'])->first()) {
            return redirect()->back()->with('notif-error', 'Title already exists.');
        }

        // Check if organization already has an election
        if ($electionModel->where('organization_id', $data['organization_id'])->first()) {
            return redirect()->back()->with('notif-error', 'An election for this organization already exists.');
        }

        if ($electionModel->insert($data)) {
            return redirect()->back()->with('notif-success', 'Election schedule created successfully.');
        } else {
            return redirect()->back()->with('notif-error', 'Failed to create election schedule.');
        }
    }

    public function retrieve_election()
    {
        $electionModel = new ElectionModel();
        $elections = $electionModel->findAll();

        return $this->response->setJSON($elections);
    }

    public function update_election($id)
    {
        $electionModel = new ElectionModel();
        $data = $this->request->getPost();

        // Validate date/time logic
        if (
            $data['start_date'] > $data['end_date'] ||
            ($data['start_date'] === $data['end_date'] && $data['start_time'] >= $data['end_time'])
        ) {
            return redirect()->back()->with('notif-error', 'Invalid date or time range.');
        }

        // Check for duplicate title excluding current
        if ($electionModel->where('title', $data['title'])->where('election_id !=', $id)->first()) {
            return redirect()->back()->with('notif-error', 'Title already exists.');
        }

        // Check if another schedule exists for the same organization
        if ($electionModel->where('organization_id', $data['organization_id'])->where('election_id !=', $id)->first()) {
            return redirect()->back()->with('notif-error', 'Another election for this organization already exists.');
        }

        if ($electionModel->update($id, $data)) {
            return redirect()->back()->with('notif-success', 'Election schedule updated successfully.');
        } else {
            return redirect()->back()->with('notif-error', 'Failed to update election schedule.');
        }
    }
    
}