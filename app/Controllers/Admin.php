<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Admin extends BaseController
{
    public function index()
    {
        return view('admin/campaigns');
    }

    public function results()
    {
        return view('admin/results');
    }

    public function candidates()
    {
        return view('admin/candidates');
    }
}