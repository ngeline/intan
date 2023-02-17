<?php

namespace App\Controllers;

use App\Models\UserModelCustom;
use App\Models\WaliSantriModel;
use App\Models\SantriModel;
use App\Models\UserGroupModel;

use App\Controllers\BaseController;

use \Myth\Auth\Password;

class Profile extends BaseController
{
    protected $user, $walisantri, $usergroup, $santri;
    public function __construct()
    {
        $this->user = new UserModelCustom();
        $this->usergroup = new UserGroupModel();
        $this->walisantri = new WaliSantriModel();
        $this->santri = new SantriModel();
    }

    public function index($id)
    {
        $u_group = $this->usergroup->where('user_id', $id)->first();
        if($u_group['group_id'] == 1){
            $user = $this->user->find($id);

            $data = [
                'title'     => 'My Profile',
                'validation'    => \Config\Services::validation(),
                'user'      => $user,
                'u_group'   => $u_group,
            ];
            
            return view('profile/index', $data);
        }else{
            $user = $this->user->find($id);
            $walisantri = $this->walisantri->where('id_user', $id)->first();

            $data = [
                'title'     => 'My Profile',
                'validation'    => \Config\Services::validation(),
                'user'      => $user,
                'u_group'   => $u_group,
                'walisantri'=> $walisantri,
                'santri'    => $this->santri->findAll()
            ];

            return view('profile/index', $data);
        }

    }

    public function update($id)
    {
        $u_group = $this->usergroup->where('user_id', $id)->first();
        if($u_group['group_id'] == 1){
            if($this->request->getVar('password') != null || $this->request->getVar('password') != '' ){
                $this->user->update($id, [
                    'email'     => $this->request->getVar('email'),
                    'username'  => $this->request->getVar('username'),
                    'password_hash' =>  Password::hash($this->request->getVar('password'))
                ]);
            }else{
                $this->user->update($id, [
                    'email'     => $this->request->getVar('email'),
                    'username'  => $this->request->getVar('username')
                ]);
            }

            session()->setFlashdata('success', 'Berhasil Edit data!');
            return redirect()->back();
        }else{ //walisantri
            // get data wali santri
            $walisantri = $this->walisantri->where('id_user', $id)->first();

            // validation
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
                session()->setFlashdata('error', 'Failed to update data!');
                // return redirect()->to(base_url('/komik/edit/'.$this->request->getVar('slug')))->withInput()->with('validation', $validation);
                return redirect()->back();
            };

            if($this->request->getVar('password') != null || $this->request->getVar('password') != '' ){
                $this->user->update($id, [
                    'email'     => $this->request->getVar('email'),
                    'username'  => $this->request->getVar('username'),
                    'password_hash' =>  Password::hash($this->request->getVar('password'))
                ]);
            }else{
                $this->user->update($id, [
                    'email'     => $this->request->getVar('email'),
                    'username'  => $this->request->getVar('username')
                ]);
            }

            $this->walisantri->update($walisantri['id'], [
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
            return redirect()->back();
        }
    }

    public function updateInsert($id)
    {
        $u_group = $this->usergroup->where('user_id', $id)->first();
        if($u_group['group_id'] == 1){
            if($this->request->getVar('password') != null || $this->request->getVar('password') != '' ){
                $this->user->update($id, [
                    'email'     => $this->request->getVar('email'),
                    'username'  => $this->request->getVar('username'),
                    'password_hash' =>  Password::hash($this->request->getVar('password'))
                ]);
            }else{
                $this->user->update($id, [
                    'email'     => $this->request->getVar('email'),
                    'username'  => $this->request->getVar('username')
                ]);
            }

            session()->setFlashdata('success', 'Berhasil Edit data!');
            return redirect()->back();
        }else{ //walisantri
            // get data wali santri
            $walisantri = $this->walisantri->where('id_user', $id)->first();

            // validation
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
                session()->setFlashdata('error', 'Failed to update data!');
                // return redirect()->to(base_url('/komik/edit/'.$this->request->getVar('slug')))->withInput()->with('validation', $validation);
                return redirect()->back();
            };

            if($this->request->getVar('password') != null || $this->request->getVar('password') != '' ){
                $this->user->update($id, [
                    'email'     => $this->request->getVar('email'),
                    'username'  => $this->request->getVar('username'),
                    'password_hash' =>  Password::hash($this->request->getVar('password'))
                ]);
            }else{
                $this->user->update($id, [
                    'email'     => $this->request->getVar('email'),
                    'username'  => $this->request->getVar('username')
                ]);
            }

            $this->walisantri->insert([
                'id_user'       => $id,
                'id_admin'      => 3,
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
            return redirect()->back();
        }
    }
}
