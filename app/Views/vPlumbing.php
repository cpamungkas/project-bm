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
                        <h3 class="card-title">Plumbing</h3>
                    </div>

                    <div class="card-body">
                        <form id="formInputData" action="<?php echo base_url('plumbing/savePlumbing'); ?>" method="post">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-3 col-form-label">Location</label>
                                        <div class="col">
                                            <div class="input-icon mb-2">
                                                <input class="form-control" value="<?= $location ?>" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-3 col-form-label">Jam Pengecekan</label>
                                        <div class="col">
                                            <!-- TODO hanya bisa pilih 1x per hari -->
                                            <!-- TODO kalo check inspection monthly ilangin time ny -->
                                            <div class="form-check">
                                                <input <?= timeCheck("08:00:00", $checkInspection)?> <?php if (old('time') == "08:00:00") {
                                                            echo ("checked");
                                                        } ?> value="08:00:00" id="time" name="time" class="jamCheck form-check-input  <?= ($validation->hasError('time')) ? 'is-invalid' : ''; ?>" type="checkbox">
                                                <span class="form-check-label">08:00</span>
                                            </div>
                                            <?php if ($validation->hasError('time')) : ?>
                                                <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                    <?= $validation->getError('time'); ?>
                                                </div>
                                            <?php endif; ?>
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
                                                <input class="form-control" value="<?= session()->get('initial') ?>" disabled>
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
                                            <td class="col-3" rowspan="2">Instalasi Air Bersih</td>
                                            <td class="col-4" style="padding-left: 8px;">P. Transfer 1</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('instalasi_air_bersih_p_transfer1') == "1") {
                                                                echo ("checked");
                                                            } ?> id="instalasi_air_bersih_p_transfer1" name="instalasi_air_bersih_p_transfer1" type="checkbox" class="checkinstalasi_air_bersih_p_transfer1 <?= ($validation->hasError('instalasi_air_bersih_p_transfer1')) ? 'is-invalid' : ''; ?>" onclick="checkinstalasi_air_bersih_p_transfer1(this.value);" value="1">
                                                    Auto<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('instalasi_air_bersih_p_transfer1') == "0") {
                                                                echo ("checked");
                                                            } ?> id="instalasi_air_bersih_p_transfer1" name="instalasi_air_bersih_p_transfer1" type="checkbox" class="checkinstalasi_air_bersih_p_transfer1 <?= ($validation->hasError('instalasi_air_bersih_p_transfer1')) ? 'is-invalid' : ''; ?>" onclick="checkinstalasi_air_bersih_p_transfer1(this.value);" value="0">
                                                    Manual
                                                </div>
                                                <?php if ($validation->hasError('instalasi_air_bersih_p_transfer1')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('instalasi_air_bersih_p_transfer1'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkinstalasi_air_bersih_p_transfer1(b) {
                                                    var x = document.getElementsByClassName('checkinstalasi_air_bersih_p_transfer1');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">P. Transfer 2</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('instalasi_air_bersih_p_transfer2') == "1") {
                                                                echo ("checked");
                                                            } ?> id="instalasi_air_bersih_p_transfer2" name="instalasi_air_bersih_p_transfer2" type="checkbox" class="checkinstalasi_air_bersih_p_transfer2 <?= ($validation->hasError('instalasi_air_bersih_p_transfer2')) ? 'is-invalid' : ''; ?>" onclick="checkinstalasi_air_bersih_p_transfer2(this.value);" value="1">
                                                    Auto<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('instalasi_air_bersih_p_transfer2') == "0") {
                                                                echo ("checked");
                                                            } ?> id="instalasi_air_bersih_p_transfer2" name="instalasi_air_bersih_p_transfer2" type="checkbox" class="checkinstalasi_air_bersih_p_transfer2 <?= ($validation->hasError('instalasi_air_bersih_p_transfer2')) ? 'is-invalid' : ''; ?>" onclick="checkinstalasi_air_bersih_p_transfer2(this.value);" value="0">
                                                    Manual
                                                </div>
                                                <?php if ($validation->hasError('instalasi_air_bersih_p_transfer2')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('instalasi_air_bersih_p_transfer2'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkinstalasi_air_bersih_p_transfer2(b) {
                                                    var x = document.getElementsByClassName('checkinstalasi_air_bersih_p_transfer2');
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
                                            <td class="col-3" rowspan="2">Fire Pump</td>
                                            <td class="col-4" style="padding-left: 8px;">Jockey Pump</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('fire_pump_jockey_pump') == "1") {
                                                                echo ("checked");
                                                            } ?> id="fire_pump_jockey_pump" name="fire_pump_jockey_pump" type="checkbox" class="checkfire_pump_jockey_pump <?= ($validation->hasError('fire_pump_jockey_pump')) ? 'is-invalid' : ''; ?>" onclick="checkfire_pump_jockey_pump(this.value);" value="1">
                                                    Auto<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('fire_pump_jockey_pump') == "0") {
                                                                echo ("checked");
                                                            } ?> id="fire_pump_jockey_pump" name="fire_pump_jockey_pump" type="checkbox" class="checkfire_pump_jockey_pump <?= ($validation->hasError('fire_pump_jockey_pump')) ? 'is-invalid' : ''; ?>" onclick="checkfire_pump_jockey_pump(this.value);" value="0">
                                                    Manual
                                                </div>
                                                <?php if ($validation->hasError('fire_pump_jockey_pump')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('fire_pump_jockey_pump'); ?>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="form-group mb-3 row">
                                                    <label class="form-label col-3 col-form-label">Pressure</label>
                                                    <div class="col">
                                                        <input type="text" class="form-control <?= ($validation->hasError('fire_pump_jockey_pressure')) ? 'is-invalid' : ''; ?>" id="fire_pump_jockey_pressure" name="fire_pump_jockey_pressure" placeholder="Pressure" value="<?= old('fire_pump_jockey_pressure'); ?>">
                                                        <?php if ($validation->hasError('fire_pump_jockey_pressure')) : ?>
                                                            <div class="invalid-feedback">
                                                                <?= $validation->getError('fire_pump_jockey_pressure'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </td>
                                            <script>
                                                function checkfire_pump_jockey_pump(b) {
                                                    var x = document.getElementsByClassName('checkfire_pump_jockey_pump');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>

                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Hydrant Pump</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('fire_pump_hydrant_pump') == "1") {
                                                                echo ("checked");
                                                            } ?> id="fire_pump_hydrant_pump" name="fire_pump_hydrant_pump" type="checkbox" class="checkfire_pump_hydrant_pump <?= ($validation->hasError('fire_pump_hydrant_pump')) ? 'is-invalid' : ''; ?>" onclick="checkfire_pump_hydrant_pump(this.value);" value="1">
                                                    Auto<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('fire_pump_hydrant_pump') == "0") {
                                                                echo ("checked");
                                                            } ?> id="fire_pump_hydrant_pump" name="fire_pump_hydrant_pump" type="checkbox" class="checkfire_pump_hydrant_pump <?= ($validation->hasError('fire_pump_hydrant_pump')) ? 'is-invalid' : ''; ?>" onclick="checkfire_pump_hydrant_pump(this.value);" value="0">
                                                    Manual
                                                </div>
                                                <?php if ($validation->hasError('fire_pump_hydrant_pump')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('fire_pump_hydrant_pump'); ?>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="form-group mb-3 row">
                                                    <label class="form-label col-3 col-form-label">Pressure</label>
                                                    <div class="col">
                                                        <input type="text" class="form-control <?= ($validation->hasError('fire_pump_hydrant_pressure')) ? 'is-invalid' : ''; ?>" id="fire_pump_hydrant_pressure" name="fire_pump_hydrant_pressure" placeholder="Pressure" value="<?= old('fire_pump_hydrant_pressure'); ?>">
                                                        <?php if ($validation->hasError('fire_pump_hydrant_pressure')) : ?>
                                                            <div class="invalid-feedback">
                                                                <?= $validation->getError('fire_pump_hydrant_pressure'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </td>
                                            <script>
                                                function checkfire_pump_hydrant_pump(b) {
                                                    var x = document.getElementsByClassName('checkfire_pump_hydrant_pump');
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
                                            <td class="col-3" rowspan="2">GWT</td>
                                            <td class="col-4" style="padding-left: 8px;">Level Air</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('gwt_level_air') == "1") {
                                                                echo ("checked");
                                                            } ?> id="gwt_level_air" name="gwt_level_air" type="checkbox" class="checkgwt_level_air <?= ($validation->hasError('gwt_level_air')) ? 'is-invalid' : ''; ?>" onclick="checkgwt_level_air(this.value);" value="1">
                                                    Full<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('gwt_level_air') == "0") {
                                                                echo ("checked");
                                                            } ?> id="gwt_level_air" name="gwt_level_air" type="checkbox" class="checkgwt_level_air <?= ($validation->hasError('gwt_level_air')) ? 'is-invalid' : ''; ?>" onclick="checkgwt_level_air(this.value);" value="0">
                                                    Kurang
                                                </div>
                                                <?php if ($validation->hasError('gwt_level_air')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('gwt_level_air'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkgwt_level_air(b) {
                                                    var x = document.getElementsByClassName('checkgwt_level_air');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Elektrode</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('gwt_elektrode') == "1") {
                                                                echo ("checked");
                                                            } ?> id="gwt_elektrode" name="gwt_elektrode" type="checkbox" class="checkgwt_elektrode <?= ($validation->hasError('gwt_elektrode')) ? 'is-invalid' : ''; ?>" onclick="checkgwt_elektrode(this.value);" value="1">
                                                    Baik<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('gwt_elektrode') == "0") {
                                                                echo ("checked");
                                                            } ?> id="gwt_elektrode" name="gwt_elektrode" type="checkbox" class="checkgwt_elektrode <?= ($validation->hasError('gwt_elektrode')) ? 'is-invalid' : ''; ?>" onclick="checkgwt_elektrode(this.value);" value="0">
                                                    Rusak
                                                </div>
                                                <?php if ($validation->hasError('gwt_elektrode')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('gwt_elektrode'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkgwt_elektrode(b) {
                                                    var x = document.getElementsByClassName('checkgwt_elektrode');
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
                                            <td class="col-3" rowspan="2">Roof Tank</td>
                                            <td class="col-4" style="padding-left: 8px;">Level Air</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('roof_tank_level_air') == "1") {
                                                                echo ("checked");
                                                            } ?> id="roof_tank_level_air" name="roof_tank_level_air" type="checkbox" class="checkroof_tank_level_air <?= ($validation->hasError('roof_tank_level_air')) ? 'is-invalid' : ''; ?>" onclick="checkroof_tank_level_air(this.value);" value="1">
                                                    Full<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('roof_tank_level_air') == "0") {
                                                                echo ("checked");
                                                            } ?> id="roof_tank_level_air" name="roof_tank_level_air" type="checkbox" class="checkroof_tank_level_air <?= ($validation->hasError('roof_tank_level_air')) ? 'is-invalid' : ''; ?>" onclick="checkroof_tank_level_air(this.value);" value="0">
                                                    Kurang
                                                </div>
                                                <?php if ($validation->hasError('roof_tank_level_air')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('roof_tank_level_air'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkroof_tank_level_air(b) {
                                                    var x = document.getElementsByClassName('checkroof_tank_level_air');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Elektrode</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('roof_tank_elektrode') == "1") {
                                                                echo ("checked");
                                                            } ?> id="roof_tank_elektrode" name="roof_tank_elektrode" type="checkbox" class="checkroof_tank_elektrode <?= ($validation->hasError('roof_tank_elektrode')) ? 'is-invalid' : ''; ?>" onclick="checkroof_tank_elektrode(this.value);" value="1">
                                                    Baik<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('roof_tank_elektrode') == "0") {
                                                                echo ("checked");
                                                            } ?> id="roof_tank_elektrode" name="roof_tank_elektrode" type="checkbox" class="checkroof_tank_elektrode <?= ($validation->hasError('roof_tank_elektrode')) ? 'is-invalid' : ''; ?>" onclick="checkroof_tank_elektrode(this.value);" value="0">
                                                    Rusak
                                                </div>
                                                <?php if ($validation->hasError('roof_tank_elektrode')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('roof_tank_elektrode'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkroof_tank_elektrode(b) {
                                                    var x = document.getElementsByClassName('checkroof_tank_elektrode');
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
                                            <td class="col-3" rowspan="2">Recycle Tank</td>
                                            <td class="col-4" style="padding-left: 8px;">Level Air</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('recycle_tank_level_air') == "1") {
                                                                echo ("checked");
                                                            } ?> id="recycle_tank_level_air" name="recycle_tank_level_air" type="checkbox" class="checkrecycle_tank_level_air <?= ($validation->hasError('recycle_tank_level_air')) ? 'is-invalid' : ''; ?>" onclick="checkrecycle_tank_level_air(this.value);" value="1">
                                                    Full<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('recycle_tank_level_air') == "0") {
                                                                echo ("checked");
                                                            } ?> id="recycle_tank_level_air" name="recycle_tank_level_air" type="checkbox" class="checkrecycle_tank_level_air <?= ($validation->hasError('recycle_tank_level_air')) ? 'is-invalid' : ''; ?>" onclick="checkrecycle_tank_level_air(this.value);" value="0">
                                                    Kurang
                                                </div>
                                                <?php if ($validation->hasError('recycle_tank_level_air')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('recycle_tank_level_air'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkrecycle_tank_level_air(b) {
                                                    var x = document.getElementsByClassName('checkrecycle_tank_level_air');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Elektrode</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('recycle_tank_elektrode') == "1") {
                                                                echo ("checked");
                                                            } ?> id="recycle_tank_elektrode" name="recycle_tank_elektrode" type="checkbox" class="checkrecycle_tank_elektrode <?= ($validation->hasError('recycle_tank_elektrode')) ? 'is-invalid' : ''; ?>" onclick="checkrecycle_tank_elektrode(this.value);" value="1">
                                                    Baik<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('recycle_tank_elektrode') == "0") {
                                                                echo ("checked");
                                                            } ?> id="recycle_tank_elektrode" name="recycle_tank_elektrode" type="checkbox" class="checkrecycle_tank_elektrode <?= ($validation->hasError('recycle_tank_elektrode')) ? 'is-invalid' : ''; ?>" onclick="checkrecycle_tank_elektrode(this.value);" value="0">
                                                    Rusak
                                                </div>
                                                <?php if ($validation->hasError('recycle_tank_elektrode')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('recycle_tank_elektrode'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkrecycle_tank_elektrode(b) {
                                                    var x = document.getElementsByClassName('checkrecycle_tank_elektrode');
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
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-3 col-form-label">Keterangan</label>
                                        <textarea name="keterangan" id="keterangan" class="form-control col <?= ($validation->hasError('keterangan')) ? 'is-invalid' : ''; ?>" rows="6"><?= old('keterangan'); ?></textarea>
                                        <?php if ($validation->hasError('keterangan')) : ?>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('keterangan'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>


                            <div class="form-footer">
                                <div class="row align-items-center">
                                    <div class="col"></div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-outline-primary ms-auto" id="btnSubmitShift" name="btnSubmitShift">
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
                        <h3 class="card-title">Plumbing</h3>
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
                                    <th>Jam Pengecekan</th>
                                    <th>Time Stamp</th>
                                    <th>PIC</th>
                                    <th class="text-center">Instalasi Air Bersih
                                        <br>P.Transfer 1
                                    </th>
                                    <th class="text-center">Instalasi Air Bersih
                                        <br>P.Transfer 2
                                    </th>
                                    <th class="text-center">Fire Pump
                                        <br>Jockey Pump
                                    </th>
                                    <th class="text-center">Fire Pump
                                        <br>Jockey Pump Pressure
                                    </th>
                                    <th class="text-center">Fire Pump
                                        <br>Hydrant Pump
                                    </th>
                                    <th class="text-center">Fire Pump
                                        <br>Hydrant Pump Pressure
                                    </th>
                                    <th class="text-center">GWT
                                        <br>Level Air
                                    </th>
                                    <th class="text-center">GWT
                                        <br>Elektrode
                                    </th>
                                    <th class="text-center">Roof Tank
                                        <br>Level Air
                                    </th>
                                    <th class="text-center">Roof Tank
                                        <br>Elektrode
                                    </th>
                                    <th class="text-center">Recycle Tank
                                        <br>Level Air
                                    </th>
                                    <th class="text-center">Recycle Tank
                                        <br>Elektrode
                                    </th>
                                    <th>Keterangan</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $i = 1 ?>
                                <?php foreach ($getDataTablePlumbing as $ts) : ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $ts['storeName']; ?></td>
                                        <td><?= $ts['time']; ?></td>
                                        <td><?= dateView($ts['date']); ?></td>
                                        <td><?= $ts['initial']; ?></td>
                                        <td><?= autoManual($ts['instalasi_air_bersih_p_transfer1']); ?></td>
                                        <td><?= autoManual($ts['instalasi_air_bersih_p_transfer2']); ?></td>
                                        <td><?= autoManual($ts['fire_pump_jockey_pump']); ?></td>
                                        <td><?= $ts['fire_pump_jockey_pressure']; ?></td>
                                        <td><?= autoManual($ts['fire_pump_hydrant_pump']); ?></td>
                                        <td><?= $ts['fire_pump_hydrant_pressure']; ?></td>
                                        <td><?= fullKurang($ts['gwt_level_air']); ?></td>
                                        <td><?= equipmentStatus($ts['gwt_elektrode']); ?></td>
                                        <td><?= fullKurang($ts['roof_tank_level_air']); ?></td>
                                        <td><?= equipmentStatus($ts['roof_tank_elektrode']); ?></td>
                                        <td><?= fullKurang($ts['recycle_tank_level_air']); ?></td>
                                        <td><?= equipmentStatus($ts['recycle_tank_elektrode']); ?></td>
                                        <td><?= $ts['keterangan']; ?></td>
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
                <h5 class="modal-title">Edit Data STP</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formEditData" action="<?= base_url('') ?>" method="post">
                    <input type="text" hidden readonly id="idFormEdit" name="idFormEdit">
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
                                <label class="form-label col-3 col-form-label">Jam Pengecekan</label>
                                <div class="col">
                                    <!-- TODO hanya bisa pilih 1x per hari -->
                                    <div class="form-check">
                                        <input type="text" hidden readonly id="timeValue" name="time" value="<?= old('time') ?>">
                                        <input disabled <?php if (old('time') == "08:00:00") {
                                                            echo ("checked");
                                                        } ?> value="08:00:00" id="time" name="time" class="jamCheck form-check-input  <?= ($validation->hasError('time')) ? 'is-invalid' : ''; ?>" type="checkbox"">
                                                <span class=" form-check-label">13:00</span>
                                    </div>
                                    <?php if ($validation->hasError('time')) : ?>
                                        <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                            <?= $validation->getError('time'); ?>
                                        </div>
                                    <?php endif; ?>
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
                                    <td class="col-3" rowspan="2">Instalasi Air Bersih</td>
                                    <td class="col-4" style="padding-left: 8px;">P. Transfer 1</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('instalasi_air_bersih_p_transfer1') == "1") {
                                                        echo ("checked");
                                                    } ?> id="instalasi_air_bersih_p_transfer1" name="instalasi_air_bersih_p_transfer1" type="checkbox" class="checkinstalasi_air_bersih_p_transfer1 <?= ($validation->hasError('instalasi_air_bersih_p_transfer1')) ? 'is-invalid' : ''; ?>" onclick="checkinstalasi_air_bersih_p_transfer1(this.value);" value="1">
                                            Auto<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('instalasi_air_bersih_p_transfer1') == "0") {
                                                        echo ("checked");
                                                    } ?> id="instalasi_air_bersih_p_transfer1" name="instalasi_air_bersih_p_transfer1" type="checkbox" class="checkinstalasi_air_bersih_p_transfer1 <?= ($validation->hasError('instalasi_air_bersih_p_transfer1')) ? 'is-invalid' : ''; ?>" onclick="checkinstalasi_air_bersih_p_transfer1(this.value);" value="0">
                                            Manual
                                        </div>
                                        <?php if ($validation->hasError('instalasi_air_bersih_p_transfer1')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('instalasi_air_bersih_p_transfer1'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkinstalasi_air_bersih_p_transfer1(b) {
                                            var x = document.getElementsByClassName('checkinstalasi_air_bersih_p_transfer1');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">P. Transfer 2</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('instalasi_air_bersih_p_transfer2') == "1") {
                                                        echo ("checked");
                                                    } ?> id="instalasi_air_bersih_p_transfer2" name="instalasi_air_bersih_p_transfer2" type="checkbox" class="checkinstalasi_air_bersih_p_transfer2 <?= ($validation->hasError('instalasi_air_bersih_p_transfer2')) ? 'is-invalid' : ''; ?>" onclick="checkinstalasi_air_bersih_p_transfer2(this.value);" value="1">
                                            Auto<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('instalasi_air_bersih_p_transfer2') == "0") {
                                                        echo ("checked");
                                                    } ?> id="instalasi_air_bersih_p_transfer2" name="instalasi_air_bersih_p_transfer2" type="checkbox" class="checkinstalasi_air_bersih_p_transfer2 <?= ($validation->hasError('instalasi_air_bersih_p_transfer2')) ? 'is-invalid' : ''; ?>" onclick="checkinstalasi_air_bersih_p_transfer2(this.value);" value="0">
                                            Manual
                                        </div>
                                        <?php if ($validation->hasError('instalasi_air_bersih_p_transfer2')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('instalasi_air_bersih_p_transfer2'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkinstalasi_air_bersih_p_transfer2(b) {
                                            var x = document.getElementsByClassName('checkinstalasi_air_bersih_p_transfer2');
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
                                    <td class="col-3" rowspan="2">Fire Pump</td>
                                    <td class="col-4" style="padding-left: 8px;">Jockey Pump</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('fire_pump_jockey_pump') == "1") {
                                                        echo ("checked");
                                                    } ?> id="fire_pump_jockey_pump" name="fire_pump_jockey_pump" type="checkbox" class="checkfire_pump_jockey_pump <?= ($validation->hasError('fire_pump_jockey_pump')) ? 'is-invalid' : ''; ?>" onclick="checkfire_pump_jockey_pump(this.value);" value="1">
                                            Auto<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('fire_pump_jockey_pump') == "0") {
                                                        echo ("checked");
                                                    } ?> id="fire_pump_jockey_pump" name="fire_pump_jockey_pump" type="checkbox" class="checkfire_pump_jockey_pump <?= ($validation->hasError('fire_pump_jockey_pump')) ? 'is-invalid' : ''; ?>" onclick="checkfire_pump_jockey_pump(this.value);" value="0">
                                            Manual
                                        </div>
                                        <?php if ($validation->hasError('fire_pump_jockey_pump')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('fire_pump_jockey_pump'); ?>
                                            </div>
                                        <?php endif; ?>
                                        <div class="form-group mb-3 row">
                                            <label class="form-label col-3 col-form-label">Pressure</label>
                                            <div class="col">
                                                <input type="text" class="form-control <?= ($validation->hasError('fire_pump_jockey_pressure')) ? 'is-invalid' : ''; ?>" id="fire_pump_jockey_pressure" name="fire_pump_jockey_pressure" placeholder="Pressure" value="<?= old('fire_pump_jockey_pressure'); ?>">
                                                <?php if ($validation->hasError('fire_pump_jockey_pressure')) : ?>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('fire_pump_jockey_pressure'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                    <script>
                                        function checkfire_pump_jockey_pump(b) {
                                            var x = document.getElementsByClassName('checkfire_pump_jockey_pump');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>

                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Hydrant Pump</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('fire_pump_hydrant_pump') == "1") {
                                                        echo ("checked");
                                                    } ?> id="fire_pump_hydrant_pump" name="fire_pump_hydrant_pump" type="checkbox" class="checkfire_pump_hydrant_pump <?= ($validation->hasError('fire_pump_hydrant_pump')) ? 'is-invalid' : ''; ?>" onclick="checkfire_pump_hydrant_pump(this.value);" value="1">
                                            Auto<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('fire_pump_hydrant_pump') == "0") {
                                                        echo ("checked");
                                                    } ?> id="fire_pump_hydrant_pump" name="fire_pump_hydrant_pump" type="checkbox" class="checkfire_pump_hydrant_pump <?= ($validation->hasError('fire_pump_hydrant_pump')) ? 'is-invalid' : ''; ?>" onclick="checkfire_pump_hydrant_pump(this.value);" value="0">
                                            Manual
                                        </div>
                                        <?php if ($validation->hasError('fire_pump_hydrant_pump')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('fire_pump_hydrant_pump'); ?>
                                            </div>
                                        <?php endif; ?>
                                        <div class="form-group mb-3 row">
                                            <label class="form-label col-3 col-form-label">Pressure</label>
                                            <div class="col">
                                                <input type="text" class="form-control <?= ($validation->hasError('fire_pump_hydrant_pressure')) ? 'is-invalid' : ''; ?>" id="fire_pump_hydrant_pressure" name="fire_pump_hydrant_pressure" placeholder="Pressure" value="<?= old('fire_pump_hydrant_pressure'); ?>">
                                                <?php if ($validation->hasError('fire_pump_hydrant_pressure')) : ?>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('fire_pump_hydrant_pressure'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                    <script>
                                        function checkfire_pump_hydrant_pump(b) {
                                            var x = document.getElementsByClassName('checkfire_pump_hydrant_pump');
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
                                    <td class="col-3" rowspan="2">GWT</td>
                                    <td class="col-4" style="padding-left: 8px;">Level Air</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('gwt_level_air') == "1") {
                                                        echo ("checked");
                                                    } ?> id="gwt_level_air" name="gwt_level_air" type="checkbox" class="checkgwt_level_air <?= ($validation->hasError('gwt_level_air')) ? 'is-invalid' : ''; ?>" onclick="checkgwt_level_air(this.value);" value="1">
                                            Full<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('gwt_level_air') == "0") {
                                                        echo ("checked");
                                                    } ?> id="gwt_level_air" name="gwt_level_air" type="checkbox" class="checkgwt_level_air <?= ($validation->hasError('gwt_level_air')) ? 'is-invalid' : ''; ?>" onclick="checkgwt_level_air(this.value);" value="0">
                                            Kurang
                                        </div>
                                        <?php if ($validation->hasError('gwt_level_air')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('gwt_level_air'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkgwt_level_air(b) {
                                            var x = document.getElementsByClassName('checkgwt_level_air');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Elektrode</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('gwt_elektrode') == "1") {
                                                        echo ("checked");
                                                    } ?> id="gwt_elektrode" name="gwt_elektrode" type="checkbox" class="checkgwt_elektrode <?= ($validation->hasError('gwt_elektrode')) ? 'is-invalid' : ''; ?>" onclick="checkgwt_elektrode(this.value);" value="1">
                                            Baik<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('gwt_elektrode') == "0") {
                                                        echo ("checked");
                                                    } ?> id="gwt_elektrode" name="gwt_elektrode" type="checkbox" class="checkgwt_elektrode <?= ($validation->hasError('gwt_elektrode')) ? 'is-invalid' : ''; ?>" onclick="checkgwt_elektrode(this.value);" value="0">
                                            Rusak
                                        </div>
                                        <?php if ($validation->hasError('gwt_elektrode')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('gwt_elektrode'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkgwt_elektrode(b) {
                                            var x = document.getElementsByClassName('checkgwt_elektrode');
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
                                    <td class="col-3" rowspan="2">Roof Tank</td>
                                    <td class="col-4" style="padding-left: 8px;">Level Air</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('roof_tank_level_air') == "1") {
                                                        echo ("checked");
                                                    } ?> id="roof_tank_level_air" name="roof_tank_level_air" type="checkbox" class="checkroof_tank_level_air <?= ($validation->hasError('roof_tank_level_air')) ? 'is-invalid' : ''; ?>" onclick="checkroof_tank_level_air(this.value);" value="1">
                                            Full<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('roof_tank_level_air') == "0") {
                                                        echo ("checked");
                                                    } ?> id="roof_tank_level_air" name="roof_tank_level_air" type="checkbox" class="checkroof_tank_level_air <?= ($validation->hasError('roof_tank_level_air')) ? 'is-invalid' : ''; ?>" onclick="checkroof_tank_level_air(this.value);" value="0">
                                            Kurang
                                        </div>
                                        <?php if ($validation->hasError('roof_tank_level_air')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('roof_tank_level_air'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkroof_tank_level_air(b) {
                                            var x = document.getElementsByClassName('checkroof_tank_level_air');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Elektrode</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('roof_tank_elektrode') == "1") {
                                                        echo ("checked");
                                                    } ?> id="roof_tank_elektrode" name="roof_tank_elektrode" type="checkbox" class="checkroof_tank_elektrode <?= ($validation->hasError('roof_tank_elektrode')) ? 'is-invalid' : ''; ?>" onclick="checkroof_tank_elektrode(this.value);" value="1">
                                            Baik<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('roof_tank_elektrode') == "0") {
                                                        echo ("checked");
                                                    } ?> id="roof_tank_elektrode" name="roof_tank_elektrode" type="checkbox" class="checkroof_tank_elektrode <?= ($validation->hasError('roof_tank_elektrode')) ? 'is-invalid' : ''; ?>" onclick="checkroof_tank_elektrode(this.value);" value="0">
                                            Rusak
                                        </div>
                                        <?php if ($validation->hasError('roof_tank_elektrode')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('roof_tank_elektrode'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkroof_tank_elektrode(b) {
                                            var x = document.getElementsByClassName('checkroof_tank_elektrode');
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
                                    <td class="col-3" rowspan="2">Recycle Tank</td>
                                    <td class="col-4" style="padding-left: 8px;">Level Air</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('recycle_tank_level_air') == "1") {
                                                        echo ("checked");
                                                    } ?> id="recycle_tank_level_air" name="recycle_tank_level_air" type="checkbox" class="checkrecycle_tank_level_air <?= ($validation->hasError('recycle_tank_level_air')) ? 'is-invalid' : ''; ?>" onclick="checkrecycle_tank_level_air(this.value);" value="1">
                                            Full<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('recycle_tank_level_air') == "0") {
                                                        echo ("checked");
                                                    } ?> id="recycle_tank_level_air" name="recycle_tank_level_air" type="checkbox" class="checkrecycle_tank_level_air <?= ($validation->hasError('recycle_tank_level_air')) ? 'is-invalid' : ''; ?>" onclick="checkrecycle_tank_level_air(this.value);" value="0">
                                            Kurang
                                        </div>
                                        <?php if ($validation->hasError('recycle_tank_level_air')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('recycle_tank_level_air'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkrecycle_tank_level_air(b) {
                                            var x = document.getElementsByClassName('checkrecycle_tank_level_air');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Elektrode</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('recycle_tank_elektrode') == "1") {
                                                        echo ("checked");
                                                    } ?> id="recycle_tank_elektrode" name="recycle_tank_elektrode" type="checkbox" class="checkrecycle_tank_elektrode <?= ($validation->hasError('recycle_tank_elektrode')) ? 'is-invalid' : ''; ?>" onclick="checkrecycle_tank_elektrode(this.value);" value="1">
                                            Baik<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('recycle_tank_elektrode') == "0") {
                                                        echo ("checked");
                                                    } ?> id="recycle_tank_elektrode" name="recycle_tank_elektrode" type="checkbox" class="checkrecycle_tank_elektrode <?= ($validation->hasError('recycle_tank_elektrode')) ? 'is-invalid' : ''; ?>" onclick="checkrecycle_tank_elektrode(this.value);" value="0">
                                            Rusak
                                        </div>
                                        <?php if ($validation->hasError('recycle_tank_elektrode')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('recycle_tank_elektrode'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkrecycle_tank_elektrode(b) {
                                            var x = document.getElementsByClassName('checkrecycle_tank_elektrode');
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
                            <div class="form-group mb-3 row">
                                <label class="form-label col-3 col-form-label">Keterangan</label>
                                <textarea name="keterangan" id="keterangan" class="form-control col <?= ($validation->hasError('keterangan')) ? 'is-invalid' : ''; ?>" rows="6"><?= old('keterangan'); ?></textarea>
                                <?php if ($validation->hasError('keterangan')) : ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('keterangan'); ?>
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
            $("#formEditData").attr('action', site_url + "/plumbing/updatePlumbing/" + oldData.post.idFormEdit);

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
            $("#formEditData").attr('action', site_url + "/plumbing/updatePlumbing/" + this.id);
            modalView.find(".is-invalid").removeClass("is-invalid");
            modalView.find(".invalid-feedback,.hasil-validasi").hide();

            inputData = new FormData();
            inputData.append("id", this.id);

            $.ajax({
                url: "<?= base_url('plumbing/ajaxDataPlumbing') ?>",
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
                        modalView.find("#time[value='" + data.data.time + "']").prop('checked', true);
                        modalView.find("#timeValue").val(data.data.time);
                        modalView.find("#date").val(data.data.date);
                        modalView.find("#worker").val(data.data.initial);
                        modalView.find("#location").val(data.data.storeName);
                        modalView.find("#equipment_checklist option[value=" + data.data.equipment_checklist + "]").prop('selected', true);
                        modalView.find("#instalasi_air_bersih_p_transfer1[value=" + data.data.instalasi_air_bersih_p_transfer1 + "]").prop('checked', true);
                        modalView.find("#instalasi_air_bersih_p_transfer2[value=" + data.data.instalasi_air_bersih_p_transfer2 + "]").prop('checked', true);
                        modalView.find("#fire_pump_jockey_pump[value=" + data.data.fire_pump_jockey_pump + "]").prop('checked', true);
                        modalView.find("#fire_pump_jockey_pressure").val(data.data.fire_pump_jockey_pressure);
                        modalView.find("#fire_pump_hydrant_pump[value=" + data.data.fire_pump_hydrant_pump + "]").prop('checked', true);
                        modalView.find("#fire_pump_hydrant_pressure").val(data.data.fire_pump_hydrant_pressure);
                        modalView.find("#gwt_level_air[value=" + data.data.gwt_level_air + "]").prop('checked', true);
                        modalView.find("#gwt_elektrode[value=" + data.data.gwt_elektrode + "]").prop('checked', true);
                        modalView.find("#roof_tank_level_air[value=" + data.data.roof_tank_level_air + "]").prop('checked', true);
                        modalView.find("#roof_tank_elektrode[value=" + data.data.roof_tank_elektrode + "]").prop('checked', true);
                        modalView.find("#recycle_tank_level_air[value=" + data.data.recycle_tank_level_air + "]").prop('checked', true);
                        modalView.find("#recycle_tank_elektrode[value=" + data.data.recycle_tank_elektrode + "]").prop('checked', true);
                        modalView.find("#keterangan").val(data.data.keterangan);
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
                        url: "<?= base_url('plumbing/deletePlumbing') ?>",
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