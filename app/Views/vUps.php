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
                        <h3 class="card-title">UPS</h3>
                    </div>

                    <div class="card-body">
                        <form id="formInputData" action="<?php echo base_url('ups/saveups'); ?>" method="post">
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

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-3 col-form-label">Merk</label>
                                        <div class="col">
                                            <input type="text" class="form-control <?= ($validation->hasError('merk')) ? 'is-invalid' : ''; ?>" id="merk" name="merk" placeholder="Merk" value="<?= old('merk'); ?>">
                                            <?php if ($validation->hasError('merk')) : ?>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('merk'); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-3 col-form-label">Type</label>
                                        <div class="col">
                                            <input type="text" class="form-control <?= ($validation->hasError('serial_number')) ? 'is-invalid' : ''; ?>" id="type" name="type" placeholder="Type" value="<?= old('type'); ?>">
                                            <?php if ($validation->hasError('serial_number')) : ?>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('serial_number'); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-3 col-form-label">Serial No</label>
                                        <div class="col">
                                            <input type="text" class="form-control <?= ($validation->hasError('serial_number')) ? 'is-invalid' : ''; ?>" id="serial_number" name="serial_number" placeholder="Serial Number" value="<?= old('serial_number'); ?>">
                                            <?php if ($validation->hasError('serial_number')) : ?>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('serial_number'); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
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

                                <div class="col-lg-6">
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-3 col-form-label">Lantai</label>
                                        <div class="col">
                                            <input type="text" class="form-control <?= ($validation->hasError('lokasi_lantai')) ? 'is-invalid' : ''; ?>" id="lokasi_lantai" name="lokasi_lantai" placeholder="Lantai" value="<?= old('lokasi_lantai'); ?>">
                                            <?php if ($validation->hasError('lokasi_lantai')) : ?>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('lokasi_lantai'); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-3 col-form-label">Ruang</label>
                                        <div class="col">
                                            <input type="text" class="form-control <?= ($validation->hasError('lokasi_ruang')) ? 'is-invalid' : ''; ?>" id="lokasi_ruang" name="lokasi_ruang" placeholder="Ruang" value="<?= old('lokasi_ruang'); ?>">
                                            <?php if ($validation->hasError('lokasi_ruang')) : ?>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('lokasi_ruang'); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-3 col-form-label">Peruntukan</label>
                                        <div class="col">
                                            <input type="text" class="form-control <?= ($validation->hasError('peruntukan')) ? 'is-invalid' : ''; ?>" id="peruntukan" name="peruntukan" placeholder="Peruntukan" value="<?= old('peruntukan'); ?>">
                                            <?php if ($validation->hasError('peruntukan')) : ?>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('peruntukan'); ?>
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
                                            <td rowspan="3">Tegangan</td>
                                            <td style="padding-left: 8px;">Input AC</td>
                                            <td>
                                                <div class="row" style="padding-top: 20px;">
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-3 row">
                                                            <div class="col">
                                                                <div class="input-icon mb-2">
                                                                    <input value="<?= old('tegangan_input'); ?>" class="form-control <?= ($validation->hasError('tegangan_input')) ? 'is-invalid' : ''; ?>" id="tegangan_input" name="tegangan_input">
                                                                    <?php if ($validation->hasError('tegangan_input')) : ?>
                                                                        <div style="font-size: 85.71428571%; color: #d63939;">
                                                                            <?= $validation->getError('tegangan_input'); ?>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding-left: 8px;">Output AC</td>
                                            <td>
                                                <div class="row" style="padding-top: 20px;">
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-3 row">
                                                            <div class="col">
                                                                <div class="input-icon mb-2">
                                                                    <input value="<?= old('tegangan_output'); ?>" class="form-control <?= ($validation->hasError('tegangan_output')) ? 'is-invalid' : ''; ?>" id="tegangan_output" name="tegangan_output">
                                                                    <?php if ($validation->hasError('tegangan_output')) : ?>
                                                                        <div style="font-size: 85.71428571%; color: #d63939;">
                                                                            <?= $validation->getError('tegangan_output'); ?>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding-left: 8px;">N - G</td>
                                            <td>
                                                <div class="row" style="padding-top: 20px;">
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-3 row">
                                                            <div class="col">
                                                                <div class="input-icon mb-2">
                                                                    <input value="<?= old('tegangan_n_g'); ?>" class="form-control <?= ($validation->hasError('tegangan_n_g')) ? 'is-invalid' : ''; ?>" id="tegangan_n_g" name="tegangan_n_g">
                                                                    <?php if ($validation->hasError('tegangan_n_g')) : ?>
                                                                        <div style="font-size: 85.71428571%; color: #d63939;">
                                                                            <?= $validation->getError('tegangan_n_g'); ?>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr style="border: 0;">
                                            <td style="border: 0;"></td>
                                            <td style="border: 0;"></td>
                                            <td style="border: 0;"></td>
                                        </tr>
                                        <tr>
                                            <td rowspan="2">Load</td>
                                            <td>Load %</td>
                                            <td>
                                                <div class="row" style="padding-top: 20px;">
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-3 row">
                                                            <div class="col">
                                                                <div class="input-icon mb-2">
                                                                    <input value="<?= old('load_percent'); ?>" class="form-control <?= ($validation->hasError('load_percent')) ? 'is-invalid' : ''; ?>" id="load_percent" name="load_percent">
                                                                    <?php if ($validation->hasError('load_percent')) : ?>
                                                                        <div style="font-size: 85.71428571%; color: #d63939;">
                                                                            <?= $validation->getError('load_percent'); ?>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                            <label class="form-label col-1 col-form-label">%</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding-left: 8px;">Load Amp</td>
                                            <td>
                                                <div class="row" style="padding-top: 20px;">
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-3 row">
                                                            <div class="col">
                                                                <div class="input-icon mb-2">
                                                                    <input value="<?= old('load_amp'); ?>" class="form-control <?= ($validation->hasError('load_amp')) ? 'is-invalid' : ''; ?>" id="load_amp" name="load_amp">
                                                                    <?php if ($validation->hasError('load_amp')) : ?>
                                                                        <div style="font-size: 85.71428571%; color: #d63939;">
                                                                            <?= $validation->getError('load_amp'); ?>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr style="border: 0;">
                                            <td style="border: 0;"></td>
                                            <td style="border: 0;"></td>
                                            <td style="border: 0;"></td>
                                        </tr>
                                        <tr>
                                            <td rowspan="4">Inspeksi</td>
                                            <td>Kebersihan</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('inspeksi_kebersihan') == "1") {
                                                                echo ("checked");
                                                            } ?> id="inspeksi_kebersihan" name="inspeksi_kebersihan" type="checkbox" class="checkKebersihan <?= ($validation->hasError('inspeksi_kebersihan')) ? 'is-invalid' : ''; ?>" onclick="checkKebersihan(this.value);" value="1">
                                                    Ya<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('inspeksi_kebersihan') == "0") {
                                                                echo ("checked");
                                                            } ?> id="inspeksi_kebersihan" name="inspeksi_kebersihan" type="checkbox" class="checkKebersihan <?= ($validation->hasError('inspeksi_kebersihan')) ? 'is-invalid' : ''; ?>" onclick="checkKebersihan(this.value);" value="0">
                                                    Tidak
                                                </div>
                                                <?php if ($validation->hasError('inspeksi_kebersihan')) : ?>
                                                    <div style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('inspeksi_kebersihan'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkKebersihan(b) {
                                                    var x = document.getElementsByClassName('checkKebersihan');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td style="padding-left: 8px;">Fan</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('inspeksi_fan') == "1") {
                                                                echo ("checked");
                                                            } ?> id="inspeksi_fan" name="inspeksi_fan" type="checkbox" class="fanCheck <?= ($validation->hasError('inspeksi_fan')) ? 'is-invalid' : ''; ?>" onclick="fanCheck(this.value);" value="1">
                                                    Ya<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('inspeksi_fan') == "0") {
                                                                echo ("checked");
                                                            } ?> id="inspeksi_fan" name="inspeksi_fan" type="checkbox" class="fanCheck <?= ($validation->hasError('inspeksi_fan')) ? 'is-invalid' : ''; ?>" onclick="fanCheck(this.value);" value="0">
                                                    Tidak
                                                </div>
                                                <?php if ($validation->hasError('inspeksi_fan')) : ?>
                                                    <div style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('inspeksi_fan'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function fanCheck(b) {
                                                    var x = document.getElementsByClassName('fanCheck');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td style="padding-left: 8px;">Suhu Ruang 24&deg;C - 27&deg;C</td>
                                            <td>
                                                <div class="row" style="padding-top: 20px;">
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-3 row">
                                                            <div class="col">
                                                                <div class="input-icon mb-2">
                                                                    <input value="<?= old('inspeksi_suhu'); ?>" class="form-control <?= ($validation->hasError('inspeksi_suhu')) ? 'is-invalid' : ''; ?>" id="inspeksi_suhu" name="inspeksi_suhu">
                                                                    <?php if ($validation->hasError('inspeksi_suhu')) : ?>
                                                                        <div style="font-size: 85.71428571%; color: #d63939;">
                                                                            <?= $validation->getError('inspeksi_suhu'); ?>
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
                                            <td style="padding-left: 8px;">Alarm</td>
                                            <td>
                                                <div class="row" style="padding-top: 20px;">
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-3 row">
                                                            <div class="col">
                                                                <div class="input-icon mb-2">
                                                                    <input value="<?= old('inspeksi_alarm'); ?>" class="form-control <?= ($validation->hasError('inspeksi_alarm')) ? 'is-invalid' : ''; ?>" id="inspeksi_alarm" name="inspeksi_alarm">
                                                                    <?php if ($validation->hasError('inspeksi_alarm')) : ?>
                                                                        <div style="font-size: 85.71428571%; color: #d63939;">
                                                                            <?= $validation->getError('inspeksi_alarm'); ?>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
                        <h3 class="card-title">UPS Data</h3>
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
                                    <th>Merk & Type</th>
                                    <th>Serial No</th>
                                    <th>Lantai</th>
                                    <th>Ruang</th>
                                    <th>Peruntukan</th>
                                    <th>Tegangan Input AC</th>
                                    <th>Tegangan Output AC</th>
                                    <th>Tegangan N-G</th>
                                    <th>Load %</th>
                                    <th>Load Amp</th>
                                    <th>Inspeksi Kebersihan</th>
                                    <th>Inspeksi Fan</th>
                                    <th>Inspeksi Suhu Ruang &deg;C</th>
                                    <th>Inspeksi Alarm</th>
                                    <th>Keterangan</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $i = 1 ?>
                                <?php foreach ($getDataTableUps as $ts) : ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $ts['storeName']; ?></td>
                                        <td><?= dateView($ts['date']); ?></td>
                                        <td><?= $ts['initial']; ?></td>
                                        <td><?= $ts['merk'] . '<br>' . $ts['type']; ?></td>
                                        <td><?= $ts['serial_number']; ?></td>
                                        <td><?= $ts['lokasi_lantai']; ?></td>
                                        <td><?= $ts['lokasi_ruang']; ?></td>
                                        <td><?= $ts['peruntukan']; ?></td>
                                        <td><?= $ts['tegangan_input']; ?></td>
                                        <td><?= $ts['tegangan_output']; ?></td>
                                        <td><?= $ts['tegangan_n_g']; ?></td>
                                        <td><?= $ts['load_percent']; ?></td>
                                        <td><?= $ts['load_amp']; ?></td>
                                        <td><?= hasilInspeksi($ts['inspeksi_kebersihan']); ?></td>
                                        <td><?= hasilInspeksi($ts['inspeksi_fan']); ?></td>
                                        <td><?= $ts['inspeksi_suhu']; ?></td>
                                        <td><?= $ts['inspeksi_alarm']; ?></td>
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
                                                    <a class="btn btn-outline-success btn-icon edit-icon" id="<?= $ts['id']; ?>" aria-label="EditData" data-bs-toggle="modal" data-bs-target="#modal-editUps">
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
<div class="modal modal-blur fade modal-edit" id="modal-editUps" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data UPS</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formEditUps" action="<?= base_url('ups/updateups') ?>" method="post">
                <input value="<?= old('idFormEdit') ?>" type="text" hidden readonly id="idFormEdit" name="idFormEdit">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-3 row">
                                <label class="form-label col-3 col-form-label">Location</label>
                                <div class="col">
                                    <div class="input-icon mb-2">
                                        <input id="location" class="form-control" value="" disabled>
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
                                        <input id="worker" class="form-control" value="" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="form-label col-3 col-form-label pt-0">Checklist</label>
                                <div class="col">
                                    <div class="form-floating">
                                        <select disabled id="equipment_checklist" name="equipment_checklist" class="form-select <?= ($validation->hasError('equipment_checklist')) ? 'is-invalid' : ''; ?>" required>
                                            <option <?= old('equipment_checklist') != null && old('equipment_checklist') == 'DAILY' ? 'selected' : ''; ?> value="DAILY">DAILY</option>
                                            <option <?= old('equipment_checklist') != null && old('equipment_checklist') == 'WEEKLY' ? 'selected' : ''; ?> value="WEEKLY">WEEKLY</option>
                                            <option <?= old('equipment_checklist') != null && old('equipment_checklist') == 'MONTHLY' ? 'selected' : ''; ?> value="MONTHLY">MONTHLY</option>
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
                                <label class="form-label col-3 col-form-label">Merk</label>
                                <div class="col">
                                    <input type="text" class="form-control <?= ($validation->hasError('merk')) ? 'is-invalid' : ''; ?>" id="merk" name="merk" placeholder="Merk" value="<?= old('merk'); ?>">
                                    <?php if ($validation->hasError('merk')) : ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('merk'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group mb-3 row">
                                <label class="form-label col-3 col-form-label">Type</label>
                                <div class="col">
                                    <input type="text" class="form-control <?= ($validation->hasError('serial_number')) ? 'is-invalid' : ''; ?>" id="type" name="type" placeholder="Type" value="<?= old('type'); ?>">
                                    <?php if ($validation->hasError('serial_number')) : ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('serial_number'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group mb-3 row">
                                <label class="form-label col-3 col-form-label">Serial No</label>
                                <div class="col">
                                    <input type="text" class="form-control <?= ($validation->hasError('serial_number')) ? 'is-invalid' : ''; ?>" id="serial_number" name="serial_number" placeholder="Serial Number" value="<?= old('serial_number'); ?>">
                                    <?php if ($validation->hasError('serial_number')) : ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('serial_number'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
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

                        <div class="col-lg-6">
                            <div class="form-group mb-3 row">
                                <label class="form-label col-3 col-form-label">Lantai</label>
                                <div class="col">
                                    <input type="text" class="form-control <?= ($validation->hasError('lokasi_lantai')) ? 'is-invalid' : ''; ?>" id="lokasi_lantai" name="lokasi_lantai" placeholder="Lantai" value="<?= old('lokasi_lantai'); ?>">
                                    <?php if ($validation->hasError('lokasi_lantai')) : ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('lokasi_lantai'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group mb-3 row">
                                <label class="form-label col-3 col-form-label">Ruang</label>
                                <div class="col">
                                    <input type="text" class="form-control <?= ($validation->hasError('lokasi_ruang')) ? 'is-invalid' : ''; ?>" id="lokasi_ruang" name="lokasi_ruang" placeholder="Ruang" value="<?= old('lokasi_ruang'); ?>">
                                    <?php if ($validation->hasError('lokasi_ruang')) : ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('lokasi_ruang'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group mb-3 row">
                                <label class="form-label col-3 col-form-label">Peruntukan</label>
                                <div class="col">
                                    <input type="text" class="form-control <?= ($validation->hasError('peruntukan')) ? 'is-invalid' : ''; ?>" id="peruntukan" name="peruntukan" placeholder="Peruntukan" value="<?= old('peruntukan'); ?>">
                                    <?php if ($validation->hasError('peruntukan')) : ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('peruntukan'); ?>
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
                                    <td rowspan="3">Tegangan</td>
                                    <td style="padding-left: 8px;">Input AC</td>
                                    <td>
                                        <div class="row" style="padding-top: 20px;">
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3 row">
                                                    <div class="col">
                                                        <div class="input-icon mb-2">
                                                            <input value="<?= old('tegangan_input'); ?>" class="form-control <?= ($validation->hasError('tegangan_input')) ? 'is-invalid' : ''; ?>" id="tegangan_input" name="tegangan_input">
                                                            <?php if ($validation->hasError('tegangan_input')) : ?>
                                                                <div style="font-size: 85.71428571%; color: #d63939;">
                                                                    <?= $validation->getError('tegangan_input'); ?>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-left: 8px;">Output AC</td>
                                    <td>
                                        <div class="row" style="padding-top: 20px;">
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3 row">
                                                    <div class="col">
                                                        <div class="input-icon mb-2">
                                                            <input value="<?= old('tegangan_output'); ?>" class="form-control <?= ($validation->hasError('tegangan_output')) ? 'is-invalid' : ''; ?>" id="tegangan_output" name="tegangan_output">
                                                            <?php if ($validation->hasError('tegangan_output')) : ?>
                                                                <div style="font-size: 85.71428571%; color: #d63939;">
                                                                    <?= $validation->getError('tegangan_output'); ?>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-left: 8px;">N - G</td>
                                    <td>
                                        <div class="row" style="padding-top: 20px;">
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3 row">
                                                    <div class="col">
                                                        <div class="input-icon mb-2">
                                                            <input value="<?= old('tegangan_n_g'); ?>" class="form-control <?= ($validation->hasError('tegangan_n_g')) ? 'is-invalid' : ''; ?>" id="tegangan_n_g" name="tegangan_n_g">
                                                            <?php if ($validation->hasError('tegangan_n_g')) : ?>
                                                                <div style="font-size: 85.71428571%; color: #d63939;">
                                                                    <?= $validation->getError('tegangan_n_g'); ?>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr style="border: 0;">
                                    <td style="border: 0;"></td>
                                    <td style="border: 0;"></td>
                                    <td style="border: 0;"></td>
                                </tr>
                                <tr>
                                    <td rowspan="2">Load</td>
                                    <td>Load %</td>
                                    <td>
                                        <div class="row" style="padding-top: 20px;">
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3 row">
                                                    <div class="col">
                                                        <div class="input-icon mb-2">
                                                            <input value="<?= old('load_percent'); ?>" class="form-control <?= ($validation->hasError('load_percent')) ? 'is-invalid' : ''; ?>" id="load_percent" name="load_percent">
                                                            <?php if ($validation->hasError('load_percent')) : ?>
                                                                <div style="font-size: 85.71428571%; color: #d63939;">
                                                                    <?= $validation->getError('load_percent'); ?>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    <label class="form-label col-1 col-form-label">%</label>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-left: 8px;">Load Amp</td>
                                    <td>
                                        <div class="row" style="padding-top: 20px;">
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3 row">
                                                    <div class="col">
                                                        <div class="input-icon mb-2">
                                                            <input value="<?= old('load_amp'); ?>" class="form-control <?= ($validation->hasError('load_amp')) ? 'is-invalid' : ''; ?>" id="load_amp" name="load_amp">
                                                            <?php if ($validation->hasError('load_amp')) : ?>
                                                                <div style="font-size: 85.71428571%; color: #d63939;">
                                                                    <?= $validation->getError('load_amp'); ?>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr style="border: 0;">
                                    <td style="border: 0;"></td>
                                    <td style="border: 0;"></td>
                                    <td style="border: 0;"></td>
                                </tr>
                                <tr>
                                    <td rowspan="4">Inspeksi</td>
                                    <td>Kebersihan</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('inspeksi_kebersihan') == "1") {
                                                        echo ("checked");
                                                    } ?> id="inspeksi_kebersihan" name="inspeksi_kebersihan" type="checkbox" class="checkKebersihanEdit <?= ($validation->hasError('inspeksi_kebersihan')) ? 'is-invalid' : ''; ?>" onclick="checkKebersihanEdit(this.value);" value="1">
                                            Ya<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('inspeksi_kebersihan') == "0") {
                                                        echo ("checked");
                                                    } ?> id="inspeksi_kebersihan" name="inspeksi_kebersihan" type="checkbox" class="checkKebersihanEdit <?= ($validation->hasError('inspeksi_kebersihan')) ? 'is-invalid' : ''; ?>" onclick="checkKebersihanEdit(this.value);" value="0">
                                            Tidak
                                        </div>
                                        <?php if ($validation->hasError('inspeksi_kebersihan')) : ?>
                                            <div style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('inspeksi_kebersihan'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkKebersihanEdit(b) {
                                            var x = document.getElementsByClassName('checkKebersihanEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td style="padding-left: 8px;">Fan</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('inspeksi_fan') == "1") {
                                                        echo ("checked");
                                                    } ?> id="inspeksi_fan" name="inspeksi_fan" type="checkbox" class="fanCheckEdit <?= ($validation->hasError('inspeksi_fan')) ? 'is-invalid' : ''; ?>" onclick="fanCheckEdit(this.value);" value="1">
                                            Ya<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('inspeksi_fan') == "0") {
                                                        echo ("checked");
                                                    } ?> id="inspeksi_fan" name="inspeksi_fan" type="checkbox" class="fanCheckEdit <?= ($validation->hasError('inspeksi_fan')) ? 'is-invalid' : ''; ?>" onclick="fanCheckEdit(this.value);" value="0">
                                            Tidak
                                        </div>
                                        <?php if ($validation->hasError('inspeksi_fan')) : ?>
                                            <div style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('inspeksi_fan'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function fanCheckEdit(b) {
                                            var x = document.getElementsByClassName('fanCheckEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td style="padding-left: 8px;">Suhu Ruang 24&deg;C - 27&deg;C</td>
                                    <td>
                                        <div class="row" style="padding-top: 20px;">
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3 row">
                                                    <div class="col">
                                                        <div class="input-icon mb-2">
                                                            <input value="<?= old('inspeksi_suhu'); ?>" class="form-control <?= ($validation->hasError('inspeksi_suhu')) ? 'is-invalid' : ''; ?>" id="inspeksi_suhu" name="inspeksi_suhu">
                                                            <?php if ($validation->hasError('inspeksi_suhu')) : ?>
                                                                <div style="font-size: 85.71428571%; color: #d63939;">
                                                                    <?= $validation->getError('inspeksi_suhu'); ?>
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
                                    <td style="padding-left: 8px;">Alarm</td>
                                    <td>
                                        <div class="row" style="padding-top: 20px;">
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3 row">
                                                    <div class="col">
                                                        <div class="input-icon mb-2">
                                                            <input value="<?= old('inspeksi_alarm'); ?>" class="form-control <?= ($validation->hasError('inspeksi_alarm')) ? 'is-invalid' : ''; ?>" id="inspeksi_alarm" name="inspeksi_alarm">
                                                            <?php if ($validation->hasError('inspeksi_alarm')) : ?>
                                                                <div style="font-size: 85.71428571%; color: #d63939;">
                                                                    <?= $validation->getError('inspeksi_alarm'); ?>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
            $("#formEditData").attr('action', site_url + "/ups/updateups/" + oldData.post.idFormEdit);

            $("#formInputData").find("input:text, textarea").not("#location,#date,#worker").val("");
            $("#formInputData").find("input:checkbox").prop('checked', false);
            $("#formInputData").find(".is-invalid").removeClass("is-invalid");
            $("#formInputData").find(".invalid-feedback,.hasil-validasi").hide();
        }

        //? modal edit
        $(".edit-icon").click(function() {
            var modalView = $("#modal-editUps");
            modalView.find("input:text").val("");
            modalView.find("input:checkbox").prop('checked', false);
            $("#formEditUps").attr('action', site_url + "/ups/updateups/" + this.id);
            modalView.find(".is-invalid").removeClass("is-invalid");
            modalView.find(".invalid-feedback,.hasil-validasi").hide();

            inputData = new FormData();
            inputData.append("id", this.id);

            $.ajax({
                url: "<?= base_url('ups/ajaxDataUps') ?>",
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
                        // modalView.find("#time[value='" + data.data.time + "']").prop('checked', true);
                        // modalView.find("#timeValue").val(data.data.time);
                        modalView.find("#date").val(data.data.date);
                        modalView.find("#worker").val(data.data.initial);
                        modalView.find("#location").val(data.data.storeName);
                        modalView.find("#merk").val(data.data.merk);
                        modalView.find("#type").val(data.data.type);
                        modalView.find("#serial_number").val(data.data.serial_number);
                        modalView.find("#keterangan").val(data.data.keterangan);
                        modalView.find("#lokasi_lantai").val(data.data.lokasi_lantai);
                        modalView.find("#lokasi_ruang").val(data.data.lokasi_ruang);
                        modalView.find("#peruntukan").val(data.data.peruntukan);
                        modalView.find("#tegangan_input").val(data.data.tegangan_input);
                        modalView.find("#tegangan_output").val(data.data.tegangan_output);
                        modalView.find("#tegangan_n_g").val(data.data.tegangan_n_g);
                        modalView.find("#load_percent").val(data.data.load_percent);
                        modalView.find("#load_amp").val(data.data.load_amp);
                        modalView.find("#inspeksi_suhu").val(data.data.inspeksi_suhu);
                        modalView.find("#inspeksi_alarm").val(data.data.inspeksi_alarm);
                        modalView.find("#inspeksi_kebersihan[value=" + data.data.inspeksi_kebersihan + "]").prop('checked', true);
                        modalView.find("#inspeksi_fan[value=" + data.data.inspeksi_fan + "]").prop('checked', true);
                        modalView.find("#equipment_checklist option[value=" + data.data.equipment_checklist + "]").prop('selected', true);
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
                        url: "<?= base_url('ups/deleteups') ?>",
                        type: "POST",
                        data: deleteData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        // dataType: "JSON",
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            window.scrollTo(0,0);
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