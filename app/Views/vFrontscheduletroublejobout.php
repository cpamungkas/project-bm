<?= $this->extend('template_worker/index'); ?>

<?= $this->section('page-content'); ?>

<div class="page-body">
    <div class="container-xl">
        <div class="row row-deck row-cards">
            <?php
            if(session("error")){ ?>
                <div class="alert alert-warning alert-dismissible fade show text-danger" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alert-triangle" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M12 9v2m0 4v.01"></path>
                        <path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75"></path>
                    </svg>
                    <strong>Error!</strong> <?= session("error") ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>
            <?php
            if(session("success")){ ?>
                <div class="alert alert-success alert-dismissible fade show text-success" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-checks" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M7 12l5 5l10 -10"></path>
                        <path d="M2 12l5 5m5 -5l5 -5"></path>
                    </svg>
                    <strong>Success!</strong> <?= session("success") ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Filter</h3>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo base_url('troublejobout/applyScheduleOutFilter'); ?>" method="post">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-3 col-form-label">Start Date</label>
                                        <div class="col">
                                            <div class="input-icon mb-2">
                                                <?php if(!old('filter_start_date')): ?>
                                                    <input name="filter_start_date" id="filter_start_date" class="form-control <?= ($validation->hasError('filter_start_date')) ? 'is-invalid' : ''; ?>" placeholder="Select a date" id="datepicker-icon" value="<?= date('d-m-Y'); ?>" required>
                                                <?php else: ?>
                                                    <input name="filter_start_date" id="filter_start_date" class="form-control <?= ($validation->hasError('filter_start_date')) ? 'is-invalid' : ''; ?>" placeholder="Select a date" id="datepicker-icon" value="<?= old('filter_start_date'); ?>" required>
                                                <?php endif; ?>
                                                <?php if($validation->hasError('filter_start_date')): ?>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('filter_start_date'); ?>
                                                    </div>
                                                <?php else: ?>
                                                    <span class="input-icon-addon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <rect x="4" y="5" width="16" height="16" rx="2"></rect>
                                                            <line x1="16" y1="3" x2="16" y2="7"></line>
                                                            <line x1="8" y1="3" x2="8" y2="7"></line>
                                                            <line x1="4" y1="11" x2="20" y2="11"></line>
                                                            <line x1="11" y1="15" x2="12" y2="15"></line>
                                                            <line x1="12" y1="15" x2="12" y2="18"></line>
                                                        </svg>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-3 col-form-label">End Date</label>
                                        <div class="col">
                                            <div class="input-icon mb-2">
                                                <?php if(!old('filter_end_date')): ?>
                                                    <?php
                                                        $end = new DateTime(date('Y-m-d'));
                                                        date_modify($end, '+1 month');
                                                    ?>
                                                    <input name="filter_end_date" id="filter_end_date" class="form-control <?= ($validation->hasError('filter_end_date')) ? 'is-invalid' : ''; ?>" placeholder="Select a date" id="datepicker-icon" value="<?= $end->format('d-m-Y'); ?>" required>
                                                <?php else: ?>
                                                    <input name="filter_end_date" id="filter_end_date" class="form-control <?= ($validation->hasError('filter_end_date')) ? 'is-invalid' : ''; ?>" placeholder="Select a date" id="datepicker-icon" value="<?= old('filter_end_date'); ?>" required>
                                                <?php endif; ?>
                                                <?php if($validation->hasError('filter_end_date')): ?>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('filter_end_date'); ?>
                                                    </div>
                                                <?php else: ?>
                                                    <span class="input-icon-addon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <rect x="4" y="5" width="16" height="16" rx="2"></rect>
                                                            <line x1="16" y1="3" x2="16" y2="7"></line>
                                                            <line x1="8" y1="3" x2="8" y2="7"></line>
                                                            <line x1="4" y1="11" x2="20" y2="11"></line>
                                                            <line x1="11" y1="15" x2="12" y2="15"></line>
                                                            <line x1="12" y1="15" x2="12" y2="18"></line>
                                                        </svg>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-3 col-form-label">From Store</label>
                                        <div class="col">
                                            <select class="form-select" aria-label="Floating label select example" disabled>
                                                <option selected><?= $location; ?></option>
                                            </select>
                                        </div>
                                        <input type="hidden" id="filter_init_store" name="filter_init_store" value="<?= $idstore; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-footer">
                                <div class="row align-items-center">
                                    <div class="col"></div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-outline-primary ms-auto" id="btnSubmitOut" name="btnSubmitOut">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                            </svg>
                                            Apply
                                        </button>
                                        <button type="reset" class="btn btn-outline-secondary ms-auto" id="btnReset" name="btnReset">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eraser" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M19 20h-10.5l-4.21 -4.3a1 1 0 0 1 0 -1.41l10 -10a1 1 0 0 1 1.41 0l5 5a1 1 0 0 1 0 1.41l-9.2 9.3"></path>
                                                <path d="M18 13.3l-6.3 -6.3"></path>
                                            </svg>
                                            Reset
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Operational Troubleshoot Job Schedule - OUT</h3>
                    </div>
                    <div class="clearfix">
                        <div class="pull-right tableTools-container"></div>
                    </div>
                    <div class="table-responsive">
                        <table id="dynamic-table" class="table card-table table-vcenter text-nowrap datatable" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="w-1"><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select all invoices"></th>
                                    <th class="w-1">No.
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-dark icon-thick" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <polyline points="6 15 12 9 18 15" />
                                        </svg>
                                    </th>
                                    <th>Name</th>
                                    <th>Initial</th>
                                    <th>From Store</th>
                                    <?php
                                        if(session("filterapplied")) {
                                            $start = new DateTime(old('filter_start_date'));
                                            $end = new DateTime(old('filter_end_date'));
                                        }
                                        else {
                                            $start = new DateTime(date('Y-m-d'));
                                            $end = new DateTime(date('Y-m-d'));
                                            date_modify($end, '+1 month');
                                        }
                                        date_modify($end, '+1 day');
                                        $interval = new DateInterval('P1D');
                                        $period = new DatePeriod($start, $interval, $end);
                                        foreach($period as $dt) {
                                            echo "<th style='width:150px;'><input class='form-check-input m-0 align-middle' type='checkbox' aria-label='Select all invoices'> " . $dt->format('F d, Y') . " </th>";
                                        }
                                    ?>
                                    <th>Description</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $n = 1;
                                    $i = 1; 
                                    $skipcount = 0;
                                    $skipcounttmp = 0;
                                ?>
                                <?php foreach($getScheduleByStoreOut as $ts): ?>
                                    <?php
                                        if(session("filterapplied")) {
                                            $s = new DateTime(old('filter_start_date'));
                                            $e = new DateTime(old('filter_end_date'));
                                        }
                                        else {
                                            $s = new DateTime(date('Y-m-d'));
                                            $e = new DateTime(date('Y-m-d'));
                                            date_modify($e, '+1 month');
                                        }
                                        $xx = date_diff(date_create($ts['start_date']), $e)->format('%R%a');
                                        $yy = date_diff($s, date_create($ts['end_date']))->format('%R%a');
                                    ?>
                                    <?php if($xx >= 0 && $yy >= 0): ?>
                                        <?php if($skipcount == 0): ?>
                                            <?php
                                                $j = 1;
                                                foreach($getScheduleByStoreOut as $a) {
                                                    if(session("filterapplied")) {
                                                        $start = new DateTime(old('filter_start_date'));
                                                        $end = new DateTime(old('filter_end_date'));
                                                    }
                                                    else {
                                                        $start = new DateTime(date('Y-m-d'));
                                                        $end = new DateTime(date('Y-m-d'));
                                                        date_modify($end, '+1 month');
                                                    }
                                                    $x = date_diff(date_create($a['start_date']), $end)->format('%R%a');
                                                    $y = date_diff($start, date_create($a['end_date']))->format('%R%a');
                                                    if(($x >= 0 && $y >= 0) && ($j > $i) && ($a['worker_id'] == $ts['worker_id'])) {
                                                        $skipcount++;
                                                    }
                                                    $j++;
                                                }
                                                $skipcounttmp = $skipcount;
                                            ?>
                                            <tr>
                                                <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                                                <td><?= $n++; ?></td>
                                                <td><?= $ts['worker_name']; ?></td>
                                                <td><?= $ts['worker_init']; ?></td>
                                                <td><?= $ts['init_store_name']; ?></td>
                                                <?php
                                                    if(session("filterapplied")) {
                                                        $start = new DateTime(old('filter_start_date'));
                                                        $end = new DateTime(old('filter_end_date'));
                                                    }
                                                    else {
                                                        $start = new DateTime(date('Y-m-d'));
                                                        $end = new DateTime(date('Y-m-d'));
                                                        date_modify($end, '+1 month');
                                                    }
                                                    date_modify($end, '+1 day');
                                                    $interval = new DateInterval('P1D');
                                                    $period = new DatePeriod($start, $interval, $end);
                                                    foreach($period as $dt) {
                                                        $x = date_diff(date_create($ts['start_date']), $dt)->format('%R%a');
                                                        $y = date_diff($dt, date_create($ts['end_date']))->format('%R%a');
                                                        if($x >= 0 && $y >= 0) {
                                                            if($ts["status"] == 0) {
                                                                echo '<td>';
                                                                echo '<span class="badge bg-secondary">';
                                                                echo '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hourglass-split" viewBox="0 0 16 16">';
                                                                echo '<path d="M2.5 15a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1h-11zm2-13v1c0 .537.12 1.045.337 1.5h6.326c.216-.455.337-.963.337-1.5V2h-7zm3 6.35c0 .701-.478 1.236-1.011 1.492A3.5 3.5 0 0 0 4.5 13s.866-1.299 3-1.48V8.35zm1 0v3.17c2.134.181 3 1.48 3 1.48a3.5 3.5 0 0 0-1.989-3.158C8.978 9.586 8.5 9.052 8.5 8.351z"/>';
                                                                echo '</svg> ';
                                                            }
                                                            else {
                                                                if($ts["status"] == -1) {
                                                                    echo '<td>';
                                                                    echo '<span class="badge bg-danger">';
                                                                    echo '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">';
                                                                    echo '<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>';
                                                                    echo '<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>';
                                                                    echo '</svg> ';
                                                                }
                                                                else {
                                                                    echo '<td>';
                                                                    echo '<span class="badge bg-success">';
                                                                    echo '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-all" viewBox="0 0 16 16">';
                                                                    echo '<path d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l7-7zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0z"/>';
                                                                    echo '<path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708z"/>';
                                                                    echo '</svg> ';
                                                                }
                                                            }
                                                            echo $ts["dest_store_name"];
                                                            echo '</td>';
                                                        }
                                                        else {
                                                            $j = 1;
                                                            $tmp = -1;
                                                            foreach($getScheduleByStoreOut as $a) {
                                                                if(($j > $i) && ($a['worker_id'] == $ts['worker_id'])) {
                                                                    $x = date_diff(date_create($a['start_date']), $dt)->format('%R%a');
                                                                    $y = date_diff($dt, date_create($a['end_date']))->format('%R%a');
                                                                    if($x >= 0 && $y >= 0) {
                                                                        $tmp = $j;
                                                                        break;
                                                                    }
                                                                }
                                                                $j++;
                                                            }
                                                            if($tmp > 0) {
                                                                $j = 1;
                                                                foreach($getScheduleByStoreOut as $a) {
                                                                    if($tmp == $j) {
                                                                        if($a["status"] == 0) {
                                                                            echo '<td>';
                                                                            echo '<span class="badge bg-secondary">';
                                                                            echo '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hourglass-split" viewBox="0 0 16 16">';
                                                                            echo '<path d="M2.5 15a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1h-11zm2-13v1c0 .537.12 1.045.337 1.5h6.326c.216-.455.337-.963.337-1.5V2h-7zm3 6.35c0 .701-.478 1.236-1.011 1.492A3.5 3.5 0 0 0 4.5 13s.866-1.299 3-1.48V8.35zm1 0v3.17c2.134.181 3 1.48 3 1.48a3.5 3.5 0 0 0-1.989-3.158C8.978 9.586 8.5 9.052 8.5 8.351z"/>';
                                                                            echo '</svg> ';
                                                                        }
                                                                        else {
                                                                            if($a["status"] == -1) {
                                                                                echo '<td>';
                                                                                echo '<span class="badge bg-danger">';
                                                                                echo '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">';
                                                                                echo '<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>';
                                                                                echo '<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>';
                                                                                echo '</svg> ';
                                                                            }
                                                                            else {
                                                                                echo '<td>';
                                                                                echo '<span class="badge bg-success">';
                                                                                echo '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-all" viewBox="0 0 16 16">';
                                                                                echo '<path d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l7-7zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0z"/>';
                                                                                echo '<path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708z"/>';
                                                                                echo '</svg> ';
                                                                            }
                                                                        }
                                                                        echo $a["dest_store_name"];
                                                                        echo '</td>';
                                                                        break;
                                                                    }
                                                                    $j++;
                                                                }
                                                            }
                                                            else {
                                                                echo "<td>-</td>";
                                                            }
                                                        }
                                                    }
                                                ?>
                                                <td>
                                                    <?php
                                                        foreach($getScheduleByStoreOut as $a) {
                                                            if(session("filterapplied")) {
                                                                $start = new DateTime(old('filter_start_date'));
                                                                $end = new DateTime(old('filter_end_date'));
                                                            }
                                                            else {
                                                                $start = new DateTime(date('Y-m-d'));
                                                                $end = new DateTime(date('Y-m-d'));
                                                                date_modify($end, '+1 month');
                                                            }
                                                            $x = date_diff(date_create($a['start_date']), $end)->format('%R%a');
                                                            $y = date_diff($start, date_create($a['end_date']))->format('%R%a');
                                                            if(($x >= 0 && $y >= 0) && ($a['worker_id'] == $ts['worker_id'])) {
                                                                if($a['description'] != "") {
                                                                    if($a["status"] == 0) {
                                                                        echo '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hourglass-split" viewBox="0 0 16 16">';
                                                                        echo '<path d="M2.5 15a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1h-11zm2-13v1c0 .537.12 1.045.337 1.5h6.326c.216-.455.337-.963.337-1.5V2h-7zm3 6.35c0 .701-.478 1.236-1.011 1.492A3.5 3.5 0 0 0 4.5 13s.866-1.299 3-1.48V8.35zm1 0v3.17c2.134.181 3 1.48 3 1.48a3.5 3.5 0 0 0-1.989-3.158C8.978 9.586 8.5 9.052 8.5 8.351z"/>';
                                                                        echo '</svg> ';
                                                                    }
                                                                    else {
                                                                        if($a["status"] == -1) {
                                                                            echo '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">';
                                                                            echo '<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>';
                                                                            echo '<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>';
                                                                            echo '</svg> ';
                                                                        }
                                                                        else {
                                                                            echo '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-all" viewBox="0 0 16 16">';
                                                                            echo '<path d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l7-7zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0z"/>';
                                                                            echo '<path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708z"/>';
                                                                            echo '</svg> ';
                                                                        }
                                                                    }
                                                                    echo $a['description'];
                                                                    echo '<br>';
                                                                }
                                                            }
                                                        }
                                                    ?>
                                                </td>
                                                <td class="text-end">
                                                    <div class="row g-2 align-items-center mb-n3">
                                                        <div class="col-6 col-sm-4 col-md-2 col-xl-auto mb-3">
                                                            <a href="#myModalView<?= $i; ?>" class="btn btn-outline-primary w-100 btn-icon" aria-label="ViewData" data-bs-toggle="modal" data-bs-target="#modal-viewdata<?= $i; ?>">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                    <circle cx="10" cy="10" r="7"></circle>
                                                                    <line x1="7" y1="10" x2="13" y2="10"></line>
                                                                    <line x1="10" y1="7" x2="10" y2="13"></line>
                                                                    <line x1="21" y1="21" x2="15" y2="15"></line>
                                                                </svg>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php else: ?>
                                            <?php $skipcount--; ?>
                                        <?php endif; ?>
                                        <!-- Modal view data -->
                                        <div class="modal modal-blur fade" id="modal-viewdata<?= $i; ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">View Job Schedule Detail (<?= $skipcounttmp - $skipcount + 1; ?>/<?= $skipcounttmp + 1; ?>)</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-lg-4">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Start Date</label>
                                                                    <input type="text" class="form-control" placeholder="dd-mm-yyyy" value="<?= $ts['start_date']; ?>" disabled>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">From Store</label>
                                                                    <select class="form-select" disabled>
                                                                        <option selected><?= $ts['init_store_name']; ?></option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="mb-3">
                                                                    <label class="form-label">End Date</label>
                                                                    <input type="text" class="form-control" placeholder="dd-mm-yyyy" value="<?= $ts['end_date']; ?>" disabled>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">To Store</label>
                                                                    <select class="form-select" disabled>
                                                                        <option selected><?= $ts['dest_store_name']; ?></option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Description</label>
                                                                    <textarea class="form-control" rows="6" placeholder="No description" disabled><?= $ts['description']; ?></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="mb-3">
                                                                <label class="form-label">Name</label>
                                                                <select class="form-select" disabled>
                                                                    <option selected><?= $ts['worker_name']; ?></option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="mb-3">
                                                                <label class="form-label">Approval</label>
                                                                <input disabled type="text" class="form-control" value="<?php if($ts['status'] == 0) { echo 'Waiting for Approval'; } else { if($ts['status'] == 1) { echo 'Approved'; } else { echo 'Rejected'; } } ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <div class="row align-items-center">
                                                            <?php if($skipcount < $skipcounttmp): ?>
                                                                <div class="col">
                                                                    <a href="#myModalView<?= $i - 1; ?>" class="btn btn-outline-primary w-100 btn-icon" aria-label="ViewData" data-bs-toggle="modal" data-bs-target="#modal-viewdata<?= $i - 1; ?>">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                                                                            <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                                                                        </svg>
                                                                    </a>
                                                                </div>
                                                            <?php else: ?>
                                                                <!-- <div class="col">
                                                                    <a class="btn border-0 w-100 btn-icon bg-transparent pe-none">
                                                                        <svg opacity="0" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                                                                            <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                                                                        </svg>
                                                                    </a>
                                                                </div> -->
                                                            <?php endif; ?>
                                                            <?php if($skipcount > 0): ?>
                                                                <div class="col">
                                                                    <a href="#myModalView<?= $i + 1; ?>" class="btn btn-outline-primary w-100 btn-icon" aria-label="ViewData" data-bs-toggle="modal" data-bs-target="#modal-viewdata<?= $i + 1; ?>">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                                                            <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                                                                        </svg>
                                                                    </a>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                        <button class="btn btn-outline-secondary ms-auto" id="btnClose" name="btnClose" data-bs-dismiss="modal">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-door-exit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                <path d="M13 12v.01"></path>
                                                                <path d="M3 21h18"></path>
                                                                <path d="M5 21v-16a2 2 0 0 1 2 -2h7.5m2.5 10.5v7.5"></path>
                                                                <path d="M14 7h7m-3 -3l3 3l-3 3"></path>
                                                            </svg>
                                                            Close
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- <div class="card-body row align-items-center">
                        <div class="col"></div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-outline-success ms-auto" id="btnEditOut" name="btnEdtOut">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                    <path d="M16 5l3 3"></path>
                                </svg>
                                Edit
                            </button>
                            <button type="submit" class="btn btn-outline-danger ms-auto" id="btnDelete" name="btnDelete" data-bs-dismiss="modal">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <line x1="4" y1="7" x2="20" y2="7"></line>
                                    <line x1="10" y1="11" x2="10" y2="17"></line>
                                    <line x1="14" y1="11" x2="14" y2="17"></line>
                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                </svg>
                                Delete
                            </button>
                            <span style="padding-left: 15px; padding-right: 15px;"></span>
                            <button type="submit" class="btn btn-outline-primary ms-auto" id="btnSaveOut" name="btnSaveOut">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-refresh" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4"></path>
                                    <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4"></path>
                                </svg>
                                Save
                            </button>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section("scripts"); ?>

<script>
    $(document).ready(function() {
        const startDatePicker = new Litepicker({
            element: document.getElementById('filter_start_date'),
            buttonText: {
                previousMonth: `
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="15 6 9 12 15 18" /></svg>`,
                nextMonth: `
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="9 6 15 12 9 18" /></svg>`,
            },
            format: 'DD-MM-YYYY'
        });
        
        const endDatePicker = new Litepicker({
            element: document.getElementById('filter_end_date'),
            buttonText: {
                previousMonth: `
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="15 6 9 12 15 18" /></svg>`,
                nextMonth: `
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="9 6 15 12 9 18" /></svg>`,
            },
            format: 'DD-MM-YYYY'
        });
    })
</script>

<?= $this->endSection(); ?>