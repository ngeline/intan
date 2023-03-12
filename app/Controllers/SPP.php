<?php

namespace App\Controllers;

use App\Models\TempSPPModel;
use App\Models\SPPModel;
use App\Models\AdminModel;
use App\Models\SantriModel;
use App\Models\UserGroupModel;
use App\Models\WaliSantriModel;

class SPP extends BaseController
{
    protected $usergroup, $tempsppModel, $sppModel, $adminModel, $santriModel, $walisantri, $db;
    public function __construct()
    {
        $this->usergroup = new UserGroupModel();
        $this->tempsppModel = new TempSPPModel();
        $this->sppModel = new SPPModel();
        $this->adminModel = new AdminModel();
        $this->santriModel = new SantriModel();
        $this->walisantri = new WaliSantriModel();
        $this->db = db_connect();
    }

    public function index()
    {
        $u_group = $this->usergroup->where('user_id', user_id())->first();
        if($u_group['group_id'] == 1){
            $data = [
                'title' => 'SPP',
                'spp' => $this->sppModel->findAll(),
                'status' => 1,
                'role' => $u_group['group_id']
            ];
        }else{
            $walisantri = $this->walisantri->where('id_user', user_id())->first();
            $data = [
                'title' => 'SPP',
                'spp' => $this->sppModel->where('nis', $walisantri['nis'])->findAll(),
                'sppTemp' =>$this->tempsppModel->where('nis', $walisantri['nis'])->findAll(),
                'status' => 1,
                'role' => $u_group['group_id']
            ];
        }
        return view('spp/index', $data);
    }

    public function search()
    {
        $u_group = $this->usergroup->where('user_id', user_id())->first();
        $fromDate = $this->request->getVar('fromDate');
        $toDate = $this->request->getVar('toDate');
        $status = $this->request->getVar('status');

        if($status == 0){
            $spp = $this->db->query(
                "SELECT * FROM temp_spp
                WHERE tanggal >= $fromDate OR tanggal <= $toDate"
            )->getResultArray();
        }else{
            $spp = $this->db->query(
                "SELECT * FROM spp
                WHERE tanggal >= $fromDate OR tanggal <= $toDate"
            )->getResultArray();
        }

        $data = [
            'title' => 'SPP',
            'spp' => $spp,
            'fromDate' => $fromDate,
            'toDate' => $toDate,
            'status' => $status,
            'role'  => $u_group['group_id']
        ];

        return view('spp/index', $data);
    }

    public function create()
    {
        $u_group = $this->usergroup->where('user_id', user_id())->first();
        if($u_group['group_id'] == 1){
            $id_admin = $this->adminModel->where('id_user', user_id())->first();
            $santri = $this->santriModel->findAll();
            $data = [
                'title' => 'Tambah Wali Santri',
                'validation'    => $this->validation,
                'id_admin'      => $id_admin['id_admin'],
                'santri'        => $santri,
                'u_group'       => $u_group
            ];
        }else{
            $id_admin = $this->adminModel->where('nama', 'admin')->first();
            $santri = $this->santriModel->findAll();
            $walisantri = $this->walisantri->where('id_user', user_id())->first();
            $data = [
                'title' => 'Tambah Wali Santri',
                'validation'    => $this->validation,
                'id_admin'      => $id_admin['id_admin'],
                'santri'        => $santri,
                'walisantri'    => $walisantri,
                'u_group'       => $u_group
            ];
        }
        return view('spp/tambah', $data);
    }

    public function store()
    {
        $this->validation->setRules([
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
        ]);
        
        if(!$this->validation->withRequest($this->request)->run()){
            session()->setFlashdata('error-header', 'Failed to adding data!');
            return redirect()->back()->withInput()->with('error', $this->validation->getErrors());
        };

        $santri = $this->santriModel->where('nis', $this->request->getVar('nis'))->first();

        // Get File
        $bukti_pembayaran = $this->request->getFile('bukti_pembayaran');

        if($bukti_pembayaran->getError() != 4){
            // random name
            $namefoto = $bukti_pembayaran->getRandomName();
    
            // move image to folder
            $bukti_pembayaran->move('img', $namefoto);
        }

        $this->tempsppModel->save([
            'id_admin'          => $this->request->getVar('id_admin'),
            'nis'               => $this->request->getVar('nis'),
            'nama_santri'       => $santri['nama_santri'],
            'tanggal'           => $this->request->getVar('tanggal'),
            'jumlah_iuran'      => $this->request->getVar('jumlah_iuran'),
            'foto'              => isset($namefoto) ? $namefoto : NULL,
            'keterangan'        => $this->request->getVar('keterangan')
        ]);

        session()->setFlashdata('success', 'Berhasil Tambah data!');

        return redirect()->to(url_to('spp'));
    }

