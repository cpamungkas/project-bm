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
                        <h3 class="card-title">Folding Gate</h3>
                    </div>

                    <div class="card-body">
                        <form id="formInputData" action="<?php echo base_url('foldinggate/saveFoldingGate'); ?>" method="post">
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

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-3 col-form-label">Folding Gate Name</label>
                                        <div class="col">
                                            <input type="text" class="form-control <?= ($validation->hasError('name')) ? 'is-invalid' : ''; ?>" id="name" name="name" placeholder="Folding Gate Name" value="<?= old('name'); ?>">
                                            <?php if ($validation->hasError('name')) : ?>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('name'); ?>
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
                                            <td class="col-3" rowspan="8">Inspeksi Folding Gate</td>
                                            <td class="col-4" style="padding-left: 8px;">Kunci Set</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('kunci_set') == "1") {
                                                                echo ("checked");
                                                            } ?> id="kunci_set" name="kunci_set" type="checkbox" class="checkkunci_set <?= ($validation->hasError('kunci_set')) ? 'is-invalid' : ''; ?>" onclick="checkkunci_set(this.value);" value="1">
                                                    Baik<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('kunci_set') == "0") {
                                                                echo ("checked");
                                                            } ?> id="kunci_set" name="kunci_set" type="checkbox" class="checkkunci_set <?= ($validation->hasError('kunci_set')) ? 'is-invalid' : ''; ?>" onclick="checkkunci_set(this.value);" value="0">
                                                    Rusak
                                                </div>
                                                <?php if ($validation->hasError('kunci_set')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('kunci_set'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkkunci_set(b) {
                                                    var x = document.getElementsByClassName('checkkunci_set');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Daun</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('daun') == "1") {
                                                                echo ("checked");
                                                            } ?> id="daun" name="daun" type="checkbox" class="checkdaun <?= ($validation->hasError('daun')) ? 'is-invalid' : ''; ?>" onclick="checkdaun(this.value);" value="1">
                                                    Baik<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('daun') == "0") {
                                                                echo ("checked");
                                                            } ?> id="daun" name="daun" type="checkbox" class="checkdaun <?= ($validation->hasError('daun')) ? 'is-invalid' : ''; ?>" onclick="checkdaun(this.value);" value="0">
                                                    Rusak
                                                </div>
                                                <?php if ($validation->hasError('daun')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('daun'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkdaun(b) {
                                                    var x = document.getElementsByClassName('checkdaun');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Silangan</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('silangan') == "1") {
                                                                echo ("checked");
                                                            } ?> id="silangan" name="silangan" type="checkbox" class="checksilangan <?= ($validation->hasError('silangan')) ? 'is-invalid' : ''; ?>" onclick="checksilangan(this.value);" value="1">
                                                    Baik<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('silangan') == "0") {
                                                                echo ("checked");
                                                            } ?> id="silangan" name="silangan" type="checkbox" class="checksilangan <?= ($validation->hasError('silangan')) ? 'is-invalid' : ''; ?>" onclick="checksilangan(this.value);" value="0">
                                                    Rusak
                                                </div>
                                                <?php if ($validation->hasError('silangan')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('silangan'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checksilangan(b) {
                                                    var x = document.getElementsByClassName('checksilangan');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Rangka CNP</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('rangka_cnp') == "1") {
                                                                echo ("checked");
                                                            } ?> id="rangka_cnp" name="rangka_cnp" type="checkbox" class="checkrangka_cnp <?= ($validation->hasError('rangka_cnp')) ? 'is-invalid' : ''; ?>" onclick="checkrangka_cnp(this.value);" value="1">
                                                    Baik<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('rangka_cnp') == "0") {
                                                                echo ("checked");
                                                            } ?> id="rangka_cnp" name="rangka_cnp" type="checkbox" class="checkrangka_cnp <?= ($validation->hasError('rangka_cnp')) ? 'is-invalid' : ''; ?>" onclick="checkrangka_cnp(this.value);" value="0">
                                                    Rusak
                                                </div>
                                                <?php if ($validation->hasError('rangka_cnp')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('rangka_cnp'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkrangka_cnp(b) {
                                                    var x = document.getElementsByClassName('checkrangka_cnp');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Rangka UNP</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('rangka_unp') == "1") {
                                                                echo ("checked");
                                                            } ?> id="rangka_unp" name="rangka_unp" type="checkbox" class="checkrangka_unp <?= ($validation->hasError('rangka_unp')) ? 'is-invalid' : ''; ?>" onclick="checkrangka_unp(this.value);" value="1">
                                                    Baik<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('rangka_unp') == "0") {
                                                                echo ("checked");
                                                            } ?> id="rangka_unp" name="rangka_unp" type="checkbox" class="checkrangka_unp <?= ($validation->hasError('rangka_unp')) ? 'is-invalid' : ''; ?>" onclick="checkrangka_unp(this.value);" value="0">
                                                    Rusak
                                                </div>
                                                <?php if ($validation->hasError('rangka_unp')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('rangka_unp'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkrangka_unp(b) {
                                                    var x = document.getElementsByClassName('checkrangka_unp');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Handle</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('handle') == "1") {
                                                                echo ("checked");
                                                            } ?> id="handle" name="handle" type="checkbox" class="checkhandle <?= ($validation->hasError('handle')) ? 'is-invalid' : ''; ?>" onclick="checkhandle(this.value);" value="1">
                                                    Baik<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('handle') == "0") {
                                                                echo ("checked");
                                                            } ?> id="handle" name="handle" type="checkbox" class="checkhandle <?= ($validation->hasError('handle')) ? 'is-invalid' : ''; ?>" onclick="checkhandle(this.value);" value="0">
                                                    Rusak
                                                </div>
                                                <?php if ($validation->hasError('handle')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('handle'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkhandle(b) {
                                                    var x = document.getElementsByClassName('checkhandle');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Roda Bearing</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('roda_bearing') == "1") {
                                                                echo ("checked");
                                                            } ?> id="roda_bearing" name="roda_bearing" type="checkbox" class="checkroda_bearing <?= ($validation->hasError('roda_bearing')) ? 'is-invalid' : ''; ?>" onclick="checkroda_bearing(this.value);" value="1">
                                                    Baik<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('roda_bearing') == "0") {
                                                                echo ("checked");
                                                            } ?> id="roda_bearing" name="roda_bearing" type="checkbox" class="checkroda_bearing <?= ($validation->hasError('roda_bearing')) ? 'is-invalid' : ''; ?>" onclick="checkroda_bearing(this.value);" value="0">
                                                    Rusak
                                                </div>
                                                <?php if ($validation->hasError('roda_bearing')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('roda_bearing'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkroda_bearing(b) {
                                                    var x = document.getElementsByClassName('checkroda_bearing');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Rel</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('rel') == "1") {
                                                                echo ("checked");
                                                            } ?> id="rel" name="rel" type="checkbox" class="checkrel <?= ($validation->hasError('rel')) ? 'is-invalid' : ''; ?>" onclick="checkrel(this.value);" value="1">
                                                    Baik<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('rel') == "0") {
                                                                echo ("checked");
                                                            } ?> id="rel" name="rel" type="checkbox" class="checkrel <?= ($validation->hasError('rel')) ? 'is-invalid' : ''; ?>" onclick="checkrel(this.value);" value="0">
                                                    Rusak
                                                </div>
                                                <?php if ($validation->hasError('rel')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('rel'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkrel(b) {
                                                    var x = document.getElementsByClassName('checkrel');
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
                        <h3 class="card-title">Folding Gate</h3>
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
                                    <th class="text-center">Folding Gate<br>
                                        Name
                                    </th>
                                    <th>Kunci Set</th>
                                    <th>Daun</th>
                                    <th>Silangan</th>
                                    <th>Rangka CNP</th>
                                    <th>Rangka UNP</th>
                                    <th>Handle</th>
                                    <th class="text-center">Roda<br>
                                        Bearing
                                    </th>
                                    <th>Rel</th>
                                    <th>Jumlah Temuan</th>
                                    <th>Penjelasan</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $i = 1 ?>
                                <?php foreach ($getDataTableFoldingGate as $ts) : ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $ts['storeName']; ?></td>
                                        <td><?= dateView($ts['date']); ?></td>
                                        <td><?= $ts['initial']; ?></td>
                                        <td><?= $ts['name']; ?></td>
                                        <td><?= equipmentStatus($ts['kunci_set']); ?></td>
                                        <td><?= equipmentStatus($ts['daun']); ?></td>
                                        <td><?= equipmentStatus($ts['silangan']); ?></td>
                                        <td><?= equipmentStatus($ts['rangka_cnp']); ?></td>
                                        <td><?= equipmentStatus($ts['rangka_unp']); ?></td>
                                        <td><?= equipmentStatus($ts['handle']); ?></td>
                                        <td><?= equipmentStatus($ts['roda_bearing']); ?></td>
                                        <td><?= equipmentStatus($ts['rel']); ?></td>
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
                <h5 class="modal-title">Edit Data Folding Gate</h5>
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

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-3 row">
                                <label class="form-label col-3 col-form-label">Folding Gate Name</label>
                                <div class="col">
                                    <input type="text" class="form-control <?= ($validation->hasError('name')) ? 'is-invalid' : ''; ?>" id="name" name="name" placeholder="Folding Gate Name" value="<?= old('name'); ?>">
                                    <?php if ($validation->hasError('name')) : ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('name'); ?>
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
                                    <td class="col-3" rowspan="8">Inspeksi Folding Gate</td>
                                    <td class="col-4" style="padding-left: 8px;">Kunci Set</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('kunci_set') == "1") {
                                                        echo ("checked");
                                                    } ?> id="kunci_set" name="kunci_set" type="checkbox" class="checkkunci_setEdit <?= ($validation->hasError('kunci_set')) ? 'is-invalid' : ''; ?>" onclick="checkkunci_setEdit(this.value);" value="1">
                                            Baik<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('kunci_set') == "0") {
                                                        echo ("checked");
                                                    } ?> id="kunci_set" name="kunci_set" type="checkbox" class="checkkunci_setEdit <?= ($validation->hasError('kunci_set')) ? 'is-invalid' : ''; ?>" onclick="checkkunci_setEdit(this.value);" value="0">
                                            Rusak
                                        </div>
                                        <?php if ($validation->hasError('kunci_set')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('kunci_set'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkkunci_setEdit(b) {
                                            var x = document.getElementsByClassName('checkkunci_setEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Daun</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('daun') == "1") {
                                                        echo ("checked");
                                                    } ?> id="daun" name="daun" type="checkbox" class="checkdaunEdit <?= ($validation->hasError('daun')) ? 'is-invalid' : ''; ?>" onclick="checkdaunEdit(this.value);" value="1">
                                            Baik<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('daun') == "0") {
                                                        echo ("checked");
                                                    } ?> id="daun" name="daun" type="checkbox" class="checkdaunEdit <?= ($validation->hasError('daun')) ? 'is-invalid' : ''; ?>" onclick="checkdaunEdit(this.value);" value="0">
                                            Rusak
                                        </div>
                                        <?php if ($validation->hasError('daun')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('daun'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkdaunEdit(b) {
                                            var x = document.getElementsByClassName('checkdaunEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Silangan</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('silangan') == "1") {
                                                        echo ("checked");
                                                    } ?> id="silangan" name="silangan" type="checkbox" class="checksilanganEdit <?= ($validation->hasError('silangan')) ? 'is-invalid' : ''; ?>" onclick="checksilanganEdit(this.value);" value="1">
                                            Baik<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('silangan') == "0") {
                                                        echo ("checked");
                                                    } ?> id="silangan" name="silangan" type="checkbox" class="checksilanganEdit <?= ($validation->hasError('silangan')) ? 'is-invalid' : ''; ?>" onclick="checksilanganEdit(this.value);" value="0">
                                            Rusak
                                        </div>
                                        <?php if ($validation->hasError('silangan')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('silangan'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checksilanganEdit(b) {
                                            var x = document.getElementsByClassName('checksilanganEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Rangka CNP</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('rangka_cnp') == "1") {
                                                        echo ("checked");
                                                    } ?> id="rangka_cnp" name="rangka_cnp" type="checkbox" class="checkrangka_cnpEdit <?= ($validation->hasError('rangka_cnp')) ? 'is-invalid' : ''; ?>" onclick="checkrangka_cnpEdit(this.value);" value="1">
                                            Baik<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('rangka_cnp') == "0") {
                                                        echo ("checked");
                                                    } ?> id="rangka_cnp" name="rangka_cnp" type="checkbox" class="checkrangka_cnpEdit <?= ($validation->hasError('rangka_cnp')) ? 'is-invalid' : ''; ?>" onclick="checkrangka_cnpEdit(this.value);" value="0">
                                            Rusak
                                        </div>
                                        <?php if ($validation->hasError('rangka_cnp')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('rangka_cnp'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkrangka_cnpEdit(b) {
                                            var x = document.getElementsByClassName('checkrangka_cnpEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Rangka UNP</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('rangka_unp') == "1") {
                                                        echo ("checked");
                                                    } ?> id="rangka_unp" name="rangka_unp" type="checkbox" class="checkrangka_unpEdit <?= ($validation->hasError('rangka_unp')) ? 'is-invalid' : ''; ?>" onclick="checkrangka_unpEdit(this.value);" value="1">
                                            Baik<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('rangka_unp') == "0") {
                                                        echo ("checked");
                                                    } ?> id="rangka_unp" name="rangka_unp" type="checkbox" class="checkrangka_unpEdit <?= ($validation->hasError('rangka_unp')) ? 'is-invalid' : ''; ?>" onclick="checkrangka_unpEdit(this.value);" value="0">
                                            Rusak
                                        </div>
                                        <?php if ($validation->hasError('rangka_unp')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('rangka_unp'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkrangka_unpEdit(b) {
                                            var x = document.getElementsByClassName('checkrangka_unpEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Handle</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('handle') == "1") {
                                                        echo ("checked");
                                                    } ?> id="handle" name="handle" type="checkbox" class="checkhandleEdit <?= ($validation->hasError('handle')) ? 'is-invalid' : ''; ?>" onclick="checkhandleEdit(this.value);" value="1">
                                            Baik<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('handle') == "0") {
                                                        echo ("checked");
                                                    } ?> id="handle" name="handle" type="checkbox" class="checkhandleEdit <?= ($validation->hasError('handle')) ? 'is-invalid' : ''; ?>" onclick="checkhandleEdit(this.value);" value="0">
                                            Rusak
                                        </div>
                                        <?php if ($validation->hasError('handle')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('handle'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkhandleEdit(b) {
                                            var x = document.getElementsByClassName('checkhandleEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Roda Bearing</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('roda_bearing') == "1") {
                                                        echo ("checked");
                                                    } ?> id="roda_bearing" name="roda_bearing" type="checkbox" class="checkroda_bearingEdit <?= ($validation->hasError('roda_bearing')) ? 'is-invalid' : ''; ?>" onclick="checkroda_bearingEdit(this.value);" value="1">
                                            Baik<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('roda_bearing') == "0") {
                                                        echo ("checked");
                                                    } ?> id="roda_bearing" name="roda_bearing" type="checkbox" class="checkroda_bearingEdit <?= ($validation->hasError('roda_bearing')) ? 'is-invalid' : ''; ?>" onclick="checkroda_bearingEdit(this.value);" value="0">
                                            Rusak
                                        </div>
                                        <?php if ($validation->hasError('roda_bearing')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('roda_bearing'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkroda_bearingEdit(b) {
                                            var x = document.getElementsByClassName('checkroda_bearingEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Rel</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('rel') == "1") {
                                                        echo ("checked");
                                                    } ?> id="rel" name="rel" type="checkbox" class="checkrelEdit <?= ($validation->hasError('rel')) ? 'is-invalid' : ''; ?>" onclick="checkrelEdit(this.value);" value="1">
                                            Baik<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('rel') == "0") {
                                                        echo ("checked");
                                                    } ?> id="rel" name="rel" type="checkbox" class="checkrelEdit <?= ($validation->hasError('rel')) ? 'is-invalid' : ''; ?>" onclick="checkrelEdit(this.value);" value="0">
                                            Rusak
                                        </div>
                                        <?php if ($validation->hasError('rel')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('rel'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkrelEdit(b) {
                                            var x = document.getElementsByClassName('checkrelEdit');
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

        let urlUpdate = site_url + '/foldinggate/updateFoldingGate/';
        let urlAjaxData = site_url + '/foldinggate/ajaxDataFoldingGate/';
        let urlDelete = site_url + '/foldinggate/deleteFoldingGate/';
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
                        modalView.find("#kunci_set[value=" + data.data.kunci_set + "]").prop('checked', true);
                        modalView.find("#daun[value=" + data.data.daun + "]").prop('checked', true);
                        modalView.find("#silangan[value=" + data.data.silangan + "]").prop('checked', true);
                        modalView.find("#rangka_cnp[value=" + data.data.rangka_cnp + "]").prop('checked', true);
                        modalView.find("#rangka_unp[value=" + data.data.rangka_unp + "]").prop('checked', true);
                        modalView.find("#handle[value=" + data.data.handle + "]").prop('checked', true);
                        modalView.find("#roda_bearing[value=" + data.data.roda_bearing + "]").prop('checked', true);
                        modalView.find("#rel[value=" + data.data.rel + "]").prop('checked', true);
                        modalView.find("#name").val(data.data.name);
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