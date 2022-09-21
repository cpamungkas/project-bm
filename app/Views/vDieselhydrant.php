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
                        <h3 class="card-title">Diesel Hydrant</h3>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo base_url('dieselhydrant/saveDieselHydrant'); ?>" method="post">
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

                                                    foreach($getDieselHydrantByStoreDate as $t) {
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

                            <div class="row" style="padding-top: 20px;">
                                <div class="col-lg-6">
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-4 col-form-label">Tekanan Oli 2.5 - 5 Bar</label>
                                        <div class="col">
                                            <div class="input-icon mb-2">
                                                <input id="oil_pressure" name="oil_pressure" class="form-control <?= ($validation->hasError('oil_pressure')) ? 'is-invalid' : ''; ?>" value="<?= old('oil_pressure'); ?>">
                                                <?php if($validation->hasError('oil_pressure')): ?>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('oil_pressure'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <label class="form-label col-1 col-form-label">Bar</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-4">Air Radiator</label>
                                        <div class="col">
                                            <div>
                                                <input <?php if(old('radiator') == "1") { echo("checked"); } ?> id="radiator" name="radiator" type="checkbox" class="radchecks <?= ($validation->hasError('radiator')) ? 'is-invalid' : ''; ?>" onclick="checkRadiator(this.value);" value="1">
                                                Penuh
                                                <span style="padding-left: 20px;"></span>
                                                <input <?php if(old('radiator') == "0") { echo("checked"); } ?> id="radiator" name="radiator" type="checkbox" class="radchecks <?= ($validation->hasError('radiator')) ? 'is-invalid' : ''; ?>" onclick="checkRadiator(this.value);" value="0">
                                                Kurang
                                            </div>
                                            <?php if($validation->hasError('radiator')): ?>
                                                <div style="font-size: 85.71428571%; color: #d63939;">
                                                    <?= $validation->getError('radiator'); ?>
                                                </div>
                                            <?php endif; ?>
                                            <script>
                                                function checkRadiator(b){
                                                    var x = document.getElementsByClassName('radchecks');
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
                                            <td rowspan="2">Engine Run Time<br>(Hours)</td>
                                            <td>Start</td>
                                            <td>
                                                <input id="start" name="start" class="form-control <?= ($validation->hasError('start')) ? 'is-invalid' : ''; ?>" value="<?= old('start'); ?>">
                                                <?php if($validation->hasError('start')): ?>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('start'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding-left: 8px;">Running</td>
                                            <td>
                                                <input id="running" name="running" class="form-control <?= ($validation->hasError('running')) ? 'is-invalid' : ''; ?>" value="<?= old('running'); ?>">
                                                <?php if($validation->hasError('running')): ?>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('running'); ?>
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
                                            <td rowspan="2">Tegangan Battery<br>(Vdc)</td>
                                            <td>Battery 1<br>10.8 - 13.8 Vdc</td>
                                            <td>
                                                <input id="battery_1" name="battery_1" class="form-control <?= ($validation->hasError('battery_1')) ? 'is-invalid' : ''; ?>" value="<?= old('battery_1'); ?>">
                                                <?php if($validation->hasError('battery_1')): ?>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('battery_1'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding-left: 8px;">Battery 2<br>10.8 - 13.8 Vdc</td>
                                            <td>
                                                <input id="battery_2" name="battery_2" class="form-control <?= ($validation->hasError('battery_2')) ? 'is-invalid' : ''; ?>" value="<?= old('battery_2'); ?>">
                                                <?php if($validation->hasError('battery_2')): ?>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('battery_2'); ?>
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

                            <div class="row" style="padding-top: 20px;">
                                <div class="col-lg-6">
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-4 col-form-label">Tangki Solar Harian</label>
                                        <div class="col">
                                            <div class="input-icon mb-2">
                                                <input id="solar" name="solar" class="form-control <?= ($validation->hasError('solar')) ? 'is-invalid' : ''; ?>" value="<?= old('solar'); ?>">
                                                <?php if($validation->hasError('solar')): ?>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('solar'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <label class="form-label col-1 col-form-label">Liter</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-4 col-form-label">Tekanan Air Pipa Header</label>
                                        <div class="col">
                                            <div class="input-icon mb-2">
                                                <input id="pipe_pressure" name="pipe_pressure" class="form-control <?= ($validation->hasError('pipe_pressure')) ? 'is-invalid' : ''; ?>" value="<?= old('pipe_pressure'); ?>">
                                                <?php if($validation->hasError('pipe_pressure')): ?>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('pipe_pressure'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row" style="padding-top: 20px;">
                                <div class="form-group">
                                    <label class="form-label row-form-label">Keterangan</label>
                                    <div class="row">
                                        <div class="input-icon mb-2">
                                            <textarea id="description" name="description" class="form-control <?= ($validation->hasError('description')) ? 'is-invalid' : ''; ?>" rows="6"><?= old('description'); ?></textarea>
                                            <?php if($validation->hasError('description')): ?>
                                                <div style="font-size: 85.71428571%; color: #d63939;">
                                                    <?= $validation->getError('description'); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-footer">
                                <div class="row align-items-center">
                                    <div class="col"></div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-outline-primary ms-auto" id="btnSubmitDieselHydrant" name="btnSubmitDieselHydrant">
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
                        <h3 class="card-title">Diesel Hydrant Data</h3>
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
                                    <th>Tekanan Oli<br>2.5 - 5 BAR</th>
                                    <th>Air Radiator</th>
                                    <th>ENGINE RUN TIME<br>Start</th>
                                    <th>ENGINE RUN TIME<br>Running</th>
                                    <th>Tegangan Battery 1<br>10.8 - 13.8 Vdc</th>
                                    <th>Tegangan Battery 2<br>10.8 - 13.8 Vdc</th>
                                    <th>Tangki Solar harian</th>
                                    <th>Tekanan Air Pipa Header</th>
                                    <th>Keterangan</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                    $n = 1;
                                ?>
                                <?php foreach($getDieselHydrantByStore as $t): ?>
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
                                        <td><?= $t['oil_pressure'] ?></td>
                                        <td><?php if($t['radiator']) { echo("Penuh"); } else { echo("Kurang"); } ?></td>
                                        <td><?= $t['start'] ?></td>
                                        <td><?= $t['running'] ?></td>
                                        <td><?= $t['battery_1'] ?></td>
                                        <td><?= $t['battery_2'] ?></td>
                                        <td><?= $t['solar'] ?></td>
                                        <td><?= $t['pipe_pressure'] ?></td>
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
                                        <form id="editDieselHydrantForm" action="<?php echo base_url('dieselhydrant/updateDieselHydrant/' . $t['id']); ?>" method="post">
                                            <div class="modal-dialog modal-xl modal-dialog-centered" role="dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Diesel Hydrant Data</h5>
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

                                                            <div class="col-lg-3">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Tekanan Oli 2.5 - 5 Bar</label>
                                                                    <div class='row' style="margin: 0px;">
                                                                        <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editoilpressure'))) ? 'is-invalid' : ''; ?>" id="editoilpressure" name="editoilpressure" value="<?= $t['oil_pressure']; ?>">
                                                                        <label class="form-label col-3" style="margin-top: auto; margin-bottom: auto;">Bar</label>
                                                                    </div>
                                                                    <?php if(($t['id'] == old('editid')) && ($validation->hasError('editoilpressure'))): ?>
                                                                        <div style="font-size: 85.71428571%; color: #d63939;">
                                                                            <?= $validation->getError('editoilpressure'); ?>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Air Radiator</label>

                                                                    <input <?php if($t['radiator']) { echo("checked"); } ?> id="editradiator" name="editradiator" type="checkbox" class="editradiatorchecks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editradiator')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditRadiator' . $n . '(this.value)' ?>;" value="1">
                                                                    <span>Penuh</span>
                                                                    
                                                                    <span style="padding-left: 20px;"></span>
                                                                    
                                                                    <input <?php if(!$t['radiator']) { echo("checked"); } ?> id="editradiator" name="editradiator" type="checkbox" class="editradiatorchecks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editradiator')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditRadiator' . $n . '(this.value)' ?>;" value="0">
                                                                    <span>Kurang</span>
                                                                    
                                                                    <?php if($validation->hasError('editradiator')): ?>
                                                                        <div class="invalid-feedback">
                                                                            <?= $validation->getError('editradiator'); ?>
                                                                        </div>
                                                                    <?php endif; ?>

                                                                    <script>
                                                                        function checkEditRadiator<?= $n ?>(b){
                                                                            var x = document.getElementsByClassName('editradiatorchecks<?= $n ?>');
                                                                            var i;

                                                                            for(i = 0; i < x.length; i++) {
                                                                                if(x[i].value != b) x[i].checked = false;
                                                                            }
                                                                        }
                                                                    </script>
                                                                </div>

                                                                <div style="padding: 10px; background-color: aliceblue;">
                                                                    <div class="mb-3 text-center">
                                                                        <label class="form-label" style="color: lightsteelblue; font-weight: bold; opacity: 90%;">Engine Run Time<br>(Hours)</label>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Start</label>

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
                                                                        <label class="form-label">Running</label>

                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editrunning')))? 'is-invalid' : ''; ?>" id="editrunning" name="editrunning" value="<?= $t['running']; ?>">
                                                                        </div>

                                                                        <?php if(($t['id'] == old('editid')) && ($validation->hasError('editrunning'))): ?>
                                                                            <div style="font-size: 85.71428571%; color: #d63939;">
                                                                                <?= $validation->getError('editrunning'); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-3">
                                                                <div style="padding: 10px; background-color: aliceblue;">
                                                                    <div class="mb-3 text-center">
                                                                        <label class="form-label" style="color: lightsteelblue; font-weight: bold; opacity: 90%;">Tegangan Battery<br>(Vdc)</label>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Battery 1 10.8 - 13.8 Vdc</label>

                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editbattery1')))? 'is-invalid' : ''; ?>" id="editbattery1" name="editbattery1" value="<?= $t['battery_1']; ?>">
                                                                        </div>

                                                                        <?php if(($t['id'] == old('editid')) && ($validation->hasError('editbattery1'))): ?>
                                                                            <div style="font-size: 85.71428571%; color: #d63939;">
                                                                                <?= $validation->getError('editbattery1'); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Battery 2 10.8 - 13.8 Vdc</label>

                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editbattery2')))? 'is-invalid' : ''; ?>" id="editbattery2" name="editbattery2" value="<?= $t['battery_2']; ?>">
                                                                        </div>

                                                                        <?php if(($t['id'] == old('editid')) && ($validation->hasError('editbattery2'))): ?>
                                                                            <div style="font-size: 85.71428571%; color: #d63939;">
                                                                                <?= $validation->getError('editbattery2'); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-3">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Tangki Solar Harian</label>
                                                                    <div class='row' style="margin: 0px;">
                                                                        <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editsolar'))) ? 'is-invalid' : ''; ?>" id="editsolar" name="editsolar" value="<?= $t['solar']; ?>">
                                                                        <label class="form-label col-3" style="margin-top: auto; margin-bottom: auto;">Liter</label>
                                                                    </div>
                                                                    <?php if(($t['id'] == old('editid')) && ($validation->hasError('editsolar'))): ?>
                                                                        <div style="font-size: 85.71428571%; color: #d63939;">
                                                                            <?= $validation->getError('editsolar'); ?>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Tekanan Air Pipa Header</label>
                                                                    <div class='row' style="margin: 0px;">
                                                                        <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editpipepressure'))) ? 'is-invalid' : ''; ?>" id="editpipepressure" name="editpipepressure" value="<?= $t['pipe_pressure']; ?>">
                                                                    </div>
                                                                    <?php if(($t['id'] == old('editid')) && ($validation->hasError('editpipepressure'))): ?>
                                                                        <div style="font-size: 85.71428571%; color: #d63939;">
                                                                            <?= $validation->getError('editpipepressure'); ?>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>

                                                                <div class="mb-3">
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
                                                            <button type="submit" class="btn btn-outline-primary ms-auto" id="btnUpdateDieselHydrant" name="btnUpdateDieselHydrant" data-bs-dismiss="modal" data-id="<?= $t['id']; ?>">
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
                                        <form id="deleteDieselHydrantForm" action="<?php echo base_url('dieselhydrant/deleteDieselHydrant/' . $t['id']); ?>" method="post">
                                            <div class="modal-dialog modal-xl modal-dialog-centered" role="dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Delete Diesel Hydrant Data</h5>
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
                                                                    
                                                                    <input checked type="checkbox" onclick="return false;">
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

                                                            <div class="col-lg-3">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Tekanan Oli 2.5 - 5 Bar</label>
                                                                    <div class='row' style="margin: 0px;">
                                                                        <input type="text" class="form-control col" value="<?= $t['oil_pressure']; ?>" disabled>
                                                                        <label class="form-label col-3" style="margin-top: auto; margin-bottom: auto;">Bar</label>
                                                                    </div>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Air Radiator</label>

                                                                    <input <?php if($t['radiator']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                    <span>Penuh</span>
                                                                    
                                                                    <span style="padding-left: 20px;"></span>
                                                                    
                                                                    <input <?php if(!$t['radiator']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                    <span>Kurang</span>
                                                                </div>

                                                                <div style="padding: 10px; background-color: aliceblue;">
                                                                    <div class="mb-3 text-center">
                                                                        <label class="form-label" style="color: lightsteelblue; font-weight: bold; opacity: 90%;">Engine Run Time<br>(Hours)</label>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Start</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col" value="<?= $t['start']; ?>" disabled>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Running</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col" value="<?= $t['running']; ?>" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-3">
                                                                <div style="padding: 10px; background-color: aliceblue;">
                                                                    <div class="mb-3 text-center">
                                                                        <label class="form-label" style="color: lightsteelblue; font-weight: bold; opacity: 90%;">Tegangan Battery<br>(Vdc)</label>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Battery 1 10.8 - 13.8 Vdc</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col" value="<?= $t['battery_1']; ?>" disabled>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Battery 2 10.8 - 13.8 Vdc</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col" value="<?= $t['battery_2']; ?>" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-3">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Tangki Solar Harian</label>
                                                                    <div class='row' style="margin: 0px;">
                                                                        <input type="text" class="form-control col" value="<?= $t['solar']; ?>" disabled>
                                                                        <label class="form-label col-3" style="margin-top: auto; margin-bottom: auto;">Liter</label>
                                                                    </div>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Tekanan Air Pipa Header</label>
                                                                    <div class='row' style="margin: 0px;">
                                                                        <input type="text" class="form-control col" value="<?= $t['pipe_pressure']; ?>" disabled>
                                                                    </div>
                                                                </div>

                                                                <div class="mb-3">
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
                                                            <button type="submit" class="btn btn-outline-danger ms-auto" id="btnDeleteDieselHydrant" name="btnDeleteDieselHydrant" data-bs-dismiss="modal" data-id="<?= $t['id']; ?>">
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
                                if($s['idEquipment'] > 7) {
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