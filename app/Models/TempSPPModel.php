<?php

namespace App\Models;

use CodeIgniter\Model;

class TempSPPModel extends Model
{
    protected $table            = 'temp_spp';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'id_admin',
        'nis',
        'nama_santri',
        'tanggal',
        'jumlah_iuran',
        'foto',
        'keterangan',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'createdAt';
    protected $updatedField  = 'updatedAt';
}
