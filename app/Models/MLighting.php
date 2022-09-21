<?php

namespace App\Models;

use CodeIgniter\Model;

class MLighting extends Model {
    protected $table = 'tb_lighting';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'location',
        'date',
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

    public function getLightingByStore($idStore) {
        $query = $this->db->query("
            SELECT
                l.id AS id,
                l.location AS store_id, s.StoreName AS store_name,
                l.date AS date, SUBSTRING(l.date, 7, 4) AS date_year, SUBSTRING(l.date, 4, 2) AS date_month,
                l.worker AS worker_id, u.name AS worker_name,
                l.area AS area,
                l.zone_1 AS zone_1, l.zone_2 AS zone_2, l.zone_3 AS zone_3, l.zone_4 AS zone_4,
                l.discovery AS discovery, l.description AS description,
                l.date_created AS date_created, l.date_updated AS date_updated,
                l.status_deleted AS status_deleted
            FROM tb_lighting AS l
            JOIN tb_user AS u ON l.worker = u.id
            JOIN tb_store AS s ON l.location = s.idStore
            WHERE l.location = $idStore
            AND l.status_deleted = 0
            ORDER BY date_year DESC, date_month DESC, date DESC, area ASC
        ");

        return $query->getResultArray();
    }

    public function getLightingByStoreDate($idStore) {
        $currDate = date('Y-m-d');

        $query = $this->db->query("
            SELECT
                l.id AS id,
                l.location AS store_id, s.StoreName AS store_name,
                l.date AS date, SUBSTRING(l.date, 7, 4) AS date_year, SUBSTRING(l.date, 4, 2) AS date_month,
                l.worker AS worker_id, u.name AS worker_name,
                l.area AS area,
                l.zone_1 AS zone_1, l.zone_2 AS zone_2, l.zone_3 AS zone_3, l.zone_4 AS zone_4,
                l.discovery AS discovery, l.description AS description,
                l.date_created AS date_created, l.date_updated AS date_updated,
                l.status_deleted AS status_deleted
            FROM tb_lighting AS l
            JOIN tb_user AS u ON l.worker = u.id
            JOIN tb_store AS s ON l.location = s.idStore
            WHERE l.location = $idStore
            AND MONTH(STR_TO_DATE(l.date, '%d-%m-%Y')) = MONTH('$currDate')
            AND YEAR(STR_TO_DATE(l.date, '%d-%m-%Y')) = YEAR('$currDate')
            AND l.status_deleted = 0
            ORDER BY date_year DESC, date_month DESC, date DESC, area ASC
        ");

        return $query->getResultArray();
    }
}
