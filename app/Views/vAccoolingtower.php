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
                        <h3 class="card-title">AC Cooling Tower</h3>
                    </div>

                    <div class="card-body">
                        <form action="<?php echo base_url('accoolingtower/saveAcCoolingTower'); ?>" method="post">
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

                                                    foreach($getAcCoolingTowerByStoreDate as $t) {
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
                        
                            <div class="row">
                                <div class="col">
                                    <div class="row" style="padding-top: 20px;">
                                        <div class="col-lg-6">
                                            <div class="form-group mb-3 row">
                                                <label class="form-label col-5">Cooling Tow. 1</label>
                                                <div class="col">
                                                    <div>
                                                        <input <?php if(old('cooling_1') == "1") { echo("checked"); } ?> id="cooling_1" name="cooling_1" type="checkbox" class="coolingtower1checks <?= ($validation->hasError('cooling_1')) ? 'is-invalid' : ''; ?>" onClick="checkCoolingTower1(this.value);" value="1">
                                                        On
                                                        <span style="padding-left: 20px;"></span>
                                                        <input <?php if(old('cooling_1') == "0") { echo("checked"); } ?> id="cooling_1" name="cooling_1" type="checkbox" class="coolingtower1checks <?= ($validation->hasError('cooling_1')) ? 'is-invalid' : ''; ?>" onClick="checkCoolingTower1(this.value);" value="0">
                                                        Off
                                                    </div>
                                                    <?php if($validation->hasError('cooling_1')): ?>
                                                        <div style="font-size: 85.71428571%; color: #d63939; white-space: normal;">
                                                            <?= $validation->getError('cooling_1'); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                    <script>
                                                        function checkCoolingTower1(b){
                                                            var x = document.getElementsByClassName('coolingtower1checks');
                                                            var i;

                                                            for (i = 0; i < x.length; i++) {
                                                                if(x[i].value != b) x[i].checked = false;
                                                            }
                                                        }
                                                    </script>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group mb-3 row">
                                                <label class="form-label col-5">CWP No. 1</label>
                                                <div class="col">
                                                    <div>
                                                        <input <?php if(old('cwp_1') == "1") { echo("checked"); } ?> id="cwp_1" name="cwp_1" type="checkbox" class="cwp1checks <?= ($validation->hasError('cwp_1')) ? 'is-invalid' : ''; ?>" onClick="checkCWP1(this.value);" value="1">
                                                        On
                                                        <span style="padding-left: 20px;"></span>
                                                        <input <?php if(old('cwp_1') == "0") { echo("checked"); } ?> id="cwp_1" name="cwp_1" type="checkbox" class="cwp1checks <?= ($validation->hasError('cwp_1')) ? 'is-invalid' : ''; ?>" onClick="checkCWP1(this.value);" value="0">
                                                        Off
                                                    </div>
                                                    <?php if($validation->hasError('cwp_1')): ?>
                                                        <div style="font-size: 85.71428571%; color: #d63939; white-space: normal;">
                                                            <?= $validation->getError('cwp_1'); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                    <script>
                                                        function checkCWP1(b){
                                                            var x = document.getElementsByClassName('cwp1checks');
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
                                        <div class="col-lg-6">
                                            <div class="form-group mb-3 row">
                                                <label class="form-label col-5">Cooling Tow. 2</label>
                                                <div class="col">
                                                    <div>
                                                        <input <?php if(old('cooling_2') == "1") { echo("checked"); } ?> id="cooling_2" name="cooling_2" type="checkbox" class="coolingtower2checks <?= ($validation->hasError('cooling_2')) ? 'is-invalid' : ''; ?>" onClick="checkCoolingTower2(this.value);" value="1">
                                                        On
                                                        <span style="padding-left: 20px;"></span>
                                                        <input <?php if(old('cooling_2') == "0") { echo("checked"); } ?> id="cooling_2" name="cooling_2" type="checkbox" class="coolingtower2checks <?= ($validation->hasError('cooling_2')) ? 'is-invalid' : ''; ?>" onClick="checkCoolingTower2(this.value);" value="0">
                                                        Off
                                                    </div>
                                                    <?php if($validation->hasError('cooling_2')): ?>
                                                        <div style="font-size: 85.71428571%; color: #d63939; white-space: normal;">
                                                            <?= $validation->getError('cooling_2'); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                    <script>
                                                        function checkCoolingTower2(b){
                                                            var x = document.getElementsByClassName('coolingtower2checks');
                                                            var i;

                                                            for (i = 0; i < x.length; i++) {
                                                                if(x[i].value != b) x[i].checked = false;
                                                            }
                                                        }
                                                    </script>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group mb-3 row">
                                                <label class="form-label col-5">CWP No. 2</label>
                                                <div class="col">
                                                    <div>
                                                        <input <?php if(old('cwp_2') == "1") { echo("checked"); } ?> id="cwp_2" name="cwp_2" type="checkbox" class="cwp2checks <?= ($validation->hasError('cwp_2')) ? 'is-invalid' : ''; ?>" onClick="checkCWP2(this.value);" value="1">
                                                        On
                                                        <span style="padding-left: 20px;"></span>
                                                        <input <?php if(old('cwp_2') == "0") { echo("checked"); } ?> id="cwp_2" name="cwp_2" type="checkbox" class="cwp2checks <?= ($validation->hasError('cwp_2')) ? 'is-invalid' : ''; ?>" onClick="checkCWP2(this.value);" value="0">
                                                        Off
                                                    </div>
                                                    <?php if($validation->hasError('cwp_2')): ?>
                                                        <div style="font-size: 85.71428571%; color: #d63939; white-space: normal;">
                                                            <?= $validation->getError('cwp_2'); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                    <script>
                                                        function checkCWP2(b){
                                                            var x = document.getElementsByClassName('cwp2checks');
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
                                        <div class="col-lg-6">
                                            <div class="form-group mb-3 row">
                                                <label class="form-label col-5">Cooling Tow. 3</label>
                                                <div class="col">
                                                    <div>
                                                        <input <?php if(old('cooling_3') == "1") { echo("checked"); } ?> id="cooling_3" name="cooling_3" type="checkbox" class="coolingtower3checks <?= ($validation->hasError('cooling_3')) ? 'is-invalid' : ''; ?>" onClick="checkCoolingTower3(this.value);" value="1">
                                                        On
                                                        <span style="padding-left: 20px;"></span>
                                                        <input <?php if(old('cooling_3') == "0") { echo("checked"); } ?> id="cooling_3" name="cooling_3" type="checkbox" class="coolingtower3checks <?= ($validation->hasError('cooling_3')) ? 'is-invalid' : ''; ?>" onClick="checkCoolingTower3(this.value);" value="0">
                                                        Off
                                                    </div>
                                                    <?php if($validation->hasError('cooling_3')): ?>
                                                        <div style="font-size: 85.71428571%; color: #d63939; white-space: normal;">
                                                            <?= $validation->getError('cooling_3'); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                    <script>
                                                        function checkCoolingTower3(b){
                                                            var x = document.getElementsByClassName('coolingtower3checks');
                                                            var i;

                                                            for (i = 0; i < x.length; i++) {
                                                                if(x[i].value != b) x[i].checked = false;
                                                            }
                                                        }
                                                    </script>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group mb-3 row">
                                                <label class="form-label col-5">CWP No. 3</label>
                                                <div class="col">
                                                    <div>
                                                        <input <?php if(old('cwp_3') == "1") { echo("checked"); } ?> id="cwp_3" name="cwp_3" type="checkbox" class="cwp3checks <?= ($validation->hasError('cwp_3')) ? 'is-invalid' : ''; ?>" onClick="checkCWP3(this.value);" value="1">
                                                        On
                                                        <span style="padding-left: 20px;"></span>
                                                        <input <?php if(old('cwp_3') == "0") { echo("checked"); } ?> id="cwp_3" name="cwp_3" type="checkbox" class="cwp3checks <?= ($validation->hasError('cwp_3')) ? 'is-invalid' : ''; ?>" onClick="checkCWP3(this.value);" value="0">
                                                        Off
                                                    </div>
                                                    <?php if($validation->hasError('cwp_3')): ?>
                                                        <div style="font-size: 85.71428571%; color: #d63939; white-space: normal;">
                                                            <?= $validation->getError('cwp_3'); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                    <script>
                                                        function checkCWP3(b){
                                                            var x = document.getElementsByClassName('cwp3checks');
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
                                        <div class="col-lg-6">
                                            <div class="form-group mb-3 row">
                                                <label class="form-label col-5">Cooling Tow. 4</label>
                                                <div class="col">
                                                    <div>
                                                        <input <?php if(old('cooling_4') == "1") { echo("checked"); } ?> id="cooling_4" name="cooling_4" type="checkbox" class="coolingtower4checks <?= ($validation->hasError('cooling_4')) ? 'is-invalid' : ''; ?>" onClick="checkCoolingTower4(this.value);" value="1">
                                                        On
                                                        <span style="padding-left: 20px;"></span>
                                                        <input <?php if(old('cooling_4') == "0") { echo("checked"); } ?> id="cooling_4" name="cooling_4" type="checkbox" class="coolingtower4checks <?= ($validation->hasError('cooling_4')) ? 'is-invalid' : ''; ?>" onClick="checkCoolingTower4(this.value);" value="0">
                                                        Off
                                                    </div>
                                                    <?php if($validation->hasError('cooling_4')): ?>
                                                        <div style="font-size: 85.71428571%; color: #d63939; white-space: normal;">
                                                            <?= $validation->getError('cooling_4'); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                    <script>
                                                        function checkCoolingTower4(b){
                                                            var x = document.getElementsByClassName('coolingtower4checks');
                                                            var i;

                                                            for (i = 0; i < x.length; i++) {
                                                                if(x[i].value != b) x[i].checked = false;
                                                            }
                                                        }
                                                    </script>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group mb-3 row">
                                                <label class="form-label col-5">CWP No. 4</label>
                                                <div class="col">
                                                    <div>
                                                        <input <?php if(old('cwp_4') == "1") { echo("checked"); } ?> id="cwp_4" name="cwp_4" type="checkbox" class="cwp4checks <?= ($validation->hasError('cwp_4')) ? 'is-invalid' : ''; ?>" onClick="checkCWP4(this.value);" value="1">
                                                        On
                                                        <span style="padding-left: 20px;"></span>
                                                        <input <?php if(old('cwp_4') == "0") { echo("checked"); } ?> id="cwp_4" name="cwp_4" type="checkbox" class="cwp4checks <?= ($validation->hasError('cwp_4')) ? 'is-invalid' : ''; ?>" onClick="checkCWP4(this.value);" value="0">
                                                        Off
                                                    </div>
                                                    <?php if($validation->hasError('cwp_4')): ?>
                                                        <div style="font-size: 85.71428571%; color: #d63939; white-space: normal;">
                                                            <?= $validation->getError('cwp_4'); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                    <script>
                                                        function checkCWP4(b){
                                                            var x = document.getElementsByClassName('cwp4checks');
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
                                        <div class="col-lg-6">
                                            <div class="form-group mb-3 row">
                                                <label class="form-label col-5">Cooling Tow. 5</label>
                                                <div class="col">
                                                    <div>
                                                        <input <?php if(old('cooling_5') == "1") { echo("checked"); } ?> id="cooling_5" name="cooling_5" type="checkbox" class="coolingtower5checks <?= ($validation->hasError('cooling_5')) ? 'is-invalid' : ''; ?>" onClick="checkCoolingTower5(this.value);" value="1">
                                                        On
                                                        <span style="padding-left: 20px;"></span>
                                                        <input <?php if(old('cooling_5') == "0") { echo("checked"); } ?> id="cooling_5" name="cooling_5" type="checkbox" class="coolingtower5checks <?= ($validation->hasError('cooling_5')) ? 'is-invalid' : ''; ?>" onClick="checkCoolingTower5(this.value);" value="0">
                                                        Off
                                                    </div>
                                                    <?php if($validation->hasError('cooling_5')): ?>
                                                        <div style="font-size: 85.71428571%; color: #d63939; white-space: normal;">
                                                            <?= $validation->getError('cooling_5'); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                    <script>
                                                        function checkCoolingTower5(b){
                                                            var x = document.getElementsByClassName('coolingtower5checks');
                                                            var i;

                                                            for (i = 0; i < x.length; i++) {
                                                                if(x[i].value != b) x[i].checked = false;
                                                            }
                                                        }
                                                    </script>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group mb-3 row">
                                                <label class="form-label col-5">CWP No. 5</label>
                                                <div class="col">
                                                    <div>
                                                        <input <?php if(old('cwp_5') == "1") { echo("checked"); } ?> id="cwp_5" name="cwp_5" type="checkbox" class="cwp5checks <?= ($validation->hasError('cwp_5')) ? 'is-invalid' : ''; ?>" onClick="checkCWP5(this.value);" value="1">
                                                        On
                                                        <span style="padding-left: 20px;"></span>
                                                        <input <?php if(old('cwp_5') == "0") { echo("checked"); } ?> id="cwp_5" name="cwp_5" type="checkbox" class="cwp5checks <?= ($validation->hasError('cwp_5')) ? 'is-invalid' : ''; ?>" onClick="checkCWP5(this.value);" value="0">
                                                        Off
                                                    </div>
                                                    <?php if($validation->hasError('cwp_5')): ?>
                                                        <div style="font-size: 85.71428571%; color: #d63939; white-space: normal;">
                                                            <?= $validation->getError('cwp_5'); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                    <script>
                                                        function checkCWP5(b){
                                                            var x = document.getElementsByClassName('cwp5checks');
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
                                    <div class="row">
                                        <div class="col-lg-6"></div>
                                        <div class="col-lg-6">
                                            <div class="form-group mb-3 row">
                                                <label class="form-label col-5">CWP No. 6</label>
                                                <div class="col">
                                                    <div>
                                                        <input <?php if(old('cwp_6') == "1") { echo("checked"); } ?> id="cwp_6" name="cwp_6" type="checkbox" class="cwp6checks <?= ($validation->hasError('cwp_6')) ? 'is-invalid' : ''; ?>" onClick="checkCWP6(this.value);" value="1">
                                                        On
                                                        <span style="padding-left: 20px;"></span>
                                                        <input <?php if(old('cwp_6') == "0") { echo("checked"); } ?> id="cwp_6" name="cwp_6" type="checkbox" class="cwp6checks <?= ($validation->hasError('cwp_6')) ? 'is-invalid' : ''; ?>" onClick="checkCWP6(this.value);" value="0">
                                                        Off
                                                    </div>
                                                    <?php if($validation->hasError('cwp_6')): ?>
                                                        <div style="font-size: 85.71428571%; color: #d63939; white-space: normal;">
                                                            <?= $validation->getError('cwp_6'); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                    <script>
                                                        function checkCWP6(b){
                                                            var x = document.getElementsByClassName('cwp6checks');
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
                                    
                                    <div class="table-responsive">
                                        <table class="table table-bordered card-table table-vcenter text-nowrap datatable" style="width:100%">
                                            <tbody>
                                                <tr style="border: 0;">
                                                    <td style="border: 0;"></td>
                                                    <td style="border: 0;"></td>
                                                    <td style="border: 0;"></td>
                                                </tr>

                                                <tr>
                                                    <td>Cooling Tower Report</td>
                                                    <td>Kondisi Kerak & Lumut</td>
                                                    <td>
                                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                                            <input <?php if(old('moss') == "1") { echo("checked"); } ?> id="moss" name="moss" type="checkbox" class="mosschecks <?= ($validation->hasError('moss')) ? 'is-invalid' : ''; ?>" onClick="checkMoss(this.value);" value="1">
                                                            Bersih<br>
                                                        </div>
                                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                                            <input <?php if(old('moss') == "0") { echo("checked"); } ?> id="moss" name="moss" type="checkbox" class="mosschecks <?= ($validation->hasError('moss')) ? 'is-invalid' : ''; ?>" onClick="checkMoss(this.value);" value="0">
                                                            Kotor
                                                        </div>
                                                        <?php if($validation->hasError('moss')): ?>
                                                            <div style="font-size: 85.71428571%; color: #d63939; white-space: normal;">
                                                                <?= $validation->getError('moss'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                    <script>
                                                        function checkMoss(b){
                                                            var x = document.getElementsByClassName('mosschecks');
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
                                                    <td rowspan="5">Water Treatment</td>
                                                    <td>Penghambat Lumut S26<br>1.3 Liter/Hari</td>
                                                    <td>
                                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                                            <input <?php if(old('s26') == "1") { echo("checked"); } ?> id="s26" name="s26" type="checkbox" class="s26checks <?= ($validation->hasError('s26')) ? 'is-invalid' : ''; ?>" onClick="checkS26(this.value);" value="1">
                                                            Ya<br>
                                                        </div>
                                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                                            <input <?php if(old('s26') == "0") { echo("checked"); } ?> id="s26" name="s26" type="checkbox" class="s26checks <?= ($validation->hasError('s26')) ? 'is-invalid' : ''; ?>" onClick="checkS26(this.value);" value="0">
                                                            Tidak
                                                        </div>
                                                        <?php if($validation->hasError('s26')): ?>
                                                            <div style="font-size: 85.71428571%; color: #d63939; white-space: normal;">
                                                                <?= $validation->getError('s26'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                    <script>
                                                        function checkS26(b){
                                                            var x = document.getElementsByClassName('s26checks');
                                                            var i;

                                                            for (i = 0; i < x.length; i++) {
                                                                if(x[i].value != b) x[i].checked = false;
                                                            }
                                                        }
                                                    </script>
                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 8px;">Mengurangi Kerak S27<br>2.6 Liter/Hari</td>
                                                    <td>
                                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                                            <input <?php if(old('s27') == "1") { echo("checked"); } ?> id="s27" name="s27" type="checkbox" class="s27checks <?= ($validation->hasError('s27')) ? 'is-invalid' : ''; ?>" onClick="checkS27(this.value);" value="1">
                                                            Ya<br>
                                                        </div>
                                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                                            <input <?php if(old('s27') == "0") { echo("checked"); } ?> id="s27" name="s27" type="checkbox" class="s27checks <?= ($validation->hasError('s27')) ? 'is-invalid' : ''; ?>" onClick="checkS27(this.value);" value="0">
                                                            Tidak
                                                        </div>
                                                        <?php if($validation->hasError('s27')): ?>
                                                            <div style="font-size: 85.71428571%; color: #d63939; white-space: normal;">
                                                                <?= $validation->getError('s27'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                    <script>
                                                        function checkS27(b){
                                                            var x = document.getElementsByClassName('s27checks');
                                                            var i;

                                                            for (i = 0; i < x.length; i++) {
                                                                if(x[i].value != b) x[i].checked = false;
                                                            }
                                                        }
                                                    </script>
                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 8px;">Dozing Pump</td>
                                                    <td>
                                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                                            <input <?php if(old('pump') == "1") { echo("checked"); } ?> id="pump" name="pump" type="checkbox" class="pumpchecks <?= ($validation->hasError('pump')) ? 'is-invalid' : ''; ?>" onClick="checkPump(this.value);" value="1">
                                                            On<br>
                                                        </div>
                                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                                            <input <?php if(old('pump') == "0") { echo("checked"); } ?> id="pump" name="pump" type="checkbox" class="pumpchecks <?= ($validation->hasError('pump')) ? 'is-invalid' : ''; ?>" onClick="checkPump(this.value);" value="0">
                                                            Off
                                                        </div>
                                                        <?php if($validation->hasError('pump')): ?>
                                                            <div style="font-size: 85.71428571%; color: #d63939; white-space: normal;">
                                                                <?= $validation->getError('pump'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                    <script>
                                                        function checkPump(b){
                                                            var x = document.getElementsByClassName('pumpchecks');
                                                            var i;

                                                            for (i = 0; i < x.length; i++) {
                                                                if(x[i].value != b) x[i].checked = false;
                                                            }
                                                        }
                                                    </script>
                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 8px;">Make Up Water</td>
                                                    <td>
                                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                                            <input <?php if(old('make_up') == "1") { echo("checked"); } ?> id="make_up" name="make_up" type="checkbox" class="waterchecks <?= ($validation->hasError('make_up')) ? 'is-invalid' : ''; ?>" onClick="checkWater(this.value);" value="1">
                                                            On<br>
                                                        </div>
                                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                                            <input <?php if(old('make_up') == "0") { echo("checked"); } ?> id="make_up" name="make_up" type="checkbox" class="waterchecks <?= ($validation->hasError('make_up')) ? 'is-invalid' : ''; ?>" onClick="checkWater(this.value);" value="0">
                                                            Off
                                                        </div>
                                                        <?php if($validation->hasError('make_up')): ?>
                                                            <div style="font-size: 85.71428571%; color: #d63939; white-space: normal;">
                                                                <?= $validation->getError('make_up'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                    <script>
                                                        function checkWater(b){
                                                            var x = document.getElementsByClassName('waterchecks');
                                                            var i;

                                                            for (i = 0; i < x.length; i++) {
                                                                if(x[i].value != b) x[i].checked = false;
                                                            }
                                                        }
                                                    </script>
                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 8px;">PH Air<br>6.7 - 7.7</td>
                                                    <td>
                                                        <input id="ph" name="ph" class="form-control <?= ($validation->hasError('ph')) ? 'is-invalid' : ''; ?>" value="<?= old('ph'); ?>">
                                                        <?php if($validation->hasError('ph')): ?>
                                                            <div class="invalid-feedback" style="white-space: normal;">
                                                                <?= $validation->getError('ph'); ?>
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
                                                    <td rowspan="8">Panel Report</td>
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
                                                    <td style="padding-left: 8px;">L - N<br>200 - 242 Vac</td>
                                                    <td>
                                                        <input id="ln" name="ln" class="form-control <?= ($validation->hasError('ln')) ? 'is-invalid' : ''; ?>" value="<?= old('ln'); ?>">
                                                        <?php if($validation->hasError('ln')): ?>
                                                            <div class="invalid-feedback" style="white-space: normal;">
                                                                <?= $validation->getError('ln'); ?>
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
                                        <button type="submit" class="btn btn-outline-primary ms-auto" id="btnSubmitAcCoolingTower" name="btnSubmitAcCoolingTower">
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
                        <h3 class="card-title">AC Cooling Tower Data</h3>
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
                                    <th>Cooling Tower No. 1</th>
                                    <th>Cooling Tower No. 2</th>
                                    <th>Cooling Tower No. 3</th>
                                    <th>Cooling Tower No. 4</th>
                                    <th>Cooling Tower No. 5</th>
                                    <th>CWP No. 1</th>
                                    <th>CWP No. 2</th>
                                    <th>CWP No. 3</th>
                                    <th>CWP No. 4</th>
                                    <th>CWP No. 5</th>
                                    <th>CWP No. 6</th>
                                    <th>COOLING TOWER REPORT<br>Kondisi Kerak & Lumut</th>
                                    <th>WATER TREATMENT<br>Penghambat Lumut S26<br>1.3 Liter/Hari</th>
                                    <th>WATER TREATMENT<br>Mengurangi Kerak S27<br>2.6 Liter/Hari</th>
                                    <th>WATER TREATMENT<br>Dozing Pump</th>
                                    <th>WATER TREATMENT<br>Make Up Water</th>
                                    <th>WATER TREATMENT<br>PH Air<br>6.7 - 7.7</th>
                                    <th>PANEL REPORT<br>R - S<br>342 - 418 Vac</th>
                                    <th>PANEL REPORT<br>S - T<br>342 - 418 Vac</th>
                                    <th>PANEL REPORT<br>T - N<br>342 - 418 Vac</th>
                                    <th>PANEL REPORT<br>L - N<br>200 - 242 Vac</th>
                                    <th>PANEL REPORT<br>R<br>80% In</th>
                                    <th>PANEL REPORT<br>S<br>80% In</th>
                                    <th>PANEL REPORT<br>T<br>80% In</th>
                                    <th>PANEL REPORT<br>KW</th>
                                    <th>Keterangan</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                    $n = 1;
                                ?>
                                <?php foreach($getAcCoolingTowerByStore as $t): ?>
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
                                        <td><?php if($t['cooling_1']) { echo("On"); } else { echo("Off"); } ?></td>
                                        <td><?php if($t['cooling_2']) { echo("On"); } else { echo("Off"); } ?></td>
                                        <td><?php if($t['cooling_3']) { echo("On"); } else { echo("Off"); } ?></td>
                                        <td><?php if($t['cooling_4']) { echo("On"); } else { echo("Off"); } ?></td>
                                        <td><?php if($t['cooling_5']) { echo("On"); } else { echo("Off"); } ?></td>
                                        <td><?php if($t['cwp_1']) { echo("On"); } else { echo("Off"); } ?></td>
                                        <td><?php if($t['cwp_2']) { echo("On"); } else { echo("Off"); } ?></td>
                                        <td><?php if($t['cwp_3']) { echo("On"); } else { echo("Off"); } ?></td>
                                        <td><?php if($t['cwp_4']) { echo("On"); } else { echo("Off"); } ?></td>
                                        <td><?php if($t['cwp_5']) { echo("On"); } else { echo("Off"); } ?></td>
                                        <td><?php if($t['cwp_6']) { echo("On"); } else { echo("Off"); } ?></td>
                                        <td><?php if($t['moss']) { echo("Bersih"); } else { echo("Kotor"); } ?></td>
                                        <td><?php if($t['s26']) { echo("Ya"); } else { echo("Tidak"); } ?></td>
                                        <td><?php if($t['s27']) { echo("Ya"); } else { echo("Tidak"); } ?></td>
                                        <td><?php if($t['pump']) { echo("On"); } else { echo("Off"); } ?></td>
                                        <td><?php if($t['make_up']) { echo("On"); } else { echo("Off"); } ?></td>
                                        <td><?= $t['ph'] ?></td>
                                        <td><?= $t['rs'] ?></td>
                                        <td><?= $t['st'] ?></td>
                                        <td><?= $t['tn'] ?></td>
                                        <td><?= $t['ln'] ?></td>
                                        <td><?= $t['r'] ?></td>
                                        <td><?= $t['s'] ?></td>
                                        <td><?= $t['t'] ?></td>
                                        <td><?= $t['kw'] ?></td>
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
                                        <form id="editAcCoolingTowerForm" action="<?php echo base_url('accoolingtower/updateAcCoolingTower/' . $t['id']); ?>" method="post">
                                            <div class="modal-dialog modal-xl modal-dialog-centered" role="dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit AC Cooling Tower Data</h5>
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

                                                                        foreach($getAcCoolingTowerByStoreDate as $tt) {
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
                                                                            <label class="form-label">Cooling Tow. 1</label>

                                                                            <input <?php if($t['cooling_1']) { echo("checked"); } ?> id="editcooling1" name="editcooling1" type="checkbox" class="editcooling1checks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editcooling1')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditCooling1' . $n . '(this.value)' ?>;" value="1">
                                                                            <span>On</span>
                                                                            
                                                                            <span style="padding-left: 20px;"></span>
                                                                            
                                                                            <input <?php if(!$t['cooling_1']) { echo("checked"); } ?> id="editcooling1" name="editcooling1" type="checkbox" class="editcooling1checks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editcooling1')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditCooling1' . $n . '(this.value)' ?>;" value="0">
                                                                            <span>Off</span>
                                                                            
                                                                            <?php if($validation->hasError('editcooling1')): ?>
                                                                                <div class="invalid-feedback">
                                                                                    <?= $validation->getError('editcooling1'); ?>
                                                                                </div>
                                                                            <?php endif; ?>

                                                                            <script>
                                                                                function checkEditCooling1<?= $n ?>(b){
                                                                                    var x = document.getElementsByClassName('editcooling1checks<?= $n ?>');
                                                                                    var i;

                                                                                    for(i = 0; i < x.length; i++) {
                                                                                        if(x[i].value != b) x[i].checked = false;
                                                                                    }
                                                                                }
                                                                            </script>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label class="form-label">Cooling Tow. 2</label>

                                                                            <input <?php if($t['cooling_2']) { echo("checked"); } ?> id="editcooling2" name="editcooling2" type="checkbox" class="editcooling2checks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editcooling2')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditCooling2' . $n . '(this.value)' ?>;" value="1">
                                                                            <span>On</span>
                                                                            
                                                                            <span style="padding-left: 20px;"></span>
                                                                            
                                                                            <input <?php if(!$t['cooling_2']) { echo("checked"); } ?> id="editcooling2" name="editcooling2" type="checkbox" class="editcooling2checks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editcooling2')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditCooling2' . $n . '(this.value)' ?>;" value="0">
                                                                            <span>Off</span>
                                                                            
                                                                            <?php if($validation->hasError('editcooling2')): ?>
                                                                                <div class="invalid-feedback">
                                                                                    <?= $validation->getError('editcooling2'); ?>
                                                                                </div>
                                                                            <?php endif; ?>

                                                                            <script>
                                                                                function checkEditCooling2<?= $n ?>(b){
                                                                                    var x = document.getElementsByClassName('editcooling2checks<?= $n ?>');
                                                                                    var i;

                                                                                    for(i = 0; i < x.length; i++) {
                                                                                        if(x[i].value != b) x[i].checked = false;
                                                                                    }
                                                                                }
                                                                            </script>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label class="form-label">Cooling Tow. 3</label>

                                                                            <input <?php if($t['cooling_3']) { echo("checked"); } ?> id="editcooling3" name="editcooling3" type="checkbox" class="editcooling3checks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editcooling3')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditCooling3' . $n . '(this.value)' ?>;" value="1">
                                                                            <span>On</span>
                                                                            
                                                                            <span style="padding-left: 20px;"></span>
                                                                            
                                                                            <input <?php if(!$t['cooling_3']) { echo("checked"); } ?> id="editcooling3" name="editcooling3" type="checkbox" class="editcooling3checks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editcooling3')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditCooling3' . $n . '(this.value)' ?>;" value="0">
                                                                            <span>Off</span>
                                                                            
                                                                            <?php if($validation->hasError('editcooling3')): ?>
                                                                                <div class="invalid-feedback">
                                                                                    <?= $validation->getError('editcooling3'); ?>
                                                                                </div>
                                                                            <?php endif; ?>

                                                                            <script>
                                                                                function checkEditCooling3<?= $n ?>(b){
                                                                                    var x = document.getElementsByClassName('editcooling3checks<?= $n ?>');
                                                                                    var i;

                                                                                    for(i = 0; i < x.length; i++) {
                                                                                        if(x[i].value != b) x[i].checked = false;
                                                                                    }
                                                                                }
                                                                            </script>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label class="form-label">Cooling Tow. 4</label>

                                                                            <input <?php if($t['cooling_4']) { echo("checked"); } ?> id="editcooling4" name="editcooling4" type="checkbox" class="editcooling4checks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editcooling4')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditCooling4' . $n . '(this.value)' ?>;" value="1">
                                                                            <span>On</span>
                                                                            
                                                                            <span style="padding-left: 20px;"></span>
                                                                            
                                                                            <input <?php if(!$t['cooling_4']) { echo("checked"); } ?> id="editcooling4" name="editcooling4" type="checkbox" class="editcooling4checks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editcooling4')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditCooling4' . $n . '(this.value)' ?>;" value="0">
                                                                            <span>Off</span>
                                                                            
                                                                            <?php if($validation->hasError('editcooling4')): ?>
                                                                                <div class="invalid-feedback">
                                                                                    <?= $validation->getError('editcooling4'); ?>
                                                                                </div>
                                                                            <?php endif; ?>

                                                                            <script>
                                                                                function checkEditCooling4<?= $n ?>(b){
                                                                                    var x = document.getElementsByClassName('editcooling4checks<?= $n ?>');
                                                                                    var i;

                                                                                    for(i = 0; i < x.length; i++) {
                                                                                        if(x[i].value != b) x[i].checked = false;
                                                                                    }
                                                                                }
                                                                            </script>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label class="form-label">Cooling Tow. 5</label>

                                                                            <input <?php if($t['cooling_5']) { echo("checked"); } ?> id="editcooling5" name="editcooling5" type="checkbox" class="editcooling5checks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editcooling5')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditCooling5' . $n . '(this.value)' ?>;" value="1">
                                                                            <span>On</span>
                                                                            
                                                                            <span style="padding-left: 20px;"></span>
                                                                            
                                                                            <input <?php if(!$t['cooling_5']) { echo("checked"); } ?> id="editcooling5" name="editcooling5" type="checkbox" class="editcooling5checks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editcooling5')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditCooling5' . $n . '(this.value)' ?>;" value="0">
                                                                            <span>Off</span>
                                                                            
                                                                            <?php if($validation->hasError('editcooling5')): ?>
                                                                                <div class="invalid-feedback">
                                                                                    <?= $validation->getError('editcooling5'); ?>
                                                                                </div>
                                                                            <?php endif; ?>

                                                                            <script>
                                                                                function checkEditCooling5<?= $n ?>(b){
                                                                                    var x = document.getElementsByClassName('editcooling5checks<?= $n ?>');
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
                                                                            <label class="form-label">CWP No. 1</label>

                                                                            <input <?php if($t['cwp_1']) { echo("checked"); } ?> id="editcwp1" name="editcwp1" type="checkbox" class="editcwp1checks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editcwp1')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditCwp1' . $n . '(this.value)' ?>;" value="1">
                                                                            <span>On</span>
                                                                            
                                                                            <span style="padding-left: 20px;"></span>
                                                                            
                                                                            <input <?php if(!$t['cwp_1']) { echo("checked"); } ?> id="editcwp1" name="editcwp1" type="checkbox" class="editcwp1checks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editcwp1')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditCwp1' . $n . '(this.value)' ?>;" value="0">
                                                                            <span>Off</span>
                                                                            
                                                                            <?php if($validation->hasError('editcwp1')): ?>
                                                                                <div class="invalid-feedback">
                                                                                    <?= $validation->getError('editcwp1'); ?>
                                                                                </div>
                                                                            <?php endif; ?>

                                                                            <script>
                                                                                function checkEditCwp1<?= $n ?>(b){
                                                                                    var x = document.getElementsByClassName('editcwp1checks<?= $n ?>');
                                                                                    var i;

                                                                                    for(i = 0; i < x.length; i++) {
                                                                                        if(x[i].value != b) x[i].checked = false;
                                                                                    }
                                                                                }
                                                                            </script>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label class="form-label">CWP No. 2</label>

                                                                            <input <?php if($t['cwp_2']) { echo("checked"); } ?> id="editcwp2" name="editcwp2" type="checkbox" class="editcwp2checks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editcwp2')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditCwp2' . $n . '(this.value)' ?>;" value="1">
                                                                            <span>On</span>
                                                                            
                                                                            <span style="padding-left: 20px;"></span>
                                                                            
                                                                            <input <?php if(!$t['cwp_2']) { echo("checked"); } ?> id="editcwp2" name="editcwp2" type="checkbox" class="editcwp2checks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editcwp2')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditCwp2' . $n . '(this.value)' ?>;" value="0">
                                                                            <span>Off</span>
                                                                            
                                                                            <?php if($validation->hasError('editcwp2')): ?>
                                                                                <div class="invalid-feedback">
                                                                                    <?= $validation->getError('editcwp2'); ?>
                                                                                </div>
                                                                            <?php endif; ?>

                                                                            <script>
                                                                                function checkEditCwp2<?= $n ?>(b){
                                                                                    var x = document.getElementsByClassName('editcwp2checks<?= $n ?>');
                                                                                    var i;

                                                                                    for(i = 0; i < x.length; i++) {
                                                                                        if(x[i].value != b) x[i].checked = false;
                                                                                    }
                                                                                }
                                                                            </script>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label class="form-label">CWP No. 3</label>

                                                                            <input <?php if($t['cwp_3']) { echo("checked"); } ?> id="editcwp3" name="editcwp3" type="checkbox" class="editcwp3checks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editcwp3')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditCwp3' . $n . '(this.value)' ?>;" value="1">
                                                                            <span>On</span>
                                                                            
                                                                            <span style="padding-left: 20px;"></span>
                                                                            
                                                                            <input <?php if(!$t['cwp_3']) { echo("checked"); } ?> id="editcwp3" name="editcwp3" type="checkbox" class="editcwp3checks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editcwp3')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditCwp3' . $n . '(this.value)' ?>;" value="0">
                                                                            <span>Off</span>
                                                                            
                                                                            <?php if($validation->hasError('editcwp3')): ?>
                                                                                <div class="invalid-feedback">
                                                                                    <?= $validation->getError('editcwp3'); ?>
                                                                                </div>
                                                                            <?php endif; ?>

                                                                            <script>
                                                                                function checkEditCwp3<?= $n ?>(b){
                                                                                    var x = document.getElementsByClassName('editcwp3checks<?= $n ?>');
                                                                                    var i;

                                                                                    for(i = 0; i < x.length; i++) {
                                                                                        if(x[i].value != b) x[i].checked = false;
                                                                                    }
                                                                                }
                                                                            </script>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label class="form-label">CWP No. 4</label>

                                                                            <input <?php if($t['cwp_4']) { echo("checked"); } ?> id="editcwp4" name="editcwp4" type="checkbox" class="editcwp4checks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editcwp4')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditCwp4' . $n . '(this.value)' ?>;" value="1">
                                                                            <span>On</span>
                                                                            
                                                                            <span style="padding-left: 20px;"></span>
                                                                            
                                                                            <input <?php if(!$t['cwp_4']) { echo("checked"); } ?> id="editcwp4" name="editcwp4" type="checkbox" class="editcwp4checks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editcwp4')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditCwp4' . $n . '(this.value)' ?>;" value="0">
                                                                            <span>Off</span>
                                                                            
                                                                            <?php if($validation->hasError('editcwp4')): ?>
                                                                                <div class="invalid-feedback">
                                                                                    <?= $validation->getError('editcwp4'); ?>
                                                                                </div>
                                                                            <?php endif; ?>

                                                                            <script>
                                                                                function checkEditCwp4<?= $n ?>(b){
                                                                                    var x = document.getElementsByClassName('editcwp4checks<?= $n ?>');
                                                                                    var i;

                                                                                    for(i = 0; i < x.length; i++) {
                                                                                        if(x[i].value != b) x[i].checked = false;
                                                                                    }
                                                                                }
                                                                            </script>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label class="form-label">CWP No. 5</label>

                                                                            <input <?php if($t['cwp_5']) { echo("checked"); } ?> id="editcwp5" name="editcwp5" type="checkbox" class="editcwp5checks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editcwp5')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditCwp5' . $n . '(this.value)' ?>;" value="1">
                                                                            <span>On</span>
                                                                            
                                                                            <span style="padding-left: 20px;"></span>
                                                                            
                                                                            <input <?php if(!$t['cwp_5']) { echo("checked"); } ?> id="editcwp5" name="editcwp5" type="checkbox" class="editcwp5checks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editcwp5')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditCwp5' . $n . '(this.value)' ?>;" value="0">
                                                                            <span>Off</span>
                                                                            
                                                                            <?php if($validation->hasError('editcwp5')): ?>
                                                                                <div class="invalid-feedback">
                                                                                    <?= $validation->getError('editcwp5'); ?>
                                                                                </div>
                                                                            <?php endif; ?>

                                                                            <script>
                                                                                function checkEditCwp5<?= $n ?>(b){
                                                                                    var x = document.getElementsByClassName('editcwp5checks<?= $n ?>');
                                                                                    var i;

                                                                                    for(i = 0; i < x.length; i++) {
                                                                                        if(x[i].value != b) x[i].checked = false;
                                                                                    }
                                                                                }
                                                                            </script>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label class="form-label">CWP No. 6</label>

                                                                            <input <?php if($t['cwp_6']) { echo("checked"); } ?> id="editcwp6" name="editcwp6" type="checkbox" class="editcwp6checks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editcwp6')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditCwp6' . $n . '(this.value)' ?>;" value="1">
                                                                            <span>On</span>
                                                                            
                                                                            <span style="padding-left: 20px;"></span>
                                                                            
                                                                            <input <?php if(!$t['cwp_6']) { echo("checked"); } ?> id="editcwp6" name="editcwp6" type="checkbox" class="editcwp6checks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editcwp6')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditCwp6' . $n . '(this.value)' ?>;" value="0">
                                                                            <span>Off</span>
                                                                            
                                                                            <?php if($validation->hasError('editcwp6')): ?>
                                                                                <div class="invalid-feedback">
                                                                                    <?= $validation->getError('editcwp6'); ?>
                                                                                </div>
                                                                            <?php endif; ?>

                                                                            <script>
                                                                                function checkEditCwp6<?= $n ?>(b){
                                                                                    var x = document.getElementsByClassName('editcwp6checks<?= $n ?>');
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
                                                                        <label class="form-label" style="color: lightsteelblue; font-weight: bold; opacity: 90%;">Cooling Tower Report</label>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Kondisi Kerak & Lumut</label>

                                                                        <input <?php if($t['moss']) { echo("checked"); } ?> id="editmoss" name="editmoss" type="checkbox" class="editmosschecks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editmoss')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditMoss' . $n . '(this.value)' ?>;" value="1">
                                                                        <span>Bersih</span>
                                                                        
                                                                        <span style="padding-left: 20px;"></span>
                                                                        
                                                                        <input <?php if(!$t['moss']) { echo("checked"); } ?> id="editmoss" name="editmoss" type="checkbox" class="editmosschecks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editmoss')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditMoss' . $n . '(this.value)' ?>;" value="0">
                                                                        <span>Kotor</span>
                                                                        
                                                                        <?php if($validation->hasError('editmoss')): ?>
                                                                            <div class="invalid-feedback">
                                                                                <?= $validation->getError('editmoss'); ?>
                                                                            </div>
                                                                        <?php endif; ?>

                                                                        <script>
                                                                            function checkEditMoss<?= $n ?>(b){
                                                                                var x = document.getElementsByClassName('editmosschecks<?= $n ?>');
                                                                                var i;

                                                                                for(i = 0; i < x.length; i++) {
                                                                                    if(x[i].value != b) x[i].checked = false;
                                                                                }
                                                                            }
                                                                        </script>
                                                                    </div>
                                                                </div>

                                                                <div style="padding: 10px; background-color: aliceblue;">
                                                                    <div class="mb-3 text-center">
                                                                        <label class="form-label" style="color: lightsteelblue; font-weight: bold; opacity: 90%;">Water Treatment</label>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Penghambat Lumut S26 1.3 Liter/Hari</label>

                                                                        <input <?php if($t['s26']) { echo("checked"); } ?> id="edits26" name="edits26" type="checkbox" class="edits26checks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('edits26')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditS26' . $n . '(this.value)' ?>;" value="1">
                                                                        <span>Ya</span>
                                                                        
                                                                        <span style="padding-left: 20px;"></span>
                                                                        
                                                                        <input <?php if(!$t['s26']) { echo("checked"); } ?> id="edits26" name="edits26" type="checkbox" class="edits26checks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('edits26')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditS26' . $n . '(this.value)' ?>;" value="0">
                                                                        <span>Tidak</span>
                                                                        
                                                                        <?php if($validation->hasError('edits26')): ?>
                                                                            <div class="invalid-feedback">
                                                                                <?= $validation->getError('edits26'); ?>
                                                                            </div>
                                                                        <?php endif; ?>

                                                                        <script>
                                                                            function checkEditS26<?= $n ?>(b){
                                                                                var x = document.getElementsByClassName('edits26checks<?= $n ?>');
                                                                                var i;

                                                                                for(i = 0; i < x.length; i++) {
                                                                                    if(x[i].value != b) x[i].checked = false;
                                                                                }
                                                                            }
                                                                        </script>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Mengurangi Kerak S27 2.6 Liter/Hari</label>

                                                                        <input <?php if($t['s27']) { echo("checked"); } ?> id="edits27" name="edits27" type="checkbox" class="edits27checks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('edits27')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditS27' . $n . '(this.value)' ?>;" value="1">
                                                                        <span>Ya</span>
                                                                        
                                                                        <span style="padding-left: 20px;"></span>
                                                                        
                                                                        <input <?php if(!$t['s27']) { echo("checked"); } ?> id="edits27" name="edits27" type="checkbox" class="edits27checks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('edits27')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditS27' . $n . '(this.value)' ?>;" value="0">
                                                                        <span>Tidak</span>
                                                                        
                                                                        <?php if($validation->hasError('edits27')): ?>
                                                                            <div class="invalid-feedback">
                                                                                <?= $validation->getError('edits27'); ?>
                                                                            </div>
                                                                        <?php endif; ?>

                                                                        <script>
                                                                            function checkEditS27<?= $n ?>(b){
                                                                                var x = document.getElementsByClassName('edits27checks<?= $n ?>');
                                                                                var i;

                                                                                for(i = 0; i < x.length; i++) {
                                                                                    if(x[i].value != b) x[i].checked = false;
                                                                                }
                                                                            }
                                                                        </script>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Dozing Pump</label>

                                                                        <input <?php if($t['pump']) { echo("checked"); } ?> id="editpump" name="editpump" type="checkbox" class="editpumpchecks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editpump')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditPump' . $n . '(this.value)' ?>;" value="1">
                                                                        <span>On</span>
                                                                        
                                                                        <span style="padding-left: 20px;"></span>
                                                                        
                                                                        <input <?php if(!$t['pump']) { echo("checked"); } ?> id="editpump" name="editpump" type="checkbox" class="editpumpchecks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editpump')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditPump' . $n . '(this.value)' ?>;" value="0">
                                                                        <span>Off</span>
                                                                        
                                                                        <?php if($validation->hasError('editpump')): ?>
                                                                            <div class="invalid-feedback">
                                                                                <?= $validation->getError('editpump'); ?>
                                                                            </div>
                                                                        <?php endif; ?>

                                                                        <script>
                                                                            function checkEditPump<?= $n ?>(b){
                                                                                var x = document.getElementsByClassName('editpumpchecks<?= $n ?>');
                                                                                var i;

                                                                                for(i = 0; i < x.length; i++) {
                                                                                    if(x[i].value != b) x[i].checked = false;
                                                                                }
                                                                            }
                                                                        </script>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Make Up Water</label>

                                                                        <input <?php if($t['make_up']) { echo("checked"); } ?> id="editmakeup" name="editmakeup" type="checkbox" class="editmakeupchecks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editmakeup')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditMakeUp' . $n . '(this.value)' ?>;" value="1">
                                                                        <span>On</span>
                                                                        
                                                                        <span style="padding-left: 20px;"></span>
                                                                        
                                                                        <input <?php if(!$t['make_up']) { echo("checked"); } ?> id="editmakeup" name="editmakeup" type="checkbox" class="editmakeupchecks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editmakeup')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditMakeUp' . $n . '(this.value)' ?>;" value="0">
                                                                        <span>Off</span>
                                                                        
                                                                        <?php if($validation->hasError('editmakeup')): ?>
                                                                            <div class="invalid-feedback">
                                                                                <?= $validation->getError('editmakeup'); ?>
                                                                            </div>
                                                                        <?php endif; ?>

                                                                        <script>
                                                                            function checkEditMakeUp<?= $n ?>(b){
                                                                                var x = document.getElementsByClassName('editmakeupchecks<?= $n ?>');
                                                                                var i;

                                                                                for(i = 0; i < x.length; i++) {
                                                                                    if(x[i].value != b) x[i].checked = false;
                                                                                }
                                                                            }
                                                                        </script>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">PH Air 6.7 - 7.7</label>

                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editph')))? 'is-invalid' : ''; ?>" id="editph" name="editph" value="<?= $t['ph']; ?>">
                                                                        </div>

                                                                        <?php if(($t['id'] == old('editid')) && ($validation->hasError('editph'))): ?>
                                                                            <div style="font-size: 85.71428571%; color: #d63939;">
                                                                                <?= $validation->getError('editph'); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-3">
                                                                <div style="padding: 10px; background-color: aliceblue;">
                                                                    <div class="mb-3 text-center">
                                                                        <label class="form-label" style="color: lightsteelblue; font-weight: bold; opacity: 90%;">Panel Report</label>
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
                                                                        <label class="form-label">L - N 200 - 242 Vac</label>

                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editln')))? 'is-invalid' : ''; ?>" id="editln" name="editln" value="<?= $t['ln']; ?>">
                                                                        </div>

                                                                        <?php if(($t['id'] == old('editid')) && ($validation->hasError('editln'))): ?>
                                                                            <div style="font-size: 85.71428571%; color: #d63939;">
                                                                                <?= $validation->getError('editln'); ?>
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
                                                            <button type="submit" class="btn btn-outline-primary ms-auto" id="btnUpdateAcCoolingTower" name="btnUpdateAcCoolingTower" data-bs-dismiss="modal" data-id="<?= $t['id']; ?>">
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
                                        <form id="deleteAcCoolingTowerForm" action="<?php echo base_url('accoolingtower/deleteAcCoolingTower/' . $t['id']); ?>" method="post">
                                            <div class="modal-dialog modal-xl modal-dialog-centered" role="dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Delete AC Cooling Tower Data</h5>
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
                                                                            <label class="form-label">Cooling Tow. 1</label>

                                                                            <input <?php if($t['cooling_1']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                            <span>On</span>
                                                                            
                                                                            <span style="padding-left: 20px;"></span>
                                                                            
                                                                            <input <?php if(!$t['cooling_1']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                            <span>Off</span>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label class="form-label">Cooling Tow. 2</label>

                                                                            <input <?php if($t['cooling_2']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                            <span>On</span>
                                                                            
                                                                            <span style="padding-left: 20px;"></span>
                                                                            
                                                                            <input <?php if(!$t['cooling_2']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                            <span>Off</span>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label class="form-label">Cooling Tow. 3</label>

                                                                            <input <?php if($t['cooling_3']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                            <span>On</span>
                                                                            
                                                                            <span style="padding-left: 20px;"></span>
                                                                            
                                                                            <input <?php if(!$t['cooling_3']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                            <span>Off</span>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label class="form-label">Cooling Tow. 4</label>

                                                                            <input <?php if($t['cooling_4']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                            <span>On</span>
                                                                            
                                                                            <span style="padding-left: 20px;"></span>
                                                                            
                                                                            <input <?php if(!$t['cooling_4']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                            <span>Off</span>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label class="form-label">Cooling Tow. 5</label>

                                                                            <input <?php if($t['cooling_5']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                            <span>On</span>
                                                                            
                                                                            <span style="padding-left: 20px;"></span>
                                                                            
                                                                            <input <?php if(!$t['cooling_5']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                            <span>Off</span>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col">
                                                                        <div class="mb-3">
                                                                            <label class="form-label">CWP No. 1</label>

                                                                            <input <?php if($t['cwp_1']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                            <span>On</span>
                                                                            
                                                                            <span style="padding-left: 20px;"></span>
                                                                            
                                                                            <input <?php if(!$t['cwp_1']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                            <span>Off</span>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label class="form-label">CWP No. 2</label>

                                                                            <input <?php if($t['cwp_2']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                            <span>On</span>
                                                                            
                                                                            <span style="padding-left: 20px;"></span>
                                                                            
                                                                            <input <?php if(!$t['cwp_2']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                            <span>Off</span>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label class="form-label">CWP No. 3</label>

                                                                            <input <?php if($t['cwp_3']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                            <span>On</span>
                                                                            
                                                                            <span style="padding-left: 20px;"></span>
                                                                            
                                                                            <input <?php if(!$t['cwp_3']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                            <span>Off</span>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label class="form-label">CWP No. 4</label>

                                                                            <input <?php if($t['cwp_4']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                            <span>On</span>
                                                                            
                                                                            <span style="padding-left: 20px;"></span>
                                                                            
                                                                            <input <?php if(!$t['cwp_4']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                            <span>Off</span>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label class="form-label">CWP No. 5</label>

                                                                            <input <?php if($t['cwp_5']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                            <span>On</span>
                                                                            
                                                                            <span style="padding-left: 20px;"></span>
                                                                            
                                                                            <input <?php if(!$t['cwp_5']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                            <span>Off</span>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label class="form-label">CWP No. 6</label>

                                                                            <input <?php if($t['cwp_6']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                            <span>On</span>
                                                                            
                                                                            <span style="padding-left: 20px;"></span>
                                                                            
                                                                            <input <?php if(!$t['cwp_6']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                            <span>Off</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-3">
                                                                <div style="padding: 10px; background-color: aliceblue;">
                                                                    <div class="mb-3 text-center">
                                                                        <label class="form-label" style="color: lightsteelblue; font-weight: bold; opacity: 90%;">Cooling Tower Report</label>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Kondisi Kerak & Lumut</label>

                                                                        <input <?php if($t['moss']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                        <span>Bersih</span>
                                                                        
                                                                        <span style="padding-left: 20px;"></span>
                                                                        
                                                                        <input <?php if(!$t['moss']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                        <span>Kotor</span>
                                                                    </div>
                                                                </div>

                                                                <div style="padding: 10px; background-color: aliceblue;">
                                                                    <div class="mb-3 text-center">
                                                                        <label class="form-label" style="color: lightsteelblue; font-weight: bold; opacity: 90%;">Water Treatment</label>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Penghambat Lumut S26 1.3 Liter/Hari</label>

                                                                        <input <?php if($t['s26']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                        <span>Ya</span>
                                                                        
                                                                        <span style="padding-left: 20px;"></span>
                                                                        
                                                                        <input <?php if(!$t['s26']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                        <span>Tidak</span>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Mengurangi Kerak S27 2.6 Liter/Hari</label>

                                                                        <input <?php if($t['s27']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                        <span>Ya</span>
                                                                        
                                                                        <span style="padding-left: 20px;"></span>
                                                                        
                                                                        <input <?php if(!$t['s27']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                        <span>Tidak</span>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Dozing Pump</label>

                                                                        <input <?php if($t['pump']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                        <span>On</span>
                                                                        
                                                                        <span style="padding-left: 20px;"></span>
                                                                        
                                                                        <input <?php if(!$t['pump']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                        <span>Off</span>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Make Up Water</label>

                                                                        <input <?php if($t['make_up']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                        <span>On</span>
                                                                        
                                                                        <span style="padding-left: 20px;"></span>
                                                                        
                                                                        <input <?php if(!$t['make_up']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                        <span>Off</span>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">PH Air 6.7 - 7.7</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col" value="<?= $t['ph']; ?>" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-3">
                                                                <div style="padding: 10px; background-color: aliceblue;">
                                                                    <div class="mb-3 text-center">
                                                                        <label class="form-label" style="color: lightsteelblue; font-weight: bold; opacity: 90%;">Panel Report</label>
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
                                                                        <label class="form-label">L - N 200 - 242 Vac</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col" value="<?= $t['ln']; ?>" disabled>
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
                                                            <button type="submit" class="btn btn-outline-danger ms-auto" id="btnDeleteAcCoolingTower" name="btnDeleteAcCoolingTower" data-bs-dismiss="modal" data-id="<?= $t['id']; ?>">
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
                                if($s['idEquipment'] > 9) {
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