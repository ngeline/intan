<?php

namespace App\Models;

use CodeIgniter\Model;

class WaliSantriModel extends Model
{
    protected $table = 'walisantri';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'id_user',
        'nis',
        'id_admin',
        'nama_walisantri',
        'jenis_kelamin',
        'tempat',
        'tanggal_lahir',
        'usia_santri',
        'alamat',
        'nama_ayah',
        'nama_ibu',
        'nama_wali',
        'no_telepon',
        'pekerjaan_ayah',
        'pekerjaan_ibu',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'createdAt';
    protected $updatedField  = 'updatedAt';
}