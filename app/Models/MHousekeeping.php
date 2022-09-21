<?php

namespace App\Models;

use CodeIgniter\Model;

class MHousekeeping extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tb_housekeeping';
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
        'ruang',
        'lantai',
        'kloset',
        'urinoir',
        'washtafel',
        'grease_trap',
        'diffuser',
        'kebersihan_lantai',
        'dinding',
        'cermin',
        'tempat_sampah',
        'floor_drainage',
        'kap_lampu',
        'hand_dryer',
        'exhaust_fan',
        'air_curtain',
        'plafond',
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

    public function getDataTableHousekeeping($allData = false)
    {
        $builder = $this->db->table('tb_housekeeping');

        $builder->select([
            'tb_housekeeping.*',
            'tb_store.storeName',
            'tb_user.initial',
        ]);

        if ($allData == FALSE) {
            $builder->where('tb_housekeeping.location', session()->get('idstore'));
        }

        $builder->join("tb_store", "tb_store.idStore = tb_housekeeping.location", "LEFT");
        $builder->join("tb_user", "tb_user.id = tb_housekeeping.worker", "LEFT");

        return $builder->get()->getResultArray();
    }

    public function ajaxDataHousekeeping($id)
    {
        $builder = $this->db->table('tb_housekeeping');

        $builder->select([
            'tb_housekeeping.*',
            'tb_store.storeName',
            'tb_user.initial',
        ]);

        $builder->where('tb_housekeeping.id', $id);

        $builder->join("tb_store", "tb_store.idStore = tb_housekeeping.location", "LEFT");
        $builder->join("tb_user", "tb_user.id = tb_housekeeping.worker", "LEFT");

        return $builder->get()->getRow();
    }
}
