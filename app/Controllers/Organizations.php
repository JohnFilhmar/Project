<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Organizations extends BaseController
{
    public function organizations()
    {
        $organizationsModel = new \App\Models\Organizations();
        return view('admin/profile', ['organizations' => $organizationsModel->findAll()]);
    }
    public function retrieve_organizations()
    {
        $organizationsModel = new \App\Models\Organizations();
        $organizations = $organizationsModel->select('organization_name')->findAll(); // SELECT 'organization_name' FROM 'organizations';
        $organizationNames = array_column($organizations, 'organization_name');
        return $this->response->setJSON(['organizations' => $organizationNames]);
    }
    public function create_organization()
    {
        $organizationName = $this->request->getPost('organization_name');
        $positionsJson = $this->request->getPost('positions');
        $positionsArray = json_decode($positionsJson, true);
        $positionsFormatted = '';
        if (is_array($positionsArray)) {
            $positionsFormatted = implode(',', array_map(function ($pos) {
                return $pos . '=1';
            }, $positionsArray));
        }
        $organizationsModel = new \App\Models\Organizations();
        $existing = $organizationsModel->where('organization_name', $organizationName)->first();
        if ($existing) {
            return redirect()->back()->with('notif-error', 'Organization name already exists.');
        }
        $data = [
            'organization_name' => $organizationName,
            'positions' => $positionsFormatted,
        ];
        if ($organizationsModel->insert($data)) {
            return redirect()->back()->with('notif-success', 'Organization created successfully.');
        } else {
            return redirect()->back()->with('notif-error', 'Failed to create the organization.');
        }
    }
    public function deactivate_organization($id)
    {
        $organizationsModel = new \App\Models\Organizations();
        $organization = $organizationsModel->find($id);
        if (!$organization) {
            return redirect()->back()->with('notif-error', 'Organization not found.');
        }
        $organizationsModel->update($id, ['is_active' => 0]);
        return redirect()->back()->with('notif-success', 'Organization deactivated successfully.');
    }
    public function activate_organization($id)
    {
        $organizationsModel = new \App\Models\Organizations();
        $organization = $organizationsModel->find($id);

        if (!$organization) {
            return redirect()->back()->with('notif-error', 'Organization not found.');
        }

        $organizationsModel->update($id, ['is_active' => 1]);
        return redirect()->back()->with('notif-success', 'Organization activated successfully.');
    }
    public function find_organization($organization_name)
    {
        $organizationsModel = new \App\Models\Organizations();

        // Replace % with space in case the name is URL-encoded
        $organization_name = str_replace('%', ' ', $organization_name);

        $organization = $organizationsModel
            ->select('organization_id')
            ->where('organization_name', $organization_name)
            ->first();

        if ($organization) {
            return $this->response->setJSON(['organization_id' => $organization['organization_id']]);
        } else {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Organization not found.']);
        }
    }






    public function positions()
    {
        $organizationsModel = new \App\Models\Organizations();
        $organizations = $organizationsModel->findAll();
        $organizationPositions = [];

        foreach ($organizations as $org) {
            $positions = [];
            if (!empty($org['positions'])) {
                $pairs = explode(',', $org['positions']);
                foreach ($pairs as $pair) {
                    list($position, $active) = explode('=', $pair);
                    $positions[$position] = (int)$active;
                }
            }
            $organizationPositions[$org['organization_name']] = $positions;
        }
        return view('admin/profile', ['organizationPositions' => $organizationPositions]);
    }
    public function create_position($organization)
    {
        $positionName = $this->request->getPost('position');
        if (!$positionName) {
            return redirect()->back()->with('notif-error', 'Position name is required.');
        }
        $organizationsModel = new \App\Models\Organizations();
        $org = $organizationsModel->where('organization_name', str_replace('%', ' ', $organization))->first();
        if (!$org) {
            return redirect()->back()->with('notif-error', 'Organization not found.');
        }
        $positions = [];
        if (!empty($org['positions'])) {
            $pairs = explode(',', $org['positions']);
            foreach ($pairs as $pair) {
                list($pos, $active) = explode('=', $pair);
                $positions[$pos] = (int)$active;
            }
        }
        if (array_key_exists($positionName, $positions)) {
            return redirect()->back()->with('notif-error', 'Position already exists.');
        }
        $positions[$positionName] = 1;
        $positionsFormatted = implode(',', array_map(function ($pos, $active) {
            return $pos . '=' . $active;
        }, array_keys($positions), $positions));
        $organizationsModel->update($org['organization_id'], ['positions' => $positionsFormatted]);
        return redirect()->back()->with('notif-success', 'Position added successfully.');
    }
    public function deactivate_position($position, $organization)
    {
        $organizationsModel = new \App\Models\Organizations();
        $org = $organizationsModel->where('organization_name', str_replace('%', ' ', $organization))->first();
        if (!$org) {
            return redirect()->back()->with('notif-error', 'Organization not found.');
        }
        $positions = [];
        if (!empty($org['positions'])) {
            $pairs = explode(',', $org['positions']);
            foreach ($pairs as $pair) {
                list($pos, $active) = explode('=', $pair);
                $positions[$pos] = (int)$active;
            }
        }
        if (!array_key_exists($position, $positions)) {
            return redirect()->back()->with('notif-error', 'Position not found.');
        }
        $positions[$position] = 0;
        $positionsFormatted = implode(',', array_map(function ($pos, $active) {
            return $pos . '=' . $active;
        }, array_keys($positions), $positions));
        $organizationsModel->update($org['organization_id'], ['positions' => $positionsFormatted]);
        return redirect()->back()->with('notif-success', 'Position deactivated successfully.');
    }
    public function activate_position($position, $organization)
    {
        $organizationsModel = new \App\Models\Organizations();
        $org = $organizationsModel->where('organization_name', str_replace('%', ' ', $organization))->first();
        if (!$org) {
            return redirect()->back()->with('notif-error', 'Organization not found.');
        }
        $positions = [];
        if (!empty($org['positions'])) {
            $pairs = explode(',', $org['positions']);
            foreach ($pairs as $pair) {
                list($pos, $active) = explode('=', $pair);
                $positions[$pos] = (int)$active;
            }
        }
        if (!array_key_exists($position, $positions)) {
            return redirect()->back()->with('notif-error', 'Position not found.');
        }
        $positions[$position] = 1;
        $positionsFormatted = implode(',', array_map(function ($pos, $active) {
            return $pos . '=' . $active;
        }, array_keys($positions), $positions));
        $organizationsModel->update($org['organization_id'], ['positions' => $positionsFormatted]);
        return redirect()->back()->with('notif-success', 'Position activated successfully.');
    }
    public function retrieve_positions($organization)
    {
        $organizationsModel = new \App\Models\Organizations();
        $org = $organizationsModel->where('organization_name', str_replace('%', ' ', $organization))->first();
        if (!$org) {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Organization not found.']);
        }
        $positions = [];
        if (!empty($org['positions'])) {
            $pairs = explode(',', $org['positions']);
            foreach ($pairs as $pair) {
                list($pos, $active) = explode('=', $pair);
                $positions[$pos] = (int)$active;
            }
        }
        return $this->response->setJSON(['positions' => $positions]);
    }
}
