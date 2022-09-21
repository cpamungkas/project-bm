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
                        <h3 class="card-title">KWH Meter</h3>
                    </div>
                    
                    <div class="card-body">
                        <form action="<?php echo base_url('kwhmeter/saveKwhMeter'); ?>" method="post">
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

                                                    foreach($getKwhMeterByStoreDate as $t) {
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
                                <div class="col-lg-8">
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-5 col-form-label">KWH Meter</label>
                                        <div class="col">
                                            <div class="input-icon mb-2">
                                                <select name="kwh_meter" id="kwh_meter" class="form-select" id="floatingSelect" aria-label="Floating label select example" required>
                                                    <option value="" selected="">Select KWH Meter</option>
                                                    <?php foreach($getKwhMeterIdPlnByStore as $kwh) : ?>
                                                        <option <?php if(old('kwh_meter') == $kwh['kwh_meter_1_value']) { echo('selected'); } ?> value="<?= $kwh['kwh_meter_1_value'] ?>" data-idpln="<?= $kwh['id_pln_1'] ?>"><?= $kwh['kwh_meter_1_value'] ?></option>
                                                        
                                                        <?php if($kwh['kwh_meter_2_id'] != 1): ?>
                                                            <option <?php if(old('kwh_meter') == $kwh['kwh_meter_2_value']) { echo('selected'); } ?> value="<?= $kwh['kwh_meter_2_value'] ?>" data-idpln="<?= $kwh['id_pln_2'] ?>"><?= $kwh['kwh_meter_2_value'] ?></option>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <label class="form-label col-1 col-form-label">KVA</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-5 col-form-label">ID PLN</label>
                                        <div class="col">
                                            <div class="mb-2">
                                                <input class="form-control <?= ($validation->hasError('id_pln')) ? 'is-invalid' : ''; ?>" name="id_pln_preview" id="id_pln_preview" value="<?= old('id_pln'); ?>" disabled>
                                                <input class="form-control" name="id_pln" id="id_pln" value="<?= old('id_pln'); ?>" hidden>
                                                <?php if($validation->hasError('id_pln')): ?>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('id_pln'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-5 col-form-label">Cos Phi atau PF > 0.85</label>
                                        <div class="col">
                                            <div class="input-icon mb-2">
                                                <input name="cos_phi" id="cos_phi" class="form-control <?= ($validation->hasError('cos_phi')) ? 'is-invalid' : ''; ?>" value="<?= old('cos_phi'); ?>">
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
                                <div class="col-lg-8">
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-5 col-form-label">KW (Kilo Watt)</label>
                                        <div class="col">
                                            <div class="input-icon mb-2">
                                                <input name="kw" id="kw" class="form-control <?= ($validation->hasError('kw')) ? 'is-invalid' : ''; ?>" value="<?= old('kw'); ?>">
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
                                <div class="col-lg-8">
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-5 col-form-label">LWBP (Luar Waktu Beban Puncak)</label>
                                        <div class="col">
                                            <div class="input-icon mb-2">
                                                <input name="lwbp" id="lwbp" class="form-control <?= ($validation->hasError('lwbp')) ? 'is-invalid' : ''; ?>" value="<?= old('lwbp'); ?>">
                                                <?php if($validation->hasError('lwbp')): ?>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('lwbp'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <label class="form-label col-1 col-form-label">KWH</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-5 col-form-label">WBP (Waktu Beban Puncak)</label>
                                        <div class="col">
                                            <div class="input-icon mb-2">
                                                <input name="wbp" id="wbp" class="form-control <?= ($validation->hasError('wbp')) ? 'is-invalid' : ''; ?>" value="<?= old('wbp'); ?>">
                                                <?php if($validation->hasError('wbp')): ?>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('wbp'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <label class="form-label col-1 col-form-label">KWH</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-5 col-form-label">KVARH (Kilo Volt Ampere Reactive Hour)</label>
                                        <div class="col">
                                            <div class="input-icon mb-2">
                                                <input name="kvarh" id="kvarh" class="form-control <?= ($validation->hasError('kvarh')) ? 'is-invalid' : ''; ?>" value="<?= old('kvarh'); ?>">
                                                <?php if($validation->hasError('kvarh')): ?>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('kvarh'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <label class="form-label col-1 col-form-label" style="white-space: nowrap;">KVARH</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-footer">
                                <div class="row align-items-center">
                                    <div class="col"></div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-outline-primary ms-auto" id="btnSubmitKwhMeter" name="btnSubmitKwhMeter">
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
                        <h3 class="card-title">KWH Meter Data</h3>
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
                                    <th>KWH Meter<br>(KVA)</th>
                                    <th>ID PLN</th>
                                    <th>Cos Phi > 0.85<br>(PF)</th>
                                    <th>Kilo Watt<br>(KW)</th>
                                    <th>LWBP<br>(KWH)</th>
                                    <th>WBP<br>(KWH)</th>
                                    <th>KVARH<br>(KVARH)</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                    $n = 1;
                                ?>
                                <?php foreach($getKwhMeterByStore as $t): ?>
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
                                        <td><?= $t['kwh_meter'] ?></td>
                                        <td><?= $t['id_pln'] ?></td>
                                        <td><?= $t['cos_phi'] ?></td>
                                        <td><?= $t['kw'] ?></td>
                                        <td><?= $t['lwbp'] ?></td>
                                        <td><?= $t['wbp'] ?></td>
                                        <td><?= $t['kvarh'] ?></td>
                                        
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
                                        <form id="editKwhMeterForm" action="<?php echo base_url('kwhmeter/updateKwhMeter/' . $t['id']); ?>" method="post">
                                            <div class="modal-dialog modal-lg modal-dialog-centered" role="dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit KWH Meter Data</h5>
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

                                                                        foreach($getKwhMeterByStoreDate as $tt) {
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
                                                                    <label class="form-label">KWH Meter</label>
                                                                    <div class='row' style="margin: 0px;">
                                                                        <select name="editkwhmeter" id="editkwhmeter" data-id="<?= $t['id'] ?>" class="editkwhmeter<?= $t['id'] ?> form-select" aria-label="Floating label select example" required>
                                                                            <option value="" selected="">Select KWH Meter</option>
                                                                            <?php foreach($getKwhMeterIdPlnByStore as $kwh) : ?>
                                                                                <option <?php if($t['kwh_meter'] == $kwh['kwh_meter_1_value']) { echo('selected'); } ?> value="<?= $kwh['kwh_meter_1_value'] ?>" data-editidpln="<?= $kwh['id_pln_1'] ?>"><?= $kwh['kwh_meter_1_value'] ?> KVA</option>
                                                                                
                                                                                <?php if($kwh['kwh_meter_2_id'] != 1): ?>
                                                                                    <option <?php if($t['kwh_meter'] == $kwh['kwh_meter_2_value']) { echo('selected'); } ?> value="<?= $kwh['kwh_meter_2_value'] ?>" data-editidpln="<?= $kwh['id_pln_2'] ?>"><?= $kwh['kwh_meter_2_value'] ?> KVA</option>
                                                                                <?php endif; ?>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                    <?php if(($t['id'] == old('editid')) && ($validation->hasError('editkwhmeter'))): ?>
                                                                        <div style="font-size: 85.71428571%; color: #d63939;">
                                                                            <?= $validation->getError('editkwhmeter'); ?>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">ID PLN</label>
                                                                    <div class='row' style="margin: 0px;">
                                                                        <input disabled type="text" class="editidplnpreview<?= $t['id'] ?> form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editidpln'))) ? 'is-invalid' : ''; ?>" id="editidplnpreview" name="editidplnpreview" value="<?= $t['id_pln']; ?>">
                                                                        <input hidden type="text" class="editidpln<?= $t['id'] ?> form-control col" id="editidpln" name="editidpln" value="<?= $t['id_pln']; ?>">
                                                                    </div>
                                                                    <?php if(($t['id'] == old('editid')) && ($validation->hasError('editidpln'))): ?>
                                                                        <div style="font-size: 85.71428571%; color: #d63939;">
                                                                            <?= $validation->getError('editidpln'); ?>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Cos Phi atau PF > 0.85</label>
                                                                    <div class='row' style="margin: 0px;">
                                                                        <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editcosphi'))) ? 'is-invalid' : ''; ?>" id="editcosphi" name="editcosphi" value="<?= $t['cos_phi']; ?>">
                                                                        <label class="form-label col-3" style="margin-top: auto; margin-bottom: auto;">PF</label>
                                                                    </div>
                                                                    <?php if(($t['id'] == old('editid')) && ($validation->hasError('editcosphi'))): ?>
                                                                        <div style="font-size: 85.71428571%; color: #d63939;">
                                                                            <?= $validation->getError('editcosphi'); ?>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-4">
                                                                <div class="mb-3">
                                                                    <label class="form-label">KW (Kilo Watt)</label>
                                                                    <div class='row' style="margin: 0px;">
                                                                        <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editkw'))) ? 'is-invalid' : ''; ?>" id="editkw" name="editkw" value="<?= $t['kw']; ?>">
                                                                        <label class="form-label col-3" style="margin-top: auto; margin-bottom: auto;">KW</label>
                                                                    </div>
                                                                    <?php if(($t['id'] == old('editid')) && ($validation->hasError('editkw'))): ?>
                                                                        <div style="font-size: 85.71428571%; color: #d63939;">
                                                                            <?= $validation->getError('editkw'); ?>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">LWBP (Luar Waktu Beban Puncak)</label>
                                                                    <div class='row' style="margin: 0px;">
                                                                        <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editlwbp'))) ? 'is-invalid' : ''; ?>" id="editlwbp" name="editlwbp" value="<?= $t['lwbp']; ?>">
                                                                        <label class="form-label col-3" style="margin-top: auto; margin-bottom: auto;">KWH</label>
                                                                    </div>
                                                                    <?php if(($t['id'] == old('editid')) && ($validation->hasError('editlwbp'))): ?>
                                                                        <div style="font-size: 85.71428571%; color: #d63939;">
                                                                            <?= $validation->getError('editlwbp'); ?>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">WBP (Waktu Beban Puncak)</label>
                                                                    <div class='row' style="margin: 0px;">
                                                                        <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editwbp'))) ? 'is-invalid' : ''; ?>" id="editwbp" name="editwbp" value="<?= $t['wbp']; ?>">
                                                                        <label class="form-label col-3" style="margin-top: auto; margin-bottom: auto;">KWH</label>
                                                                    </div>
                                                                    <?php if(($t['id'] == old('editid')) && ($validation->hasError('editwbp'))): ?>
                                                                        <div style="font-size: 85.71428571%; color: #d63939;">
                                                                            <?= $validation->getError('editwbp'); ?>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">KVARH (Kilo Volt Ampere Reactive Hour)</label>
                                                                    <div class='row' style="margin: 0px;">
                                                                        <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editkvarh'))) ? 'is-invalid' : ''; ?>" id="editkvarh" name="editkvarh" value="<?= $t['kvarh']; ?>">
                                                                        <label class="form-label col-3" style="margin-top: auto; margin-bottom: auto; white-space: nowrap;">KVARH</label>
                                                                    </div>
                                                                    <?php if(($t['id'] == old('editid')) && ($validation->hasError('editkvarh'))): ?>
                                                                        <div style="font-size: 85.71428571%; color: #d63939;">
                                                                            <?= $validation->getError('editkvarh'); ?>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <div class="col-auto">
                                                            <button type="submit" class="btn btn-outline-primary ms-auto" id="btnUpdateKwhMeter" name="btnUpdateKwhMeter" data-bs-dismiss="modal" data-id="<?= $t['id']; ?>">
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
                                        <form id="deleteKwhMeterForm" action="<?php echo base_url('kwhmeter/deleteKwhMeter/' . $t['id']); ?>" method="post">
                                            <div class="modal-dialog modal-lg modal-dialog-centered" role="dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Delete KWH Meter Data</h5>
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
                                                                    <label class="form-label">KWH Meter</label>
                                                                    <div class='row' style="margin: 0px;">
                                                                        <select class="form-select" aria-label="Floating label select example" disabled>
                                                                            <option selected><?= $kwh['kwh_meter_1_value'] ?> KVA</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">ID PLN</label>
                                                                    <div class='row' style="margin: 0px;">
                                                                        <input disabled type="text" class="form-control col" value="<?= $t['id_pln']; ?>">
                                                                    </div>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Cos Phi atau PF > 0.85</label>
                                                                    <div class='row' style="margin: 0px;">
                                                                        <input type="text" class="form-control col" value="<?= $t['cos_phi']; ?>" disabled>
                                                                        <label class="form-label col-3" style="margin-top: auto; margin-bottom: auto;">PF</label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-4">
                                                                <div class="mb-3">
                                                                    <label class="form-label">KW (Kilo Watt)</label>
                                                                    <div class='row' style="margin: 0px;">
                                                                        <input type="text" class="form-control col" value="<?= $t['kw']; ?>" disabled>
                                                                        <label class="form-label col-3" style="margin-top: auto; margin-bottom: auto;">KW</label>
                                                                    </div>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">LWBP (Luar Waktu Beban Puncak)</label>
                                                                    <div class='row' style="margin: 0px;">
                                                                        <input type="text" class="form-control col" value="<?= $t['lwbp']; ?>" disabled>
                                                                        <label class="form-label col-3" style="margin-top: auto; margin-bottom: auto;">KWH</label>
                                                                    </div>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">WBP (Waktu Beban Puncak)</label>
                                                                    <div class='row' style="margin: 0px;">
                                                                        <input type="text" class="form-control col" value="<?= $t['wbp']; ?>" disabled>
                                                                        <label class="form-label col-3" style="margin-top: auto; margin-bottom: auto;">KWH</label>
                                                                    </div>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">KVARH (Kilo Volt Ampere Reactive Hour)</label>
                                                                    <div class='row' style="margin: 0px;">
                                                                        <input type="text" class="form-control col" value="<?= $t['kvarh']; ?>" disabled>
                                                                        <label class="form-label col-3" style="margin-top: auto; margin-bottom: auto; white-space: nowrap;">KVARH</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <div class="col-auto">
                                                            <button type="submit" class="btn btn-outline-danger ms-auto" id="btnDeleteKwhMeter" name="btnDeleteKwhMeter" data-bs-dismiss="modal" data-id="<?= $t['id']; ?>">
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
                                if($s['idEquipment'] > 2) {
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
        $('#kwh_meter').on('change', function() {
            $('#id_pln_preview').val($(this).find(':selected').data('idpln')).trigger('change');
            $('#id_pln').val($(this).find(':selected').data('idpln')).trigger('change');
        });

        $('select[class^="editkwhmeter"]').on('change', function() {
            $('.editidplnpreview' + $(this).data("id")).val($(this).find(':selected').data('editidpln')).trigger('change');
            $('.editidpln' + $(this).data("id")).val($(this).find(':selected').data('editidpln')).trigger('change');
        });

        $("#btnReset").on( "click", function() {
            $("input[type=checkbox]:not(:disabled):not(:hidden)").removeAttr('checked');
            $("input:not([type=checkbox]):not(:disabled):not(:hidden)").attr("value","");
            $("#id_pln").attr("value","");
            $("#id_pln_preview").attr("value","");
            $("#description").html("");

            $("#kwh_meter option:selected").each(function () {
                $(this).removeAttr('selected'); 
            });
        });
    })
</script>

<?= $this->endSection(); ?>