<?php

namespace App\Controllers;

use App\Models\SantriModel;
use App\Models\AdminModel;
use App\Models\KelasModel;

class Santri extends BaseController
{
    protected $santriModel, $adminModel, $kelasModel;
    public function __construct()
    {
        $this->santriModel = new SantriModel();
        $this->adminModel = new AdminModel();
        $this->kelasModel = new KelasModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Santri',
            'santri' => $this->santriModel->findAll()
        ];
        return view('santri/index', $data);
    }

    public function create()
    {
        $id_admin = $this->adminModel->where('id_user', user_id())->first();
        $data = [
            'title'         => 'Tambah Santri',
            'validation'    => $this->validation,
            'id_admin'      => $id_admin['id_admin'],
            'kelas'         => $this->kelasModel->findAll()
        ];
        return view('santri/tambah', $data);
    }

    public function store()
    {
        $this->validation->setRules([
                'nis'               => 'required',
                'nama_santri'       => 'required',
                'jenis_kelamin'     => 'required',
                'id_kelas'          => 'required',
                'status_santri'     => 'required',    
            ],
            [ 
                'nis'   => [
                    'required' => 'NIS Harus Diisi!'
                ],
                'nama_santri' => [
                    'required' => 'Nama Santri Harus Diisi!'
                ],
                'jenis_kelamin' => [
                    'required'  => 'Jenis Kelamin Harus Dipilih!'
                ],
                'id_kelas'      => [
                    'required'  => 'Kelas Harus Dipilih!'
                ],
                'status_santri' => [
                    'required'  => 'Status Santri Harus Diisi!'
                ]
            ]
        );
        if(!$this->validation->withRequest($this->request)->run()){
            session()->setFlashdata('error-header', 'Failed to adding data!');
            return redirect()->back()->withInput()->with('error', $this->validation->getErrors());
        };

        $this->santriModel->save([
            'nis'           => $this->request->getVar('nis'),
            'id_admin'      => $this->request->getVar('id_admin'),
            'id_kelas'      => $this->request->getVar('id_kelas'),
            'nama_santri'   => $this->request->getVar('nama_santri'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'status_santri' => $this->request->getVar('status_santri')
        ]);

        session()->setFlashdata('success', 'Berhasil Tambah data!');

        return redirect()->to('/santri');
    }

    public function edit($nis)
    {
        $data = [
            'title' => 'Detail Santri',
            'santri' => $this->santriModel->where('nis', $nis)->first(),
            'kelas'         => $this->kelasModel->findAll(),
            'validation'    => \Config\Services::validation()
        ];

        // When Komik Not Found
        if(empty($data['santri'])){
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Santri dengan Id = '.$nis.' Tidak Ditemukan!');
        }

        return view('santri/edit', $data);
    }

    public function update($nis)
    {
        $this->validation->setRules([
                'nis'               => 'required',
                'nama_santri'       => 'required',
                'jenis_kelamin'     => 'required',
                'id_kelas'          => 'required',
                'status_santri'     => 'required',    
            ],
            [ 
                'nis'   => [
                    'required' => 'NIS Harus Diisi!'
                ],
                'nama_santri' => [
                    'required' => 'Nama Santri Harus Diisi!'
                ],
                'jenis_kelamin' => [
                    'required'  => 'Jenis Kelamin Harus Dipilih!'
                ],
                'id_kelas'      => [
                    'required'  => 'Kelas Harus Dipilih!'
                ],
                'status_santri' => [
                    'required'  => 'Status Santri Harus Diisi!'
                ]
            ]
        );
        if(!$this->validation->withRequest($this->request)->run()){
            session()->setFlashdata('error-header', 'Failed to adding data!');
            return redirect()->back()->withInput()->with('error', $this->validation->getErrors());
        };

        $this->santriModel->update($nis, [
            'nis'           => $this->request->getVar('nis'),
            'id_admin'      => $this->request->getVar('id_admin'),
            'id_kelas'      => $this->request->getVar('id_kelas'),
            'nama_santri'   => $this->request->getVar('nama_santri'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'status_santri' => $this->request->getVar('status_santri')
        ]);

        session()->setFlashdata('success', 'Berhasil Edit data!');

        return redirect()->to('/santri');
    }

    public function delete($nis)
    {
        $santri = $this->santriModel->where('nis', $nis)->find();
        if($santri){
            $this->santriModel->delete($nis);
            session()->setFlashdata('success-delete', 'Berhasil Hapus data!');
            return redirect()->to('/santri');
        }else{
            session()->setFlashdata('error', 'Gagal Menghapus data! Mungkin data sudah terhapus! silahkan reflesh page!');
            return redirect()->to('/santri');
        }
    }

}
