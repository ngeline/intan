<?php

namespace App\Models;

use CodeIgniter\Model;

class UserGroupModel extends Model
{
    protected $table            = 'auth_groups_users';
    protected $primaryKey       = 'group_id';
    protected $useAutoIncrement = false;

    protected $allowedFields = [
        'group_id',
        'user_id'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
