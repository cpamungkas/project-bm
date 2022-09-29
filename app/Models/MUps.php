<?php

namespace App\Models;

use CodeIgniter\Model;

class MUps extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tb_ups';
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
        'merk',
        'type',
        'serial_number',
        'lokasi_ruang',
        'lokasi_lantai',
        'peruntukan',
        'tegangan_input',
        'tegangan_output',
        'tegangan_n_g',
        'load_percent',
        'load_amp',
        'inspeksi_kebersihan',
        'inspeksi_fan',
        'inspeksi_suhu',
        'inspeksi_alarm',
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

    public function getDataTableUps($allData = FALSE)
    {
        $builder = $this->db->table('tb_ups');

        $builder->select([
            'tb_ups.*',
            'tb_store.storeName',
            'tb_user.initial',
        ]);

        if ($allData == FALSE) {
            $builder->where('tb_ups.location', session()->get('idstore'));
        }

        $builder->join("tb_store", "tb_store.idStore = tb_ups.location", "LEFT");
        $builder->join("tb_user", "tb_user.id = tb_ups.worker", "LEFT");

        $builder->orderBy("created_at","DESC");

        return $builder->get()->getResultArray();
    }

    public function ajaxDataUps($id)
    {
        $builder = $this->db->table('tb_ups');

        $builder->select([
            'tb_ups.*',
            'tb_store.storeName',
            'tb_user.initial',
        ]);

        $builder->where('tb_ups.id', $id);

        $builder->join("tb_store", "tb_store.idStore = tb_ups.location", "LEFT");
        $builder->join("tb_user", "tb_user.id = tb_ups.worker", "LEFT");

        return $builder->get()->getRow();
    }

    public function checkInspection($date = null)
    {
        if ($date == null) {
            $date = ["MONTHLY" => date('Y-m-d')];
        }

        $builder = $this->db->table('tb_ups');

        $builder->select('id');

        $key = array_key_first($date);
        switch ($key) {
            case 'DIALY':
                $builder->where('date', dateSQL($date[$key]));
                $result = $builder->countAllResults();
                if ($result > 0) {
                    return true;
                }
                return false;
                break;

            case 'WEEKLY':
                $builder->select('date');
                $builder->where("DATE_FORMAT(date, '%Y-%m')", convertDate($date[$key], 'Y-m'));
                $arrTanggal = $builder->get()->getResultArray();

                $dateWeek = convertDate($date[$key], 'W');
                $arrWeekNum = [];
                $i = 0;
                foreach ($arrTanggal as $key => $value) {
                    if ($dateWeek == convertDate($value['date'], 'W')) {
                        $arrWeekNum[$i] = [
                            'id' => $value['id'],
                            'weekNum' => convertDate($value['date'], 'W')
                        ];
                        $i++;
                    }
                }

                $result = count($arrWeekNum);
                
                if ($result > 0) {
                    return true;
                }
                return false;
                break;

            case 'MONTHLY':
                $builder->where("DATE_FORMAT(date, '%Y-%m')", convertDate($date[$key], 'Y-m'));
                $result = $builder->countAllResults();
                if ($result > 0) {
                    return true;
                }
                return false;
                break;
            
            default:
                return false;
                break;
        }
    }
}
