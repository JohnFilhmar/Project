<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Officer extends BaseController
{
    public function profile()
    {
        return view('officer/profile');
    }
}