<?php

namespace App\Controllers;

use App\Models\WaliSantriModel;

class WaliSantri extends BaseController
{

    protected $walisantriModel;
    public function __construct()
    {
        $this->WaliSantriModel = new walisantriModel();
    }
    public function index()
    {
        $data = [
            'title' => 'WaliSantri',
            'WaliSantri' => $this->WaliSantriModel->findAll()
        ];
        return view('admin/walisantri/index');
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah WaliSantri',
            'validation'    => \Config\Services::validation()
        ];
        return view('admin/WaliSantri/tambah', $data);
    }

    public function store()
    {
        if(!$this->validate([
            'nama_walisantri'    => [
                'rules'         => 'required|is_unique[walisantri.nama_wali]',
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

        $this->WaliSantriModel->save([
            'id_admin'      => $this->request->getVar('id_admin'),
            'nama_wali'    => $this->request->getVar('nama_wali')
        ]);

        session()->setFlashdata('success', 'Berhasil Tambah data!');

        return redirect()->to('/walisantri');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Detail Wali Santri',
            'walisantri' => $this->WaliSantriModel->find($id),
            'validation'    => \Config\Services::validation()
        ];

        // When Komik Not Found
        if(empty($data['walisantri'])){
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Kelas dengan Id = '.$id.' Tidak Ditemukan!');
        }

        return view('admin/walisantri/detail', $data);
    }

    public function update($id)
    {
        $walisantri = $this->WaliSantriModel->find($id);
        if($walisantri['nama_wali'] != $this->request->getVar('nama_kelas')){
            $validate_nama = 'required';
        }else{
            $validate_nama = 'required';
        }
        if(!$this->validate([
            'nama_wali'    => [
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

        $this->WaliSantriModel->update($id, [
            'id_admin'      => $this->request->getVar('id_admin'),
            'nama_wali'    => $this->request->getVar('nama_wali')
        ]);

        session()->setFlashdata('success', 'Berhasil Edit data!');

        return redirect()->to('/walisantri');
    }

    public function delete($id)
    {
        $walisantri = $this->WaliSantriModel->find($id);
        if($walisantri){
            $this->WaliSantriModel->delete($id);
            session()->setFlashdata('success-delete', 'Berhasil Hapus data!');
            return redirect()->to('/walisantri');
        }else{
            session()->setFlashdata('error', 'Gagal Menghapus data! Mungkin data sudah terhapus! silahkan reflesh page!');
            return redirect()->to('/walisantri');
        }
    }
}
