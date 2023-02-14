<?php

namespace App\Controllers;

use App\Models\KelasModel;
use App\Models\AdminModel;

class Kelas extends BaseController
{
    protected $kelasModel, $adminModel;
    public function __construct()
    {
        $this->kelasModel = new KelasModel();
        $this->adminModel = new AdminModel();
    }

    public function index()
    {
        $id_admin = $this->adminModel->where('id_user', user_id())->first();
        $data = [
            'title' => 'Kelas',
            'kelas' => $this->kelasModel->findAll()
        ];
        return view('kelas/index', $data);
    }

    public function create()
    {
        $id_admin = $this->adminModel->where('id_user', user_id())->first();
        $data = [
            'title' => 'Tambah Kelas',
            'id_admin' => $id_admin['id_admin'],
            'validation'    => \Config\Services::validation()
        ];
        return view('kelas/tambah', $data);
    }

    public function store()
    {
        $this->validation->setRules([
            'nama_kelas'    => [
                'rules'         => 'required|is_unique[kelas.nama_kelas]',
                'errors'        => [
                    'required'  => 'Nama kelas harus diisi!',
                    'is_unique' => 'Nama kelas sudah tersedia!'
                ]
            ]
        ]);
        if(!$this->validation->withRequest($this->request)->run()){
            session()->setFlashdata('error-header', 'Failed to adding data!');
            return redirect()->back()->withInput()->with('error', $this->validation->getErrors());
        };

        $this->kelasModel->save([
            'id_admin'      => $this->request->getVar('id_admin'),
            'nama_kelas'    => $this->request->getVar('nama_kelas')
        ]);

        session()->setFlashdata('success', 'Berhasil Tambah data!');

        return redirect()->to('/kelas');
    }

    public function edit($id)
    {
        $id_admin = $this->adminModel->where('id_user', user_id())->first();
        $data = [
            'title'     => 'Detail Komik',
            'kelas'     => $this->kelasModel->find($id),
            'id_admin'  => $id_admin,
            'validation'    => \Config\Services::validation()
        ];

        // When Komik Not Found
        if(empty($data['kelas'])){
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Kelas dengan Id = '.$id.' Tidak Ditemukan!');
        }

        return view('kelas/detail', $data);
    }

    public function update($id)
    {
        $kelas = $this->kelasModel->find($id);
        $this->validation->setRules([
            'nama_kelas'    => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Nama kelas harus diisi!',
                ]
            ]
        ]);
        if(!$this->validation->withRequest($this->request)->run()){
            session()->setFlashdata('error-header', 'Failed to adding data!');
            return redirect()->back()->withInput()->with('error', $this->validation->getErrors());
        };

        $this->kelasModel->update($id, [
            'id_admin'      => $this->request->getVar('id_admin'),
            'nama_kelas'    => $this->request->getVar('nama_kelas')
        ]);

        session()->setFlashdata('success', 'Berhasil Edit data!');

        return redirect()->to('/kelas');
    }

    public function delete($id)
    {
        $kelas = $this->kelasModel->find($id);
        if($kelas){
            $this->kelasModel->delete($id);
            session()->setFlashdata('success-delete', 'Berhasil Hapus data!');
            return redirect()->to('/kelas');
        }else{
            session()->setFlashdata('error', 'Gagal Menghapus data! Mungkin data sudah terhapus! silahkan reflesh page!');
            return redirect()->to('/kelas');
        }
    }
}