    public function edit($id)
    {
        $u_group = $this->usergroup->where('user_id', user_id())->first();
        if($u_group['group_id'] == 1){
            $data = [
                'title' => 'Detail SPP Santri',
                'spp' => $this->sppModel->find($id),
                'santri'    => $this->santriModel->findAll(),
                'validation'    => $this->validation,
                'u_group'       => $u_group
            ];
        }else{
            $walisantri = $this->walisantri->where('id_user', user_id())->first();
            $data = [
                'title' => 'Detail SPP Santri',
                'spp' => $this->sppModel->find($id),
                'santri'    => $this->santriModel->findAll(),
                'walisantri'    => $walisantri,
                'validation'    => $this->validation,
                'u_group'       => $u_group
            ];
        }

        // When SPP Not Found
        if(empty($data['spp'])){
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Kelas dengan Id = '.$id.' Tidak Ditemukan!');
        }

        return view('spp/edit', $data);
    }

    public function update($id)
    {
        $this->validation->setRules([
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
        ]);
        
        if(!$this->validation->withRequest($this->request)->run()){
            session()->setFlashdata('error-header', 'Failed to adding data!');
            return redirect()->back()->withInput()->with('error', $this->validation->getErrors());
        };

        $santri = $this->santriModel->where('nis', $this->request->getVar('nis'))->first();

        // Get File
        $bukti_pembayaran = $this->request->getFile('bukti_pembayaran');

        if($bukti_pembayaran->getError() != 4){
            // random name
            $namefoto = $bukti_pembayaran->getRandomName();
    
            // move image to folder
            $bukti_pembayaran->move('img', $namefoto);
        }

        $this->sppModel->update($id, [
            'id_admin'          => $this->request->getVar('id_admin'),
            'nis'               => $this->request->getVar('nis'),
            'nama_santri'       => $santri['nama_santri'],
            'tanggal'           => $this->request->getVar('tanggal'),
            'jumlah_iuran'      => $this->request->getVar('jumlah_iuran'),
            'foto'              => isset($namefoto) ? $namefoto : NULL,
            'keterangan'        => $this->request->getVar('keterangan')
        ]);

        session()->setFlashdata('success', 'Berhasil Edit data!');

        return redirect()->to(url_to('spp'));
    }

    public function konfirmasi($id)
    {
        $spp = $this->tempsppModel->find($id);
        if($spp){
            $this->sppModel->save([
                'id_admin'          => $spp['id_admin'],
                'nis'               => $spp['nis'],
                'nama_santri'       => $spp['nama_santri'],
                'tanggal'           => $spp['tanggal'],
                'jumlah_iuran'      => $spp['jumlah_iuran'],
                'foto'              => $spp['foto'],
                'keterangan'        => $spp['keterangan']
            ]);

            $this->tempsppModel->delete($id);
            session()->setFlashdata('success-warning', 'Berhasil Konfirmasi Data!');
            return redirect()->to(url_to('spp'));
        }else{
            session()->setFlashdata('error', 'Gagal Konfirmasi Data! Mungkin data sudah terkonfirmasi! silahkan reflesh page!');
            return redirect()->to(url_to('spp'));
        }
    }

    public function delete($id)
    {
        $spp = $this->tempsppModel->find($id);
        if($spp){
            $this->tempsppModel->delete($id);
            session()->setFlashdata('success-delete', 'Berhasil Hapus data!');
            return redirect()->to(url_to('spp'));
        }else{
            session()->setFlashdata('error', 'Gagal Menghapus data! Mungkin data sudah terhapus! silahkan reflesh page!');
            return redirect()->to(url_to('spp'));
        }
    }
}
