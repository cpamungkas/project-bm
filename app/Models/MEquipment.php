<?php

namespace App\Models;

use CodeIgniter\Model;

class MEquipment extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tb_store_equipment';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['storeCode', 'idStore', 'travoAndCubicle', 'kwhMeter1', 'kwhMeter2', 'PanelLVMDP', 'PanelCapBank', 'Genset', 'DieselHydrant', 'acChiller', 'acCoolingTower', 'acAHU', 'acSplitWall', 'Suhu', 'Lighting', 'Escalator', 'Elevator', 'Dumbwaiter', 'Sanitary', 'UPS', 'GasStation', 'STP', 'CCTV', 'Plumbing', 'MeterSumber', 'DindingPartisi', 'Pintu', 'FoldingGate', 'RollingDoor', 'FireFighting', 'TelephonedanPABX', 'Housekeeping', 'Gondola', 'SoundSystem', 'status_deleted'];

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

    /**
     * getStoreDropdown
     *
     * @param  bool $distinct => untuk mendapat semua store / hanya store yg tdk ada di tb_store_equipment
     * @return void
     */
    public function getStoreDropdown($distinct = TRUE)
    {
        if ($distinct === TRUE) {
            $builder = $this->db->table('tb_store_equipment');
            $builder->distinct(true);
            $builder->select('idStore');
            $builder->where('tb_store_equipment.status_deleted', '0');

            $store = $builder->get()->getResultArray();
        }
        $builder = $this->db->table('tb_store');

        $builder->select([
            'tb_store.idStore',
            'tb_store.StoreName',
            'tb_store.StoreCode',
        ]);

        $builder->where('status_deleted', '0');
        if ($distinct === TRUE) {
            foreach ($store as $key => $value) {
                $builder->where('idStore !=', $value['idStore']);
            }
        }
        return $builder->get()->getResultArray();
    }

    public function getDataTableStoreEquip()
    {
        $equip = $this->getEquipment();

        $builder = $this->db->table('tb_store_equipment');
        $builder->distinct(true);
        $builder->select('idStore');
        $builder->where('tb_store_equipment.status_deleted', '0');

        $store = $builder->get()->getResultArray();

        $builder = $this->db->table('tb_store_equipment');

        $builder->select([
            'tb_store_equipment.*',
            'tb_store.storeName',
            'tb_store.storeCode',
            'tb_equipment.equipment',
        ]);

        $builder->where('tb_store_equipment.status_deleted', '0');

        $builder->join("tb_store", "tb_store.idStore = tb_store_equipment.idStore", "LEFT");
        $builder->join("tb_equipment", "tb_equipment.id = tb_store_equipment.idEquipment", "LEFT");

        $builder->orderBy('tb_store_equipment.idStore');
        $all = $builder->get()->getResultArray();

        $dataTable = [];
        $i = 0;
        foreach ($store as $key => $value) {
            foreach ($all as $x => $y) {
                if ($y['idStore'] == $value['idStore']) {
                    $dataTable += [
                        $i => [
                            'idStore' => $y['idStore'],
                            'storeName' => $y['storeName'],
                            'storeCode' => $y['storeCode'],
                        ]
                    ];
                    if (count($dataTable[$i]) == 3) {
                        foreach ($equip as $p => $q) {
                            $dataTable[$i] += [
                                $q['equipment'] => ($y['idEquipment'] == $q['id']) ? $y['idEquipment'] : '-'
                            ];
                        }
                    } else {
                        $dataTable[$i][$y['equipment']] = $y['idEquipment'];
                    }
                }
            }
            $i++;
        }
        return $dataTable;
    }

    public function ajaxDataStoreEquipment($idStore)
    {
        $builder = $this->db->table('tb_store_equipment');

        $builder->select([
            'tb_store_equipment.*',
            'tb_store.storeName',
            'tb_store.storeCode',
            'tb_equipment.equipment',
            'tb_equipment.equipment_name',
        ]);

        $builder->where('tb_store_equipment.idStore', $idStore);
        $builder->where('tb_store_equipment.status_deleted', '0');

        $builder->join("tb_store", "tb_store.idStore = tb_store_equipment.idStore", "LEFT");
        $builder->join("tb_equipment", "tb_equipment.id = tb_store_equipment.idEquipment", "LEFT");

        return $builder->get()->getResultArray();
    }

    public function deleteStoreEquipment($idStore)
    {
        $builder = $this->db->table('tb_store_equipment');
        $this->db->transStart();

        $builder->where('idStore', $idStore);

        $builder->update([
            'status_deleted' => '1'
        ]);

        $this->db->transComplete();

        if ($this->db->transStatus() === false) {
            return false;
        }
        return true;
    }

    public function getEquipment()
    {
        $builder = $this->db->table('tb_equipment');

        $builder->where('status_deleted', '0');

        return $builder->get()->getResultArray();
    }

    public function inputStoreEquipSetup($data)
    {
        $builder = $this->db->table('tb_store_equipment');
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

    public function editStoreEquipSetup($data, $idStore)
    {
        $builder = $this->db->table('tb_store_equipment');
        $this->db->transStart();

        $builder->delete([
            'idStore' => $idStore,
            'status_deleted' => '0'
        ]);

        foreach ($data as $key => $value) {
            $builder->insert($value);
        }

        $this->db->transComplete();

        if ($this->db->transStatus() === false) {
            return false;
        }
        return true;
    }

    public function getStoreEquipmentByStore($idStore) {
        $query = $this->db->query("
            SELECT
            s.id AS id, s.idStore AS idStore, s.status_deleted AS status_deleted, s.idEquipment AS idEquipment,
            e.url AS url
            FROM tb_store_equipment as s
            JOIN tb_equipment AS e ON s.idEquipment = e.id
            WHERE s.idStore = $idStore
            AND s.status_deleted = '0'
            ORDER BY s.idEquipment ASC
        ");

        return $query->getResultArray();
    }

    public function getStoreEquipmentByStoreEquipment($idStore, $idEquipment) {
        $query = $this->db->query("
            SELECT *
            FROM tb_store_equipment
            WHERE idStore = $idStore
            AND idEquipment = $idEquipment
            AND status_deleted = '0'
        ");

        return $query->getResultArray();
    }
}
