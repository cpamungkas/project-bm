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
                        <h3 class="card-title">Housekeeping</h3>
                    </div>

                    <div class="card-body">
                        <form id="formInputData" action="<?php echo base_url('housekeeping/saveHousekeeping'); ?>" method="post">
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
                                                <input <?= timeCheck("13:00:00", $checkInspection) ?> <?php if (old('time') == "13:00:00") {
                                                                                                            echo ("checked");
                                                                                                        } ?> value="13:00:00" id="time" name="time" class="jamCheck form-check-input  <?= ($validation->hasError('time')) ? 'is-invalid' : ''; ?>" type="checkbox">
                                                <span class="form-check-label">13:00</span>
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

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-3 col-form-label">Lantai</label>
                                        <div class="col">
                                            <input type="text" class="form-control <?= ($validation->hasError('lantai')) ? 'is-invalid' : ''; ?>" id="lantai" name="lantai" placeholder="Lantai" value="<?= old('lantai'); ?>">
                                            <?php if ($validation->hasError('lantai')) : ?>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('lantai'); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-3 col-form-label">Ruang</label>
                                        <div class="col">
                                            <input type="text" class="form-control <?= ($validation->hasError('ruang')) ? 'is-invalid' : ''; ?>" id="ruang" name="ruang" placeholder="Ruang" value="<?= old('ruang'); ?>">
                                            <?php if ($validation->hasError('ruang')) : ?>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('ruang'); ?>
                                                </div>
                                            <?php endif; ?>
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
                                            <td class="col-3" rowspan="15">Kebersihan</td>
                                            <td class="col-4" style="padding-left: 8px;">Closet</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('kloset') == "1") {
                                                                echo ("checked");
                                                            } ?> id="kloset" name="kloset" type="checkbox" class="checkkloset <?= ($validation->hasError('kloset')) ? 'is-invalid' : ''; ?>" onclick="checkkloset(this.value);" value="1">
                                                    Bersih<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('kloset') == "0") {
                                                                echo ("checked");
                                                            } ?> id="kloset" name="kloset" type="checkbox" class="checkkloset <?= ($validation->hasError('kloset')) ? 'is-invalid' : ''; ?>" onclick="checkkloset(this.value);" value="0">
                                                    Kotor
                                                </div>
                                                <?php if ($validation->hasError('kloset')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('kloset'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkkloset(b) {
                                                    var x = document.getElementsByClassName('checkkloset');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Urinoir</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('urinoir') == "1") {
                                                                echo ("checked");
                                                            } ?> id="urinoir" name="urinoir" type="checkbox" class="checkurinoir <?= ($validation->hasError('urinoir')) ? 'is-invalid' : ''; ?>" onclick="checkurinoir(this.value);" value="1">
                                                    Bersih<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('urinoir') == "0") {
                                                                echo ("checked");
                                                            } ?> id="urinoir" name="urinoir" type="checkbox" class="checkurinoir <?= ($validation->hasError('urinoir')) ? 'is-invalid' : ''; ?>" onclick="checkurinoir(this.value);" value="0">
                                                    Kotor
                                                </div>
                                                <?php if ($validation->hasError('urinoir')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('urinoir'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkurinoir(b) {
                                                    var x = document.getElementsByClassName('checkurinoir');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Washtafel</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('washtafel') == "1") {
                                                                echo ("checked");
                                                            } ?> id="washtafel" name="washtafel" type="checkbox" class="checkwashtafel <?= ($validation->hasError('washtafel')) ? 'is-invalid' : ''; ?>" onclick="checkwashtafel(this.value);" value="1">
                                                    Bersih<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('washtafel') == "0") {
                                                                echo ("checked");
                                                            } ?> id="washtafel" name="washtafel" type="checkbox" class="checkwashtafel <?= ($validation->hasError('washtafel')) ? 'is-invalid' : ''; ?>" onclick="checkwashtafel(this.value);" value="0">
                                                    Kotor
                                                </div>
                                                <?php if ($validation->hasError('washtafel')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('washtafel'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkwashtafel(b) {
                                                    var x = document.getElementsByClassName('checkwashtafel');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Grease Trap</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('grease_trap') == "1") {
                                                                echo ("checked");
                                                            } ?> id="grease_trap" name="grease_trap" type="checkbox" class="checkgrease_trap <?= ($validation->hasError('grease_trap')) ? 'is-invalid' : ''; ?>" onclick="checkgrease_trap(this.value);" value="1">
                                                    Bersih<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('grease_trap') == "0") {
                                                                echo ("checked");
                                                            } ?> id="grease_trap" name="grease_trap" type="checkbox" class="checkgrease_trap <?= ($validation->hasError('grease_trap')) ? 'is-invalid' : ''; ?>" onclick="checkgrease_trap(this.value);" value="0">
                                                    Kotor
                                                </div>
                                                <?php if ($validation->hasError('grease_trap')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('grease_trap'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkgrease_trap(b) {
                                                    var x = document.getElementsByClassName('checkgrease_trap');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Diffuser</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('diffuser') == "1") {
                                                                echo ("checked");
                                                            } ?> id="diffuser" name="diffuser" type="checkbox" class="checkdiffuser <?= ($validation->hasError('diffuser')) ? 'is-invalid' : ''; ?>" onclick="checkdiffuser(this.value);" value="1">
                                                    Bersih<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('diffuser') == "0") {
                                                                echo ("checked");
                                                            } ?> id="diffuser" name="diffuser" type="checkbox" class="checkdiffuser <?= ($validation->hasError('diffuser')) ? 'is-invalid' : ''; ?>" onclick="checkdiffuser(this.value);" value="0">
                                                    Kotor
                                                </div>
                                                <?php if ($validation->hasError('diffuser')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('diffuser'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkdiffuser(b) {
                                                    var x = document.getElementsByClassName('checkdiffuser');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Lantai</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('kebersihan_lantai') == "1") {
                                                                echo ("checked");
                                                            } ?> id="kebersihan_lantai" name="kebersihan_lantai" type="checkbox" class="checkkebersihan_lantai <?= ($validation->hasError('kebersihan_lantai')) ? 'is-invalid' : ''; ?>" onclick="checkkebersihan_lantai(this.value);" value="1">
                                                    Bersih<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('kebersihan_lantai') == "0") {
                                                                echo ("checked");
                                                            } ?> id="kebersihan_lantai" name="kebersihan_lantai" type="checkbox" class="checkkebersihan_lantai <?= ($validation->hasError('kebersihan_lantai')) ? 'is-invalid' : ''; ?>" onclick="checkkebersihan_lantai(this.value);" value="0">
                                                    Kotor
                                                </div>
                                                <?php if ($validation->hasError('kebersihan_lantai')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('kebersihan_lantai'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkkebersihan_lantai(b) {
                                                    var x = document.getElementsByClassName('checkkebersihan_lantai');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Dinding</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('dinding') == "1") {
                                                                echo ("checked");
                                                            } ?> id="dinding" name="dinding" type="checkbox" class="checkdinding <?= ($validation->hasError('dinding')) ? 'is-invalid' : ''; ?>" onclick="checkdinding(this.value);" value="1">
                                                    Bersih<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('dinding') == "0") {
                                                                echo ("checked");
                                                            } ?> id="dinding" name="dinding" type="checkbox" class="checkdinding <?= ($validation->hasError('dinding')) ? 'is-invalid' : ''; ?>" onclick="checkdinding(this.value);" value="0">
                                                    Kotor
                                                </div>
                                                <?php if ($validation->hasError('dinding')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('dinding'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkdinding(b) {
                                                    var x = document.getElementsByClassName('checkdinding');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Kaca / Cermin</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('cermin') == "1") {
                                                                echo ("checked");
                                                            } ?> id="cermin" name="cermin" type="checkbox" class="checkcermin <?= ($validation->hasError('cermin')) ? 'is-invalid' : ''; ?>" onclick="checkcermin(this.value);" value="1">
                                                    Bersih<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('cermin') == "0") {
                                                                echo ("checked");
                                                            } ?> id="cermin" name="cermin" type="checkbox" class="checkcermin <?= ($validation->hasError('cermin')) ? 'is-invalid' : ''; ?>" onclick="checkcermin(this.value);" value="0">
                                                    Kotor
                                                </div>
                                                <?php if ($validation->hasError('cermin')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('cermin'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkcermin(b) {
                                                    var x = document.getElementsByClassName('checkcermin');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Plafond</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('plafond') == "1") {
                                                                echo ("checked");
                                                            } ?> id="plafond" name="plafond" type="checkbox" class="checkplafond <?= ($validation->hasError('plafond')) ? 'is-invalid' : ''; ?>" onclick="checkplafond(this.value);" value="1">
                                                    Bersih<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('plafond') == "0") {
                                                                echo ("checked");
                                                            } ?> id="plafond" name="plafond" type="checkbox" class="checkplafond <?= ($validation->hasError('plafond')) ? 'is-invalid' : ''; ?>" onclick="checkplafond(this.value);" value="0">
                                                    Kotor
                                                </div>
                                                <?php if ($validation->hasError('plafond')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('plafond'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkplafond(b) {
                                                    var x = document.getElementsByClassName('checkplafond');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Tempat Sampah</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('tempat_sampah') == "1") {
                                                                echo ("checked");
                                                            } ?> id="tempat_sampah" name="tempat_sampah" type="checkbox" class="checktempat_sampah <?= ($validation->hasError('tempat_sampah')) ? 'is-invalid' : ''; ?>" onclick="checktempat_sampah(this.value);" value="1">
                                                    Bersih<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('tempat_sampah') == "0") {
                                                                echo ("checked");
                                                            } ?> id="tempat_sampah" name="tempat_sampah" type="checkbox" class="checktempat_sampah <?= ($validation->hasError('tempat_sampah')) ? 'is-invalid' : ''; ?>" onclick="checktempat_sampah(this.value);" value="0">
                                                    Kotor
                                                </div>
                                                <?php if ($validation->hasError('tempat_sampah')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('tempat_sampah'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checktempat_sampah(b) {
                                                    var x = document.getElementsByClassName('checktempat_sampah');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Floor Drainage</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('floor_drainage') == "1") {
                                                                echo ("checked");
                                                            } ?> id="floor_drainage" name="floor_drainage" type="checkbox" class="checkfloor_drainage <?= ($validation->hasError('floor_drainage')) ? 'is-invalid' : ''; ?>" onclick="checkfloor_drainage(this.value);" value="1">
                                                    Bersih<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('floor_drainage') == "0") {
                                                                echo ("checked");
                                                            } ?> id="floor_drainage" name="floor_drainage" type="checkbox" class="checkfloor_drainage <?= ($validation->hasError('floor_drainage')) ? 'is-invalid' : ''; ?>" onclick="checkfloor_drainage(this.value);" value="0">
                                                    Kotor
                                                </div>
                                                <?php if ($validation->hasError('floor_drainage')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('floor_drainage'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkfloor_drainage(b) {
                                                    var x = document.getElementsByClassName('checkfloor_drainage');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Kap Lampu</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('kap_lampu') == "1") {
                                                                echo ("checked");
                                                            } ?> id="kap_lampu" name="kap_lampu" type="checkbox" class="checkkap_lampu <?= ($validation->hasError('kap_lampu')) ? 'is-invalid' : ''; ?>" onclick="checkkap_lampu(this.value);" value="1">
                                                    Bersih<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('kap_lampu') == "0") {
                                                                echo ("checked");
                                                            } ?> id="kap_lampu" name="kap_lampu" type="checkbox" class="checkkap_lampu <?= ($validation->hasError('kap_lampu')) ? 'is-invalid' : ''; ?>" onclick="checkkap_lampu(this.value);" value="0">
                                                    Kotor
                                                </div>
                                                <?php if ($validation->hasError('kap_lampu')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('kap_lampu'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkkap_lampu(b) {
                                                    var x = document.getElementsByClassName('checkkap_lampu');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Hand Dryer</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('hand_dryer') == "1") {
                                                                echo ("checked");
                                                            } ?> id="hand_dryer" name="hand_dryer" type="checkbox" class="checkhand_dryer <?= ($validation->hasError('hand_dryer')) ? 'is-invalid' : ''; ?>" onclick="checkhand_dryer(this.value);" value="1">
                                                    Bersih<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('hand_dryer') == "0") {
                                                                echo ("checked");
                                                            } ?> id="hand_dryer" name="hand_dryer" type="checkbox" class="checkhand_dryer <?= ($validation->hasError('hand_dryer')) ? 'is-invalid' : ''; ?>" onclick="checkhand_dryer(this.value);" value="0">
                                                    Kotor
                                                </div>
                                                <?php if ($validation->hasError('hand_dryer')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('hand_dryer'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkhand_dryer(b) {
                                                    var x = document.getElementsByClassName('checkhand_dryer');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Exhaust Fan</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('exhaust_fan') == "1") {
                                                                echo ("checked");
                                                            } ?> id="exhaust_fan" name="exhaust_fan" type="checkbox" class="checkexhaust_fan <?= ($validation->hasError('exhaust_fan')) ? 'is-invalid' : ''; ?>" onclick="checkexhaust_fan(this.value);" value="1">
                                                    Bersih<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('exhaust_fan') == "0") {
                                                                echo ("checked");
                                                            } ?> id="exhaust_fan" name="exhaust_fan" type="checkbox" class="checkexhaust_fan <?= ($validation->hasError('exhaust_fan')) ? 'is-invalid' : ''; ?>" onclick="checkexhaust_fan(this.value);" value="0">
                                                    Kotor
                                                </div>
                                                <?php if ($validation->hasError('exhaust_fan')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('exhaust_fan'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkexhaust_fan(b) {
                                                    var x = document.getElementsByClassName('checkexhaust_fan');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Air Curtain</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('air_curtain') == "1") {
                                                                echo ("checked");
                                                            } ?> id="air_curtain" name="air_curtain" type="checkbox" class="checkair_curtain <?= ($validation->hasError('air_curtain')) ? 'is-invalid' : ''; ?>" onclick="checkair_curtain(this.value);" value="1">
                                                    Bersih<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('air_curtain') == "0") {
                                                                echo ("checked");
                                                            } ?> id="air_curtain" name="air_curtain" type="checkbox" class="checkair_curtain <?= ($validation->hasError('air_curtain')) ? 'is-invalid' : ''; ?>" onclick="checkair_curtain(this.value);" value="0">
                                                    Kotor
                                                </div>
                                                <?php if ($validation->hasError('air_curtain')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('air_curtain'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkair_curtain(b) {
                                                    var x = document.getElementsByClassName('checkair_curtain');
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
                        <h3 class="card-title">Housekeeping</h3>
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
                                    <th>Lantai</th>
                                    <th>Ruang</th>
                                    <th>Closet</th>
                                    <th>Urinoir</th>
                                    <th>Washtafel</th>
                                    <th class="text-center">Grease<br>Trap</th>
                                    <th>Diffuser</th>
                                    <th class="text-center">Kebersihan<br>Lantai</th>
                                    <th>Dinding</th>
                                    <th class="text-center">Kaca/<br>Cermin</th>
                                    <th>Plafond</th>
                                    <th class="text-center">Tempat<br>Sampah</th>
                                    <th class="text-center">Floor<br>Drainage</th>
                                    <th class="text-center">Kap<br>Lampu</th>
                                    <th class="text-center">Hand<br>Dryer</th>
                                    <th class="text-center">Exhaust<br>Fan</th>
                                    <th class="text-center">Air<br>Curtain</th>
                                    <th>Jumlah Temuan</th>
                                    <th>Penjelasan</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $i = 1 ?>
                                <?php foreach ($getDataTableHousekeeping as $ts) : ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $ts['storeName']; ?></td>
                                        <td><?= $ts['time']; ?></td>
                                        <td><?= dateView($ts['date']); ?></td>
                                        <td><?= $ts['initial']; ?></td>
                                        <td><?= $ts['lantai']; ?></td>
                                        <td><?= $ts['ruang']; ?></td>
                                        <td><?= bersihKotor($ts['kloset']); ?></td>
                                        <td><?= bersihKotor($ts['urinoir']); ?></td>
                                        <td><?= bersihKotor($ts['washtafel']); ?></td>
                                        <td><?= bersihKotor($ts['grease_trap']); ?></td>
                                        <td><?= bersihKotor($ts['diffuser']); ?></td>
                                        <td><?= bersihKotor($ts['kebersihan_lantai']); ?></td>
                                        <td><?= bersihKotor($ts['dinding']); ?></td>
                                        <td><?= bersihKotor($ts['cermin']); ?></td>
                                        <td><?= bersihKotor($ts['plafond']); ?></td>
                                        <td><?= bersihKotor($ts['tempat_sampah']); ?></td>
                                        <td><?= bersihKotor($ts['floor_drainage']); ?></td>
                                        <td><?= bersihKotor($ts['kap_lampu']); ?></td>
                                        <td><?= bersihKotor($ts['hand_dryer']); ?></td>
                                        <td><?= bersihKotor($ts['exhaust_fan']); ?></td>
                                        <td><?= bersihKotor($ts['air_curtain']); ?></td>
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
                <h5 class="modal-title">Edit Data Housekeeping</h5>
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
                                        <input disabled <?php if (old('time') == "13:00:00") {
                                                            echo ("checked");
                                                        } ?> value="13:00:00" id="time" name="time" class="jamCheck form-check-input  <?= ($validation->hasError('time')) ? 'is-invalid' : ''; ?>" type="checkbox">
                                        <span class="form-check-label">13:00</span>
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

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-3 row">
                                <label class="form-label col-3 col-form-label">Lantai</label>
                                <div class="col">
                                    <input type="text" class="form-control <?= ($validation->hasError('lantai')) ? 'is-invalid' : ''; ?>" id="lantai" name="lantai" placeholder="Lantai" value="<?= old('lantai'); ?>">
                                    <?php if ($validation->hasError('lantai')) : ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('lantai'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-3 row">
                                <label class="form-label col-3 col-form-label">Ruang</label>
                                <div class="col">
                                    <input type="text" class="form-control <?= ($validation->hasError('ruang')) ? 'is-invalid' : ''; ?>" id="ruang" name="ruang" placeholder="Ruang" value="<?= old('ruang'); ?>">
                                    <?php if ($validation->hasError('ruang')) : ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('ruang'); ?>
                                        </div>
                                    <?php endif; ?>
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
                                    <td class="col-3" rowspan="15">Kebersihan</td>
                                    <td class="col-4" style="padding-left: 8px;">Closet</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('kloset') == "1") {
                                                        echo ("checked");
                                                    } ?> id="kloset" name="kloset" type="checkbox" class="checkklosetEdit <?= ($validation->hasError('kloset')) ? 'is-invalid' : ''; ?>" onclick="checkklosetEdit(this.value);" value="1">
                                            Bersih<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('kloset') == "0") {
                                                        echo ("checked");
                                                    } ?> id="kloset" name="kloset" type="checkbox" class="checkklosetEdit <?= ($validation->hasError('kloset')) ? 'is-invalid' : ''; ?>" onclick="checkklosetEdit(this.value);" value="0">
                                            Kotor
                                        </div>
                                        <?php if ($validation->hasError('kloset')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('kloset'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkklosetEdit(b) {
                                            var x = document.getElementsByClassName('checkklosetEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Urinoir</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('urinoir') == "1") {
                                                        echo ("checked");
                                                    } ?> id="urinoir" name="urinoir" type="checkbox" class="checkurinoirEdit <?= ($validation->hasError('urinoir')) ? 'is-invalid' : ''; ?>" onclick="checkurinoirEdit(this.value);" value="1">
                                            Bersih<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('urinoir') == "0") {
                                                        echo ("checked");
                                                    } ?> id="urinoir" name="urinoir" type="checkbox" class="checkurinoirEdit <?= ($validation->hasError('urinoir')) ? 'is-invalid' : ''; ?>" onclick="checkurinoirEdit(this.value);" value="0">
                                            Kotor
                                        </div>
                                        <?php if ($validation->hasError('urinoir')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('urinoir'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkurinoirEdit(b) {
                                            var x = document.getElementsByClassName('checkurinoirEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Washtafel</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('washtafel') == "1") {
                                                        echo ("checked");
                                                    } ?> id="washtafel" name="washtafel" type="checkbox" class="checkwashtafelEdit <?= ($validation->hasError('washtafel')) ? 'is-invalid' : ''; ?>" onclick="checkwashtafelEdit(this.value);" value="1">
                                            Bersih<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('washtafel') == "0") {
                                                        echo ("checked");
                                                    } ?> id="washtafel" name="washtafel" type="checkbox" class="checkwashtafelEdit <?= ($validation->hasError('washtafel')) ? 'is-invalid' : ''; ?>" onclick="checkwashtafelEdit(this.value);" value="0">
                                            Kotor
                                        </div>
                                        <?php if ($validation->hasError('washtafel')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('washtafel'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkwashtafelEdit(b) {
                                            var x = document.getElementsByClassName('checkwashtafelEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Grease Trap</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('grease_trap') == "1") {
                                                        echo ("checked");
                                                    } ?> id="grease_trap" name="grease_trap" type="checkbox" class="checkgrease_trapEdit <?= ($validation->hasError('grease_trap')) ? 'is-invalid' : ''; ?>" onclick="checkgrease_trapEdit(this.value);" value="1">
                                            Bersih<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('grease_trap') == "0") {
                                                        echo ("checked");
                                                    } ?> id="grease_trap" name="grease_trap" type="checkbox" class="checkgrease_trapEdit <?= ($validation->hasError('grease_trap')) ? 'is-invalid' : ''; ?>" onclick="checkgrease_trapEdit(this.value);" value="0">
                                            Kotor
                                        </div>
                                        <?php if ($validation->hasError('grease_trap')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('grease_trap'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkgrease_trapEdit(b) {
                                            var x = document.getElementsByClassName('checkgrease_trapEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Diffuser</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('diffuser') == "1") {
                                                        echo ("checked");
                                                    } ?> id="diffuser" name="diffuser" type="checkbox" class="checkdiffuserEdit <?= ($validation->hasError('diffuser')) ? 'is-invalid' : ''; ?>" onclick="checkdiffuserEdit(this.value);" value="1">
                                            Bersih<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('diffuser') == "0") {
                                                        echo ("checked");
                                                    } ?> id="diffuser" name="diffuser" type="checkbox" class="checkdiffuserEdit <?= ($validation->hasError('diffuser')) ? 'is-invalid' : ''; ?>" onclick="checkdiffuserEdit(this.value);" value="0">
                                            Kotor
                                        </div>
                                        <?php if ($validation->hasError('diffuser')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('diffuser'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkdiffuserEdit(b) {
                                            var x = document.getElementsByClassName('checkdiffuserEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Lantai</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('kebersihan_lantai') == "1") {
                                                        echo ("checked");
                                                    } ?> id="kebersihan_lantai" name="kebersihan_lantai" type="checkbox" class="checkkebersihan_lantaiEdit <?= ($validation->hasError('kebersihan_lantai')) ? 'is-invalid' : ''; ?>" onclick="checkkebersihan_lantaiEdit(this.value);" value="1">
                                            Bersih<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('kebersihan_lantai') == "0") {
                                                        echo ("checked");
                                                    } ?> id="kebersihan_lantai" name="kebersihan_lantai" type="checkbox" class="checkkebersihan_lantaiEdit <?= ($validation->hasError('kebersihan_lantai')) ? 'is-invalid' : ''; ?>" onclick="checkkebersihan_lantaiEdit(this.value);" value="0">
                                            Kotor
                                        </div>
                                        <?php if ($validation->hasError('kebersihan_lantai')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('kebersihan_lantai'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkkebersihan_lantaiEdit(b) {
                                            var x = document.getElementsByClassName('checkkebersihan_lantaiEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Dinding</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('dinding') == "1") {
                                                        echo ("checked");
                                                    } ?> id="dinding" name="dinding" type="checkbox" class="checkdindingEdit <?= ($validation->hasError('dinding')) ? 'is-invalid' : ''; ?>" onclick="checkdindingEdit(this.value);" value="1">
                                            Bersih<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('dinding') == "0") {
                                                        echo ("checked");
                                                    } ?> id="dinding" name="dinding" type="checkbox" class="checkdindingEdit <?= ($validation->hasError('dinding')) ? 'is-invalid' : ''; ?>" onclick="checkdindingEdit(this.value);" value="0">
                                            Kotor
                                        </div>
                                        <?php if ($validation->hasError('dinding')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('dinding'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkdindingEdit(b) {
                                            var x = document.getElementsByClassName('checkdindingEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Kaca / Cermin</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('cermin') == "1") {
                                                        echo ("checked");
                                                    } ?> id="cermin" name="cermin" type="checkbox" class="checkcerminEdit <?= ($validation->hasError('cermin')) ? 'is-invalid' : ''; ?>" onclick="checkcerminEdit(this.value);" value="1">
                                            Bersih<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('cermin') == "0") {
                                                        echo ("checked");
                                                    } ?> id="cermin" name="cermin" type="checkbox" class="checkcerminEdit <?= ($validation->hasError('cermin')) ? 'is-invalid' : ''; ?>" onclick="checkcerminEdit(this.value);" value="0">
                                            Kotor
                                        </div>
                                        <?php if ($validation->hasError('cermin')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('cermin'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkcerminEdit(b) {
                                            var x = document.getElementsByClassName('checkcerminEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Plafond</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('plafond') == "1") {
                                                        echo ("checked");
                                                    } ?> id="plafond" name="plafond" type="checkbox" class="checkplafondEdit <?= ($validation->hasError('plafond')) ? 'is-invalid' : ''; ?>" onclick="checkplafondEdit(this.value);" value="1">
                                            Bersih<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('plafond') == "0") {
                                                        echo ("checked");
                                                    } ?> id="plafond" name="plafond" type="checkbox" class="checkplafondEdit <?= ($validation->hasError('plafond')) ? 'is-invalid' : ''; ?>" onclick="checkplafondEdit(this.value);" value="0">
                                            Kotor
                                        </div>
                                        <?php if ($validation->hasError('plafond')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('plafond'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkplafondEdit(b) {
                                            var x = document.getElementsByClassName('checkplafondEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Tempat Sampah</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('tempat_sampah') == "1") {
                                                        echo ("checked");
                                                    } ?> id="tempat_sampah" name="tempat_sampah" type="checkbox" class="checktempat_sampahEdit <?= ($validation->hasError('tempat_sampah')) ? 'is-invalid' : ''; ?>" onclick="checktempat_sampahEdit(this.value);" value="1">
                                            Bersih<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('tempat_sampah') == "0") {
                                                        echo ("checked");
                                                    } ?> id="tempat_sampah" name="tempat_sampah" type="checkbox" class="checktempat_sampahEdit <?= ($validation->hasError('tempat_sampah')) ? 'is-invalid' : ''; ?>" onclick="checktempat_sampahEdit(this.value);" value="0">
                                            Kotor
                                        </div>
                                        <?php if ($validation->hasError('tempat_sampah')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('tempat_sampah'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checktempat_sampahEdit(b) {
                                            var x = document.getElementsByClassName('checktempat_sampahEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Floor Drainage</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('floor_drainage') == "1") {
                                                        echo ("checked");
                                                    } ?> id="floor_drainage" name="floor_drainage" type="checkbox" class="checkfloor_drainageEdit <?= ($validation->hasError('floor_drainage')) ? 'is-invalid' : ''; ?>" onclick="checkfloor_drainageEdit(this.value);" value="1">
                                            Bersih<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('floor_drainage') == "0") {
                                                        echo ("checked");
                                                    } ?> id="floor_drainage" name="floor_drainage" type="checkbox" class="checkfloor_drainageEdit <?= ($validation->hasError('floor_drainage')) ? 'is-invalid' : ''; ?>" onclick="checkfloor_drainageEdit(this.value);" value="0">
                                            Kotor
                                        </div>
                                        <?php if ($validation->hasError('floor_drainage')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('floor_drainage'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkfloor_drainageEdit(b) {
                                            var x = document.getElementsByClassName('checkfloor_drainageEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Kap Lampu</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('kap_lampu') == "1") {
                                                        echo ("checked");
                                                    } ?> id="kap_lampu" name="kap_lampu" type="checkbox" class="checkkap_lampuEdit <?= ($validation->hasError('kap_lampu')) ? 'is-invalid' : ''; ?>" onclick="checkkap_lampuEdit(this.value);" value="1">
                                            Bersih<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('kap_lampu') == "0") {
                                                        echo ("checked");
                                                    } ?> id="kap_lampu" name="kap_lampu" type="checkbox" class="checkkap_lampuEdit <?= ($validation->hasError('kap_lampu')) ? 'is-invalid' : ''; ?>" onclick="checkkap_lampuEdit(this.value);" value="0">
                                            Kotor
                                        </div>
                                        <?php if ($validation->hasError('kap_lampu')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('kap_lampu'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkkap_lampuEdit(b) {
                                            var x = document.getElementsByClassName('checkkap_lampuEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Hand Dryer</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('hand_dryer') == "1") {
                                                        echo ("checked");
                                                    } ?> id="hand_dryer" name="hand_dryer" type="checkbox" class="checkhand_dryerEdit <?= ($validation->hasError('hand_dryer')) ? 'is-invalid' : ''; ?>" onclick="checkhand_dryerEdit(this.value);" value="1">
                                            Bersih<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('hand_dryer') == "0") {
                                                        echo ("checked");
                                                    } ?> id="hand_dryer" name="hand_dryer" type="checkbox" class="checkhand_dryerEdit <?= ($validation->hasError('hand_dryer')) ? 'is-invalid' : ''; ?>" onclick="checkhand_dryerEdit(this.value);" value="0">
                                            Kotor
                                        </div>
                                        <?php if ($validation->hasError('hand_dryer')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('hand_dryer'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkhand_dryerEdit(b) {
                                            var x = document.getElementsByClassName('checkhand_dryerEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Exhaust Fan</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('exhaust_fan') == "1") {
                                                        echo ("checked");
                                                    } ?> id="exhaust_fan" name="exhaust_fan" type="checkbox" class="checkexhaust_fanEdit <?= ($validation->hasError('exhaust_fan')) ? 'is-invalid' : ''; ?>" onclick="checkexhaust_fanEdit(this.value);" value="1">
                                            Bersih<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('exhaust_fan') == "0") {
                                                        echo ("checked");
                                                    } ?> id="exhaust_fan" name="exhaust_fan" type="checkbox" class="checkexhaust_fanEdit <?= ($validation->hasError('exhaust_fan')) ? 'is-invalid' : ''; ?>" onclick="checkexhaust_fanEdit(this.value);" value="0">
                                            Kotor
                                        </div>
                                        <?php if ($validation->hasError('exhaust_fan')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('exhaust_fan'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkexhaust_fanEdit(b) {
                                            var x = document.getElementsByClassName('checkexhaust_fanEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Air Curtain</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('air_curtain') == "1") {
                                                        echo ("checked");
                                                    } ?> id="air_curtain" name="air_curtain" type="checkbox" class="checkair_curtainEdit <?= ($validation->hasError('air_curtain')) ? 'is-invalid' : ''; ?>" onclick="checkair_curtainEdit(this.value);" value="1">
                                            Bersih<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('air_curtain') == "0") {
                                                        echo ("checked");
                                                    } ?> id="air_curtain" name="air_curtain" type="checkbox" class="checkair_curtainEdit <?= ($validation->hasError('air_curtain')) ? 'is-invalid' : ''; ?>" onclick="checkair_curtainEdit(this.value);" value="0">
                                            Kotor
                                        </div>
                                        <?php if ($validation->hasError('air_curtain')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('air_curtain'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkair_curtainEdit(b) {
                                            var x = document.getElementsByClassName('checkair_curtainEdit');
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

        let urlUpdate = site_url + '/housekeeping/updateHousekeeping/';
        let urlAjaxData = site_url + '/housekeeping/ajaxDataHousekeeping/';
        let urlDelete = site_url + '/housekeeping/deleteHousekeeping/';
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
                        modalView.find("#kloset[value=" + data.data.kloset + "]").prop('checked', true);
                        modalView.find("#urinoir[value=" + data.data.urinoir + "]").prop('checked', true);
                        modalView.find("#washtafel[value=" + data.data.washtafel + "]").prop('checked', true);
                        modalView.find("#grease_trap[value=" + data.data.grease_trap + "]").prop('checked', true);
                        modalView.find("#diffuser[value=" + data.data.diffuser + "]").prop('checked', true);
                        modalView.find("#kebersihan_lantai[value=" + data.data.kebersihan_lantai + "]").prop('checked', true);
                        modalView.find("#dinding[value=" + data.data.dinding + "]").prop('checked', true);
                        modalView.find("#cermin[value=" + data.data.cermin + "]").prop('checked', true);
                        modalView.find("#tempat_sampah[value=" + data.data.tempat_sampah + "]").prop('checked', true);
                        modalView.find("#floor_drainage[value=" + data.data.floor_drainage + "]").prop('checked', true);
                        modalView.find("#kap_lampu[value=" + data.data.kap_lampu + "]").prop('checked', true);
                        modalView.find("#hand_dryer[value=" + data.data.hand_dryer + "]").prop('checked', true);
                        modalView.find("#exhaust_fan[value=" + data.data.exhaust_fan + "]").prop('checked', true);
                        modalView.find("#air_curtain[value=" + data.data.air_curtain + "]").prop('checked', true);
                        modalView.find("#plafond[value=" + data.data.plafond + "]").prop('checked', true);
                        modalView.find("#lantai").val(data.data.lantai);
                        modalView.find("#ruang").val(data.data.ruang);
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