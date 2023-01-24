<?php

namespace App\Models;

use CodeIgniter\Model;

class SantriModel extends Model
{
    protected $table = 'santri';
    protected $primaryKey = 'nis';

    protected $useAutoIncrement = false;
    protected $allowedFields = [
        'nis',
        'id_kelas',
        'id_admin',
        'nama_santri',
        'jenis_kelamin',
        'status_santri'
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'createdAt';
    protected $updatedField  = 'updatedAt';
}