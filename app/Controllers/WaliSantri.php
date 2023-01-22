<?php

namespace App\Controllers;

use App\Models\WaliSantriModel;

class WaliSantri extends BaseController
{

    protected $walisantriModel;
    public function __construct()
    {
        $this->walisantriModel = new WaliSantriModel();
    }
    public function index()
    {
        $data = [
            'title' => 'WaliSantri',
            'walisantri' => $this->walisantriModel->findAll()
        ];
        return view('admin/walisantri/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah WaliSantri',
            'validation'    => \Config\Services::validation()
        ];
        return view('admin/walisantri/tambah', $data);
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
            return redirect()->to(base_url('/walisantri/tambah-walisantri'))->withInput();
        };

        $this->walisantriModel->save([
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
            'walisantri' => $this->walisantriModel->find($id),
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
        $walisantri = $this->walisantriModel->find($id);
        if($walisantri['nama_wali'] != $this->request->getVar('nama_wali')){
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
            return redirect()->to(base_url('/walisantri/edit/'.$id))->withInput();
        };

        $this->walisantriModel->update($id, [
            'id_admin'      => $this->request->getVar('id_admin'),
            'nama_wali'    => $this->request->getVar('nama_wali')
        ]);

        session()->setFlashdata('success', 'Berhasil Edit data!');

        return redirect()->to('/walisantri');
    }

    public function delete($id)
    {
        $walisantri = $this->walisantriModel->find($id);
        if($walisantri){
            $this->walisantriModel->delete($id);
            session()->setFlashdata('success-delete', 'Berhasil Hapus data!');
            return redirect()->to('/walisantri');
        }else{
            session()->setFlashdata('error', 'Gagal Menghapus data! Mungkin data sudah terhapus! silahkan reflesh page!');
            return redirect()->to('/walisantri');
        }
    }
}
