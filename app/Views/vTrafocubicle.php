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
                        <h3 class="card-title">Trafo & Cubicle</h3>
                    </div>

                    <div class="card-body">
                        <form action="<?php echo base_url('trafocubicle/saveTrafoCubicle'); ?>" method="post">
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
                                                    $time3 = 0;

                                                    foreach($getTrafoCubicleByStoreDate as $t) {
                                                        if(strval($t['time']) == "08:00:00") {
                                                            $time1 = 1;
                                                        }

                                                        if(strval($t['time']) == "13:00:00") {
                                                            $time2 = 1;
                                                        }

                                                        if(strval($t['time']) == "19:00:00") {
                                                            $time3 = 1;
                                                        }
                                                    }
                                                ?>

                                                <input <?php if($time1 == 1) { echo("disabled"); } ?><?php if(old('time') == "08:00:00") { echo("checked"); } ?> id="time" name="time" type="checkbox" class="timechecks <?= ($validation->hasError('time')) ? 'is-invalid' : ''; ?>" onclick="checkTime(this.value);" value="08:00:00">
                                                <span <?php if($time1 == 1) { echo("style='opacity: 50%;'"); } ?>>08.00</span>
                                                
                                                <span style="padding-left: 20px;"></span>
                                                
                                                <input <?php if($time2 == 1) { echo("disabled"); } ?><?php if(old('time') == "13:00:00") { echo("checked"); } ?> id="time" name="time" type="checkbox" class="timechecks <?= ($validation->hasError('time')) ? 'is-invalid' : ''; ?>" onclick="checkTime(this.value);" value="13:00:00">
                                                <span <?php if($time2 == 1) { echo("style='opacity: 50%;'"); } ?>>13.00</span>
                                                
                                                <span style="padding-left: 20px;"></span>

                                                <input <?php if($time3 == 1) { echo("disabled"); } ?><?php if(old('time') == "19:00:00") { echo("checked"); } ?> id="time" name="time" type="checkbox" class="timechecks <?= ($validation->hasError('time')) ? 'is-invalid' : ''; ?>" onclick="checkTime(this.value);" value="19:00:00">
                                                <span <?php if($time3 == 1) { echo("style='opacity: 50%;'"); } ?>>19.00</span>
                                                
                                                <?php if($validation->hasError('time')): ?>
                                                    <div class="invalid-feedback">
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
                            
                            <div class="row" style="padding-top: 20px;">
                                <div class="col-lg-6">
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-4 col-form-label">Suhu Oli 30&deg;C - 50&deg;C</label>
                                        <div class="col">
                                            <div class="input-icon mb-2">
                                                <input value="<?= old('oil_temperature'); ?>" class="form-control <?= ($validation->hasError('oil_temperature')) ? 'is-invalid' : ''; ?>" id="oil_temperature" name="oil_temperature">
                                            </div>
                                            <?php if($validation->hasError('oil_temperature')): ?>
                                                <div style="font-size: 85.71428571%; color: #d63939;">
                                                    <?= $validation->getError('oil_temperature'); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <label class="form-label col-1 col-form-label">&deg;C</label>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered card-table table-vcenter text-nowrap datatable" style="width:100%">
                                    <tbody>
                                        <tr style="border: 0;">
                                            <td style="border: 0;"></td>
                                            <td style="border: 0;"></td>
                                            <td style="border: 0;"></td>
                                        </tr>
                                        <tr>
                                            <td rowspan="3">Trafo</td>
                                            <td>Kebersihan Trafo</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if(old('trafo_cleanliness') == "1") { echo("checked"); } ?> id="trafo_cleanliness" name="trafo_cleanliness" type="checkbox" class="tracleanchecks <?= ($validation->hasError('trafo_cleanliness')) ? 'is-invalid' : ''; ?>" onclick="checkCleanTra(this.value);" value="1">
                                                    Bersih<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if(old('trafo_cleanliness') == "0") { echo("checked"); } ?> id="trafo_cleanliness" name="trafo_cleanliness" type="checkbox" class="tracleanchecks <?= ($validation->hasError('trafo_cleanliness')) ? 'is-invalid' : ''; ?>" onclick="checkCleanTra(this.value);" value="0">
                                                    Kotor
                                                </div>
                                                <?php if($validation->hasError('trafo_cleanliness')): ?>
                                                    <div style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('trafo_cleanliness'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkCleanTra(b){
                                                    var x = document.getElementsByClassName('tracleanchecks');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if(x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td style="padding-left: 8px;">Suhu Ruang 23&deg;C - 27&deg;C</td>
                                            <td>
                                                <div class="row" style="padding-top: 20px;">
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-3 row">
                                                            <div class="col">
                                                                <div class="input-icon mb-2">
                                                                    <input value="<?= old('trafo_temperature'); ?>" class="form-control <?= ($validation->hasError('trafo_temperature')) ? 'is-invalid' : ''; ?>" id="trafo_temperature" name="trafo_temperature">
                                                                    <?php if($validation->hasError('trafo_temperature')): ?>
                                                                        <div style="font-size: 85.71428571%; color: #d63939;">
                                                                            <?= $validation->getError('trafo_temperature'); ?>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                            <label class="form-label col-1 col-form-label">&deg;C</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding-left: 8px;">Oli Rembes</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if(old('trafo_oil_leak') == "1") { echo("checked"); } ?> id="trafo_oil_leak" name="trafo_oil_leak" type="checkbox" class="oilchecks <?= ($validation->hasError('trafo_oil_leak')) ? 'is-invalid' : ''; ?>" onclick="checkOil(this.value);" value="1">
                                                    Ya<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if(old('trafo_oil_leak') == "0") { echo("checked"); } ?> id="trafo_oil_leak" name="trafo_oil_leak" type="checkbox" class="oilchecks <?= ($validation->hasError('trafo_oil_leak')) ? 'is-invalid' : ''; ?>" onclick="checkOil(this.value);" value="0">
                                                    Tidak
                                                </div>
                                                <?php if($validation->hasError('trafo_oil_leak')): ?>
                                                    <div style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('trafo_oil_leak'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkOil(b){
                                                    var x = document.getElementsByClassName('oilchecks');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if(x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr style="border: 0;">
                                            <td style="border: 0;"></td>
                                            <td style="border: 0;"></td>
                                            <td style="border: 0;"></td>
                                        </tr>
                                        <tr>
                                            <td rowspan="4">Cubicle</td>
                                            <td>Kebersihan Cubicle</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if(old('cubicle_cleanliness') == "1") { echo("checked"); } ?> id="cubicle_cleanliness" name="cubicle_cleanliness" type="checkbox" class="cubcleanchecks <?= ($validation->hasError('cubicle_cleanliness')) ? 'is-invalid' : ''; ?>" onclick="checkCleanCub(this.value);" value="1">
                                                    Bersih<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if(old('cubicle_cleanliness') == "0") { echo("checked"); } ?> id="cubicle_cleanliness" name="cubicle_cleanliness" type="checkbox" class="cubcleanchecks <?= ($validation->hasError('cubicle_cleanliness')) ? 'is-invalid' : ''; ?>" onclick="checkCleanCub(this.value);" value="0">
                                                    Kotor
                                                </div>
                                                <?php if($validation->hasError('cubicle_cleanliness')): ?>
                                                    <div style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('cubicle_cleanliness'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkCleanCub(b){
                                                    var x = document.getElementsByClassName('cubcleanchecks');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if(x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td style="padding-left: 8px;">Suhu Ruang 23&deg;C - 27&deg;C</td>
                                            <td>
                                                <div class="row" style="padding-top: 20px;">
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-3 row">
                                                            <div class="col">
                                                                <div class="input-icon mb-2">
                                                                    <input value="<?= old('cubicle_temperature'); ?>" class="form-control <?= ($validation->hasError('cubicle_temperature')) ? 'is-invalid' : ''; ?>" id="cubicle_temperature" name="cubicle_temperature">
                                                                    <?php if($validation->hasError('cubicle_temperature')): ?>
                                                                        <div style="font-size: 85.71428571%; color: #d63939;">
                                                                            <?= $validation->getError('cubicle_temperature'); ?>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                            <label class="form-label col-1 col-form-label">&deg;C</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding-left: 8px;">Noise</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if(old('cubicle_noise') == "1") { echo("checked"); } ?> id="cubicle_noise" name="cubicle_noise" type="checkbox" class="noisechecks <?= ($validation->hasError('cubicle_noise')) ? 'is-invalid' : ''; ?>" onclick="checkNoise(this.value);" value="1">
                                                    Ya<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if(old('cubicle_noise') == "0") { echo("checked"); } ?> id="cubicle_noise" name="cubicle_noise" type="checkbox" class="noisechecks <?= ($validation->hasError('cubicle_noise')) ? 'is-invalid' : ''; ?>" onclick="checkNoise(this.value);" value="0">
                                                    Tidak
                                                </div>
                                                <?php if($validation->hasError('cubicle_noise')): ?>
                                                    <div style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('cubicle_noise'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkNoise(b){
                                                    var x = document.getElementsByClassName('noisechecks');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if(x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td style="padding-left: 8px;">Tercium Bau Ozone</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if(old('cubicle_ozone') == "1") { echo("checked"); } ?> id="cubicle_ozone" name="cubicle_ozone" type="checkbox" class="ozonechecks <?= ($validation->hasError('cubicle_ozone')) ? 'is-invalid' : ''; ?>" onclick="checkOzone(this.value);" value="1">
                                                    Ya<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if(old('cubicle_ozone') == "0") { echo("checked"); } ?> id="cubicle_ozone" name="cubicle_ozone" type="checkbox" class="ozonechecks <?= ($validation->hasError('cubicle_ozone')) ? 'is-invalid' : ''; ?>" onclick="checkOzone(this.value);" value="0">
                                                    Tidak
                                                </div>
                                                <?php if($validation->hasError('cubicle_ozone')): ?>
                                                    <div style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('cubicle_ozone'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkOzone(b){
                                                    var x = document.getElementsByClassName('ozonechecks');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if(x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr style="border: 0;">
                                            <td style="border: 0;"></td>
                                            <td style="border: 0;"></td>
                                            <td style="border: 0;"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="form-footer">
                                <div class="row align-items-center">
                                    <div class="col"></div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-outline-primary ms-auto" id="btnSubmitTrafoCubicle" name="btnSubmitTrafoCubicle">
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
                        <h3 class="card-title">Trafo & Cubicle Data</h3>
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
                                    <th>Suhu Oli 30&deg;C - 50&deg;C</th>
                                    <th>TRAFO<br>Kebersihan Trafo</th>
                                    <th>TRAFO<br>Suhu Ruang 23&deg;C - 27&deg;C</th>
                                    <th>TRAFO<br>Oli Rembes</th>
                                    <th>CUBICLE<br>Kebersihan Cubicle</th>
                                    <th>CUBICLE<br>Suhu Ruang 23&deg;C - 27&deg;C</th>
                                    <th>CUBICLE<br>Noise</th>
                                    <th>CUBICLE<br>Tercium Bau Ozone</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                    $n = 1;
                                ?>
                                <?php foreach($getTrafoCubicleByStore as $t): ?>
                                    <?php
                                        $date = new DateTime($t['date']);
                                        $time = new DateTime($t['time']);                               
                                    ?>

                                    <tr>
                                        <td><?= $n ?></td>

                                        <td><?= $t['store_name'] ?></td>
                                        <td><?= $date->format('j F Y') ?></td>
                                        <td><?= $time->format('H.i') ?></td>
                                        <td><?= $t['worker_name'] ?></td>
                                        <td><?= $t['oil_temperature'] ?>&deg;C</td>
                                        <td><?php if($t['trafo_cleanliness']) { echo("Bersih"); } else { echo("Kotor"); } ?></td>
                                        <td><?= $t['trafo_temperature'] ?>&deg;C</td>
                                        <td><?php if($t['trafo_oil_leak']) { echo("Ya"); } else { echo("Tidak"); } ?></td>
                                        <td><?php if($t['cubicle_cleanliness']) { echo("Bersih"); } else { echo("Kotor"); } ?></td>
                                        <td><?= $t['cubicle_temperature'] ?>&deg;C</td>
                                        <td><?php if($t['cubicle_noise']) { echo("Ya"); } else { echo("Tidak"); } ?></td>
                                        <td><?php if($t['cubicle_ozone']) { echo("Ya"); } else { echo("Tidak"); } ?></td>
                                        
                                        <td class="text-end">
                                            <div class="row g-2 align-items-center mb-n3">
                                                <div class="col-6 col-sm-4 col-md-2 col-xl-auto mb-3">
                                                    <button href="#myModalEdit<?= $n; ?>" id="btnModalEdit<?= $t['id']; ?>" data-bs-toggle="modal" data-bs-target="#modal-editdata<?= $n; ?>" class="btn btn-outline-success w-100 btn-icon btn-edit">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                                            <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                                            <path d="M16 5l3 3"></path>
                                                        </svg>
                                                    </button>
                                                </div>

                                                <div class="col-6 col-sm-4 col-md-2 col-xl-auto mb-3">
                                                    <button href="#myModalDelete<?= $n; ?>" class="btn btn-outline-danger w-100 btn-icon" aria-label="DeleteData" data-bs-toggle="modal" data-bs-target="#modal-deletedata<?= $n; ?>">
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

                                    <!-- Modal edit data -->
                                    <div class="modal modal-blur fade" id="modal-editdata<?= $n; ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                                        <form id="editTrafoCubicleForm" action="<?php echo base_url('trafocubicle/updateTrafoCubicle/' . $t['id']); ?>" method="post">
                                            <div class="modal-dialog modal-lg modal-dialog-centered" role="dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Trafo & Cubicle Data</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-lg-4">
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
                                                                        $time3 = 0;

                                                                        foreach($getTrafoCubicleByStoreDate as $tt) {
                                                                            if($tt['date'] == $t['date']) {
                                                                                if(strval($tt['time']) == "08:00:00") {
                                                                                    $time1 = 1;
                                                                                }

                                                                                if(strval($tt['time']) == "13:00:00") {
                                                                                    $time2 = 1;
                                                                                }

                                                                                if(strval($tt['time']) == "19:00:00") {
                                                                                    $time3 = 1;
                                                                                }
                                                                            }
                                                                        }
                                                                    ?>

                                                                    <label class="form-label">Time</label>
                                                                    
                                                                    <input <?php if(strval($t['time']) == "08:00:00") { echo("checked"); } else { if($time1 == 1) { echo("disabled"); } } ?> id="edittime" name="edittime" type="checkbox" class="edittimechecks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('edittime'))) ? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditTime' . $n . '(this.value)' ?>;" value="08:00:00">
                                                                    <span <?php if((strval($t['time']) != "08:00:00") && ($time1 == 1)) { echo("style='opacity: 50%;'"); } ?>>08.00</span>
                                                                    
                                                                    <span style="padding-left: 20px;"></span>
                                                                    
                                                                    <input <?php if(strval($t['time']) == "13:00:00") { echo("checked"); } else { if($time2 == 1) { echo("disabled"); } } ?> id="edittime" name="edittime" type="checkbox" class="edittimechecks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('edittime'))) ? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditTime' . $n . '(this.value)' ?>;" value="13:00:00">
                                                                    <span <?php if((strval($t['time']) != "13:00:00") && ($time2 == 1)) { echo("style='opacity: 50%;'"); } ?>>13.00</span>
                                                                    
                                                                    <span style="padding-left: 20px;"></span>

                                                                    <input <?php if(strval($t['time']) == "19:00:00") { echo("checked"); } else { if($time3 == 1) { echo("disabled"); } } ?> id="edittime" name="edittime" type="checkbox" class="edittimechecks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('edittime'))) ? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditTime' . $n . '(this.value)' ?>;" value="19:00:00">
                                                                    <span <?php if((strval($t['time']) != "19:00:00") && ($time3 == 1)) { echo("style='opacity: 50%;'"); } ?>>19.00</span>
                                                                    
                                                                    <?php if($validation->hasError('edittime')): ?>
                                                                        <div class="invalid-feedback">
                                                                            <?= $validation->getError('edittime'); ?>
                                                                        </div>
                                                                    <?php endif; ?>

                                                                    <script>
                                                                        function checkEditTime<?= $n ?>(b){
                                                                            var x = document.getElementsByClassName('edittimechecks<?= $n ?>');
                                                                            var i;

                                                                            for(i = 0; i < x.length; i++) {
                                                                                if(x[i].value != b) x[i].checked = false;
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

                                                            <div class="col-lg-4">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Suhu Oli 30&deg;C - 50&deg;C</label>
                                                                    <div class='row' style="margin: 0px;">
                                                                        <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editoiltemperature'))) ? 'is-invalid' : ''; ?>" id="editoiltemperature" name="editoiltemperature" value="<?= $t['oil_temperature']; ?>">
                                                                        <label class="form-label col-2" style="margin-top: auto; margin-bottom: auto;">&deg;C</label>
                                                                    </div>
                                                                    <?php if(($t['id'] == old('editid')) && ($validation->hasError('editoiltemperature'))): ?>
                                                                        <div style="font-size: 85.71428571%; color: #d63939;">
                                                                            <?= $validation->getError('editoiltemperature'); ?>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>

                                                                <div style="padding: 10px; background-color: aliceblue;">
                                                                    <div class="mb-3 text-center">
                                                                        <label class="form-label" style="color: lightsteelblue; font-weight: bold; opacity: 90%;">TRAFO</label>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Kebersihan Trafo</label>

                                                                        <input <?php if($t['trafo_cleanliness']) { echo("checked"); } ?> id="edittrafocleanliness" name="edittrafocleanliness" type="checkbox" class="edittrafocleanlinesschecks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('edittrafocleanliness')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditTrafoCleanliness' . $n . '(this.value)' ?>;" value="1">
                                                                        <span>Bersih</span>
                                                                        
                                                                        <span style="padding-left: 20px;"></span>
                                                                        
                                                                        <input <?php if(!$t['trafo_cleanliness']) { echo("checked"); } ?> id="edittrafocleanliness" name="edittrafocleanliness" type="checkbox" class="edittrafocleanlinesschecks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('edittrafocleanliness')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditTrafoCleanliness' . $n . '(this.value)' ?>;" value="0">
                                                                        <span>Kotor</span>
                                                                        
                                                                        <?php if($validation->hasError('edittrafocleanliness')): ?>
                                                                            <div class="invalid-feedback">
                                                                                <?= $validation->getError('edittrafocleanliness'); ?>
                                                                            </div>
                                                                        <?php endif; ?>

                                                                        <script>
                                                                            function checkEditTrafoCleanliness<?= $n ?>(b){
                                                                                var x = document.getElementsByClassName('edittrafocleanlinesschecks<?= $n ?>');
                                                                                var i;

                                                                                for(i = 0; i < x.length; i++) {
                                                                                    if(x[i].value != b) x[i].checked = false;
                                                                                }
                                                                            }
                                                                        </script>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Suhu Ruang 23&deg;C - 27&deg;C</label>

                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('edittrafotemperature')))? 'is-invalid' : ''; ?>" id="edittrafotemperature" name="edittrafotemperature" value="<?= $t['trafo_temperature']; ?>">
                                                                            <label class="form-label col-2" style="margin-top: auto; margin-bottom: auto;">&deg;C</label>
                                                                        </div>

                                                                        <?php if(($t['id'] == old('editid')) && ($validation->hasError('edittrafotemperature'))): ?>
                                                                            <div style="font-size: 85.71428571%; color: #d63939;">
                                                                                <?= $validation->getError('edittrafotemperature'); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Oli Rembes</label>

                                                                        <input <?php if($t['trafo_oil_leak']) { echo("checked"); } ?> id="edittrafooilleak" name="edittrafooilleak" type="checkbox" class="edittrafooilleakchecks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('edittrafooilleak')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditTrafoOilLeak' . $n . '(this.value)' ?>;" value="1">
                                                                        <span>Ya</span>
                                                                        
                                                                        <span style="padding-left: 20px;"></span>
                                                                        
                                                                        <input <?php if(!$t['trafo_oil_leak']) { echo("checked"); } ?> id="edittrafooilleak" name="edittrafooilleak" type="checkbox" class="edittrafooilleakchecks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('edittrafooilleak')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditTrafoOilLeak' . $n . '(this.value)' ?>;" value="0">
                                                                        <span>Tidak</span>
                                                                        
                                                                        <?php if($validation->hasError('edittrafooilleak')): ?>
                                                                            <div class="invalid-feedback">
                                                                                <?= $validation->getError('edittrafooilleak'); ?>
                                                                            </div>
                                                                        <?php endif; ?>

                                                                        <script>
                                                                            function checkEditTrafoOilLeak<?= $n ?>(b){
                                                                                var x = document.getElementsByClassName('edittrafooilleakchecks<?= $n ?>');
                                                                                var i;

                                                                                for(i = 0; i < x.length; i++) {
                                                                                    if(x[i].value != b) x[i].checked = false;
                                                                                }
                                                                            }
                                                                        </script>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-4">
                                                                <div style="padding: 10px; background-color: aliceblue;">
                                                                    <div class="mb-3 text-center">
                                                                        <label class="form-label" style="color: lightsteelblue; font-weight: bold; opacity: 90%;">CUBICLE</label>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Kebersihan Cubicle</label>

                                                                        <input <?php if($t['cubicle_cleanliness']) { echo("checked"); } ?> id="editcubiclecleanliness" name="editcubiclecleanliness" type="checkbox" class="editcubiclecleanlinesschecks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editcubiclecleanliness'))) ? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditCubicleCleanliness' . $n . '(this.value)' ?>;" value="1">
                                                                        <span>Bersih</span>

                                                                        <span style="padding-left: 20px;"></span>

                                                                        <input <?php if(!$t['cubicle_cleanliness']) { echo("checked"); } ?> id="editcubiclecleanliness" name="editcubiclecleanliness" type="checkbox" class="editcubiclecleanlinesschecks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editcubiclecleanliness'))) ? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditCubicleCleanliness' . $n . '(this.value)' ?>;" value="0">
                                                                        <span>Kotor</span>

                                                                        <?php if($validation->hasError('editcubiclecleanliness')): ?>
                                                                            <div class="invalid-feedback">
                                                                                <?= $validation->getError('editcubiclecleanliness'); ?>
                                                                            </div>
                                                                        <?php endif; ?>

                                                                        <script>
                                                                            function checkEditCubicleCleanliness<?= $n ?>(b){
                                                                                var x = document.getElementsByClassName('editcubiclecleanlinesschecks<?= $n ?>');
                                                                                var i;

                                                                                for(i = 0; i < x.length; i++) {
                                                                                    if(x[i].value != b) x[i].checked = false;
                                                                                }
                                                                            }
                                                                        </script>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Suhu Ruang 23&deg;C - 27&deg;C</label>

                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editcubicletemperature'))) ? 'is-invalid' : ''; ?>" id="editcubicletemperature" name="editcubicletemperature" value="<?= $t['cubicle_temperature']; ?>">
                                                                            <label class="form-label col-2" style="margin-top: auto; margin-bottom: auto;">&deg;C</label>
                                                                        </div>

                                                                        <?php if(($t['id'] == old('editid')) && ($validation->hasError('editcubicletemperature'))): ?>
                                                                            <div style="font-size: 85.71428571%; color: #d63939;">
                                                                                <?= $validation->getError('editcubicletemperature'); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Noise</label>

                                                                        <input <?php if($t['cubicle_noise']) { echo("checked"); } ?> id="editcubiclenoise" name="editcubiclenoise" type="checkbox" class="editcubiclenoisechecks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editcubiclenoise'))) ? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditCubicleNoise' . $n . '(this.value)' ?>;" value="1">
                                                                        <span>Ya</span>
                                                                        
                                                                        <span style="padding-left: 20px;"></span>
                                                                        
                                                                        <input <?php if(!$t['cubicle_noise']) { echo("checked"); } ?> id="editcubiclenoise" name="editcubiclenoise" type="checkbox" class="editcubiclenoisechecks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editcubiclenoise'))) ? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditCubicleNoise' . $n . '(this.value)' ?>;" value="0">
                                                                        <span>Tidak</span>
                                                                        
                                                                        <?php if($validation->hasError('editcubiclenoise')): ?>
                                                                            <div class="invalid-feedback">
                                                                                <?= $validation->getError('editcubiclenoise'); ?>
                                                                            </div>
                                                                        <?php endif; ?>

                                                                        <script>
                                                                            function checkEditCubicleNoise<?= $n ?>(b){
                                                                                var x = document.getElementsByClassName('editcubiclenoisechecks<?= $n ?>');
                                                                                var i;

                                                                                for(i = 0; i < x.length; i++) {
                                                                                    if(x[i].value != b) x[i].checked = false;
                                                                                }
                                                                            }
                                                                        </script>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Tercium Bau Ozone</label>

                                                                        <input <?php if($t['cubicle_ozone']) { echo("checked"); } ?> id="editcubicleozone" name="editcubicleozone" type="checkbox" class="editcubicleozonechecks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editcubicleozone'))) ? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditCubicleOzone' . $n . '(this.value)' ?>;" value="1">
                                                                        <span>Ya</span>
                                                                        
                                                                        <span style="padding-left: 20px;"></span>
                                                                        
                                                                        <input <?php if(!$t['cubicle_ozone']) { echo("checked"); } ?> id="editcubicleozone" name="editcubicleozone" type="checkbox" class="editcubicleozonechecks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editcubicleozone'))) ? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditCubicleOzone' . $n . '(this.value)' ?>;" value="0">
                                                                        <span>Tidak</span>
                                                                        
                                                                        <?php if($validation->hasError('editcubicleozone')): ?>
                                                                            <div class="invalid-feedback">
                                                                                <?= $validation->getError('editcubicleozone'); ?>
                                                                            </div>
                                                                        <?php endif; ?>

                                                                        <script>
                                                                            function checkEditCubicleOzone<?= $n ?>(b){
                                                                                var x = document.getElementsByClassName('editcubicleozonechecks<?= $n ?>');
                                                                                var i;

                                                                                for(i = 0; i < x.length; i++) {
                                                                                    if(x[i].value != b) x[i].checked = false;
                                                                                }
                                                                            }
                                                                        </script>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <div class="col-auto">
                                                            <button type="submit" class="btn btn-outline-primary ms-auto" id="btnUpdateTrafoCubicle" name="btnUpdateTrafoCubicle" data-bs-dismiss="modal" data-id="<?= $t['id']; ?>">
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
                                        </form>
                                    </div>

                                    <!-- Modal delete data -->
                                    <div class="modal modal-blur fade" id="modal-deletedata<?= $n; ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                                        <form id="deleteTrafoCubicleForm" action="<?php echo base_url('trafocubicle/deleteTrafoCubicle/' . $t['id']); ?>" method="post">
                                            <div class="modal-dialog modal-lg modal-dialog-centered" role="dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Delete Trafo & Cubicle Data</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-lg-4">
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
                                                                    
                                                                    <input <?php if(strval($t['time']) == "08:00:00") { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                    <span>08.00</span>
                                                                    
                                                                    <span style="padding-left: 20px;"></span>
                                                                    
                                                                    <input <?php if(strval($t['time']) == "13:00:00") { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                    <span>13.00</span>
                                                                    
                                                                    <span style="padding-left: 20px;"></span>

                                                                    <input <?php if(strval($t['time']) == "19:00:00") { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                    <span>19.00</span>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Worker</label>
                                                                    <input type="text" class="form-control" value="<?= $t['worker_name']; ?>" disabled>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Checklist</label>
                                                                    <input type="text" class="form-control" value="Daily" disabled>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-4">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Suhu Oli 30&deg;C - 50&deg;C</label>
                                                                    <div class='row' style="margin: 0px;">
                                                                        <input type="text" class="form-control col" value="<?= $t['oil_temperature']; ?>" disabled>
                                                                        <label class="form-label col-2" style="margin-top: auto; margin-bottom: auto;">&deg;C</label>
                                                                    </div>
                                                                </div>

                                                                <div style="padding: 10px; background-color: aliceblue;">
                                                                    <div class="mb-3 text-center">
                                                                        <label class="form-label" style="color: lightsteelblue; font-weight: bold; opacity: 90%;">TRAFO</label>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Kebersihan Trafo</label>

                                                                        <input <?php if($t['trafo_cleanliness']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                        <span>Bersih</span>
                                                                        
                                                                        <span style="padding-left: 20px;"></span>
                                                                        
                                                                        <input <?php if(!$t['trafo_cleanliness']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                        <span>Kotor</span>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Suhu Ruang 23&deg;C - 27&deg;C</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col" value="<?= $t['trafo_temperature']; ?>" disabled>
                                                                            <label class="form-label col-2" style="margin-top: auto; margin-bottom: auto;">&deg;C</label>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Oli Rembes</label>

                                                                        <input <?php if($t['trafo_oil_leak']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                        <span>Ya</span>
                                                                        
                                                                        <span style="padding-left: 20px;"></span>
                                                                        
                                                                        <input <?php if(!$t['trafo_oil_leak']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                        <span>Tidak</span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-4">
                                                                <div style="padding: 10px; background-color: aliceblue;">
                                                                    <div class="mb-3 text-center">
                                                                        <label class="form-label" style="color: lightsteelblue; font-weight: bold; opacity: 90%;">CUBICLE</label>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Kebersihan Cubicle</label>

                                                                        <input <?php if($t['cubicle_cleanliness']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                        <span>Bersih</span>

                                                                        <span style="padding-left: 20px;"></span>

                                                                        <input <?php if(!$t['cubicle_cleanliness']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                        <span>Kotor</span>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Suhu Ruang 23&deg;C - 27&deg;C</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col" value="<?= $t['cubicle_temperature']; ?>" disabled>
                                                                            <label class="form-label col-2" style="margin-top: auto; margin-bottom: auto;">&deg;C</label>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Noise</label>

                                                                        <input <?php if($t['cubicle_noise']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                        <span>Ya</span>
                                                                        
                                                                        <span style="padding-left: 20px;"></span>
                                                                        
                                                                        <input <?php if(!$t['cubicle_noise']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                        <span>Tidak</span>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Tercium Bau Ozone</label>

                                                                        <input <?php if($t['cubicle_ozone']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                        <span>Ya</span>
                                                                        
                                                                        <span style="padding-left: 20px;"></span>
                                                                        
                                                                        <input <?php if(!$t['cubicle_ozone']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                        <span>Tidak</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <div class="col-auto">
                                                            <button type="submit" class="btn btn-outline-danger ms-auto" id="btnDeleteTrafoCubicle" name="btnDeleteTrafoCubicle" data-bs-dismiss="modal" data-id="<?= $t['id']; ?>">
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
                                        </form>
                                    </div>
                                    
                                    <?php $n++; ?>
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
                                if($s['idEquipment'] > 1) {
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
            $("input:not([type=checkbox]):not(:disabled):not(:hidden)").attr("value", "");
            $("#description").html("");
        });
    })
</script>

<?= $this->endSection(); ?>