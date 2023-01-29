<?php

namespace App\Controllers;

use App\Models\WaliSantriModel;
use App\Models\AdminModel;
use App\Models\SantriModel;
use App\Models\UserModelCustom;
use \Myth\Auth\Password;

class WaliSantri extends BaseController
{

    protected $walisantriModel, $santriModel, $adminModel, $user, $db;
    public function __construct()
    {
        $this->walisantriModel = new WaliSantriModel();
        $this->santriModel = new SantriModel();
        $this->adminModel = new AdminModel();
        $this->user = new UserModelCustom();
        $this->db = db_connect();
    }
    public function index()
    {
        $walisantri = $this->db->query('SELECT walisantri.id as id_walisantri, walisantri.*, users.*, santri.* FROM walisantri, santri, users WHERE walisantri.id_user = users.id AND walisantri.nis = santri.nis');
        $walisantri = $walisantri->getResultArray();
        $data = [
            'title' => 'WaliSantri',
            'walisantri' => $walisantri
        ];
        return view('admin/walisantri/index', $data);
    }

    public function create()
    {
        $id_admin = $this->adminModel->where('id_user', user_id())->first();
        $santri = $this->santriModel->findAll();
        $data = [
            'title' => 'Tambah Wali Santri',
            'validation'    => \Config\Services::validation(),
            'id_admin'      => $id_admin['id_admin'],
            'santri'        => $santri
        ];
        return view('admin/walisantri/tambah', $data);
    }

