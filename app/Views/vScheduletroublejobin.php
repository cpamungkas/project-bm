<?= $this->extend('template_worker/index'); ?>
<?= $this->section('page-content'); ?>

<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- <h2 class="page-title">
                    Empty page
                </h2> -->
            </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <div class="row row-deck row-cards">
            <?php
            if (session("error")) { ?>
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
            if (session("success")) { ?>
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
                        <h3 class="card-title">Operational Troubleshoot Job Schedule - IN</h3>
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
                                        $start = new DateTime(date('Y-m-d'));
                                        $interval = new DateInterval('P1D');
                                        $end = new DateTime(date('Y-m-d'));
                                        date_modify($end, '+1 month');
                                        $period = new DatePeriod($start, $interval, $end);
                                        foreach($period as $dt) {
                                            echo "<th style='width:150px;'><input class='form-check-input m-0 align-middle' type='checkbox' aria-label='Select all invoices'> " . $dt->format('F d, Y') . " </th>";
                                        }
                                    ?>
                                    <th>Description</th>
                                    <th>Approval Status</th>
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
                                <?php foreach ($getScheduleByStoreIn as $ts) : ?>
                                    <?php if($skipcount == 0): ?>
                                        <tr>
                                            <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                                            <td><?= $n; ?></td>
                                            <td><?= $ts['worker_name']; ?></td>
                                            <td><?= $ts['worker_init']; ?></td>
                                            <td><?= $ts['init_store_name']; ?></td>
                                            <?php
                                                $start = new DateTime(date('Y-m-d'));
                                                $interval = new DateInterval('P1D');
                                                $end = new DateTime(date('Y-m-d'));
                                                date_modify($end, '+1 month');
                                                $period = new DatePeriod($start, $interval, $end);
                                                $p = 0;
                                                foreach($period as $dt) {
                                                    $x = date_diff(date_create($ts['start_date']), $dt)->format('%R%a');
                                                    $y = date_diff($dt, date_create($ts['end_date']))->format('%R%a');
                                                    if($x >= 0 && $y >= 0) {
                                                        echo "<td>" . $ts['dest_store_name'] . "</td>";
                                                    }
                                                    else {
                                                        $j = 1;
                                                        $tmp = -1;
                                                        $skipcount = 0;
                                                        foreach($getScheduleByStoreIn as $a) {
                                                            if(($j > $i) && ($a['worker_id'] == $ts['worker_id'])) {
                                                                $skipcount++;
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
                                                            foreach($getScheduleByStoreIn as $a) {
                                                                if($tmp == $j) {
                                                                    echo "<td>" . $a['dest_store_name'] . "</td>";
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
                                                    foreach($getScheduleByStoreIn as $a) {
                                                        if($a['worker_id'] == $ts['worker_id']) {
                                                            if($a['description'] != "") {
                                                                echo "<br>" . $a['description'];
                                                            }
                                                        }
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                    foreach($getScheduleByStoreIn as $a) {
                                                        if($a['worker_id'] == $ts['worker_id']) {
                                                            if($a['status'] == 1) {
                                                                echo "<br>Approved";
                                                            }
                                                            else {
                                                                if($a['status'] == -1) {
                                                                    echo "<br>Rejected";
                                                                }
                                                                else {
                                                                    echo "<br>Waiting for Approval";
                                                                }
                                                            }
                                                        }
                                                    }
                                                ?>
                                            </td>
                                            <td class="text-end">
                                                <div class="row g-2 align-items-center mb-n3">
                                                    <div class="col-6 col-sm-4 col-md-2 col-xl-auto mb-3">
                                                        <button href="#myModalApproveReject<?= $i; ?>" class="btn btn-outline-primary w-100 btn-icon" aria-label="ApproveRejectData" data-bs-toggle="modal" data-bs-target="#modal-approverejectdata<?= $i; ?>">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                <circle cx="10" cy="10" r="7"></circle>
                                                                <line x1="7" y1="10" x2="13" y2="10"></line>
                                                                <line x1="10" y1="7" x2="10" y2="13"></line>
                                                                <line x1="21" y1="21" x2="15" y2="15"></line>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php 
                                            $n++;
                                            $skipcounttmp = $skipcount;
                                        ?>
                                    <?php else: ?>
                                        <?php $skipcount--; ?>
                                    <?php endif; ?>
                                    <!-- Modal approve/reject data -->
                                    <div class="modal modal-blur fade" id="modal-approverejectdata<?= $i; ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                                        <form id="approverejectscheduleForm" action="<?php echo base_url('troublejobin/approverejectschedule/' . $ts['id']); ?>" method="post" class="needs-validation" novalidate>
                                            <div class="modal-dialog modal-lg modal-dialog-centered" role="dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Approve/Reject Job Schedule (<?= $skipcounttmp - $skipcount + 1; ?>/<?= $skipcounttmp + 1; ?>)</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-lg-4">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Start Date</label>
                                                                    <input type="text" name="modalapproverejectstartdate" id="modalapproverejectstartdate" class="form-control" placeholder="dd-mm-yyyy" value="<?= $ts['start_date']; ?>" disabled>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">From Store</label>
                                                                    <select class="form-select" disabled>
                                                                        <option selected><?= $ts['init_store_name']; ?></option>
                                                                    </select>
                                                                    <input name="modalapproverejectinitstore" id="modalapproverejectinitstore" type="hidden" value="<?= $ts['init_store_id']; ?>">
                                                                </div>                                                                
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="mb-3">
                                                                    <label class="form-label">End Date</label>
                                                                    <input type="text" name="modalapproverejectenddate" id="modalapproverejectenddate" class="form-control" placeholder="dd-mm-yyyy" value="<?= $ts['end_date']; ?>" disabled>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">To Store</label>
                                                                    <select class="form-select" disabled>
                                                                        <option selected><?= $ts['dest_store_name']; ?></option>
                                                                    </select>
                                                                    <input name="modalapproverejectdeststore" id="modalapproverejectdeststore" type="hidden" value="<?= $ts['dest_store_id']; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Description</label>
                                                                    <textarea name="modalapproverejectdescription" id="modalapproverejectdescription" class="form-control" name="example-textarea-input" rows="6" placeholder="No description" disabled><?= $ts['description']; ?></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="mb-3">
                                                                <label class="form-label">Name</label>
                                                                <select class="form-select" disabled>
                                                                    <option selected><?= $ts['worker_name']; ?></option>
                                                                </select>
                                                                <input name="modalapproverejectworker" id="modalapproverejectworker" type="hidden" value="<?= $idstore; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="mb-3">
                                                                <label class="form-label">Approval</label>
                                                                <select class="form-select" id="modalapproverejectdescription" name="modalapproverejectdescription" <?php if($ts['status'] == 0) {echo 'required';} else {echo 'disabled';} ?>>
                                                                    <option value="" <?php if($ts['status'] == 0) {echo 'selected';} ?>>Select Approval Status</option>
                                                                    <option value="1" <?php if($ts['status'] == 1) {echo 'selected';} ?>>Accept</option>
                                                                    <option value="-1" <?php if($ts['status'] == -1) {echo 'selected';} ?>>Reject</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <div class="row align-items-center">
                                                            <?php if($skipcount < $skipcounttmp): ?>
                                                                <div class="col">
                                                                    <a href="#myModalApproveReject<?= $i - 1; ?>" class="btn btn-outline-primary w-100 btn-icon" aria-label="ViewData" data-bs-toggle="modal" data-bs-target="#modal-approverejectdata<?= $i - 1; ?>">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                                                                            <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                                                                        </svg>
                                                                    </a>
                                                                </div>
                                                            <?php endif; ?>
                                                            <?php if($skipcount > 0): ?>
                                                                <div class="col">
                                                                    <a href="#myModalApproveReject<?= $i + 1; ?>" class="btn btn-outline-primary w-100 btn-icon" aria-label="ViewData" data-bs-toggle="modal" data-bs-target="#modal-approverejectdata<?= $i + 1; ?>">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                                                            <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                                                                        </svg>
                                                                    </a>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="row align-items-center">
                                                            <div class="col-auto">
                                                                <?php if($ts['status'] == 0): ?>
                                                                    <button type="submit" class="btn btn-outline-primary ms-auto" id="btnApproveDeleteSchedule" name="btnApproveDeleteSchedule" data-bs-dismiss="modal" data-id="<?= $ts['id']; ?>">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-upload" viewBox="0 0 16 16">
                                                                            <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                                                            <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z"/>
                                                                        </svg>
                                                                        <div style="padding-right: 10px;"></div>
                                                                        Submit
                                                                    </button>
                                                                <?php endif; ?>
                                                                <a class="btn btn-outline-secondary ms-auto" id="btnClose" name="btnClose" data-bs-dismiss="modal">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-door-exit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                        <path d="M13 12v.01"></path>
                                                                        <path d="M3 21h18"></path>
                                                                        <path d="M5 21v-16a2 2 0 0 1 2 -2h7.5m2.5 10.5v7.5"></path>
                                                                        <path d="M14 7h7m-3 -3l3 3l-3 3"></path>
                                                                    </svg>
                                                                    Close
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Job Schedule Detail</h3>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-3 col-form-label">Start Date</label>
                                        <div class="col">
                                            <div class="input-icon mb-2">
                                                <input class="form-control " placeholder="Select a date" id="datepicker-icon" readonly value="<?= date('d-m-Y'); ?>" required>
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
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-3 col-form-label">From Store</label>
                                        <div class="col">
                                            <div class="form-floating">
                                                <select class="form-select" aria-label="Floating label select example" disabled>
                                                    <option selected><?= $location; ?></option>
                                                </select>
                                                <label for="floatingSelect">Select store</label>
                                            </div>
                                        </div>
                                        <input type="hidden" id="init_store" name="init_store" value="<?= $idstore; ?>">
                                    </div>
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-3 col-form-label">Name</label>
                                        <div class="col">
                                            <div class="form-floating">
                                                <select class="form-select" aria-label="Floating label select example" disabled>
                                                    <option selected><?= $name; ?></option>
                                                </select>
                                                <label for="floatingSelect">Select worker</label>
                                            </div>
                                        </div>
                                        <input type="hidden" id="worker_id" name="worker_id" value="<?= $name; ?>">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-3 col-form-label">End Date</label>
                                        <div class="col">
                                            <div class="input-icon mb-2">
                                                <input class="form-control " placeholder="Select a date" id="datepicker-icon" value="<?= date('d-m-Y'); ?>" readonly>
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
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-3 col-form-label">To Store</label>
                                        <div class="col">
                                            <div class="form-floating">
                                                <select class="form-select" aria-label="Floating label select example" disabled>
                                                    <option selected><?= $location; ?></option>
                                                </select>
                                                <label for="floatingSelect">Select store</label>
                                            </div>
                                        </div>
                                        <input type="hidden" id="dest_store" name="dest_store" value="<?= $idstore; ?>">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label">Description </label>
                                        <textarea class="form-control" name="example-textarea-input" rows="6" placeholder="Content.." readonly></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-footer">
                                <div class="row align-items-center">
                                    <div class="col"></div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-outline-primary ms-auto" id="btnSubmitShift" name="btnSubmitShift">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                            </svg>
                                            Approve
                                        </button>
                                        <button type="reset" class="btn btn-outline-secondary ms-auto" id="btnReset" name="btnReset">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eraser" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M19 20h-10.5l-4.21 -4.3a1 1 0 0 1 0 -1.41l10 -10a1 1 0 0 1 1.41 0l5 5a1 1 0 0 1 0 1.41l-9.2 9.3"></path>
                                                <path d="M18 13.3l-6.3 -6.3"></path>
                                            </svg>
                                            Reject
                                        </button>
                                        <button type="reset" class="btn btn-outline-secondary ms-auto" id="btnReset" name="btnReset">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eraser" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M19 20h-10.5l-4.21 -4.3a1 1 0 0 1 0 -1.41l10 -10a1 1 0 0 1 1.41 0l5 5a1 1 0 0 1 0 1.41l-9.2 9.3"></path>
                                                <path d="M18 13.3l-6.3 -6.3"></path>
                                            </svg>
                                            Submit
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div> -->
        </div>
    </div>
</div>

<?= $this->endSection(); ?>