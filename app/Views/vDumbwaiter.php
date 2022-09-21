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
                        <h3 class="card-title">Dumbwaiter</h3>
                    </div>

                    <div class="card-body">
                        <form action="<?php echo base_url('dumbwaiter/saveDumbwaiter'); ?>" method="post">
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

                                                    foreach($getDumbwaiterByStoreDate as $t) {
                                                        if(strval($t['time']) == "10:00:00") {
                                                            $time1 = 1;
                                                        }
                                                    }
                                                ?>

                                                <input onclick="return false;" <?php if($time1 == 1) { echo("disabled"); } ?>checked id="time" name="time" type="checkbox" value="10:00:00" class="<?= ($validation->hasError('time')) ? 'is-invalid' : ''; ?>">
                                                <span <?php if($time1 == 1) { echo("style='opacity: 50%;'"); } ?>>10.00</span>

                                                <?php if($validation->hasError('time')): ?>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('time'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
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
                                                <input class="form-control" value="Weekly" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                            <div style="width: 100%; border-top: 1px solid lightgrey; height: 0; margin-top: 20px; margin-bottom: 20px;"></div>
                        
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
                                                    <td rowspan="8">Dumbwaiter</td>
                                                    <td>Emergency Stop</td>
                                                    <td>
                                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                                            <input <?php if(old('stop') == "1") { echo("checked"); } ?> id="stop" name="stop" type="checkbox" class="stopchecks <?= ($validation->hasError('stop')) ? 'is-invalid' : ''; ?>" onClick="checkStop(this.value);" value="1">
                                                            Baik<br>
                                                        </div>
                                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                                            <input <?php if(old('stop') == "0") { echo("checked"); } ?> id="stop" name="stop" type="checkbox" class="stopchecks <?= ($validation->hasError('stop')) ? 'is-invalid' : ''; ?>" onClick="checkStop(this.value);" value="0">
                                                            Rusak
                                                        </div>
                                                        <?php if($validation->hasError('stop')): ?>
                                                            <div style="font-size: 85.71428571%; color: #d63939; white-space: normal;">
                                                                <?= $validation->getError('stop'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                    <script>
                                                        function checkStop(b){
                                                            var x = document.getElementsByClassName('stopchecks');
                                                            var i;

                                                            for (i = 0; i < x.length; i++) {
                                                                if(x[i].value != b) x[i].checked = false;
                                                            }
                                                        }
                                                    </script>
                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 8px;">Motor</td>
                                                    <td>
                                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                                            <input <?php if(old('motor') == "1") { echo("checked"); } ?> id="motor" name="motor" type="checkbox" class="motorchecks <?= ($validation->hasError('motor')) ? 'is-invalid' : ''; ?>" onClick="checkMotor(this.value);" value="1">
                                                            Baik<br>
                                                        </div>
                                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                                            <input <?php if(old('motor') == "0") { echo("checked"); } ?> id="motor" name="motor" type="checkbox" class="motorchecks <?= ($validation->hasError('motor')) ? 'is-invalid' : ''; ?>" onClick="checkMotor(this.value);" value="0">
                                                            Rusak
                                                        </div>
                                                        <?php if($validation->hasError('motor')): ?>
                                                            <div style="font-size: 85.71428571%; color: #d63939; white-space: normal;">
                                                                <?= $validation->getError('motor'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                    <script>
                                                        function checkMotor(b){
                                                            var x = document.getElementsByClassName('motorchecks');
                                                            var i;

                                                            for (i = 0; i < x.length; i++) {
                                                                if(x[i].value != b) x[i].checked = false;
                                                            }
                                                        }
                                                    </script>
                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 8px;">Econo/VSD</td>
                                                    <td>
                                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                                            <input <?php if(old('vsd') == "1") { echo("checked"); } ?> id="vsd" name="vsd" type="checkbox" class="vsdchecks <?= ($validation->hasError('vsd')) ? 'is-invalid' : ''; ?>" onClick="checkVsd(this.value);" value="1">
                                                            Baik<br>
                                                        </div>
                                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                                            <input <?php if(old('vsd') == "0") { echo("checked"); } ?> id="vsd" name="vsd" type="checkbox" class="vsdchecks <?= ($validation->hasError('vsd')) ? 'is-invalid' : ''; ?>" onClick="checkVsd(this.value);" value="0">
                                                            Rusak
                                                        </div>
                                                        <?php if($validation->hasError('vsd')): ?>
                                                            <div style="font-size: 85.71428571%; color: #d63939; white-space: normal;">
                                                                <?= $validation->getError('vsd'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                    <script>
                                                        function checkVsd(b){
                                                            var x = document.getElementsByClassName('vsdchecks');
                                                            var i;

                                                            for (i = 0; i < x.length; i++) {
                                                                if(x[i].value != b) x[i].checked = false;
                                                            }
                                                        }
                                                    </script>
                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 8px;">Pintu</td>
                                                    <td>
                                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                                            <input <?php if(old('door') == "1") { echo("checked"); } ?> id="door" name="door" type="checkbox" class="doorchecks <?= ($validation->hasError('door')) ? 'is-invalid' : ''; ?>" onClick="checkDoor(this.value);" value="1">
                                                            Baik<br>
                                                        </div>
                                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                                            <input <?php if(old('door') == "0") { echo("checked"); } ?> id="door" name="door" type="checkbox" class="doorchecks <?= ($validation->hasError('door')) ? 'is-invalid' : ''; ?>" onClick="checkDoor(this.value);" value="0">
                                                            Rusak
                                                        </div>
                                                        <?php if($validation->hasError('door')): ?>
                                                            <div style="font-size: 85.71428571%; color: #d63939; white-space: normal;">
                                                                <?= $validation->getError('door'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                    <script>
                                                        function checkDoor(b){
                                                            var x = document.getElementsByClassName('doorchecks');
                                                            var i;

                                                            for (i = 0; i < x.length; i++) {
                                                                if(x[i].value != b) x[i].checked = false;
                                                            }
                                                        }
                                                    </script>
                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 8px;">Safety Switch</td>
                                                    <td>
                                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                                            <input <?php if(old('switch') == "1") { echo("checked"); } ?> id="switch" name="switch" type="checkbox" class="switchchecks <?= ($validation->hasError('switch')) ? 'is-invalid' : ''; ?>" onClick="checkSwitch(this.value);" value="1">
                                                            Baik<br>
                                                        </div>
                                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                                            <input <?php if(old('switch') == "0") { echo("checked"); } ?> id="switch" name="switch" type="checkbox" class="switchchecks <?= ($validation->hasError('switch')) ? 'is-invalid' : ''; ?>" onClick="checkSwitch(this.value);" value="0">
                                                            Rusak
                                                        </div>
                                                        <?php if($validation->hasError('switch')): ?>
                                                            <div style="font-size: 85.71428571%; color: #d63939; white-space: normal;">
                                                                <?= $validation->getError('switch'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                    <script>
                                                        function checkSwitch(b){
                                                            var x = document.getElementsByClassName('switchchecks');
                                                            var i;

                                                            for (i = 0; i < x.length; i++) {
                                                                if(x[i].value != b) x[i].checked = false;
                                                            }
                                                        }
                                                    </script>
                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 8px;">Brake</td>
                                                    <td>
                                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                                            <input <?php if(old('brake') == "1") { echo("checked"); } ?> id="brake" name="brake" type="checkbox" class="brakechecks <?= ($validation->hasError('brake')) ? 'is-invalid' : ''; ?>" onClick="checkBrake(this.value);" value="1">
                                                            Baik<br>
                                                        </div>
                                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                                            <input <?php if(old('brake') == "0") { echo("checked"); } ?> id="brake" name="brake" type="checkbox" class="brakechecks <?= ($validation->hasError('brake')) ? 'is-invalid' : ''; ?>" onClick="checkBrake(this.value);" value="0">
                                                            Rusak
                                                        </div>
                                                        <?php if($validation->hasError('brake')): ?>
                                                            <div style="font-size: 85.71428571%; color: #d63939; white-space: normal;">
                                                                <?= $validation->getError('brake'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                    <script>
                                                        function checkBrake(b){
                                                            var x = document.getElementsByClassName('brakechecks');
                                                            var i;

                                                            for (i = 0; i < x.length; i++) {
                                                                if(x[i].value != b) x[i].checked = false;
                                                            }
                                                        }
                                                    </script>
                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 8px;">Tombol</td>
                                                    <td>
                                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                                            <input <?php if(old('button') == "1") { echo("checked"); } ?> id="button" name="button" type="checkbox" class="buttonchecks <?= ($validation->hasError('button')) ? 'is-invalid' : ''; ?>" onClick="checkButton(this.value);" value="1">
                                                            Baik<br>
                                                        </div>
                                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                                            <input <?php if(old('button') == "0") { echo("checked"); } ?> id="button" name="button" type="checkbox" class="buttonchecks <?= ($validation->hasError('button')) ? 'is-invalid' : ''; ?>" onClick="checkButton(this.value);" value="0">
                                                            Rusak
                                                        </div>
                                                        <?php if($validation->hasError('button')): ?>
                                                            <div style="font-size: 85.71428571%; color: #d63939; white-space: normal;">
                                                                <?= $validation->getError('button'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                    <script>
                                                        function checkButton(b){
                                                            var x = document.getElementsByClassName('buttonchecks');
                                                            var i;

                                                            for (i = 0; i < x.length; i++) {
                                                                if(x[i].value != b) x[i].checked = false;
                                                            }
                                                        }
                                                    </script>
                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 8px;">Intercom</td>
                                                    <td>
                                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                                            <input <?php if(old('intercom') == "1") { echo("checked"); } ?> id="intercom" name="intercom" type="checkbox" class="intercomchecks <?= ($validation->hasError('intercom')) ? 'is-invalid' : ''; ?>" onClick="checkIntercom(this.value);" value="1">
                                                            Baik<br>
                                                        </div>
                                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                                            <input <?php if(old('intercom') == "0") { echo("checked"); } ?> id="intercom" name="intercom" type="checkbox" class="intercomchecks <?= ($validation->hasError('intercom')) ? 'is-invalid' : ''; ?>" onClick="checkIntercom(this.value);" value="0">
                                                            Rusak
                                                        </div>
                                                        <?php if($validation->hasError('intercom')): ?>
                                                            <div style="font-size: 85.71428571%; color: #d63939; white-space: normal;">
                                                                <?= $validation->getError('intercom'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                    <script>
                                                        function checkIntercom(b){
                                                            var x = document.getElementsByClassName('intercomchecks');
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
                                                    <td rowspan="3">Inspeksi</td>
                                                    <td>Noise</td>
                                                    <td>
                                                        <input id="noise" name="noise" class="form-control <?= ($validation->hasError('noise')) ? 'is-invalid' : ''; ?>" value="<?= old('noise'); ?>">
                                                        <?php if($validation->hasError('noise')): ?>
                                                            <div class="invalid-feedback" style="white-space: normal;">
                                                                <?= $validation->getError('noise'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 8px;">Temperature</td>
                                                    <td>
                                                        <input id="temperature" name="temperature" class="form-control <?= ($validation->hasError('temperature')) ? 'is-invalid' : ''; ?>" value="<?= old('temperature'); ?>">
                                                        <?php if($validation->hasError('temperature')): ?>
                                                            <div class="invalid-feedback" style="white-space: normal;">
                                                                <?= $validation->getError('temperature'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 8px;">Vibrasi</td>
                                                    <td>
                                                        <input id="vibration" name="vibration" class="form-control <?= ($validation->hasError('vibration')) ? 'is-invalid' : ''; ?>" value="<?= old('vibration'); ?>">
                                                        <?php if($validation->hasError('vibration')): ?>
                                                            <div class="invalid-feedback" style="white-space: normal;">
                                                                <?= $validation->getError('vibration'); ?>
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
                                        <button type="submit" class="btn btn-outline-primary ms-auto" id="btnSubmitDumbwaiter" name="btnSubmitDumbwaiter">
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
                        <h3 class="card-title">Dumbwaiter Data</h3>
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
                                    <th>DUMBWAITER<br>Emergency Stop</th>
                                    <th>DUMBWAITER<br>Motor</th>
                                    <th>DUMBWAITER<br>Econo/VSD</th>
                                    <th>DUMBWAITER<br>Pintu</th>
                                    <th>DUMBWAITER<br>Safety Switch</th>
                                    <th>DUMBWAITER<br>Brake</th>
                                    <th>DUMBWAITER<br>Tombol</th>
                                    <th>DUMBWAITER<br>Intercom</th>
                                    <th>INSPEKSI<br>Noise</th>
                                    <th>INSPEKSI<br>Temperature</th>
                                    <th>INSPEKSI<br>Vibrasi</th>
                                    <th>Keterangan</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                    $n = 1;
                                ?>
                                <?php foreach($getDumbwaiterByStore as $t): ?>
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
                                        <td><?php if($t['stop']) { echo("Baik"); } else { echo("Rusak"); } ?></td>
                                        <td><?php if($t['motor']) { echo("Baik"); } else { echo("Rusak"); } ?></td>
                                        <td><?php if($t['vsd']) { echo("Baik"); } else { echo("Rusak"); } ?></td>
                                        <td><?php if($t['door']) { echo("Baik"); } else { echo("Rusak"); } ?></td>
                                        <td><?php if($t['switch']) { echo("Baik"); } else { echo("Rusak"); } ?></td>
                                        <td><?php if($t['brake']) { echo("Baik"); } else { echo("Rusak"); } ?></td>
                                        <td><?php if($t['button']) { echo("Baik"); } else { echo("Rusak"); } ?></td>
                                        <td><?php if($t['intercom']) { echo("Baik"); } else { echo("Rusak"); } ?></td>
                                        <td><?= $t['noise'] ?></td>
                                        <td><?= $t['temperature'] ?></td>
                                        <td><?= $t['vibration'] ?></td>
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
                                        <form id="editDumbwaiterForm" action="<?php echo base_url('dumbwaiter/updateDumbwaiter/' . $t['id']); ?>" method="post">
                                            <div class="modal-dialog modal-lg modal-dialog-centered" role="dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Dumbwaiter Data</h5>
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
                                                                    <label class="form-label">Time</label>
                                                                    
                                                                    <input checked id="edittime" name="edittime" type="checkbox" onclick="return false;" value="10:00:00">
                                                                    <span>10.00</span>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Worker</label>
                                                                    <input type="text" class="form-control" value="<?= $name; ?>*" disabled>
                                                                    <input type="text" class="form-control" id="editworker" name="editworker" value="<?= $id; ?>" hidden>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Checklist</label>
                                                                    <input type="text" class="form-control" value="Weekly" disabled>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-4">
                                                                <div style="padding: 10px; background-color: aliceblue;">
                                                                    <div class="mb-3 text-center">
                                                                        <label class="form-label" style="color: lightsteelblue; font-weight: bold; opacity: 90%;">Dumbwaiter</label>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Emergency Stop</label>

                                                                        <input <?php if($t['stop']) { echo("checked"); } ?> id="editstop" name="editstop" type="checkbox" class="editstopchecks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editstop')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditStop' . $n . '(this.value)' ?>;" value="1">
                                                                        <span>Baik</span>
                                                                        
                                                                        <span style="padding-left: 20px;"></span>
                                                                        
                                                                        <input <?php if(!$t['stop']) { echo("checked"); } ?> id="editstop" name="editstop" type="checkbox" class="editstopchecks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editstop')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditStop' . $n . '(this.value)' ?>;" value="0">
                                                                        <span>Rusak</span>
                                                                        
                                                                        <?php if($validation->hasError('editstop')): ?>
                                                                            <div class="invalid-feedback" style="white-space: normal;">
                                                                                <?= $validation->getError('editstop'); ?>
                                                                            </div>
                                                                        <?php endif; ?>

                                                                        <script>
                                                                            function checkEditStop<?= $n ?>(b){
                                                                                var x = document.getElementsByClassName('editstopchecks<?= $n ?>');
                                                                                var i;

                                                                                for(i = 0; i < x.length; i++) {
                                                                                    if(x[i].value != b) x[i].checked = false;
                                                                                }
                                                                            }
                                                                        </script>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Motor</label>

                                                                        <input <?php if($t['motor']) { echo("checked"); } ?> id="editmotor" name="editmotor" type="checkbox" class="editmotorchecks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editmotor')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditMotor' . $n . '(this.value)' ?>;" value="1">
                                                                        <span>Baik</span>
                                                                        
                                                                        <span style="padding-left: 20px;"></span>
                                                                        
                                                                        <input <?php if(!$t['motor']) { echo("checked"); } ?> id="editmotor" name="editmotor" type="checkbox" class="editmotorchecks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editmotor')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditMotor' . $n . '(this.value)' ?>;" value="0">
                                                                        <span>Rusak</span>
                                                                        
                                                                        <?php if($validation->hasError('editmotor')): ?>
                                                                            <div class="invalid-feedback" style="white-space: normal;">
                                                                                <?= $validation->getError('editmotor'); ?>
                                                                            </div>
                                                                        <?php endif; ?>

                                                                        <script>
                                                                            function checkEditMotor<?= $n ?>(b){
                                                                                var x = document.getElementsByClassName('editmotorchecks<?= $n ?>');
                                                                                var i;

                                                                                for(i = 0; i < x.length; i++) {
                                                                                    if(x[i].value != b) x[i].checked = false;
                                                                                }
                                                                            }
                                                                        </script>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Econo/VSD</label>

                                                                        <input <?php if($t['vsd']) { echo("checked"); } ?> id="editvsd" name="editvsd" type="checkbox" class="editvsdchecks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editvsd')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditVsd' . $n . '(this.value)' ?>;" value="1">
                                                                        <span>Baik</span>
                                                                        
                                                                        <span style="padding-left: 20px;"></span>
                                                                        
                                                                        <input <?php if(!$t['vsd']) { echo("checked"); } ?> id="editvsd" name="editvsd" type="checkbox" class="editvsdchecks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editvsd')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditVsd' . $n . '(this.value)' ?>;" value="0">
                                                                        <span>Rusak</span>
                                                                        
                                                                        <?php if($validation->hasError('editvsd')): ?>
                                                                            <div class="invalid-feedback" style="white-space: normal;">
                                                                                <?= $validation->getError('editvsd'); ?>
                                                                            </div>
                                                                        <?php endif; ?>

                                                                        <script>
                                                                            function checkEditVsd<?= $n ?>(b){
                                                                                var x = document.getElementsByClassName('editvsdchecks<?= $n ?>');
                                                                                var i;

                                                                                for(i = 0; i < x.length; i++) {
                                                                                    if(x[i].value != b) x[i].checked = false;
                                                                                }
                                                                            }
                                                                        </script>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Pintu</label>

                                                                        <input <?php if($t['door']) { echo("checked"); } ?> id="editdoor" name="editdoor" type="checkbox" class="editdoorchecks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editdoor')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditDoor' . $n . '(this.value)' ?>;" value="1">
                                                                        <span>Baik</span>
                                                                        
                                                                        <span style="padding-left: 20px;"></span>
                                                                        
                                                                        <input <?php if(!$t['door']) { echo("checked"); } ?> id="editdoor" name="editdoor" type="checkbox" class="editdoorchecks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editdoor')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditDoor' . $n . '(this.value)' ?>;" value="0">
                                                                        <span>Rusak</span>
                                                                        
                                                                        <?php if($validation->hasError('editdoor')): ?>
                                                                            <div class="invalid-feedback" style="white-space: normal;">
                                                                                <?= $validation->getError('editdoor'); ?>
                                                                            </div>
                                                                        <?php endif; ?>

                                                                        <script>
                                                                            function checkEditDoor<?= $n ?>(b){
                                                                                var x = document.getElementsByClassName('editdoorchecks<?= $n ?>');
                                                                                var i;

                                                                                for(i = 0; i < x.length; i++) {
                                                                                    if(x[i].value != b) x[i].checked = false;
                                                                                }
                                                                            }
                                                                        </script>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Safety Switch</label>

                                                                        <input <?php if($t['switch']) { echo("checked"); } ?> id="editswitch" name="editswitch" type="checkbox" class="editswitchchecks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editswitch')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditSwitch' . $n . '(this.value)' ?>;" value="1">
                                                                        <span>Baik</span>
                                                                        
                                                                        <span style="padding-left: 20px;"></span>
                                                                        
                                                                        <input <?php if(!$t['switch']) { echo("checked"); } ?> id="editswitch" name="editswitch" type="checkbox" class="editswitchchecks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editswitch')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditSwitch' . $n . '(this.value)' ?>;" value="0">
                                                                        <span>Rusak</span>
                                                                        
                                                                        <?php if($validation->hasError('editswitch')): ?>
                                                                            <div class="invalid-feedback" style="white-space: normal;">
                                                                                <?= $validation->getError('editswitch'); ?>
                                                                            </div>
                                                                        <?php endif; ?>

                                                                        <script>
                                                                            function checkEditSwitch<?= $n ?>(b){
                                                                                var x = document.getElementsByClassName('editswitchchecks<?= $n ?>');
                                                                                var i;

                                                                                for(i = 0; i < x.length; i++) {
                                                                                    if(x[i].value != b) x[i].checked = false;
                                                                                }
                                                                            }
                                                                        </script>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Brake</label>

                                                                        <input <?php if($t['brake']) { echo("checked"); } ?> id="editbrake" name="editbrake" type="checkbox" class="editbrakechecks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editbrake')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditBrake' . $n . '(this.value)' ?>;" value="1">
                                                                        <span>Baik</span>
                                                                        
                                                                        <span style="padding-left: 20px;"></span>
                                                                        
                                                                        <input <?php if(!$t['brake']) { echo("checked"); } ?> id="editbrake" name="editbrake" type="checkbox" class="editbrakechecks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editbrake')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditBrake' . $n . '(this.value)' ?>;" value="0">
                                                                        <span>Rusak</span>
                                                                        
                                                                        <?php if($validation->hasError('editbrake')): ?>
                                                                            <div class="invalid-feedback" style="white-space: normal;">
                                                                                <?= $validation->getError('editbrake'); ?>
                                                                            </div>
                                                                        <?php endif; ?>

                                                                        <script>
                                                                            function checkEditBrake<?= $n ?>(b){
                                                                                var x = document.getElementsByClassName('editbrakechecks<?= $n ?>');
                                                                                var i;

                                                                                for(i = 0; i < x.length; i++) {
                                                                                    if(x[i].value != b) x[i].checked = false;
                                                                                }
                                                                            }
                                                                        </script>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Tombol</label>

                                                                        <input <?php if($t['button']) { echo("checked"); } ?> id="editbutton" name="editbutton" type="checkbox" class="editbuttonchecks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editbutton')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditButton' . $n . '(this.value)' ?>;" value="1">
                                                                        <span>Baik</span>
                                                                        
                                                                        <span style="padding-left: 20px;"></span>
                                                                        
                                                                        <input <?php if(!$t['button']) { echo("checked"); } ?> id="editbutton" name="editbutton" type="checkbox" class="editbuttonchecks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editbutton')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditButton' . $n . '(this.value)' ?>;" value="0">
                                                                        <span>Rusak</span>
                                                                        
                                                                        <?php if($validation->hasError('editbutton')): ?>
                                                                            <div class="invalid-feedback" style="white-space: normal;">
                                                                                <?= $validation->getError('editbutton'); ?>
                                                                            </div>
                                                                        <?php endif; ?>

                                                                        <script>
                                                                            function checkEditButton<?= $n ?>(b){
                                                                                var x = document.getElementsByClassName('editbuttonchecks<?= $n ?>');
                                                                                var i;

                                                                                for(i = 0; i < x.length; i++) {
                                                                                    if(x[i].value != b) x[i].checked = false;
                                                                                }
                                                                            }
                                                                        </script>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Intercom</label>

                                                                        <input <?php if($t['intercom']) { echo("checked"); } ?> id="editintercom" name="editintercom" type="checkbox" class="editintercomchecks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editintercom')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditIntercom' . $n . '(this.value)' ?>;" value="1">
                                                                        <span>Baik</span>
                                                                        
                                                                        <span style="padding-left: 20px;"></span>
                                                                        
                                                                        <input <?php if(!$t['intercom']) { echo("checked"); } ?> id="editintercom" name="editintercom" type="checkbox" class="editintercomchecks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editintercom')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditIntercom' . $n . '(this.value)' ?>;" value="0">
                                                                        <span>Rusak</span>
                                                                        
                                                                        <?php if($validation->hasError('editintercom')): ?>
                                                                            <div class="invalid-feedback" style="white-space: normal;">
                                                                                <?= $validation->getError('editintercom'); ?>
                                                                            </div>
                                                                        <?php endif; ?>

                                                                        <script>
                                                                            function checkEditIntercom<?= $n ?>(b){
                                                                                var x = document.getElementsByClassName('editintercomchecks<?= $n ?>');
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
                                                                        <label class="form-label" style="color: lightsteelblue; font-weight: bold; opacity: 90%;">Inspeksi</label>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Noise</label>

                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editnoise')))? 'is-invalid' : ''; ?>" id="editnoise" name="editnoise" value="<?= $t['noise']; ?>">
                                                                        </div>

                                                                        <?php if(($t['id'] == old('editid')) && ($validation->hasError('editnoise'))): ?>
                                                                            <div style="font-size: 85.71428571%; color: #d63939; white-space: normal;">
                                                                                <?= $validation->getError('editnoise'); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Temperature</label>

                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('edittemperature')))? 'is-invalid' : ''; ?>" id="edittemperature" name="edittemperature" value="<?= $t['temperature']; ?>">
                                                                        </div>

                                                                        <?php if(($t['id'] == old('editid')) && ($validation->hasError('edittemperature'))): ?>
                                                                            <div style="font-size: 85.71428571%; color: #d63939; white-space: normal;">
                                                                                <?= $validation->getError('edittemperature'); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Vibrasi</label>

                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editvibration')))? 'is-invalid' : ''; ?>" id="editvibration" name="editvibration" value="<?= $t['vibration']; ?>">
                                                                        </div>

                                                                        <?php if(($t['id'] == old('editid')) && ($validation->hasError('editvibration'))): ?>
                                                                            <div style="font-size: 85.71428571%; color: #d63939; white-space: normal;">
                                                                                <?= $validation->getError('editvibration'); ?>
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
                                                                        <div style="font-size: 85.71428571%; color: #d63939; white-space: normal;">
                                                                            <?= $validation->getError('editdescription'); ?>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <div class="col-auto">
                                                            <button type="submit" class="btn btn-outline-primary ms-auto" id="btnUpdateDumbwaiter" name="btnUpdateDumbwaiter" data-bs-dismiss="modal" data-id="<?= $t['id']; ?>">
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
                                        <form id="deleteDumbwaiterForm" action="<?php echo base_url('dumbwaiter/deleteDumbwaiter/' . $t['id']); ?>" method="post">
                                            <div class="modal-dialog modal-lg modal-dialog-centered" role="dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Delete Dumbwaiter Data</h5>
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
                                                                    
                                                                    <input checked type="checkbox" onclick="return false;" value="10:00:00">
                                                                    <span>10.00</span>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Worker</label>
                                                                    <input type="text" class="form-control" value="<?= $t['worker_name']; ?>" disabled>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Checklist</label>
                                                                    <input type="text" class="form-control" value="Weekly" disabled>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-4">
                                                                <div style="padding: 10px; background-color: aliceblue;">
                                                                    <div class="mb-3 text-center">
                                                                        <label class="form-label" style="color: lightsteelblue; font-weight: bold; opacity: 90%;">Dumbwaiter</label>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Emergency Stop</label>

                                                                        <input <?php if($t['stop']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                        <span>Baik</span>
                                                                        
                                                                        <span style="padding-left: 20px;"></span>
                                                                        
                                                                        <input <?php if(!$t['stop']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                        <span>Rusak</span>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Motor</label>

                                                                        <input <?php if($t['motor']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                        <span>Baik</span>
                                                                        
                                                                        <span style="padding-left: 20px;"></span>
                                                                        
                                                                        <input <?php if(!$t['motor']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                        <span>Rusak</span>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Econo/VSD</label>

                                                                        <input <?php if($t['vsd']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                        <span>Baik</span>
                                                                        
                                                                        <span style="padding-left: 20px;"></span>
                                                                        
                                                                        <input <?php if(!$t['vsd']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                        <span>Rusak</span>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Pintu</label>

                                                                        <input <?php if($t['door']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                        <span>Baik</span>
                                                                        
                                                                        <span style="padding-left: 20px;"></span>
                                                                        
                                                                        <input <?php if(!$t['door']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                        <span>Rusak</span>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Safety Switch</label>

                                                                        <input <?php if($t['switch']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                        <span>Baik</span>
                                                                        
                                                                        <span style="padding-left: 20px;"></span>
                                                                        
                                                                        <input <?php if(!$t['switch']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                        <span>Rusak</span>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Brake</label>

                                                                        <input <?php if($t['brake']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                        <span>Baik</span>
                                                                        
                                                                        <span style="padding-left: 20px;"></span>
                                                                        
                                                                        <input <?php if(!$t['brake']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                        <span>Rusak</span>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Tombol</label>

                                                                        <input <?php if($t['button']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                        <span>Baik</span>
                                                                        
                                                                        <span style="padding-left: 20px;"></span>
                                                                        
                                                                        <input <?php if(!$t['button']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                        <span>Rusak</span>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Intercom</label>

                                                                        <input <?php if($t['intercom']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                        <span>Baik</span>
                                                                        
                                                                        <span style="padding-left: 20px;"></span>
                                                                        
                                                                        <input <?php if(!$t['intercom']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                        <span>Rusak</span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-4">
                                                                <div style="padding: 10px; background-color: aliceblue;">
                                                                    <div class="mb-3 text-center">
                                                                        <label class="form-label" style="color: lightsteelblue; font-weight: bold; opacity: 90%;">Inspeksi</label>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Noise</label>

                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col" value="<?= $t['noise']; ?>" disabled>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Temperature</label>

                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col" value="<?= $t['temperature']; ?>" disabled>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Vibrasi</label>

                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col" value="<?= $t['vibration']; ?>" disabled>
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
                                                            <button type="submit" class="btn btn-outline-danger ms-auto" id="btnDeleteDumbwaiter" name="btnDeleteDumbwaiter" data-bs-dismiss="modal" data-id="<?= $t['id']; ?>">
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
                                if($s['idEquipment'] > 16) {
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
            $("input[type=checkbox]:not(:disabled):not(:hidden):not(#time)").removeAttr('checked');
            $("input:not([type=checkbox]):not(:disabled):not(:hidden)").attr("value","");
            $("#description").html("");
        });
    })
</script>

<?= $this->endSection(); ?>