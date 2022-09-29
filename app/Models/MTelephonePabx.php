<?php

namespace App\Models;

use CodeIgniter\Model;

class MTelephonePabx extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tb_telephone_pabx';
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
        'line_co',
        'line_ext',
        'microphone',
        'kabel_handle',
        'speaker',
        'layar_display',
        'roset',
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

    public function getDataTableTelpPabx($allData = false)
    {
        $builder = $this->db->table('tb_telephone_pabx');

        $builder->select([
            'tb_telephone_pabx.*',
            'tb_store.storeName',
            'tb_user.initial',
        ]);

        if ($allData == FALSE) {
            $builder->where('tb_telephone_pabx.location', session()->get('idstore'));
        }

        $builder->join("tb_store", "tb_store.idStore = tb_telephone_pabx.location", "LEFT");
        $builder->join("tb_user", "tb_user.id = tb_telephone_pabx.worker", "LEFT");

        $builder->orderBy("created_at","DESC");

        return $builder->get()->getResultArray();
    }

    public function ajaxDataTelpPabx($id)
    {
        $builder = $this->db->table('tb_telephone_pabx');

        $builder->select([
            'tb_telephone_pabx.*',
            'tb_store.storeName',
            'tb_user.initial',
        ]);

        $builder->where('tb_telephone_pabx.id', $id);

        $builder->join("tb_store", "tb_store.idStore = tb_telephone_pabx.location", "LEFT");
        $builder->join("tb_user", "tb_user.id = tb_telephone_pabx.worker", "LEFT");

        return $builder->get()->getRow();
    }
}
