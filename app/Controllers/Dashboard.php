<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard Page'
        ];
        return view('admin/dashboard/index', $data);
    }
}
