<?php

namespace App\Models;

use CodeIgniter\Model;

class MCctv extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tb_cctv';
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
        'dvr',
        'hdd_internal',
        'usb_extender',
        'hdmi_vga_ext',
        'jumlah_rekaman',
        'camera_jumlah',
        'camera_keterangan',
        'adaptor_power_jumlah',
        'adaptor_power_keterangan',
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

    public function saveCctv($data)
    {
        $builder = $this->db->table('tb_cctv');
        $this->db->transStart();

        foreach ($data as $key => $value) {
            $builder->insert($value);
        }

        $this->db->transComplete();

        if ($this->db->transStatus() === false) {
            return false;
        }
        return true;
    }

    public function getDataTableCctv($allData = false)
    {
        $builder = $this->db->table('tb_cctv');

        $builder->select([
            'tb_cctv.*',
            'tb_store.storeName',
            'tb_user.initial',
        ]);

        if ($allData == FALSE) {
            $builder->where('tb_cctv.location', session()->get('idstore'));
        }

        $builder->join("tb_store", "tb_store.idStore = tb_cctv.location", "LEFT");
        $builder->join("tb_user", "tb_user.id = tb_cctv.worker", "LEFT");
        
        $builder->orderBy("created_at","DESC");

        return $builder->get()->getResultArray();
    }

    public function ajaxDataCctv($id)
    {
        $builder = $this->db->table('tb_cctv');

        $builder->select([
            'tb_cctv.*',
            'tb_store.storeName',
            'tb_user.initial',
        ]);

        $builder->where('tb_cctv.id', $id);

        $builder->join("tb_store", "tb_store.idStore = tb_cctv.location", "LEFT");
        $builder->join("tb_user", "tb_user.id = tb_cctv.worker", "LEFT");

        return $builder->get()->getRow();
    }
}
