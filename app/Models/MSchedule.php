<?php

namespace App\Models;

use CodeIgniter\Model;

class MSchedule extends Model
{
    protected $table = 'tb_store';
    protected $primaryKey = 'idStore';
    protected $allowedFields = [
        'StoreName',
        'StoreCode',
        'KWHMeter1',
        'KWHMeter2',
        'idPLN1',
        'idPLN2',
        'date_created',
        'date_updated',
        'status_deleted'
    ];

    public function getDataWorkerByStore($idStore)
    {
        $query = "SELECT id, username, nik, name, email, initial, role_id, superior_role_id, location, level  FROM tb_user WHERE location = '$idStore' AND status_deleted = 0";
        return $this->db->query($query)->getResultArray();
    }

    public function getDataShift()
    {
        $query = "SELECT * FROM tb_shift";
        return $this->db->query($query)->getResultArray();
    }

    public function saveTechShift($data = null)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tb_job_shift');
        $builder->insert($data);

        return $db->affectedRows();
    }

    public function editTechShift($data = null, $id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tb_job_shift');
        $builder->where('id', $id);
        $builder->update($data);

        return $db->affectedRows();
    }

    public function deleteTechShift($id)
    {
        if ($id == null) {
            return false;
        }

        $db      = \Config\Database::connect();
        $builder = $db->table('tb_job_shift');
        $builder->delete(['id' => $id]);

        return $db->affectedRows();
    }

    public function saveTechJobOut($data = null)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tb_job_assignment');
        $builder->insert($data);

        return $db->affectedRows();
    }

    public function editTechJobOut($data = null, $id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tb_job_assignment');
        $builder->where('id', $id);
        $builder->update($data);

        return $db->affectedRows();
    }

    public function deleteTechJobOut($id)
    {
        if ($id == null) {
            return false;
        }

        $db      = \Config\Database::connect();
        $builder = $db->table('tb_job_assignment');
        $builder->delete(['id' => $id]);

        return $db->affectedRows();
    }

    public function getDataTechJob($id = null)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tb_job_assignment');
        if ($id !== null) {
            $builder->where("id", $id);
        }
        return $builder->get()->getResultArray();
    }

    /**
     * getDataTableTechJob
     *
     * @param  array $where
     * @return void
     */
    public function getDataTableTechJob($where = null, $isAdmin = TRUE)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tb_job_assignment');

        if (!$isAdmin) {
            $builder->where('tb_job_assignment.idUser', session()->get('id'));
        }

        if ($where !== null) {
            $builder->where($where);
        }
        $builder->select([
            "tb_job_assignment.*",
            "from.idStore as idStoreFrom",
            "from.StoreName as nameStoreFrom",
            "to.idStore as idStoreTo",
            "to.StoreName as nameStoreTo",
            "tb_user.name",
            "tb_user.initial",
        ]);
        $builder->join("tb_store from", "from.idStore = tb_job_assignment.from_store", "LEFT");
        $builder->join("tb_store to", "to.idStore = tb_job_assignment.to_store", "LEFT");
        $builder->join("tb_user", "tb_user.id = tb_job_assignment.idUser", "LEFT");

        return $builder->get()->getResultArray();
    }

    public function getDataTableTechShift($where = null, $isAdmin = TRUE)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tb_job_shift');

        if (!$isAdmin) {
            $builder->where('tb_job_shift.idStore', session()->get('idstore'));
        }

        if ($where !== null) {
            $builder->where($where);
        }
        $builder->select([
            "tb_job_shift.*",
            "tb_store.StoreName",
            "tb_user.name",
            "tb_user.initial",
            "tb_shift.shift",
            "tb_shift.description as shiftDescription",
        ]);
        $builder->join("tb_store", "tb_store.idStore = tb_job_shift.idStore", "LEFT");
        $builder->join("tb_user", "tb_user.id = tb_job_shift.idUser", "LEFT");
        $builder->join("tb_shift", "tb_shift.idShift = tb_job_shift.idShift", "LEFT");

        return $builder->get()->getResultArray();
    }

    public function checkFreeShiftSchedule($date, $idUser)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tb_job_shift');

        $builder->where([
            'date' => $date,
            'idUser' => $idUser,
        ]);

        return $builder->get()->getResultArray();
    }

    public function checkFreeTechJobSchedule($idUser, $start_date, $end_date)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tb_job_assignment');

        $builder->where([
            "start_date <=" => $end_date,
            "end_date >=" => $start_date,
            'idUser' => $idUser,
        ]);

        return $builder->get()->getResultArray();
    }

    public function getWorkerFreeShift($date, $idStore)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tb_user');

        $builder->select([
            "tb_user.id",
        ]);
        $builder->where([
            "tb_job_shift.date" => $date,
            "tb_user.location" => $idStore
        ]);
        $builder->join("tb_job_shift", "tb_job_shift.idUser = tb_user.id", "LEFT");

        //? mengambil data user yg memiliki shift pd hari itu
        $notFree = $builder->get()->getResultArray();

        $builder->select([
            "tb_user.id",
            "tb_user.name",
        ]);
        if ($notFree != NULL) {
            foreach ($notFree as $key => $value) {
                $builder->where("id !=", $value['id']);
            }
        }
        $builder->where("tb_user.location", $idStore);

        return $builder->get()->getResultArray();
    }

    public function checkWorkerTechJobAjax($start_date, $end_date, $idStore)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tb_user');

        $builder->select([
            "tb_user.id",
        ]);

        $builder->where([
            "start_date <=" => $end_date,
            "end_date >=" => $start_date,
        ]);

        $builder->join("tb_job_assignment", "tb_job_assignment.idUser = tb_user.id", "LEFT");

        $notFree = $builder->get()->getResultArray();

        $builder->select([
            "tb_user.id",
            "tb_user.name",
        ]);
        if ($notFree != NULL) {
            foreach ($notFree as $key => $value) {
                $builder->where("id !=", $value['id']);
            }
        }
        $builder->where("tb_user.location", $idStore);

        return $builder->get()->getResultArray();
    }
}
