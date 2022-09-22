<?php

namespace App\Models;

use CodeIgniter\Model;

class MSoundSystem extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tb_sound_system';
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
        'amplifier',
        'mixer',
        'radio_fm',
        'cd_mp3_player',
        'switch_zone',
        'mic_announcer',
        'speaker_jumlah',
        'speaker_keterangan',
        'car_call',
        'emergency_evac_system',
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

    public function getDataTableSoundSystem($allData = false)
    {
        $builder = $this->db->table('tb_sound_system');

        $builder->select([
            'tb_sound_system.*',
            'tb_store.storeName',
            'tb_user.initial',
        ]);

        if ($allData == FALSE) {
            $builder->where('tb_sound_system.location', session()->get('idstore'));
        }

        $builder->join("tb_store", "tb_store.idStore = tb_sound_system.location", "LEFT");
        $builder->join("tb_user", "tb_user.id = tb_sound_system.worker", "LEFT");

        $builder->orderBy("created_at","DESC");

        return $builder->get()->getResultArray();
    }

    public function ajaxDataSoundSystem($id)
    {
        $builder = $this->db->table('tb_sound_system');

        $builder->select([
            'tb_sound_system.*',
            'tb_store.storeName',
            'tb_user.initial',
        ]);

        $builder->where('tb_sound_system.id', $id);

        $builder->join("tb_store", "tb_store.idStore = tb_sound_system.location", "LEFT");
        $builder->join("tb_user", "tb_user.id = tb_sound_system.worker", "LEFT");

        return $builder->get()->getRow();
    }
}
