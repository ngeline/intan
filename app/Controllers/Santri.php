<?php

namespace App\Controllers;

use App\Models\SantriModel;
use App\Models\AdminModel;

class Santri extends BaseController
{
    protected $santriModel, $adminModel;
    public function __construct()
    {
        $this->santriModel = new SantriModel();
        $this->adminModel = new AdminModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Santri',
            'santri' => $this->santriModel->findAll()
        ];
        return view('admin/santri/index', $data);
    }

    public function create()
    {
        $id_admin = $this->adminModel->where('id_user', user_id())->first();
        $data = [
            'title'         => 'Tambah Santri',
            'validation'    => \Config\Services::validation(),
            'id_admin'      => $id_admin['id_admin']
        ];
        return view('admin/santri/tambah', $data);
    }

    public function store()
    {
        if(!$this->validate([
            'nama_santri'    => [
                'rules'         => 'required|is_unique[santri.nama_santri]',
                'errors'        => [
                    'required'  => '{field} harus diisi!',
                    'is_unique' => '{filed} sudah tersedia!'
                ]
            ]
        ])){
            // $validation = \Config\Services::validation();
            session()->setFlashdata('error', 'Failed to adding data!');
            // return redirect()->to(base_url('/santri/edit/'.$this->request->getVar('slug')))->withInput()->with('validation', $validation);
            return redirect()->to(base_url('/santri/tambah-santri'))->withInput();
        };

        $this->santriModel->save([
            'id_admin'      => $this->request->getVar('id_admin'),
            'nama_santri'    => $this->request->getVar('nama_santri')
        ]);

        session()->setFlashdata('success', 'Berhasil Tambah data!');

        return redirect()->to('/santri');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Detail Santri',
            'kelas' => $this->santriModel->find($id),
            'validation'    => \Config\Services::validation()
        ];

        // When Komik Not Found
        if(empty($data['santri'])){
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Santri dengan Id = '.$id.' Tidak Ditemukan!');
        }

        return view('admin/santri/detail', $data);
    }

    public function update($id)
    {
        $santri = $this->santriModel->find($id);
        if($santri['nama_santri'] != $this->request->getVar('nama_santri')){
            $validate_nama = 'required';
        }else{
            $validate_nama = 'required';
        }
        if(!$this->validate([
            'nama_santri'    => [
                'rules'         => $validate_nama,
                'errors'        => [
                    'required'  => '{field} harus diisi!',
                    'is_unique' => '{filed} sudah tersedia!'
                ]
            ]
        ])){
            // $validation = \Config\Services::validation();
            session()->setFlashdata('error', 'Failed to adding data!');
            // return redirect()->to(base_url('/santri/edit/'.$this->request->getVar('slug')))->withInput()->with('validation', $validation);
            return redirect()->to(base_url('/santri/edit/'.$id))->withInput();
        };

        $this->santriModel->update($id, [
            'id_admin'      => $this->request->getVar('id_admin'),
            'nama_santri'    => $this->request->getVar('nama_santri')
        ]);

        session()->setFlashdata('success', 'Berhasil Edit data!');

        return redirect()->to('/santri');
    }
    public function delete($id)
    {
        $santri = $this->santriModel->find($id);
        if($santri){
            $this->santriModel->delete($id);
            session()->setFlashdata('success-delete', 'Berhasil Hapus data!');
            return redirect()->to('/santri');
        }else{
            session()->setFlashdata('error', 'Gagal Menghapus data! Mungkin data sudah terhapus! silahkan reflesh page!');
            return redirect()->to('/santri');
        }
    }

}
