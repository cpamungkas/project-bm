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
}