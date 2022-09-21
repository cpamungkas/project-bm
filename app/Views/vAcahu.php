<?= $this->extend('template_worker/index'); ?>

<?= $this->section('page-content'); ?>

<div class="page-body">
    <div class="container-xl">
        <div class="row row-deck row-cards">
            <?php if(session("error")) { ?>
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

            <?php if(session("success")) { ?>
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
                        <h3 class="card-title">AC AHU</h3>
                    </div>
                    
                    <div class="card-body">
                        <form action="<?php echo base_url('acahu/saveAcAhu'); ?>" method="post">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-4 col-form-label">Location</label>
                                        <div class="col">
                                            <div class="input-icon mb-2">
                                                <input class="form-control" value="<?= $location ?>" disabled >
                                                <input id="location" name="location" class="form-control" value="<?= $idstore; ?>" hidden >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-4 col-form-label">Date</label>
                                        <div class="col">
                                            <div class="input-icon mb-2">
                                                <input class="form-control" value="<?= date('d-m-Y'); ?>" disabled>
                                                <input id="date" name="date" class="form-control" value="<?= date('d-m-Y'); ?>" hidden>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-4">Time</label>
                                        <div class="col">
                                            <div>
                                                <?php
                                                    $time1 = 0;
                                                    $time2 = 0;

                                                    foreach($getAcAhuByStoreDate as $t) {
                                                        if(strval($t['time']) == "10:00:00") {
                                                            $time1++;
                                                        }

                                                        if(strval($t['time']) == "19:00:00") {
                                                            $time2++;
                                                        }
                                                    }
                                                ?>

                                                <input <?php if($time1 == 21) { echo("disabled"); } ?><?php if(old('time') == "10:00:00") { echo("checked"); } ?> id="time" name="time" type="checkbox" class="timechecks timechecks10 <?= ($validation->hasError('time')) ? 'is-invalid' : ''; ?>" onclick="checkTime(this.value);" value="10:00:00">
                                                <span <?php if($time1 == 21) { echo("style='opacity: 50%;'"); } ?>>10.00</span>
                                                
                                                <span style="padding-left: 20px;"></span>
                                                
                                                <input <?php if($time2 == 21) { echo("disabled"); } ?><?php if(old('time') == "19:00:00") { echo("checked"); } ?> id="time" name="time" type="checkbox" class="timechecks timechecks19 <?= ($validation->hasError('time')) ? 'is-invalid' : ''; ?>" onclick="checkTime(this.value);" value="19:00:00">
                                                <span <?php if($time2 == 21) { echo("style='opacity: 50%;'"); } ?>>19.00</span>
                                                
                                                <?php if($validation->hasError('time')): ?>
                                                    <div class="invalid-feedback" style="white-space: normal;">
                                                        <?= $validation->getError('time'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <script>
                                                function checkTime(b){
                                                    var x = document.getElementsByClassName('timechecks');
                                                    var i;

                                                    for(i = 0; i < x.length; i++) {
                                                        if(x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-4 col-form-label">Worker</label>
                                        <div class="col">
                                            <div class="input-icon mb-2">
                                                <input class="form-control" value="<?= $name ?>" disabled >
                                                <input id="worker" name="worker" class="form-control" value="<?= $id ?>" hidden >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-4 col-form-label">Checklist</label>
                                        <div class="col">
                                            <div class="input-icon mb-2">
                                                <input class="form-control" value="Daily" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                            <div style="width: 100%; border-top: 1px solid lightgrey; height: 0; margin-top: 20px; margin-bottom: 20px;"></div>
                                                    
                            <div class="table-responsive">
                                <table class="table table-bordered card-table table-vcenter text-nowrap datatable" style="width:100%">
                                    <tbody>
                                        <tr style="border: 0;">
                                            <td style="border: 0;"></td>
                                            <td style="border: 0;"></td>
                                            <td style="border: 0;"></td>
                                            <td style="border: 0;"></td>
                                        </tr>

                                        <tr>
                                            <td rowspan="7" style="padding-right: 30px;">
                                                <select name="ahu" id="ahu" class="form-select <?= ($validation->hasError('ahu')) ? 'is-invalid' : ''; ?>">
                                                    <?php for($i = 1; $i <= 21; $i++): ?>
                                                        <option <?php if(old('ahu') == $i) { echo('selected'); } ?> value="<?= $i ?>">
                                                            AHU No. <?= $i ?>
                                                        </option>
                                                    <?php endfor; ?>
                                                </select>
                                                <?php if($validation->hasError('ahu')): ?>
                                                    <div class="invalid-feedback" style="white-space: normal;">
                                                        <?= $validation->getError('ahu'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <td rowspan="2">Water Pressure</td>
                                            <td>In<br>0.5 - 2.5 BAR</td>
                                            <td>
                                                <input id="pres_in" name="pres_in" class="form-control <?= ($validation->hasError('pres_in')) ? 'is-invalid' : ''; ?>" value="<?= old('pres_in'); ?>">
                                                <?php if($validation->hasError('pres_in')): ?>
                                                    <div class="invalid-feedback" style="white-space: normal;">
                                                        <?= $validation->getError('pres_in'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding-left: 8px;">Out<br>0.5 - 1.5 BAR</td>
                                            <td>
                                                <input id="pres_out" name="pres_out" class="form-control <?= ($validation->hasError('pres_out')) ? 'is-invalid' : ''; ?>" value="<?= old('pres_out'); ?>">
                                                <?php if($validation->hasError('pres_out')): ?>
                                                    <div class="invalid-feedback" style="white-space: normal;">
                                                        <?= $validation->getError('pres_out'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td rowspan="2" style="padding-left: 8px;">Water Temp.</td>
                                            <td>In<br>14&deg;C - 18&deg;C</td>
                                            <td>
                                                <input id="temp_in" name="temp_in" class="form-control <?= ($validation->hasError('temp_in')) ? 'is-invalid' : ''; ?>" value="<?= old('temp_in'); ?>">
                                                <?php if($validation->hasError('temp_in')): ?>
                                                    <div class="invalid-feedback" style="white-space: normal;">
                                                        <?= $validation->getError('temp_in'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding-left: 8px;">Out<br>16&deg;C - 22&deg;C</td>
                                            <td>
                                                <input id="temp_out" name="temp_out" class="form-control <?= ($validation->hasError('temp_out')) ? 'is-invalid' : ''; ?>" value="<?= old('temp_out'); ?>">
                                                <?php if($validation->hasError('temp_out')): ?>
                                                    <div class="invalid-feedback" style="white-space: normal;">
                                                        <?= $validation->getError('temp_out'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td rowspan="3" style="padding-left: 8px;">
                                                Action
                                                <?php if($validation->hasError('action')): ?>
                                                    <div style="font-size: 85.71428571%; color: #d63939; white-space: normal;">
                                                        <?= $validation->getError('action'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <td>Fan</td>
                                            <td><input <?php if(old('action') == "1") { echo("checked"); } ?> id="action" name="action" type="checkbox" class="actionchecks <?= ($validation->hasError('action')) ? 'is-invalid' : ''; ?>" onclick="checkAction(this.value);" value="1"></td>
                                        </tr>
                                        <tr>
                                            <td style="padding-left: 8px;">Comp</td>
                                            <td><input <?php if(old('action') == "2") { echo("checked"); } ?> id="action" name="action" type="checkbox" class="actionchecks <?= ($validation->hasError('action')) ? 'is-invalid' : ''; ?>" onclick="checkAction(this.value);" value="2"></td>
                                        </tr>
                                        <tr>
                                            <td style="padding-left: 8px;">Off</td>
                                            <td><input <?php if(old('action') == "3") { echo("checked"); } ?> id="action" name="action" type="checkbox" class="actionchecks <?= ($validation->hasError('action')) ? 'is-invalid' : ''; ?>" onclick="checkAction(this.value);" value="3"></td>
                                        </tr>
                                        <script>
                                            function checkAction(b){
                                                var x = document.getElementsByClassName('actionchecks');
                                                var i;

                                                for (i = 0; i < x.length; i++) {
                                                    if(x[i].value != b) x[i].checked = false;
                                                }
                                            }
                                        </script>

                                        <tr style="border: 0;">
                                            <td style="border: 0;"></td>
                                            <td style="border: 0;"></td>
                                            <td style="border: 0;"></td>
                                            <td style="border: 0;"></td>
                                        </tr>
                                        <!-- <tr>
                                            <td rowspan="4">Suhu Area Rata-Rata<br>24&deg;C - 26&deg;C</td>
                                            <td colspan="2">Lantai 1</td>
                                            <td>
                                                <input id="tn" name="tn" class="form-control <?= ($validation->hasError('tn')) ? 'is-invalid' : ''; ?>" value="<?= old('tn'); ?>">
                                                <?php if($validation->hasError('tn')): ?>
                                                    <div class="invalid-feedback" style="white-space: normal;">
                                                        <?= $validation->getError('tn'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="padding-left: 8px;">Lantai 2</td>
                                            <td>
                                                <input id="tn" name="tn" class="form-control <?= ($validation->hasError('tn')) ? 'is-invalid' : ''; ?>" value="<?= old('tn'); ?>">
                                                <?php if($validation->hasError('tn')): ?>
                                                    <div class="invalid-feedback" style="white-space: normal;">
                                                        <?= $validation->getError('tn'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="padding-left: 8px;">Lantai 3</td>
                                            <td>
                                                <input id="tn" name="tn" class="form-control <?= ($validation->hasError('tn')) ? 'is-invalid' : ''; ?>" value="<?= old('tn'); ?>">
                                                <?php if($validation->hasError('tn')): ?>
                                                    <div class="invalid-feedback" style="white-space: normal;">
                                                        <?= $validation->getError('tn'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="padding-left: 8px;">Lantai 4</td>
                                            <td>
                                                <input id="tn" name="tn" class="form-control <?= ($validation->hasError('tn')) ? 'is-invalid' : ''; ?>" value="<?= old('tn'); ?>">
                                                <?php if($validation->hasError('tn')): ?>
                                                    <div class="invalid-feedback" style="white-space: normal;">
                                                        <?= $validation->getError('tn'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <tr style="border: 0;">
                                            <td style="border: 0;"></td>
                                            <td style="border: 0;"></td>
                                            <td style="border: 0;"></td>
                                            <td style="border: 0;"></td>
                                        </tr> -->
                                    </tbody>
                                </table>
                            </div>

                            <div class="form-footer">
                                <div class="row align-items-center">
                                    <div class="col"></div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-outline-primary ms-auto" id="btnSubmitAcAhu" name="btnSubmitAcAhu">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                            </svg>
                                            Add
                                        </button>
                                        <button type="reset" class="btn btn-outline-secondary ms-auto" id="btnReset" name="btnReset">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eraser" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M19 20h-10.5l-4.21 -4.3a1 1 0 0 1 0 -1.41l10 -10a1 1 0 0 1 1.41 0l5 5a1 1 0 0 1 0 1.41l-9.2 9.3"></path>
                                                <path d="M18 13.3l-6.3 -6.3"></path>
                                            </svg>
                                            Clear
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
                        <h3 class="card-title">AC AHU Data</h3>
                    </div>

                    <div class="clearfix">
                        <div class="pull-right tableTools-container"></div>
                    </div>

                    <div class="table-responsive">
                        <table id="dynamic-table" class="table card-table table-vcenter text-nowrap datatable" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="w-1">No.</th>
                                    <th>Location</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Worker</th>
                                    <?php for($k = 1; $k <= 21; $k++): ?>
                                        <th>AHU NO. <?= $k ?><br>Water Pressure<br>In<br>0.5 - 2.5 BAR</th>
                                        <th>AHU NO. <?= $k ?><br>Water Pressure<br>Out<br>0.5 - 1.5 BAR</th>
                                        <th>AHU NO. <?= $k ?><br>Water Temperature<br>In<br>14&deg;C - 18&deg;C</th>
                                        <th>AHU NO. <?= $k ?><br>Water Temperature<br>Out<br>16&deg;C - 22&deg;C</th>
                                        <th>Action</th>
                                    <?php endfor; ?>

                                    <th class="text-end">Option</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php 
                                    $n = 1;
                                    $i = 1; 
                                    $skipcount = 0;
                                    $skipcounttmp = 0;
                                ?>
                                <?php foreach($getAcAhuByStore as $t): ?>
                                    <?php if($skipcount == 0): ?>
                                        <?php
                                            $j = 1;
                                            foreach($getAcAhuByStore as $a) {
                                                if(($j > $i) && ($a['date'] == $t['date']) && ($a['time'] == $t['time'])) {
                                                    $skipcount++;
                                                }
                                                $j++;
                                            }
                                            $skipcounttmp = $skipcount;
                                        ?>

                                        <?php
                                            $date = new DateTime($t['date']);
                                            $time = new DateTime($t['time']);                           
                                        ?>

                                        <tr>
                                            <td><?= $n++ ?></td>

                                            <td><?= $t['store_name'] ?></td>
                                            <td><?= $date->format('j F Y') ?></td>
                                            <td><?= $time->format('H.i') ?></td>
                                            <td><?= $t['worker_name'] ?></td>

                                            <?php for($k = 1; $k <= 21; $k++): ?>
                                                <?php if($t['ahu'] == $k): ?>
                                                    <td><?= $t['pres_in'] ?></td>
                                                    <td><?= $t['pres_out'] ?></td>
                                                    <td><?= $t['temp_in'] ?></td>
                                                    <td><?= $t['temp_out'] ?></td>
                                                    <td>
                                                        <?php
                                                            if($t['action'] == 1) {
                                                                echo("Fan");
                                                            }
                                                            else {
                                                                if($t['action'] == 2) {
                                                                    echo("Comp");
                                                                }
                                                                else {
                                                                    echo("Off");
                                                                }
                                                            }
                                                        ?>
                                                    </td>
                                                <?php else: ?>
                                                    <?php
                                                        $j = 1;
                                                        $tmp = -1;
                                                        foreach($getAcAhuByStore as $a) {
                                                            if(($j > $i) && ($a['date'] == $t['date']) && ($a['time'] == $t['time']) && ($a['ahu'] == $k)) {
                                                                $tmp = $j;
                                                                break;
                                                            }
                                                            $j++;
                                                        }
                                                        if($tmp > 0) {
                                                            $j = 1;
                                                            foreach($getAcAhuByStore as $a) {
                                                                if($tmp == $j) {
                                                                    echo("<td>" . $a['pres_in'] . "</td>");
                                                                    echo("<td>" . $a['pres_out'] . "</td>");
                                                                    echo("<td>" . $a['temp_in'] . "</td>");
                                                                    echo("<td>" . $a['temp_out'] . "</td>");
                                                                    echo("<td>");
                                                                    if($a['action'] == 1) {
                                                                        echo("Fan");
                                                                    }
                                                                    else {
                                                                        if($t['action'] == 2) {
                                                                            echo("Comp");
                                                                        }
                                                                        else {
                                                                            echo("Off");
                                                                        }
                                                                    }
                                                                    echo("</td>");

                                                                    break;
                                                                }

                                                                $j++;
                                                            }
                                                        }
                                                        else {
                                                            echo "<td>-</td>";
                                                            echo "<td>-</td>";
                                                            echo "<td>-</td>";
                                                            echo "<td>-</td>";
                                                            echo "<td>-</td>";
                                                        }
                                                    ?>
                                                <?php endif; ?>
                                            <?php endfor; ?>
                                            
                                            <td class="text-end">
                                                <div class="row g-2 align-items-center mb-n3">
                                                    <div class="col-6 col-sm-4 col-md-2 col-xl-auto mb-3">
                                                        <button href="#myModalEdit<?= $i; ?>" id="btnModalEdit<?= $t['id']; ?>" data-bs-toggle="modal" data-bs-target="#modal-editdata<?= $i; ?>" class="btn btn-outline-success w-100 btn-icon btn-edit">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                                                <path d="M16 5l3 3"></path>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                    <div class="col-6 col-sm-4 col-md-2 col-xl-auto mb-3">
                                                        <button href="#myModalDelete<?= $i; ?>" class="btn btn-outline-danger w-100 btn-icon" aria-label="DeleteData" data-bs-toggle="modal" data-bs-target="#modal-deletedata<?= $i; ?>">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                <line x1="4" y1="7" x2="20" y2="7"></line>
                                                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php else: ?>
                                        <?php $skipcount--; ?>
                                    <?php endif; ?>

                                    <!-- Modal edit data -->
                                    <div class="modal modal-blur fade" id="modal-editdata<?= $i; ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                                        <form id="editAcAhuForm" action="<?php echo base_url('acahu/updateAcAhu/' . $t['id']); ?>" method="post">
                                            <div class="modal-dialog modal-lg modal-dialog-centered" role="dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit AC AHU Data (<?= $skipcounttmp - $skipcount + 1; ?>/<?= $skipcounttmp + 1; ?>)</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <input type="text" class="form-control" id="editid" name="editid" value="<?= $t['id']; ?>" hidden>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Location</label>
                                                                    <input type="text" class="form-control" value="<?= $location ?>" disabled>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Date</label>
                                                                    <input type="text" class="form-control" placeholder="dd-mm-yyyy" value="<?= $t['date']; ?>" disabled>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <?php
                                                                        $time1 = 0;
                                                                        $time2 = 0;

                                                                        foreach($getAcAhuByStoreDate as $tt) {
                                                                            if($tt['date'] == $t['date']) {
                                                                                if(strval($tt['time']) == "10:00:00") {
                                                                                    $time1++;
                                                                                }

                                                                                if(strval($tt['time']) == "19:00:00") {
                                                                                    $time2++;
                                                                                }
                                                                            }
                                                                        }
                                                                    ?>

                                                                    <label class="form-label">Time</label>
                                                                    
                                                                    <input <?php if(strval($t['time']) == "10:00:00") { echo("checked"); } else { if($time1 == 21) { echo("disabled"); } } ?> data-id="<?= $i ?>" data-date="<?= $t['date']; ?>" data-dataid="<?= $t['id']; ?>" data-ahu="<?= $t['ahu']; ?>" id="edittime" name="edittime" type="checkbox" class="edittimechecks<?= $i; ?> edittimechecks_10 <?= (($t['id'] == old('editid')) && ($validation->hasError('edittime'))) ? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditTime' . $i . '(this.value)' ?>;" value="10:00:00">
                                                                    <span <?php if((strval($t['time']) != "10:00:00") && ($time1 == 21)) { echo("style='opacity: 50%;'"); } ?>>10.00</span>
                                                                    
                                                                    <span style="padding-left: 20px;"></span>
                                                                    
                                                                    <input <?php if(strval($t['time']) == "19:00:00") { echo("checked"); } else { if($time2 == 21) { echo("disabled"); } } ?> data-id="<?= $i ?>" data-date="<?= $t['date']; ?>" data-dataid="<?= $t['id']; ?>" data-ahu="<?= $t['ahu']; ?>" id="edittime" name="edittime" type="checkbox" class="edittimechecks<?= $i; ?> edittimechecks_19 <?= (($t['id'] == old('editid')) && ($validation->hasError('edittime'))) ? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditTime' . $i . '(this.value)' ?>;" value="19:00:00">
                                                                    <span <?php if((strval($t['time']) != "19:00:00") && ($time2 == 21)) { echo("style='opacity: 50%;'"); } ?>>19.00</span>
                                                                    
                                                                    <?php if($validation->hasError('edittime')): ?>
                                                                        <div class="invalid-feedback">
                                                                            <?= $validation->getError('edittime'); ?>
                                                                        </div>
                                                                    <?php endif; ?>

                                                                    <script>
                                                                        function checkEditTime<?= $i ?>(b){
                                                                            var x = document.getElementsByClassName('edittimechecks<?= $i ?>');
                                                                            var y;

                                                                            for(y = 0; y < x.length; y++) {
                                                                                if(x[y].value != b) x[y].checked = false;
                                                                            }
                                                                        }
                                                                    </script>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Worker</label>
                                                                    <input type="text" class="form-control" value="<?= $name; ?>*" disabled>
                                                                    <input type="text" class="form-control" id="editworker" name="editworker" value="<?= $id; ?>" hidden>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Checklist</label>
                                                                    <input type="text" class="form-control" value="Daily" disabled>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6">
                                                                <div style="padding: 10px; background-color: aliceblue;">
                                                                    <div class="mb-3">
                                                                        <div class='row' style="margin: 0px;">
                                                                            <select name="editahu" id="editahu" class="editahu<?= $i ?> form-select <?= (($t['id'] == old('editid')) && ($validation->hasError('editahu'))) ? 'is-invalid' : ''; ?>" aria-label="Floating label select example">
                                                                                <?php for($m = 1; $m <= 21; $m++): ?>
                                                                                    <?php
                                                                                        $ahu = 0;
                                                                                        foreach($getAcAhuByStore as $tt) {
                                                                                            if(($tt['id'] != $t['id']) && ($tt['date'] == $t['date']) && ($tt['time'] == $t['time']) && ($tt['ahu'] == $m)) {
                                                                                                $ahu = 1;
                                                                                                break;
                                                                                            }
                                                                                        }
                                                                                    ?>
                                                                                    <?php if(!$ahu): ?>
                                                                                        <option <?php if($t['ahu'] == $m) { echo('selected'); } ?> value="<?= $m ?>">
                                                                                            AHU No. <?= $m ?>
                                                                                        </option>
                                                                                    <?php endif; ?>
                                                                                <?php endfor; ?>
                                                                            </select>
                                                                        </div>
                                                                        <?php if(($t['id'] == old('editid')) && ($validation->hasError('editahu'))): ?>
                                                                            <div style="font-size: 85.71428571%; color: #d63939;">
                                                                                <?= $validation->getError('editahu'); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Water Pressure In 0.5 - 2.5 BAR</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editpresin'))) ? 'is-invalid' : ''; ?>" id="editpresin" name="editpresin" value="<?= $t['pres_in']; ?>">
                                                                            <label class="form-label col-2" style="margin-top: auto; margin-bottom: auto;">&deg;C</label>
                                                                        </div>
                                                                        <?php if(($t['id'] == old('editid')) && ($validation->hasError('editpresin'))): ?>
                                                                            <div style="font-size: 85.71428571%; color: #d63939;">
                                                                                <?= $validation->getError('editpresin'); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Water Pressure Out 0.5 - 1.5 BAR</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editpresout'))) ? 'is-invalid' : ''; ?>" id="editpresout" name="editpresout" value="<?= $t['pres_out']; ?>">
                                                                            <label class="form-label col-2" style="margin-top: auto; margin-bottom: auto;">&deg;C</label>
                                                                        </div>
                                                                        <?php if(($t['id'] == old('editid')) && ($validation->hasError('editpresout'))): ?>
                                                                            <div style="font-size: 85.71428571%; color: #d63939;">
                                                                                <?= $validation->getError('editpresout'); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Water Temperature In 14&deg;C - 18&deg;C</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('edittempin'))) ? 'is-invalid' : ''; ?>" id="edittempin" name="edittempin" value="<?= $t['temp_in']; ?>">
                                                                            <label class="form-label col-2" style="margin-top: auto; margin-bottom: auto;">&deg;C</label>
                                                                        </div>
                                                                        <?php if(($t['id'] == old('editid')) && ($validation->hasError('edittempin'))): ?>
                                                                            <div style="font-size: 85.71428571%; color: #d63939;">
                                                                                <?= $validation->getError('edittempin'); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Water Temperature Out 16&deg;C - 22&deg;C</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('edittempout'))) ? 'is-invalid' : ''; ?>" id="edittempout" name="edittempout" value="<?= $t['temp_out']; ?>">
                                                                            <label class="form-label col-2" style="margin-top: auto; margin-bottom: auto;">&deg;C</label>
                                                                        </div>
                                                                        <?php if(($t['id'] == old('editid')) && ($validation->hasError('edittempout'))): ?>
                                                                            <div style="font-size: 85.71428571%; color: #d63939;">
                                                                                <?= $validation->getError('edittempout'); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Action</label>

                                                                        <input <?php if($t['action'] == 1) { echo("checked"); } ?> id="editaction" name="editaction" type="checkbox" class="editactionchecks<?= $i; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editaction')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditAction' . $i . '(this.value)' ?>;" value="1">
                                                                        <span>Fan</span>
                                                                        
                                                                        <span style="padding-left: 20px;"></span>
                                                                        
                                                                        <input <?php if($t['action'] == 2) { echo("checked"); } ?> id="editaction" name="editaction" type="checkbox" class="editactionchecks<?= $i; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editaction')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditAction' . $i . '(this.value)' ?>;" value="2">
                                                                        <span>Comp</span>

                                                                        <span style="padding-left: 20px;"></span>
                                                                        
                                                                        <input <?php if($t['action'] == 3) { echo("checked"); } ?> id="editaction" name="editaction" type="checkbox" class="editactionchecks<?= $i; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editaction')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditAction' . $i . '(this.value)' ?>;" value="3">
                                                                        <span>Off</span>
                                                                        
                                                                        <?php if($validation->hasError('editaction')): ?>
                                                                            <div class="invalid-feedback" style="white-space: normal;">
                                                                                <?= $validation->getError('editaction'); ?>
                                                                            </div>
                                                                        <?php endif; ?>

                                                                        <script>
                                                                            function checkEditAction<?= $i ?>(b){
                                                                                var x = document.getElementsByClassName('editactionchecks<?= $i ?>');
                                                                                var y;

                                                                                for(y = 0; y < x.length; y++) {
                                                                                    if(x[y].value != b) x[y].checked = false;
                                                                                }
                                                                            }
                                                                        </script>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer justify-content-between">
                                                        <div class="row align-items-center">
                                                            <?php if($skipcount < $skipcounttmp): ?>
                                                                <div class="col">
                                                                    <a href="#myModalEdit<?= $i - 1; ?>" class="btn btn-outline-primary w-100 btn-icon" aria-label="ViewData" data-bs-toggle="modal" data-bs-target="#modal-editdata<?= $i - 1; ?>">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                                                                            <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                                                                        </svg>
                                                                    </a>
                                                                </div>
                                                            <?php endif; ?>
                                                            <?php if($skipcount > 0): ?>
                                                                <div class="col">
                                                                    <a href="#myModalEdit<?= $i + 1; ?>" class="btn btn-outline-primary w-100 btn-icon" aria-label="ViewData" data-bs-toggle="modal" data-bs-target="#modal-editdata<?= $i + 1; ?>">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                                                            <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                                                                        </svg>
                                                                    </a>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="row align-items-center">
                                                            <div class="col"></div>
                                                            <div class="col-auto">
                                                                <button type="submit" class="btn btn-outline-primary ms-auto" id="btnUpdateAcAhu" name="btnUpdateAcAhu" data-bs-dismiss="modal" data-id="<?= $t['id']; ?>">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-refresh" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                        <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4"></path>
                                                                        <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4"></path>
                                                                    </svg>
                                                                    Save
                                                                </button>
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

                                    <!-- Modal delete data -->
                                    <div class="modal modal-blur fade" id="modal-deletedata<?= $i; ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                                        <form id="edeleteAcAhuForm" action="<?php echo base_url('acahu/deleteAcAhu/' . $t['id']); ?>" method="post">
                                            <div class="modal-dialog modal-lg modal-dialog-centered" role="dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Delete AC AHU Data (<?= $skipcounttmp - $skipcount + 1; ?>/<?= $skipcounttmp + 1; ?>)</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Location</label>
                                                                    <input type="text" class="form-control" value="<?= $location ?>" disabled>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Date</label>
                                                                    <input type="text" class="form-control" placeholder="dd-mm-yyyy" value="<?= $t['date']; ?>" disabled>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Time</label>
                                                                    
                                                                    <input <?php if(strval($t['time']) == "10:00:00") { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                    <span>10.00</span>
                                                                    
                                                                    <span style="padding-left: 20px;"></span>
                                                                    
                                                                    <input <?php if(strval($t['time']) == "19:00:00") { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                    <span>19.00</span>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Worker</label>
                                                                    <input type="text" class="form-control" value="<?= $t['worker_name']; ?>*" disabled>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Checklist</label>
                                                                    <input type="text" class="form-control" value="Daily" disabled>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6">
                                                                <div style="padding: 10px; background-color: aliceblue;">
                                                                    <div class="mb-3">
                                                                        <div class='row' style="margin: 0px;">
                                                                            <select class="form-select" aria-label="Floating label select example" disabled>
                                                                                <option selected>AHU No. <?= $t['ahu'] ?></option>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Water Pressure In 0.5 - 2.5 BAR</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col" value="<?= $t['pres_in']; ?>" disabled>
                                                                            <label class="form-label col-2" style="margin-top: auto; margin-bottom: auto;">&deg;C</label>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Water Pressure Out 0.5 - 1.5 BAR</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col" value="<?= $t['pres_out']; ?>" disabled>
                                                                            <label class="form-label col-2" style="margin-top: auto; margin-bottom: auto;">&deg;C</label>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Water Temperature In 14&deg;C - 18&deg;C</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col" value="<?= $t['temp_in']; ?>" disabled>
                                                                            <label class="form-label col-2" style="margin-top: auto; margin-bottom: auto;">&deg;C</label>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Water Temperature Out 16&deg;C - 22&deg;C</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col" value="<?= $t['temp_out']; ?>" disabled>
                                                                            <label class="form-label col-2" style="margin-top: auto; margin-bottom: auto;">&deg;C</label>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Action</label>

                                                                        <input <?php if($t['action'] == 1) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                        <span>Fan</span>
                                                                        
                                                                        <span style="padding-left: 20px;"></span>
                                                                        
                                                                        <input <?php if($t['action'] == 2) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                        <span>Comp</span>

                                                                        <span style="padding-left: 20px;"></span>
                                                                        
                                                                        <input <?php if($t['action'] == 3) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                        <span>Off</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer justify-content-between">
                                                        <div class="row align-items-center">
                                                            <?php if($skipcount < $skipcounttmp): ?>
                                                                <div class="col">
                                                                    <a href="#myModalDelete<?= $i - 1; ?>" class="btn btn-outline-primary w-100 btn-icon" aria-label="ViewData" data-bs-toggle="modal" data-bs-target="#modal-deletedata<?= $i - 1; ?>">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                                                                            <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                                                                        </svg>
                                                                    </a>
                                                                </div>
                                                            <?php endif; ?>
                                                            <?php if($skipcount > 0): ?>
                                                                <div class="col">
                                                                    <a href="#myModalDelete<?= $i + 1; ?>" class="btn btn-outline-primary w-100 btn-icon" aria-label="ViewData" data-bs-toggle="modal" data-bs-target="#modal-deletedata<?= $i + 1; ?>">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                                                            <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                                                                        </svg>
                                                                    </a>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="row align-items-center">
                                                            <div class="col"></div>
                                                            <div class="col-auto">
                                                                <button type="submit" class="btn btn-outline-danger ms-auto" id="btnDeleteAcAhu" name="btnDeleteAcAhu" data-bs-dismiss="modal" data-id="<?= $t['id']; ?>">
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

            <?php if(count($getStoreEquipmentByStore) > 1): ?>
                <div class="col-12">
                    <a
                        href="<?php
                            $i = 1;
                            foreach($getStoreEquipmentByStore as $s) {
                                if($s['idEquipment'] > 10) {
                                    echo($s['url']);
                                    break;
                                }
                                
                                if($i == count($getStoreEquipmentByStore)){
                                    echo($getStoreEquipmentByStore[0]['url']);
                                    break;
                                }

                                $i++;
                            }
                        ?>"
                        class="btn btn-outline-primary ms-auto"
                    >
                        Next
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section("scripts"); ?>

<script>
    $(document).ready(function() {
        $("#btnReset").on( "click", function() {
            $("input[type=checkbox]:not(:disabled):not(:hidden)").removeAttr('checked');
            $("input:not([type=checkbox]):not(:disabled):not(:hidden)").attr("value","");

            $("#ahu option:selected").each(function () {
                $(this).removeAttr('selected');
            });
        });

        $(".timechecks10").change(function() {
            if(this.checked) {
                $("#ahu").find("option").remove().end();

                <?php for($i = 1; $i <= 21; $i++): ?>
                    <?php
                        $found = 0;
                        foreach($getAcAhuByStoreDate as $t) {
                            if(($t['ahu'] == $i) && ($t['time'] == "10:00:00")) {
                                $found = 1;
                                break;
                            }
                        }
                    ?>
                    <?php if(!$found): ?>
                        $("#ahu").append(
                            '<option value="<?= $i ?>" <?php if(old("ahu") == $i) { echo("selected"); } ?>>AHU No. <?= $i ?></option>'
                        );
                    <?php endif; ?>
                <?php endfor; ?>
            }
        });

        $(".timechecks19").change(function() {
            if(this.checked) {
                $("#ahu").find("option").remove().end();

                <?php for($i = 1; $i <= 21; $i++): ?>
                    <?php
                        $found = 0;
                        foreach($getAcAhuByStoreDate as $t) {
                            if(($t['ahu'] == $i) && ($t['time'] == "19:00:00")) {
                                $found = 1;
                                break;
                            }
                        }
                    ?>
                    <?php if(!$found): ?>
                        $("#ahu").append(
                            '<option value="<?= $i ?>" <?php if(old("ahu") == $i) { echo("selected"); } ?>>AHU No. <?= $i ?></option>'
                        );
                    <?php endif; ?>
                <?php endfor; ?>
            }
        });

        $('.edittimechecks_10').change(function() {
            if($(this).is(':checked')) {
                $(".editahu" + $(this).data("id")).empty();

                <?php for($i = 1; $i <= 21; $i++): ?>
                    var found = 0;
                    
                    <?php foreach($getAcAhuByStore as $t): ?>
                        <?php if(($t['ahu'] == $i) && ($t['time'] == "10:00:00")): ?>
                            if(($(this).data("date") == "<?= $t['date'] ?>") && ($(this).data("dataid") != "<?= $t['id'] ?>")) {
                                found = 1;
                            }
                        <?php endif; ?>
                    <?php endforeach; ?>

                    if(!found) {
                        if($(this).data("ahu") == "<?= $i ?>") {
                            $(".editahu" + $(this).data("id")).append(
                                '<option value="<?= $i ?>" selected>AHU No. <?= $i ?></option>'
                            );
                        }
                        else {
                            $(".editahu" + $(this).data("id")).append(
                                '<option value="<?= $i ?>">AHU No. <?= $i ?></option>'
                            );
                        }
                    }
                <?php endfor; ?>
            }
        });

        $('.edittimechecks_19').change(function() {
            if($(this).is(':checked')) {
                $(".editahu" + $(this).data("id")).empty();

                <?php for($i = 1; $i <= 21; $i++): ?>
                    var found = 0;
                    
                    <?php foreach($getAcAhuByStore as $t): ?>
                        <?php if(($t['ahu'] == $i) && ($t['time'] == "19:00:00")): ?>
                            if(($(this).data("date") == "<?= $t['date'] ?>") && ($(this).data("dataid") != "<?= $t['id'] ?>")) {
                                found = 1;
                            }
                        <?php endif; ?>
                    <?php endforeach; ?>

                    if(!found) {
                        $(".editahu" + $(this).data("id")).append(
                            '<option value="<?= $i ?>">AHU No. <?= $i ?></option>'
                        );
                    }
                <?php endfor; ?>
            }
        });
    })
</script>

<?= $this->endSection(); ?>