    public function store()
    {
        if(!$this->validate([
            'nama_walisantri'    => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Nama Wali Santri harus diisi!'
                ]
                ],
            'nis'    => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'NIS Santri harus dipilih!'
                ]
                ],
            'jenis_kelamin'    => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Jenis Kelamin Santri harus diisi!'
                ]
                ],
            'tempat'    => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Tempat Lahir Santri harus diisi!'
                ]
                ],
            'tanggal_lahir'    => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Tanggal Lahir Santri harus diisi!'
                ]
                ],
            'usia_santri'    => [
                    'rules'         => 'required',
                    'errors'        => [
                        'required'  => 'Usia Santri harus diisi!'
                    ]
                    ],
            'alamat'    => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Alamat Santri harus diisi!'
                ]
                ],
            'nama_ayah'    => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Nama Ayah Santri harus diisi!'
                ]
                ],
            'pekerjaan_ayah'    => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Pekerjaan Ayah Santri harus diisi!'
                ]
                ],
            'nama_ibu'    => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Nama Ibu Santri harus diisi!'
                ]
                ],
            'pekerjaan_ibu'    => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Pekerjaan Ibu Santri harus diisi!'
                ]
                ],
            'no_telepon'    => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Nomor Telepon Wali Santri harus diisi!'
                ]
                ],
        ])){
            session()->setFlashdata('error', 'Failed to adding data!');
            // return redirect()->to(base_url('wali-santri/tambah-walisantri'))->withInput()->with('validation', $validation);
            return redirect()->back()->withInput();
        };

        $checkUser = $this->user->where('username', $this->request->getVar('nama_walisantri'))->first();
        if(!$checkUser){
            $this->user->save([
                'email'     => $this->request->getVar('nama_walisantri').'@gmail.com',
                'username'  => $this->request->getVar('nama_walisantri'),
                'password_hash'  => Password::hash('walisantri')
            ]);
        }else{
            $countUser = count($checkUser);
            $countUser += 1;
            $this->user->save([
                'email'     => $this->request->getVar('nama_walisantri').''.$countUser.'@gmail.com',
                'username'  => $this->request->getVar('nama_walisantri').''.$countUser,
                'password_hash'  => Password::hash('walisantri')
            ]);
        }


        $user = $this->user->where('email', $this->request->getVar('nama_walisantri').'@gmail.com')->first();

        $this->walisantriModel->save([
            'id_user'       => $user['id'],
            'nis'           => $this->request->getVar('nis'),
            'id_admin'      => $this->request->getVar('id_admin'),
            'nama_walisantri'   => $this->request->getVar('nama_walisantri'),
            'jenis_kelamin'     => $this->request->getVar('jenis_kelamin'),
            'tempat'            => $this->request->getVar('tempat'),
            'tanggal_lahir'     => $this->request->getVar('tanggal_lahir'),
            'usia_santri'       => $this->request->getVar('usia_santri'),
            'alamat'            => $this->request->getVar('alamat'),
            'nama_ayah'            => $this->request->getVar('nama_ayah'),
            'nama_ibu'            => $this->request->getVar('nama_ibu'),
            'no_telepon'            => $this->request->getVar('no_telepon'),
            'pekerjaan_ayah'            => $this->request->getVar('pekerjaan_ayah'),
            'pekerjaan_ibu'            => $this->request->getVar('pekerjaan_ibu'),
        ]);

        session()->setFlashdata('success', 'Berhasil Tambah data!');

        return redirect()->to(url_to('walisantri'));
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Detail Wali Santri',
            'walisantri' => $this->walisantriModel->find($id),
            'santri'    => $this->santriModel->findAll(),
            'validation'    => \Config\Services::validation()
        ];

        // When Komik Not Found
        if(empty($data['walisantri'])){
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Kelas dengan Id = '.$id.' Tidak Ditemukan!');
        }

        return view('admin/walisantri/edit', $data);
    }

    public function update($id)
    {
        $walisantri = $this->walisantriModel->find($id);

        if(!$this->validate([
            'nama_walisantri'    => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Nama Wali Santri harus diisi!'
                ]
            ],
            'nis'    => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'NIS Santri harus dipilih!'
                ]
            ],
            'jenis_kelamin'    => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Jenis Kelamin Santri harus diisi!'
                ]
            ],
            'tempat'    => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Tempat Lahir Santri harus diisi!'
                ]
            ],
            'tanggal_lahir'    => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Tanggal Lahir Santri harus diisi!'
                ]
            ],
            'usia_santri'    => [
                    'rules'         => 'required',
                    'errors'        => [
                        'required'  => 'Usia Santri harus diisi!'
                    ]
            ],
            'alamat'    => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Alamat Santri harus diisi!'
                ]
            ],
            'nama_ayah'    => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Nama Ayah Santri harus diisi!'
                ]
            ],
            'pekerjaan_ayah'    => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Pekerjaan Ayah Santri harus diisi!'
                ]
            ],
            'nama_ibu'    => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Nama Ibu Santri harus diisi!'
                ]
            ],
            'pekerjaan_ibu'    => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Pekerjaan Ibu Santri harus diisi!'
                ]
            ],
            'no_telepon'    => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Nomor Telepon Wali Santri harus diisi!'
                ]
            ]
        ])){
            // $validation = \Config\Services::validation();
            session()->setFlashdata('error', 'Failed to adding data!');
            // return redirect()->to(base_url('/komik/edit/'.$this->request->getVar('slug')))->withInput()->with('validation', $validation);
            return redirect()->to(base_url('/walisantri/edit/'.$id))->withInput();
        };

        $this->user->update($walisantri['id_user'], [
            'email'     => $this->request->getVar('nama_walisantri').'@gmail.com',
            'username'  => $this->request->getVar('nama_walisantri')
        ]);

        $this->walisantriModel->update($id, [
            'nis'           => $this->request->getVar('nis'),
            'nama_walisantri'   => $this->request->getVar('nama_walisantri'),
            'jenis_kelamin'     => $this->request->getVar('jenis_kelamin'),
            'tempat'            => $this->request->getVar('tempat'),
            'tanggal_lahir'     => $this->request->getVar('tanggal_lahir'),
            'usia_santri'       => $this->request->getVar('usia_santri'),
            'alamat'            => $this->request->getVar('alamat'),
            'nama_ayah'            => $this->request->getVar('nama_ayah'),
            'nama_ibu'            => $this->request->getVar('nama_ibu'),
            'no_telepon'            => $this->request->getVar('no_telepon'),
            'pekerjaan_ayah'            => $this->request->getVar('pekerjaan_ayah'),
            'pekerjaan_ibu'            => $this->request->getVar('pekerjaan_ibu'),
        ]);

        session()->setFlashdata('success', 'Berhasil Edit data!');

        return redirect()->to(url_to('walisantri'));
    }

    public function delete($id)
    {
        $walisantri = $this->walisantriModel->find($id);
        $user = $this->user->find($walisantri['id_user']);
        if($walisantri && $user){
            $this->walisantriModel->delete($id);
            $this->user->delete($walisantri['id_user']);
            session()->setFlashdata('success-delete', 'Berhasil Hapus data!');
            return redirect()->to(url_to('walisantri'));
        }else{
            session()->setFlashdata('error', 'Gagal Menghapus data! Mungkin data sudah terhapus! silahkan reflesh page!');
            return redirect()->to(url_to('walisantri'));
        }
    }
}
