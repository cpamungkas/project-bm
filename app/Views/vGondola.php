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
                        <h3 class="card-title">Gondola</h3>
                    </div>

                    <div class="card-body">
                        <form id="formInputData" action="<?php echo base_url('gondola/saveGondola'); ?>" method="post">
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
                                        <label class="form-label col-3 col-form-label">Jam Pengecekan</label>
                                        <div class="col">
                                            <!-- TODO hanya bisa pilih 1x per hari -->
                                            <div class="form-check">
                                                <input <?= timeCheck("10:00:00", $checkInspection) ?> <?php if (old('time') == "10:00:00") {
                                                                                                            echo ("checked");
                                                                                                        } ?> value="10:00:00" id="time" name="time" class="jamCheck form-check-input  <?= ($validation->hasError('time')) ? 'is-invalid' : ''; ?>" type="checkbox">
                                                <span class="form-check-label">10:00</span>
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
                                            <td class="col-3" rowspan="11">Unit Gondola</td>
                                            <td class="col-4" style="padding-left: 8px;">Paket Kontrol</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('paket_kontrol') == "1") {
                                                                echo ("checked");
                                                            } ?> id="paket_kontrol" name="paket_kontrol" type="checkbox" class="checkpaket_kontrol <?= ($validation->hasError('paket_kontrol')) ? 'is-invalid' : ''; ?>" onclick="checkpaket_kontrol(this.value);" value="1">
                                                    Berfungsi<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('paket_kontrol') == "0") {
                                                                echo ("checked");
                                                            } ?> id="paket_kontrol" name="paket_kontrol" type="checkbox" class="checkpaket_kontrol <?= ($validation->hasError('paket_kontrol')) ? 'is-invalid' : ''; ?>" onclick="checkpaket_kontrol(this.value);" value="0">
                                                    Tidak
                                                </div>
                                                <?php if ($validation->hasError('paket_kontrol')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('paket_kontrol'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkpaket_kontrol(b) {
                                                    var x = document.getElementsByClassName('checkpaket_kontrol');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Motor Gerak Rail</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('motor_gerak_rail') == "1") {
                                                                echo ("checked");
                                                            } ?> id="motor_gerak_rail" name="motor_gerak_rail" type="checkbox" class="checkmotor_gerak_rail <?= ($validation->hasError('motor_gerak_rail')) ? 'is-invalid' : ''; ?>" onclick="checkmotor_gerak_rail(this.value);" value="1">
                                                    Berfungsi<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('motor_gerak_rail') == "0") {
                                                                echo ("checked");
                                                            } ?> id="motor_gerak_rail" name="motor_gerak_rail" type="checkbox" class="checkmotor_gerak_rail <?= ($validation->hasError('motor_gerak_rail')) ? 'is-invalid' : ''; ?>" onclick="checkmotor_gerak_rail(this.value);" value="0">
                                                    Tidak
                                                </div>
                                                <?php if ($validation->hasError('motor_gerak_rail')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('motor_gerak_rail'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkmotor_gerak_rail(b) {
                                                    var x = document.getElementsByClassName('checkmotor_gerak_rail');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Motor Gerak Putar</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('motor_gerak_putar') == "1") {
                                                                echo ("checked");
                                                            } ?> id="motor_gerak_putar" name="motor_gerak_putar" type="checkbox" class="checkmotor_gerak_putar <?= ($validation->hasError('motor_gerak_putar')) ? 'is-invalid' : ''; ?>" onclick="checkmotor_gerak_putar(this.value);" value="1">
                                                    Berfungsi<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('motor_gerak_putar') == "0") {
                                                                echo ("checked");
                                                            } ?> id="motor_gerak_putar" name="motor_gerak_putar" type="checkbox" class="checkmotor_gerak_putar <?= ($validation->hasError('motor_gerak_putar')) ? 'is-invalid' : ''; ?>" onclick="checkmotor_gerak_putar(this.value);" value="0">
                                                    Tidak
                                                </div>
                                                <?php if ($validation->hasError('motor_gerak_putar')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('motor_gerak_putar'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkmotor_gerak_putar(b) {
                                                    var x = document.getElementsByClassName('checkmotor_gerak_putar');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Motor Gerak Arm</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('motor_gerak_arm') == "1") {
                                                                echo ("checked");
                                                            } ?> id="motor_gerak_arm" name="motor_gerak_arm" type="checkbox" class="checkmotor_gerak_arm <?= ($validation->hasError('motor_gerak_arm')) ? 'is-invalid' : ''; ?>" onclick="checkmotor_gerak_arm(this.value);" value="1">
                                                    Berfungsi<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('motor_gerak_arm') == "0") {
                                                                echo ("checked");
                                                            } ?> id="motor_gerak_arm" name="motor_gerak_arm" type="checkbox" class="checkmotor_gerak_arm <?= ($validation->hasError('motor_gerak_arm')) ? 'is-invalid' : ''; ?>" onclick="checkmotor_gerak_arm(this.value);" value="0">
                                                    Tidak
                                                </div>
                                                <?php if ($validation->hasError('motor_gerak_arm')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('motor_gerak_arm'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkmotor_gerak_arm(b) {
                                                    var x = document.getElementsByClassName('checkmotor_gerak_arm');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Motor Gerak Keranjang</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('motor_gerak_keranjang') == "1") {
                                                                echo ("checked");
                                                            } ?> id="motor_gerak_keranjang" name="motor_gerak_keranjang" type="checkbox" class="checkmotor_gerak_keranjang <?= ($validation->hasError('motor_gerak_keranjang')) ? 'is-invalid' : ''; ?>" onclick="checkmotor_gerak_keranjang(this.value);" value="1">
                                                    Berfungsi<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('motor_gerak_keranjang') == "0") {
                                                                echo ("checked");
                                                            } ?> id="motor_gerak_keranjang" name="motor_gerak_keranjang" type="checkbox" class="checkmotor_gerak_keranjang <?= ($validation->hasError('motor_gerak_keranjang')) ? 'is-invalid' : ''; ?>" onclick="checkmotor_gerak_keranjang(this.value);" value="0">
                                                    Tidak
                                                </div>
                                                <?php if ($validation->hasError('motor_gerak_keranjang')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('motor_gerak_keranjang'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkmotor_gerak_keranjang(b) {
                                                    var x = document.getElementsByClassName('checkmotor_gerak_keranjang');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Wire Rope</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('wire_rope') == "1") {
                                                                echo ("checked");
                                                            } ?> id="wire_rope" name="wire_rope" type="checkbox" class="checkwire_rope <?= ($validation->hasError('wire_rope')) ? 'is-invalid' : ''; ?>" onclick="checkwire_rope(this.value);" value="1">
                                                    Berfungsi<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('wire_rope') == "0") {
                                                                echo ("checked");
                                                            } ?> id="wire_rope" name="wire_rope" type="checkbox" class="checkwire_rope <?= ($validation->hasError('wire_rope')) ? 'is-invalid' : ''; ?>" onclick="checkwire_rope(this.value);" value="0">
                                                    Tidak
                                                </div>
                                                <?php if ($validation->hasError('wire_rope')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('wire_rope'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkwire_rope(b) {
                                                    var x = document.getElementsByClassName('checkwire_rope');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Safety Block</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('safety_block') == "1") {
                                                                echo ("checked");
                                                            } ?> id="safety_block" name="safety_block" type="checkbox" class="checksafety_block <?= ($validation->hasError('safety_block')) ? 'is-invalid' : ''; ?>" onclick="checksafety_block(this.value);" value="1">
                                                    Berfungsi<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('safety_block') == "0") {
                                                                echo ("checked");
                                                            } ?> id="safety_block" name="safety_block" type="checkbox" class="checksafety_block <?= ($validation->hasError('safety_block')) ? 'is-invalid' : ''; ?>" onclick="checksafety_block(this.value);" value="0">
                                                    Tidak
                                                </div>
                                                <?php if ($validation->hasError('safety_block')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('safety_block'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checksafety_block(b) {
                                                    var x = document.getElementsByClassName('checksafety_block');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Gear Box</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('gear_box') == "1") {
                                                                echo ("checked");
                                                            } ?> id="gear_box" name="gear_box" type="checkbox" class="checkgear_box <?= ($validation->hasError('gear_box')) ? 'is-invalid' : ''; ?>" onclick="checkgear_box(this.value);" value="1">
                                                    Berfungsi<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('gear_box') == "0") {
                                                                echo ("checked");
                                                            } ?> id="gear_box" name="gear_box" type="checkbox" class="checkgear_box <?= ($validation->hasError('gear_box')) ? 'is-invalid' : ''; ?>" onclick="checkgear_box(this.value);" value="0">
                                                    Tidak
                                                </div>
                                                <?php if ($validation->hasError('gear_box')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('gear_box'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkgear_box(b) {
                                                    var x = document.getElementsByClassName('checkgear_box');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Noise</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('noise') == "1") {
                                                                echo ("checked");
                                                            } ?> id="noise" name="noise" type="checkbox" class="checknoise <?= ($validation->hasError('noise')) ? 'is-invalid' : ''; ?>" onclick="checknoise(this.value);" value="1">
                                                    Ya<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('noise') == "0") {
                                                                echo ("checked");
                                                            } ?> id="noise" name="noise" type="checkbox" class="checknoise <?= ($validation->hasError('noise')) ? 'is-invalid' : ''; ?>" onclick="checknoise(this.value);" value="0">
                                                    Tidak
                                                </div>
                                                <?php if ($validation->hasError('noise')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('noise'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checknoise(b) {
                                                    var x = document.getElementsByClassName('checknoise');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Vibrasi</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('vibrasi') == "1") {
                                                                echo ("checked");
                                                            } ?> id="vibrasi" name="vibrasi" type="checkbox" class="checkvibrasi <?= ($validation->hasError('vibrasi')) ? 'is-invalid' : ''; ?>" onclick="checkvibrasi(this.value);" value="1">
                                                    Ya<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('vibrasi') == "0") {
                                                                echo ("checked");
                                                            } ?> id="vibrasi" name="vibrasi" type="checkbox" class="checkvibrasi <?= ($validation->hasError('vibrasi')) ? 'is-invalid' : ''; ?>" onclick="checkvibrasi(this.value);" value="0">
                                                    Tidak
                                                </div>
                                                <?php if ($validation->hasError('vibrasi')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('vibrasi'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkvibrasi(b) {
                                                    var x = document.getElementsByClassName('checkvibrasi');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Pelumasan</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('pelumasan') == "1") {
                                                                echo ("checked");
                                                            } ?> id="pelumasan" name="pelumasan" type="checkbox" class="checkpelumasan <?= ($validation->hasError('pelumasan')) ? 'is-invalid' : ''; ?>" onclick="checkpelumasan(this.value);" value="1">
                                                    Ya<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('pelumasan') == "0") {
                                                                echo ("checked");
                                                            } ?> id="pelumasan" name="pelumasan" type="checkbox" class="checkpelumasan <?= ($validation->hasError('pelumasan')) ? 'is-invalid' : ''; ?>" onclick="checkpelumasan(this.value);" value="0">
                                                    Tidak
                                                </div>
                                                <?php if ($validation->hasError('pelumasan')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('pelumasan'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkpelumasan(b) {
                                                    var x = document.getElementsByClassName('checkpelumasan');
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
                                            <td class="col-3" rowspan="8">Kelengkapan</td>
                                            <td class="col-4" style="padding-left: 8px;">Seragam</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('seragam') == "1") {
                                                                echo ("checked");
                                                            } ?> id="seragam" name="seragam" type="checkbox" class="checkseragam <?= ($validation->hasError('seragam')) ? 'is-invalid' : ''; ?>" onclick="checkseragam(this.value);" value="1">
                                                    Lengkap<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('seragam') == "0") {
                                                                echo ("checked");
                                                            } ?> id="seragam" name="seragam" type="checkbox" class="checkseragam <?= ($validation->hasError('seragam')) ? 'is-invalid' : ''; ?>" onclick="checkseragam(this.value);" value="0">
                                                    Tidak
                                                </div>
                                                <?php if ($validation->hasError('seragam')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('seragam'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkseragam(b) {
                                                    var x = document.getElementsByClassName('checkseragam');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">ID Card</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('id_card') == "1") {
                                                                echo ("checked");
                                                            } ?> id="id_card" name="id_card" type="checkbox" class="checkid_card <?= ($validation->hasError('id_card')) ? 'is-invalid' : ''; ?>" onclick="checkid_card(this.value);" value="1">
                                                    Lengkap<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('id_card') == "0") {
                                                                echo ("checked");
                                                            } ?> id="id_card" name="id_card" type="checkbox" class="checkid_card <?= ($validation->hasError('id_card')) ? 'is-invalid' : ''; ?>" onclick="checkid_card(this.value);" value="0">
                                                    Tidak
                                                </div>
                                                <?php if ($validation->hasError('id_card')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('id_card'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkid_card(b) {
                                                    var x = document.getElementsByClassName('checkid_card');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Helmet</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('helmet') == "1") {
                                                                echo ("checked");
                                                            } ?> id="helmet" name="helmet" type="checkbox" class="checkhelmet <?= ($validation->hasError('helmet')) ? 'is-invalid' : ''; ?>" onclick="checkhelmet(this.value);" value="1">
                                                    Lengkap<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('helmet') == "0") {
                                                                echo ("checked");
                                                            } ?> id="helmet" name="helmet" type="checkbox" class="checkhelmet <?= ($validation->hasError('helmet')) ? 'is-invalid' : ''; ?>" onclick="checkhelmet(this.value);" value="0">
                                                    Tidak
                                                </div>
                                                <?php if ($validation->hasError('helmet')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('helmet'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkhelmet(b) {
                                                    var x = document.getElementsByClassName('checkhelmet');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Safety Glasses</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('safety_glasses') == "1") {
                                                                echo ("checked");
                                                            } ?> id="safety_glasses" name="safety_glasses" type="checkbox" class="checksafety_glasses <?= ($validation->hasError('safety_glasses')) ? 'is-invalid' : ''; ?>" onclick="checksafety_glasses(this.value);" value="1">
                                                    Lengkap<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('safety_glasses') == "0") {
                                                                echo ("checked");
                                                            } ?> id="safety_glasses" name="safety_glasses" type="checkbox" class="checksafety_glasses <?= ($validation->hasError('safety_glasses')) ? 'is-invalid' : ''; ?>" onclick="checksafety_glasses(this.value);" value="0">
                                                    Tidak
                                                </div>
                                                <?php if ($validation->hasError('safety_glasses')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('safety_glasses'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checksafety_glasses(b) {
                                                    var x = document.getElementsByClassName('checksafety_glasses');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Full Body Harnetz</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('full_body_harnetz') == "1") {
                                                                echo ("checked");
                                                            } ?> id="full_body_harnetz" name="full_body_harnetz" type="checkbox" class="checkfull_body_harnetz <?= ($validation->hasError('full_body_harnetz')) ? 'is-invalid' : ''; ?>" onclick="checkfull_body_harnetz(this.value);" value="1">
                                                    Lengkap<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('full_body_harnetz') == "0") {
                                                                echo ("checked");
                                                            } ?> id="full_body_harnetz" name="full_body_harnetz" type="checkbox" class="checkfull_body_harnetz <?= ($validation->hasError('full_body_harnetz')) ? 'is-invalid' : ''; ?>" onclick="checkfull_body_harnetz(this.value);" value="0">
                                                    Tidak
                                                </div>
                                                <?php if ($validation->hasError('full_body_harnetz')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('full_body_harnetz'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkfull_body_harnetz(b) {
                                                    var x = document.getElementsByClassName('checkfull_body_harnetz');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Auto Stop / Gerigi</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('auto_stop') == "1") {
                                                                echo ("checked");
                                                            } ?> id="auto_stop" name="auto_stop" type="checkbox" class="checkauto_stop <?= ($validation->hasError('auto_stop')) ? 'is-invalid' : ''; ?>" onclick="checkauto_stop(this.value);" value="1">
                                                    Lengkap<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('auto_stop') == "0") {
                                                                echo ("checked");
                                                            } ?> id="auto_stop" name="auto_stop" type="checkbox" class="checkauto_stop <?= ($validation->hasError('auto_stop')) ? 'is-invalid' : ''; ?>" onclick="checkauto_stop(this.value);" value="0">
                                                    Tidak
                                                </div>
                                                <?php if ($validation->hasError('auto_stop')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('auto_stop'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkauto_stop(b) {
                                                    var x = document.getElementsByClassName('checkauto_stop');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Carbiner</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('carbiner') == "1") {
                                                                echo ("checked");
                                                            } ?> id="carbiner" name="carbiner" type="checkbox" class="checkcarbiner <?= ($validation->hasError('carbiner')) ? 'is-invalid' : ''; ?>" onclick="checkcarbiner(this.value);" value="1">
                                                    Lengkap<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('carbiner') == "0") {
                                                                echo ("checked");
                                                            } ?> id="carbiner" name="carbiner" type="checkbox" class="checkcarbiner <?= ($validation->hasError('carbiner')) ? 'is-invalid' : ''; ?>" onclick="checkcarbiner(this.value);" value="0">
                                                    Tidak
                                                </div>
                                                <?php if ($validation->hasError('carbiner')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('carbiner'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkcarbiner(b) {
                                                    var x = document.getElementsByClassName('checkcarbiner');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Sarung Tangan</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('sarung_tangan') == "1") {
                                                                echo ("checked");
                                                            } ?> id="sarung_tangan" name="sarung_tangan" type="checkbox" class="checksarung_tangan <?= ($validation->hasError('sarung_tangan')) ? 'is-invalid' : ''; ?>" onclick="checksarung_tangan(this.value);" value="1">
                                                    Lengkap<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('sarung_tangan') == "0") {
                                                                echo ("checked");
                                                            } ?> id="sarung_tangan" name="sarung_tangan" type="checkbox" class="checksarung_tangan <?= ($validation->hasError('sarung_tangan')) ? 'is-invalid' : ''; ?>" onclick="checksarung_tangan(this.value);" value="0">
                                                    Tidak
                                                </div>
                                                <?php if ($validation->hasError('sarung_tangan')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('sarung_tangan'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checksarung_tangan(b) {
                                                    var x = document.getElementsByClassName('checksarung_tangan');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                    </tbody>
                                </table>
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
                        <h3 class="card-title">Gondola</h3>
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
                                    <th class="text-center">Paket<br>Kontrol</th>
                                    <th class="text-center">Motor<br>Gerak<br>Rail</th>
                                    <th class="text-center">Motor<br>Gerak<br>Putar</th>
                                    <th class="text-center">Motor<br>Gerak<br>Arm</th>
                                    <th class="text-center">Motor<br>Gerak<br>Keranjang</th>
                                    <th class="text-center">Wire<br>Rope</th>
                                    <th class="text-center">Safety<br>Block</th>
                                    <th class="text-center">Gear<br>Box</th>
                                    <th>Noise</th>
                                    <th>Vibrasi</th>
                                    <th>Pelumasan</th>
                                    <th>Seragam</th>
                                    <th>ID Card</th>
                                    <th>Helmet</th>
                                    <th class="text-center">Safety<br>Glasses</th>
                                    <th class="text-center">Full<br>Body<br>Hornetz</th>
                                    <th class="text-center">Auto<br>Stop/<br>Gerigi</th>
                                    <th>Carbiner</th>
                                    <th class="text-center">Sarung<br>Tangan</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $i = 1 ?>
                                <?php foreach ($getDataTableGondola as $ts) : ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $ts['storeName']; ?></td>
                                        <td><?= $ts['time']; ?></td>
                                        <td><?= dateView($ts['date']); ?></td>
                                        <td><?= $ts['initial']; ?></td>
                                        <td><?= berfungsiTidak($ts['paket_kontrol']); ?></td>
                                        <td><?= berfungsiTidak($ts['motor_gerak_rail']); ?></td>
                                        <td><?= berfungsiTidak($ts['motor_gerak_putar']); ?></td>
                                        <td><?= berfungsiTidak($ts['motor_gerak_arm']); ?></td>
                                        <td><?= berfungsiTidak($ts['motor_gerak_keranjang']); ?></td>
                                        <td><?= berfungsiTidak($ts['wire_rope']); ?></td>
                                        <td><?= berfungsiTidak($ts['safety_block']); ?></td>
                                        <td><?= berfungsiTidak($ts['gear_box']); ?></td>
                                        <td><?= yaTidak($ts['noise']); ?></td>
                                        <td><?= yaTidak($ts['vibrasi']); ?></td>
                                        <td><?= yaTidak($ts['pelumasan']); ?></td>
                                        <td><?= lengkapTidak($ts['seragam']); ?></td>
                                        <td><?= lengkapTidak($ts['id_card']); ?></td>
                                        <td><?= lengkapTidak($ts['helmet']); ?></td>
                                        <td><?= lengkapTidak($ts['safety_glasses']); ?></td>
                                        <td><?= lengkapTidak($ts['full_body_harnetz']); ?></td>
                                        <td><?= lengkapTidak($ts['auto_stop']); ?></td>
                                        <td><?= lengkapTidak($ts['carbiner']); ?></td>
                                        <td><?= lengkapTidak($ts['sarung_tangan']); ?></td>
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
        </div>
    </div>
</div>

<!-- Modal edit data -->
<div class="modal modal-blur fade modal-edit" id="modal-editData" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data Gondola</h5>
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
                                <label class="form-label col-3 col-form-label">Jam Pengecekan</label>
                                <div class="col">
                                    <div class="form-check">
                                        <input type="text" hidden readonly id="timeValue" name="time" value="<?= old('time') ?>">
                                        <input disabled <?php if (old('time') == "10:00:00") {
                                                            echo ("checked");
                                                        } ?> value="10:00:00" id="time" name="time" class="jamCheck form-check-input  <?= ($validation->hasError('time')) ? 'is-invalid' : ''; ?>" type="checkbox">
                                        <span class="form-check-label">10:00</span>
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
                                    <td class="col-3" rowspan="11">Unit Gondola</td>
                                    <td class="col-4" style="padding-left: 8px;">Paket Kontrol</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('paket_kontrol') == "1") {
                                                        echo ("checked");
                                                    } ?> id="paket_kontrol" name="paket_kontrol" type="checkbox" class="checkpaket_kontrolEdit <?= ($validation->hasError('paket_kontrol')) ? 'is-invalid' : ''; ?>" onclick="checkpaket_kontrolEdit(this.value);" value="1">
                                            Berfungsi<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('paket_kontrol') == "0") {
                                                        echo ("checked");
                                                    } ?> id="paket_kontrol" name="paket_kontrol" type="checkbox" class="checkpaket_kontrolEdit <?= ($validation->hasError('paket_kontrol')) ? 'is-invalid' : ''; ?>" onclick="checkpaket_kontrolEdit(this.value);" value="0">
                                            Tidak
                                        </div>
                                        <?php if ($validation->hasError('paket_kontrol')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('paket_kontrol'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkpaket_kontrolEdit(b) {
                                            var x = document.getElementsByClassName('checkpaket_kontrolEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Motor Gerak Rail</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('motor_gerak_rail') == "1") {
                                                        echo ("checked");
                                                    } ?> id="motor_gerak_rail" name="motor_gerak_rail" type="checkbox" class="checkmotor_gerak_railEdit <?= ($validation->hasError('motor_gerak_rail')) ? 'is-invalid' : ''; ?>" onclick="checkmotor_gerak_railEdit(this.value);" value="1">
                                            Berfungsi<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('motor_gerak_rail') == "0") {
                                                        echo ("checked");
                                                    } ?> id="motor_gerak_rail" name="motor_gerak_rail" type="checkbox" class="checkmotor_gerak_railEdit <?= ($validation->hasError('motor_gerak_rail')) ? 'is-invalid' : ''; ?>" onclick="checkmotor_gerak_railEdit(this.value);" value="0">
                                            Tidak
                                        </div>
                                        <?php if ($validation->hasError('motor_gerak_rail')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('motor_gerak_rail'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkmotor_gerak_railEdit(b) {
                                            var x = document.getElementsByClassName('checkmotor_gerak_railEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Motor Gerak Putar</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('motor_gerak_putar') == "1") {
                                                        echo ("checked");
                                                    } ?> id="motor_gerak_putar" name="motor_gerak_putar" type="checkbox" class="checkmotor_gerak_putarEdit <?= ($validation->hasError('motor_gerak_putar')) ? 'is-invalid' : ''; ?>" onclick="checkmotor_gerak_putarEdit(this.value);" value="1">
                                            Berfungsi<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('motor_gerak_putar') == "0") {
                                                        echo ("checked");
                                                    } ?> id="motor_gerak_putar" name="motor_gerak_putar" type="checkbox" class="checkmotor_gerak_putarEdit <?= ($validation->hasError('motor_gerak_putar')) ? 'is-invalid' : ''; ?>" onclick="checkmotor_gerak_putarEdit(this.value);" value="0">
                                            Tidak
                                        </div>
                                        <?php if ($validation->hasError('motor_gerak_putar')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('motor_gerak_putar'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkmotor_gerak_putarEdit(b) {
                                            var x = document.getElementsByClassName('checkmotor_gerak_putarEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Motor Gerak Arm</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('motor_gerak_arm') == "1") {
                                                        echo ("checked");
                                                    } ?> id="motor_gerak_arm" name="motor_gerak_arm" type="checkbox" class="checkmotor_gerak_armEdit <?= ($validation->hasError('motor_gerak_arm')) ? 'is-invalid' : ''; ?>" onclick="checkmotor_gerak_armEdit(this.value);" value="1">
                                            Berfungsi<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('motor_gerak_arm') == "0") {
                                                        echo ("checked");
                                                    } ?> id="motor_gerak_arm" name="motor_gerak_arm" type="checkbox" class="checkmotor_gerak_armEdit <?= ($validation->hasError('motor_gerak_arm')) ? 'is-invalid' : ''; ?>" onclick="checkmotor_gerak_armEdit(this.value);" value="0">
                                            Tidak
                                        </div>
                                        <?php if ($validation->hasError('motor_gerak_arm')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('motor_gerak_arm'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkmotor_gerak_armEdit(b) {
                                            var x = document.getElementsByClassName('checkmotor_gerak_armEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Motor Gerak Keranjang</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('motor_gerak_keranjang') == "1") {
                                                        echo ("checked");
                                                    } ?> id="motor_gerak_keranjang" name="motor_gerak_keranjang" type="checkbox" class="checkmotor_gerak_keranjangEdit <?= ($validation->hasError('motor_gerak_keranjang')) ? 'is-invalid' : ''; ?>" onclick="checkmotor_gerak_keranjangEdit(this.value);" value="1">
                                            Berfungsi<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('motor_gerak_keranjang') == "0") {
                                                        echo ("checked");
                                                    } ?> id="motor_gerak_keranjang" name="motor_gerak_keranjang" type="checkbox" class="checkmotor_gerak_keranjangEdit <?= ($validation->hasError('motor_gerak_keranjang')) ? 'is-invalid' : ''; ?>" onclick="checkmotor_gerak_keranjangEdit(this.value);" value="0">
                                            Tidak
                                        </div>
                                        <?php if ($validation->hasError('motor_gerak_keranjang')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('motor_gerak_keranjang'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkmotor_gerak_keranjangEdit(b) {
                                            var x = document.getElementsByClassName('checkmotor_gerak_keranjangEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Wire Rope</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('wire_rope') == "1") {
                                                        echo ("checked");
                                                    } ?> id="wire_rope" name="wire_rope" type="checkbox" class="checkwire_ropeEdit <?= ($validation->hasError('wire_rope')) ? 'is-invalid' : ''; ?>" onclick="checkwire_ropeEdit(this.value);" value="1">
                                            Berfungsi<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('wire_rope') == "0") {
                                                        echo ("checked");
                                                    } ?> id="wire_rope" name="wire_rope" type="checkbox" class="checkwire_ropeEdit <?= ($validation->hasError('wire_rope')) ? 'is-invalid' : ''; ?>" onclick="checkwire_ropeEdit(this.value);" value="0">
                                            Tidak
                                        </div>
                                        <?php if ($validation->hasError('wire_rope')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('wire_rope'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkwire_ropeEdit(b) {
                                            var x = document.getElementsByClassName('checkwire_ropeEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Safety Block</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('safety_block') == "1") {
                                                        echo ("checked");
                                                    } ?> id="safety_block" name="safety_block" type="checkbox" class="checksafety_blockEdit <?= ($validation->hasError('safety_block')) ? 'is-invalid' : ''; ?>" onclick="checksafety_blockEdit(this.value);" value="1">
                                            Berfungsi<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('safety_block') == "0") {
                                                        echo ("checked");
                                                    } ?> id="safety_block" name="safety_block" type="checkbox" class="checksafety_blockEdit <?= ($validation->hasError('safety_block')) ? 'is-invalid' : ''; ?>" onclick="checksafety_blockEdit(this.value);" value="0">
                                            Tidak
                                        </div>
                                        <?php if ($validation->hasError('safety_block')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('safety_block'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checksafety_blockEdit(b) {
                                            var x = document.getElementsByClassName('checksafety_blockEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Gear Box</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('gear_box') == "1") {
                                                        echo ("checked");
                                                    } ?> id="gear_box" name="gear_box" type="checkbox" class="checkgear_boxEdit <?= ($validation->hasError('gear_box')) ? 'is-invalid' : ''; ?>" onclick="checkgear_boxEdit(this.value);" value="1">
                                            Berfungsi<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('gear_box') == "0") {
                                                        echo ("checked");
                                                    } ?> id="gear_box" name="gear_box" type="checkbox" class="checkgear_boxEdit <?= ($validation->hasError('gear_box')) ? 'is-invalid' : ''; ?>" onclick="checkgear_boxEdit(this.value);" value="0">
                                            Tidak
                                        </div>
                                        <?php if ($validation->hasError('gear_box')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('gear_box'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkgear_boxEdit(b) {
                                            var x = document.getElementsByClassName('checkgear_boxEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Noise</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('noise') == "1") {
                                                        echo ("checked");
                                                    } ?> id="noise" name="noise" type="checkbox" class="checknoiseEdit <?= ($validation->hasError('noise')) ? 'is-invalid' : ''; ?>" onclick="checknoiseEdit(this.value);" value="1">
                                            Ya<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('noise') == "0") {
                                                        echo ("checked");
                                                    } ?> id="noise" name="noise" type="checkbox" class="checknoiseEdit <?= ($validation->hasError('noise')) ? 'is-invalid' : ''; ?>" onclick="checknoiseEdit(this.value);" value="0">
                                            Tidak
                                        </div>
                                        <?php if ($validation->hasError('noise')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('noise'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checknoiseEdit(b) {
                                            var x = document.getElementsByClassName('checknoiseEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Vibrasi</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('vibrasi') == "1") {
                                                        echo ("checked");
                                                    } ?> id="vibrasi" name="vibrasi" type="checkbox" class="checkvibrasiEdit <?= ($validation->hasError('vibrasi')) ? 'is-invalid' : ''; ?>" onclick="checkvibrasiEdit(this.value);" value="1">
                                            Ya<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('vibrasi') == "0") {
                                                        echo ("checked");
                                                    } ?> id="vibrasi" name="vibrasi" type="checkbox" class="checkvibrasiEdit <?= ($validation->hasError('vibrasi')) ? 'is-invalid' : ''; ?>" onclick="checkvibrasiEdit(this.value);" value="0">
                                            Tidak
                                        </div>
                                        <?php if ($validation->hasError('vibrasi')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('vibrasi'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkvibrasiEdit(b) {
                                            var x = document.getElementsByClassName('checkvibrasiEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Pelumasan</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('pelumasan') == "1") {
                                                        echo ("checked");
                                                    } ?> id="pelumasan" name="pelumasan" type="checkbox" class="checkpelumasanEdit <?= ($validation->hasError('pelumasan')) ? 'is-invalid' : ''; ?>" onclick="checkpelumasanEdit(this.value);" value="1">
                                            Ya<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('pelumasan') == "0") {
                                                        echo ("checked");
                                                    } ?> id="pelumasan" name="pelumasan" type="checkbox" class="checkpelumasanEdit <?= ($validation->hasError('pelumasan')) ? 'is-invalid' : ''; ?>" onclick="checkpelumasanEdit(this.value);" value="0">
                                            Tidak
                                        </div>
                                        <?php if ($validation->hasError('pelumasan')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('pelumasan'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkpelumasanEdit(b) {
                                            var x = document.getElementsByClassName('checkpelumasanEdit');
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
                                    <td class="col-3" rowspan="8">Kelengkapan</td>
                                    <td class="col-4" style="padding-left: 8px;">Seragam</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('seragam') == "1") {
                                                        echo ("checked");
                                                    } ?> id="seragam" name="seragam" type="checkbox" class="checkseragamEdit <?= ($validation->hasError('seragam')) ? 'is-invalid' : ''; ?>" onclick="checkseragamEdit(this.value);" value="1">
                                            Lengkap<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('seragam') == "0") {
                                                        echo ("checked");
                                                    } ?> id="seragam" name="seragam" type="checkbox" class="checkseragamEdit <?= ($validation->hasError('seragam')) ? 'is-invalid' : ''; ?>" onclick="checkseragamEdit(this.value);" value="0">
                                            Tidak
                                        </div>
                                        <?php if ($validation->hasError('seragam')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('seragam'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkseragamEdit(b) {
                                            var x = document.getElementsByClassName('checkseragamEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">ID Card</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('id_card') == "1") {
                                                        echo ("checked");
                                                    } ?> id="id_card" name="id_card" type="checkbox" class="checkid_cardEdit <?= ($validation->hasError('id_card')) ? 'is-invalid' : ''; ?>" onclick="checkid_cardEdit(this.value);" value="1">
                                            Lengkap<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('id_card') == "0") {
                                                        echo ("checked");
                                                    } ?> id="id_card" name="id_card" type="checkbox" class="checkid_cardEdit <?= ($validation->hasError('id_card')) ? 'is-invalid' : ''; ?>" onclick="checkid_cardEdit(this.value);" value="0">
                                            Tidak
                                        </div>
                                        <?php if ($validation->hasError('id_card')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('id_card'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkid_cardEdit(b) {
                                            var x = document.getElementsByClassName('checkid_cardEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Helmet</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('helmet') == "1") {
                                                        echo ("checked");
                                                    } ?> id="helmet" name="helmet" type="checkbox" class="checkhelmetEdit <?= ($validation->hasError('helmet')) ? 'is-invalid' : ''; ?>" onclick="checkhelmetEdit(this.value);" value="1">
                                            Lengkap<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('helmet') == "0") {
                                                        echo ("checked");
                                                    } ?> id="helmet" name="helmet" type="checkbox" class="checkhelmetEdit <?= ($validation->hasError('helmet')) ? 'is-invalid' : ''; ?>" onclick="checkhelmetEdit(this.value);" value="0">
                                            Tidak
                                        </div>
                                        <?php if ($validation->hasError('helmet')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('helmet'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkhelmetEdit(b) {
                                            var x = document.getElementsByClassName('checkhelmetEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Safety Glasses</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('safety_glasses') == "1") {
                                                        echo ("checked");
                                                    } ?> id="safety_glasses" name="safety_glasses" type="checkbox" class="checksafety_glassesEdit <?= ($validation->hasError('safety_glasses')) ? 'is-invalid' : ''; ?>" onclick="checksafety_glassesEdit(this.value);" value="1">
                                            Lengkap<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('safety_glasses') == "0") {
                                                        echo ("checked");
                                                    } ?> id="safety_glasses" name="safety_glasses" type="checkbox" class="checksafety_glassesEdit <?= ($validation->hasError('safety_glasses')) ? 'is-invalid' : ''; ?>" onclick="checksafety_glassesEdit(this.value);" value="0">
                                            Tidak
                                        </div>
                                        <?php if ($validation->hasError('safety_glasses')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('safety_glasses'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checksafety_glassesEdit(b) {
                                            var x = document.getElementsByClassName('checksafety_glassesEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Full Body Harnetz</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('full_body_harnetz') == "1") {
                                                        echo ("checked");
                                                    } ?> id="full_body_harnetz" name="full_body_harnetz" type="checkbox" class="checkfull_body_harnetzEdit <?= ($validation->hasError('full_body_harnetz')) ? 'is-invalid' : ''; ?>" onclick="checkfull_body_harnetzEdit(this.value);" value="1">
                                            Lengkap<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('full_body_harnetz') == "0") {
                                                        echo ("checked");
                                                    } ?> id="full_body_harnetz" name="full_body_harnetz" type="checkbox" class="checkfull_body_harnetzEdit <?= ($validation->hasError('full_body_harnetz')) ? 'is-invalid' : ''; ?>" onclick="checkfull_body_harnetzEdit(this.value);" value="0">
                                            Tidak
                                        </div>
                                        <?php if ($validation->hasError('full_body_harnetz')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('full_body_harnetz'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkfull_body_harnetzEdit(b) {
                                            var x = document.getElementsByClassName('checkfull_body_harnetzEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Auto Stop / Gerigi</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('auto_stop') == "1") {
                                                        echo ("checked");
                                                    } ?> id="auto_stop" name="auto_stop" type="checkbox" class="checkauto_stopEdit <?= ($validation->hasError('auto_stop')) ? 'is-invalid' : ''; ?>" onclick="checkauto_stopEdit(this.value);" value="1">
                                            Lengkap<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('auto_stop') == "0") {
                                                        echo ("checked");
                                                    } ?> id="auto_stop" name="auto_stop" type="checkbox" class="checkauto_stopEdit <?= ($validation->hasError('auto_stop')) ? 'is-invalid' : ''; ?>" onclick="checkauto_stopEdit(this.value);" value="0">
                                            Tidak
                                        </div>
                                        <?php if ($validation->hasError('auto_stop')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('auto_stop'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkauto_stopEdit(b) {
                                            var x = document.getElementsByClassName('checkauto_stopEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Carbiner</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('carbiner') == "1") {
                                                        echo ("checked");
                                                    } ?> id="carbiner" name="carbiner" type="checkbox" class="checkcarbinerEdit <?= ($validation->hasError('carbiner')) ? 'is-invalid' : ''; ?>" onclick="checkcarbinerEdit(this.value);" value="1">
                                            Lengkap<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('carbiner') == "0") {
                                                        echo ("checked");
                                                    } ?> id="carbiner" name="carbiner" type="checkbox" class="checkcarbinerEdit <?= ($validation->hasError('carbiner')) ? 'is-invalid' : ''; ?>" onclick="checkcarbinerEdit(this.value);" value="0">
                                            Tidak
                                        </div>
                                        <?php if ($validation->hasError('carbiner')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('carbiner'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkcarbinerEdit(b) {
                                            var x = document.getElementsByClassName('checkcarbinerEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Sarung Tangan</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('sarung_tangan') == "1") {
                                                        echo ("checked");
                                                    } ?> id="sarung_tangan" name="sarung_tangan" type="checkbox" class="checksarung_tanganEdit <?= ($validation->hasError('sarung_tangan')) ? 'is-invalid' : ''; ?>" onclick="checksarung_tanganEdit(this.value);" value="1">
                                            Lengkap<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('sarung_tangan') == "0") {
                                                        echo ("checked");
                                                    } ?> id="sarung_tangan" name="sarung_tangan" type="checkbox" class="checksarung_tanganEdit <?= ($validation->hasError('sarung_tangan')) ? 'is-invalid' : ''; ?>" onclick="checksarung_tanganEdit(this.value);" value="0">
                                            Tidak
                                        </div>
                                        <?php if ($validation->hasError('sarung_tangan')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('sarung_tangan'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checksarung_tanganEdit(b) {
                                            var x = document.getElementsByClassName('checksarung_tanganEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                            </tbody>
                        </table>
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

        let urlUpdate = site_url + '/gondola/updateGondola/';
        let urlAjaxData = site_url + '/gondola/ajaxDataGondola/';
        let urlDelete = site_url + '/gondola/deleteGondola/';
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
                        modalView.find("#time[value='" + data.data.time + "']").prop('checked', true);
                        modalView.find("#timeValue").val(data.data.time);
                        modalView.find("#date").val(data.data.date);
                        modalView.find("#worker").val(data.data.initial);
                        modalView.find("#location").val(data.data.storeName);
                        modalView.find("#equipment_checklist option[value=" + data.data.equipment_checklist + "]").prop('selected', true);
                        modalView.find("#paket_kontrol[value=" + data.data.paket_kontrol + "]").prop('checked', true);
                        modalView.find("#motor_gerak_rail[value=" + data.data.motor_gerak_rail + "]").prop('checked', true);
                        modalView.find("#motor_gerak_putar[value=" + data.data.motor_gerak_putar + "]").prop('checked', true);
                        modalView.find("#motor_gerak_arm[value=" + data.data.motor_gerak_arm + "]").prop('checked', true);
                        modalView.find("#motor_gerak_keranjang[value=" + data.data.motor_gerak_keranjang + "]").prop('checked', true);
                        modalView.find("#wire_rope[value=" + data.data.wire_rope + "]").prop('checked', true);
                        modalView.find("#safety_block[value=" + data.data.safety_block + "]").prop('checked', true);
                        modalView.find("#gear_box[value=" + data.data.gear_box + "]").prop('checked', true);
                        modalView.find("#noise[value=" + data.data.noise + "]").prop('checked', true);
                        modalView.find("#vibrasi[value=" + data.data.vibrasi + "]").prop('checked', true);
                        modalView.find("#pelumasan[value=" + data.data.pelumasan + "]").prop('checked', true);
                        modalView.find("#seragam[value=" + data.data.seragam + "]").prop('checked', true);
                        modalView.find("#id_card[value=" + data.data.id_card + "]").prop('checked', true);
                        modalView.find("#helmet[value=" + data.data.helmet + "]").prop('checked', true);
                        modalView.find("#safety_glasses[value=" + data.data.safety_glasses + "]").prop('checked', true);
                        modalView.find("#full_body_harnetz[value=" + data.data.full_body_harnetz + "]").prop('checked', true);
                        modalView.find("#auto_stop[value=" + data.data.auto_stop + "]").prop('checked', true);
                        modalView.find("#carbiner[value=" + data.data.carbiner + "]").prop('checked', true);
                        modalView.find("#sarung_tangan[value=" + data.data.sarung_tangan + "]").prop('checked', true);
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