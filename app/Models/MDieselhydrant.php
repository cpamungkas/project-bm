<?php

namespace App\Models;

use CodeIgniter\Model;

class MDieselhydrant extends Model {
    protected $table = 'tb_dieselhydrant';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'location',
        'date',
        'time',
        'worker',
        'oil_pressure',
        'radiator',
        'start',
        'running',
        'battery_1',
        'battery_2',
        'solar',
        'pipe_pressure',
        'description',
        'date_created',
        'date_updated',
        'status_deleted'
    ];

    public function getDieselHydrantByStore($idStore) {
        $query = $this->db->query("
            SELECT
                d.id AS id,
                d.location AS store_id, s.StoreName AS store_name,
                d.date AS date, SUBSTRING(d.date, 7, 4) AS date_year, SUBSTRING(d.date, 4, 2) AS date_month, d.time AS time,
                d.worker AS worker_id, u.name AS worker_name,
                d.oil_pressure AS oil_pressure, d.radiator AS radiator,
                d.start AS start, d.running AS running,
                d.battery_1 AS battery_1, d.battery_2 AS battery_2,
                d.solar AS solar, d.pipe_pressure AS pipe_pressure,
                d.description AS description,
                d.date_created AS date_created, d.date_updated AS date_updated
            FROM tb_dieselhydrant AS d
            JOIN tb_user AS u ON d.worker = u.id
            JOIN tb_store AS s ON d.location = s.idStore
            WHERE d.location = $idStore AND d.status_deleted = 0
            ORDER BY date_year DESC, date_month DESC, date DESC, time DESC
        ");

        return $query->getResultArray();
    }

    public function getDieselHydrantByStoreDate($idStore) {
        $currDate = date('Y-m-d');

        $query = $this->db->query("
            SELECT
                d.id AS id,
                d.location AS store_id, s.StoreName AS store_name,
                d.date AS date, SUBSTRING(d.date, 7, 4) AS date_year, SUBSTRING(d.date, 4, 2) AS date_month, d.time AS time,
                d.worker AS worker_id, u.name AS worker_name,
                d.oil_pressure AS oil_pressure, d.radiator AS radiator,
                d.start AS start, d.running AS running,
                d.battery_1 AS battery_1, d.battery_2 AS battery_2,
                d.solar AS solar, d.pipe_pressure AS pipe_pressure,
                d.description AS description,
                d.date_created AS date_created, d.date_updated AS date_updated
            FROM tb_dieselhydrant AS d
            JOIN tb_user AS u ON d.worker = u.id
            JOIN tb_store AS s ON d.location = s.idStore
            WHERE d.location = $idStore
            AND YEARWEEK(STR_TO_DATE(d.date, '%d-%m-%Y'), 7) = YEARWEEK('$currDate', 7)
            AND d.status_deleted = 0
            ORDER BY date_year DESC, date_month DESC, date DESC, time DESC
        ");

        return $query->getResultArray();
    }
}
