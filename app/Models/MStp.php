<?php

namespace App\Models;

use CodeIgniter\Model;

class MStp extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tb_stp';
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
        'blower1',
        'blower2',
        'transfer_pump1',
        'transfer_pump2',
        'effluent_pump1',
        'effluent_pump2',
        'equalizing_pump1',
        'equalizing_pump2',
        'filter_pump1',
        'filter_pump2',
        'dozing_pump',
        'fresh_air_fan',
        'exhaust_fan',
        'inspeksi_cleaning_grease_trap',
        'inspeksi_chlorine',
        'inspeksi_flow_meter',
        'inspeksi_ph_water',
        'keterangan',
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

    public function getDataTableStp($allData = FALSE)
    {
        $builder = $this->db->table('tb_stp');

        $builder->select([
            'tb_stp.*',
            'tb_store.storeName',
            'tb_user.initial',
        ]);

        if ($allData == FALSE) {
            $builder->where('tb_stp.location', session()->get('idstore'));
        }

        $builder->join("tb_store", "tb_store.idStore = tb_stp.location", "LEFT");
        $builder->join("tb_user", "tb_user.id = tb_stp.worker", "LEFT");

        return $builder->get()->getResultArray();
    }

    public function ajaxDataStp($id)
    {
        $builder = $this->db->table('tb_stp');

        $builder->select([
            'tb_stp.*',
            'tb_store.storeName',
            'tb_user.initial',
        ]);

        $builder->where('tb_stp.id', $id);

        $builder->join("tb_store", "tb_store.idStore = tb_stp.location", "LEFT");
        $builder->join("tb_user", "tb_user.id = tb_stp.worker", "LEFT");

        return $builder->get()->getRow();
    }
}
