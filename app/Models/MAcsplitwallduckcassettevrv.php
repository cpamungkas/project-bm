<?php

namespace App\Models;

use CodeIgniter\Model;

class MAcsplitwallduckcassettevrv extends Model {
    protected $table = 'tb_acsplitwallduckcassettevrv';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'location',
        'date',
        'worker',
        'merk',
        'type',
        'serial',
        'room',
        'floor',
        'a_before',
        'a_after',
        'r22',
        'r32',
        'r410a',
        'action_filter',
        'action_evaporator',
        'action_condenser',
        'action_cover',
        'action_drainage',
        'spare_part',
        'description',
        'date_created',
        'date_updated',
        'status_deleted'
    ];

    public function getAcSplitWallDuckCassetteVrvByStore($idStore) {
        $query = $this->db->query("
            SELECT
                a.id AS id,
                a.location AS store_id, s.StoreName AS store_name,
                a.date AS date, SUBSTRING(a.date, 7, 4) AS date_year, SUBSTRING(a.date, 4, 2) AS date_month,
                a.worker AS worker_id, u.name AS worker_name,
                a.merk AS merk, a.type AS type, a.serial AS serial,
                a.room AS room, a.floor AS floor,
                a.a_before AS a_before, a.a_after AS a_after,
                a.r22 AS r22, a.r32 AS r32, a.r410a AS r410a,
                a.action_filter AS action_filter, a.action_evaporator AS action_evaporator, a.action_condenser AS action_condenser, a.action_cover AS action_cover, a.action_drainage AS action_drainage,
                a.spare_part AS spare_part,
                a.description AS description,
                a.date_created AS date_created, a.date_updated AS date_updated,
                a.status_deleted AS status_deleted
            FROM tb_acsplitwallduckcassettevrv AS a
            JOIN tb_user AS u ON a.worker = u.id
            JOIN tb_store AS s ON a.location = s.idStore
            WHERE a.location = $idStore AND a.status_deleted = 0
            ORDER BY date_year DESC, date_month DESC, date DESC
        ");

        return $query->getResultArray();
    }

    public function getAcSplitWallDuckCassetteVrvByStoreDate($idStore) {
        $currDate = date('Y-m-d');

        $query = $this->db->query("
            SELECT
                a.id AS id,
                a.location AS store_id, s.StoreName AS store_name,
                a.date AS date, SUBSTRING(a.date, 7, 4) AS date_year, SUBSTRING(a.date, 4, 2) AS date_month,
                a.worker AS worker_id, u.name AS worker_name,
                a.merk AS merk, a.type AS type, a.serial AS serial,
                a.room AS room, a.floor AS floor,
                a.a_before AS a_before, a.a_after AS a_after,
                a.r22 AS r22, a.r32 AS r32, a.r410a AS r410a,
                a.action_filter AS action_filter, a.action_evaporator AS action_evaporator, a.action_condenser AS action_condenser, a.action_cover AS action_cover, a.action_drainage AS action_drainage,
                a.spare_part AS spare_part,
                a.description AS description,
                a.date_created AS date_created, a.date_updated AS date_updated,
                a.status_deleted AS status_deleted
            FROM tb_acsplitwallduckcassettevrv AS a
            JOIN tb_user AS u ON a.worker = u.id
            JOIN tb_store AS s ON a.location = s.idStore
            WHERE a.location = $idStore
            AND MONTH(STR_TO_DATE(a.date, '%d-%m-%Y')) = MONTH('$currDate')
            AND YEAR(STR_TO_DATE(a.date, '%d-%m-%Y')) = YEAR('$currDate')
            AND a.status_deleted = 0
            ORDER BY date_year DESC, date_month DESC, date DESC
        ");

        return $query->getResultArray();
    }
}
