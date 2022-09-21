<?php

namespace App\Models;

use CodeIgniter\Model;

class MAcahu extends Model {
    protected $table = 'tb_acahu';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'location',
        'date',
        'time',
        'worker',
        'ahu',
        'pres_in',
        'pres_out',
        'temp_in',
        'temp_out',
        'action',
        'date_created',
        'date_updated',
        'status_deleted'
    ];

    public function getAcAhuByStore($idStore) {
        $query = $this->db->query("
            SELECT
                a.id AS id,
                a.location AS store_id, s.StoreName AS store_name,
                a.date AS date, SUBSTRING(a.date, 7, 4) AS date_year, SUBSTRING(a.date, 4, 2) AS date_month, a.time AS time,
                a.worker AS worker_id, u.name AS worker_name,
                a.ahu AS ahu,
                a.pres_in AS pres_in, a.pres_out AS pres_out,
                a.temp_in AS temp_in, a.temp_out AS temp_out,
                a.action AS action,
                a.date_created AS date_created, a.date_updated AS date_updated
            FROM tb_acahu AS a
            JOIN tb_user AS u ON a.worker = u.id
            JOIN tb_store AS s ON a.location = s.idStore
            WHERE a.location = $idStore AND a.status_deleted = 0
            ORDER BY date_year DESC, date_month DESC, date DESC, time DESC, ahu ASC
        ");

        return $query->getResultArray();
    }

    public function getAcAhuByStoreDate($idStore) {
        $currDate = date('d-m-Y');

        $query = $this->db->query("
            SELECT
                a.id AS id,
                a.location AS store_id, s.StoreName AS store_name,
                a.date AS date, SUBSTRING(a.date, 7, 4) AS date_year, SUBSTRING(a.date, 4, 2) AS date_month, a.time AS time,
                a.worker AS worker_id, u.name AS worker_name,
                a.ahu AS ahu,
                a.pres_in AS pres_in, a.pres_out AS pres_out,
                a.temp_in AS temp_in, a.temp_out AS temp_out,
                a.action AS action,
                a.date_created AS date_created, a.date_updated AS date_updated
            FROM tb_acahu AS a
            JOIN tb_user AS u ON a.worker = u.id
            JOIN tb_store AS s ON a.location = s.idStore
            WHERE a.location = $idStore AND a.date = '$currDate' AND a.status_deleted = 0
            ORDER BY date_year DESC, date_month DESC, date DESC, time DESC, ahu ASC
        ");

        return $query->getResultArray();
    }
}
