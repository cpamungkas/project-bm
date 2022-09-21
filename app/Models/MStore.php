<?php

namespace App\Models;

use CodeIgniter\Model;

class MStore extends Model
{
    protected $table = 'tb_store';
    protected $primaryKey = 'idStore';
    protected $allowedFields = [
        'StoreName',
        'StoreCode',
        'KWHMeter1',
        'KWHMeter2',
        'idPLN1',
        'idPLN2',
        'date_created',
        'date_updated',
        'date_deleted',
        'status_deleted'
    ];

    public function getStore()
    {
        $query = $this->db->table('tb_store')
            ->where('status_deleted', 0)
            ->get();
        return $query->getResultArray();
    }

    public function getTotalStore()
    {
        $query = $this->db->table('tb_store')
            ->where('status_deleted', 0)
            ->countAllResults();
        return $query;
    }   

    public function getDataTableStore()
    {

        $query = "select idStore, StoreName, StoreCode, a.KWHMeter1 as 'idKWHMeter1', b.kwhmeter1 as 'KWHMeter1', idPLN1, a.KWHMeter2 as 'idKWHMeter2', c.kwhmeter2 as 'KWHMeter2', idPLN2 from tb_store a inner JOIN tb_kwhmeter1 b on  a.KWHMeter1 = b.idkwhmeter1 inner JOIN tb_kwhmeter2 c on  a.KWHMeter2 = c.idkwhmeter2
        where a.status_deleted = 0 order by idStore asc";
        return $this->db->query($query)->getResultArray();
    }

    public function getKWHMeter1()
    {
        $query = "select idkwhmeter1, kwhmeter1 from tb_kwhmeter1 where status_deleted = 0";
        return $this->db->query($query)->getResultArray();
    }

    public function getKWHMeter2()
    {
        $query = "select idkwhmeter2, kwhmeter2 from tb_kwhmeter2 where status_deleted = 0";
        return $this->db->query($query)->getResultArray();
    }

    public function updateStorebyIds($idstore)
    {
        $idUrl = $idstore;
        $data = [
            'StoreName' => $this->request->getPost('storename'),
            'StoreCode' => $this->request->getPost('storecode'),
            'KWHMeter1' => $this->request->getVar('modalkwhmeter1'),
            'KWHMeter2' => $this->request->getVar('modalkwhmeter2'),
            'idPLN1' => $this->request->getPost('idpln1'),
            'idPLN2' => $this->request->getPost('idpln2'),
            'date_updated' => time(),
            'status_deleted' => 0
        ];
        $this->db->where('idStore', $idUrl);
        $this->db->update('tb_store', $data);
        return redirect()->to('/store');
    }
}
