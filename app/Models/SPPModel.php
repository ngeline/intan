<?php

namespace App\Models;

use CodeIgniter\Model;

class SPPModel extends Model
{
    protected $table            = 'spp';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'id_admin',
        'nis',
        'nama_santri',
        'tanggal',
        'jumlah_iuran',
        'keterangan',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'createdAt';
    protected $updatedField  = 'updatedAt';
}
