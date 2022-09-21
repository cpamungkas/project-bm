<?php

namespace App\Models;

use CodeIgniter\Model;

class MTemperature extends Model {
    protected $table = 'tb_temperature';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'location',
        'date',
        'time',
        'worker',
        'area',
        'zone_1',
        'zone_2',
        'zone_3',
        'zone_4',
        'discovery',
        'description',
        'date_created',
        'date_updated',
        'status_deleted'
    ];

    public function getTemperatureByStore($idStore) {
        $query = $this->db->query("
            SELECT
                t.id AS id,
                t.location AS store_id, s.StoreName AS store_name,
                t.date AS date, SUBSTRING(t.date, 7, 4) AS date_year, SUBSTRING(t.date, 4, 2) AS date_month, t.time AS time,
                t.worker AS worker_id, u.name AS worker_name,
                t.area AS area,
                t.zone_1 AS zone_1, t.zone_2 AS zone_2, t.zone_3 AS zone_3, t.zone_4 AS zone_4,
                t.discovery AS discovery, t.description AS description,
                t.date_created AS date_created, t.date_updated AS date_updated,
                t.status_deleted AS status_deleted
            FROM tb_temperature AS t
            JOIN tb_user AS u ON t.worker = u.id
            JOIN tb_store AS s ON t.location = s.idStore
            WHERE t.location = $idStore
            AND t.status_deleted = 0
            ORDER BY date_year DESC, date_month DESC, date DESC, area ASC
        ");

        return $query->getResultArray();
    }

    public function getTemperatureByStoreDate($idStore) {
        $currDate = date('d-m-Y');

        $query = $this->db->query("
            SELECT
                t.id AS id,
                t.location AS store_id, s.StoreName AS store_name,
                t.date AS date, SUBSTRING(t.date, 7, 4) AS date_year, SUBSTRING(t.date, 4, 2) AS date_month, t.time AS time,
                t.worker AS worker_id, u.name AS worker_name,
                t.area AS area,
                t.zone_1 AS zone_1, t.zone_2 AS zone_2, t.zone_3 AS zone_3, t.zone_4 AS zone_4,
                t.discovery AS discovery, t.description AS description,
                t.date_created AS date_created, t.date_updated AS date_updated,
                t.status_deleted AS status_deleted
            FROM tb_temperature AS t
            JOIN tb_user AS u ON t.worker = u.id
            JOIN tb_store AS s ON t.location = s.idStore
            WHERE t.location = $idStore
            AND t.date = '$currDate'
            AND t.status_deleted = 0
            ORDER BY date_year DESC, date_month DESC, date DESC, area ASC
        ");

        return $query->getResultArray();
    }
}
