<?php

namespace App\Models;

use CodeIgniter\Model;

class MUser extends Model
{
    protected $DBGroup = 'default';
    protected $table = "tb_user";
    protected $primaryKey = "id";
    protected $allowedFields = [
        'username',
        'password',
        'nik',
        'name',
        'email',
        'image',
        'initial',
        'is_active',
        'role_id',
        'superior_role_id',
        'superior_name_id',
        'location',
        'level',
        'date_created',
        'date_updated',
        'date_deleted',
        'status_deleted'
    ];

    public function getUser($nik)
    {
        return $this->where('nik', $nik)->first();
    }

    public function getTotalUser()
    {
        $query = $this->db->table('tb_user')
            ->where('status_deleted', 0)
            ->countAllResults();
        return $query;
    }

    public function getLastID()
    {
        return $this->select('id')->orderBy('id', 'DESC')->first();

        // return $this->db->table($this->table)->get()->getLastRow()->id;
    }

    public function getAllUser()
    {
        return $this->findAll();
    }

    public function getUserByID($id)
    {
        return $this->where('id', $id)->first();
    }

    public function getUserByRoleID($id)
    {
        return $this->where('role_id', $id)->findAll();
    }

    public function getUserBySuperiorRoleID($id)
    {
        return $this->where('superior_role_id', $id)->findAll();
    }

    public function getUserByLevel($level)
    {
        return $this->where('level', $level)->findAll();
    }

    public function getUserByLocation($location)
    {
        return $this->where('location', $location)->findAll();
    }

    public function getUserByStatus($status)
    {
        return $this->where('is_active', $status)->findAll();
    }

    public function getUserByStatusDeleted($status)
    {
        return $this->where('status_deleted', $status)->findAll();
    }

    public function getUserByRoleIDAndStatus($id, $status)
    {
        return $this->where('role_id', $id)->where('is_active', $status)->findAll();
    }

    public function getUserByRoleIDAndStatusDeleted($id, $status)
    {
        return $this->where('role_id', $id)->where('status_deleted', $status)->findAll();
    }

    public function getUserBySuperiorRoleIDAndStatus($id, $status)
    {
        return $this->where('superior_role_id', $id)->where('is_active', $status)->findAll();
    }

    public function getUserBySuperiorRoleIDAndStatusDeleted($id, $status)
    {
        return $this->where('superior_role_id', $id)->where('status_deleted', $status)->findAll();
    }

    public function getUserByLevelAndStatus($level, $status)
    {
        return $this->where('level', $level)->where('is_active', $status)->findAll();
    }

    public function getUserByLevelAndStatusDeleted($level, $status)
    {
        return $this->where('level', $level)->where('status_deleted', $status)->findAll();
    }

    public function getUserByLocationAndStatus($location, $status)
    {
        return $this->where('location', $location)->where('is_active', $status)->findAll();
    }

    public function getUserByLocationAndStatusDeleted($location, $status)
    {
        return $this->where('location', $location)->where('status_deleted', $status)->findAll();
    }

    public function getUserByRoleIDAndSuperiorRoleIDAndStatus($id, $superior_id, $status)
    {
        return $this->where('role_id', $id)->where('superior_role_id', $superior_id)->where('is_active', $status)->findAll();
    }

    public function getUserByRoleIDAndSuperiorRoleIDAndStatusDeleted($id, $superior_id, $status)
    {
        return $this->where('role_id', $id)->where('superior_role_id', $superior_id)->where('status_deleted', $status)->findAll();
    }

    public function getUserByRoleIDAndLevelAndStatus($id, $level, $status)
    {
        return $this->where('role_id', $id)->where('level', $level)->where('is_active', $status)->findAll();
    }

    public function getUserByRoleIDAndLevelAndStatusDeleted($id, $level, $status)
    {
        return $this->where('role_id', $id)->where('level', $level)->where('status_deleted', $status)->findAll();
    }

    public function getUserByRoleIDAndLocationAndStatus($id, $location, $status)
    {
        return $this->where('role_id', $id)->where('location', $location)->where('is_active', $status)->findAll();
    }

    public function getUserByRoleIDAndLocationAndStatusDeleted($id, $location, $status)
    {
        return $this->where('role_id', $id)->where('location', $location)->where('status_deleted', $status)->findAll();
    }

    public function getUserByRoleIDAndSuperiorRoleIDAndLevelAndStatus($id, $superior_id, $level, $status)
    {
        return $this->where('role_id', $id)->where('superior_role_id', $superior_id)->where('level', $level)->where('is_active', $status)->findAll();
    }

    public function getUserByRoleIDAndSuperiorRoleIDAndLevelAndStatusDeleted($id, $superior_id, $level, $status)
    {
        return $this->where('role_id', $id)->where('superior_role_id', $superior_id)->where('level', $level)->where('status_deleted', $status)->findAll();
    }

    public function getUserByRoleIDAndSuperiorRoleIDAndLocationAndStatus($id, $superior_id, $location, $status)
    {
        return $this->where('role_id', $id)->where('superior_role_id', $superior_id)->where('location', $location)->where('is_active', $status)->findAll();
    }

