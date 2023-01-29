<?php

namespace App\Controllers;

use App\Models\SPPModel;
use App\Models\AdminModel;
use App\Models\SantriModel;

class SPP extends BaseController
{
    protected $sppModel, $adminModel, $santriModel;
    public function __construct()
    {
        $this->sppModel = new SPPModel();
        $this->adminModel = new AdminModel();
        $this->santriModel = new SantriModel();
    }

    public function index()
    {
        $data = [
            'title' => 'SPP',
            'spp' => $this->sppModel->findAll()
        ];
        return view('admin/spp/index', $data);
    }

    public function create()
    {
        $id_admin = $this->adminModel->where('id_user', user_id())->first();
        $santri = $this->santriModel->findAll();
        $data = [
            'title' => 'Tambah Wali Santri',
            'validation'    => $this->validation,
            'id_admin'      => $id_admin['id_admin'],
            'santri'        => $santri
        ];
        return view('admin/spp/tambah', $data);
    }

    public function store()
    {
        $validate = $this->validate(
            [
                'nis'           => [
                    'rules' => 'required',
                    'errors' => [
                        'required'  => 'NIS dan Nama Santri Harus Dipilih!'
                    ]
                ],
                'tanggal'       => [
                    'rules' => 'required',
                    'errors'=> [
                        'required' => 'Tanggal Iuran Harus Dipilih!'
                    ]
                ],
                'jumlah_iuran'  => [
                    'rules' => 'required',
                    'errors'=> [
                        'required' => 'Tanggal Iuran Harus Dipilih!'
                    ]
                ],
                'keterangan'    => [
                    'rules' => 'required',
                    'errors'=> [
                        'required'  => 'Keterangan Harus Diisi!'
                    ]
                ]
            ]
        );

        if($validate == false){
            session()->setFlashdata('error', 'Failed to adding data!');
            return redirect()->back()->withInput()->with('validation', $this->validation->getErrors());
        }

        $santri = $this->santriModel->where('nis', $this->request->getVar('nis'))->first();

        $this->sppModel->save([
            'id_admin'          => $this->request->getVar('id_admin'),
            'nis'               => $this->request->getVar('nis'),
            'nama_santri'       => $santri['nama_santri'],
            'tanggal'           => $this->request->getVar('tanggal'),
            'jumlah_iuran'      => $this->request->getVar('jumlah_iuran'),
            'keterangan'        => $this->request->getVar('keterangan')
        ]);

        session()->setFlashdata('success', 'Berhasil Tambah data!');

        return redirect()->to(url_to('spp'));
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Detail SPP Santri',
            'spp' => $this->sppModel->find($id),
            'santri'    => $this->santriModel->findAll(),
            'validation'    => $this->validation
        ];

        // When Komik Not Found
        if(empty($data['spp'])){
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Kelas dengan Id = '.$id.' Tidak Ditemukan!');
        }

        return view('admin/spp/edit', $data);
    }

    public function update($id)
    {
        $validate = $this->validate(
            [
                'nis'           => [
                    'rules' => 'required',
                    'errors' => [
                        'required'  => 'NIS dan Nama Santri Harus Dipilih!'
                    ]
                ],
                'tanggal'       => [
                    'rules' => 'required',
                    'errors'=> [
                        'required' => 'Tanggal Iuran Harus Dipilih!'
                    ]
                ],
                'jumlah_iuran'  => [
                    'rules' => 'required',
                    'errors'=> [
                        'required' => 'Tanggal Iuran Harus Dipilih!'
                    ]
                ],
                'keterangan'    => [
                    'rules' => 'required',
                    'errors'=> [
                        'required'  => 'Keterangan Harus Diisi!'
                    ]
                ]
            ]
        );

        if($validate == false){
            session()->setFlashdata('error', 'Failed to adding data!');
            return redirect()->back()->withInput()->with('validation', $this->validation->getErrors());
        }

        $santri = $this->santriModel->where('nis', $this->request->getVar('nis'))->first();

        $this->sppModel->update($id, [
            'id_admin'          => $this->request->getVar('id_admin'),
            'nis'               => $this->request->getVar('nis'),
            'nama_santri'       => $santri['nama_santri'],
            'tanggal'           => $this->request->getVar('tanggal'),
            'jumlah_iuran'      => $this->request->getVar('jumlah_iuran'),
            'keterangan'        => $this->request->getVar('keterangan')
        ]);

        session()->setFlashdata('success', 'Berhasil Edit data!');

        return redirect()->to(url_to('spp'));
    }

    public function delete($id)
    {
        $spp = $this->sppModel->find($id);
        if($spp){
            $this->sppModel->delete($id);
            session()->setFlashdata('success-delete', 'Berhasil Hapus data!');
            return redirect()->to(url_to('spp'));
        }else{
            session()->setFlashdata('error', 'Gagal Menghapus data! Mungkin data sudah terhapus! silahkan reflesh page!');
            return redirect()->to(url_to('spp'));
        }
    }
}
