<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Campaigns extends BaseController
{
    public function index()
    {
        $campaignModel = new \App\Models\Campaigns();
        return view('admin/campaigns', ['campaigns' => $campaignModel->findAll()]);
    }
    public function campaign_lists()
    {
        $campaignModel = new \App\Models\Campaigns();
        $campaigns = $campaignModel->findAll();
        return view('admin/campaign_lists', ['campaigns' => $campaigns]);
    }
    public function create_campaign()
    {
        $data = [
            'title' => $this->request->getPost('campaign_name'),
            'details' => $this->request->getPost('description'),
            'image_url' => $this->request->getPost('image_url'),
            'image_file' => $this->request->getPost('image_file'),
            'partylist' => $this->request->getPost('partylist'),
        ];
        $campaignModel = new \App\Models\Campaigns();
        $existing = $campaignModel
            ->where('title', $data['title'])
            ->orWhere('image_url', $data['image_url'])
            ->first();
        if (empty($data['image_url']) && !empty($_FILES['image_file']['name'])) {
            $file = $this->request->getFile('image_file');
            if ($file->isValid() && !$file->hasMoved()) {
                $filename = $file->getClientName();
                $uploadPath = FCPATH . 'campaigns/';
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }
                $file->move($uploadPath, $filename);
                $data['image_url'] = '/campaigns/' . $filename;
            } else {
                session()->setFlashdata('error', 'Invalid image file.');
                return redirect()->to('/campaign_lists');
            }
            $existing = $campaignModel
                ->where('title', $data['title'])
                ->orWhere('image_url', $data['image_url'])
                ->first();
        }
        if ($existing) {
            session()->setFlashdata('notif-error', 'Campaign title or image already exists.');
            return redirect()->to('/campaign_lists');
        }
        $campaignModel->insert([
            'title' => $data['title'],
            'details' => $data['details'],
            'image_url' => $data['image_url'],
            'partylist' => $data['partylist'],
        ]);
        session()->setFlashdata('notif-success', 'Campaign title or image already exists.');
        return view('admin/campaign_lists', ['campaigns' => $campaignModel->findAll()]);
    }
    public function retrieve_campaigns()
    {
        $campaignModel = new \App\Models\Campaigns();
        $campaigns = $campaignModel->findAll();
        if (empty($campaigns)) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'No campaigns found.']);
        }
        return $this->response->setJSON(['status' => 'success', 'data' => $campaigns]);
    }
    public function delete_campaign($id)
    {
        $campaignModel = new \App\Models\Campaigns();
        $campaign = $campaignModel->find($id);
        if ($campaign) {
            if (!empty($campaign['image_url']) && file_exists(FCPATH . $campaign['image_url'])) {
                unlink(FCPATH . $campaign['image_url']);
            }
            $campaignModel->delete($id);
            session()->setFlashdata('notif-success', 'Campaign deleted successfully.');
        } else {
            session()->setFlashdata('notif-error', 'Campaign not found.');
        }
        return redirect()->to('/campaign_lists');
    }
    public function update_campaign($id)
    {
        $campaignModel = new \App\Models\Campaigns();
        $campaign = $campaignModel->find($id);
        if (!$campaign) {
            session()->setFlashdata('notif-error', 'Campaign not found.');
            return redirect()->to('/campaign_lists');
        }
        $data = [
            'title' => $this->request->getPost('campaign_name'),
            'details' => $this->request->getPost('description'),
            'image_url' => $this->request->getPost('image_url'),
            'partylist' => $this->request->getPost('partylist'),
        ];
        if (!empty($_FILES['image_file']['name'])) {
            $file = $this->request->getFile('image_file');
            if ($file->isValid() && !$file->hasMoved()) {
                if (!empty($campaign['image_url']) && file_exists(FCPATH . $campaign['image_url'])) {
                    unlink(FCPATH . $campaign['image_url']);
                }
                $filename = $file->getClientName();
                $uploadPath = FCPATH . 'campaigns/';
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }
                $file->move($uploadPath, $filename);
                $data['image_url'] = '/campaigns/' . $filename;
            } else {
                session()->setFlashdata('error', 'Invalid image file.');
                return redirect()->to('/campaign_lists');
            }
        }
        $existing = $campaignModel
            ->where('title', $data['title'])
            ->orWhere('image_url', $data['image_url'])
            ->first();
        if ($existing && $existing['campaign_id'] != $id) {
            session()->setFlashdata('notif-error', 'Campaign title or image already exists.');
            return redirect()->to('/campaign_lists');
        }
        $campaignModel->update($id, [
            'title' => $data['title'],
            'details' => $data['details'],
            'image_url' => $data['image_url'],
            'partylist' => $data['partylist'],
        ]);
        session()->setFlashdata('notif-success', 'Campaign updated successfully.');
        return redirect()->to('/campaign_lists');
    }

    public function retrieve_partylist()
    {
        $campaignModel = new \App\Models\Campaigns();
        // Get unique partylists from campaigns table
        $partylists = $campaignModel->distinct()->select('partylist')->where('partylist IS NOT NULL')->where('partylist !=', '')->findAll();
        $partylistNames = array_map(function($row) {
            return $row['partylist'];
        }, $partylists);
        return $this->response->setJSON(['partylists' => $partylistNames]);
    }
}
