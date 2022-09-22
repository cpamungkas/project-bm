<?php

namespace App\Models;

use CodeIgniter\Model;

class MFoldingGate extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tb_folding_gate';
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
        'daun',
        'silangan',
        'rangka_cnp',
        'rangka_unp',
        'handle',
        'roda_bearing',
        'rel',
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

    public function getDataTableFoldingGate($allData = false)
    {
        $builder = $this->db->table('tb_folding_gate');

        $builder->select([
            'tb_folding_gate.*',
            'tb_store.storeName',
            'tb_user.initial',
        ]);

        if ($allData == FALSE) {
            $builder->where('tb_folding_gate.location', session()->get('idstore'));
        }

        $builder->join("tb_store", "tb_store.idStore = tb_folding_gate.location", "LEFT");
        $builder->join("tb_user", "tb_user.id = tb_folding_gate.worker", "LEFT");

        $builder->orderBy("created_at","DESC");

        return $builder->get()->getResultArray();
    }

    public function ajaxDataFoldingGate($id)
    {
        $builder = $this->db->table('tb_folding_gate');

        $builder->select([
            'tb_folding_gate.*',
            'tb_store.storeName',
            'tb_user.initial',
        ]);

        $builder->where('tb_folding_gate.id', $id);

        $builder->join("tb_store", "tb_store.idStore = tb_folding_gate.location", "LEFT");
        $builder->join("tb_user", "tb_user.id = tb_folding_gate.worker", "LEFT");

        return $builder->get()->getRow();
    }
}
