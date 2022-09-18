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
            if (isset($value['equipment_checklist'])) {
                if ($value['equipment_checklist'] == 'MONTHLY') {
                    return 'disabled';
                }
                if ($value['time'] == $time) {
                    return 'disabled';
                }
            } else {
                foreach ($value as $p => $q) {
                    if ($q['equipment_checklist'] == 'MONTHLY') {
                        return 'disabled';
                    }
                    if ($q['time'] == $time) {
                        return 'disabled';
                    }
                }
            }
        }
    }
    return '';
}
