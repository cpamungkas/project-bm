<?php

namespace App\Models;

use CodeIgniter\Model;

class MMaster extends Model
{
    protected $DBGroup = 'default';
    protected $table = "tb_level";
    protected $primaryKey = "idLevel";
    protected $allowedFields = [
        'Level',
        'accessmenu',
        'date_created',
        'date_updated',
        'status_deleted'
    ];



    public function getTotalLevel()
    {
        $query = $this->db->table('tb_level')
            ->where('status_deleted', 0)
            ->countAllResults();
        return $query;
    }

    public function getLastID()
    {
        return $this->select('idLevel')->orderBy('idLevel', 'DESC')->first();
    }

    public function getAllLevel()
    {
        return $this->findAll();
    }

    function getDataLevel()
    {
        $hasil = $this->db->query("SELECT idLevel, Level as level, menu_access, date_created, date_updated, status_deleted  from tb_level WHERE status_deleted =0 ORDER BY idLevel ASC");

        return $hasil->getResultArray();
    }
}
