<?php

namespace App\Models;

use CodeIgniter\Model;

class MPanellvmdp extends Model {
    protected $table = 'tb_panellvmdp';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'location',
        'date',
        'time',
        'worker',
        'vac_rs',
        'vac_st',
        'vac_tn',
        'vac_ng',
        'cleanliness',
        'temperature',
        'connection',
        'in_r',
        'in_s',
        'in_t',
        'description',
        'date_created',
        'date_updated',
        'status_deleted'
    ];

    public function getPanelLvmdpByStore($idStore) {
        $query = $this->db->query("
            SELECT
                p.id AS id,
                p.location AS store_id, s.StoreName AS store_name,
                p.date AS date, SUBSTRING(p.date, 7, 4) AS date_year, SUBSTRING(p.date, 4, 2) AS date_month, p.time AS time,
                p.worker AS worker_id, u.name AS worker_name,
                p.vac_rs AS vac_rs, p.vac_st AS vac_st, p.vac_tn AS vac_tn, p.vac_ng AS vac_ng,
                p.cleanliness AS cleanliness, p.temperature AS temperature, p.connection AS connection,
                p.in_r AS in_r, p.in_s AS in_s, p.in_t AS in_t,
                p.description AS description,
                p.date_created AS date_created, p.date_updated AS date_updated,
                p.status_deleted AS status_deleted
            FROM tb_panellvmdp AS p
            JOIN tb_user AS u ON p.worker = u.id
            JOIN tb_store AS s ON p.location = s.idStore
            WHERE p.location = $idStore AND p.status_deleted = 0
            ORDER BY date_year DESC, date_month DESC, date DESC, time DESC
        ");

        return $query->getResultArray();
    }

    public function getPanelLvmdpByStoreDate($idStore) {
        $currDate = date('d-m-Y');

        $query = $this->db->query("
            SELECT
                p.id AS id,
                p.location AS store_id, s.StoreName AS store_name,
                p.date AS date, SUBSTRING(p.date, 7, 4) AS date_year, SUBSTRING(p.date, 4, 2) AS date_month, p.time AS time,
                p.worker AS worker_id, u.name AS worker_name,
                p.vac_rs AS vac_rs, p.vac_st AS vac_st, p.vac_tn AS vac_tn, p.vac_ng AS vac_ng,
                p.cleanliness AS cleanliness, p.temperature AS temperature, p.connection AS connection,
                p.in_r AS in_r, p.in_s AS in_s, p.in_t AS in_t,
                p.description AS description,
                p.date_created AS date_created, p.date_updated AS date_updated,
                p.status_deleted AS status_deleted
            FROM tb_panellvmdp AS p
            JOIN tb_user AS u ON p.worker = u.id
            JOIN tb_store AS s ON p.location = s.idStore
            WHERE p.location = $idStore AND p.date = '$currDate' AND p.status_deleted = 0
            ORDER BY date_year DESC, date_month DESC, date DESC, time DESC
        ");

        return $query->getResultArray();
    }
}
