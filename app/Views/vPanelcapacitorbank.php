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
                        <h3 class="card-title">Panel Capacitor Bank</h3>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo base_url('panelcapacitorbank/savePanelCapacitorBank'); ?>" method="post">
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

                                                    foreach($getPanelCapacitorBankByStoreDate as $t) {
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
                                        <label class="form-label col-4 col-form-label">Total Cos Phi 0.9 - 1</label>
                                        <div class="col">
                                            <div class="input-icon mb-2">
                                                <input id="cos_phi" name="cos_phi" class="form-control <?= ($validation->hasError('cos_phi')) ? 'is-invalid' : ''; ?>" value="<?= old('cos_phi'); ?>">
                                                <?php if($validation->hasError('cos_phi')): ?>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('cos_phi'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <label class="form-label col-1 col-form-label">PF</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-4 col-form-label">Total KW</label>
                                        <div class="col">
                                            <div class="input-icon mb-2">
                                                <input id="kw" name="kw" class="form-control <?= ($validation->hasError('kw')) ? 'is-invalid' : ''; ?>" value="<?= old('kw'); ?>">
                                                <?php if($validation->hasError('kw')): ?>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('kw'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <label class="form-label col-1 col-form-label">KW</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-4 col-form-label">Total KVAR</label>
                                        <div class="col">
                                            <div class="input-icon mb-2">
                                                <input id="kvar" name="kvar" class="form-control <?= ($validation->hasError('kvar')) ? 'is-invalid' : ''; ?>" value="<?= old('kvar'); ?>">
                                                <?php if($validation->hasError('kvar')): ?>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('kvar'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <label class="form-label col-1 col-form-label" style="white-space: nowrap;">KVAR</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-4 col-form-label">Step Number</label>
                                        <div class="col">
                                            <div class="input-icon mb-2">
                                                <input id="step" name="step" class="form-control <?= ($validation->hasError('step')) ? 'is-invalid' : ''; ?>" value="<?= old('step'); ?>">
                                                <?php if($validation->hasError('step')): ?>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('step'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table card-table table-vcenter text-nowrap datatable table-bordered" style="width:100%">
                                    <tbody>
                                        <tr style="border: 0;">
                                            <td style="border: 0;"></td>
                                            <td style="border: 0;"></td>
                                            <td style="border: 0;"></td>
                                            <td style="border: 0;"></td>
                                        </tr>
                                        <tr>
                                            <td rowspan="3">Arus</td>
                                            <td>R</td>
                                            <td>80% In</td>
                                            <td>
                                                <input id="in_r" name="in_r" class="form-control <?= ($validation->hasError('in_r')) ? 'is-invalid' : ''; ?>" value="<?= old('in_r'); ?>">
                                                <?php if($validation->hasError('in_r')): ?>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('in_r'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding-left: 8px;">S</td>
                                            <td>80% In</td>
                                            <td>
                                                <input id="in_s" name="in_s" class="form-control <?= ($validation->hasError('in_s')) ? 'is-invalid' : ''; ?>" value="<?= old('in_s'); ?>">
                                                <?php if($validation->hasError('in_s')): ?>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('in_s'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding-left: 8px;">T</td>
                                            <td>80% In</td>
                                            <td>
                                                <input id="in_t" name="in_t" class="form-control <?= ($validation->hasError('in_t')) ? 'is-invalid' : ''; ?>" value="<?= old('in_t'); ?>">
                                                <?php if($validation->hasError('in_t')): ?>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('in_t'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <tr style="border: 0;">
                                            <td style="border: 0;"></td>
                                            <td style="border: 0;"></td>
                                            <td style="border: 0;"></td>
                                            <td style="border: 0;"></td>
                                        </tr>
                                        <tr>
                                            <td rowspan="3">Kondisi</td>
                                            <td colspan="2">Kebersihan Panel</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if(old('cleanliness') == "1") { echo("checked"); } ?> id="cleanliness" name="cleanliness" type="checkbox" class="cleanchecks <?= ($validation->hasError('cleanliness')) ? 'is-invalid' : ''; ?>" onclick="checkClean(this.value);" value="1">
                                                    Bersih<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if(old('cleanliness') == "0") { echo("checked"); } ?> id="cleanliness" name="cleanliness" type="checkbox" class="cleanchecks <?= ($validation->hasError('cleanliness')) ? 'is-invalid' : ''; ?>" onclick="checkClean(this.value);" value="0">
                                                    Kotor
                                                </div>
                                                <?php if($validation->hasError('cleanliness')): ?>
                                                    <div style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('cleanliness'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkClean(b){
                                                    var x = document.getElementsByClassName('cleanchecks');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if(x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="padding-left: 8px;">Suhu Ruang 23&deg;C - 27&deg;C</td>
                                            <td>
                                                <div class="row" style="padding-top: 20px;">
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-3 row">
                                                            <div class="col">
                                                                <div class="input-icon mb-2">
                                                                    <input id="temperature" name="temperature" class="form-control <?= ($validation->hasError('temperature')) ? 'is-invalid' : ''; ?>" value="<?= old('temperature'); ?>">
                                                                    <?php if($validation->hasError('temperature')): ?>
                                                                        <div class="invalid-feedback">
                                                                            <?= $validation->getError('temperature'); ?>
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
                                            <td colspan="2" style="padding-left: 8px;">Koneksi Kabel</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if(old('connection') == "1") { echo("checked"); } ?> id="connection" name="connection" type="checkbox" class="connectionchecks <?= ($validation->hasError('connection')) ? 'is-invalid' : ''; ?>" onclick="checkConnection(this.value);" value="1">
                                                    Baik<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if(old('connection') == "0") { echo("checked"); } ?> id="connection" name="connection" type="checkbox" class="connectionchecks <?= ($validation->hasError('connection')) ? 'is-invalid' : ''; ?>" onclick="checkConnection(this.value);" value="0">
                                                    Buruk
                                                </div>
                                                <?php if($validation->hasError('connection')): ?>
                                                    <div style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('connection'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkConnection(b){
                                                    var x = document.getElementsByClassName('connectionchecks');
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
                                            <td style="border: 0;"></td>
                                        </tr>
                                    </tbody>
                                </table>
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
                                        <button type="submit" class="btn btn-outline-primary ms-auto" id="btnSubmitPanelCapacitorBank" name="btnSubmitPanelCapacitorBank">
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
                        <h3 class="card-title">Panel Capacitor Bank Data</h3>
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
                                    <th>Total Cos Phi<br>0.9 - 1</th>
                                    <th>Total KW</th>
                                    <th>Total KVAR</th>
                                    <th>Step Number</th>
                                    <th>Arus R</th>
                                    <th>Arus S</th>
                                    <th>Arus T</th>
                                    <th>KONDISI<br>Kebersihan Panel</th>
                                    <th>KONDISI<br>Suhu Ruang 23&deg;C - 27&deg;C</th>
                                    <th>KONDISI<br>Koneksi Kabel</th>
                                    <th>Keterangan</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                    $n = 1;
                                ?>
                                <?php foreach($getPanelCapacitorBankByStore as $t): ?>
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
                                        <td><?= $t['cos_phi'] ?></td>
                                        <td><?= $t['kw'] ?></td>
                                        <td><?= $t['kvar'] ?></td>
                                        <td><?= $t['step'] ?></td>
                                        <td><?= $t['in_r'] ?></td>
                                        <td><?= $t['in_s'] ?></td>
                                        <td><?= $t['in_t'] ?></td>
                                        <td><?php if($t['cleanliness']) { echo("Bersih"); } else { echo("Kotor"); } ?></td>
                                        <td><?= $t['temperature'] ?>&deg;C</td>
                                        <td><?php if($t['connection']) { echo("Baik"); } else { echo("Buruk"); } ?></td>
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
                                        <form id="editPanelCapacitorBankForm" action="<?php echo base_url('panelcapacitorbank/updatePanelCapacitorBank/' . $t['id']); ?>" method="post">
                                            <div class="modal-dialog modal-xl modal-dialog-centered" role="dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Panel Capacitor Bank Data</h5>
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
                                                                        $time3 = 0;

                                                                        foreach($getPanelCapacitorBankByStoreDate as $tt) {
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

                                                            <div class="col-lg-3">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Total Cos Phi 0.9 - 1</label>

                                                                    <div class='row' style="margin: 0px;">
                                                                        <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editcosphi')))? 'is-invalid' : ''; ?>" id="editcosphi" name="editcosphi" value="<?= $t['cos_phi']; ?>">
                                                                        <label class="form-label col-2" style="margin-top: auto; margin-bottom: auto;">PF</label>
                                                                    </div>

                                                                    <?php if(($t['id'] == old('editid')) && ($validation->hasError('editcosphi'))): ?>
                                                                        <div style="font-size: 85.71428571%; color: #d63939;">
                                                                            <?= $validation->getError('editcosphi'); ?>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Total KW</label>

                                                                    <div class='row' style="margin: 0px;">
                                                                        <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editkw')))? 'is-invalid' : ''; ?>" id="editkw" name="editkw" value="<?= $t['kw']; ?>">
                                                                        <label class="form-label col-2" style="margin-top: auto; margin-bottom: auto;">KW</label>
                                                                    </div>

                                                                    <?php if(($t['id'] == old('editid')) && ($validation->hasError('editkw'))): ?>
                                                                        <div style="font-size: 85.71428571%; color: #d63939;">
                                                                            <?= $validation->getError('editkw'); ?>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Total KVAR</label>

                                                                    <div class='row' style="margin: 0px;">
                                                                        <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editkvar')))? 'is-invalid' : ''; ?>" id="editkvar" name="editkvar" value="<?= $t['kvar']; ?>">
                                                                        <label class="form-label col-2" style="margin-top: auto; margin-bottom: auto; white-space: nowrap;">KVAR</label>
                                                                    </div>

                                                                    <?php if(($t['id'] == old('editid')) && ($validation->hasError('editkvar'))): ?>
                                                                        <div style="font-size: 85.71428571%; color: #d63939;">
                                                                            <?= $validation->getError('editkvar'); ?>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Step Number</label>

                                                                    <div class='row' style="margin: 0px;">
                                                                        <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editstep')))? 'is-invalid' : ''; ?>" id="editstep" name="editstep" value="<?= $t['step']; ?>">
                                                                    </div>

                                                                    <?php if(($t['id'] == old('editid')) && ($validation->hasError('editstep'))): ?>
                                                                        <div style="font-size: 85.71428571%; color: #d63939;">
                                                                            <?= $validation->getError('editstep'); ?>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-3">
                                                                <div style="padding: 10px; background-color: aliceblue;">
                                                                    <div class="mb-3 text-center">
                                                                        <label class="form-label" style="color: lightsteelblue; font-weight: bold; opacity: 90%;">ARUS</label>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">R 80%In</label>

                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editinr')))? 'is-invalid' : ''; ?>" id="editinr" name="editinr" value="<?= $t['in_r']; ?>">
                                                                        </div>

                                                                        <?php if(($t['id'] == old('editid')) && ($validation->hasError('editinr'))): ?>
                                                                            <div style="font-size: 85.71428571%; color: #d63939;">
                                                                                <?= $validation->getError('editinr'); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">S 80%In</label>

                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editins')))? 'is-invalid' : ''; ?>" id="editins" name="editins" value="<?= $t['in_s']; ?>">
                                                                        </div>

                                                                        <?php if(($t['id'] == old('editid')) && ($validation->hasError('editins'))): ?>
                                                                            <div style="font-size: 85.71428571%; color: #d63939;">
                                                                                <?= $validation->getError('editins'); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">T 80%In</label>

                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editint')))? 'is-invalid' : ''; ?>" id="editint" name="editint" value="<?= $t['in_t']; ?>">
                                                                        </div>

                                                                        <?php if(($t['id'] == old('editid')) && ($validation->hasError('editint'))): ?>
                                                                            <div style="font-size: 85.71428571%; color: #d63939;">
                                                                                <?= $validation->getError('editint'); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-3">
                                                                <div style="padding: 10px; background-color: aliceblue;">
                                                                    <div class="mb-3 text-center">
                                                                        <label class="form-label" style="color: lightsteelblue; font-weight: bold; opacity: 90%;">KONDISI</label>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Kebersihan Panel</label>

                                                                        <input <?php if($t['cleanliness']) { echo("checked"); } ?> id="editcleanliness" name="editcleanliness" type="checkbox" class="editcleanlinesschecks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editcleanliness')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditCleanliness' . $n . '(this.value)' ?>;" value="1">
                                                                        <span>Bersih</span>
                                                                        
                                                                        <span style="padding-left: 20px;"></span>
                                                                        
                                                                        <input <?php if(!$t['cleanliness']) { echo("checked"); } ?> id="editcleanliness" name="editcleanliness" type="checkbox" class="editcleanlinesschecks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editcleanliness')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditCleanliness' . $n . '(this.value)' ?>;" value="0">
                                                                        <span>Kotor</span>
                                                                        
                                                                        <?php if($validation->hasError('editcleanliness')): ?>
                                                                            <div class="invalid-feedback">
                                                                                <?= $validation->getError('editcleanliness'); ?>
                                                                            </div>
                                                                        <?php endif; ?>

                                                                        <script>
                                                                            function checkEditCleanliness<?= $n ?>(b){
                                                                                var x = document.getElementsByClassName('editcleanlinesschecks<?= $n ?>');
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
                                                                            <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('edittemperature')))? 'is-invalid' : ''; ?>" id="edittemperature" name="edittemperature" value="<?= $t['temperature']; ?>">
                                                                            <label class="form-label col-2" style="margin-top: auto; margin-bottom: auto;">&deg;C</label>
                                                                        </div>

                                                                        <?php if(($t['id'] == old('editid')) && ($validation->hasError('edittemperature'))): ?>
                                                                            <div style="font-size: 85.71428571%; color: #d63939;">
                                                                                <?= $validation->getError('edittemperature'); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Koneksi Kabel</label>

                                                                        <input <?php if($t['connection']) { echo("checked"); } ?> id="editconnection" name="editconnection" type="checkbox" class="editconnectionchecks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editconnection')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditConnection' . $n . '(this.value)' ?>;" value="1">
                                                                        <span>Baik</span>
                                                                        
                                                                        <span style="padding-left: 20px;"></span>
                                                                        
                                                                        <input <?php if(!$t['connection']) { echo("checked"); } ?> id="editconnection" name="editconnection" type="checkbox" class="editconnectionchecks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editconnection')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditConnection' . $n . '(this.value)' ?>;" value="0">
                                                                        <span>Buruk</span>
                                                                        
                                                                        <?php if($validation->hasError('editconnection')): ?>
                                                                            <div class="invalid-feedback">
                                                                                <?= $validation->getError('editconnection'); ?>
                                                                            </div>
                                                                        <?php endif; ?>

                                                                        <script>
                                                                            function checkEditConnection<?= $n ?>(b){
                                                                                var x = document.getElementsByClassName('editconnectionchecks<?= $n ?>');
                                                                                var i;

                                                                                for(i = 0; i < x.length; i++) {
                                                                                    if(x[i].value != b) x[i].checked = false;
                                                                                }
                                                                            }
                                                                        </script>
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
                                                            <button type="submit" class="btn btn-outline-primary ms-auto" id="btnUpdatePanelCapacitorBank" name="btnUpdatePanelCapacitorBank" data-bs-dismiss="modal" data-id="<?= $t['id']; ?>">
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
                                        <form id="deletePanelCapacitorBankForm" action="<?php echo base_url('panelcapacitorbank/deletePanelCapacitorBank/' . $t['id']); ?>" method="post">
                                            <div class="modal-dialog modal-xl modal-dialog-centered" role="dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Delete Panel Capacitor Bank Data</h5>
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

                                                            <div class="col-lg-3">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Total Cos Phi 0.9 - 1</label>
                                                                    <div class='row' style="margin: 0px;">
                                                                        <input type="text" class="form-control col" value="<?= $t['cos_phi']; ?>" disabled>
                                                                        <label class="form-label col-2" style="margin-top: auto; margin-bottom: auto;">PF</label>
                                                                    </div>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Total KW</label>
                                                                    <div class='row' style="margin: 0px;">
                                                                        <input type="text" class="form-control col" value="<?= $t['kw']; ?>" disabled>
                                                                        <label class="form-label col-2" style="margin-top: auto; margin-bottom: auto;">KW</label>
                                                                    </div>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Total KVAR</label>
                                                                    <div class='row' style="margin: 0px;">
                                                                        <input type="text" class="form-control col" value="<?= $t['kvar']; ?>" disabled>
                                                                        <label class="form-label col-2" style="margin-top: auto; margin-bottom: auto; white-space: nowrap;">KVAR</label>
                                                                    </div>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Step Number</label>
                                                                    <div class='row' style="margin: 0px;">
                                                                        <input type="text" class="form-control col" value="<?= $t['step']; ?>" disabled>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-3">
                                                                <div style="padding: 10px; background-color: aliceblue;">
                                                                    <div class="mb-3 text-center">
                                                                        <label class="form-label" style="color: lightsteelblue; font-weight: bold; opacity: 90%;">ARUS</label>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">R 80%In</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col" value="<?= $t['in_r']; ?>" disabled>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">S 80%In</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col" value="<?= $t['in_s']; ?>" disabled>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">T 80%In</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col" value="<?= $t['in_t']; ?>" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-3">
                                                                <div style="padding: 10px; background-color: aliceblue;">
                                                                    <div class="mb-3 text-center">
                                                                        <label class="form-label" style="color: lightsteelblue; font-weight: bold; opacity: 90%;">KONDISI</label>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Kebersihan Panel</label>

                                                                        <input <?php if($t['cleanliness']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                        <span>Bersih</span>
                                                                        
                                                                        <span style="padding-left: 20px;"></span>
                                                                        
                                                                        <input <?php if(!$t['cleanliness']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                        <span>Kotor</span>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Suhu Ruang 23&deg;C - 27&deg;C</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col" value="<?= $t['temperature']; ?>" disabled>
                                                                            <label class="form-label col-2" style="margin-top: auto; margin-bottom: auto;">&deg;C</label>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Koneksi Kabel</label>

                                                                        <input <?php if($t['connection']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                        <span>Baik</span>
                                                                        
                                                                        <span style="padding-left: 20px;"></span>
                                                                        
                                                                        <input <?php if(!$t['connection']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                        <span>Buruk</span>
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
                                                            <button type="submit" class="btn btn-outline-danger ms-auto" id="btnDeletePanelCapacitorBank" name="btnDeletePanelCapacitorBank" data-bs-dismiss="modal" data-id="<?= $t['id']; ?>">
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
                                if($s['idEquipment'] > 5) {
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