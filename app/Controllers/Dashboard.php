<?php

namespace App\Controllers;
use App\Models\UserGroupModel;
use App\Models\TempSPPModel;
use App\Models\SPPModel;
use App\Models\WaliSantriModel;

class Dashboard extends BaseController
{
    protected $usergroup, $spp, $db;
    public function __construct()
    {
        $this->usergroup = new UserGroupModel();
        $this->tempspp = new TempSPPModel();
        $this->spp = new SPPModel();
        $this->walisantri = new WaliSantriModel();
        $this->db = db_connect();
    }
    public function index()
    {   
        $u_group = $this->usergroup->where('user_id', user_id())->first();
        if($u_group['group_id'] == 2){
            $dt = date('Y-m');
            $walisantri = $this->walisantri->where('id_user', user_id())->first();
            $checkData = $this->db->query(
                "SELECT * FROM spp
                WHERE tanggal  LIKE '%".$dt."%'"
            )->getResultArray();
            $checkDataTemp = $this->db->query(
                "SELECT * FROM temp_spp
                WHERE tanggal  LIKE '%".$dt."%'"
            )->getResultArray();
            $data = [
                'title'     => 'Dashboard Page',
                'checkData' => $checkData,
                'checkDataTemp' => $checkDataTemp,
                'role' => $u_group['group_id']
            ];
            return view('dashboard/index', $data);
        }else{

            $data = [
                'title' => 'Dashboard Page',
                'role' => $u_group['group_id']
            ];
            return view('dashboard/index', $data);
        }
    }
}
