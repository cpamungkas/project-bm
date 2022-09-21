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
                        <h3 class="card-title">AC Chiller</h3>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo base_url('acchiller/saveAcChiller'); ?>" method="post">
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

                                                    foreach($getAcChillerByStoreDate as $t) {
                                                        if(strval($t['time']) == "10:00:00") {
                                                            $time1 = 1;
                                                        }

                                                        if(strval($t['time']) == "19:00:00") {
                                                            $time2 = 1;
                                                        }
                                                    }
                                                ?>

                                                <input <?php if($time1 == 1) { echo("disabled"); } ?><?php if(old('time') == "10:00:00") { echo("checked"); } ?> id="time" name="time" type="checkbox" class="timechecks <?= ($validation->hasError('time')) ? 'is-invalid' : ''; ?>" onclick="checkTime(this.value);" value="10:00:00">
                                                <span <?php if($time1 == 1) { echo("style='opacity: 50%;'"); } ?>>10.00</span>
                                                
                                                <span style="padding-left: 20px;"></span>
                                                
                                                <input <?php if($time2 == 1) { echo("disabled"); } ?><?php if(old('time') == "19:00:00") { echo("checked"); } ?> id="time" name="time" type="checkbox" class="timechecks <?= ($validation->hasError('time')) ? 'is-invalid' : ''; ?>" onclick="checkTime(this.value);" value="19:00:00">
                                                <span <?php if($time2 == 1) { echo("style='opacity: 50%;'"); } ?>>19.00</span>
                                                
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
                        
                            <div class="row" style="padding-top: 20px;">
                                <div class="col-lg-3">
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-5">Chiller No. 1</label>
                                        <div class="col">
                                            <div>
                                                <input <?php if(old('chiller_1') == "1") { echo("checked"); } ?> id="chiller_1" name="chiller_1" type="checkbox" class="chiller1checks <?= ($validation->hasError('chiller_1')) ? 'is-invalid' : ''; ?>" onclick="checkChiller1(this.value);" value="1">
                                                On
                                                <span style="padding-left: 20px;"></span>
                                                <input <?php if(old('chiller_1') == "0") { echo("checked"); } ?> id="chiller_1" name="chiller_1" type="checkbox" class="chiller1checks <?= ($validation->hasError('chiller_1')) ? 'is-invalid' : ''; ?>" onclick="checkChiller1(this.value);" value="0">
                                                Off
                                            </div>
                                            <?php if($validation->hasError('chiller_1')): ?>
                                                <div style="font-size: 85.71428571%; color: #d63939; white-space: normal;">
                                                    <?= $validation->getError('chiller_1'); ?>
                                                </div>
                                            <?php endif; ?>
                                            <script>
                                                function checkChiller1(b){
                                                    var x = document.getElementsByClassName('chiller1checks');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if(x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-5">CHWP No. 1</label>
                                        <div class="col">
                                            <div>
                                                <input <?php if(old('chwp_1') == "1") { echo("checked"); } ?> id="chwp_1" name="chwp_1" type="checkbox" class="chwp1checks <?= ($validation->hasError('chwp_1')) ? 'is-invalid' : ''; ?>" onclick="checkCHWP1(this.value);" value="1">
                                                On
                                                <span style="padding-left: 20px;"></span>
                                                <input <?php if(old('chwp_1') == "0") { echo("checked"); } ?> id="chwp_1" name="chwp_1" type="checkbox" class="chwp1checks <?= ($validation->hasError('chwp_1')) ? 'is-invalid' : ''; ?>" onclick="checkCHWP1(this.value);" value="0">
                                                Off
                                            </div>
                                            <?php if($validation->hasError('chwp_1')): ?>
                                                <div style="font-size: 85.71428571%; color: #d63939; white-space: normal;">
                                                    <?= $validation->getError('chwp_1'); ?>
                                                </div>
                                            <?php endif; ?>
                                            <script>
                                                function checkCHWP1(b){
                                                    var x = document.getElementsByClassName('chwp1checks');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if(x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-5">Chiller No. 2</label>
                                        <div class="col">
                                            <div>
                                                <input <?php if(old('chiller_2') == "1") { echo("checked"); } ?> id="chiller_2" name="chiller_2" type="checkbox" class="chiller2checks <?= ($validation->hasError('chiller_2')) ? 'is-invalid' : ''; ?>" onclick="checkChiller2(this.value);" value="1">
                                                On
                                                <span style="padding-left: 20px;"></span>
                                                <input <?php if(old('chiller_2') == "0") { echo("checked"); } ?> id="chiller_2" name="chiller_2" type="checkbox" class="chiller2checks <?= ($validation->hasError('chiller_2')) ? 'is-invalid' : ''; ?>" onclick="checkChiller2(this.value);" value="0">
                                                Off
                                            </div>
                                            <?php if($validation->hasError('chiller_2')): ?>
                                                <div style="font-size: 85.71428571%; color: #d63939; white-space: normal;">
                                                    <?= $validation->getError('chiller_2'); ?>
                                                </div>
                                            <?php endif; ?>
                                            <script>
                                                function checkChiller2(b){
                                                    var x = document.getElementsByClassName('chiller2checks');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if(x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-5">CHWP No. 2</label>
                                        <div class="col">
                                            <div>
                                                <input <?php if(old('chwp_2') == "1") { echo("checked"); } ?> id="chwp_2" name="chwp_2" type="checkbox" class="chwp2checks <?= ($validation->hasError('chwp_2')) ? 'is-invalid' : ''; ?>" onclick="checkCHWP2(this.value);" value="1">
                                                On
                                                <span style="padding-left: 20px;"></span>
                                                <input <?php if(old('chwp_2') == "0") { echo("checked"); } ?> id="chwp_2" name="chwp_2" type="checkbox" class="chwp2checks <?= ($validation->hasError('chwp_2')) ? 'is-invalid' : ''; ?>" onclick="checkCHWP2(this.value);" value="0">
                                                Off
                                            </div>
                                            <?php if($validation->hasError('chwp_2')): ?>
                                                <div style="font-size: 85.71428571%; color: #d63939; white-space: normal;">
                                                    <?= $validation->getError('chwp_2'); ?>
                                                </div>
                                            <?php endif; ?>
                                            <script>
                                                function checkCHWP2(b){
                                                    var x = document.getElementsByClassName('chwp2checks');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if(x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3"></div>
                                <div class="col-lg-3">
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-5">CHWP No. 3</label>
                                        <div class="col">
                                            <div>
                                                <input <?php if(old('chwp_3') == "1") { echo("checked"); } ?> id="chwp_3" name="chwp_3" type="checkbox" class="chwp3checks <?= ($validation->hasError('chwp_3')) ? 'is-invalid' : ''; ?>" onclick="checkCHWP3(this.value);" value="1">
                                                On
                                                <span style="padding-left: 20px;"></span>
                                                <input <?php if(old('chwp_3') == "0") { echo("checked"); } ?> id="chwp_3" name="chwp_3" type="checkbox" class="chwp3checks <?= ($validation->hasError('chwp_3')) ? 'is-invalid' : ''; ?>" onclick="checkCHWP3(this.value);" value="0">
                                                Off
                                            </div>
                                            <?php if($validation->hasError('chwp_3')): ?>
                                                <div style="font-size: 85.71428571%; color: #d63939; white-space: normal;">
                                                    <?= $validation->getError('chwp_3'); ?>
                                                </div>
                                            <?php endif; ?>
                                            <script>
                                                function checkCHWP3(b){
                                                    var x = document.getElementsByClassName('chwp3checks');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if(x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="table-responsive">
                                        <table class="table table-bordered card-table table-vcenter text-nowrap datatable" style="width:100%">
                                            <tbody>
                                                <tr style="border: 0;">
                                                    <td style="border: 0;"></td>
                                                    <td style="border: 0;"></td>
                                                    <td style="border: 0;"></td>
                                                </tr>

                                                <tr>
                                                    <td rowspan="4">CHWP Water Report</td>
                                                    <td>Entering Water Temp.<br>18&deg;C - 22&deg;C</td>
                                                    <td>
                                                        <input id="chwp_entering_temp" name="chwp_entering_temp" class="form-control <?= ($validation->hasError('chwp_entering_temp')) ? 'is-invalid' : ''; ?>" value="<?= old('chwp_entering_temp'); ?>">
                                                        <?php if($validation->hasError('chwp_entering_temp')): ?>
                                                            <div class="invalid-feedback" style="white-space: normal;">
                                                                <?= $validation->getError('chwp_entering_temp'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 8px;">Leaving Water Temp.<br>14&deg;C - 18&deg;C</td>
                                                    <td>
                                                        <input id="chwp_leaving_temp" name="chwp_leaving_temp" class="form-control <?= ($validation->hasError('chwp_leaving_temp')) ? 'is-invalid' : ''; ?>" value="<?= old('chwp_leaving_temp'); ?>">
                                                        <?php if($validation->hasError('chwp_leaving_temp')): ?>
                                                            <div class="invalid-feedback" style="white-space: normal;">
                                                                <?= $validation->getError('chwp_leaving_temp'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 8px;">Entering Water Pressure<br>2.5 BAR - 3.5 BAR</td>
                                                    <td>
                                                        <input id="chwp_entering_pres" name="chwp_entering_pres" class="form-control <?= ($validation->hasError('chwp_entering_pres')) ? 'is-invalid' : ''; ?>" value="<?= old('chwp_entering_pres'); ?>">
                                                        <?php if($validation->hasError('chwp_entering_pres')): ?>
                                                            <div class="invalid-feedback" style="white-space: normal;">
                                                                <?= $validation->getError('chwp_entering_pres'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 8px;">Leaving Water Pressure<br>&plusmn; 0.5 BAR - 2 BAR</td>
                                                    <td>
                                                        <input id="chwp_leaving_pres" name="chwp_leaving_pres" class="form-control <?= ($validation->hasError('chwp_leaving_pres')) ? 'is-invalid' : ''; ?>" value="<?= old('chwp_leaving_pres'); ?>">
                                                        <?php if($validation->hasError('chwp_leaving_pres')): ?>
                                                            <div class="invalid-feedback" style="white-space: normal;">
                                                                <?= $validation->getError('chwp_leaving_pres'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>

                                                <tr style="border: 0;">
                                                    <td style="border: 0;"></td>
                                                    <td style="border: 0;"></td>
                                                    <td style="border: 0;"></td>
                                                </tr>

                                                <tr>
                                                    <td rowspan="4">CWP Water Report</td>
                                                    <td>Entering Water Temp.<br>23&deg;C - 31&deg;C</td>
                                                    <td>
                                                        <input id="cwp_entering_temp" name="cwp_entering_temp" class="form-control <?= ($validation->hasError('cwp_entering_temp')) ? 'is-invalid' : ''; ?>" value="<?= old('cwp_entering_temp'); ?>">
                                                        <?php if($validation->hasError('cwp_entering_temp')): ?>
                                                            <div class="invalid-feedback" style="white-space: normal;">
                                                                <?= $validation->getError('cwp_entering_temp'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 8px;">Leaving Water Temp.<br>27&deg;C - 35&deg;C</td>
                                                    <td>
                                                        <input id="cwp_leaving_temp" name="cwp_leaving_temp" class="form-control <?= ($validation->hasError('cwp_leaving_temp')) ? 'is-invalid' : ''; ?>" value="<?= old('cwp_leaving_temp'); ?>">
                                                        <?php if($validation->hasError('cwp_leaving_temp')): ?>
                                                            <div class="invalid-feedback" style="white-space: normal;">
                                                                <?= $validation->getError('cwp_leaving_temp'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 8px;">Entering Water Pressure<br>1.5 BAR - 2.5 BAR</td>
                                                    <td>
                                                        <input id="cwp_entering_pres" name="cwp_entering_pres" class="form-control <?= ($validation->hasError('cwp_entering_pres')) ? 'is-invalid' : ''; ?>" value="<?= old('cwp_entering_pres'); ?>">
                                                        <?php if($validation->hasError('cwp_entering_pres')): ?>
                                                            <div class="invalid-feedback" style="white-space: normal;">
                                                                <?= $validation->getError('cwp_entering_pres'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 8px;">Leaving Water Pressure<br>&plusmn; 0.5 BAR - 1.5 BAR</td>
                                                    <td>
                                                        <input id="cwp_leaving_pres" name="cwp_leaving_pres" class="form-control <?= ($validation->hasError('cwp_leaving_pres')) ? 'is-invalid' : ''; ?>" value="<?= old('cwp_leaving_pres'); ?>">
                                                        <?php if($validation->hasError('cwp_leaving_pres')): ?>
                                                            <div class="invalid-feedback" style="white-space: normal;">
                                                                <?= $validation->getError('cwp_leaving_pres'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                                
                                                <tr style="border: 0;">
                                                    <td style="border: 0;"></td>
                                                    <td style="border: 0;"></td>
                                                    <td style="border: 0;"></td>
                                                </tr>

                                                <tr>
                                                    <td rowspan="7">Chiller Load Report</td>
                                                    <td>R - S<br>342 - 418 Vac</td>
                                                    <td>
                                                        <input id="rs" name="rs" class="form-control <?= ($validation->hasError('rs')) ? 'is-invalid' : ''; ?>" value="<?= old('rs'); ?>">
                                                        <?php if($validation->hasError('rs')): ?>
                                                            <div class="invalid-feedback" style="white-space: normal;">
                                                                <?= $validation->getError('rs'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 8px;">S - T<br>342 - 418 Vac</td>
                                                    <td>
                                                        <input id="st" name="st" class="form-control <?= ($validation->hasError('st')) ? 'is-invalid' : ''; ?>" value="<?= old('st'); ?>">
                                                        <?php if($validation->hasError('st')): ?>
                                                            <div class="invalid-feedback" style="white-space: normal;">
                                                                <?= $validation->getError('st'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 8px;">T - N<br>342 - 418 Vac</td>
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
                                                    <td style="padding-left: 8px;">R<br>80% In</td>
                                                    <td>
                                                        <input id="r" name="r" class="form-control <?= ($validation->hasError('r')) ? 'is-invalid' : ''; ?>" value="<?= old('r'); ?>">
                                                        <?php if($validation->hasError('r')): ?>
                                                            <div class="invalid-feedback" style="white-space: normal;">
                                                                <?= $validation->getError('r'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 8px;">S<br>80% In</td>
                                                    <td>
                                                        <input id="s" name="s" class="form-control <?= ($validation->hasError('s')) ? 'is-invalid' : ''; ?>" value="<?= old('s'); ?>">
                                                        <?php if($validation->hasError('s')): ?>
                                                            <div class="invalid-feedback" style="white-space: normal;">
                                                                <?= $validation->getError('s'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 8px;">T<br>80% In</td>
                                                    <td>
                                                        <input id="t" name="t" class="form-control <?= ($validation->hasError('t')) ? 'is-invalid' : ''; ?>" value="<?= old('t'); ?>">
                                                        <?php if($validation->hasError('t')): ?>
                                                            <div class="invalid-feedback" style="white-space: normal;">
                                                                <?= $validation->getError('t'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 8px;">KW</td>
                                                    <td>
                                                        <input id="kw" name="kw" class="form-control <?= ($validation->hasError('kw')) ? 'is-invalid' : ''; ?>" value="<?= old('kw'); ?>">
                                                        <?php if($validation->hasError('kw')): ?>
                                                            <div class="invalid-feedback" style="white-space: normal;">
                                                                <?= $validation->getError('kw'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                                
                                                <tr style="border: 0;">
                                                    <td style="border: 0;"></td>
                                                    <td style="border: 0;"></td>
                                                    <td style="border: 0;"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="table-responsive">
                                        <table class="table table-bordered card-table table-vcenter text-nowrap datatable" style="width:100%">
                                            <tbody>
                                                <tr style="border: 0;">
                                                    <td style="border: 0;"></td>
                                                    <td style="border: 0;"></td>
                                                    <td style="border: 0;"></td>
                                                </tr>
                                                
                                                <tr>
                                                    <td rowspan="9">Chiller Report</td>
                                                    <td>Evaporator Refrigerant Pressure<br>(KPA)</td>
                                                    <td>
                                                        <input id="eva_pres" name="eva_pres" class="form-control <?= ($validation->hasError('eva_pres')) ? 'is-invalid' : ''; ?>" value="<?= old('eva_pres'); ?>">
                                                        <?php if($validation->hasError('eva_pres')): ?>
                                                            <div class="invalid-feedback" style="white-space: normal;">
                                                                <?= $validation->getError('eva_pres'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 8px;">Condensor Refrigerant Pressure<br>(KPA)</td>
                                                    <td>
                                                        <input id="con_pres" name="con_pres" class="form-control <?= ($validation->hasError('con_pres')) ? 'is-invalid' : ''; ?>" value="<?= old('con_pres'); ?>">
                                                        <?php if($validation->hasError('con_pres')): ?>
                                                            <div class="invalid-feedback" style="white-space: normal;">
                                                                <?= $validation->getError('con_pres'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 8px;">Saturated Evaporator Refrigerant Temp.<br>(&deg;C)</td>
                                                    <td>
                                                        <input id="eva_temp" name="eva_temp" class="form-control <?= ($validation->hasError('eva_temp')) ? 'is-invalid' : ''; ?>" value="<?= old('eva_temp'); ?>">
                                                        <?php if($validation->hasError('eva_temp')): ?>
                                                            <div class="invalid-feedback" style="white-space: normal;">
                                                                <?= $validation->getError('eva_temp'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 8px;">Saturated Condensor Refrigerant Temp.<br>(&deg;C)</td>
                                                    <td>
                                                        <input id="con_temp" name="con_temp" class="form-control <?= ($validation->hasError('con_temp')) ? 'is-invalid' : ''; ?>" value="<?= old('con_temp'); ?>">
                                                        <?php if($validation->hasError('con_temp')): ?>
                                                            <div class="invalid-feedback" style="white-space: normal;">
                                                                <?= $validation->getError('con_temp'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 8px;">Compressor % RLA Average<br>(80%)</td>
                                                    <td>
                                                        <input id="rla" name="rla" class="form-control <?= ($validation->hasError('rla')) ? 'is-invalid' : ''; ?>" value="<?= old('rla'); ?>">
                                                        <?php if($validation->hasError('rla')): ?>
                                                            <div class="invalid-feedback" style="white-space: normal;">
                                                                <?= $validation->getError('rla'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 8px;">Compressor Start<br>(Hours)</td>
                                                    <td>
                                                        <input id="start" name="start" class="form-control <?= ($validation->hasError('start')) ? 'is-invalid' : ''; ?>" value="<?= old('start'); ?>">
                                                        <?php if($validation->hasError('start')): ?>
                                                            <div class="invalid-feedback" style="white-space: normal;" style="white-space: normal;">
                                                                <?= $validation->getError('start'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 8px;">Compressor Running<br>(Hours)</td>
                                                    <td>
                                                        <input id="running" name="running" class="form-control <?= ($validation->hasError('running')) ? 'is-invalid' : ''; ?>" value="<?= old('running'); ?>">
                                                        <?php if($validation->hasError('running')): ?>
                                                            <div class="invalid-feedback" style="white-space: normal;" style="white-space: normal;">
                                                                <?= $validation->getError('running'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 8px;">Oil Condensor Temp.<br>(&deg;C)</td>
                                                    <td>
                                                        <input id="oil_temp" name="oil_temp" class="form-control <?= ($validation->hasError('oil_temp')) ? 'is-invalid' : ''; ?>" value="<?= old('oil_temp'); ?>">
                                                        <?php if($validation->hasError('oil_temp')): ?>
                                                            <div class="invalid-feedback" style="white-space: normal;">
                                                                <?= $validation->getError('oil_temp'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 8px;">Chiller Water Set Point<br>10&deg;C - 14&deg;C</td>
                                                    <td>
                                                        <input id="set_point" name="set_point" class="form-control <?= ($validation->hasError('set_point')) ? 'is-invalid' : ''; ?>" value="<?= old('set_point'); ?>">
                                                        <?php if($validation->hasError('set_point')): ?>
                                                            <div class="invalid-feedback" style="white-space: normal;">
                                                                <?= $validation->getError('set_point'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>

                                                <tr style="border: 0;">
                                                    <td style="border: 0;"></td>
                                                    <td style="border: 0;"></td>
                                                    <td style="border: 0;"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="row">
                                        <div class="form-group">
                                            <label class="form-label row-form-label">Keterangan</label>
                                            <div class="row">
                                                <div class="input-icon mb-2">
                                                    <textarea id="description" name="description" class="form-control <?= ($validation->hasError('description')) ? 'is-invalid' : ''; ?>" rows="6"><?= old('description'); ?></textarea>
                                                    <?php if($validation->hasError('description')): ?>
                                                        <div style="font-size: 85.71428571%; color: #d63939; white-space: normal;">
                                                            <?= $validation->getError('description'); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-footer">
                                <div class="row align-items-center">
                                    <div class="col"></div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-outline-primary ms-auto" id="btnSubmitAcChiller" name="btnSubmitAcChiller">
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
                        <h3 class="card-title">AC Chiller Data</h3>
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
                                    <th>Chiller No. 1</th>
                                    <th>Chiller No. 2</th>
                                    <th>CHWP No. 1</th>
                                    <th>CHWP No. 2</th>
                                    <th>CHWP No. 3</th>
                                    <th>CHWP WATER REPORT<br>Entering Water Temp.<br>18&deg;C - 22&deg;C</th>
                                    <th>CHWP WATER REPORT<br>Leaving Water Pressure<br>14&deg;C - 18&deg;C</th>
                                    <th>CHWP WATER REPORT<br>Entering Water Temp.<br>2.5 BAR - 3.5 BAR</th>
                                    <th>CHWP WATER REPORT<br>Leaving Water Pressure<br>&plusmn; 0.5 BAR - 2 BAR</th>
                                    <th>CWP WATER REPORT<br>Entering Water Temp.<br>23&deg;C - 31&deg;C</th>
                                    <th>CWP WATER REPORT<br>Leaving Water Pressure<br>27&deg;C - 35&deg;C</th>
                                    <th>CWP WATER REPORT<br>Entering Water Temp.<br>1.5 BAR - 2.5 BAR</th>
                                    <th>CWP WATER REPORT<br>Leaving Water Pressure<br>&plusmn; 0.5 BAR - 1.5 BAR</th>
                                    <th>CHILLER LOAD REPORT<br>R - S<br>342 - 418 Vac</th>
                                    <th>CHILLER LOAD REPORT<br>S - T<br>342 - 418 Vac</th>
                                    <th>CHILLER LOAD REPORT<br>T - N<br>342 - 418 Vac</th>
                                    <th>CHILLER LOAD REPORT<br>R<br>80% In</th>
                                    <th>CHILLER LOAD REPORT<br>S<br>80% In</th>
                                    <th>CHILLER LOAD REPORT<br>T<br>80% In</th>
                                    <th>CHILLER LOAD REPORT<br>KW</th>
                                    <th>CHILLER REPORT<br>Evaporator Refrigerant Pressure<br>(KPA)</th>
                                    <th>CHILLER REPORT<br>Condensor Refrigerant Pressure<br>(KPA)</th>
                                    <th>CHILLER REPORT<br>Saturated Evaporator Refrigerant Temp.<br>(&deg;C)</th>
                                    <th>CHILLER REPORT<br>Saturated Condensor Refrigerant Temp.<br>(&deg;C)</th>
                                    <th>CHILLER REPORT<br>Compressor % RLA Average<br>(80%)</th>
                                    <th>CHILLER REPORT<br>Compressor Start<br>(Hours)</th>
                                    <th>CHILLER REPORT<br>Compressor Running<br>(Hours)</th>
                                    <th>CHILLER REPORT<br>Oil Condensor Temp.<br>(&deg;C)</th>
                                    <th>CHILLER REPORT<br>Chiller Water Set Point<br>10&deg;C - 14&deg;C</th>
                                    <th>Keterangan</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                    $n = 1;
                                ?>
                                <?php foreach($getAcChillerByStore as $t): ?>
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
                                        <td><?php if($t['chiller_1']) { echo("On"); } else { echo("Off"); } ?></td>
                                        <td><?php if($t['chiller_2']) { echo("On"); } else { echo("Off"); } ?></td>
                                        <td><?php if($t['chwp_1']) { echo("On"); } else { echo("Off"); } ?></td>
                                        <td><?php if($t['chwp_2']) { echo("On"); } else { echo("Off"); } ?></td>
                                        <td><?php if($t['chwp_3']) { echo("On"); } else { echo("Off"); } ?></td>
                                        <td><?= $t['chwp_entering_temp'] ?></td>
                                        <td><?= $t['chwp_leaving_temp'] ?></td>
                                        <td><?= $t['chwp_entering_pres'] ?></td>
                                        <td><?= $t['chwp_leaving_pres'] ?></td>
                                        <td><?= $t['cwp_entering_temp'] ?></td>
                                        <td><?= $t['cwp_leaving_temp'] ?></td>
                                        <td><?= $t['cwp_entering_pres'] ?></td>
                                        <td><?= $t['cwp_leaving_pres'] ?></td>
                                        <td><?= $t['rs'] ?></td>
                                        <td><?= $t['st'] ?></td>
                                        <td><?= $t['tn'] ?></td>
                                        <td><?= $t['r'] ?></td>
                                        <td><?= $t['s'] ?></td>
                                        <td><?= $t['t'] ?></td>
                                        <td><?= $t['kw'] ?></td>
                                        <td><?= $t['eva_pres'] ?></td>
                                        <td><?= $t['con_pres'] ?></td>
                                        <td><?= $t['eva_temp'] ?></td>
                                        <td><?= $t['con_temp'] ?></td>
                                        <td><?= $t['rla'] ?></td>
                                        <td><?= $t['start'] ?></td>
                                        <td><?= $t['running'] ?></td>
                                        <td><?= $t['oil_temp'] ?></td>
                                        <td><?= $t['set_point'] ?></td>
                                        <td><?= $t['description'] ?></td>
                                        
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
                                        <form id="editAcChillerForm" action="<?php echo base_url('acchiller/updateAcChiller/' . $t['id']); ?>" method="post">
                                            <div class="modal-dialog modal-xl modal-dialog-centered" role="dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit AC Chiller Data</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-lg-3">
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

                                                                        foreach($getAcChillerByStoreDate as $tt) {
                                                                            if($tt['date'] == $t['date']) {
                                                                                if(strval($tt['time']) == "10:00:00") {
                                                                                    $time1 = 1;
                                                                                }

                                                                                if(strval($tt['time']) == "19:00:00") {
                                                                                    $time2 = 1;
                                                                                }
                                                                            }
                                                                        }
                                                                    ?>

                                                                    <label class="form-label">Time</label>
                                                                    
                                                                    <input <?php if(strval($t['time']) == "10:00:00") { echo("checked"); } else { if($time1 == 1) { echo("disabled"); } } ?> id="edittime" name="edittime" type="checkbox" class="edittimechecks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('edittime'))) ? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditTime' . $n . '(this.value)' ?>;" value="10:00:00">
                                                                    <span <?php if((strval($t['time']) != "10:00:00") && ($time1 == 1)) { echo("style='opacity: 50%;'"); } ?>>10.00</span>
                                                                    
                                                                    <span style="padding-left: 20px;"></span>
                                                                    
                                                                    <input <?php if(strval($t['time']) == "19:00:00") { echo("checked"); } else { if($time2 == 1) { echo("disabled"); } } ?> id="edittime" name="edittime" type="checkbox" class="edittimechecks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('edittime'))) ? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditTime' . $n . '(this.value)' ?>;" value="19:00:00">
                                                                    <span <?php if((strval($t['time']) != "19:00:00") && ($time2 == 1)) { echo("style='opacity: 50%;'"); } ?>>19.00</span>

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

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="mb-3">
                                                                            <label class="form-label">Chiller No. 1</label>

                                                                            <input <?php if($t['chiller_1']) { echo("checked"); } ?> id="editchiller1" name="editchiller1" type="checkbox" class="editchiller1checks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editchiller1')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditChiller1' . $n . '(this.value)' ?>;" value="1">
                                                                            <span>On</span>
                                                                            
                                                                            <span style="padding-left: 20px;"></span>
                                                                            
                                                                            <input <?php if(!$t['chiller_1']) { echo("checked"); } ?> id="editchiller1" name="editchiller1" type="checkbox" class="editchiller1checks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editchiller1')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditChiller1' . $n . '(this.value)' ?>;" value="0">
                                                                            <span>Off</span>
                                                                            
                                                                            <?php if($validation->hasError('editchiller1')): ?>
                                                                                <div class="invalid-feedback">
                                                                                    <?= $validation->getError('editchiller1'); ?>
                                                                                </div>
                                                                            <?php endif; ?>

                                                                            <script>
                                                                                function checkEditChiller1<?= $n ?>(b){
                                                                                    var x = document.getElementsByClassName('editchiller1checks<?= $n ?>');
                                                                                    var i;

                                                                                    for(i = 0; i < x.length; i++) {
                                                                                        if(x[i].value != b) x[i].checked = false;
                                                                                    }
                                                                                }
                                                                            </script>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label class="form-label">Chiller No. 2</label>

                                                                            <input <?php if($t['chiller_2']) { echo("checked"); } ?> id="editchiller2" name="editchiller2" type="checkbox" class="editchiller2checks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editchiller2')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditChiller2' . $n . '(this.value)' ?>;" value="1">
                                                                            <span>On</span>
                                                                            
                                                                            <span style="padding-left: 20px;"></span>
                                                                            
                                                                            <input <?php if(!$t['chiller_2']) { echo("checked"); } ?> id="editchiller2" name="editchiller2" type="checkbox" class="editchiller2checks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editchiller2')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditChiller2' . $n . '(this.value)' ?>;" value="0">
                                                                            <span>Off</span>
                                                                            
                                                                            <?php if($validation->hasError('editchiller2')): ?>
                                                                                <div class="invalid-feedback">
                                                                                    <?= $validation->getError('editchiller2'); ?>
                                                                                </div>
                                                                            <?php endif; ?>

                                                                            <script>
                                                                                function checkEditChiller2<?= $n ?>(b){
                                                                                    var x = document.getElementsByClassName('editchiller2checks<?= $n ?>');
                                                                                    var i;

                                                                                    for(i = 0; i < x.length; i++) {
                                                                                        if(x[i].value != b) x[i].checked = false;
                                                                                    }
                                                                                }
                                                                            </script>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col">
                                                                        <div class="mb-3">
                                                                            <label class="form-label">CHWP No. 1</label>

                                                                            <input <?php if($t['chwp_1']) { echo("checked"); } ?> id="editchwp1" name="editchwp1" type="checkbox" class="editchwp1checks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editchwp1')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditChwp1' . $n . '(this.value)' ?>;" value="1">
                                                                            <span>On</span>
                                                                            
                                                                            <span style="padding-left: 20px;"></span>
                                                                            
                                                                            <input <?php if(!$t['chwp_1']) { echo("checked"); } ?> id="editchwp1" name="editchwp1" type="checkbox" class="editchwp1checks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editchwp1')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditChwp1' . $n . '(this.value)' ?>;" value="0">
                                                                            <span>Off</span>
                                                                            
                                                                            <?php if($validation->hasError('editchwp1')): ?>
                                                                                <div class="invalid-feedback">
                                                                                    <?= $validation->getError('editchwp1'); ?>
                                                                                </div>
                                                                            <?php endif; ?>

                                                                            <script>
                                                                                function checkEditChwp1<?= $n ?>(b){
                                                                                    var x = document.getElementsByClassName('editchwp1checks<?= $n ?>');
                                                                                    var i;

                                                                                    for(i = 0; i < x.length; i++) {
                                                                                        if(x[i].value != b) x[i].checked = false;
                                                                                    }
                                                                                }
                                                                            </script>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label class="form-label">CHWP No. 2</label>

                                                                            <input <?php if($t['chwp_2']) { echo("checked"); } ?> id="editchwp2" name="editchwp2" type="checkbox" class="editchwp2checks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editchwp2')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditChwp2' . $n . '(this.value)' ?>;" value="1">
                                                                            <span>On</span>
                                                                            
                                                                            <span style="padding-left: 20px;"></span>
                                                                            
                                                                            <input <?php if(!$t['chwp_2']) { echo("checked"); } ?> id="editchwp2" name="editchwp2" type="checkbox" class="editchwp2checks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editchwp2')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditChwp2' . $n . '(this.value)' ?>;" value="0">
                                                                            <span>Off</span>
                                                                            
                                                                            <?php if($validation->hasError('editchwp2')): ?>
                                                                                <div class="invalid-feedback">
                                                                                    <?= $validation->getError('editchwp2'); ?>
                                                                                </div>
                                                                            <?php endif; ?>

                                                                            <script>
                                                                                function checkEditChwp2<?= $n ?>(b){
                                                                                    var x = document.getElementsByClassName('editchwp2checks<?= $n ?>');
                                                                                    var i;

                                                                                    for(i = 0; i < x.length; i++) {
                                                                                        if(x[i].value != b) x[i].checked = false;
                                                                                    }
                                                                                }
                                                                            </script>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label class="form-label">CHWP No. 3</label>

                                                                            <input <?php if($t['chwp_3']) { echo("checked"); } ?> id="editchwp3" name="editchwp3" type="checkbox" class="editchwp3checks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editchwp3')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditChwp3' . $n . '(this.value)' ?>;" value="1">
                                                                            <span>On</span>
                                                                            
                                                                            <span style="padding-left: 20px;"></span>
                                                                            
                                                                            <input <?php if(!$t['chwp_3']) { echo("checked"); } ?> id="editchwp3" name="editchwp3" type="checkbox" class="editchwp3checks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editchwp3')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditChwp3' . $n . '(this.value)' ?>;" value="0">
                                                                            <span>Off</span>
                                                                            
                                                                            <?php if($validation->hasError('editchwp3')): ?>
                                                                                <div class="invalid-feedback">
                                                                                    <?= $validation->getError('editchwp3'); ?>
                                                                                </div>
                                                                            <?php endif; ?>

                                                                            <script>
                                                                                function checkEditChwp3<?= $n ?>(b){
                                                                                    var x = document.getElementsByClassName('editchwp3checks<?= $n ?>');
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

                                                            <div class="col-lg-3">
                                                                <div style="padding: 10px; background-color: aliceblue;">
                                                                    <div class="mb-3 text-center">
                                                                        <label class="form-label" style="color: lightsteelblue; font-weight: bold; opacity: 90%;">CHWP Water Report</label>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Entering Water Temp. 18&deg;C - 22&deg;C</label>

                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editchwpenteringtemp')))? 'is-invalid' : ''; ?>" id="editchwpenteringtemp" name="editchwpenteringtemp" value="<?= $t['chwp_entering_temp']; ?>">
                                                                        </div>

                                                                        <?php if(($t['id'] == old('editid')) && ($validation->hasError('editchwpenteringtemp'))): ?>
                                                                            <div style="font-size: 85.71428571%; color: #d63939;">
                                                                                <?= $validation->getError('editchwpenteringtemp'); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Leaving Water Temp. 14&deg;C - 18&deg;C</label>

                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editchwpleavingtemp')))? 'is-invalid' : ''; ?>" id="editchwpleavingtemp" name="editchwpleavingtemp" value="<?= $t['chwp_leaving_temp']; ?>">
                                                                        </div>

                                                                        <?php if(($t['id'] == old('editid')) && ($validation->hasError('editchwpleavingtemp'))): ?>
                                                                            <div style="font-size: 85.71428571%; color: #d63939;">
                                                                                <?= $validation->getError('editchwpleavingtemp'); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Entering Water Pressure 2.5 BAR - 3.5 BAR</label>

                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editchwpenteringpres')))? 'is-invalid' : ''; ?>" id="editchwpenteringpres" name="editchwpenteringpres" value="<?= $t['chwp_entering_pres']; ?>">
                                                                        </div>

                                                                        <?php if(($t['id'] == old('editid')) && ($validation->hasError('editchwpenteringpres'))): ?>
                                                                            <div style="font-size: 85.71428571%; color: #d63939;">
                                                                                <?= $validation->getError('editchwpenteringpres'); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Leaving Water Pressure &plusmn; 0.5 BAR - 2 BAR</label>

                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editchwpleavingpres')))? 'is-invalid' : ''; ?>" id="editchwpleavingpres" name="editchwpleavingpres" value="<?= $t['chwp_leaving_pres']; ?>">
                                                                        </div>

                                                                        <?php if(($t['id'] == old('editid')) && ($validation->hasError('editchwpleavingpres'))): ?>
                                                                            <div style="font-size: 85.71428571%; color: #d63939;">
                                                                                <?= $validation->getError('editchwpleavingpres'); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>

                                                                <div style="padding: 10px; background-color: aliceblue;">
                                                                    <div class="mb-3 text-center">
                                                                        <label class="form-label" style="color: lightsteelblue; font-weight: bold; opacity: 90%;">CWP Water Report</label>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Entering Water Temp. 23&deg;C - 31&deg;C</label>

                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editcwpenteringtemp')))? 'is-invalid' : ''; ?>" id="editcwpenteringtemp" name="editcwpenteringtemp" value="<?= $t['cwp_entering_temp']; ?>">
                                                                        </div>

                                                                        <?php if(($t['id'] == old('editid')) && ($validation->hasError('editcwpenteringtemp'))): ?>
                                                                            <div style="font-size: 85.71428571%; color: #d63939;">
                                                                                <?= $validation->getError('editcwpenteringtemp'); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Leaving Water Temp. 27&deg;C - 35&deg;C</label>

                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editcwpleavingtemp')))? 'is-invalid' : ''; ?>" id="editcwpleavingtemp" name="editcwpleavingtemp" value="<?= $t['cwp_leaving_temp']; ?>">
                                                                        </div>

                                                                        <?php if(($t['id'] == old('editid')) && ($validation->hasError('editcwpleavingtemp'))): ?>
                                                                            <div style="font-size: 85.71428571%; color: #d63939;">
                                                                                <?= $validation->getError('editcwpleavingtemp'); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Entering Water Pressure 1.5 BAR - 2.5 BAR</label>

                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editcwpenteringpres')))? 'is-invalid' : ''; ?>" id="editcwpenteringpres" name="editcwpenteringpres" value="<?= $t['cwp_entering_pres']; ?>">
                                                                        </div>

                                                                        <?php if(($t['id'] == old('editid')) && ($validation->hasError('editcwpenteringpres'))): ?>
                                                                            <div style="font-size: 85.71428571%; color: #d63939;">
                                                                                <?= $validation->getError('editcwpenteringpres'); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Leaving Water Pressure &plusmn; 0.5 BAR - 1.5 BAR</label>

                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editcwpleavingpres')))? 'is-invalid' : ''; ?>" id="editcwpleavingpres" name="editcwpleavingpres" value="<?= $t['cwp_leaving_pres']; ?>">
                                                                        </div>

                                                                        <?php if(($t['id'] == old('editid')) && ($validation->hasError('editcwpleavingpres'))): ?>
                                                                            <div style="font-size: 85.71428571%; color: #d63939;">
                                                                                <?= $validation->getError('editcwpleavingpres'); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-3">
                                                                <div style="padding: 10px; background-color: aliceblue;">
                                                                    <div class="mb-3 text-center">
                                                                        <label class="form-label" style="color: lightsteelblue; font-weight: bold; opacity: 90%;">Chiller Load Report</label>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">R - S 342 - 418 Vac</label>

                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editrs')))? 'is-invalid' : ''; ?>" id="editrs" name="editrs" value="<?= $t['rs']; ?>">
                                                                        </div>

                                                                        <?php if(($t['id'] == old('editid')) && ($validation->hasError('editrs'))): ?>
                                                                            <div style="font-size: 85.71428571%; color: #d63939;">
                                                                                <?= $validation->getError('editrs'); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">S - T 342 - 418 Vac</label>

                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editst')))? 'is-invalid' : ''; ?>" id="editst" name="editst" value="<?= $t['st']; ?>">
                                                                        </div>

                                                                        <?php if(($t['id'] == old('editid')) && ($validation->hasError('editst'))): ?>
                                                                            <div style="font-size: 85.71428571%; color: #d63939;">
                                                                                <?= $validation->getError('editst'); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">T - N 342 - 418 Vac</label>

                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('edittn')))? 'is-invalid' : ''; ?>" id="edittn" name="edittn" value="<?= $t['tn']; ?>">
                                                                        </div>

                                                                        <?php if(($t['id'] == old('editid')) && ($validation->hasError('edittn'))): ?>
                                                                            <div style="font-size: 85.71428571%; color: #d63939;">
                                                                                <?= $validation->getError('edittn'); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">R 80% In</label>

                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editr')))? 'is-invalid' : ''; ?>" id="editr" name="editr" value="<?= $t['r']; ?>">
                                                                        </div>

                                                                        <?php if(($t['id'] == old('editid')) && ($validation->hasError('editr'))): ?>
                                                                            <div style="font-size: 85.71428571%; color: #d63939;">
                                                                                <?= $validation->getError('editr'); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">S 80% In</label>

                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('edits')))? 'is-invalid' : ''; ?>" id="edits" name="edits" value="<?= $t['s']; ?>">
                                                                        </div>

                                                                        <?php if(($t['id'] == old('editid')) && ($validation->hasError('edits'))): ?>
                                                                            <div style="font-size: 85.71428571%; color: #d63939;">
                                                                                <?= $validation->getError('edits'); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">T 80% In</label>

                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editt')))? 'is-invalid' : ''; ?>" id="editt" name="editt" value="<?= $t['t']; ?>">
                                                                        </div>

                                                                        <?php if(($t['id'] == old('editid')) && ($validation->hasError('editt'))): ?>
                                                                            <div style="font-size: 85.71428571%; color: #d63939;">
                                                                                <?= $validation->getError('editt'); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">KW</label>

                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editkw')))? 'is-invalid' : ''; ?>" id="editkw" name="editkw" value="<?= $t['kw']; ?>">
                                                                        </div>

                                                                        <?php if(($t['id'] == old('editid')) && ($validation->hasError('editkw'))): ?>
                                                                            <div style="font-size: 85.71428571%; color: #d63939;">
                                                                                <?= $validation->getError('editkw'); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-3">
                                                                <div style="padding: 10px; background-color: aliceblue;">
                                                                    <div class="mb-3 text-center">
                                                                        <label class="form-label" style="color: lightsteelblue; font-weight: bold; opacity: 90%;">Chiller Report</label>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Evaporator Refrigerant Pressure (KPA)</label>

                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editevapres')))? 'is-invalid' : ''; ?>" id="editevapres" name="editevapres" value="<?= $t['eva_pres']; ?>">
                                                                        </div>

                                                                        <?php if(($t['id'] == old('editid')) && ($validation->hasError('editevapres'))): ?>
                                                                            <div style="font-size: 85.71428571%; color: #d63939;">
                                                                                <?= $validation->getError('editevapres'); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Condensor Refrigerant Pressure (KPA)</label>

                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editconpres')))? 'is-invalid' : ''; ?>" id="editconpres" name="editconpres" value="<?= $t['con_pres']; ?>">
                                                                        </div>

                                                                        <?php if(($t['id'] == old('editid')) && ($validation->hasError('editconpres'))): ?>
                                                                            <div style="font-size: 85.71428571%; color: #d63939;">
                                                                                <?= $validation->getError('editconpres'); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Saturated Evaporator Refrigerant Temp. (&deg;C)</label>

                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editevatemp')))? 'is-invalid' : ''; ?>" id="editevatemp" name="editevatemp" value="<?= $t['eva_temp']; ?>">
                                                                        </div>

                                                                        <?php if(($t['id'] == old('editid')) && ($validation->hasError('editevatemp'))): ?>
                                                                            <div style="font-size: 85.71428571%; color: #d63939;">
                                                                                <?= $validation->getError('editevatemp'); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Saturated Condensor Refrigerant Temp. (&deg;C)</label>

                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editcontemp')))? 'is-invalid' : ''; ?>" id="editcontemp" name="editcontemp" value="<?= $t['con_temp']; ?>">
                                                                        </div>
                                                                        
                                                                        <?php if(($t['id'] == old('editid')) && ($validation->hasError('editcontemp'))): ?>
                                                                            <div style="font-size: 85.71428571%; color: #d63939;">
                                                                                <?= $validation->getError('editcontemp'); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Compressor % RLA Average (80%)</label>

                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editrla')))? 'is-invalid' : ''; ?>" id="editrla" name="editrla" value="<?= $t['rla']; ?>">
                                                                        </div>

                                                                        <?php if(($t['id'] == old('editid')) && ($validation->hasError('editrla'))): ?>
                                                                            <div style="font-size: 85.71428571%; color: #d63939;">
                                                                                <?= $validation->getError('editrla'); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Compressor Start (Hours)</label>

                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editstart')))? 'is-invalid' : ''; ?>" id="editstart" name="editstart" value="<?= $t['start']; ?>">
                                                                        </div>
                                                                        
                                                                        <?php if(($t['id'] == old('editid')) && ($validation->hasError('editstart'))): ?>
                                                                            <div style="font-size: 85.71428571%; color: #d63939;">
                                                                                <?= $validation->getError('editstart'); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Compressor Running (Hours)</label>

                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editrunning')))? 'is-invalid' : ''; ?>" id="editrunning" name="editrunning" value="<?= $t['running']; ?>">
                                                                        </div>
                                                                        
                                                                        <?php if(($t['id'] == old('editid')) && ($validation->hasError('editrunning'))): ?>
                                                                            <div style="font-size: 85.71428571%; color: #d63939;">
                                                                                <?= $validation->getError('editrunning'); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Oil Condensor Temp. (&deg;C)</label>

                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editoiltemp')))? 'is-invalid' : ''; ?>" id="editoiltemp" name="editoiltemp" value="<?= $t['oil_temp']; ?>">
                                                                        </div>
                                                                        
                                                                        <?php if(($t['id'] == old('editid')) && ($validation->hasError('editoiltemp'))): ?>
                                                                            <div style="font-size: 85.71428571%; color: #d63939;">
                                                                                <?= $validation->getError('editoiltemp'); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Chiller Water Set Point 10&deg;C - 14&deg;C</label>

                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editsetpoint')))? 'is-invalid' : ''; ?>" id="editsetpoint" name="editsetpoint" value="<?= $t['set_point']; ?>">
                                                                        </div>
                                                                        
                                                                        <?php if(($t['id'] == old('editid')) && ($validation->hasError('editsetpoint'))): ?>
                                                                            <div style="font-size: 85.71428571%; color: #d63939;">
                                                                                <?= $validation->getError('editsetpoint'); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>

                                                                <div class="mb-3" style="margin-top: 15px;">
                                                                    <label class="form-label">Keterangan</label>

                                                                    <div class='row' style="margin: 0px;">
                                                                        <textarea class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editdescription')))? 'is-invalid' : ''; ?>" id="editdescription" name="editdescription" rows="3"><?= $t['description']; ?></textarea>
                                                                    </div>

                                                                    <?php if(($t['id'] == old('editid')) && ($validation->hasError('editdescription'))): ?>
                                                                        <div style="font-size: 85.71428571%; color: #d63939;">
                                                                            <?= $validation->getError('editdescription'); ?>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <div class="col-auto">
                                                            <button type="submit" class="btn btn-outline-primary ms-auto" id="btnUpdateAcChiller" name="btnUpdateAcChiller" data-bs-dismiss="modal" data-id="<?= $t['id']; ?>">
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
                                        <form id="deleteAcChillerForm" action="<?php echo base_url('acchiller/deleteAcChiller/' . $t['id']); ?>" method="post">
                                            <div class="modal-dialog modal-xl modal-dialog-centered" role="dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Delete AC Chiller Data</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-lg-3">
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
                                                                    <input type="text" class="form-control" value="<?= $t['worker_name']; ?>" disabled>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Checklist</label>
                                                                    <input type="text" class="form-control" value="Daily" disabled>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="mb-3">
                                                                            <label class="form-label">Chiller No. 1</label>

                                                                            <input <?php if($t['chiller_1']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                            <span>On</span>
                                                                            
                                                                            <span style="padding-left: 20px;"></span>
                                                                            
                                                                            <input <?php if(!$t['chiller_1']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                            <span>Off</span>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label class="form-label">Chiller No. 2</label>

                                                                            <input <?php if($t['chiller_2']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                            <span>On</span>
                                                                            
                                                                            <span style="padding-left: 20px;"></span>
                                                                            
                                                                            <input <?php if(!$t['chiller_2']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                            <span>Off</span>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col">
                                                                        <div class="mb-3">
                                                                            <label class="form-label">CHWP No. 1</label>

                                                                            <input <?php if($t['chwp_1']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                            <span>On</span>
                                                                            
                                                                            <span style="padding-left: 20px;"></span>
                                                                            
                                                                            <input <?php if(!$t['chwp_1']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                            <span>Off</span>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label class="form-label">CHWP No. 2</label>

                                                                            <input <?php if($t['chwp_2']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                            <span>On</span>
                                                                            
                                                                            <span style="padding-left: 20px;"></span>
                                                                            
                                                                            <input <?php if(!$t['chwp_2']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                            <span>Off</span>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label class="form-label">CHWP No. 3</label>

                                                                            <input <?php if($t['chwp_3']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                            <span>On</span>
                                                                            
                                                                            <span style="padding-left: 20px;"></span>
                                                                            
                                                                            <input <?php if(!$t['chwp_3']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                            <span>Off</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-3">
                                                                <div style="padding: 10px; background-color: aliceblue;">
                                                                    <div class="mb-3 text-center">
                                                                        <label class="form-label" style="color: lightsteelblue; font-weight: bold; opacity: 90%;">CHWP Water Report</label>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Entering Water Temp. 18&deg;C - 22&deg;C</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col" value="<?= $t['chwp_entering_temp']; ?>" disabled>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Leaving Water Temp. 14&deg;C - 18&deg;C</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col" value="<?= $t['chwp_leaving_temp']; ?>" disabled>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Entering Water Pressure 2.5 BAR - 3.5 BAR</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col" value="<?= $t['chwp_entering_pres']; ?>" disabled>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Leaving Water Pressure &plusmn; 0.5 BAR - 2 BAR</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col" value="<?= $t['chwp_leaving_pres']; ?>" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div style="padding: 10px; background-color: aliceblue;">
                                                                    <div class="mb-3 text-center">
                                                                        <label class="form-label" style="color: lightsteelblue; font-weight: bold; opacity: 90%;">CWP Water Report</label>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Entering Water Temp. 23&deg;C - 31&deg;C</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col" value="<?= $t['cwp_entering_temp']; ?>" disabled>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Leaving Water Temp. 27&deg;C - 35&deg;C</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col" value="<?= $t['cwp_leaving_temp']; ?>" disabled>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Entering Water Pressure 1.5 BAR - 2.5 BAR</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col" value="<?= $t['cwp_entering_pres']; ?>" disabled>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Leaving Water Pressure &plusmn; 0.5 BAR - 1.5 BAR</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col" value="<?= $t['cwp_leaving_pres']; ?>" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-3">
                                                                <div style="padding: 10px; background-color: aliceblue;">
                                                                    <div class="mb-3 text-center">
                                                                        <label class="form-label" style="color: lightsteelblue; font-weight: bold; opacity: 90%;">Chiller Load Report</label>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">R - S 342 - 418 Vac</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col" value="<?= $t['rs']; ?>" disabled>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">S - T 342 - 418 Vac</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col" value="<?= $t['st']; ?>" disabled>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">T - N 342 - 418 Vac</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col" value="<?= $t['tn']; ?>" disabled>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">R 80% In</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col" value="<?= $t['r']; ?>" disabled>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">S 80% In</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col" value="<?= $t['s']; ?>" disabled>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">T 80% In</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col" value="<?= $t['t']; ?>" disabled>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">KW</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col" value="<?= $t['kw']; ?>" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-3">
                                                                <div style="padding: 10px; background-color: aliceblue;">
                                                                    <div class="mb-3 text-center">
                                                                        <label class="form-label" style="color: lightsteelblue; font-weight: bold; opacity: 90%;">Chiller Report</label>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Evaporator Refrigerant Pressure (KPA)</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col" value="<?= $t['eva_pres']; ?>" disabled>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Condensor Refrigerant Pressure (KPA)</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col" value="<?= $t['con_pres']; ?>" disabled>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Saturated Evaporator Refrigerant Temp. (&deg;C)</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col" value="<?= $t['eva_temp']; ?>" disabled>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Saturated Condensor Refrigerant Temp. (&deg;C)</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col" value="<?= $t['con_temp']; ?>" disabled>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Compressor % RLA Average (80%)</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col" value="<?= $t['rla']; ?>" disabled>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Compressor Start (Hours)</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col" value="<?= $t['start']; ?>" disabled>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Compressor Running (Hours)</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col" value="<?= $t['running']; ?>" disabled>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Oil Condensor Temp. (&deg;C)</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col" value="<?= $t['oil_temp']; ?>" disabled>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Chiller Water Set Point 10&deg;C - 14&deg;C</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col" value="<?= $t['set_point']; ?>" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="mb-3" style="margin-top: 15px;">
                                                                    <label class="form-label">Keterangan</label>
                                                                    <div class='row' style="margin: 0px;">
                                                                        <textarea class="form-control col" rows="3" disabled><?= $t['description']; ?></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <div class="col-auto">
                                                            <button type="submit" class="btn btn-outline-danger ms-auto" id="btnDeleteAcChiller" name="btnDeleteAcChiller" data-bs-dismiss="modal" data-id="<?= $t['id']; ?>">
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
                                if($s['idEquipment'] > 8) {
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
            $("#description").html("");
        });
    })
</script>

<?= $this->endSection(); ?>