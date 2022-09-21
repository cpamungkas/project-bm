<?php

namespace App\Models;

use CodeIgniter\Model;

class MShiftschedule extends Model
{
    protected $table = 'tb_shiftschedule';
    protected $primaryKey = 'idShiftSchedule';
    protected $allowedFields = [
        'date',
        'store',
        'worker_id',
        'shift',
        'description',
        'date_created',
        'date_updated',
        'status_deleted'
    ];

    public function getWorkerFreeShift($date, $idStore) {
        $db = \Config\Database::connect();
        $builder = $db->table('tb_user');

        $builder->select([
            "tb_user.id"
        ]);
        $builder->where([
            "tb_shiftschedule.status_deleted !=" => 1,
            "tb_shiftschedule.date" => $date,
            "tb_user.location" => $idStore
        ]);
        $builder->join("tb_shiftschedule", "tb_shiftschedule.worker_id = tb_user.id", "LEFT");

        $notFree = $builder->get()->getResultArray();

        $builder->select([
            "tb_user.id",
            "tb_user.name"
        ]);
        if($notFree != NULL) {
            foreach($notFree as $key => $value) {
                $builder->where("id !=", $value['id']);
            }
        }
        $builder->where("tb_user.location", $idStore);

        return $builder->get()->getResultArray();
    }

    // public function getWorkerFreeShiftException($id, $date, $idStore) {
    //     $db = \Config\Database::connect();
    //     $builder = $db->table('tb_user');

    //     $builder->select([
    //         "tb_user.id"
    //     ]);
    //     $builder->where([
    //         "tb_shiftschedule.idShiftSchedule !=" => $id,
    //         "tb_shiftschedule.date" => $date,
    //         "tb_user.location" => $idStore
    //     ]);
    //     $builder->join("tb_shiftschedule", "tb_shiftschedule.worker_id = tb_user.id", "LEFT");

    //     $notFree = $builder->get()->getResultArray();

    //     $builder->select([
    //         "tb_user.id",
    //         "tb_user.name",
    //     ]);
    //     if($notFree != NULL) {
    //         foreach($notFree as $key => $value) {
    //             $builder->where("id !=", $value['id']);
    //         }
    //     }
    //     $builder->where("tb_user.location", $idStore);

    //     return $builder->get()->getResultArray();
    // }

    public function getShiftScheduleByStore($idStore) {
        $query = $this->db->query("SELECT s.idShiftSchedule AS id, s.date AS `date`, SUBSTRING(s.date, 7, 4) AS date_year, SUBSTRING(s.date, 4, 2) AS date_month, s.store AS `store_id`, t.StoreName AS `store_name`, s.worker_id AS `worker_id`, u.name AS `worker_name`, u.initial AS `worker_init`, s.shift AS `shift_id`, h.shift AS shift, h.description AS `shift_description`, s.description AS `description`
        FROM tb_shiftschedule AS s
        JOIN tb_user AS u ON s.`worker_id` = u.id
        JOIN tb_store AS t ON s.`store` = t.idStore
        JOIN tb_shift AS h ON s.`shift` = h.idShift
        WHERE s.`status_deleted` = 0 AND s.store = $idStore
        ORDER BY s.worker_id, date_year, date_month, s.date ASC");
        return $query->getResultArray();
    }

    public function getShiftScheduleByWorkerId($id) {
        $query = $this->db->query("SELECT s.idShiftSchedule AS id, s.date AS `date`, s.store AS `store_id`, t.StoreName AS `store_name`, s.worker_id AS `worker_id`, u.name AS `worker_name`, u.initial AS `worker_init`, s.shift AS `shift_id`, h.shift AS shift, h.description AS `shift_description`, s.description AS `description`
        FROM tb_shiftschedule AS s
        JOIN tb_user AS u ON s.`worker_id` = u.id
        JOIN tb_store AS t ON s.`store` = t.idStore
        JOIN tb_shift AS h ON s.`shift` = h.idShift
        WHERE s.`status_deleted` = 0 AND s.worker_id = $id");
        return $query->getResultArray();
    }

    public function getShiftScheduleByWorkerIdException($id, $worker_id) {
        $query = $this->db->query("SELECT s.idShiftSchedule AS id, s.date AS `date`, s.store AS `store_id`, t.StoreName AS `store_name`, s.worker_id AS `worker_id`, u.name AS `worker_name`, u.initial AS `worker_init`, s.shift AS `shift_id`, h.shift AS shift, h.description AS `shift_description`, s.description AS `description`
        FROM tb_shiftschedule AS s
        JOIN tb_user AS u ON s.`worker_id` = u.id
        JOIN tb_store AS t ON s.`store` = t.idStore
        JOIN tb_shift AS h ON s.`shift` = h.idShift
        WHERE s.`status_deleted` = 0 AND NOT s.idShiftSchedule = $id  AND s.worker_id = $worker_id");
        return $query->getResultArray();
    }

    public function updateShiftById($id) {
        $data = [
            'date' => $this->request->getPost('date'),
            'worker_id' => $this->request->getPost('worker_id'),
            'shift' => $this->request->getPost('shift'),
            'description' => $this->request->getPost('description'),
            'date_updated' => time(),
            'status_deleted' => 0
        ];
        $this->db->where('idShiftSchedule', $id);
        $this->db->update('tb_shiftschedule', $data);
        return redirect()->to('/troubleshift');
    }
}
