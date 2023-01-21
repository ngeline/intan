<?php

namespace App\Controllers;

use App\Models\KelasModel;

class Kelas extends BaseController
{
    protected $kelasModel;
    public function __construct()
    {
        $this->kelasModel = new KelasModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Kelas',
            'kelas' => $this->kelasModel->findAll()
        ];
        return view('admin/kelas/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Kelas',
            'validation'    => \Config\Services::validation()
        ];
        return view('admin/kelas/tambah', $data);
    }

    public function store()
    {
        if(!$this->validate([
            'nama_kelas'    => [
                'rules'         => 'required|is_unique[kelas.nama_kelas]',
                'errors'        => [
                    'required'  => '{field} harus diisi!',
                    'is_unique' => '{filed} sudah tersedia!'
                ]
            ]
        ])){
            // $validation = \Config\Services::validation();
            session()->setFlashdata('error', 'Failed to adding data!');
            // return redirect()->to(base_url('/komik/edit/'.$this->request->getVar('slug')))->withInput()->with('validation', $validation);
            return redirect()->to(base_url('/kelas/tambah-kelas'))->withInput();
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
        $data = [
            'title' => 'Detail Komik',
            'kelas' => $this->kelasModel->find($id),
            'validation'    => \Config\Services::validation()
        ];

        // When Komik Not Found
        if(empty($data['kelas'])){
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Kelas dengan Id = '.$id.' Tidak Ditemukan!');
        }

        return view('admin/kelas/detail', $data);
    }

    public function update($id)
    {
        $kelas = $this->kelasModel->find($id);
        if($kelas['nama_kelas'] != $this->request->getVar('nama_kelas')){
            $validate_nama = 'required';
        }else{
            $validate_nama = 'required';
        }
        if(!$this->validate([
            'nama_kelas'    => [
                'rules'         => $validate_nama,
                'errors'        => [
                    'required'  => '{field} harus diisi!',
                    'is_unique' => '{filed} sudah tersedia!'
                ]
            ]
        ])){
            // $validation = \Config\Services::validation();
            session()->setFlashdata('error', 'Failed to adding data!');
            // return redirect()->to(base_url('/komik/edit/'.$this->request->getVar('slug')))->withInput()->with('validation', $validation);
            return redirect()->to(base_url('/kelas/edit/'.$id))->withInput();
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