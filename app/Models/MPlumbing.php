<?php

namespace App\Models;

use CodeIgniter\Model;

class MPlumbing extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tb_plumbing';
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
        'instalasi_air_bersih_p_transfer1',
        'instalasi_air_bersih_p_transfer2',
        'fire_pump_jockey_pump',
        'fire_pump_jockey_pressure',
        'fire_pump_hydrant_pump',
        'fire_pump_hydrant_pressure',
        'gwt_level_air',
        'gwt_elektrode',
        'roof_tank_level_air',
        'roof_tank_elektrode',
        'recycle_tank_level_air',
        'recycle_tank_elektrode',
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

    public function getDataTablePlumbing($allData = false)
    {
        $builder = $this->db->table('tb_plumbing');

        $builder->select([
            'tb_plumbing.*',
            'tb_store.storeName',
            'tb_user.initial',
        ]);

        if ($allData == FALSE) {
            $builder->where('tb_plumbing.location', session()->get('idstore'));
        }

        $builder->join("tb_store", "tb_store.idStore = tb_plumbing.location", "LEFT");
        $builder->join("tb_user", "tb_user.id = tb_plumbing.worker", "LEFT");

        return $builder->get()->getResultArray();
    }

    public function ajaxDataPlumbing($id)
    {
        $builder = $this->db->table('tb_plumbing');

        $builder->select([
            'tb_plumbing.*',
            'tb_store.storeName',
            'tb_user.initial',
        ]);

        $builder->where('tb_plumbing.id', $id);

        $builder->join("tb_store", "tb_store.idStore = tb_plumbing.location", "LEFT");
        $builder->join("tb_user", "tb_user.id = tb_plumbing.worker", "LEFT");

        return $builder->get()->getRow();
    }

    public function checkInspection($checklist, $date = null)
    {
        if ($date == null) {
            $date = date('Y-m-d');
        }

        $builder = $this->db->table('tb_plumbing');

        $builder->select('*');

        $builder->where('location', session()->get('idstore'));
        $builder->where('equipment_checklist', $checklist);

        switch ($checklist) {
            case 'DAILY':
                $builder->where('date', dateSQL($date));
                $result = $builder->countAllResults(false);
                $data = $builder->get()->getResultArray();
                if ($result > 0) {
                    return $output = [
                        'status' => true,
                        'data' => $data
                    ];
                }
                return ['status' => false, 'l' => $this->db->getLastQuery()];
                break;

            case 'WEEKLY':
                // TODO optimalisasi dg tanggal ambil -7 day to +7 day
                $builder->where("DATE_FORMAT(date, '%Y-%m')", convertDate($date, 'Y-m'));
                $arrTanggal = $builder->get()->getResultArray();

                $dateWeek = convertDate($date, 'W');
                $arrWeekNum = [];
                $i = 0;
                foreach ($arrTanggal as $key => $value) {
                    if ($dateWeek == convertDate($value['date'], 'W')) {
                        $arrWeekNum[$i] = [ $value
                            // 'id' => $value['id'],
                            // 'weekNum' => convertDate($value['date'], 'W')
                        ];
                        $i++;
                    }
                }

                $result = count($arrWeekNum);
                
                if ($result > 0) {
                    return $output = [
                        'status' => true,
                        'data' => $arrWeekNum,
                    ];
                }
                return ['status' => false];
                break;

            case 'MONTHLY':
                $builder->where("DATE_FORMAT(date, '%Y-%m')", convertDate($date, 'Y-m'));
                $result = $builder->countAllResults();
                if ($result > 0) {
                    ['status' => true];
                }
                return ['status' => false];
                break;
            
            default:
                return ['status' => false];
                break;
        }
    }
}
