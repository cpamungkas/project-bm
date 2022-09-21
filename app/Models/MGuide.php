<?php

namespace App\Models;

use CodeIgniter\Model;

class MGuide extends Model {
    protected $table = 'tb_userguide';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'equipment',
        'category',
        'sub_category',
        'daily_08',
        'daily_10',
        'daily_13',
        'daily_19',
        'weekly_10',
        'weekly_19',
        'monthly'
    ];

    public function getUserGuide()
    {
        $query = $this->db->query("
            SELECT
                g.id AS id,
                g.equipment AS equipment,
                g.category AS category_id, c.name AS category_name,
                g.sub_category AS sub_category_id,
                g.daily_08 AS daily_08,
                g.daily_10 AS daily_10,
                g.daily_13 AS daily_13,
                g.daily_19 AS daily_19,
                g.weekly_10 AS weekly_10,
                g.weekly_19 AS weekly_19,
                g.monthly AS monthly
            FROM tb_userguide AS g
            JOIN tb_userguide_category AS c ON g.category = c.id"
        );
        
        return $query->getResultArray();
    }
}
