<?php

/**
 * convertDate
 * merubah tanggal urutan tanggal
 *
 * @param  string $date
 * @return void
 */
function convertDate($date, $format = null)
{
    if ($format != null) {
        $tanggal = new DateTime($date);
        return $tanggal->format($format);
    }
    $tanggal = explode("-", $date);
    return $tanggal[2] . '-' . $tanggal[1] . '-' . $tanggal[0];
}

function dateSQL($date)
{
    $tanggal = new DateTime($date);
    return $tanggal->format('Y-m-d');
}

function dateView($date)
{
    $tanggal = new DateTime($date);
    return $tanggal->format('d-m-Y');
}

/**
 * coloredShift
 * Menambahkan badge berwarna pada shift
 *
 * @param  string $shift
 * @return void
 */
function coloredShift($shift)
{
    switch ($shift) {
        case 'P':
            return '<span class="badge bg-primary">P</span>';
            break;

        case 'S':
            return '<span class="badge bg-secondary">S</span>';
            break;

        case 'M':
            return '<span class="badge bg-success">M</span>';
            break;

        case 'O':
            return '<span class="badge bg-danger">O</span>';
            break;

        case 'L':
            return '<span class="badge bg-warning">L</span>';
            break;

        case 'CT':
            return '<span class="badge bg-info text-dark">CT</span>';
            break;

        case 'OP':
            return '<span class="badge bg-tomato">OP</span>';
            break;

        case 'DLK':
            return '<span class="badge bg-dark">DLK</span>';
            break;

        default:
            return "<span class='badge bg-primary'>$shift</span>";
            break;
    }
}

// TODO fix desc yesicon
/**
 * yesIcon
 * Memberi icon ceklis, silang, dan tanda tanya
 *
 * @param  string $data
 * @return void
 */
function yesIcon($data)
{
    if ($data != NULL and $data != '-') {
        return '<span class="bg-success text-white p-2 rounded">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l5 5l10 -10"></path></svg>
            </span>';
    }
    return '<span class="bg-danger text-white p-2 rounded">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
      </span>';
    // switch ($data) {
    //     case 'YES':
    //         return '<span class="bg-success text-white p-2 rounded">
    //             <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l5 5l10 -10"></path></svg>
    //             </span>';
    //         break;

    //     case 'NO':
    //         return '<span class="bg-danger text-white p-2 rounded">
    //             <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
    //           </span>';
    //         break;

    //     default:
    //         return '<span class="bg-secondary text-white p-2 rounded">
    //           <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M8 8a3.5 3 0 0 1 3.5 -3h1a3.5 3 0 0 1 3.5 3a3 3 0 0 1 -2 3a3 4 0 0 0 -2 4"></path><line x1="12" y1="19" x2="12" y2="19.01"></line></svg>
    //         </span>';
    //         break;
    // }
}

function hasilInspeksi($hasil)
{
    switch ($hasil) {
        case 0:
            return "BURUK";
            break;

        case 1:
            return "BAIK";
            break;

        default:
            return "-";
            break;
    }
}

function equipmentStatus($hasil)
{
    switch ($hasil) {
        case 0:
            return "RUSAK";
            break;

        case 1:
            return "BAIK";
            break;

        default:
            return "-";
            break;
    }
}

function onOff($hasil)
{
    switch ($hasil) {
        case 0:
            return "OFF";
            break;

        case 1:
            return "ON";
            break;

        default:
            return "-";
            break;
    }
}

function autoManual($hasil)
{
    switch ($hasil) {
        case 0:
            return "MANUAL";
            break;

        case 1:
            return "AUTO";
            break;

        default:
            return "-";
            break;
    }
}

function fullKurang($hasil)
{
    switch ($hasil) {
        case 0:
            return "KURANG";
            break;

        case 1:
            return "FULL";
            break;

        default:
            return "-";
            break;
    }
}

function bersihKotor($hasil)
{
    switch ($hasil) {
        case 0:
            return "KOTOR";
            break;

        case 1:
            return "BERSIH";
            break;

        default:
            return "-";
            break;
    }
}

