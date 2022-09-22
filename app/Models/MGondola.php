<?php

namespace App\Models;

use CodeIgniter\Model;

class MGondola extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tb_gondola';
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
        'paket_kontrol',
        'motor_gerak_rail',
        'motor_gerak_putar',
        'motor_gerak_arm',
        'motor_gerak_keranjang',
        'wire_rope',
        'safety_block',
        'gear_box',
        'noise',
        'vibrasi',
        'pelumasan',
        'seragam',
        'id_card',
        'helmet',
        'safety_glasses',
        'full_body_harnetz',
        'auto_stop',
        'carbiner',
        'sarung_tangan',
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

    public function getDataTableGondola($allData = false)
    {
        $builder = $this->db->table('tb_gondola');

        $builder->select([
            'tb_gondola.*',
            'tb_store.storeName',
            'tb_user.initial',
        ]);

        if ($allData == FALSE) {
            $builder->where('tb_gondola.location', session()->get('idstore'));
        }

        $builder->join("tb_store", "tb_store.idStore = tb_gondola.location", "LEFT");
        $builder->join("tb_user", "tb_user.id = tb_gondola.worker", "LEFT");

        return $builder->get()->getResultArray();
    }

    public function ajaxDataGondola($id)
    {
        $builder = $this->db->table('tb_gondola');

        $builder->select([
            'tb_gondola.*',
            'tb_store.storeName',
            'tb_user.initial',
        ]);

        $builder->where('tb_gondola.id', $id);

        $builder->join("tb_store", "tb_store.idStore = tb_gondola.location", "LEFT");
        $builder->join("tb_user", "tb_user.id = tb_gondola.worker", "LEFT");

        return $builder->get()->getRow();
    }
}
