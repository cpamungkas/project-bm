<?php

namespace App\Models;

use CodeIgniter\Model;

class MSanitary extends Model {
    protected $table = 'tb_sanitary';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'location',
        'date',
        'time',
        'worker',
        'floor',
        'room',
        'closet_instalation',
        'closet_washer',
        'closet_float',
        'closet_faucet',
        'urinoir_faucet',
        'urinoir_instalation',
        'washtafel_faucet',
        'washtafel_instalation',
        'filtration',
        'discovery',
        'description',
        'date_created',
        'date_updated',
        'status_deleted'
    ];

    public function getSanitaryByStore($idStore) {
        $query = $this->db->query("
            SELECT
                t.id AS id,
                t.location AS store_id, s.StoreName AS store_name,
                t.date AS date, SUBSTRING(t.date, 7, 4) AS date_year, SUBSTRING(t.date, 4, 2) AS date_month, t.time AS time,
                t.worker AS worker_id, u.name AS worker_name,
                t.floor AS floor, t.room AS room,
                t.closet_instalation AS closet_instalation, t.closet_washer AS closet_washer, t.closet_float AS closet_float, t.closet_faucet AS closet_faucet,
                t.urinoir_faucet AS urinoir_faucet, t.urinoir_instalation AS urinoir_instalation,
                t.washtafel_faucet AS washtafel_faucet, t.washtafel_instalation AS washtafel_instalation,
                t.filtration AS filtration,
                t.discovery,
                t.description AS description,
                t.date_created AS date_created, t.date_updated AS date_updated,
                t.status_deleted AS status_deleted
            FROM tb_sanitary AS t
            JOIN tb_user AS u ON t.worker = u.id
            JOIN tb_store AS s ON t.location = s.idStore
            WHERE t.location = $idStore AND t.status_deleted = 0
            ORDER BY date_year DESC, date_month DESC, date DESC, time DESC
        ");

        return $query->getResultArray();
    }

    public function getSanitaryByStoreDate($idStore) {
        $currDate = date('Y-m-d');

        $query = $this->db->query("
            SELECT
                t.id AS id,
                t.location AS store_id, s.StoreName AS store_name,
                t.date AS date, SUBSTRING(t.date, 7, 4) AS date_year, SUBSTRING(t.date, 4, 2) AS date_month, t.time AS time,
                t.worker AS worker_id, u.name AS worker_name,
                t.floor AS floor, t.room AS room,
                t.closet_instalation AS closet_instalation, t.closet_washer AS closet_washer, t.closet_float AS closet_float, t.closet_faucet AS closet_faucet,
                t.urinoir_faucet AS urinoir_faucet, t.urinoir_instalation AS urinoir_instalation,
                t.washtafel_faucet AS washtafel_faucet, t.washtafel_instalation AS washtafel_instalation,
                t.filtration AS filtration,
                t.discovery,
                t.description AS description,
                t.date_created AS date_created, t.date_updated AS date_updated,
                t.status_deleted AS status_deleted
            FROM tb_sanitary AS t
            JOIN tb_user AS u ON t.worker = u.id
            JOIN tb_store AS s ON t.location = s.idStore
            WHERE t.location = $idStore
            AND YEARWEEK(STR_TO_DATE(t.date, '%d-%m-%Y'), 7) = YEARWEEK('$currDate', 7)
            AND t.status_deleted = 0
            ORDER BY date_year DESC, date_month DESC, date DESC, time DESC
        ");

        return $query->getResultArray();
    }
}
