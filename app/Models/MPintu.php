<?php

namespace App\Models;

use CodeIgniter\Model;

class MPintu extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tb_pintu';
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
        'cat',
        'kunci',
        'kusen',
        'handle_pintu',
        'engsel',
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

    public function getDataTablePintu($allData = false)
    {
        $builder = $this->db->table('tb_pintu');

        $builder->select([
            'tb_pintu.*',
            'tb_store.storeName',
            'tb_user.initial',
        ]);

        if ($allData == FALSE) {
            $builder->where('tb_pintu.location', session()->get('idstore'));
        }

        $builder->join("tb_store", "tb_store.idStore = tb_pintu.location", "LEFT");
        $builder->join("tb_user", "tb_user.id = tb_pintu.worker", "LEFT");

        return $builder->get()->getResultArray();
    }

    public function ajaxDataPintu($id)
    {
        $builder = $this->db->table('tb_pintu');

        $builder->select([
            'tb_pintu.*',
            'tb_store.storeName',
            'tb_user.initial',
        ]);

        $builder->where('tb_pintu.id', $id);

        $builder->join("tb_store", "tb_store.idStore = tb_pintu.location", "LEFT");
        $builder->join("tb_user", "tb_user.id = tb_pintu.worker", "LEFT");

        return $builder->get()->getRow();
    }
}
