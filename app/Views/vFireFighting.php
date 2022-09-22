<?= $this->extend('template_worker/index'); ?>
<?= $this->section('page-content'); ?>

<div class="page-body">
    <div class="container-xl">
        <div class="row row-deck row-cards">
            <?php if (session("error")) { ?>
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

            <?php if (session("success")) { ?>
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
                        <h3 class="card-title">Fire Fighting</h3>
                    </div>

                    <div class="card-body">
                        <form id="formInputData" action="<?php echo base_url('firefighting/saveFireFighting'); ?>" method="post">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-3 col-form-label">Location</label>
                                        <div class="col">
                                            <div class="input-icon mb-2">
                                                <input id="location" class="form-control" value="<?= $location ?>" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-3 col-form-label">Date</label>
                                        <div class="col">
                                            <div class="input-icon mb-2">
                                                <input id="date" name="date" class="form-control" value="<?= date('d-m-Y'); ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-3 col-form-label">Worker</label>
                                        <div class="col">
                                            <div class="input-icon mb-2">
                                                <input id="worker" class="form-control" value="<?= session()->get('initial') ?>" disabled>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="form-label col-3 col-form-label pt-0">Checklist</label>
                                        <div class="col">
                                            <div class="form-floating">
                                                <select disabled id="equipment_checklist" name="equipment_checklist" class="form-select <?= ($validation->hasError('equipment_checklist')) ? 'is-invalid' : ''; ?>" required>
                                                    <option <?= old('equipment_checklist') != null && old('equipment_checklist') == 'DAILY' ? 'selected' : ($defaultChecklist['checklist'] == 'DAILY' ? 'selected' : ''); ?> value="DAILY">DAILY</option>
                                                    <option <?= old('equipment_checklist') != null && old('equipment_checklist') == 'WEEKLY' ? 'selected' : ($defaultChecklist['checklist'] == 'WEEKLY' ? 'selected' : ''); ?> value="WEEKLY">WEEKLY</option>
                                                    <option <?= old('equipment_checklist') != null && old('equipment_checklist') == 'MONTHLY' ? 'selected' : ($defaultChecklist['checklist'] == 'MONTHLY' ? 'selected' : ''); ?> value="MONTHLY">MONTHLY</option>
                                                </select>
                                                <label for="floatingSelect">Select Checklist</label>
                                            </div>
                                            <?php if ($validation->hasError('equipment_checklist')) : ?>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('equipment_checklist'); ?>
                                                </div>
                                            <?php endif; ?>
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
                                        </tr>
                                        <tr>
                                            <td class="col-3" rowspan="3">MCFA</td>
                                            <td class="col" colspan="2" style="padding-left: 8px;">
                                                <div class="form-group mb-3 row">
                                                    <label class="form-label col-3 col-form-label">Type</label>
                                                    <div class="col">
                                                        <input type="text" class="form-control <?= ($validation->hasError('type')) ? 'is-invalid' : ''; ?>" id="type" name="type" placeholder="Type" value="<?= old('type'); ?>">
                                                        <?php if ($validation->hasError('type')) : ?>
                                                            <div class="invalid-feedback">
                                                                <?= $validation->getError('type'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col" colspan="2" style="padding-left: 8px;">
                                                <div class="form-group mb-3 row">
                                                    <label class="form-label col-3 col-form-label">Jumlah Zona</label>
                                                    <div class="col">
                                                        <input type="text" class="form-control <?= ($validation->hasError('jumlah_zona')) ? 'is-invalid' : ''; ?>" id="jumlah_zona" name="jumlah_zona" placeholder="Jumlah Zona" value="<?= old('jumlah_zona'); ?>">
                                                        <?php if ($validation->hasError('jumlah_zona')) : ?>
                                                            <div class="invalid-feedback">
                                                                <?= $validation->getError('jumlah_zona'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col" colspan="2" style="padding-left: 8px;">
                                                <div class="form-check">
                                                    <input <?php if (old('mcfa_normal') == "1") {
                                                                echo ("checked");
                                                            } ?> value="1" id="mcfa_normal" name="mcfa_normal" class="form-check-input  <?= ($validation->hasError('mcfa_normal')) ? 'is-invalid' : ''; ?>" type="checkbox">
                                                    <span class="form-check-label">Normal</span>
                                                    <?php if ($validation->hasError('mcfa_normal')) : ?>
                                                        <div class="invalid-feedback">
                                                            <?= $validation->getError('mcfa_normal'); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="form-check">
                                                    <input <?php if (old('mcfa_alarm_silenced') == "1") {
                                                                echo ("checked");
                                                            } ?> value="1" id="mcfa_alarm_silenced" name="mcfa_alarm_silenced" class="form-check-input  <?= ($validation->hasError('mcfa_alarm_silenced')) ? 'is-invalid' : ''; ?>" type="checkbox">
                                                    <span class="form-check-label">Alarm Silenced</span>
                                                    <?php if ($validation->hasError('mcfa_alarm_silenced')) : ?>
                                                        <div class="invalid-feedback">
                                                            <?= $validation->getError('mcfa_alarm_silenced'); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="form-check">
                                                    <input <?php if (old('mcfa_fire') == "1") {
                                                                echo ("checked");
                                                            } ?> value="1" id="mcfa_fire" name="mcfa_fire" class="form-check-input  <?= ($validation->hasError('mcfa_fire')) ? 'is-invalid' : ''; ?>" type="checkbox">
                                                    <span class="form-check-label">Fire</span>
                                                    <?php if ($validation->hasError('mcfa_fire')) : ?>
                                                        <div class="invalid-feedback">
                                                            <?= $validation->getError('mcfa_fire'); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="form-check">
                                                    <input <?php if (old('mcfa_trouble') == "1") {
                                                                echo ("checked");
                                                            } ?> value="1" id="mcfa_trouble" name="mcfa_trouble" class="form-check-input  <?= ($validation->hasError('mcfa_trouble')) ? 'is-invalid' : ''; ?>" type="checkbox">
                                                    <span class="form-check-label">Trouble</span>
                                                    <?php if ($validation->hasError('mcfa_trouble')) : ?>
                                                        <div class="invalid-feedback">
                                                            <?= $validation->getError('mcfa_trouble'); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr style="border: 0;">
                                            <td style="border: 0;"></td>
                                            <td style="border: 0;"></td>
                                            <td style="border: 0;"></td>
                                        </tr>
                                        <tr>
                                            <td class="col-3" rowspan="3">Lantai 1</td>
                                            <td class="col-4" style="padding-left: 8px;">Smoke Detector</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('lt1_smoke_detector') == "1") {
                                                                echo ("checked");
                                                            } ?> id="lt1_smoke_detector" name="lt1_smoke_detector" type="checkbox" class="checklt1_smoke_detector <?= ($validation->hasError('lt1_smoke_detector')) ? 'is-invalid' : ''; ?>" onclick="checklt1_smoke_detector(this.value);" value="1">
                                                    Baik<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('lt1_smoke_detector') == "0") {
                                                                echo ("checked");
                                                            } ?> id="lt1_smoke_detector" name="lt1_smoke_detector" type="checkbox" class="checklt1_smoke_detector <?= ($validation->hasError('lt1_smoke_detector')) ? 'is-invalid' : ''; ?>" onclick="checklt1_smoke_detector(this.value);" value="0">
                                                    Rusak
                                                </div>
                                                <?php if ($validation->hasError('lt1_smoke_detector')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('lt1_smoke_detector'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checklt1_smoke_detector(b) {
                                                    var x = document.getElementsByClassName('checklt1_smoke_detector');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Heat Detector</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('lt1_heat_detector') == "1") {
                                                                echo ("checked");
                                                            } ?> id="lt1_heat_detector" name="lt1_heat_detector" type="checkbox" class="checklt1_heat_detector <?= ($validation->hasError('lt1_heat_detector')) ? 'is-invalid' : ''; ?>" onclick="checklt1_heat_detector(this.value);" value="1">
                                                    Baik<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('lt1_heat_detector') == "0") {
                                                                echo ("checked");
                                                            } ?> id="lt1_heat_detector" name="lt1_heat_detector" type="checkbox" class="checklt1_heat_detector <?= ($validation->hasError('lt1_heat_detector')) ? 'is-invalid' : ''; ?>" onclick="checklt1_heat_detector(this.value);" value="0">
                                                    Rusak
                                                </div>
                                                <?php if ($validation->hasError('lt1_heat_detector')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('lt1_heat_detector'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checklt1_heat_detector(b) {
                                                    var x = document.getElementsByClassName('checklt1_heat_detector');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Flow Switch</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('lt1_flow_switch') == "1") {
                                                                echo ("checked");
                                                            } ?> id="lt1_flow_switch" name="lt1_flow_switch" type="checkbox" class="checklt1_flow_switch <?= ($validation->hasError('lt1_flow_switch')) ? 'is-invalid' : ''; ?>" onclick="checklt1_flow_switch(this.value);" value="1">
                                                    Baik<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('lt1_flow_switch') == "0") {
                                                                echo ("checked");
                                                            } ?> id="lt1_flow_switch" name="lt1_flow_switch" type="checkbox" class="checklt1_flow_switch <?= ($validation->hasError('lt1_flow_switch')) ? 'is-invalid' : ''; ?>" onclick="checklt1_flow_switch(this.value);" value="0">
                                                    Rusak
                                                </div>
                                                <?php if ($validation->hasError('lt1_flow_switch')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('lt1_flow_switch'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checklt1_flow_switch(b) {
                                                    var x = document.getElementsByClassName('checklt1_flow_switch');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
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
                                            <td class="col-3" rowspan="3">Lantai 2</td>
                                            <td class="col-4" style="padding-left: 8px;">Smoke Detector</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('lt2_smoke_detector') == "1") {
                                                                echo ("checked");
                                                            } ?> id="lt2_smoke_detector" name="lt2_smoke_detector" type="checkbox" class="checklt2_smoke_detector <?= ($validation->hasError('lt2_smoke_detector')) ? 'is-invalid' : ''; ?>" onclick="checklt2_smoke_detector(this.value);" value="1">
                                                    Baik<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('lt2_smoke_detector') == "0") {
                                                                echo ("checked");
                                                            } ?> id="lt2_smoke_detector" name="lt2_smoke_detector" type="checkbox" class="checklt2_smoke_detector <?= ($validation->hasError('lt2_smoke_detector')) ? 'is-invalid' : ''; ?>" onclick="checklt2_smoke_detector(this.value);" value="0">
                                                    Rusak
                                                </div>
                                                <?php if ($validation->hasError('lt2_smoke_detector')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('lt2_smoke_detector'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checklt2_smoke_detector(b) {
                                                    var x = document.getElementsByClassName('checklt2_smoke_detector');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Heat Detector</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('lt2_heat_detector') == "1") {
                                                                echo ("checked");
                                                            } ?> id="lt2_heat_detector" name="lt2_heat_detector" type="checkbox" class="checklt2_heat_detector <?= ($validation->hasError('lt2_heat_detector')) ? 'is-invalid' : ''; ?>" onclick="checklt2_heat_detector(this.value);" value="1">
                                                    Baik<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('lt2_heat_detector') == "0") {
                                                                echo ("checked");
                                                            } ?> id="lt2_heat_detector" name="lt2_heat_detector" type="checkbox" class="checklt2_heat_detector <?= ($validation->hasError('lt2_heat_detector')) ? 'is-invalid' : ''; ?>" onclick="checklt2_heat_detector(this.value);" value="0">
                                                    Rusak
                                                </div>
                                                <?php if ($validation->hasError('lt2_heat_detector')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('lt2_heat_detector'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checklt2_heat_detector(b) {
                                                    var x = document.getElementsByClassName('checklt2_heat_detector');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Flow Switch</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('lt2_flow_switch') == "1") {
                                                                echo ("checked");
                                                            } ?> id="lt2_flow_switch" name="lt2_flow_switch" type="checkbox" class="checklt2_flow_switch <?= ($validation->hasError('lt2_flow_switch')) ? 'is-invalid' : ''; ?>" onclick="checklt2_flow_switch(this.value);" value="1">
                                                    Baik<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('lt2_flow_switch') == "0") {
                                                                echo ("checked");
                                                            } ?> id="lt2_flow_switch" name="lt2_flow_switch" type="checkbox" class="checklt2_flow_switch <?= ($validation->hasError('lt2_flow_switch')) ? 'is-invalid' : ''; ?>" onclick="checklt2_flow_switch(this.value);" value="0">
                                                    Rusak
                                                </div>
                                                <?php if ($validation->hasError('lt2_flow_switch')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('lt2_flow_switch'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checklt2_flow_switch(b) {
                                                    var x = document.getElementsByClassName('checklt2_flow_switch');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
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
                                            <td class="col-3" rowspan="3">Lantai 3</td>
                                            <td class="col-4" style="padding-left: 8px;">Smoke Detector</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('lt3_smoke_detector') == "1") {
                                                                echo ("checked");
                                                            } ?> id="lt3_smoke_detector" name="lt3_smoke_detector" type="checkbox" class="checklt3_smoke_detector <?= ($validation->hasError('lt3_smoke_detector')) ? 'is-invalid' : ''; ?>" onclick="checklt3_smoke_detector(this.value);" value="1">
                                                    Baik<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('lt3_smoke_detector') == "0") {
                                                                echo ("checked");
                                                            } ?> id="lt3_smoke_detector" name="lt3_smoke_detector" type="checkbox" class="checklt3_smoke_detector <?= ($validation->hasError('lt3_smoke_detector')) ? 'is-invalid' : ''; ?>" onclick="checklt3_smoke_detector(this.value);" value="0">
                                                    Rusak
                                                </div>
                                                <?php if ($validation->hasError('lt3_smoke_detector')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('lt3_smoke_detector'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checklt3_smoke_detector(b) {
                                                    var x = document.getElementsByClassName('checklt3_smoke_detector');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Heat Detector</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('lt3_heat_detector') == "1") {
                                                                echo ("checked");
                                                            } ?> id="lt3_heat_detector" name="lt3_heat_detector" type="checkbox" class="checklt3_heat_detector <?= ($validation->hasError('lt3_heat_detector')) ? 'is-invalid' : ''; ?>" onclick="checklt3_heat_detector(this.value);" value="1">
                                                    Baik<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('lt3_heat_detector') == "0") {
                                                                echo ("checked");
                                                            } ?> id="lt3_heat_detector" name="lt3_heat_detector" type="checkbox" class="checklt3_heat_detector <?= ($validation->hasError('lt3_heat_detector')) ? 'is-invalid' : ''; ?>" onclick="checklt3_heat_detector(this.value);" value="0">
                                                    Rusak
                                                </div>
                                                <?php if ($validation->hasError('lt3_heat_detector')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('lt3_heat_detector'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checklt3_heat_detector(b) {
                                                    var x = document.getElementsByClassName('checklt3_heat_detector');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Flow Switch</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('lt3_flow_switch') == "1") {
                                                                echo ("checked");
                                                            } ?> id="lt3_flow_switch" name="lt3_flow_switch" type="checkbox" class="checklt3_flow_switch <?= ($validation->hasError('lt3_flow_switch')) ? 'is-invalid' : ''; ?>" onclick="checklt3_flow_switch(this.value);" value="1">
                                                    Baik<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('lt3_flow_switch') == "0") {
                                                                echo ("checked");
                                                            } ?> id="lt3_flow_switch" name="lt3_flow_switch" type="checkbox" class="checklt3_flow_switch <?= ($validation->hasError('lt3_flow_switch')) ? 'is-invalid' : ''; ?>" onclick="checklt3_flow_switch(this.value);" value="0">
                                                    Rusak
                                                </div>
                                                <?php if ($validation->hasError('lt3_flow_switch')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('lt3_flow_switch'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checklt3_flow_switch(b) {
                                                    var x = document.getElementsByClassName('checklt3_flow_switch');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
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
                                            <td class="col-3" rowspan="3">Lantai 4</td>
                                            <td class="col-4" style="padding-left: 8px;">Smoke Detector</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('lt4_smoke_detector') == "1") {
                                                                echo ("checked");
                                                            } ?> id="lt4_smoke_detector" name="lt4_smoke_detector" type="checkbox" class="checklt4_smoke_detector <?= ($validation->hasError('lt4_smoke_detector')) ? 'is-invalid' : ''; ?>" onclick="checklt4_smoke_detector(this.value);" value="1">
                                                    Baik<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('lt4_smoke_detector') == "0") {
                                                                echo ("checked");
                                                            } ?> id="lt4_smoke_detector" name="lt4_smoke_detector" type="checkbox" class="checklt4_smoke_detector <?= ($validation->hasError('lt4_smoke_detector')) ? 'is-invalid' : ''; ?>" onclick="checklt4_smoke_detector(this.value);" value="0">
                                                    Rusak
                                                </div>
                                                <?php if ($validation->hasError('lt4_smoke_detector')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('lt4_smoke_detector'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checklt4_smoke_detector(b) {
                                                    var x = document.getElementsByClassName('checklt4_smoke_detector');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Heat Detector</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('lt4_heat_detector') == "1") {
                                                                echo ("checked");
                                                            } ?> id="lt4_heat_detector" name="lt4_heat_detector" type="checkbox" class="checklt4_heat_detector <?= ($validation->hasError('lt4_heat_detector')) ? 'is-invalid' : ''; ?>" onclick="checklt4_heat_detector(this.value);" value="1">
                                                    Baik<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('lt4_heat_detector') == "0") {
                                                                echo ("checked");
                                                            } ?> id="lt4_heat_detector" name="lt4_heat_detector" type="checkbox" class="checklt4_heat_detector <?= ($validation->hasError('lt4_heat_detector')) ? 'is-invalid' : ''; ?>" onclick="checklt4_heat_detector(this.value);" value="0">
                                                    Rusak
                                                </div>
                                                <?php if ($validation->hasError('lt4_heat_detector')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('lt4_heat_detector'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checklt4_heat_detector(b) {
                                                    var x = document.getElementsByClassName('checklt4_heat_detector');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Flow Switch</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('lt4_flow_switch') == "1") {
                                                                echo ("checked");
                                                            } ?> id="lt4_flow_switch" name="lt4_flow_switch" type="checkbox" class="checklt4_flow_switch <?= ($validation->hasError('lt4_flow_switch')) ? 'is-invalid' : ''; ?>" onclick="checklt4_flow_switch(this.value);" value="1">
                                                    Baik<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('lt4_flow_switch') == "0") {
                                                                echo ("checked");
                                                            } ?> id="lt4_flow_switch" name="lt4_flow_switch" type="checkbox" class="checklt4_flow_switch <?= ($validation->hasError('lt4_flow_switch')) ? 'is-invalid' : ''; ?>" onclick="checklt4_flow_switch(this.value);" value="0">
                                                    Rusak
                                                </div>
                                                <?php if ($validation->hasError('lt4_flow_switch')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('lt4_flow_switch'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checklt4_flow_switch(b) {
                                                    var x = document.getElementsByClassName('checklt4_flow_switch');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
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

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="table-responsive">
                                        <table class="table table-bordered card-table table-vcenter text-nowrap datatable" style="width:100%">
                                            <tbody>
                                                <tr style="border: 0;">
                                                    <td style="border: 0;"></td>
                                                    <td style="border: 0;"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-3" style="padding-left: 8px;">Hydrant Pillar</td>
                                                    <td>
                                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                                            <input <?php if (old('hydrant_pillar') == "1") {
                                                                        echo ("checked");
                                                                    } ?> id="hydrant_pillar" name="hydrant_pillar" type="checkbox" class="checkhydrant_pillar <?= ($validation->hasError('hydrant_pillar')) ? 'is-invalid' : ''; ?>" onclick="checkhydrant_pillar(this.value);" value="1">
                                                            Baik<br>
                                                        </div>
                                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                                            <input <?php if (old('hydrant_pillar') == "0") {
                                                                        echo ("checked");
                                                                    } ?> id="hydrant_pillar" name="hydrant_pillar" type="checkbox" class="checkhydrant_pillar <?= ($validation->hasError('hydrant_pillar')) ? 'is-invalid' : ''; ?>" onclick="checkhydrant_pillar(this.value);" value="0">
                                                            Rusak
                                                        </div>
                                                        <?php if ($validation->hasError('hydrant_pillar')) : ?>
                                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                                <?= $validation->getError('hydrant_pillar'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                    <script>
                                                        function checkhydrant_pillar(b) {
                                                            var x = document.getElementsByClassName('checkhydrant_pillar');
                                                            var i;

                                                            for (i = 0; i < x.length; i++) {
                                                                if (x[i].value != b) x[i].checked = false;
                                                            }
                                                        }
                                                    </script>
                                                </tr>
                                                <tr>
                                                    <td class="col-3" style="padding-left: 8px;">Siamese Connection</td>
                                                    <td>
                                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                                            <input <?php if (old('siamese_connection') == "1") {
                                                                        echo ("checked");
                                                                    } ?> id="siamese_connection" name="siamese_connection" type="checkbox" class="checksiamese_connection <?= ($validation->hasError('siamese_connection')) ? 'is-invalid' : ''; ?>" onclick="checksiamese_connection(this.value);" value="1">
                                                            Baik<br>
                                                        </div>
                                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                                            <input <?php if (old('siamese_connection') == "0") {
                                                                        echo ("checked");
                                                                    } ?> id="siamese_connection" name="siamese_connection" type="checkbox" class="checksiamese_connection <?= ($validation->hasError('siamese_connection')) ? 'is-invalid' : ''; ?>" onclick="checksiamese_connection(this.value);" value="0">
                                                            Rusak
                                                        </div>
                                                        <?php if ($validation->hasError('siamese_connection')) : ?>
                                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                                <?= $validation->getError('siamese_connection'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                    <script>
                                                        function checksiamese_connection(b) {
                                                            var x = document.getElementsByClassName('checksiamese_connection');
                                                            var i;

                                                            for (i = 0; i < x.length; i++) {
                                                                if (x[i].value != b) x[i].checked = false;
                                                            }
                                                        }
                                                    </script>
                                                </tr>
                                                <tr style="border: 0;">
                                                    <td style="border: 0;"></td>
                                                    <td style="border: 0;"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="table-responsive">
                                        <table class="table table-bordered card-table table-vcenter text-nowrap datatable" style="width:100%">
                                            <tbody>
                                                <tr style="border: 0;">
                                                    <td style="border: 0;"></td>
                                                    <td style="border: 0;"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-3" style="padding-left: 8px;">Lampu & Bell</td>
                                                    <td>
                                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                                            <input <?php if (old('lampu_dan_bell') == "1") {
                                                                        echo ("checked");
                                                                    } ?> id="lampu_dan_bell" name="lampu_dan_bell" type="checkbox" class="checklampu_dan_bell <?= ($validation->hasError('lampu_dan_bell')) ? 'is-invalid' : ''; ?>" onclick="checklampu_dan_bell(this.value);" value="1">
                                                            Baik<br>
                                                        </div>
                                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                                            <input <?php if (old('lampu_dan_bell') == "0") {
                                                                        echo ("checked");
                                                                    } ?> id="lampu_dan_bell" name="lampu_dan_bell" type="checkbox" class="checklampu_dan_bell <?= ($validation->hasError('lampu_dan_bell')) ? 'is-invalid' : ''; ?>" onclick="checklampu_dan_bell(this.value);" value="0">
                                                            Rusak
                                                        </div>
                                                        <?php if ($validation->hasError('lampu_dan_bell')) : ?>
                                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                                <?= $validation->getError('lampu_dan_bell'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                    <script>
                                                        function checklampu_dan_bell(b) {
                                                            var x = document.getElementsByClassName('checklampu_dan_bell');
                                                            var i;

                                                            for (i = 0; i < x.length; i++) {
                                                                if (x[i].value != b) x[i].checked = false;
                                                            }
                                                        }
                                                    </script>
                                                </tr>
                                                <tr>
                                                    <td class="col-3" style="padding-left: 8px;">Break Glass</td>
                                                    <td>
                                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                                            <input <?php if (old('break_glass') == "1") {
                                                                        echo ("checked");
                                                                    } ?> id="break_glass" name="break_glass" type="checkbox" class="checkbreak_glass <?= ($validation->hasError('break_glass')) ? 'is-invalid' : ''; ?>" onclick="checkbreak_glass(this.value);" value="1">
                                                            Baik<br>
                                                        </div>
                                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                                            <input <?php if (old('break_glass') == "0") {
                                                                        echo ("checked");
                                                                    } ?> id="break_glass" name="break_glass" type="checkbox" class="checkbreak_glass <?= ($validation->hasError('break_glass')) ? 'is-invalid' : ''; ?>" onclick="checkbreak_glass(this.value);" value="0">
                                                            Rusak
                                                        </div>
                                                        <?php if ($validation->hasError('break_glass')) : ?>
                                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                                <?= $validation->getError('break_glass'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                    <script>
                                                        function checkbreak_glass(b) {
                                                            var x = document.getElementsByClassName('checkbreak_glass');
                                                            var i;

                                                            for (i = 0; i < x.length; i++) {
                                                                if (x[i].value != b) x[i].checked = false;
                                                            }
                                                        }
                                                    </script>
                                                </tr>
                                                <tr style="border: 0;">
                                                    <td style="border: 0;"></td>
                                                    <td style="border: 0;"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-3 col-form-label">Jumlah Temuan</label>
                                        <div class="col">
                                            <input type="text" class="form-control <?= ($validation->hasError('jumlah_temuan')) ? 'is-invalid' : ''; ?>" id="jumlah_temuan" name="jumlah_temuan" placeholder="Jumlah Temuan" value="<?= old('jumlah_temuan'); ?>">
                                            <?php if ($validation->hasError('jumlah_temuan')) : ?>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('jumlah_temuan'); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-3 col-form-label">Penjelasan</label>
                                        <textarea name="penjelasan" id="penjelasan" class="form-control col <?= ($validation->hasError('penjelasan')) ? 'is-invalid' : ''; ?>" rows="6"><?= old('penjelasan'); ?></textarea>
                                        <?php if ($validation->hasError('penjelasan')) : ?>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('penjelasan'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-footer">
                                <div class="row align-items-center">
                                    <div class="col"></div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-outline-primary ms-auto">
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
                                            Reset
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
                        <h3 class="card-title">Fire Fighting</h3>
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
                                    <th>Time Stamp</th>
                                    <th>PIC</th>
                                    <th class="text-center">MCFA<br>
                                        Type
                                    </th>
                                    <th class="text-center">MCFA<br>
                                        Jumlah Zona
                                    </th>
                                    <th class="text-center">MCFA<br>
                                        Normal
                                    </th>
                                    <th class="text-center">MCFA<br>
                                        Alarm<br>
                                        Silenced
                                    </th>
                                    <th class="text-center">MCFA<br>
                                        Fire
                                    </th>
                                    <th class="text-center">MCFA<br>
                                        Trouble
                                    </th>
                                    <th class="text-center">Lantai 1<br>
                                        Smoke<br>
                                        Detector
                                    </th>
                                    <th class="text-center">Lantai 1<br>
                                        Heat<br>
                                        Detector
                                    </th>
                                    <th class="text-center">Lantai 1<br>
                                        Flow<br>
                                        Switch
                                    </th>
                                    <th class="text-center">Lantai 2<br>
                                        Smoke<br>
                                        Detector
                                    </th>
                                    <th class="text-center">Lantai 2<br>
                                        Heat<br>
                                        Detector
                                    </th>
                                    <th class="text-center">Lantai 2<br>
                                        Flow<br>
                                        Switch
                                    </th>
                                    <th class="text-center">Lantai 3<br>
                                        Smoke<br>
                                        Detector
                                    </th>
                                    <th class="text-center">Lantai 3<br>
                                        Heat<br>
                                        Detector
                                    </th>
                                    <th class="text-center">Lantai 3<br>
                                        Flow<br>
                                        Switch
                                    </th>
                                    <th class="text-center">Lantai 4<br>
                                        Smoke<br>
                                        Detector
                                    </th>
                                    <th class="text-center">Lantai 4<br>
                                        Heat<br>
                                        Detector
                                    </th>
                                    <th class="text-center">Lantai 4<br>
                                        Flow<br>
                                        Switch
                                    </th>
                                    <th class="text-center">Hydrant<br>
                                        Pillar
                                    </th>
                                    <th class="text-center">Siamese<br>
                                        Connection
                                    </th>
                                    <th class="text-center">Lampu<br>
                                        & Bell
                                    </th>
                                    <th class="text-center">Glass<br>
                                        Break
                                    </th>
                                    <th>Jumlah Temuan</th>
                                    <th>Penjelasan</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $i = 1 ?>
                                <?php foreach ($getDataTableFireFighting as $ts) : ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $ts['storeName']; ?></td>
                                        <td><?= dateView($ts['date']); ?></td>
                                        <td><?= $ts['initial']; ?></td>
                                        <td><?= $ts['type']; ?></td>
                                        <td><?= $ts['jumlah_zona']; ?></td>
                                        <td><?= yesNoIcon($ts['mcfa_normal']); ?></td>
                                        <td><?= yesNoIcon($ts['mcfa_alarm_silenced']); ?></td>
                                        <td><?= yesNoIcon($ts['mcfa_fire']); ?></td>
                                        <td><?= yesNoIcon($ts['mcfa_trouble']); ?></td>
                                        <td><?= equipmentStatus($ts['lt1_smoke_detector']); ?></td>
                                        <td><?= equipmentStatus($ts['lt1_heat_detector']); ?></td>
                                        <td><?= equipmentStatus($ts['lt1_flow_switch']); ?></td>
                                        <td><?= equipmentStatus($ts['lt2_smoke_detector']); ?></td>
                                        <td><?= equipmentStatus($ts['lt2_heat_detector']); ?></td>
                                        <td><?= equipmentStatus($ts['lt2_flow_switch']); ?></td>
                                        <td><?= equipmentStatus($ts['lt3_smoke_detector']); ?></td>
                                        <td><?= equipmentStatus($ts['lt3_heat_detector']); ?></td>
                                        <td><?= equipmentStatus($ts['lt3_flow_switch']); ?></td>
                                        <td><?= equipmentStatus($ts['lt4_smoke_detector']); ?></td>
                                        <td><?= equipmentStatus($ts['lt4_heat_detector']); ?></td>
                                        <td><?= equipmentStatus($ts['lt4_flow_switch']); ?></td>
                                        <td><?= equipmentStatus($ts['hydrant_pillar']); ?></td>
                                        <td><?= equipmentStatus($ts['siamese_connection']); ?></td>
                                        <td><?= equipmentStatus($ts['lampu_dan_bell']); ?></td>
                                        <td><?= equipmentStatus($ts['break_glass']); ?></td>
                                        <td><?= $ts['jumlah_temuan']; ?></td>
                                        <td><?= $ts['penjelasan']; ?></td>
                                        <td class="text-end">
                                            <div class="row g-2 align-items-center mb-n3">
                                                <div class="col-6 col-sm-4 col-md-2 col-xl-auto mb-3">
                                                    <!-- <a class="btn btn-outline-primary btn-icon view-icon" id="<?= $ts['id']; ?>" aria-label="ViewData" data-bs-toggle="modal" data-bs-target="#modal-viewStoreEquip">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <circle cx="10" cy="10" r="7"></circle>
                                                            <line x1="7" y1="10" x2="13" y2="10"></line>
                                                            <line x1="10" y1="7" x2="10" y2="13"></line>
                                                            <line x1="21" y1="21" x2="15" y2="15"></line>
                                                        </svg>
                                                    </a> -->
                                                    <a class="btn btn-outline-success btn-icon edit-icon" id="<?= $ts['id']; ?>" aria-label="EditData" data-bs-toggle="modal" data-bs-target="#modal-editData">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                                            <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                                            <path d="M16 5l3 3"></path>
                                                        </svg>
                                                    </a>
                                                    <a class="btn btn-outline-danger btn-icon delete-icon" id="<?= $ts['id']; ?>" aria-label="DeleteData">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <line x1="4" y1="7" x2="20" y2="7"></line>
                                                            <line x1="10" y1="11" x2="10" y2="17"></line>
                                                            <line x1="14" y1="11" x2="14" y2="17"></line>
                                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

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
                                if($s['idEquipment'] > $defaultChecklist['idEq']) {
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

<!-- Modal edit data -->
<div class="modal modal-blur fade modal-edit" id="modal-editData" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data Fire Fighting</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formEditData" action="<?= base_url('') ?>" method="post">
                    <input value="<?= old('idFormEdit') ?>" type="text" hidden readonly id="idFormEdit" name="idFormEdit">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-3 row">
                                <label class="form-label col-3 col-form-label">Location</label>
                                <div class="col">
                                    <div class="input-icon mb-2">
                                        <input id="location" name="location" class="form-control" value="<?= $location ?>" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3 row">
                                <label class="form-label col-3 col-form-label">Date</label>
                                <div class="col">
                                    <div class="input-icon mb-2">
                                        <input id="date" name="date" class="form-control" value="<?= date('d-m-Y'); ?>" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-3 row">
                                <label class="form-label col-3 col-form-label">Worker</label>
                                <div class="col">
                                    <div class="input-icon mb-2">
                                        <input id="worker" name="worker" class="form-control" value="<?= session()->get('initial') ?>" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="form-label col-3 col-form-label pt-0">Checklist</label>
                                <div class="col">
                                    <div class="form-floating">
                                        <select disabled id="equipment_checklist" name="equipment_checklist" class="form-select <?= ($validation->hasError('equipment_checklist')) ? 'is-invalid' : ''; ?>" required>
                                            <option <?= old('equipment_checklist') != null && old('equipment_checklist') == 'DAILY' ? 'selected' : ($defaultChecklist['checklist'] == 'DAILY' ? 'selected' : ''); ?> value="DAILY">DAILY</option>
                                            <option <?= old('equipment_checklist') != null && old('equipment_checklist') == 'WEEKLY' ? 'selected' : ($defaultChecklist['checklist'] == 'WEEKLY' ? 'selected' : ''); ?> value="WEEKLY">WEEKLY</option>
                                            <option <?= old('equipment_checklist') != null && old('equipment_checklist') == 'MONTHLY' ? 'selected' : ($defaultChecklist['checklist'] == 'MONTHLY' ? 'selected' : ''); ?> value="MONTHLY">MONTHLY</option>
                                        </select>
                                        <label for="floatingSelect">Select Checklist</label>
                                    </div>
                                    <?php if ($validation->hasError('equipment_checklist')) : ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('equipment_checklist'); ?>
                                        </div>
                                    <?php endif; ?>
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
                                </tr>
                                <tr>
                                    <td class="col-3" rowspan="3">MCFA</td>
                                    <td class="col" colspan="2" style="padding-left: 8px;">
                                        <div class="form-group mb-3 row">
                                            <label class="form-label col-3 col-form-label">Type</label>
                                            <div class="col">
                                                <input type="text" class="form-control <?= ($validation->hasError('type')) ? 'is-invalid' : ''; ?>" id="type" name="type" placeholder="Type" value="<?= old('type'); ?>">
                                                <?php if ($validation->hasError('type')) : ?>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('type'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col" colspan="2" style="padding-left: 8px;">
                                        <div class="form-group mb-3 row">
                                            <label class="form-label col-3 col-form-label">Jumlah Zona</label>
                                            <div class="col">
                                                <input type="text" class="form-control <?= ($validation->hasError('jumlah_zona')) ? 'is-invalid' : ''; ?>" id="jumlah_zona" name="jumlah_zona" placeholder="Jumlah Zona" value="<?= old('jumlah_zona'); ?>">
                                                <?php if ($validation->hasError('jumlah_zona')) : ?>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('jumlah_zona'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col" colspan="2" style="padding-left: 8px;">
                                        <div class="form-check">
                                            <input <?php if (old('mcfa_normal') == "1") {
                                                        echo ("checked");
                                                    } ?> value="1" id="mcfa_normal" name="mcfa_normal" class="form-check-input  <?= ($validation->hasError('mcfa_normal')) ? 'is-invalid' : ''; ?>" type="checkbox">
                                            <span class="form-check-label">Normal</span>
                                            <?php if ($validation->hasError('mcfa_normal')) : ?>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('mcfa_normal'); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-check">
                                            <input <?php if (old('mcfa_alarm_silenced') == "1") {
                                                        echo ("checked");
                                                    } ?> value="1" id="mcfa_alarm_silenced" name="mcfa_alarm_silenced" class="form-check-input  <?= ($validation->hasError('mcfa_alarm_silenced')) ? 'is-invalid' : ''; ?>" type="checkbox">
                                            <span class="form-check-label">Alarm Silenced</span>
                                            <?php if ($validation->hasError('mcfa_alarm_silenced')) : ?>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('mcfa_alarm_silenced'); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-check">
                                            <input <?php if (old('mcfa_fire') == "1") {
                                                        echo ("checked");
                                                    } ?> value="1" id="mcfa_fire" name="mcfa_fire" class="form-check-input  <?= ($validation->hasError('mcfa_fire')) ? 'is-invalid' : ''; ?>" type="checkbox">
                                            <span class="form-check-label">Fire</span>
                                            <?php if ($validation->hasError('mcfa_fire')) : ?>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('mcfa_fire'); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-check">
                                            <input <?php if (old('mcfa_trouble') == "1") {
                                                        echo ("checked");
                                                    } ?> value="1" id="mcfa_trouble" name="mcfa_trouble" class="form-check-input  <?= ($validation->hasError('mcfa_trouble')) ? 'is-invalid' : ''; ?>" type="checkbox">
                                            <span class="form-check-label">Trouble</span>
                                            <?php if ($validation->hasError('mcfa_trouble')) : ?>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('mcfa_trouble'); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr style="border: 0;">
                                    <td style="border: 0;"></td>
                                    <td style="border: 0;"></td>
                                    <td style="border: 0;"></td>
                                </tr>
                                <tr>
                                    <td class="col-3" rowspan="3">Lantai 1</td>
                                    <td class="col-4" style="padding-left: 8px;">Smoke Detector</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('lt1_smoke_detector') == "1") {
                                                        echo ("checked");
                                                    } ?> id="lt1_smoke_detector" name="lt1_smoke_detector" type="checkbox" class="checklt1_smoke_detectorEdit <?= ($validation->hasError('lt1_smoke_detector')) ? 'is-invalid' : ''; ?>" onclick="checklt1_smoke_detectorEdit(this.value);" value="1">
                                            Baik<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('lt1_smoke_detector') == "0") {
                                                        echo ("checked");
                                                    } ?> id="lt1_smoke_detector" name="lt1_smoke_detector" type="checkbox" class="checklt1_smoke_detectorEdit <?= ($validation->hasError('lt1_smoke_detector')) ? 'is-invalid' : ''; ?>" onclick="checklt1_smoke_detectorEdit(this.value);" value="0">
                                            Rusak
                                        </div>
                                        <?php if ($validation->hasError('lt1_smoke_detector')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('lt1_smoke_detector'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checklt1_smoke_detectorEdit(b) {
                                            var x = document.getElementsByClassName('checklt1_smoke_detectorEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Heat Detector</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('lt1_heat_detector') == "1") {
                                                        echo ("checked");
                                                    } ?> id="lt1_heat_detector" name="lt1_heat_detector" type="checkbox" class="checklt1_heat_detectorEdit <?= ($validation->hasError('lt1_heat_detector')) ? 'is-invalid' : ''; ?>" onclick="checklt1_heat_detectorEdit(this.value);" value="1">
                                            Baik<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('lt1_heat_detector') == "0") {
                                                        echo ("checked");
                                                    } ?> id="lt1_heat_detector" name="lt1_heat_detector" type="checkbox" class="checklt1_heat_detectorEdit <?= ($validation->hasError('lt1_heat_detector')) ? 'is-invalid' : ''; ?>" onclick="checklt1_heat_detectorEdit(this.value);" value="0">
                                            Rusak
                                        </div>
                                        <?php if ($validation->hasError('lt1_heat_detector')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('lt1_heat_detector'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checklt1_heat_detectorEdit(b) {
                                            var x = document.getElementsByClassName('checklt1_heat_detectorEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Flow Switch</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('lt1_flow_switch') == "1") {
                                                        echo ("checked");
                                                    } ?> id="lt1_flow_switch" name="lt1_flow_switch" type="checkbox" class="checklt1_flow_switchEdit <?= ($validation->hasError('lt1_flow_switch')) ? 'is-invalid' : ''; ?>" onclick="checklt1_flow_switchEdit(this.value);" value="1">
                                            Baik<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('lt1_flow_switch') == "0") {
                                                        echo ("checked");
                                                    } ?> id="lt1_flow_switch" name="lt1_flow_switch" type="checkbox" class="checklt1_flow_switchEdit <?= ($validation->hasError('lt1_flow_switch')) ? 'is-invalid' : ''; ?>" onclick="checklt1_flow_switchEdit(this.value);" value="0">
                                            Rusak
                                        </div>
                                        <?php if ($validation->hasError('lt1_flow_switch')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('lt1_flow_switch'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checklt1_flow_switchEdit(b) {
                                            var x = document.getElementsByClassName('checklt1_flow_switchEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
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
                                    <td class="col-3" rowspan="3">Lantai 2</td>
                                    <td class="col-4" style="padding-left: 8px;">Smoke Detector</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('lt2_smoke_detector') == "1") {
                                                        echo ("checked");
                                                    } ?> id="lt2_smoke_detector" name="lt2_smoke_detector" type="checkbox" class="checklt2_smoke_detectorEdit <?= ($validation->hasError('lt2_smoke_detector')) ? 'is-invalid' : ''; ?>" onclick="checklt2_smoke_detectorEdit(this.value);" value="1">
                                            Baik<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('lt2_smoke_detector') == "0") {
                                                        echo ("checked");
                                                    } ?> id="lt2_smoke_detector" name="lt2_smoke_detector" type="checkbox" class="checklt2_smoke_detectorEdit <?= ($validation->hasError('lt2_smoke_detector')) ? 'is-invalid' : ''; ?>" onclick="checklt2_smoke_detectorEdit(this.value);" value="0">
                                            Rusak
                                        </div>
                                        <?php if ($validation->hasError('lt2_smoke_detector')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('lt2_smoke_detector'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checklt2_smoke_detectorEdit(b) {
                                            var x = document.getElementsByClassName('checklt2_smoke_detectorEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Heat Detector</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('lt2_heat_detector') == "1") {
                                                        echo ("checked");
                                                    } ?> id="lt2_heat_detector" name="lt2_heat_detector" type="checkbox" class="checklt2_heat_detectorEdit <?= ($validation->hasError('lt2_heat_detector')) ? 'is-invalid' : ''; ?>" onclick="checklt2_heat_detectorEdit(this.value);" value="1">
                                            Baik<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('lt2_heat_detector') == "0") {
                                                        echo ("checked");
                                                    } ?> id="lt2_heat_detector" name="lt2_heat_detector" type="checkbox" class="checklt2_heat_detectorEdit <?= ($validation->hasError('lt2_heat_detector')) ? 'is-invalid' : ''; ?>" onclick="checklt2_heat_detectorEdit(this.value);" value="0">
                                            Rusak
                                        </div>
                                        <?php if ($validation->hasError('lt2_heat_detector')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('lt2_heat_detector'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checklt2_heat_detectorEdit(b) {
                                            var x = document.getElementsByClassName('checklt2_heat_detectorEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Flow Switch</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('lt2_flow_switch') == "1") {
                                                        echo ("checked");
                                                    } ?> id="lt2_flow_switch" name="lt2_flow_switch" type="checkbox" class="checklt2_flow_switchEdit <?= ($validation->hasError('lt2_flow_switch')) ? 'is-invalid' : ''; ?>" onclick="checklt2_flow_switchEdit(this.value);" value="1">
                                            Baik<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('lt2_flow_switch') == "0") {
                                                        echo ("checked");
                                                    } ?> id="lt2_flow_switch" name="lt2_flow_switch" type="checkbox" class="checklt2_flow_switchEdit <?= ($validation->hasError('lt2_flow_switch')) ? 'is-invalid' : ''; ?>" onclick="checklt2_flow_switchEdit(this.value);" value="0">
                                            Rusak
                                        </div>
                                        <?php if ($validation->hasError('lt2_flow_switch')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('lt2_flow_switch'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checklt2_flow_switchEdit(b) {
                                            var x = document.getElementsByClassName('checklt2_flow_switchEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
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
                                    <td class="col-3" rowspan="3">Lantai 3</td>
                                    <td class="col-4" style="padding-left: 8px;">Smoke Detector</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('lt3_smoke_detector') == "1") {
                                                        echo ("checked");
                                                    } ?> id="lt3_smoke_detector" name="lt3_smoke_detector" type="checkbox" class="checklt3_smoke_detectorEdit <?= ($validation->hasError('lt3_smoke_detector')) ? 'is-invalid' : ''; ?>" onclick="checklt3_smoke_detectorEdit(this.value);" value="1">
                                            Baik<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('lt3_smoke_detector') == "0") {
                                                        echo ("checked");
                                                    } ?> id="lt3_smoke_detector" name="lt3_smoke_detector" type="checkbox" class="checklt3_smoke_detectorEdit <?= ($validation->hasError('lt3_smoke_detector')) ? 'is-invalid' : ''; ?>" onclick="checklt3_smoke_detectorEdit(this.value);" value="0">
                                            Rusak
                                        </div>
                                        <?php if ($validation->hasError('lt3_smoke_detector')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('lt3_smoke_detector'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checklt3_smoke_detectorEdit(b) {
                                            var x = document.getElementsByClassName('checklt3_smoke_detectorEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Heat Detector</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('lt3_heat_detector') == "1") {
                                                        echo ("checked");
                                                    } ?> id="lt3_heat_detector" name="lt3_heat_detector" type="checkbox" class="checklt3_heat_detectorEdit <?= ($validation->hasError('lt3_heat_detector')) ? 'is-invalid' : ''; ?>" onclick="checklt3_heat_detectorEdit(this.value);" value="1">
                                            Baik<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('lt3_heat_detector') == "0") {
                                                        echo ("checked");
                                                    } ?> id="lt3_heat_detector" name="lt3_heat_detector" type="checkbox" class="checklt3_heat_detectorEdit <?= ($validation->hasError('lt3_heat_detector')) ? 'is-invalid' : ''; ?>" onclick="checklt3_heat_detectorEdit(this.value);" value="0">
                                            Rusak
                                        </div>
                                        <?php if ($validation->hasError('lt3_heat_detector')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('lt3_heat_detector'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checklt3_heat_detectorEdit(b) {
                                            var x = document.getElementsByClassName('checklt3_heat_detectorEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Flow Switch</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('lt3_flow_switch') == "1") {
                                                        echo ("checked");
                                                    } ?> id="lt3_flow_switch" name="lt3_flow_switch" type="checkbox" class="checklt3_flow_switchEdit <?= ($validation->hasError('lt3_flow_switch')) ? 'is-invalid' : ''; ?>" onclick="checklt3_flow_switchEdit(this.value);" value="1">
                                            Baik<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('lt3_flow_switch') == "0") {
                                                        echo ("checked");
                                                    } ?> id="lt3_flow_switch" name="lt3_flow_switch" type="checkbox" class="checklt3_flow_switchEdit <?= ($validation->hasError('lt3_flow_switch')) ? 'is-invalid' : ''; ?>" onclick="checklt3_flow_switchEdit(this.value);" value="0">
                                            Rusak
                                        </div>
                                        <?php if ($validation->hasError('lt3_flow_switch')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('lt3_flow_switch'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checklt3_flow_switchEdit(b) {
                                            var x = document.getElementsByClassName('checklt3_flow_switchEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
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
                                    <td class="col-3" rowspan="3">Lantai 4</td>
                                    <td class="col-4" style="padding-left: 8px;">Smoke Detector</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('lt4_smoke_detector') == "1") {
                                                        echo ("checked");
                                                    } ?> id="lt4_smoke_detector" name="lt4_smoke_detector" type="checkbox" class="checklt4_smoke_detectorEdit <?= ($validation->hasError('lt4_smoke_detector')) ? 'is-invalid' : ''; ?>" onclick="checklt4_smoke_detectorEdit(this.value);" value="1">
                                            Baik<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('lt4_smoke_detector') == "0") {
                                                        echo ("checked");
                                                    } ?> id="lt4_smoke_detector" name="lt4_smoke_detector" type="checkbox" class="checklt4_smoke_detectorEdit <?= ($validation->hasError('lt4_smoke_detector')) ? 'is-invalid' : ''; ?>" onclick="checklt4_smoke_detectorEdit(this.value);" value="0">
                                            Rusak
                                        </div>
                                        <?php if ($validation->hasError('lt4_smoke_detector')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('lt4_smoke_detector'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checklt4_smoke_detectorEdit(b) {
                                            var x = document.getElementsByClassName('checklt4_smoke_detectorEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Heat Detector</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('lt4_heat_detector') == "1") {
                                                        echo ("checked");
                                                    } ?> id="lt4_heat_detector" name="lt4_heat_detector" type="checkbox" class="checklt4_heat_detectorEdit <?= ($validation->hasError('lt4_heat_detector')) ? 'is-invalid' : ''; ?>" onclick="checklt4_heat_detectorEdit(this.value);" value="1">
                                            Baik<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('lt4_heat_detector') == "0") {
                                                        echo ("checked");
                                                    } ?> id="lt4_heat_detector" name="lt4_heat_detector" type="checkbox" class="checklt4_heat_detectorEdit <?= ($validation->hasError('lt4_heat_detector')) ? 'is-invalid' : ''; ?>" onclick="checklt4_heat_detectorEdit(this.value);" value="0">
                                            Rusak
                                        </div>
                                        <?php if ($validation->hasError('lt4_heat_detector')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('lt4_heat_detector'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checklt4_heat_detectorEdit(b) {
                                            var x = document.getElementsByClassName('checklt4_heat_detectorEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Flow Switch</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('lt4_flow_switch') == "1") {
                                                        echo ("checked");
                                                    } ?> id="lt4_flow_switch" name="lt4_flow_switch" type="checkbox" class="checklt4_flow_switchEdit <?= ($validation->hasError('lt4_flow_switch')) ? 'is-invalid' : ''; ?>" onclick="checklt4_flow_switchEdit(this.value);" value="1">
                                            Baik<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('lt4_flow_switch') == "0") {
                                                        echo ("checked");
                                                    } ?> id="lt4_flow_switch" name="lt4_flow_switch" type="checkbox" class="checklt4_flow_switchEdit <?= ($validation->hasError('lt4_flow_switch')) ? 'is-invalid' : ''; ?>" onclick="checklt4_flow_switchEdit(this.value);" value="0">
                                            Rusak
                                        </div>
                                        <?php if ($validation->hasError('lt4_flow_switch')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('lt4_flow_switch'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checklt4_flow_switchEdit(b) {
                                            var x = document.getElementsByClassName('checklt4_flow_switchEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
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

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="table-responsive">
                                <table class="table table-bordered card-table table-vcenter text-nowrap datatable" style="width:100%">
                                    <tbody>
                                        <tr style="border: 0;">
                                            <td style="border: 0;"></td>
                                            <td style="border: 0;"></td>
                                        </tr>
                                        <tr>
                                            <td class="col-3" style="padding-left: 8px;">Hydrant Pillar</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('hydrant_pillar') == "1") {
                                                                echo ("checked");
                                                            } ?> id="hydrant_pillar" name="hydrant_pillar" type="checkbox" class="checkhydrant_pillarEdit <?= ($validation->hasError('hydrant_pillar')) ? 'is-invalid' : ''; ?>" onclick="checkhydrant_pillarEdit(this.value);" value="1">
                                                    Baik<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('hydrant_pillar') == "0") {
                                                                echo ("checked");
                                                            } ?> id="hydrant_pillar" name="hydrant_pillar" type="checkbox" class="checkhydrant_pillarEdit <?= ($validation->hasError('hydrant_pillar')) ? 'is-invalid' : ''; ?>" onclick="checkhydrant_pillarEdit(this.value);" value="0">
                                                    Rusak
                                                </div>
                                                <?php if ($validation->hasError('hydrant_pillar')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('hydrant_pillar'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkhydrant_pillarEdit(b) {
                                                    var x = document.getElementsByClassName('checkhydrant_pillarEdit');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-3" style="padding-left: 8px;">Siamese Connection</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('siamese_connection') == "1") {
                                                                echo ("checked");
                                                            } ?> id="siamese_connection" name="siamese_connection" type="checkbox" class="checksiamese_connectionEdit <?= ($validation->hasError('siamese_connection')) ? 'is-invalid' : ''; ?>" onclick="checksiamese_connectionEdit(this.value);" value="1">
                                                    Baik<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('siamese_connection') == "0") {
                                                                echo ("checked");
                                                            } ?> id="siamese_connection" name="siamese_connection" type="checkbox" class="checksiamese_connectionEdit <?= ($validation->hasError('siamese_connection')) ? 'is-invalid' : ''; ?>" onclick="checksiamese_connectionEdit(this.value);" value="0">
                                                    Rusak
                                                </div>
                                                <?php if ($validation->hasError('siamese_connection')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('siamese_connection'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checksiamese_connectionEdit(b) {
                                                    var x = document.getElementsByClassName('checksiamese_connectionEdit');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr style="border: 0;">
                                            <td style="border: 0;"></td>
                                            <td style="border: 0;"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="table-responsive">
                                <table class="table table-bordered card-table table-vcenter text-nowrap datatable" style="width:100%">
                                    <tbody>
                                        <tr style="border: 0;">
                                            <td style="border: 0;"></td>
                                            <td style="border: 0;"></td>
                                        </tr>
                                        <tr>
                                            <td class="col-3" style="padding-left: 8px;">Lampu & Bell</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('lampu_dan_bell') == "1") {
                                                                echo ("checked");
                                                            } ?> id="lampu_dan_bell" name="lampu_dan_bell" type="checkbox" class="checklampu_dan_bellEdit <?= ($validation->hasError('lampu_dan_bell')) ? 'is-invalid' : ''; ?>" onclick="checklampu_dan_bellEdit(this.value);" value="1">
                                                    Baik<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('lampu_dan_bell') == "0") {
                                                                echo ("checked");
                                                            } ?> id="lampu_dan_bell" name="lampu_dan_bell" type="checkbox" class="checklampu_dan_bellEdit <?= ($validation->hasError('lampu_dan_bell')) ? 'is-invalid' : ''; ?>" onclick="checklampu_dan_bellEdit(this.value);" value="0">
                                                    Rusak
                                                </div>
                                                <?php if ($validation->hasError('lampu_dan_bell')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('lampu_dan_bell'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checklampu_dan_bellEdit(b) {
                                                    var x = document.getElementsByClassName('checklampu_dan_bellEdit');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-3" style="padding-left: 8px;">Break Glass</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('break_glass') == "1") {
                                                                echo ("checked");
                                                            } ?> id="break_glass" name="break_glass" type="checkbox" class="checkbreak_glassEdit <?= ($validation->hasError('break_glass')) ? 'is-invalid' : ''; ?>" onclick="checkbreak_glassEdit(this.value);" value="1">
                                                    Baik<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('break_glass') == "0") {
                                                                echo ("checked");
                                                            } ?> id="break_glass" name="break_glass" type="checkbox" class="checkbreak_glassEdit <?= ($validation->hasError('break_glass')) ? 'is-invalid' : ''; ?>" onclick="checkbreak_glassEdit(this.value);" value="0">
                                                    Rusak
                                                </div>
                                                <?php if ($validation->hasError('break_glass')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('break_glass'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkbreak_glassEdit(b) {
                                                    var x = document.getElementsByClassName('checkbreak_glassEdit');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr style="border: 0;">
                                            <td style="border: 0;"></td>
                                            <td style="border: 0;"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-3 row">
                                <label class="form-label col-3 col-form-label">Jumlah Temuan</label>
                                <div class="col">
                                    <input type="text" class="form-control <?= ($validation->hasError('jumlah_temuan')) ? 'is-invalid' : ''; ?>" id="jumlah_temuan" name="jumlah_temuan" placeholder="Jumlah Temuan" value="<?= old('jumlah_temuan'); ?>">
                                    <?php if ($validation->hasError('jumlah_temuan')) : ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('jumlah_temuan'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3 row">
                                <label class="form-label col-3 col-form-label">Penjelasan</label>
                                <textarea name="penjelasan" id="penjelasan" class="form-control col <?= ($validation->hasError('penjelasan')) ? 'is-invalid' : ''; ?>" rows="6"><?= old('penjelasan'); ?></textarea>
                                <?php if ($validation->hasError('penjelasan')) : ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('penjelasan'); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
            </div>

            <div class="modal-footer">
                <div class="row align-items-center">
                    <div class="col"></div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-outline-primary ms-auto" id="btnUpdateshift" name="btnUpdateshift" data-bs-dismiss="modal">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-refresh" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4"></path>
                                <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4"></path>
                            </svg>
                            Update
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
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section("scripts"); ?>

<script>
    var site_url = `<?= base_url() ?>`;
    $(document).ready(function() {

        let urlUpdate = site_url + '/firefighting/updateFireFighting/';
        let urlDelete = site_url + '/firefighting/deleteFireFighting/';
        let urlAjaxData = site_url + '/firefighting/ajaxDataFireFighting/';
        let validateChecklist = `<?= $defaultChecklist['checklist'] ?>`;
        let dataChecklist = `<?= isset($checkInspection['data']) ? json_encode($checkInspection['data']) : '' ?>`;

        if (($("#formInputData .jamCheck").not(":disabled").length == 0 && validateChecklist != "MONTHLY") || (validateChecklist == "MONTHLY" && dataChecklist != '')) {
            $("#formInputData").find("input,button,select,textarea").prop('disabled', true);
            Swal.fire(
                'Warning!',
                'Data for the <?= strtolower($defaultChecklist['checklist']) ?> inspection already exists or the timestamp has passed! Input form will be disabled',
                'warning'
            )
        }

        $('#formInputData').on('submit', function() {
            $('#equipment_checklist').prop('disabled', false);
        });

        oldData = <?= json_encode(session()->get('_ci_old_input')) ?>;
        if (oldData != null && oldData.post.idFormEdit != null) {
            $("#modal-editData").modal('show');
            $("#formEditData").attr('action', urlUpdate + oldData.post.idFormEdit);

            $("#formInputData").find("input:text, textarea").not("#location,#date,#worker").val("");
            $("#formInputData").find("input:checkbox").prop('checked', false);
            $("#formInputData").find(".is-invalid").removeClass("is-invalid");
            $("#formInputData").find(".invalid-feedback,.hasil-validasi").hide();
        }

        //? modal edit
        $(".edit-icon").click(function() {
            var modalView = $("#modal-editData");
            modalView.find("input:text").val("");
            modalView.find("input:checkbox").prop('checked', false);
            $("#formEditData").attr('action', urlUpdate + this.id);
            modalView.find(".is-invalid").removeClass("is-invalid");
            modalView.find(".invalid-feedback,.hasil-validasi").hide();

            inputData = new FormData();
            inputData.append("id", this.id);

            $.ajax({
                url: urlAjaxData,
                type: "POST",
                data: inputData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                // dataType: "JSON",
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.data != null) {
                        modalView.find("#idFormEdit").val(data.data.id);
                        modalView.find("#date").val(data.data.date);
                        modalView.find("#worker").val(data.data.initial);
                        modalView.find("#location").val(data.data.storeName);
                        modalView.find("#equipment_checklist option[value=" + data.data.equipment_checklist + "]").prop('selected', true);
                        modalView.find("#mcfa_normal[value=" + data.data.mcfa_normal + "]").prop('checked', true);
                        modalView.find("#mcfa_alarm_silenced[value=" + data.data.mcfa_alarm_silenced + "]").prop('checked', true);
                        modalView.find("#mcfa_fire[value=" + data.data.mcfa_fire + "]").prop('checked', true);
                        modalView.find("#mcfa_trouble[value=" + data.data.mcfa_trouble + "]").prop('checked', true);
                        modalView.find("#lt1_smoke_detector[value=" + data.data.lt1_smoke_detector + "]").prop('checked', true);
                        modalView.find("#lt1_heat_detector[value=" + data.data.lt1_heat_detector + "]").prop('checked', true);
                        modalView.find("#lt1_flow_switch[value=" + data.data.lt1_flow_switch + "]").prop('checked', true);
                        modalView.find("#lt2_smoke_detector[value=" + data.data.lt2_smoke_detector + "]").prop('checked', true);
                        modalView.find("#lt2_heat_detector[value=" + data.data.lt2_heat_detector + "]").prop('checked', true);
                        modalView.find("#lt2_flow_switch[value=" + data.data.lt2_flow_switch + "]").prop('checked', true);
                        modalView.find("#lt3_smoke_detector[value=" + data.data.lt3_smoke_detector + "]").prop('checked', true);
                        modalView.find("#lt3_heat_detector[value=" + data.data.lt3_heat_detector + "]").prop('checked', true);
                        modalView.find("#lt3_flow_switch[value=" + data.data.lt3_flow_switch + "]").prop('checked', true);
                        modalView.find("#lt4_smoke_detector[value=" + data.data.lt4_smoke_detector + "]").prop('checked', true);
                        modalView.find("#lt4_heat_detector[value=" + data.data.lt4_heat_detector + "]").prop('checked', true);
                        modalView.find("#lt4_flow_switch[value=" + data.data.lt4_flow_switch + "]").prop('checked', true);
                        modalView.find("#hydrant_pillar[value=" + data.data.hydrant_pillar + "]").prop('checked', true);
                        modalView.find("#siamese_connection[value=" + data.data.siamese_connection + "]").prop('checked', true);
                        modalView.find("#lampu_dan_bell[value=" + data.data.lampu_dan_bell + "]").prop('checked', true);
                        modalView.find("#break_glass[value=" + data.data.break_glass + "]").prop('checked', true);
                        modalView.find("#break_glass[value=" + data.data.break_glass + "]").prop('checked', true);
                        modalView.find("#type").val(data.data.type);
                        modalView.find("#jumlah_zona").val(data.data.jumlah_zona);
                        modalView.find("#jumlah_temuan").val(data.data.jumlah_temuan);
                        modalView.find("#penjelasan").val(data.data.penjelasan);
                    } else {
                        Swal.fire(
                            'Error',
                            'Data Not Found!',
                            'error'
                        )
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    Swal.fire(
                        'Error',
                        'Something Went Wrong!',
                        'error'
                    )
                }
            });
        });

        $('.delete-icon').click(function() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Submit',
            }).then((result) => {
                if (result.isConfirmed) {
                    var deleteData = new FormData()

                    deleteData.append('id', this.id);
                    $.ajax({
                        url: urlDelete,
                        type: "POST",
                        data: deleteData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        // dataType: "JSON",
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            window.scrollTo(0, 0);
                            location.reload();
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            Swal.fire(
                                'Error',
                                'Something Went Wrong!',
                                'error'
                            )
                        }
                    });
                }
            })
        });
    });
</script>

<?= $this->endSection(); ?>