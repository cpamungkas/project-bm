<?php

namespace App\Models;

use CodeIgniter\Model;

class MDindingPartisi extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tb_dinding_partisi';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'location',
        'date',
        'worker',
        'equipment_checklist',
        'ruang',
        'lantai',
        'cat',
        'kaca',
        'kusen',
        'wallpaper',
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

    public function getDataTableDindingPartisi($allData = false)
    {
        $builder = $this->db->table('tb_dinding_partisi');

        $builder->select([
            'tb_dinding_partisi.*',
            'tb_store.storeName',
            'tb_user.initial',
        ]);

        if ($allData == FALSE) {
            $builder->where('tb_dinding_partisi.location', session()->get('idstore'));
        }

        $builder->join("tb_store", "tb_store.idStore = tb_dinding_partisi.location", "LEFT");
        $builder->join("tb_user", "tb_user.id = tb_dinding_partisi.worker", "LEFT");

        return $builder->get()->getResultArray();
    }

    public function ajaxDataDindingPartisi($id)
    {
        $builder = $this->db->table('tb_dinding_partisi');

        $builder->select([
            'tb_dinding_partisi.*',
            'tb_store.storeName',
            'tb_user.initial',
        ]);

        $builder->where('tb_dinding_partisi.id', $id);

        $builder->join("tb_store", "tb_store.idStore = tb_dinding_partisi.location", "LEFT");
        $builder->join("tb_user", "tb_user.id = tb_dinding_partisi.worker", "LEFT");

        return $builder->get()->getRow();
    }
}
