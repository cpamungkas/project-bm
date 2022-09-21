<?php

namespace App\Models;

use CodeIgniter\Model;

class MAcchiller extends Model {
    protected $table = 'tb_acchiller';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'location',
        'date',
        'time',
        'worker',
        'chiller_1',
        'chiller_2',
        'chwp_1',
        'chwp_2',
        'chwp_3',
        'chwp_entering_temp',
        'chwp_leaving_temp',
        'chwp_entering_pres',
        'chwp_leaving_pres',  
        'cwp_entering_temp',
        'cwp_leaving_temp',
        'cwp_entering_pres',
        'cwp_leaving_pres', 
        'rs',
        'st',
        'tn',
        'r',
        's',
        't',
        'kw',
        'eva_pres',
        'con_pres',
        'eva_temp',
        'con_temp',
        'rla',
        'start',
        'running',
        'oil_temp',
        'set_point',
        'description',       
        'date_created',
        'date_updated',
        'status_deleted'
    ];

    public function getAcChillerByStore($idStore) {
        $query = $this->db->query("
            SELECT
                a.id AS id,
                a.location AS store_id, s.StoreName AS store_name,
                a.date AS date, SUBSTRING(a.date, 7, 4) AS date_year, SUBSTRING(a.date, 4, 2) AS date_month, a.time AS time,
                a.worker AS worker_id, u.name AS worker_name,
                a.chiller_1 AS chiller_1, a.chiller_2 AS chiller_2,
                a.chwp_1 AS chwp_1, a.chwp_2 AS chwp_2, a.chwp_3 AS chwp_3,
                a.chwp_entering_temp AS chwp_entering_temp, a.chwp_leaving_temp AS chwp_leaving_temp, a.chwp_entering_pres AS chwp_entering_pres, a.chwp_leaving_pres AS chwp_leaving_pres,
                a.cwp_entering_temp AS cwp_entering_temp, a.cwp_leaving_temp AS cwp_leaving_temp, a.cwp_entering_pres AS cwp_entering_pres, a.cwp_leaving_pres AS cwp_leaving_pres,
                a.rs AS rs, a.st AS st, a.tn AS tn, a.r AS r, a.s AS s, a.t AS t, a.kw AS kw,
                a.eva_pres AS eva_pres, a.con_pres AS con_pres, a.eva_temp AS eva_temp, a.con_temp AS con_temp, a.rla AS rla, a.start AS start, a.running AS running, a.oil_temp AS oil_temp, a.set_point AS set_point,
                a.description AS description,
                a.date_created AS date_created, a.date_updated AS date_updated
            FROM tb_acchiller AS a
            JOIN tb_user AS u ON a.worker = u.id
            JOIN tb_store AS s ON a.location = s.idStore
            WHERE a.location = $idStore AND a.status_deleted = 0
            ORDER BY date_year DESC, date_month DESC, date DESC, time DESC
        ");

        return $query->getResultArray();
    }

    public function getAcChillerByStoreDate($idStore) {
        $currDate = date('d-m-Y');

        $query = $this->db->query("
            SELECT
                a.id AS id,
                a.location AS store_id, s.StoreName AS store_name,
                a.date AS date, SUBSTRING(a.date, 7, 4) AS date_year, SUBSTRING(a.date, 4, 2) AS date_month, a.time AS time,
                a.worker AS worker_id, u.name AS worker_name,
                a.chiller_1 AS chiller_1, a.chiller_2 AS chiller_2,
                a.chwp_1 AS chwp_1, a.chwp_2 AS chwp_2, a.chwp_3 AS chwp_3,
                a.chwp_entering_temp AS chwp_entering_temp, a.chwp_leaving_temp AS chwp_leaving_temp, a.chwp_entering_pres AS chwp_entering_pres, a.chwp_leaving_pres AS chwp_leaving_pres,
                a.cwp_entering_temp AS cwp_entering_temp, a.cwp_leaving_temp AS cwp_leaving_temp, a.cwp_entering_pres AS cwp_entering_pres, a.cwp_leaving_pres AS cwp_leaving_pres,
                a.rs AS rs, a.st AS st, a.tn AS tn, a.r AS r, a.s AS s, a.t AS t, a.kw AS kw,
                a.eva_pres AS eva_pres, a.con_pres AS con_pres, a.eva_temp AS eva_temp, a.con_temp AS con_temp, a.rla AS rla, a.start AS start, a.running AS running, a.oil_temp AS oil_temp, a.set_point AS set_point,
                a.description AS description,
                a.date_created AS date_created, a.date_updated AS date_updated
            FROM tb_acchiller AS a
            JOIN tb_user AS u ON a.worker = u.id
            JOIN tb_store AS s ON a.location = s.idStore
            WHERE a.location = $idStore AND a.date = '$currDate' AND a.status_deleted = 0
            ORDER BY date_year DESC, date_month DESC, date DESC, time DESC
        ");

        return $query->getResultArray();
    }
}
