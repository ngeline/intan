<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard Page'
        ];
        return view('dashboard/index', $data);
    }
}
