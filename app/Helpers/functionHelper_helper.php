<?php 
    /**
     * convertDate
     * merubah tanggal urutan tanggal
     *
     * @param  mixed $date
     * @return void
     */
    function convertDate($date)
    {
        $tanggal = explode("-", $date);
        return $tanggal[2].'-'.$tanggal[1].'-'.$tanggal[0];
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
                return '<span class="badge bg-warning text-dark">L</span>';
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