    public function getUserByRoleIDAndSuperiorRoleIDAndLocationAndStatusDeleted($id, $superior_id, $location, $status)
    {
        return $this->where('role_id', $id)->where('superior_role_id', $superior_id)->where('location', $location)->where('status_deleted', $status)->findAll();
    }

    public function getUserByRoleIDAndSuperiorRoleIDAndLevelAndLocationAndStatus($id, $superior_id, $level, $location, $status)
    {
        return $this->where('role_id', $id)->where('superior_role_id', $superior_id)->where('level', $level)->where('location', $location)->where('is_active', $status)->findAll();
    }

    public function getUserByRoleIDAndSuperiorRoleIDAndLevelAndLocationAndStatusDeleted($id, $superior_id, $level, $location, $status)
    {
        return $this->where('role_id', $id)->where('superior_role_id', $superior_id)->where('level', $level)->where('location', $location)->where('status_deleted', $status)->findAll();
    }

    public function getUserByRoleIDAndSuperiorRoleIDAndLevelAndLocationAndStatusDeletedAndStatus($id, $superior_id, $level, $location, $status_deleted, $status)
    {
        return $this->where('role_id', $id)->where('superior_role_id', $superior_id)->where('level', $level)->where('location', $location)->where('status_deleted', $status_deleted)->where('is_active', $status)->findAll();
    }

    public function getDataRole()
    {
        $query = $this->db->query("SELECT * FROM tb_user_role where status_deleted = 0 and role_id NOT IN (99,1,2)");
        return $query->getResultArray();
    }

    public function getDataRoleAdmin()
    {
        $query = $this->db->query("SELECT * FROM tb_user_role");
        return $query->getResultArray();
    }

    public function getDataSuperiorName()
    {
        $query = $this->db->query("SELECT a.idSuperior, a.idSuperiorRole, b.role, a.SuperiorName, a.date_created, a.date_updated, a.status_deleted FROM tb_superior_name a inner join tb_user_role b on a.idSuperiorRole = b.role_id where a.status_deleted = 0 and b.role_id NOT IN (99,1,2)");
        return $query->getResultArray();
    }

    public function getDataSuperiorName2($id)
    {
        $query = $this->db->query("SELECT * FROM tb_superior_name WHERE idSuperiorRole='$id'");
        return $query->getResultArray();
    }

    public function getDataLocation()
    {
        $query = $this->db->query("SELECT * FROM tb_store where status_deleted = 0");
        return $query->getResultArray();
    }

    public function getDataLevel()
    {
        $query = $this->db->query("SELECT * FROM tb_level where status_deleted = 0");
        return $query->getResultArray();
    }

