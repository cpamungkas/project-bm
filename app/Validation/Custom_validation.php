<?php 

namespace App\Validation;

use App\Models\MSchedule;
use App\Models\MStore;
use App\Models\MUser;

class Custom_validation {
    public function __construct()
    {
        $this->mUser = new MUser();
        $this->mStore = new MStore();
        $this->mSchedule = new MSchedule();
        helper(['form', 'url', 'functionHelper']);
    }

    public function checkFreeShiftSchedule($idUser, $date)
    {
        $schdule = $this->mSchedule->checkFreeShiftSchedule($date, $idUser);

        if ($schdule != null) {
            return FALSE;
        }
        return TRUE;
    }

    public function checkFreeTechJobSchedule(string $str, string $fields, array $data)
	{
		$schdule = $this->mSchedule->checkFreeTechJobSchedule($data['name'], convertDate($data['start_date']), convertDate($data['end_date']));

        if ($schdule != null) {
            return FALSE;
        }
        return TRUE;
	}

    public function checkTimeByChecklist($checkTime, $checklist)
	{
        if ($checklist == 'MONTHLY' || $checkTime == null) {
            return TRUE;
        }

        $time = [];
        switch ($checklist) {
            case 'DAILY':
                $time = ['08:00:00','10:00:00','13:00:00','19:00:00'];
                break;
    
            case 'WEEKLY':
                $time = ['10:00:00', '19:00:00'];
                break;
            
            default:
                return FALSE;
                break;
        }

        if (in_array($checkTime, $time)) {
            return TRUE;
        }

        return FALSE;
	}

    public function checkEmptyTime($checkTime, $checklist)
    {
        if ($checklist == 'MONTHLY') {
            return TRUE;
        }
        if ($checkTime == null) {
            return FALSE;
        }
        return TRUE;
    }
}