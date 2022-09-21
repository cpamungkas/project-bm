<?php

namespace App\Models;

use CodeIgniter\Model;

class MElevator extends Model {
    protected $table = 'tb_elevator';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'location',
        'date',
        'time',
        'worker',
        'name',
        'ard',
        'motor',
        'rope',
        'vsd',
        'door',
        'censor',
        'interphone',
        'button',
        'noise',
        'temperature',
        'vibration',
        'description',
        'date_created',
        'date_updated',
        'status_deleted'
    ];

    public function getElevatorByStore($idStore) {
        $query = $this->db->query("
            SELECT
                e.id AS id,
                e.location AS store_id, s.StoreName AS store_name,
                e.date AS date, SUBSTRING(e.date, 7, 4) AS date_year, SUBSTRING(e.date, 4, 2) AS date_month, e.time AS time,
                e.worker AS worker_id, u.name AS worker_name,
                e.name AS name,
                e.ard AS ard, e.motor AS motor, e.rope AS rope, e.vsd AS vsd, e.door AS door, e.censor AS censor, e.interphone AS interphone, e.button AS button,
                e.noise AS noise, e.temperature AS temperature, e.vibration AS vibration,
                e.description AS description,
                e.date_created AS date_created, e.date_updated AS date_updated,
                e.status_deleted AS status_deleted
            FROM tb_elevator AS e
            JOIN tb_user AS u ON e.worker = u.id
            JOIN tb_store AS s ON e.location = s.idStore
            WHERE e.location = $idStore AND e.status_deleted = 0
            ORDER BY date_year DESC, date_month DESC, date DESC, time DESC
        ");

        return $query->getResultArray();
    }

    public function getElevatorByStoreDate($idStore) {
        $currDate = date('Y-m-d');

        $query = $this->db->query("
            SELECT
                e.id AS id,
                e.location AS store_id, s.StoreName AS store_name,
                e.date AS date, SUBSTRING(e.date, 7, 4) AS date_year, SUBSTRING(e.date, 4, 2) AS date_month, e.time AS time,
                e.worker AS worker_id, u.name AS worker_name,
                e.name AS name,
                e.ard AS ard, e.motor AS motor, e.rope AS rope, e.vsd AS vsd, e.door AS door, e.censor AS censor, e.interphone AS interphone, e.button AS button,
                e.noise AS noise, e.temperature AS temperature, e.vibration AS vibration,
                e.description AS description,
                e.date_created AS date_created, e.date_updated AS date_updated,
                e.status_deleted AS status_deleted
            FROM tb_elevator AS e
            JOIN tb_user AS u ON e.worker = u.id
            JOIN tb_store AS s ON e.location = s.idStore
            WHERE e.location = $idStore
            AND YEARWEEK(STR_TO_DATE(e.date, '%d-%m-%Y'), 7) = YEARWEEK('$currDate', 7)
            AND e.status_deleted = 0
            ORDER BY date_year DESC, date_month DESC, date DESC, time DESC
        ");

        return $query->getResultArray();
    }
}
