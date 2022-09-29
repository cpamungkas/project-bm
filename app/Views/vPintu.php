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
                        <h3 class="card-title">Pintu</h3>
                    </div>

                    <div class="card-body">
                        <form id="formInputData" action="<?php echo base_url('pintu/savePintu'); ?>" method="post">
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

                                    <?php 
                                        generateChecklistTime($defaultChecklist['checklist'], $checkInspection);
                                    ?>

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
                                            <td class="col-3" rowspan="5">Inspeksi Pintu</td>
                                            <td class="col-4" style="padding-left: 8px;">Cat</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('cat') == "1") {
                                                                echo ("checked");
                                                            } ?> id="cat" name="cat" type="checkbox" class="checkcat <?= ($validation->hasError('cat')) ? 'is-invalid' : ''; ?>" onclick="checkcat(this.value);" value="1">
                                                    Baik<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('cat') == "0") {
                                                                echo ("checked");
                                                            } ?> id="cat" name="cat" type="checkbox" class="checkcat <?= ($validation->hasError('cat')) ? 'is-invalid' : ''; ?>" onclick="checkcat(this.value);" value="0">
                                                    Rusak
                                                </div>
                                                <?php if ($validation->hasError('cat')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('cat'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkcat(b) {
                                                    var x = document.getElementsByClassName('checkcat');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Kunci</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('kunci') == "1") {
                                                                echo ("checked");
                                                            } ?> id="kunci" name="kunci" type="checkbox" class="checkkunci <?= ($validation->hasError('kunci')) ? 'is-invalid' : ''; ?>" onclick="checkkunci(this.value);" value="1">
                                                    Baik<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('kunci') == "0") {
                                                                echo ("checked");
                                                            } ?> id="kunci" name="kunci" type="checkbox" class="checkkunci <?= ($validation->hasError('kunci')) ? 'is-invalid' : ''; ?>" onclick="checkkunci(this.value);" value="0">
                                                    Rusak
                                                </div>
                                                <?php if ($validation->hasError('kunci')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('kunci'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkkunci(b) {
                                                    var x = document.getElementsByClassName('checkkunci');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Kusen</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('kusen') == "1") {
                                                                echo ("checked");
                                                            } ?> id="kusen" name="kusen" type="checkbox" class="checkkusen <?= ($validation->hasError('kusen')) ? 'is-invalid' : ''; ?>" onclick="checkkusen(this.value);" value="1">
                                                    Baik<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('kusen') == "0") {
                                                                echo ("checked");
                                                            } ?> id="kusen" name="kusen" type="checkbox" class="checkkusen <?= ($validation->hasError('kusen')) ? 'is-invalid' : ''; ?>" onclick="checkkusen(this.value);" value="0">
                                                    Rusak
                                                </div>
                                                <?php if ($validation->hasError('kusen')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('kusen'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkkusen(b) {
                                                    var x = document.getElementsByClassName('checkkusen');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Handle Pintu</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('handle_pintu') == "1") {
                                                                echo ("checked");
                                                            } ?> id="handle_pintu" name="handle_pintu" type="checkbox" class="checkhandle_pintu <?= ($validation->hasError('handle_pintu')) ? 'is-invalid' : ''; ?>" onclick="checkhandle_pintu(this.value);" value="1">
                                                    Baik<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('handle_pintu') == "0") {
                                                                echo ("checked");
                                                            } ?> id="handle_pintu" name="handle_pintu" type="checkbox" class="checkhandle_pintu <?= ($validation->hasError('handle_pintu')) ? 'is-invalid' : ''; ?>" onclick="checkhandle_pintu(this.value);" value="0">
                                                    Rusak
                                                </div>
                                                <?php if ($validation->hasError('handle_pintu')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('handle_pintu'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkhandle_pintu(b) {
                                                    var x = document.getElementsByClassName('checkhandle_pintu');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Engsel</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('engsel') == "1") {
                                                                echo ("checked");
                                                            } ?> id="engsel" name="engsel" type="checkbox" class="checkengsel <?= ($validation->hasError('engsel')) ? 'is-invalid' : ''; ?>" onclick="checkengsel(this.value);" value="1">
                                                    Baik<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('engsel') == "0") {
                                                                echo ("checked");
                                                            } ?> id="engsel" name="engsel" type="checkbox" class="checkengsel <?= ($validation->hasError('engsel')) ? 'is-invalid' : ''; ?>" onclick="checkengsel(this.value);" value="0">
                                                    Rusak
                                                </div>
                                                <?php if ($validation->hasError('engsel')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('engsel'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkengsel(b) {
                                                    var x = document.getElementsByClassName('checkengsel');
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
                        <h3 class="card-title">Pintu</h3>
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
                                    <th>Lantai</th>
                                    <th>Ruang</th>
                                    <th>Cat</th>
                                    <th>Kunci</th>
                                    <th>Kusen</th>
                                    <th>Handle Pintu</th>
                                    <th>Engsel</th>
                                    <th>Jumlah Temuan</th>
                                    <th>Penjelasan</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $i = 1 ?>
                                <?php foreach ($getDataTablePintu as $ts) : ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $ts['storeName']; ?></td>
                                        <td><?= dateView($ts['date']); ?></td>
                                        <td><?= $ts['initial']; ?></td>
                                        <td><?= $ts['lantai']; ?></td>
                                        <td><?= $ts['ruang']; ?></td>
                                        <td><?= equipmentStatus($ts['cat']); ?></td>
                                        <td><?= equipmentStatus($ts['kunci']); ?></td>
                                        <td><?= equipmentStatus($ts['kusen']); ?></td>
                                        <td><?= equipmentStatus($ts['handle_pintu']); ?></td>
                                        <td><?= equipmentStatus($ts['engsel']); ?></td>
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
                <h5 class="modal-title">Edit Data Pintu</h5>
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
                                        <input class="form-control" value="<?= old('location') ?>" id="location" name="location" disabled>
                                    </div>
                                </div>
                            </div>

                            <?php 
                                generateChecklistTime($defaultChecklist['checklist'], $checkInspection, null, TRUE);
                            ?>

                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3 row">
                                <label class="form-label col-3 col-form-label">Date</label>
                                <div class="col">
                                    <div class="input-icon mb-2">
                                        <input id="date" name="date" class="form-control" value="<?= old('date') ?>" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3 row">
                                <label class="form-label col-3 col-form-label">Worker</label>
                                <div class="col">
                                    <div class="input-icon mb-2">
                                        <input id="worker" name="worker" class="form-control" value="<?= old('worker') ?>" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="form-label col-3 col-form-label pt-0">Checklist</label>
                                <div class="col">
                                    <div class="input-icon mb-2">
                                        <input id="equipment_checklist" name="equipment_checklist" class="form-control" value="<?= old('equipment_checklist') ?>" disabled>
                                    </div>
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
                                    <td class="col-3" rowspan="5">Inspeksi Pintu</td>
                                    <td class="col-4" style="padding-left: 8px;">Cat</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('cat') == "1") {
                                                        echo ("checked");
                                                    } ?> id="cat" name="cat" type="checkbox" class="checkcatEdit <?= ($validation->hasError('cat')) ? 'is-invalid' : ''; ?>" onclick="checkcatEdit(this.value);" value="1">
                                            Baik<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('cat') == "0") {
                                                        echo ("checked");
                                                    } ?> id="cat" name="cat" type="checkbox" class="checkcatEdit <?= ($validation->hasError('cat')) ? 'is-invalid' : ''; ?>" onclick="checkcatEdit(this.value);" value="0">
                                            Rusak
                                        </div>
                                        <?php if ($validation->hasError('cat')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('cat'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkcatEdit(b) {
                                            var x = document.getElementsByClassName('checkcatEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Kunci</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('kunci') == "1") {
                                                        echo ("checked");
                                                    } ?> id="kunci" name="kunci" type="checkbox" class="checkkunciEdit <?= ($validation->hasError('kunci')) ? 'is-invalid' : ''; ?>" onclick="checkkunciEdit(this.value);" value="1">
                                            Baik<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('kunci') == "0") {
                                                        echo ("checked");
                                                    } ?> id="kunci" name="kunci" type="checkbox" class="checkkunciEdit <?= ($validation->hasError('kunci')) ? 'is-invalid' : ''; ?>" onclick="checkkunciEdit(this.value);" value="0">
                                            Rusak
                                        </div>
                                        <?php if ($validation->hasError('kunci')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('kunci'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkkunciEdit(b) {
                                            var x = document.getElementsByClassName('checkkunciEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Kusen</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('kusen') == "1") {
                                                        echo ("checked");
                                                    } ?> id="kusen" name="kusen" type="checkbox" class="checkkusenEdit <?= ($validation->hasError('kusen')) ? 'is-invalid' : ''; ?>" onclick="checkkusenEdit(this.value);" value="1">
                                            Baik<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('kusen') == "0") {
                                                        echo ("checked");
                                                    } ?> id="kusen" name="kusen" type="checkbox" class="checkkusenEdit <?= ($validation->hasError('kusen')) ? 'is-invalid' : ''; ?>" onclick="checkkusenEdit(this.value);" value="0">
                                            Rusak
                                        </div>
                                        <?php if ($validation->hasError('kusen')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('kusen'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkkusenEdit(b) {
                                            var x = document.getElementsByClassName('checkkusenEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Handle Pintu</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('handle_pintu') == "1") {
                                                        echo ("checked");
                                                    } ?> id="handle_pintu" name="handle_pintu" type="checkbox" class="checkhandle_pintuEdit <?= ($validation->hasError('handle_pintu')) ? 'is-invalid' : ''; ?>" onclick="checkhandle_pintuEdit(this.value);" value="1">
                                            Baik<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('handle_pintu') == "0") {
                                                        echo ("checked");
                                                    } ?> id="handle_pintu" name="handle_pintu" type="checkbox" class="checkhandle_pintuEdit <?= ($validation->hasError('handle_pintu')) ? 'is-invalid' : ''; ?>" onclick="checkhandle_pintuEdit(this.value);" value="0">
                                            Rusak
                                        </div>
                                        <?php if ($validation->hasError('handle_pintu')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('handle_pintu'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkhandle_pintuEdit(b) {
                                            var x = document.getElementsByClassName('checkhandle_pintuEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Engsel</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('engsel') == "1") {
                                                        echo ("checked");
                                                    } ?> id="engsel" name="engsel" type="checkbox" class="checkengselEdit <?= ($validation->hasError('engsel')) ? 'is-invalid' : ''; ?>" onclick="checkengselEdit(this.value);" value="1">
                                            Baik<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('engsel') == "0") {
                                                        echo ("checked");
                                                    } ?> id="engsel" name="engsel" type="checkbox" class="checkengselEdit <?= ($validation->hasError('engsel')) ? 'is-invalid' : ''; ?>" onclick="checkengselEdit(this.value);" value="0">
                                            Rusak
                                        </div>
                                        <?php if ($validation->hasError('engsel')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('engsel'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkengselEdit(b) {
                                            var x = document.getElementsByClassName('checkengselEdit');
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

        let urlUpdate = site_url + '/pintu/updatePintu/';
        let urlAjaxData = site_url + '/pintu/ajaxDataPintu/';
        let urlDelete = site_url + '/pintu/deletePintu/';
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

        $('#formEditData').on('submit', function() {
            $('input').prop('disabled', false);
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
                        modalView.find("#equipment_checklist").val(data.data.equipment_checklist);
                        modalView.find("#timeValue").val(data.data.time);
                        modalView.find("#date").val(data.data.date);
                        modalView.find("#worker").val(data.data.initial);
                        modalView.find("#location").val(data.data.storeName);
                        // modalView.find("#equipment_checklist option[value=" + data.data.equipment_checklist + "]").prop('selected', true);
                        modalView.find("#cat[value=" + data.data.cat + "]").prop('checked', true);
                        modalView.find("#kunci[value=" + data.data.kunci + "]").prop('checked', true);
                        modalView.find("#kusen[value=" + data.data.kusen + "]").prop('checked', true);
                        modalView.find("#handle_pintu[value=" + data.data.handle_pintu + "]").prop('checked', true);
                        modalView.find("#engsel[value=" + data.data.engsel + "]").prop('checked', true);
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