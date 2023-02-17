<?php

namespace App\Controllers;

use App\Models\UserModelCustom;
use App\Models\UserGroupModel;

class User extends BaseController
{
    protected $user, $userGroup, $db;

    public function __construct()
    {
        $this->user = new UserModelCustom();
        $this->userGroup = new UserGroupModel();
        $this->db = db_connect();
    }

    public function index()
    {
        $user = $this->db->query(
            'SELECT u.id as u_id, u.email, u.username, u.active, ag.name as role
            FROM users u, auth_groups ag, auth_groups_users agu
            WHERE u.id = agu.user_id AND ag.id = agu.group_id'
        )->getResultArray();

        $data = [
            'title' => 'Kelola User',
            'user'  => $user
        ];
        return view('user/index', $data);
    }

    public function aktivasi($id)
    {
        $user = $this->user->find($id);
        if($user && $user['active'] == 0){
            $this->db->query(
                'UPDATE users SET active = 1 WHERE id = '.$id.' '
            );
            session()->setFlashdata('success', 'Berhasil Aktivasi User!');
            return redirect()->back();
        }else{
            session()->setFlashdata('error', 'Gagal Aktivasi User! Mungkin user sudah teraktivasi! silahkan reflesh page!');
            return redirect()->back();
        }
    }

    public function blokir($id)
    {
        $user = $this->user->find($id);
        if($user && $user['active'] == 1){
            $this->db->query(
                'UPDATE users SET active = 0 WHERE id = '.$id.' '
            );
            session()->setFlashdata('success', 'Berhasil Blokir User!');
            return redirect()->back();
        }else{
            session()->setFlashdata('error', 'Gagal Blokir User! Mungkin user sudah terblokir! silahkan reflesh page!');
            return redirect()->back();
        }
    }
}