    public function getDataEmployee2()
    {
        $session = \Config\Services::session();
        $session = session();
        if ($session->get('role_id') == 99) {
            $query =  $this->db->query("SELECT a.id, a.username, a.password, a.nik, a.name, a.email, a.image, a.initial, a.is_active, a.role_id, b.role AS 'roleuser', 
            a.superior_role_id, r.role AS 'rolesuperior', t.SuperiorName, a.location, s.StoreCode, s.StoreName as 'storename', a.level, l.Level as 'levelname', a.date_created, a.date_updated, a.date_deleted, a.status_deleted 
            FROM tb_user AS a
            JOIN tb_user_role AS r ON a.`superior_role_id` = r.`role_id`
            INNER JOIN tb_user_role AS b ON a.`role_id` = b.`role_id`
            INNER JOIN tb_superior_name AS t ON a.`superior_role_id` = t.idSuperiorRole
            INNER JOIN tb_store AS s ON a.`location` = s.`idStore`
            INNER JOIN tb_level AS l ON a.`level`= l.`idLevel`");
        } else {
            $query = $this->db->query("SELECT a.id, a.username, a.password, a.nik, a.name, a.email, a.image, a.initial, a.is_active, a.role_id, b.role AS 'roleuser', 
            a.superior_role_id, r.role AS 'rolesuperior', t.SuperiorName, a.location, s.StoreCode, s.StoreName as 'storename', a.level, l.Level as 'levelname', a.date_created, a.date_updated, a.date_deleted, a.status_deleted 
            FROM tb_user AS a
            JOIN tb_user_role AS r ON a.`superior_role_id` = r.`role_id`
            INNER JOIN tb_user_role AS b ON a.`role_id` = b.`role_id`
            INNER JOIN tb_superior_name AS t ON a.`superior_role_id` = t.idSuperiorRole
            INNER JOIN tb_store AS s ON a.`location` = s.`idStore`
            INNER JOIN tb_level AS l ON a.`level`= l.`idLevel`
            WHERE a.`status_deleted` =0 AND a.role_id NOT IN (99,1,2)");
        }
        return $query->getResultArray();
    }
    function getDataemployeeById($id)
    {
        $hasil = $this->db->query("SELECT a.id, a.username, a.password, a.nik, a.name, a.email, a.image, a.initial, a.is_active, a.role_id, b.role AS 'roleuser', 
            a.superior_role_id, CASE WHEN r.`role` = 'None' THEN ' - ' ELSE r.role END AS 'rolesuperior', a.superior_name_id, CASE WHEN a.superior_role_id = 13 THEN ' - ' ELSE t.SuperiorName END AS 'SuperiorName', a.location, s.StoreCode, s.StoreName AS 'storename', a.level, l.Level AS 'levelname', a.date_created, a.date_updated, a.date_deleted, a.status_deleted 
            FROM tb_user AS a            
            INNER JOIN tb_user_role AS b ON a.`role_id` = b.`role_id`           
            INNER JOIN tb_user_role AS r ON a.`superior_role_id` = r.`role_id`              
            INNER JOIN tb_superior_name AS t ON a.`superior_name_id` = t.idSuperior
            INNER JOIN tb_store AS s ON a.`location` = s.`idStore`
            INNER JOIN tb_level AS l ON a.`level`= l.`idLevel`
            WHERE a.nik = '$id' and a.`status_deleted` =0 AND a.role_id NOT IN (99,1,2)");
        return $hasil->getResultArray();

        $query = $this->db->query("SELECT * FROM tb_superior_name WHERE idSuperiorRole='$id'");
        return $query->getResultArray();
    }

    function getDataEmployee()
    {
        $session = session();
        if ($session->get('role_id') == 99) {
            $hasil =  $this->db->query("SELECT a.id, a.username, a.password, a.nik, a.name, a.email, a.image, a.initial, a.is_active, a.role_id, b.role AS 'roleuser', 
            a.superior_role_id,  CASE WHEN r.`role` = 'None' THEN ' - ' ELSE r.role END AS 'rolesuperior', a.superior_name_id, CASE WHEN a.superior_role_id = 13 THEN ' - ' ELSE t.SuperiorName END AS 'SuperiorName', a.location, s.StoreCode, s.StoreName as 'storename', a.level, l.Level as 'levelname', a.date_created, a.date_updated, a.date_deleted, a.status_deleted 
            FROM tb_user AS a
            INNER JOIN tb_user_role AS b ON a.`role_id` = b.`role_id`
            INNER JOIN tb_superior_name AS t ON a.`superior_name_id` = t.idSuperior
            JOIN tb_user_role AS r ON a.`superior_role_id` = r.`role_id`
            INNER JOIN tb_store AS s ON a.`location` = s.`idStore`
            INNER JOIN tb_level AS l ON a.`level`= l.`idLevel`
            ORDER BY a.id ASC");
        } else {
            $hasil = $this->db->query("SELECT a.id, a.username, a.password, a.nik, a.name, a.email, a.initial, a.image, a.is_active, a.role_id, b.role AS 'roleuser', 
            a.superior_role_id, CASE WHEN r.`role` = 'None' THEN ' - ' ELSE r.role END AS 'rolesuperior', a.superior_name_id, CASE WHEN a.superior_role_id = 13 THEN ' - ' ELSE t.SuperiorName END AS 'SuperiorName', a.location, s.StoreCode, s.StoreName AS 'storename', a.level, l.Level AS 'levelname', a.date_created, a.date_updated, a.date_deleted, a.status_deleted 
            FROM tb_user AS a            
            INNER JOIN tb_user_role AS b ON a.`role_id` = b.`role_id`
            /*INNER JOIN tb_superior_name AS t ON a.`superior_role_id` = t.idSuperior
            JOIN tb_user_role AS r ON a.`superior_role_id` = r.`role_id`*/

            
            INNER JOIN tb_user_role AS r ON a.`superior_role_id` = r.`role_id`   
            -- INNER JOIN tb_superior_name AS t ON a.`superior_name_id` = t.idSuperior

            -- INNER JOIN tb_user_role AS r ON t.`idSuperiorRole` = r.`role_id`            
            INNER JOIN tb_superior_name AS t ON a.`superior_name_id` = t.idSuperior
            INNER JOIN tb_store AS s ON a.`location` = s.`idStore`
            INNER JOIN tb_level AS l ON a.`level`= l.`idLevel`
            WHERE a.`status_deleted` =0 AND a.role_id NOT IN (99,1,2)
            ORDER BY a.id ASC");
        }
        // $hasil = $this->db->query("SELECT * FROM tb_user where status_deleted = 0");
        return $hasil->getResultArray();
    }

    public function getDataRoleUser($roleId)
    {
        // return $this->where('nik', $nik)->first();
        return $this->db->query("SELECT role FROM tb_user_role WHERE role_id='$roleId' and status_deleted = 0")->getFirstRow();
        // return $query->getResultArray();
    }

    public function getLocationByUser($idLoc)
    {
        return $this->db->query("SELECT StoreName as location FROM tb_store WHERE idStore = '$idLoc' AND status_deleted = 0")->getFirstRow();
    }

    //------------------------------------------------------//













}
