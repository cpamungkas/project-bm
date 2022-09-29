<?php

namespace App\Models;

use CodeIgniter\Model;

class MMeterSumber extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tb_meter_sumber_dan_air_olahan';
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
        'meter_pdam_floating_valve',
        'meter_pdam_m3',
        'meter_deep_well_m3',
        'meter_air_effluent_m3',
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

    public function getDataTableMeterSumber($allData = false)
    {
        $builder = $this->db->table('tb_meter_sumber_dan_air_olahan');

        $builder->select([
            'tb_meter_sumber_dan_air_olahan.*',
            'tb_store.storeName',
            'tb_user.initial',
        ]);

        if ($allData == FALSE) {
            $builder->where('tb_meter_sumber_dan_air_olahan.location', session()->get('idstore'));
        }

        $builder->join("tb_store", "tb_store.idStore = tb_meter_sumber_dan_air_olahan.location", "LEFT");
        $builder->join("tb_user", "tb_user.id = tb_meter_sumber_dan_air_olahan.worker", "LEFT");

        $builder->orderBy("created_at","DESC");

        return $builder->get()->getResultArray();
    }

    public function ajaxDataMeterSumber($id)
    {
        $builder = $this->db->table('tb_meter_sumber_dan_air_olahan');

        $builder->select([
            'tb_meter_sumber_dan_air_olahan.*',
            'tb_store.storeName',
            'tb_user.initial',
        ]);

        $builder->where('tb_meter_sumber_dan_air_olahan.id', $id);

        $builder->join("tb_store", "tb_store.idStore = tb_meter_sumber_dan_air_olahan.location", "LEFT");
        $builder->join("tb_user", "tb_user.id = tb_meter_sumber_dan_air_olahan.worker", "LEFT");

        return $builder->get()->getRow();
    }
}
