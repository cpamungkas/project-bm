<?php

namespace App\Models;

use CodeIgniter\Model;

class MGenset extends Model {
    protected $table = 'tb_genset';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'location',
        'date',
        'time',
        'worker',
        'genset',
        'run_number',
        'pressure',
        'radiator',
        'start',
        'running',
        'vdc_12',
        'vdc_24',
        'solar',
        'rs',
        'st',
        'tn',
        'ln',
        'r',
        's',
        't',
        'kw',
        'description',
        'date_created',
        'date_updated',
        'status_deleted'
    ];

    public function getGensetByStore($idStore, $genset) {
        $query = $this->db->query("
            SELECT
                g.id AS id,
                g.location AS store_id, s.StoreName AS store_name,
                g.date AS date, SUBSTRING(g.date, 7, 4) AS date_year, SUBSTRING(g.date, 4, 2) AS date_month, g.time AS time,
                g.worker AS worker_id, u.name AS worker_name,
                g.genset AS genset,
                g.run_number AS run_number, g.pressure AS pressure, g.radiator AS radiator,
                g.start AS start, g.running AS running,
                g.vdc_12 AS vdc_12, g.vdc_24 AS vdc_24,
                g.solar AS solar,
                g.rs AS rs, g.st AS st, g.tn AS tn, g.ln AS ln,
                g.r AS r, g.s AS s, g.t AS t, g.kw AS kw,
                g.description AS description,
                g.date_created AS date_created, g.date_updated AS date_updated
            FROM tb_genset AS g
            JOIN tb_user AS u ON g.worker = u.id
            JOIN tb_store AS s ON g.location = s.idStore
            WHERE g.location = $idStore AND g.status_deleted = 0
            AND g.genset = $genset
            ORDER BY date_year DESC, date_month DESC, date DESC, time DESC
        ");

        return $query->getResultArray();
    }

    public function getGensetByStoreDate($idStore, $genset) {
        $currDate = date('Y-m-d');

        $query = $this->db->query("
            SELECT
                g.id AS id,
                g.location AS store_id, s.StoreName AS store_name,
                g.date AS date, SUBSTRING(g.date, 7, 4) AS date_year, SUBSTRING(g.date, 4, 2) AS date_month, g.time AS time,
                g.worker AS worker_id, u.name AS worker_name,
                g.genset AS genset,
                g.run_number AS run_number, g.pressure AS pressure, g.radiator AS radiator,
                g.start AS start, g.running AS running,
                g.vdc_12 AS vdc_12, g.vdc_24 AS vdc_24,
                g.solar AS solar,
                g.rs AS rs, g.st AS st, g.tn AS tn, g.ln AS ln,
                g.r AS r, g.s AS s, g.t AS t, g.kw AS kw,
                g.description AS description,
                g.date_created AS date_created, g.date_updated AS date_updated
            FROM tb_genset AS g
            JOIN tb_user AS u ON g.worker = u.id
            JOIN tb_store AS s ON g.location = s.idStore
            WHERE g.location = $idStore
            AND g.genset = $genset
            AND YEARWEEK(STR_TO_DATE(g.date, '%d-%m-%Y'), 7) = YEARWEEK('$currDate', 7)
            AND g.status_deleted = 0
            ORDER BY date_year DESC, date_month DESC, date DESC, time DESC
        ");

        return $query->getResultArray();
    }
}
