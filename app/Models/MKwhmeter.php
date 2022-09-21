<?php

namespace App\Models;

use CodeIgniter\Model;

class MKwhmeter extends Model {
    protected $table = 'tb_kwhmeter';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'location',
        'date',
        'time',
        'worker',
        'kwh_meter',
        'id_pln',
        'cos_phi',
        'kw',
        'lwbp',
        'wbp',
        'kvarh',
        'date_created',
        'date_updated',
        'status_deleted'
    ];

    public function getKwhMeterByStore($idStore) {
        $query = $this->db->query("
            SELECT
                k.id AS id,
                k.location AS store_id, s.StoreName AS store_name,
                k.date AS date, SUBSTRING(k.date, 7, 4) AS date_year, SUBSTRING(k.date, 4, 2) AS date_month, k.time AS time,
                k.worker AS worker_id, u.name AS worker_name,
                k.kwh_meter AS kwh_meter,
                k.id_pln AS id_pln,
                k.cos_phi AS cos_phi,
                k.kw AS kw,
                k.lwbp AS lwbp,
                k.wbp AS wbp,
                k.kvarh AS kvarh,
                k.date_created AS date_created, k.date_updated AS date_updated,
                k.status_deleted AS status_deleted
            FROM tb_kwhmeter AS k
            JOIN tb_user AS u ON k.worker = u.id
            JOIN tb_store AS s ON k.location = s.idStore
            WHERE k.location = $idStore AND k.status_deleted = 0
            ORDER BY date_year DESC, date_month DESC, date DESC, time DESC
        ");

        return $query->getResultArray();
    }

    public function getKwhMeterByStoreDate($idStore) {
        $currDate = date('d-m-Y');

        $query = $this->db->query("
            SELECT
                k.id AS id,
                k.location AS store_id, s.StoreName AS store_name,
                k.date AS date, SUBSTRING(k.date, 7, 4) AS date_year, SUBSTRING(k.date, 4, 2) AS date_month, k.time AS time,
                k.worker AS worker_id, u.name AS worker_name,
                k.kwh_meter AS kwh_meter,
                k.id_pln AS id_pln,
                k.cos_phi AS cos_phi,
                k.kw AS kw,
                k.lwbp AS lwbp,
                k.wbp AS wbp,
                k.kvarh AS kvarh,
                k.date_created AS date_created, k.date_updated AS date_updated,
                k.status_deleted AS status_deleted
            FROM tb_kwhmeter AS k
            JOIN tb_user AS u ON k.worker = u.id
            JOIN tb_store AS s ON k.location = s.idStore
            WHERE k.location = $idStore AND k.date = '$currDate' AND k.status_deleted = 0
            ORDER BY date_year DESC, date_month DESC, date DESC, time DESC
        ");

        return $query->getResultArray();
    }

    public function getKwhMeterIdPlnByStore($idStore) {
        $query = $this->db->query("
            SELECT
                s.KWHMeter1 AS kwh_meter_1_id, x.kwhmeter1 AS kwh_meter_1_value,
                s.KWHMeter2 AS kwh_meter_2_id, y.kwhmeter2 AS kwh_meter_2_value,
                s.idPLN1 AS id_pln_1,
                s.idPLN2 AS id_pln_2
            FROM tb_store AS s
            JOIN tb_kwhmeter1 AS x ON s.KWHMeter1 = x.idkwhmeter1
            JOIN tb_kwhmeter2 AS y ON s.KWHMeter2 = y.idkwhmeter2
            WHERE s.idStore = $idStore
        ");

        return $query->getResultArray();
    }
}
