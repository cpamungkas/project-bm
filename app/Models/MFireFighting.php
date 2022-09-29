<?php

namespace App\Models;

use CodeIgniter\Model;

class MFireFighting extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tb_fire_fighting';
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
        'type',
        'jumlah_zona',
        'mcfa_normal',
        'mcfa_alarm_silenced',
        'mcfa_fire',
        'mcfa_trouble',
        'lt1_smoke_detector',
        'lt1_heat_detector',
        'lt1_flow_switch',
        'lt2_smoke_detector',
        'lt2_heat_detector',
        'lt2_flow_switch',
        'lt3_smoke_detector',
        'lt3_heat_detector',
        'lt3_flow_switch',
        'lt4_smoke_detector',
        'lt4_heat_detector',
        'lt4_flow_switch',
        'hydrant_pillar',
        'siamese_connection',
        'lampu_dan_bell',
        'break_glass',
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

    public function getDataTableFireFighting($allData = false)
    {
        $builder = $this->db->table('tb_fire_fighting');

        $builder->select([
            'tb_fire_fighting.*',
            'tb_store.storeName',
            'tb_user.initial',
        ]);

        if ($allData == FALSE) {
            $builder->where('tb_fire_fighting.location', session()->get('idstore'));
        }

        $builder->join("tb_store", "tb_store.idStore = tb_fire_fighting.location", "LEFT");
        $builder->join("tb_user", "tb_user.id = tb_fire_fighting.worker", "LEFT");

        $builder->orderBy("created_at","DESC");

        return $builder->get()->getResultArray();
    }

    public function ajaxDataFireFighting($id)
    {
        $builder = $this->db->table('tb_fire_fighting');

        $builder->select([
            'tb_fire_fighting.*',
            'tb_store.storeName',
            'tb_user.initial',
        ]);

        $builder->where('tb_fire_fighting.id', $id);

        $builder->join("tb_store", "tb_store.idStore = tb_fire_fighting.location", "LEFT");
        $builder->join("tb_user", "tb_user.id = tb_fire_fighting.worker", "LEFT");

        return $builder->get()->getRow();
    }
}
