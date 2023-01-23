<?php

namespace App\Controllers;

use App\Models\SPPModel;

class SPP extends BaseController
{
    protected $sppModel;
    public function __construct()
    {
        $this->sppModel = new SPPModel();
    }

    public function index()
    {
        $data = [
            'title' => 'SPP',
            'spp' => $this->sppModel->findAll()
        ];
        return view('admin/spp/index', $data);
    }
}
