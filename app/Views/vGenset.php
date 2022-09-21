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
                        <h3 class="card-title">Genset <?= $genset ?></h3>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo base_url('genset' . $genset . '/saveGenset'); ?>" method="post">
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

                                                    foreach($getGensetByStoreDate as $t) {
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
                                <div class="col-lg-6">
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-4 col-form-label">Genset Run Number</label>
                                        <div class="col">
                                            <div class="input-icon mb-2">
                                                <input id="run_number" name="run_number" class="form-control <?= ($validation->hasError('run_number')) ? 'is-invalid' : ''; ?>" value="<?= old('run_number'); ?>">
                                                <?php if($validation->hasError('run_number')): ?>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('run_number'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-4 col-form-label">Tekanan Oli 2.5 - 8 Bar</label>
                                        <div class="col">
                                            <div class="input-icon mb-2">
                                                <input id="pressure" name="pressure" class="form-control <?= ($validation->hasError('pressure')) ? 'is-invalid' : ''; ?>" value="<?= old('pressure'); ?>">
                                                <?php if($validation->hasError('pressure')): ?>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('pressure'); ?>
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
                                <table class="table card-table table-vcenter text-nowrap datatable table-bordered" style="width:100%">
                                    <tbody>
                                        <tr style="border: 0;">
                                            <td style="border: 0;"></td>
                                            <td style="border: 0;"></td>
                                            <td style="border: 0;"></td>
                                            <td style="border: 0;"></td>
                                        </tr>

                                        <tr>
                                            <td rowspan="2">Engine Run Time<br>(Hours)</td>
                                            <td colspan="2">Start</td>
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
                                            <td colspan="2" style="padding-left: 8px;">Running</td>
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
                                            <td style="border: 0;"></td>
                                        </tr>
                                        
                                        <tr>
                                            <td rowspan="2">Tegangan Battery<br>(Vdc)</td>
                                            <td>12 Vdc</td>
                                            <td>10.8 - 13.8 Vdc</td>
                                            <td>
                                                <input id="vdc_12" name="vdc_12" class="form-control <?= ($validation->hasError('vdc_12')) ? 'is-invalid' : ''; ?>" value="<?= old('vdc_12'); ?>">
                                                <?php if($validation->hasError('vdc_12')): ?>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('vdc_12'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding-left: 8px;">24 Vdc</td>
                                            <td>22 - 27.6 Vdc</td>
                                            <td>
                                                <input id="vdc_24" name="vdc_24" class="form-control <?= ($validation->hasError('vdc_24')) ? 'is-invalid' : ''; ?>" value="<?= old('vdc_24'); ?>">
                                                <?php if($validation->hasError('vdc_24')): ?>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('vdc_24'); ?>
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
                                            <td rowspan="4">Generator Voltage Report<br>(Vac)</td>
                                            <td>R - S</td>
                                            <td>342 - 418 Vac</td>
                                            <td>
                                                <input id="rs" name="rs" class="form-control <?= ($validation->hasError('rs')) ? 'is-invalid' : ''; ?>" value="<?= old('rs'); ?>">
                                                <?php if($validation->hasError('rs')): ?>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('rs'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="padding-left: 8px;">S - T</td>
                                            <td>342 - 418 Vac</td>
                                            <td>
                                                <input id="st" name="st" class="form-control <?= ($validation->hasError('st')) ? 'is-invalid' : ''; ?>" value="<?= old('st'); ?>">
                                                <?php if($validation->hasError('st')): ?>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('st'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="padding-left: 8px;">T - N</td>
                                            <td>342 - 418 Vac</td>
                                            <td>
                                                <input id="tn" name="tn" class="form-control <?= ($validation->hasError('tn')) ? 'is-invalid' : ''; ?>" value="<?= old('tn'); ?>">
                                                <?php if($validation->hasError('tn')): ?>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('tn'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="padding-left: 8px;">L - N</td>
                                            <td>200 - 242 Vac</td>
                                            <td>
                                                <input id="ln" name="ln" class="form-control <?= ($validation->hasError('ln')) ? 'is-invalid' : ''; ?>" value="<?= old('ln'); ?>">
                                                <?php if($validation->hasError('ln')): ?>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('ln'); ?>
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
                                            <td rowspan="4">Generator Load Report<br>(%)</td>
                                            <td style="padding-left: 8px;">R</td>
                                            <td>&plusmn; 80% In</td>
                                            <td>
                                                <input id="r" name="r" class="form-control <?= ($validation->hasError('r')) ? 'is-invalid' : ''; ?>" value="<?= old('r'); ?>">
                                                <?php if($validation->hasError('r')): ?>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('r'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="padding-left: 8px;">S</td>
                                            <td>&plusmn; 80% In</td>
                                            <td>
                                                <input id="s" name="s" class="form-control <?= ($validation->hasError('s')) ? 'is-invalid' : ''; ?>" value="<?= old('s'); ?>">
                                                <?php if($validation->hasError('s')): ?>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('s'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="padding-left: 8px;">T</td>
                                            <td>&plusmn; 80% In</td>
                                            <td>
                                                <input id="t" name="t" class="form-control <?= ($validation->hasError('t')) ? 'is-invalid' : ''; ?>" value="<?= old('t'); ?>">
                                                <?php if($validation->hasError('t')): ?>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('t'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td colspan="2" style="padding-left: 8px;">KW</td>
                                            <td>
                                                <input id="kw" name="kw" class="form-control <?= ($validation->hasError('kw')) ? 'is-invalid' : ''; ?>" value="<?= old('kw'); ?>">
                                                <?php if($validation->hasError('kw')): ?>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('kw'); ?>
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
                                        <button type="submit" class="btn btn-outline-primary ms-auto" id="btnSubmitGenset" name="btnSubmitGenset">
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
                        <h3 class="card-title">Genset <?= $genset ?> Data</h3>
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
                                    <th>Genset Run Number</th>
                                    <th>Tekanan Oli<br>2.5 - 8 BAR</th>
                                    <th>Air Radiator</th>
                                    <th>ENGINE RUN TIME<br>Start</th>
                                    <th>ENGINE RUN TIME<br>Running</th>
                                    <th>TEGANGAN BATTERY 12Vdc<br>10.8 - 13.8 Vdc</th>
                                    <th>TEGANGAN BATTERY 24Vdc<br>22 - 27.6 Vdc</th>
                                    <th>Tangki Solar harian</th>
                                    <th>GENERATOR VOLTAGE REPORT<br>R - S<br>342 - 418 Vac</th>
                                    <th>GENERATOR VOLTAGE REPORT<br>S - T<br>342 - 418 Vac</th>
                                    <th>GENERATOR VOLTAGE REPORT<br>T - N<br>342 - 418 Vac</th>
                                    <th>GENERATOR VOLTAGE REPORT<br>L - N<br>200 - 242 Vac</th>
                                    <th>GENERATOR LOAD REPORT<br>R<br>&plusmn; 80% In</th>
                                    <th>GENERATOR LOAD REPORT<br>S<br>&plusmn; 80% In</th>
                                    <th>GENERATOR LOAD REPORT<br>T<br>&plusmn; 80% In</th>
                                    <th>GENERATOR LOAD REPORT<br>KW</th>
                                    <th>Keterangan</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                    $n = 1;
                                ?>
                                <?php foreach($getGensetByStore as $t): ?>
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
                                        <td><?= $t['run_number'] ?></td>
                                        <td><?= $t['pressure'] ?></td>
                                        <td><?php if($t['radiator']) { echo("Penuh"); } else { echo("Kurang"); } ?></td>
                                        <td><?= $t['start'] ?></td>
                                        <td><?= $t['running'] ?></td>
                                        <td><?= $t['vdc_12'] ?></td>
                                        <td><?= $t['vdc_24'] ?></td>
                                        <td><?= $t['solar'] ?></td>
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
                                        <form id="editGensetForm" action="<?php echo base_url('genset' . $genset . '/updateGenset/' . $t['id']); ?>" method="post">
                                            <div class="modal-dialog modal-xl modal-dialog-centered" role="dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Genset <?= $genset ?> Data</h5>
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

                                                                <div class="mb-3">
                                                                    <label class="form-label">Genset Run Number</label>
                                                                    <div class='row' style="margin: 0px;">
                                                                        <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editrunnumber'))) ? 'is-invalid' : ''; ?>" id="editrunnumber" name="editrunnumber" value="<?= $t['run_number']; ?>">
                                                                    </div>
                                                                    <?php if(($t['id'] == old('editid')) && ($validation->hasError('editrunnumber'))): ?>
                                                                        <div style="font-size: 85.71428571%; color: #d63939;">
                                                                            <?= $validation->getError('editrunnumber'); ?>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-3">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Tekanan Oli 2.5 - 8 Bar</label>
                                                                    <div class='row' style="margin: 0px;">
                                                                        <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editpressure'))) ? 'is-invalid' : ''; ?>" id="editpressure" name="editpressure" value="<?= $t['pressure']; ?>">
                                                                        <label class="form-label col-3" style="margin-top: auto; margin-bottom: auto;">Bar</label>
                                                                    </div>
                                                                    <?php if(($t['id'] == old('editid')) && ($validation->hasError('editpressure'))): ?>
                                                                        <div style="font-size: 85.71428571%; color: #d63939;">
                                                                            <?= $validation->getError('editpressure'); ?>
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

                                                                <div style="padding: 10px; background-color: aliceblue;">
                                                                    <div class="mb-3 text-center">
                                                                        <label class="form-label" style="color: lightsteelblue; font-weight: bold; opacity: 90%;">Tegangan Battery<br>(Vdc)</label>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">12 Vdc (10.8 - 13.8 Vdc)</label>

                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editvdc12')))? 'is-invalid' : ''; ?>" id="editvdc12" name="editvdc12" value="<?= $t['vdc_12']; ?>">
                                                                        </div>
                                                                        <?php if(($t['id'] == old('editid')) && ($validation->hasError('editvdc12'))): ?>
                                                                            <div style="font-size: 85.71428571%; color: #d63939;">
                                                                                <?= $validation->getError('editvdc12'); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">24 Vdc (22 - 27.6 Vdc)</label>

                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editvdc24')))? 'is-invalid' : ''; ?>" id="editvdc24" name="editvdc24" value="<?= $t['vdc_24']; ?>">
                                                                        </div>
                                                                        <?php if(($t['id'] == old('editid')) && ($validation->hasError('editvdc24'))): ?>
                                                                            <div style="font-size: 85.71428571%; color: #d63939;">
                                                                                <?= $validation->getError('editvdc24'); ?>
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

                                                                <div style="padding: 10px; background-color: aliceblue;">
                                                                    <div class="mb-3 text-center">
                                                                        <label class="form-label" style="color: lightsteelblue; font-weight: bold; opacity: 90%;">Generator Voltage Report<br>(Vac)</label>
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
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-3">
                                                                <div style="padding: 10px; background-color: aliceblue;">
                                                                    <div class="mb-3 text-center">
                                                                        <label class="form-label" style="color: lightsteelblue; font-weight: bold; opacity: 90%;">Generator Load Report<br>(%)</label>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">R &plusmn; 80% In</label>

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
                                                                        <label class="form-label">S &plusmn; 80% In</label>

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
                                                                        <label class="form-label">T &plusmn; 80% In</label>

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
                                                            <button type="submit" class="btn btn-outline-primary ms-auto" id="btnUpdateGenset" name="btnUpdateGenset" data-bs-dismiss="modal" data-id="<?= $t['id']; ?>">
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
                                        <form id="deleteGensetForm" action="<?php echo base_url('genset' . $genset . '/deleteGenset/' . $t['id']); ?>" method="post">
                                            <div class="modal-dialog modal-xl modal-dialog-centered" role="dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Delete Genset <?= $genset ?> Data</h5>
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

                                                                <div class="mb-3">
                                                                    <label class="form-label">Genset Run Number</label>
                                                                    <div class='row' style="margin: 0px;">
                                                                        <input type="text" class="form-control col" value="<?= $t['run_number']; ?>" disabled>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-3">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Tekanan Oli 2.5 - 8 Bar</label>
                                                                    <div class='row' style="margin: 0px;">
                                                                        <input type="text" class="form-control col" value="<?= $t['pressure']; ?>" disabled>
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

                                                                <div style="padding: 10px; background-color: aliceblue;">
                                                                    <div class="mb-3 text-center">
                                                                        <label class="form-label" style="color: lightsteelblue; font-weight: bold; opacity: 90%;">Tegangan Battery<br>(Vdc)</label>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">12 Vdc (10.8 - 13.8 Vdc)</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col" value="<?= $t['vdc_12']; ?>" disabled>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">24 Vdc (22 - 27.6 Vdc)</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col" value="<?= $t['vdc_24']; ?>" disabled>
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

                                                                <div style="padding: 10px; background-color: aliceblue;">
                                                                    <div class="mb-3 text-center">
                                                                        <label class="form-label" style="color: lightsteelblue; font-weight: bold; opacity: 90%;">Generator Voltage Report<br>(Vac)</label>
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
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-3">
                                                                <div style="padding: 10px; background-color: aliceblue;">
                                                                    <div class="mb-3 text-center">
                                                                        <label class="form-label" style="color: lightsteelblue; font-weight: bold; opacity: 90%;">Generator Load Report<br>(%)</label>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">R &plusmn; 80% In</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col" value="<?= $t['r']; ?>" disabled>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">S &plusmn; 80% In</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col" value="<?= $t['s']; ?>" disabled>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">T &plusmn; 80% In</label>
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
                                                            <button type="submit" class="btn btn-outline-danger ms-auto" id="btnDeleteGenset" name="btnDeleteGenset" data-bs-dismiss="modal" data-id="<?= $t['id']; ?>">
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

            <?php if($genset == 2): ?>
                <?php if(count($getStoreEquipmentByStore) > 1): ?>
                    <div class="col-12">
                        <a
                            href="<?php
                                $i = 1;
                                foreach($getStoreEquipmentByStore as $s) {
                                    if($s['idEquipment'] > 6) {
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
            <?php else: ?>
                <div class="col-12">
                    <a href="genset<?= ($genset + 1) ?>" class="btn btn-outline-primary ms-auto">Next</a>
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