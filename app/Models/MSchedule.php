<?php

namespace App\Models;

use CodeIgniter\Model;

class MSchedule extends Model
{
    protected $table = 'tb_store';
    protected $primaryKey = 'idStore';
    protected $allowedFields = [
        'StoreName',
        'StoreCode',
        'KWHMeter1',
        'KWHMeter2',
        'idPLN1',
        'idPLN2',
        'date_created',
        'date_updated',
        'status_deleted'
    ];

    public function getDataWorkerByStore($idStore)
    {
        $query = "SELECT id, username, nik, name, email, initial, role_id, superior_role_id, location, level  FROM tb_user WHERE location = '$idStore' AND status_deleted = 0";
        return $this->db->query($query)->getResultArray();
    }

public function getDataShift()
    {
        $query = "SELECT * FROM tb_shift";
        return $this->db->query($query)->getResultArray();
    }
}
