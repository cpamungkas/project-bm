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
                        <h3 class="card-title">Sewage Treatment Plant</h3>
                    </div>

                    <div class="card-body">
                        <form id="formInputData" action="<?php echo base_url('stp/saveStp'); ?>" method="post">
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
                                            <div class="form-check">
                                                <input <?= timeCheck("13:00:00", $checkInspection)?> <?php if (old('time') == "13:00:00") {
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
                                            <td class="col-3" rowspan="10">Sewage Treatment Plant</td>
                                            <td class="col-4" style="padding-left: 8px;">Blower 1</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('blower1') == "1") {
                                                                echo ("checked");
                                                            } ?> id="blower1" name="blower1" type="checkbox" class="checkBlower1 <?= ($validation->hasError('blower1')) ? 'is-invalid' : ''; ?>" onclick="checkBlower1(this.value);" value="1">
                                                    Auto<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('blower1') == "0") {
                                                                echo ("checked");
                                                            } ?> id="blower1" name="blower1" type="checkbox" class="checkBlower1 <?= ($validation->hasError('blower1')) ? 'is-invalid' : ''; ?>" onclick="checkBlower1(this.value);" value="0">
                                                    Manual
                                                </div>
                                                <?php if ($validation->hasError('blower1')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('blower1'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkBlower1(b) {
                                                    var x = document.getElementsByClassName('checkBlower1');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Blower 2</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('blower2') == "1") {
                                                                echo ("checked");
                                                            } ?> id="blower2" name="blower2" type="checkbox" class="checkblower2 <?= ($validation->hasError('blower2')) ? 'is-invalid' : ''; ?>" onclick="checkblower2(this.value);" value="1">
                                                    Auto<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('blower2') == "0") {
                                                                echo ("checked");
                                                            } ?> id="blower2" name="blower2" type="checkbox" class="checkblower2 <?= ($validation->hasError('blower2')) ? 'is-invalid' : ''; ?>" onclick="checkblower2(this.value);" value="0">
                                                    Manual
                                                </div>
                                                <?php if ($validation->hasError('blower2')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('blower2'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkblower2(b) {
                                                    var x = document.getElementsByClassName('checkblower2');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Transfer Pump 1</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('transfer_pump1') == "1") {
                                                                echo ("checked");
                                                            } ?> id="transfer_pump1" name="transfer_pump1" type="checkbox" class="checktransfer_pump1 <?= ($validation->hasError('transfer_pump1')) ? 'is-invalid' : ''; ?>" onclick="checktransfer_pump1(this.value);" value="1">
                                                    Auto<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('transfer_pump1') == "0") {
                                                                echo ("checked");
                                                            } ?> id="transfer_pump1" name="transfer_pump1" type="checkbox" class="checktransfer_pump1 <?= ($validation->hasError('transfer_pump1')) ? 'is-invalid' : ''; ?>" onclick="checktransfer_pump1(this.value);" value="0">
                                                    Manual
                                                </div>
                                                <?php if ($validation->hasError('transfer_pump1')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('transfer_pump1'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checktransfer_pump1(b) {
                                                    var x = document.getElementsByClassName('checktransfer_pump1');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Transfer Pump 2</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('transfer_pump2') == "1") {
                                                                echo ("checked");
                                                            } ?> id="transfer_pump2" name="transfer_pump2" type="checkbox" class="checktransfer_pump2 <?= ($validation->hasError('transfer_pump2')) ? 'is-invalid' : ''; ?>" onclick="checktransfer_pump2(this.value);" value="1">
                                                    Auto<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('transfer_pump2') == "0") {
                                                                echo ("checked");
                                                            } ?> id="transfer_pump2" name="transfer_pump2" type="checkbox" class="checktransfer_pump2 <?= ($validation->hasError('transfer_pump2')) ? 'is-invalid' : ''; ?>" onclick="checktransfer_pump2(this.value);" value="0">
                                                    Manual
                                                </div>
                                                <?php if ($validation->hasError('transfer_pump2')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('transfer_pump2'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checktransfer_pump2(b) {
                                                    var x = document.getElementsByClassName('checktransfer_pump2');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Effluent Pump 1</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('effluent_pump1') == "1") {
                                                                echo ("checked");
                                                            } ?> id="effluent_pump1" name="effluent_pump1" type="checkbox" class="checkeffluent_pump1 <?= ($validation->hasError('effluent_pump1')) ? 'is-invalid' : ''; ?>" onclick="checkeffluent_pump1(this.value);" value="1">
                                                    Auto<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('effluent_pump1') == "0") {
                                                                echo ("checked");
                                                            } ?> id="effluent_pump1" name="effluent_pump1" type="checkbox" class="checkeffluent_pump1 <?= ($validation->hasError('effluent_pump1')) ? 'is-invalid' : ''; ?>" onclick="checkeffluent_pump1(this.value);" value="0">
                                                    Manual
                                                </div>
                                                <?php if ($validation->hasError('effluent_pump1')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('effluent_pump1'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkeffluent_pump1(b) {
                                                    var x = document.getElementsByClassName('checkeffluent_pump1');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Effluent Pump 2</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('effluent_pump2') == "1") {
                                                                echo ("checked");
                                                            } ?> id="effluent_pump2" name="effluent_pump2" type="checkbox" class="checkeffluent_pump2 <?= ($validation->hasError('effluent_pump2')) ? 'is-invalid' : ''; ?>" onclick="checkeffluent_pump2(this.value);" value="1">
                                                    Auto<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('effluent_pump2') == "0") {
                                                                echo ("checked");
                                                            } ?> id="effluent_pump2" name="effluent_pump2" type="checkbox" class="checkeffluent_pump2 <?= ($validation->hasError('effluent_pump2')) ? 'is-invalid' : ''; ?>" onclick="checkeffluent_pump2(this.value);" value="0">
                                                    Manual
                                                </div>
                                                <?php if ($validation->hasError('effluent_pump2')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('effluent_pump2'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkeffluent_pump2(b) {
                                                    var x = document.getElementsByClassName('checkeffluent_pump2');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Equalizing Pump 1</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('equalizing_pump1') == "1") {
                                                                echo ("checked");
                                                            } ?> id="equalizing_pump1" name="equalizing_pump1" type="checkbox" class="checkequalizing_pump1 <?= ($validation->hasError('equalizing_pump1')) ? 'is-invalid' : ''; ?>" onclick="checkequalizing_pump1(this.value);" value="1">
                                                    Auto<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('equalizing_pump1') == "0") {
                                                                echo ("checked");
                                                            } ?> id="equalizing_pump1" name="equalizing_pump1" type="checkbox" class="checkequalizing_pump1 <?= ($validation->hasError('equalizing_pump1')) ? 'is-invalid' : ''; ?>" onclick="checkequalizing_pump1(this.value);" value="0">
                                                    Manual
                                                </div>
                                                <?php if ($validation->hasError('equalizing_pump1')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('equalizing_pump1'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkequalizing_pump1(b) {
                                                    var x = document.getElementsByClassName('checkequalizing_pump1');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Equalizing Pump 2</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('equalizing_pump2') == "1") {
                                                                echo ("checked");
                                                            } ?> id="equalizing_pump2" name="equalizing_pump2" type="checkbox" class="checkequalizing_pump2 <?= ($validation->hasError('equalizing_pump2')) ? 'is-invalid' : ''; ?>" onclick="checkequalizing_pump2(this.value);" value="1">
                                                    Auto<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('equalizing_pump2') == "0") {
                                                                echo ("checked");
                                                            } ?> id="equalizing_pump2" name="equalizing_pump2" type="checkbox" class="checkequalizing_pump2 <?= ($validation->hasError('equalizing_pump2')) ? 'is-invalid' : ''; ?>" onclick="checkequalizing_pump2(this.value);" value="0">
                                                    Manual
                                                </div>
                                                <?php if ($validation->hasError('equalizing_pump2')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('equalizing_pump2'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkequalizing_pump2(b) {
                                                    var x = document.getElementsByClassName('checkequalizing_pump2');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Filter Pump 1</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('filter_pump1') == "1") {
                                                                echo ("checked");
                                                            } ?> id="filter_pump1" name="filter_pump1" type="checkbox" class="checkfilter_pump1 <?= ($validation->hasError('filter_pump1')) ? 'is-invalid' : ''; ?>" onclick="checkfilter_pump1(this.value);" value="1">
                                                    Auto<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('filter_pump1') == "0") {
                                                                echo ("checked");
                                                            } ?> id="filter_pump1" name="filter_pump1" type="checkbox" class="checkfilter_pump1 <?= ($validation->hasError('filter_pump1')) ? 'is-invalid' : ''; ?>" onclick="checkfilter_pump1(this.value);" value="0">
                                                    Manual
                                                </div>
                                                <?php if ($validation->hasError('filter_pump1')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('filter_pump1'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkfilter_pump1(b) {
                                                    var x = document.getElementsByClassName('checkfilter_pump1');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Filter Pump 2</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('filter_pump2') == "1") {
                                                                echo ("checked");
                                                            } ?> id="filter_pump2" name="filter_pump2" type="checkbox" class="checkfilter_pump2 <?= ($validation->hasError('filter_pump2')) ? 'is-invalid' : ''; ?>" onclick="checkfilter_pump2(this.value);" value="1">
                                                    Auto<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('filter_pump2') == "0") {
                                                                echo ("checked");
                                                            } ?> id="filter_pump2" name="filter_pump2" type="checkbox" class="checkfilter_pump2 <?= ($validation->hasError('filter_pump2')) ? 'is-invalid' : ''; ?>" onclick="checkfilter_pump2(this.value);" value="0">
                                                    Manual
                                                </div>
                                                <?php if ($validation->hasError('filter_pump2')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('filter_pump2'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkfilter_pump2(b) {
                                                    var x = document.getElementsByClassName('checkfilter_pump2');
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
                                        <label class="form-label col-3 col-form-label">Dozing Pump</label>
                                        <div class="col">
                                            <div class="form-check">
                                                <input <?php if (old('dozing_pump') == "1") {
                                                            echo ("checked");
                                                        } ?> id="dozing_pump" name="dozing_pump" type="checkbox" class="checkdozing_pump form-check-input <?= ($validation->hasError('dozing_pump')) ? 'is-invalid' : ''; ?>" onclick="checkdozing_pump(this.value);" value="1">
                                                <span class="form-check-label">Auto</span>
                                            </div>
                                            <div class="form-check">
                                                <input <?php if (old('dozing_pump') == "0") {
                                                            echo ("checked");
                                                        } ?> id="dozing_pump" name="dozing_pump" type="checkbox" class="checkdozing_pump form-check-input <?= ($validation->hasError('dozing_pump')) ? 'is-invalid' : ''; ?>" onclick="checkdozing_pump(this.value);" value="0">
                                                <span class="form-check-label">Manual</span>
                                            </div>
                                            <?php if ($validation->hasError('dozing_pump')) : ?>
                                                <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                    <?= $validation->getError('dozing_pump'); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <script>
                                            function checkdozing_pump(b) {
                                                var x = document.getElementsByClassName('checkdozing_pump');
                                                var i;

                                                for (i = 0; i < x.length; i++) {
                                                    if (x[i].value != b) x[i].checked = false;
                                                }
                                            }
                                        </script>
                                    </div>
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-3 col-form-label">Fresh Air Fan</label>
                                        <div class="col">
                                            <div class="form-check">
                                                <input <?php if (old('fresh_air_fan') == "1") {
                                                            echo ("checked");
                                                        } ?> id="fresh_air_fan" name="fresh_air_fan" type="checkbox" class="checkfresh_air_fan form-check-input <?= ($validation->hasError('fresh_air_fan')) ? 'is-invalid' : ''; ?>" onclick="checkfresh_air_fan(this.value);" value="1">
                                                <span class="form-check-label">On</span>
                                            </div>
                                            <div class="form-check">
                                                <input <?php if (old('fresh_air_fan') == "0") {
                                                            echo ("checked");
                                                        } ?> id="fresh_air_fan" name="fresh_air_fan" type="checkbox" class="checkfresh_air_fan form-check-input <?= ($validation->hasError('fresh_air_fan')) ? 'is-invalid' : ''; ?>" onclick="checkfresh_air_fan(this.value);" value="0">
                                                <span class="form-check-label">Off</span>
                                            </div>
                                            <?php if ($validation->hasError('fresh_air_fan')) : ?>
                                                <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                    <?= $validation->getError('fresh_air_fan'); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <script>
                                            function checkfresh_air_fan(b) {
                                                var x = document.getElementsByClassName('checkfresh_air_fan');
                                                var i;

                                                for (i = 0; i < x.length; i++) {
                                                    if (x[i].value != b) x[i].checked = false;
                                                }
                                            }
                                        </script>
                                    </div>
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-3 col-form-label">Exhaust Fan</label>
                                        <div class="col">
                                            <div class="form-check">
                                                <input <?php if (old('exhaust_fan') == "1") {
                                                            echo ("checked");
                                                        } ?> id="exhaust_fan" name="exhaust_fan" type="checkbox" class="checkexhaust_fan form-check-input <?= ($validation->hasError('exhaust_fan')) ? 'is-invalid' : ''; ?>" onclick="checkexhaust_fan(this.value);" value="1">
                                                <span class="form-check-label">On</span>
                                            </div>
                                            <div class="form-check">
                                                <input <?php if (old('exhaust_fan') == "0") {
                                                            echo ("checked");
                                                        } ?> id="exhaust_fan" name="exhaust_fan" type="checkbox" class="checkexhaust_fan form-check-input <?= ($validation->hasError('exhaust_fan')) ? 'is-invalid' : ''; ?>" onclick="checkexhaust_fan(this.value);" value="0">
                                                <span class="form-check-label">Off</span>
                                            </div>
                                            <?php if ($validation->hasError('exhaust_fan')) : ?>
                                                <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                    <?= $validation->getError('exhaust_fan'); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <script>
                                            function checkexhaust_fan(b) {
                                                var x = document.getElementsByClassName('checkexhaust_fan');
                                                var i;

                                                for (i = 0; i < x.length; i++) {
                                                    if (x[i].value != b) x[i].checked = false;
                                                }
                                            }
                                        </script>
                                    </div>
                                </div>

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

                            <div class="table-responsive">
                                <table class="table table-bordered card-table table-vcenter text-nowrap datatable" style="width:100%">
                                    <tbody>
                                        <tr style="border: 0;">
                                            <td style="border: 0;"></td>
                                            <td style="border: 0;"></td>
                                            <td style="border: 0;"></td>
                                        </tr>
                                        <tr>
                                            <td class="col-3" rowspan="4">Inspeksi</td>
                                            <td>Cleaning Grease Trap</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('inspeksi_cleaning_grease_trap') == "1") {
                                                                echo ("checked");
                                                            } ?> id="inspeksi_cleaning_grease_trap" name="inspeksi_cleaning_grease_trap" type="checkbox" class="checkinspeksi_cleaning_grease_trap <?= ($validation->hasError('inspeksi_cleaning_grease_trap')) ? 'is-invalid' : ''; ?>" onclick="checkinspeksi_cleaning_grease_trap(this.value);" value="1">
                                                    Ya<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('inspeksi_cleaning_grease_trap') == "0") {
                                                                echo ("checked");
                                                            } ?> id="inspeksi_cleaning_grease_trap" name="inspeksi_cleaning_grease_trap" type="checkbox" class="checkinspeksi_cleaning_grease_trap <?= ($validation->hasError('inspeksi_cleaning_grease_trap')) ? 'is-invalid' : ''; ?>" onclick="checkinspeksi_cleaning_grease_trap(this.value);" value="0">
                                                    Tidak
                                                </div>
                                                <?php if ($validation->hasError('inspeksi_cleaning_grease_trap')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('inspeksi_cleaning_grease_trap'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkinspeksi_cleaning_grease_trap(b) {
                                                    var x = document.getElementsByClassName('checkinspeksi_cleaning_grease_trap');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Chlorine</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('inspeksi_chlorine') == "1") {
                                                                echo ("checked");
                                                            } ?> id="inspeksi_chlorine" name="inspeksi_chlorine" type="checkbox" class="checkinspeksi_chlorine <?= ($validation->hasError('inspeksi_chlorine')) ? 'is-invalid' : ''; ?>" onclick="checkinspeksi_chlorine(this.value);" value="1">
                                                    Ya<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('inspeksi_chlorine') == "0") {
                                                                echo ("checked");
                                                            } ?> id="inspeksi_chlorine" name="inspeksi_chlorine" type="checkbox" class="checkinspeksi_chlorine <?= ($validation->hasError('inspeksi_chlorine')) ? 'is-invalid' : ''; ?>" onclick="checkinspeksi_chlorine(this.value);" value="0">
                                                    Tidak
                                                </div>
                                                <?php if ($validation->hasError('inspeksi_chlorine')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('inspeksi_chlorine'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkinspeksi_chlorine(b) {
                                                    var x = document.getElementsByClassName('checkinspeksi_chlorine');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Flow Meter</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('inspeksi_flow_meter') == "1") {
                                                                echo ("checked");
                                                            } ?> id="inspeksi_flow_meter" name="inspeksi_flow_meter" type="checkbox" class="checkinspeksi_flow_meter <?= ($validation->hasError('inspeksi_flow_meter')) ? 'is-invalid' : ''; ?>" onclick="checkinspeksi_flow_meter(this.value);" value="1">
                                                    Ya<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('inspeksi_flow_meter') == "0") {
                                                                echo ("checked");
                                                            } ?> id="inspeksi_flow_meter" name="inspeksi_flow_meter" type="checkbox" class="checkinspeksi_flow_meter <?= ($validation->hasError('inspeksi_flow_meter')) ? 'is-invalid' : ''; ?>" onclick="checkinspeksi_flow_meter(this.value);" value="0">
                                                    Tidak
                                                </div>
                                                <?php if ($validation->hasError('inspeksi_flow_meter')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('inspeksi_flow_meter'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkinspeksi_flow_meter(b) {
                                                    var x = document.getElementsByClassName('checkinspeksi_flow_meter');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">PH Water</td>
                                            <td>
                                                <div class="row" style="padding-top: 20px;">
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-3 row">
                                                            <div class="col">
                                                                <div class="input-icon mb-2">
                                                                    <input value="<?= old('inspeksi_ph_water'); ?>" class="form-control <?= ($validation->hasError('inspeksi_ph_water')) ? 'is-invalid' : ''; ?>" id="inspeksi_ph_water" name="inspeksi_ph_water">
                                                                    <?php if ($validation->hasError('inspeksi_ph_water')) : ?>
                                                                        <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                                            <?= $validation->getError('inspeksi_ph_water'); ?>
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
                        <h3 class="card-title">Sewage Treatment Plant</h3>
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
                                    <th>Blower 1</th>
                                    <th>Blower 2</th>
                                    <th>Transfer Pump 1</th>
                                    <th>Transfer Pump 2</th>
                                    <th>Effluent Pump 1</th>
                                    <th>Effluent Pump 2</th>
                                    <th>Equalizing Pump 1</th>
                                    <th>Equalizing Pump 2</th>
                                    <th>Filter Pump 1</th>
                                    <th>Filter Pump 2</th>
                                    <th>Dozing Pump</th>
                                    <th>Fresh Air Fan</th>
                                    <th>Exhaust Fan</th>
                                    <th>Cleaning Grease Trap</th>
                                    <th>Chlorine</th>
                                    <th>Flow Meter</th>
                                    <th>PH Water</th>
                                    <th>Keterangan</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $i = 1 ?>
                                <?php foreach ($getDataTableStp as $ts) : ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $ts['storeName']; ?></td>
                                        <td><?= $ts['time']; ?></td>
                                        <td><?= dateView($ts['date']); ?></td>
                                        <td><?= $ts['initial']; ?></td>
                                        <td><?= autoManual($ts['blower1']); ?></td>
                                        <td><?= autoManual($ts['blower2']); ?></td>
                                        <td><?= autoManual($ts['transfer_pump1']); ?></td>
                                        <td><?= autoManual($ts['transfer_pump2']); ?></td>
                                        <td><?= autoManual($ts['effluent_pump1']); ?></td>
                                        <td><?= autoManual($ts['effluent_pump2']); ?></td>
                                        <td><?= autoManual($ts['equalizing_pump1']); ?></td>
                                        <td><?= autoManual($ts['equalizing_pump2']); ?></td>
                                        <td><?= autoManual($ts['filter_pump1']); ?></td>
                                        <td><?= autoManual($ts['filter_pump2']); ?></td>
                                        <td><?= autoManual($ts['dozing_pump']); ?></td>
                                        <td><?= onOff($ts['fresh_air_fan']); ?></td>
                                        <td><?= onOff($ts['exhaust_fan']); ?></td>
                                        <td><?= hasilInspeksi($ts['inspeksi_cleaning_grease_trap']); ?></td>
                                        <td><?= hasilInspeksi($ts['inspeksi_chlorine']); ?></td>
                                        <td><?= hasilInspeksi($ts['inspeksi_flow_meter']); ?></td>
                                        <td><?= $ts['inspeksi_ph_water']; ?></td>
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
                <form value="<?= old('idFormEdit') ?>" id="formEditData" action="<?= base_url('') ?>" method="post">
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
                                        <input disabled <?php if (old('time') == "13:00:00") {
                                                            echo ("checked");
                                                        } ?> value="13:00:00" id="time" name="time" class="jamCheck form-check-input  <?= ($validation->hasError('time')) ? 'is-invalid' : ''; ?>" type="checkbox"">
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
                                    <td class="col-3" rowspan="10">Sewage Treatment Plant</td>
                                    <td class="col-4" style="padding-left: 8px;">Blower 1</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('blower1') == "1") {
                                                        echo ("checked");
                                                    } ?> id="blower1" name="blower1" type="checkbox" class="checkBlower1Edit <?= ($validation->hasError('blower1')) ? 'is-invalid' : ''; ?>" onclick="checkBlower1Edit(this.value);" value="1">
                                            Auto<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('blower1') == "0") {
                                                        echo ("checked");
                                                    } ?> id="blower1" name="blower1" type="checkbox" class="checkBlower1Edit <?= ($validation->hasError('blower1')) ? 'is-invalid' : ''; ?>" onclick="checkBlower1Edit(this.value);" value="0">
                                            Manual
                                        </div>
                                        <?php if ($validation->hasError('blower1')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('blower1'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkBlower1Edit(b) {
                                            var x = document.getElementsByClassName('checkBlower1Edit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Blower 2</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('blower2') == "1") {
                                                        echo ("checked");
                                                    } ?> id="blower2" name="blower2" type="checkbox" class="checkblower2Edit <?= ($validation->hasError('blower2')) ? 'is-invalid' : ''; ?>" onclick="checkblower2Edit(this.value);" value="1">
                                            Auto<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('blower2') == "0") {
                                                        echo ("checked");
                                                    } ?> id="blower2" name="blower2" type="checkbox" class="checkblower2Edit <?= ($validation->hasError('blower2')) ? 'is-invalid' : ''; ?>" onclick="checkblower2Edit(this.value);" value="0">
                                            Manual
                                        </div>
                                        <?php if ($validation->hasError('blower2')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('blower2'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkblower2Edit(b) {
                                            var x = document.getElementsByClassName('checkblower2Edit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Transfer Pump 1</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('transfer_pump1') == "1") {
                                                        echo ("checked");
                                                    } ?> id="transfer_pump1" name="transfer_pump1" type="checkbox" class="checktransfer_pump1Edit <?= ($validation->hasError('transfer_pump1')) ? 'is-invalid' : ''; ?>" onclick="checktransfer_pump1Edit(this.value);" value="1">
                                            Auto<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('transfer_pump1') == "0") {
                                                        echo ("checked");
                                                    } ?> id="transfer_pump1" name="transfer_pump1" type="checkbox" class="checktransfer_pump1Edit <?= ($validation->hasError('transfer_pump1')) ? 'is-invalid' : ''; ?>" onclick="checktransfer_pump1Edit(this.value);" value="0">
                                            Manual
                                        </div>
                                        <?php if ($validation->hasError('transfer_pump1')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('transfer_pump1'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checktransfer_pump1Edit(b) {
                                            var x = document.getElementsByClassName('checktransfer_pump1Edit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Transfer Pump 2</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('transfer_pump2') == "1") {
                                                        echo ("checked");
                                                    } ?> id="transfer_pump2" name="transfer_pump2" type="checkbox" class="checktransfer_pump2Edit <?= ($validation->hasError('transfer_pump2')) ? 'is-invalid' : ''; ?>" onclick="checktransfer_pump2Edit(this.value);" value="1">
                                            Auto<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('transfer_pump2') == "0") {
                                                        echo ("checked");
                                                    } ?> id="transfer_pump2" name="transfer_pump2" type="checkbox" class="checktransfer_pump2Edit <?= ($validation->hasError('transfer_pump2')) ? 'is-invalid' : ''; ?>" onclick="checktransfer_pump2Edit(this.value);" value="0">
                                            Manual
                                        </div>
                                        <?php if ($validation->hasError('transfer_pump2')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('transfer_pump2'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checktransfer_pump2Edit(b) {
                                            var x = document.getElementsByClassName('checktransfer_pump2Edit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Effluent Pump 1</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('effluent_pump1') == "1") {
                                                        echo ("checked");
                                                    } ?> id="effluent_pump1" name="effluent_pump1" type="checkbox" class="checkeffluent_pump1Edit <?= ($validation->hasError('effluent_pump1')) ? 'is-invalid' : ''; ?>" onclick="checkeffluent_pump1Edit(this.value);" value="1">
                                            Auto<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('effluent_pump1') == "0") {
                                                        echo ("checked");
                                                    } ?> id="effluent_pump1" name="effluent_pump1" type="checkbox" class="checkeffluent_pump1Edit <?= ($validation->hasError('effluent_pump1')) ? 'is-invalid' : ''; ?>" onclick="checkeffluent_pump1Edit(this.value);" value="0">
                                            Manual
                                        </div>
                                        <?php if ($validation->hasError('effluent_pump1')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('effluent_pump1'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkeffluent_pump1Edit(b) {
                                            var x = document.getElementsByClassName('checkeffluent_pump1Edit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Effluent Pump 2</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('effluent_pump2') == "1") {
                                                        echo ("checked");
                                                    } ?> id="effluent_pump2" name="effluent_pump2" type="checkbox" class="checkeffluent_pump2Edit <?= ($validation->hasError('effluent_pump2')) ? 'is-invalid' : ''; ?>" onclick="checkeffluent_pump2Edit(this.value);" value="1">
                                            Auto<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('effluent_pump2') == "0") {
                                                        echo ("checked");
                                                    } ?> id="effluent_pump2" name="effluent_pump2" type="checkbox" class="checkeffluent_pump2Edit <?= ($validation->hasError('effluent_pump2')) ? 'is-invalid' : ''; ?>" onclick="checkeffluent_pump2Edit(this.value);" value="0">
                                            Manual
                                        </div>
                                        <?php if ($validation->hasError('effluent_pump2')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('effluent_pump2'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkeffluent_pump2Edit(b) {
                                            var x = document.getElementsByClassName('checkeffluent_pump2Edit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Equalizing Pump 1</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('equalizing_pump1') == "1") {
                                                        echo ("checked");
                                                    } ?> id="equalizing_pump1" name="equalizing_pump1" type="checkbox" class="checkequalizing_pump1Edit <?= ($validation->hasError('equalizing_pump1')) ? 'is-invalid' : ''; ?>" onclick="checkequalizing_pump1Edit(this.value);" value="1">
                                            Auto<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('equalizing_pump1') == "0") {
                                                        echo ("checked");
                                                    } ?> id="equalizing_pump1" name="equalizing_pump1" type="checkbox" class="checkequalizing_pump1Edit <?= ($validation->hasError('equalizing_pump1')) ? 'is-invalid' : ''; ?>" onclick="checkequalizing_pump1Edit(this.value);" value="0">
                                            Manual
                                        </div>
                                        <?php if ($validation->hasError('equalizing_pump1')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('equalizing_pump1'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkequalizing_pump1Edit(b) {
                                            var x = document.getElementsByClassName('checkequalizing_pump1Edit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Equalizing Pump 2</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('equalizing_pump2') == "1") {
                                                        echo ("checked");
                                                    } ?> id="equalizing_pump2" name="equalizing_pump2" type="checkbox" class="checkequalizing_pump2Edit <?= ($validation->hasError('equalizing_pump2')) ? 'is-invalid' : ''; ?>" onclick="checkequalizing_pump2Edit(this.value);" value="1">
                                            Auto<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('equalizing_pump2') == "0") {
                                                        echo ("checked");
                                                    } ?> id="equalizing_pump2" name="equalizing_pump2" type="checkbox" class="checkequalizing_pump2Edit <?= ($validation->hasError('equalizing_pump2')) ? 'is-invalid' : ''; ?>" onclick="checkequalizing_pump2Edit(this.value);" value="0">
                                            Manual
                                        </div>
                                        <?php if ($validation->hasError('equalizing_pump2')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('equalizing_pump2'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkequalizing_pump2Edit(b) {
                                            var x = document.getElementsByClassName('checkequalizing_pump2Edit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Filter Pump 1</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('filter_pump1') == "1") {
                                                        echo ("checked");
                                                    } ?> id="filter_pump1" name="filter_pump1" type="checkbox" class="checkfilter_pump1Edit <?= ($validation->hasError('filter_pump1')) ? 'is-invalid' : ''; ?>" onclick="checkfilter_pump1Edit(this.value);" value="1">
                                            Auto<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('filter_pump1') == "0") {
                                                        echo ("checked");
                                                    } ?> id="filter_pump1" name="filter_pump1" type="checkbox" class="checkfilter_pump1Edit <?= ($validation->hasError('filter_pump1')) ? 'is-invalid' : ''; ?>" onclick="checkfilter_pump1Edit(this.value);" value="0">
                                            Manual
                                        </div>
                                        <?php if ($validation->hasError('filter_pump1')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('filter_pump1'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkfilter_pump1Edit(b) {
                                            var x = document.getElementsByClassName('checkfilter_pump1Edit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Filter Pump 2</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('filter_pump2') == "1") {
                                                        echo ("checked");
                                                    } ?> id="filter_pump2" name="filter_pump2" type="checkbox" class="checkfilter_pump2Edit <?= ($validation->hasError('filter_pump2')) ? 'is-invalid' : ''; ?>" onclick="checkfilter_pump2Edit(this.value);" value="1">
                                            Auto<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('filter_pump2') == "0") {
                                                        echo ("checked");
                                                    } ?> id="filter_pump2" name="filter_pump2" type="checkbox" class="checkfilter_pump2Edit <?= ($validation->hasError('filter_pump2')) ? 'is-invalid' : ''; ?>" onclick="checkfilter_pump2Edit(this.value);" value="0">
                                            Manual
                                        </div>
                                        <?php if ($validation->hasError('filter_pump2')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('filter_pump2'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkfilter_pump2Edit(b) {
                                            var x = document.getElementsByClassName('checkfilter_pump2Edit');
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
                                <label class="form-label col-3 col-form-label">Dozing Pump</label>
                                <div class="col">
                                    <div class="form-check">
                                        <input <?php if (old('dozing_pump') == "1") {
                                                    echo ("checked");
                                                } ?> id="dozing_pump" name="dozing_pump" type="checkbox" class="checkdozing_pumpEdit form-check-input <?= ($validation->hasError('dozing_pump')) ? 'is-invalid' : ''; ?>" onclick="checkdozing_pumpEdit(this.value);" value="1">
                                        <span class="form-check-label">Auto</span>
                                    </div>
                                    <div class="form-check">
                                        <input <?php if (old('dozing_pump') == "0") {
                                                    echo ("checked");
                                                } ?> id="dozing_pump" name="dozing_pump" type="checkbox" class="checkdozing_pumpEdit form-check-input <?= ($validation->hasError('dozing_pump')) ? 'is-invalid' : ''; ?>" onclick="checkdozing_pumpEdit(this.value);" value="0">
                                        <span class="form-check-label">Manual</span>
                                    </div>
                                    <?php if ($validation->hasError('dozing_pump')) : ?>
                                        <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                            <?= $validation->getError('dozing_pump'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <script>
                                    function checkdozing_pumpEdit(b) {
                                        var x = document.getElementsByClassName('checkdozing_pumpEdit');
                                        var i;

                                        for (i = 0; i < x.length; i++) {
                                            if (x[i].value != b) x[i].checked = false;
                                        }
                                    }
                                </script>
                            </div>
                            <div class="form-group mb-3 row">
                                <label class="form-label col-3 col-form-label">Fresh Air Fan</label>
                                <div class="col">
                                    <div class="form-check">
                                        <input <?php if (old('fresh_air_fan') == "1") {
                                                    echo ("checked");
                                                } ?> id="fresh_air_fan" name="fresh_air_fan" type="checkbox" class="checkfresh_air_fanEdit form-check-input <?= ($validation->hasError('fresh_air_fan')) ? 'is-invalid' : ''; ?>" onclick="checkfresh_air_fanEdit(this.value);" value="1">
                                        <span class="form-check-label">On</span>
                                    </div>
                                    <div class="form-check">
                                        <input <?php if (old('fresh_air_fan') == "0") {
                                                    echo ("checked");
                                                } ?> id="fresh_air_fan" name="fresh_air_fan" type="checkbox" class="checkfresh_air_fanEdit form-check-input <?= ($validation->hasError('fresh_air_fan')) ? 'is-invalid' : ''; ?>" onclick="checkfresh_air_fanEdit(this.value);" value="0">
                                        <span class="form-check-label">Off</span>
                                    </div>
                                    <?php if ($validation->hasError('fresh_air_fan')) : ?>
                                        <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                            <?= $validation->getError('fresh_air_fan'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <script>
                                    function checkfresh_air_fanEdit(b) {
                                        var x = document.getElementsByClassName('checkfresh_air_fanEdit');
                                        var i;

                                        for (i = 0; i < x.length; i++) {
                                            if (x[i].value != b) x[i].checked = false;
                                        }
                                    }
                                </script>
                            </div>
                            <div class="form-group mb-3 row">
                                <label class="form-label col-3 col-form-label">Exhaust Fan</label>
                                <div class="col">
                                    <div class="form-check">
                                        <input <?php if (old('exhaust_fan') == "1") {
                                                    echo ("checked");
                                                } ?> id="exhaust_fan" name="exhaust_fan" type="checkbox" class="checkexhaust_fanEdit form-check-input <?= ($validation->hasError('exhaust_fan')) ? 'is-invalid' : ''; ?>" onclick="checkexhaust_fanEdit(this.value);" value="1">
                                        <span class="form-check-label">On</span>
                                    </div>
                                    <div class="form-check">
                                        <input <?php if (old('exhaust_fan') == "0") {
                                                    echo ("checked");
                                                } ?> id="exhaust_fan" name="exhaust_fan" type="checkbox" class="checkexhaust_fanEdit form-check-input <?= ($validation->hasError('exhaust_fan')) ? 'is-invalid' : ''; ?>" onclick="checkexhaust_fanEdit(this.value);" value="0">
                                        <span class="form-check-label">Off</span>
                                    </div>
                                    <?php if ($validation->hasError('exhaust_fan')) : ?>
                                        <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                            <?= $validation->getError('exhaust_fan'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <script>
                                    function checkexhaust_fanEdit(b) {
                                        var x = document.getElementsByClassName('checkexhaust_fanEdit');
                                        var i;

                                        for (i = 0; i < x.length; i++) {
                                            if (x[i].value != b) x[i].checked = false;
                                        }
                                    }
                                </script>
                            </div>
                        </div>

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

                    <div class="table-responsive">
                        <table class="table table-bordered card-table table-vcenter text-nowrap datatable" style="width:100%">
                            <tbody>
                                <tr style="border: 0;">
                                    <td style="border: 0;"></td>
                                    <td style="border: 0;"></td>
                                    <td style="border: 0;"></td>
                                </tr>
                                <tr>
                                    <td class="col-3" rowspan="4">Inspeksi</td>
                                    <td>Cleaning Grease Trap</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('inspeksi_cleaning_grease_trap') == "1") {
                                                        echo ("checked");
                                                    } ?> id="inspeksi_cleaning_grease_trap" name="inspeksi_cleaning_grease_trap" type="checkbox" class="checkinspeksi_cleaning_grease_trapEdit <?= ($validation->hasError('inspeksi_cleaning_grease_trap')) ? 'is-invalid' : ''; ?>" onclick="checkinspeksi_cleaning_grease_trapEdit(this.value);" value="1">
                                            Ya<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('inspeksi_cleaning_grease_trap') == "0") {
                                                        echo ("checked");
                                                    } ?> id="inspeksi_cleaning_grease_trap" name="inspeksi_cleaning_grease_trap" type="checkbox" class="checkinspeksi_cleaning_grease_trapEdit <?= ($validation->hasError('inspeksi_cleaning_grease_trap')) ? 'is-invalid' : ''; ?>" onclick="checkinspeksi_cleaning_grease_trapEdit(this.value);" value="0">
                                            Tidak
                                        </div>
                                        <?php if ($validation->hasError('inspeksi_cleaning_grease_trap')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('inspeksi_cleaning_grease_trap'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkinspeksi_cleaning_grease_trapEdit(b) {
                                            var x = document.getElementsByClassName('checkinspeksi_cleaning_grease_trapEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Chlorine</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('inspeksi_chlorine') == "1") {
                                                        echo ("checked");
                                                    } ?> id="inspeksi_chlorine" name="inspeksi_chlorine" type="checkbox" class="checkinspeksi_chlorineEdit <?= ($validation->hasError('inspeksi_chlorine')) ? 'is-invalid' : ''; ?>" onclick="checkinspeksi_chlorineEdit(this.value);" value="1">
                                            Ya<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('inspeksi_chlorine') == "0") {
                                                        echo ("checked");
                                                    } ?> id="inspeksi_chlorine" name="inspeksi_chlorine" type="checkbox" class="checkinspeksi_chlorineEdit <?= ($validation->hasError('inspeksi_chlorine')) ? 'is-invalid' : ''; ?>" onclick="checkinspeksi_chlorineEdit(this.value);" value="0">
                                            Tidak
                                        </div>
                                        <?php if ($validation->hasError('inspeksi_chlorine')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('inspeksi_chlorine'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkinspeksi_chlorineEdit(b) {
                                            var x = document.getElementsByClassName('checkinspeksi_chlorineEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Flow Meter</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('inspeksi_flow_meter') == "1") {
                                                        echo ("checked");
                                                    } ?> id="inspeksi_flow_meter" name="inspeksi_flow_meter" type="checkbox" class="checkinspeksi_flow_meterEdit <?= ($validation->hasError('inspeksi_flow_meter')) ? 'is-invalid' : ''; ?>" onclick="checkinspeksi_flow_meterEdit(this.value);" value="1">
                                            Ya<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('inspeksi_flow_meter') == "0") {
                                                        echo ("checked");
                                                    } ?> id="inspeksi_flow_meter" name="inspeksi_flow_meter" type="checkbox" class="checkinspeksi_flow_meterEdit <?= ($validation->hasError('inspeksi_flow_meter')) ? 'is-invalid' : ''; ?>" onclick="checkinspeksi_flow_meterEdit(this.value);" value="0">
                                            Tidak
                                        </div>
                                        <?php if ($validation->hasError('inspeksi_flow_meter')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('inspeksi_flow_meter'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkinspeksi_flow_meterEdit(b) {
                                            var x = document.getElementsByClassName('checkinspeksi_flow_meterEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">PH Water</td>
                                    <td>
                                        <div class="row" style="padding-top: 20px;">
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3 row">
                                                    <div class="col">
                                                        <div class="input-icon mb-2">
                                                            <input value="<?= old('inspeksi_ph_water'); ?>" class="form-control <?= ($validation->hasError('inspeksi_ph_water')) ? 'is-invalid' : ''; ?>" id="inspeksi_ph_water" name="inspeksi_ph_water">
                                                            <?php if ($validation->hasError('inspeksi_ph_water')) : ?>
                                                                <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                                    <?= $validation->getError('inspeksi_ph_water'); ?>
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
            $("#formEditData").attr('action', site_url + "/stp/updateStp/" + oldData.post.idFormEdit);

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
            $("#formEditData").attr('action', site_url + "/stp/updateStp/" + this.id);
            modalView.find(".is-invalid").removeClass("is-invalid");
            modalView.find(".invalid-feedback,.hasil-validasi").hide();

            inputData = new FormData();
            inputData.append("id", this.id);

            $.ajax({
                url: "<?= base_url('stp/ajaxDataStp') ?>",
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
                        modalView.find("#blower1[value=" + data.data.blower1 + "]").prop('checked', true);
                        modalView.find("#blower2[value=" + data.data.blower2 + "]").prop('checked', true);
                        modalView.find("#transfer_pump1[value=" + data.data.transfer_pump1 + "]").prop('checked', true);
                        modalView.find("#transfer_pump2[value=" + data.data.transfer_pump2 + "]").prop('checked', true);
                        modalView.find("#effluent_pump1[value=" + data.data.effluent_pump1 + "]").prop('checked', true);
                        modalView.find("#effluent_pump2[value=" + data.data.effluent_pump2 + "]").prop('checked', true);
                        modalView.find("#equalizing_pump1[value=" + data.data.equalizing_pump1 + "]").prop('checked', true);
                        modalView.find("#equalizing_pump2[value=" + data.data.equalizing_pump2 + "]").prop('checked', true);
                        modalView.find("#filter_pump1[value=" + data.data.filter_pump1 + "]").prop('checked', true);
                        modalView.find("#filter_pump2[value=" + data.data.filter_pump2 + "]").prop('checked', true);
                        modalView.find("#dozing_pump[value=" + data.data.dozing_pump + "]").prop('checked', true);
                        modalView.find("#fresh_air_fan[value=" + data.data.fresh_air_fan + "]").prop('checked', true);
                        modalView.find("#exhaust_fan[value=" + data.data.exhaust_fan + "]").prop('checked', true);
                        modalView.find("#inspeksi_cleaning_grease_trap[value=" + data.data.inspeksi_cleaning_grease_trap + "]").prop('checked', true);
                        modalView.find("#inspeksi_chlorine[value=" + data.data.inspeksi_chlorine + "]").prop('checked', true);
                        modalView.find("#inspeksi_flow_meter[value=" + data.data.inspeksi_flow_meter + "]").prop('checked', true);
                        modalView.find("#detector[value=" + data.data.detector + "]").prop('checked', true);
                        modalView.find("#inspeksi_ph_water").val(data.data.inspeksi_ph_water);
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
                        url: "<?= base_url('stp/deleteStp') ?>",
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