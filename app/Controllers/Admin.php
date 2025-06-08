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
    
    public function studentLists()
    {
        $students = [];

        $first_names = ["John", "Jane", "Michael", "Emily", "Daniel", "Sophia", "Chris", "Olivia", "David", "Emma"];
        $last_names = ["Smith", "Johnson", "Williams", "Brown", "Jones", "Garcia", "Martinez", "Lee", "Clark", "Lewis"];
        $courses = ["BSIT", "BSCS", "BSBA", "BSA", "BSEd", "BSCE", "BSN", "BSCrim"];
        $orgs = ["Red Cross Youth", "Rotaract", "JPCS", "ACSS", "GDSC", "SC", "None"];

        for ($i = 1; $i <= 20; $i++) {
            $first = $first_names[array_rand($first_names)];
            $last = $last_names[array_rand($last_names)];
            $full_name = "$first $last";

            $student_number = "2023-" . str_pad($i, 4, "0", STR_PAD_LEFT);
            $course = $courses[array_rand($courses)];
            $year_level = rand(1, 4);
            $contact = "09" . rand(100000000, 999999999);
            $email = strtolower($first) . "." . strtolower($last) . "@school.edu.ph";
            $org_count = rand(1, 2);

            // ✅ Fix for implode error
            $selected_orgs = array_rand(array_flip($orgs), $org_count);
            $selected_orgs = is_array($selected_orgs) ? $selected_orgs : [$selected_orgs];
            $organizations = implode(", ", $selected_orgs);

            $students[$student_number] = [
                "full_name" => $full_name,
                "course" => $course,
                "year_level" => $year_level,
                "contact" => $contact,
                "email" => $email,
                "organizations" => $organizations
            ];
        }

        return view('admin/student-lists', ['students' => $students]);
    }
}
