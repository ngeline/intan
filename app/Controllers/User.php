<?php

namespace App\Controllers;

class User extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Kelola User'
        ];
        return view('admin/user/index', $data);
    }
}
