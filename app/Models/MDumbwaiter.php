<?php

namespace App\Models;

use CodeIgniter\Model;

class MDumbwaiter extends Model {
    protected $table = 'tb_dumbwaiter';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'location',
        'date',
        'time',
        'worker',
        'stop',
        'motor',
        'vsd',
        'door',
        'switch',
        'brake',
        'button',
        'intercom',
        'noise',
        'temperature',
        'vibration',
        'description',
        'date_created',
        'date_updated',
        'status_deleted'
    ];

    public function getDumbwaiterByStore($idStore) {
        $query = $this->db->query("
            SELECT
                d.id AS id,
                d.location AS store_id, s.StoreName AS store_name,
                d.date AS date, SUBSTRING(d.date, 7, 4) AS date_year, SUBSTRING(d.date, 4, 2) AS date_month, d.time AS time,
                d.worker AS worker_id, u.name AS worker_name,
                d.stop AS stop, d.motor AS motor, d.vsd AS vsd, d.door AS door, d.switch AS switch, d.brake AS brake, d.button AS button, d.intercom AS intercom,
                d.noise AS noise, d.temperature AS temperature, d.vibration AS vibration,
                d.description AS description,
                d.date_created AS date_created, d.date_updated AS date_updated,
                d.status_deleted AS status_deleted
            FROM tb_dumbwaiter AS d
            JOIN tb_user AS u ON d.worker = u.id
            JOIN tb_store AS s ON d.location = s.idStore
            WHERE d.location = $idStore AND d.status_deleted = 0
            ORDER BY date_year DESC, date_month DESC, date DESC, time DESC
        ");

        return $query->getResultArray();
    }

    public function getDumbwaiterByStoreDate($idStore) {
        $currDate = date('Y-m-d');

        $query = $this->db->query("
            SELECT
                d.id AS id,
                d.location AS store_id, s.StoreName AS store_name,
                d.date AS date, SUBSTRING(d.date, 7, 4) AS date_year, SUBSTRING(d.date, 4, 2) AS date_month, d.time AS time,
                d.worker AS worker_id, u.name AS worker_name,
                d.stop AS stop, d.motor AS motor, d.vsd AS vsd, d.door AS door, d.switch AS switch, d.brake AS brake, d.button AS button, d.intercom AS intercom,
                d.noise AS noise, d.temperature AS temperature, d.vibration AS vibration,
                d.description AS description,
                d.date_created AS date_created, d.date_updated AS date_updated,
                d.status_deleted AS status_deleted
            FROM tb_dumbwaiter AS d
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
