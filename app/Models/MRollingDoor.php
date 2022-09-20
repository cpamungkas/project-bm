<?php

namespace App\Models;

use CodeIgniter\Model;

class MRollingDoor extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tb_rolling_door';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'location',
        'time',
        'date',
        'worker',
        'equipment_checklist',
        'name',
        'kunci_set',
        'daun_slot',
        'pulley',
        'pegas',
        'as_batang',
        'side_bracket',
        'bottom_t_rail',
        'pilar_rel',
        'jumlah_temuan',
        'penjelasan',
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getDataTableRollingDoor($allData = false)
    {
        $builder = $this->db->table('tb_rolling_door');

        $builder->select([
            'tb_rolling_door.*',
            'tb_store.storeName',
            'tb_user.initial',
        ]);

        if ($allData == FALSE) {
            $builder->where('tb_rolling_door.location', session()->get('idstore'));
        }

        $builder->join("tb_store", "tb_store.idStore = tb_rolling_door.location", "LEFT");
        $builder->join("tb_user", "tb_user.id = tb_rolling_door.worker", "LEFT");

        return $builder->get()->getResultArray();
    }

    public function ajaxDataRollingDoor($id)
    {
        $builder = $this->db->table('tb_rolling_door');

        $builder->select([
            'tb_rolling_door.*',
            'tb_store.storeName',
            'tb_user.initial',
        ]);

        $builder->where('tb_rolling_door.id', $id);

        $builder->join("tb_store", "tb_store.idStore = tb_rolling_door.location", "LEFT");
        $builder->join("tb_user", "tb_user.id = tb_rolling_door.worker", "LEFT");

        return $builder->get()->getRow();
    }
}
