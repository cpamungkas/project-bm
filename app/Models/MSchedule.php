<?php

namespace App\Models;

use CodeIgniter\Model;

class MSchedule extends Model
{
    protected $table = 'tb_schedule';
    protected $primaryKey = 'idSchedule';
    protected $allowedFields = [
        'start_date',
        'end_date',
        'init_store',
        'dest_store',
        'worker_id',
        'description',
        'date_created',
        'date_updated',
        'status_approved',
        'status_deleted'
    ];

    public function getScheduleByStoreOut($idStore) {
        $query = $this->db->query("SELECT s.idSchedule AS id, s.start_date AS `start_date`, SUBSTRING(s.start_date, 7, 4) AS start_year, SUBSTRING(s.start_date, 4, 2) AS start_month, s.end_date AS `end_date`, s.init_store AS `init_store_id`, i.StoreName AS `init_store_name`, s.dest_store AS `dest_store_id`, d.StoreName AS `dest_store_name`, s.worker_id AS `worker_id`, u.name AS `worker_name`, u.initial AS `worker_init`, s.description AS `description`, s.status_approved AS `status`
        FROM tb_schedule AS s
        JOIN tb_user AS u ON s.`worker_id` = u.id
        JOIN tb_store AS i ON s.`init_store` = i.idStore
        JOIN tb_store AS d ON s.`dest_store` = d.idStore
        WHERE s.`status_deleted` = 0 AND s.init_store = $idStore
        ORDER BY s.worker_id, start_year, start_month, s.start_date ASC");
        return $query->getResultArray();
    }

    public function getScheduleByStoreIn($idStore) {
        $query = $this->db->query("SELECT s.idSchedule AS id, s.start_date AS `start_date`, SUBSTRING(s.start_date, 7, 4) AS start_year, SUBSTRING(s.start_date, 4, 2) AS start_month, s.end_date AS `end_date`, s.init_store AS `init_store_id`, i.StoreName AS `init_store_name`, s.dest_store AS `dest_store_id`, d.StoreName AS `dest_store_name`, s.worker_id AS `worker_id`, u.name AS `worker_name`, u.initial AS `worker_init`, s.description AS `description`, s.status_approved AS `status`
        FROM tb_schedule AS s
        JOIN tb_user AS u ON s.`worker_id` = u.id
        JOIN tb_store AS i ON s.`init_store` = i.idStore
        JOIN tb_store AS d ON s.`dest_store` = d.idStore
        WHERE s.`status_deleted` = 0 AND s.dest_store = $idStore
        ORDER BY s.worker_id, start_year, start_month, s.start_date ASC");
        return $query->getResultArray();
    }

    public function getScheduleById($id) {
        $query = $this->db->query("SELECT s.idSchedule AS id, s.start_date AS `start_date`, s.end_date AS `end_date`, s.init_store AS `init_store_id`, i.StoreName AS `init_store_name`, s.dest_store AS `dest_store_id`, d.StoreName AS `dest_store_name`, s.worker_id AS `worker_id`, u.name AS `worker_name`, u.initial AS `worker_init`, s.description AS `description`, s.status_approved AS `status`
        FROM tb_schedule AS s
        JOIN tb_user AS u ON s.`worker_id` = u.id
        JOIN tb_store AS i ON s.`init_store` = i.idStore
        JOIN tb_store AS d ON s.`dest_store` = d.idStore
        WHERE s.`status_deleted` = 0 AND s.idSchedule = $id");
        return $query->getResultArray();
    }

    public function getScheduleByWorkerId($id) {
        $query = $this->db->query("SELECT s.idSchedule AS id, s.start_date AS `start_date`, s.end_date AS `end_date`, s.init_store AS `init_store_id`, i.StoreName AS `init_store_name`, s.dest_store AS `dest_store_id`, d.StoreName AS `dest_store_name`, s.worker_id AS `worker_id`, u.name AS `worker_name`, u.initial AS `worker_init`, s.description AS `description`, s.status_approved AS `status`
        FROM tb_schedule AS s
        JOIN tb_user AS u ON s.`worker_id` = u.id
        JOIN tb_store AS i ON s.`init_store` = i.idStore
        JOIN tb_store AS d ON s.`dest_store` = d.idStore
        WHERE s.`status_deleted` = 0 AND s.worker_id = $id");
        return $query->getResultArray();
    }

    public function getScheduleByWorkerIdException($id, $idWorker) {
        $query = $this->db->query("SELECT s.idSchedule AS id, s.start_date AS `start_date`, s.end_date AS `end_date`, s.init_store AS `init_store_id`, i.StoreName AS `init_store_name`, s.dest_store AS `dest_store_id`, d.StoreName AS `dest_store_name`, s.worker_id AS `worker_id`, u.name AS `worker_name`, u.initial AS `worker_init`, s.description AS `description`, s.status_approved AS `status`
        FROM tb_schedule AS s
        JOIN tb_user AS u ON s.`worker_id` = u.id
        JOIN tb_store AS i ON s.`init_store` = i.idStore
        JOIN tb_store AS d ON s.`dest_store` = d.idStore
        WHERE s.`status_deleted` = 0 AND NOT s.idSchedule = $id AND s.worker_id = $idWorker");
        return $query->getResultArray();
    }

    public function getDataWorkerByStore($idStore) {
        $query = "SELECT id, username, nik, name, email, initial, role_id, superior_role_id, location, level  FROM tb_user WHERE location = '$idStore' AND status_deleted = 0";
        return $this->db->query($query)->getResultArray();
    }

    public function getDataShift() {
        $query = "SELECT * FROM tb_shift";
        return $this->db->query($query)->getResultArray();
    }

    public function updateScheduleById($id) {
        $data = [
            'start_date' => $this->request->getPost('start_date'),
            'end_date' => $this->request->getPost('end_date'),
            'dest_store' => $this->request->getPost('dest_store'),
            'worker_id' => $this->request->getPost('worker_id'),
            'description' => $this->request->getPost('description'),
            'date_updated' => time(),
            'status_deleted' => 0
        ];
        $this->db->where('idSchedule', $id);
        $this->db->update('tb_schedule', $data);
        return redirect()->to('/troublejobout');
    }

    public function getWorkerFreeJob($start_date, $end_date, $idStore) {
        $db = \Config\Database::connect();
        $builder = $db->table('tb_user');

        $start_date_details = explode("-", $start_date);
        $start_date_fin = $start_date_details[2] . '-' . $start_date_details[1] . '-' . $start_date_details[0];

        $end_date_details = explode("-", $end_date);
        $end_date_fin = $end_date_details[2] . '-' . $end_date_details[1] . '-' . $end_date_details[0];

        $builder->select([
            "tb_user.id",
        ]);
        $builder->where("tb_schedule.status_deleted != 1");
        $builder->where("STR_TO_DATE(tb_schedule.start_date, '%d-%m-%Y') <=", $end_date_fin);
        $builder->where("STR_TO_DATE(tb_schedule.end_date, '%d-%m-%Y') >=", $start_date_fin);
        $builder->join("tb_schedule", "tb_schedule.worker_id = tb_user.id", "LEFT");

        $notFree = $builder->get()->getResultArray();

        $builder->select([
            "tb_user.id",
            "tb_user.name",
        ]);
        if($notFree != NULL) {
            foreach($notFree as $key => $value) {
                $builder->where("id !=", $value['id']);
            }
        }
        $builder->where("tb_user.location" , $idStore);

        return $builder->get()->getResultArray();
    }
}

