<?php

namespace App\Models;

use CodeIgniter\Model;

class MTrafocubicle extends Model {
    protected $table = 'tb_trafocubicle';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'location',
        'date',
        'time',
        'worker',
        'oil_temperature',
        'trafo_cleanliness',
        'trafo_temperature',
        'trafo_oil_leak',
        'cubicle_cleanliness',
        'cubicle_temperature',
        'cubicle_noise',
        'cubicle_ozone',
        'date_created',
        'date_updated',
        'status_deleted'
    ];

    public function getTrafoCubicleByStore($idStore) {
        $query = $this->db->query("
            SELECT
                t.id AS id,
                t.location AS store_id, s.StoreName AS store_name,
                t.date AS date, SUBSTRING(t.date, 7, 4) AS date_year, SUBSTRING(t.date, 4, 2) AS date_month, t.time AS time,
                t.worker AS worker_id, u.name AS worker_name,
                t.oil_temperature AS oil_temperature,
                t.trafo_cleanliness AS trafo_cleanliness, t.trafo_temperature AS trafo_temperature, t.trafo_oil_leak AS trafo_oil_leak,
                t.cubicle_cleanliness AS cubicle_cleanliness, t.cubicle_temperature AS cubicle_temperature, t.cubicle_noise AS cubicle_noise, t.cubicle_ozone AS cubicle_ozone,
                t.date_created AS date_created, t.date_updated AS date_updated,
                t.status_deleted AS status_deleted
            FROM tb_trafocubicle AS t
            JOIN tb_user AS u ON t.worker = u.id
            JOIN tb_store AS s ON t.location = s.idStore
            WHERE t.location = $idStore AND t.status_deleted = 0
            ORDER BY date_year DESC, date_month DESC, date DESC, time DESC
        ");

        return $query->getResultArray();
    }

    public function getTrafoCubicleByStoreDate($idStore) {
        $currDate = date('d-m-Y');

        $query = $this->db->query("
            SELECT
                t.id AS id,
                t.location AS store_id, s.StoreName AS store_name,
                t.date AS date, SUBSTRING(t.date, 7, 4) AS date_year, SUBSTRING(t.date, 4, 2) AS date_month, t.time AS time,
                t.worker AS worker_id, u.name AS worker_name,
                t.oil_temperature AS oil_temperature,
                t.trafo_cleanliness AS trafo_cleanliness, t.trafo_temperature AS trafo_temperature, t.trafo_oil_leak AS trafo_oil_leak,
                t.cubicle_cleanliness AS cubicle_cleanliness, t.cubicle_temperature AS cubicle_temperature, t.cubicle_noise AS cubicle_noise, t.cubicle_ozone AS cubicle_ozone,
                t.date_created AS date_created, t.date_updated AS date_updated,
                t.status_deleted AS status_deleted
            FROM tb_trafocubicle AS t
            JOIN tb_user AS u ON t.worker = u.id
            JOIN tb_store AS s ON t.location = s.idStore
            WHERE t.location = $idStore AND t.date = '$currDate' AND t.status_deleted = 0
            ORDER BY date_year DESC, date_month DESC, date DESC, time DESC
        ");

        return $query->getResultArray();
    }
}
