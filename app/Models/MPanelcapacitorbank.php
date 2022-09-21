<?php

namespace App\Models;

use CodeIgniter\Model;

class MPanelcapacitorbank extends Model {
    protected $table = 'tb_panelcapacitorbank';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'location',
        'date',
        'time',
        'worker',
        'cos_phi',
        'kw',
        'kvar',
        'step',
        'in_r',
        'in_s',
        'in_t',
        'cleanliness',
        'temperature',
        'connection',
        'description',
        'date_created',
        'date_updated',
        'status_deleted'
    ];

    public function getPanelCapacitorBankByStore($idStore) {
        $query = $this->db->query("
            SELECT
                p.id AS id,
                p.location AS store_id, s.StoreName AS store_name,
                p.date AS date, SUBSTRING(p.date, 7, 4) AS date_year, SUBSTRING(p.date, 4, 2) AS date_month, p.time AS time,
                p.worker AS worker_id, u.name AS worker_name,
                p.cos_phi AS cos_phi, p.kw AS kw, p.kvar AS kvar, p.step AS step,
                p.in_r AS in_r, p.in_s AS in_s, p.in_t AS in_t,
                p.cleanliness AS cleanliness, p.temperature AS temperature, p.connection AS connection,
                p.description AS description,
                p.date_created AS date_created, p.date_updated AS date_updated,
                p.status_deleted AS status_deleted
            FROM tb_panelcapacitorbank AS p
            JOIN tb_user AS u ON p.worker = u.id
            JOIN tb_store AS s ON p.location = s.idStore
            WHERE p.location = $idStore AND p.status_deleted = 0
            ORDER BY date_year DESC, date_month DESC, date DESC, time DESC
        ");

        return $query->getResultArray();
    }

    public function getPanelCapacitorBankByStoreDate($idStore) {
        $currDate = date('d-m-Y');

        $query = $this->db->query("
            SELECT
                p.id AS id,
                p.location AS store_id, s.StoreName AS store_name,
                p.date AS date, SUBSTRING(p.date, 7, 4) AS date_year, SUBSTRING(p.date, 4, 2) AS date_month, p.time AS time,
                p.worker AS worker_id, u.name AS worker_name,
                p.cos_phi AS cos_phi, p.kw AS kw, p.kvar AS kvar, p.step AS step,
                p.in_r AS in_r, p.in_s AS in_s, p.in_t AS in_t,
                p.cleanliness AS cleanliness, p.temperature AS temperature, p.connection AS connection,
                p.description AS description,
                p.date_created AS date_created, p.date_updated AS date_updated,
                p.status_deleted AS status_deleted
            FROM tb_panelcapacitorbank AS p
            JOIN tb_user AS u ON p.worker = u.id
            JOIN tb_store AS s ON p.location = s.idStore
            WHERE p.location = $idStore AND p.date = '$currDate' AND p.status_deleted = 0
            ORDER BY date_year DESC, date_month DESC, date DESC, time DESC
        ");

        return $query->getResultArray();
    }
}
