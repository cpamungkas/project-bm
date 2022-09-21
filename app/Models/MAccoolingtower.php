<?php

namespace App\Models;

use CodeIgniter\Model;

class MAccoolingtower extends Model {
    protected $table = 'tb_accoolingtower';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'location',
        'date',
        'time',
        'worker',
        'cooling_1',
        'cooling_2',
        'cooling_3',
        'cooling_4',
        'cooling_5',
        'cwp_1',
        'cwp_2',
        'cwp_3',
        'cwp_4',
        'cwp_5',
        'cwp_6',
        'moss',
        's26',
        's27',
        'pump',
        'make_up',
        'ph',
        'rs',
        'st',
        'tn',
        'ln',
        'r',
        's',
        't',
        'kw',
        'description',       
        'date_created',
        'date_updated',
        'status_deleted'
    ];

    public function getAcCoolingTowerByStore($idStore) {
        $query = $this->db->query("
            SELECT
                a.id AS id,
                a.location AS store_id, s.StoreName AS store_name,
                a.date AS date, SUBSTRING(a.date, 7, 4) AS date_year, SUBSTRING(a.date, 4, 2) AS date_month, a.time AS time,
                a.worker AS worker_id, u.name AS worker_name,
                a.cooling_1 AS cooling_1, a.cooling_2 AS cooling_2, a.cooling_3 AS cooling_3, a.cooling_4 AS cooling_4, a.cooling_5 AS cooling_5,
                a.cwp_1 AS cwp_1, a.cwp_2 AS cwp_2, a.cwp_3 AS cwp_3, a.cwp_4 AS cwp_4, a.cwp_5 AS cwp_5, a.cwp_6 AS cwp_6,
                a.moss AS moss,
                a.s26 AS s26, a.s27 AS s27, a.pump AS pump, a.make_up AS make_up, a.ph AS ph,
                a.rs AS rs, a.st AS st, a.tn AS tn, a.ln AS ln, a.r AS r, a.s AS s, a.t AS t, a.kw AS kw,
                a.description AS description,
                a.date_created AS date_created, a.date_updated AS date_updated
            FROM tb_accoolingtower AS a
            JOIN tb_user AS u ON a.worker = u.id
            JOIN tb_store AS s ON a.location = s.idStore
            WHERE a.location = $idStore AND a.status_deleted = 0
            ORDER BY date_year DESC, date_month DESC, date DESC, time DESC
        ");

        return $query->getResultArray();
    }

    public function getAcCoolingTowerByStoreDate($idStore) {
        $currDate = date('d-m-Y');

        $query = $this->db->query("
            SELECT
                a.id AS id,
                a.location AS store_id, s.StoreName AS store_name,
                a.date AS date, SUBSTRING(a.date, 7, 4) AS date_year, SUBSTRING(a.date, 4, 2) AS date_month, a.time AS time,
                a.worker AS worker_id, u.name AS worker_name,
                a.cooling_1 AS cooling_1, a.cooling_2 AS cooling_2, a.cooling_3 AS cooling_3, a.cooling_4 AS cooling_4, a.cooling_5 AS cooling_5,
                a.cwp_1 AS cwp_1, a.cwp_2 AS cwp_2, a.cwp_3 AS cwp_3, a.cwp_4 AS cwp_4, a.cwp_5 AS cwp_5, a.cwp_6 AS cwp_6,
                a.moss AS moss,
                a.s26 AS s26, a.s27 AS s27, a.pump AS pump, a.make_up AS make_up, a.ph AS ph,
                a.rs AS rs, a.st AS st, a.tn AS tn, a.ln AS ln, a.r AS r, a.s AS s, a.t AS t, a.kw AS kw,
                a.description AS description,
                a.date_created AS date_created, a.date_updated AS date_updated
            FROM tb_accoolingtower AS a
            JOIN tb_user AS u ON a.worker = u.id
            JOIN tb_store AS s ON a.location = s.idStore
            WHERE a.location = $idStore AND a.date = '$currDate' AND a.status_deleted = 0
            ORDER BY date_year DESC, date_month DESC, date DESC, time DESC
        ");

        return $query->getResultArray();
    }
}