function berfungsiTidak($hasil)
{
    switch ($hasil) {
        case 0:
            return "TIDAK";
            break;

        case 1:
            return "BERFUNGSI";
            break;

        default:
            return "-";
            break;
    }
}

function yaTidak($hasil)
{
    switch ($hasil) {
        case 0:
            return "TIDAK";
            break;

        case 1:
            return "YA";
            break;

        default:
            return "-";
            break;
    }
}

function lengkapTidak($hasil)
{
    switch ($hasil) {
        case 0:
            return "TIDAK";
            break;

        case 1:
            return "LENGKAP";
            break;

        default:
            return "-";
            break;
    }
}

function yesNoIcon($hasil)
{
    switch ($hasil) {
        case 0:
            return '<span class="bg-danger text-white p-2 rounded">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
          </span>';
            break;

        case 1:
            return '<span class="bg-success text-white p-2 rounded">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l5 5l10 -10"></path></svg>
            </span>';
            break;

        default:
            return "-";
            break;
    }
}

/**
 * timeCheck
 * mengecek jam checklist dengan wkt sekarang, checklist equipment, dan waktu inspeksi yg sudah dilakukan
 * data yang valid akan mereturn disabled untuk form checklist
 *
 * @param  string $time ==> "08:00:00"
 * @param  array $data  ==> hasil data dari checkInspection
 * @return void
 */
function timeCheck($time, $data)
{
    if ($time < date("H:i:s")) {
        return 'disabled';
    }
    if (isset($data['data'])) {
        foreach ($data['data'] as $key => $value) {
            if ($value['equipment_checklist'] == 'MONTHLY') {
                return 'disabled';
            }
            if ($value['time'] == $time) {
                return 'disabled';
            }
        }
    }
    return '';
}

// TODO lanjutin buat generate time checklist
function generateChecklistTime($checklist, $checkInspection, $time = null, $isUpdate = FALSE)
{
    
    $validation = \Config\Services::validation();

    if ($checklist == "MONTHLY") {
        return '';
    }
    if ($isUpdate) {
        echo '<div class="form-group mb-3 row">
        <label class="form-label col-3 col-form-label">Jam Pengecekan</label>
        <div class="col">
            <div class="input-icon mb-2">
                <input id="timeValue" name="time" class="form-control" value="'. old('time') .'" disabled>
            </div>
        </div></div>';
    return;
    }

    echo '<div class="form-group mb-3 row">';
    echo '<label class="form-label col-3 col-form-label">Jam Pengecekan</label>';
    echo '<div class="col">';

    if ($time == null) {
        switch ($checklist) {
            case 'DAILY':
                $time = ['08:00:00','10:00:00','13:00:00','19:00:00'];
                break;
    
            case 'WEEKLY':
                $time = ['10:00:00', '19:00:00'];
                break;
            
            default:
                return '';
                break;
        }
    }

    foreach ($time as $key => $value) {
        echo '<div class="form-check">';
        echo ($isUpdate ? '<input type="text" hidden readonly id="timeValue" name="time" value="'. old('time') .'">' : '');
        echo '<input '. ($isUpdate ? 'disabled' : '' ) . ' ' . timeCheck($value, $checkInspection) . (old("time") == $value ? ' checked' : ' ');
        echo ' value="'. $value .'" id="time" name="time" class="jamCheck form-check-input ' . ($validation->hasError("time") ? " is-invalid" : " ") . '"';
        echo 'type="checkbox" onclick="jamCheck(this.value)">
                <span class="form-check-label">';
        $jam = explode(":", $value);
        echo $jam[0] . ':' . $jam[1];
        echo '</span>
            </div>';
    }
    
    if ($validation->hasError('time')) {
        echo '<div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">' . 
            $validation->getError('time') . 
        '</div>';
    }

    echo "</div>
            <script>
                function jamCheck(b) {
                    var x = document.getElementsByClassName('jamCheck');
                    var i;

                    for (i = 0; i < x.length; i++) {
                        if (x[i].value != b) x[i].checked = false;
                    }
                }
            </script>
        </div>";
}
