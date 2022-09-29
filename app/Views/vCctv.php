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
                        <h3 class="card-title">CCTV</h3>
                    </div>

                    <div class="card-body">
                        <form id="formInputData" action="<?php echo base_url('cctv/saveCctv'); ?>" method="post">
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
                                    if ($equipmentDefaultChecklist['checklist'] === $defaultChecklist['checklist']) {
                                        generateChecklistTime($defaultChecklist['checklist'], $checkInspection, ["10:00:00"]);
                                    } else {
                                        generateChecklistTime($defaultChecklist['checklist'], $checkInspection);
                                    }
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
                                <div class="form-group mb-3 row">
                                    <label class="form-label col-1 col-form-label">DVR</label>
                                    <div class="col">
                                        <?php for ($i = 1; $i <= 5; $i++) { ?>
                                            <div class="form-check form-check-inline">
                                                <input <?php if (old("dvr$i") == "DVR$i") {
                                                            echo ("checked");
                                                        } ?> value="DVR<?= $i ?>" id="dvr<?= $i ?>" name="dvr<?= $i ?>" class="dvrCheck form-check-input <?= ($validation->hasError("dvr$i")) ? 'is-invalid' : ''; ?>" type="checkbox">
                                                <span class="form-check-label">DVR<?= $i ?></span>
                                            </div>
                                        <?php } ?>

                                        <?php if ($validation->hasError('dvr1') || $validation->hasError('dvr2') || $validation->hasError('dvr3') || $validation->hasError('dvr4') || $validation->hasError('dvr5')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('dvr1'); ?>
                                                <?= $validation->getError('dvr2'); ?>
                                                <?= $validation->getError('dvr3'); ?>
                                                <?= $validation->getError('dvr4'); ?>
                                                <?= $validation->getError('dvr5'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <div style="width: 100%; border-top: 1px solid lightgrey; height: 0; margin-top: 20px; margin-bottom: 20px;"></div>

                            <!-- START OF DVR LOOP -->
                            <?php for ($i = 1; $i <= 5; $i++) { ?>
                                <div class="elem-dvr<?= $i ?>" <?= old("dvr$i") != null ? '' : 'hidden' ?>>
                                    <div class="row">
                                        <h4>DVR<?= $i ?></h4>
                                        <div class="col-lg-6">
                                            <div class="form-group mb-3 row">
                                                <label class="form-label col-3 col-form-label">HDD Internal</label>
                                                <div class="col">
                                                    <div class="form-check">
                                                        <input <?php if (old("hdd_internal$i") == "1") {
                                                                    echo ("checked");
                                                                } ?> id="hdd_internal<?= $i ?>" name="hdd_internal<?= $i ?>" type="checkbox" class="hddCheck<?= $i ?> form-check-input <?= ($validation->hasError("hdd_internal$i")) ? 'is-invalid' : ''; ?>" onclick="hddCheck<?= $i ?>(this.value);" value="1">
                                                        <span class="form-check-label">Baik</span>
                                                    </div>
                                                    <div class="form-check">
                                                        <input <?php if (old("hdd_internal$i") == "0") {
                                                                    echo ("checked");
                                                                } ?> id="hdd_internal<?= $i ?>" name="hdd_internal<?= $i ?>" type="checkbox" class="hddCheck<?= $i ?> form-check-input <?= ($validation->hasError("hdd_internal$i")) ? 'is-invalid' : ''; ?>" onclick="hddCheck<?= $i ?>(this.value);" value="0">
                                                        <span class="form-check-label">Rusak</span>
                                                    </div>
                                                    <?php if ($validation->hasError("hdd_internal$i")) : ?>
                                                        <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                            <?= $validation->getError("hdd_internal$i"); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                <script>
                                                    function hddCheck<?= $i ?>(b) {
                                                        var x = document.getElementsByClassName('hddCheck<?= $i ?>');
                                                        var i;

                                                        for (i = 0; i < x.length; i++) {
                                                            if (x[i].value != b) x[i].checked = false;
                                                        }
                                                    }
                                                </script>
                                            </div>
                                            <div class="form-group mb-3 row">
                                                <label class="form-label col-3 col-form-label">USB Extender</label>
                                                <div class="col">
                                                    <div class="form-check">
                                                        <input <?php if (old("usb_extender$i") == "1") {
                                                                    echo ("checked");
                                                                } ?> id="usb_extender<?= $i ?>" name="usb_extender<?= $i ?>" type="checkbox" class="usbCheck<?= $i ?> form-check-input <?= ($validation->hasError("usb_extender$i")) ? 'is-invalid' : ''; ?>" onclick="usbCheck<?= $i ?>(this.value);" value="1">
                                                        <span class="form-check-label">Baik</span>
                                                    </div>
                                                    <div class="form-check">
                                                        <input <?php if (old("usb_extender$i") == "0") {
                                                                    echo ("checked");
                                                                } ?> id="usb_extender<?= $i ?>" name="usb_extender<?= $i ?>" type="checkbox" class="usbCheck<?= $i ?> form-check-input <?= ($validation->hasError("usb_extender$i")) ? 'is-invalid' : ''; ?>" onclick="usbCheck<?= $i ?>(this.value);" value="0">
                                                        <span class="form-check-label">Rusak</span>
                                                    </div>
                                                    <?php if ($validation->hasError("usb_extender$i")) : ?>
                                                        <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                            <?= $validation->getError("usb_extender$i"); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                <script>
                                                    function usbCheck<?= $i ?>(b) {
                                                        var x = document.getElementsByClassName('usbCheck<?= $i ?>');
                                                        var i;

                                                        for (i = 0; i < x.length; i++) {
                                                            if (x[i].value != b) x[i].checked = false;
                                                        }
                                                    }
                                                </script>
                                            </div>
                                            <div class="form-group mb-3 row">
                                                <label class="form-label col-3 col-form-label">HDMI / VGA Ext</label>
                                                <div class="col">
                                                    <div class="form-check">
                                                        <input <?php if (old("hdmi_vga_ext$i") == "1") {
                                                                    echo ("checked");
                                                                } ?> id="hdmi_vga_ext<?= $i ?>" name="hdmi_vga_ext<?= $i ?>" type="checkbox" class="hdmiCheck<?= $i ?> form-check-input <?= ($validation->hasError("hdmi_vga_ext$i")) ? 'is-invalid' : ''; ?>" onclick="hdmiCheck<?= $i ?>(this.value);" value="1">
                                                        <span class="form-check-label">Baik</span>
                                                    </div>
                                                    <div class="form-check">
                                                        <input <?php if (old("hdmi_vga_ext$i") == "0") {
                                                                    echo ("checked");
                                                                } ?> id="hdmi_vga_ext<?= $i ?>" name="hdmi_vga_ext<?= $i ?>" type="checkbox" class="hdmiCheck<?= $i ?> form-check-input <?= ($validation->hasError("hdmi_vga_ext$i")) ? 'is-invalid' : ''; ?>" onclick="hdmiCheck<?= $i ?>(this.value);" value="0">
                                                        <span class="form-check-label">Rusak</span>
                                                    </div>
                                                    <?php if ($validation->hasError("hdmi_vga_ext$i")) : ?>
                                                        <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                            <?= $validation->getError("hdmi_vga_ext$i"); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                <script>
                                                    function hdmiCheck<?= $i ?>(b) {
                                                        var x = document.getElementsByClassName('hdmiCheck<?= $i ?>');
                                                        var i;

                                                        for (i = 0; i < x.length; i++) {
                                                            if (x[i].value != b) x[i].checked = false;
                                                        }
                                                    }
                                                </script>
                                            </div>
                                            <div class="form-group mb-3 row">
                                                <label class="form-label col-3 col-form-label">Jumlah Rekaman</label>
                                                <div class="col">
                                                    <input type="text" class="form-control <?= ($validation->hasError("jumlah_rekaman$i")) ? 'is-invalid' : ''; ?>" id="jumlah_rekaman<?= $i ?>" name="jumlah_rekaman<?= $i ?>" placeholder="Jumlah Rekaman" value="<?= old("jumlah_rekaman$i"); ?>">
                                                    <?php if ($validation->hasError("jumlah_rekaman$i")) : ?>
                                                        <div class="invalid-feedback">
                                                            <?= $validation->getError("jumlah_rekaman$i"); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                <label class="col col-form-label">Days</label>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="table-responsive">
                                                <table class="table table-bordered card-table table-vcenter text-nowrap" style="width:100%">
                                                    <tbody>
                                                        <tr>
                                                            <td class="col-3" rowspan="2">Camera</td>
                                                            <td class="col-4" style="padding-left: 8px;">Jumlah</td>
                                                            <td>
                                                                <div class="row" style="padding-top: 20px;">
                                                                    <div class="col">
                                                                        <div class="form-group mb-3 row">
                                                                            <div class="col">
                                                                                <div class="input-icon mb-2">
                                                                                    <input value="<?= old("camera_jumlah$i"); ?>" class="form-control <?= ($validation->hasError("camera_jumlah$i")) ? 'is-invalid' : ''; ?>" id="camera_jumlah<?= $i ?>" name="camera_jumlah<?= $i ?>">
                                                                                    <?php if ($validation->hasError("camera_jumlah$i")) : ?>
                                                                                        <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                                                            <?= $validation->getError("camera_jumlah$i"); ?>
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
                                                            <td class="col-4" style="padding-left: 8px;">Keterangan</td>
                                                            <td>
                                                                <div class="row" style="padding-top: 20px;">
                                                                    <div class="col">
                                                                        <div class="form-group mb-3 row">
                                                                            <textarea name="camera_keterangan<?= $i ?>" id="camera_keterangan<?= $i ?>" class="form-control col <?= ($validation->hasError("camera_keterangan$i")) ? 'is-invalid' : ''; ?>" rows="6"><?= old("camera_keterangan$i"); ?></textarea>
                                                                            <?php if ($validation->hasError("camera_keterangan$i")) : ?>
                                                                                <div class="invalid-feedback">
                                                                                    <?= $validation->getError("camera_keterangan$i"); ?>
                                                                                </div>
                                                                            <?php endif; ?>
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

                                        <div class="col col-md-12 col-lg-12">
                                            <div class="table-responsive">
                                                <table class="table table-bordered card-table table-vcenter text-nowrap" style="width:100%">
                                                    <tbody>
                                                        <tr>
                                                            <td class="col-3" rowspan="2">Adaptor / Power Supply</td>
                                                            <td class="col-4" style="padding-left: 8px;">Jumlah</td>
                                                            <td>
                                                                <div class="row" style="padding-top: 20px;">
                                                                    <div class="col">
                                                                        <div class="form-group mb-3 row">
                                                                            <div class="col">
                                                                                <div class="input-icon mb-2">
                                                                                    <input value="<?= old("adaptor_power_jumlah$i"); ?>" class="form-control <?= ($validation->hasError("adaptor_power_jumlah$i")) ? 'is-invalid' : ''; ?>" id="adaptor_power_jumlah<?= $i ?>" name="adaptor_power_jumlah<?= $i ?>">
                                                                                    <?php if ($validation->hasError("adaptor_power_jumlah$i")) : ?>
                                                                                        <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                                                            <?= $validation->getError("adaptor_power_jumlah$i"); ?>
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
                                                            <td class="col-4" style="padding-left: 8px;">Keterangan</td>
                                                            <td>
                                                                <div class="row" style="padding-top: 20px;">
                                                                    <div class="col">
                                                                        <div class="form-group mb-3 row">
                                                                            <textarea name="adaptor_power_keterangan<?= $i ?>" id="adaptor_power_keterangan<?= $i ?>" class="form-control col <?= ($validation->hasError("adaptor_power_keterangan$i")) ? 'is-invalid' : ''; ?>" rows="6"><?= old("adaptor_power_keterangan$i"); ?></textarea>
                                                                            <?php if ($validation->hasError("adaptor_power_keterangan$i")) : ?>
                                                                                <div class="invalid-feedback">
                                                                                    <?= $validation->getError("adaptor_power_keterangan$i"); ?>
                                                                                </div>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div style="width: 100%; border-top: 1px solid lightgrey; height: 0; margin-top: 20px; margin-bottom: 20px;"></div>

                                </div>

                            <?php } ?>
                            <!-- END OF DVR LOOP -->

                            <div class="form-footer">
                                <div class="row align-items-center">
                                    <div class="col"></div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-outline-primary ms-auto" id="btnSubmitFormInput" name="btnSubmitFormInput">
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
                        <h3 class="card-title">CCTV</h3>
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
                                    <th>DVR</th>
                                    <th>HDD Internal</th>
                                    <th>USB Extender</th>
                                    <th>HDMI / VGA Ext</th>
                                    <th>Jml Rekaman (Days)</th>
                                    <th>Camera (Jumlah)</th>
                                    <th>Camera Keterangan</th>
                                    <th>Adaptor (Jumlah)</th>
                                    <th>Adaptor Keterangan</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $i = 1 ?>
                                <?php foreach ($getDataTableCctv as $ts) : ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $ts['storeName']; ?></td>
                                        <td><?= $ts['time']; ?></td>
                                        <td><?= dateView($ts['date']); ?></td>
                                        <td><?= $ts['initial']; ?></td>
                                        <td><?= $ts['dvr']; ?></td>
                                        <td><?= hasilInspeksi($ts['hdd_internal']); ?></td>
                                        <td><?= hasilInspeksi($ts['usb_extender']); ?></td>
                                        <td><?= hasilInspeksi($ts['hdmi_vga_ext']); ?></td>
                                        <td><?= $ts['jumlah_rekaman']; ?></td>
                                        <td><?= $ts['camera_jumlah']; ?></td>
                                        <td><?= $ts['camera_keterangan']; ?></td>
                                        <td><?= $ts['adaptor_power_jumlah']; ?></td>
                                        <td><?= $ts['adaptor_power_keterangan']; ?></td>
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
                <h5 id="modalTitle" class="modal-title">Edit Data CCTV</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formEditData" action="<?= base_url('') ?>" method="post">
                    <input value="<?= old('idFormEdit') ?>" type="text" hidden readonly id="idFormEdit" name="idFormEdit">
                    <div class="elem-dvr">
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
                            if ($equipmentDefaultChecklist['checklist'] === $defaultChecklist['checklist']) {
                                generateChecklistTime($defaultChecklist['checklist'], $checkInspection, ["10:00:00"], TRUE);
                            } else {
                                generateChecklistTime($defaultChecklist['checklist'], $checkInspection, null, TRUE);
                            }
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
                                    <label class="form-label col-3 col-form-label">HDD Internal</label>
                                    <div class="col">
                                        <div class="form-check">
                                            <input <?php if (old("hdd_internal") == "1") {
                                                        echo ("checked");
                                                    } ?> id="hdd_internal" name="hdd_internal" type="checkbox" class="hddCheckEdit form-check-input <?= ($validation->hasError("hdd_internal")) ? 'is-invalid' : ''; ?>" onclick="hddCheckEdit(this.value);" value="1">
                                            <span class="form-check-label">Baik</span>
                                        </div>
                                        <div class="form-check">
                                            <input <?php if (old("hdd_internal") == "0") {
                                                        echo ("checked");
                                                    } ?> id="hdd_internal" name="hdd_internal" type="checkbox" class="hddCheckEdit form-check-input <?= ($validation->hasError("hdd_internal")) ? 'is-invalid' : ''; ?>" onclick="hddCheckEdit(this.value);" value="0">
                                            <span class="form-check-label">Rusak</span>
                                        </div>
                                        <?php if ($validation->hasError("hdd_internal")) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError("hdd_internal"); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <script>
                                        function hddCheckEdit(b) {
                                            var x = document.getElementsByClassName('hddCheckEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </div>
                                <div class="form-group mb-3 row">
                                    <label class="form-label col-3 col-form-label">USB Extender</label>
                                    <div class="col">
                                        <div class="form-check">
                                            <input <?php if (old("usb_extender") == "1") {
                                                        echo ("checked");
                                                    } ?> id="usb_extender" name="usb_extender" type="checkbox" class="usbCheckEdit form-check-input <?= ($validation->hasError("usb_extender")) ? 'is-invalid' : ''; ?>" onclick="usbCheckEdit(this.value);" value="1">
                                            <span class="form-check-label">Baik</span>
                                        </div>
                                        <div class="form-check">
                                            <input <?php if (old("usb_extender") == "0") {
                                                        echo ("checked");
                                                    } ?> id="usb_extender" name="usb_extender" type="checkbox" class="usbCheckEdit form-check-input <?= ($validation->hasError("usb_extender")) ? 'is-invalid' : ''; ?>" onclick="usbCheckEdit(this.value);" value="0">
                                            <span class="form-check-label">Rusak</span>
                                        </div>
                                        <?php if ($validation->hasError("usb_extender")) : ?>
                                            <div style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError("usb_extender"); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <script>
                                        function usbCheckEdit(b) {
                                            var x = document.getElementsByClassName('usbCheckEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </div>
                                <div class="form-group mb-3 row">
                                    <label class="form-label col-3 col-form-label">HDMI / VGA Ext</label>
                                    <div class="col">
                                        <div class="form-check">
                                            <input <?php if (old("hdmi_vga_ext") == "1") {
                                                        echo ("checked");
                                                    } ?> id="hdmi_vga_ext" name="hdmi_vga_ext" type="checkbox" class="hdmiCheckEdit form-check-input <?= ($validation->hasError("hdmi_vga_ext")) ? 'is-invalid' : ''; ?>" onclick="hdmiCheckEdit(this.value);" value="1">
                                            <span class="form-check-label">Baik</span>
                                        </div>
                                        <div class="form-check">
                                            <input <?php if (old("hdmi_vga_ext") == "0") {
                                                        echo ("checked");
                                                    } ?> id="hdmi_vga_ext" name="hdmi_vga_ext" type="checkbox" class="hdmiCheckEdit form-check-input <?= ($validation->hasError("hdmi_vga_ext")) ? 'is-invalid' : ''; ?>" onclick="hdmiCheckEdit(this.value);" value="0">
                                            <span class="form-check-label">Rusak</span>
                                        </div>
                                        <?php if ($validation->hasError("hdmi_vga_ext")) : ?>
                                            <div style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError("hdmi_vga_ext"); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <script>
                                        function hdmiCheckEdit(b) {
                                            var x = document.getElementsByClassName('hdmiCheckEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </div>
                                <div class="form-group mb-3 row">
                                    <label class="form-label col-3 col-form-label">Jumlah Rekaman</label>
                                    <div class="col">
                                        <input type="text" class="form-control <?= ($validation->hasError("jumlah_rekaman")) ? 'is-invalid' : ''; ?>" id="jumlah_rekaman" name="jumlah_rekaman" placeholder="Jumlah Rekaman" value="<?= old("jumlah_rekaman"); ?>">
                                        <?php if ($validation->hasError("jumlah_rekaman")) : ?>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError("jumlah_rekaman"); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <label class="col col-form-label">Days</label>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="table-responsive">
                                    <table class="table table-bordered card-table table-vcenter text-nowrap" style="width:100%">
                                        <tbody>
                                            <tr>
                                                <td class="col-3" rowspan="2">Camera</td>
                                                <td class="col-4" style="padding-left: 8px;">Jumlah</td>
                                                <td>
                                                    <div class="row" style="padding-top: 20px;">
                                                        <div class="col">
                                                            <div class="form-group mb-3 row">
                                                                <div class="col">
                                                                    <div class="input-icon mb-2">
                                                                        <input value="<?= old("camera_jumlah"); ?>" class="form-control <?= ($validation->hasError("camera_jumlah")) ? 'is-invalid' : ''; ?>" id="camera_jumlah" name="camera_jumlah">
                                                                        <?php if ($validation->hasError("camera_jumlah")) : ?>
                                                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                                                <?= $validation->getError("camera_jumlah"); ?>
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
                                                <td class="col-4" style="padding-left: 8px;">Keterangan</td>
                                                <td>
                                                    <div class="row" style="padding-top: 20px;">
                                                        <div class="col">
                                                            <div class="form-group mb-3 row">
                                                                <textarea name="camera_keterangan" id="camera_keterangan" class="form-control col <?= ($validation->hasError("camera_keterangan")) ? 'is-invalid' : ''; ?>" rows="6"><?= old("camera_keterangan"); ?></textarea>
                                                                <?php if ($validation->hasError("camera_keterangan")) : ?>
                                                                    <div class="invalid-feedback">
                                                                        <?= $validation->getError("camera_keterangan"); ?>
                                                                    </div>
                                                                <?php endif; ?>
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

                            <div class="col col-md-12 col-lg-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered card-table table-vcenter text-nowrap" style="width:100%">
                                        <tbody>
                                            <tr>
                                                <td class="col-3" rowspan="2">Adaptor / Power Supply</td>
                                                <td class="col-4" style="padding-left: 8px;">Jumlah</td>
                                                <td>
                                                    <div class="row" style="padding-top: 20px;">
                                                        <div class="col">
                                                            <div class="form-group mb-3 row">
                                                                <div class="col">
                                                                    <div class="input-icon mb-2">
                                                                        <input value="<?= old("adaptor_power_jumlah"); ?>" class="form-control <?= ($validation->hasError("adaptor_power_jumlah")) ? 'is-invalid' : ''; ?>" id="adaptor_power_jumlah" name="adaptor_power_jumlah">
                                                                        <?php if ($validation->hasError("adaptor_power_jumlah")) : ?>
                                                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                                                <?= $validation->getError("adaptor_power_jumlah"); ?>
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
                                                <td class="col-4" style="padding-left: 8px;">Keterangan</td>
                                                <td>
                                                    <div class="row" style="padding-top: 20px;">
                                                        <div class="col">
                                                            <div class="form-group mb-3 row">
                                                                <textarea name="adaptor_power_keterangan" id="adaptor_power_keterangan" class="form-control col <?= ($validation->hasError("adaptor_power_keterangan")) ? 'is-invalid' : ''; ?>" rows="6"><?= old("adaptor_power_keterangan"); ?></textarea>
                                                                <?php if ($validation->hasError("adaptor_power_keterangan")) : ?>
                                                                    <div class="invalid-feedback">
                                                                        <?= $validation->getError("adaptor_power_keterangan"); ?>
                                                                    </div>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div style="width: 100%; border-top: 1px solid lightgrey; height: 0; margin-top: 20px; margin-bottom: 20px;"></div>

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

        $('#formEditData').on('submit', function() {
            $('input').prop('disabled', false);
        });

        $("#btnSubmitFormInput").click(function(e) {
            if ($("#formInputData .dvrCheck:checked").length == 0) {
                e.preventDefault()
                Swal.fire(
                    'Warning!',
                    'Check at least 1 DVR!',
                    'warning'
                )
            }
        });

        $("#formInputData .dvrCheck").change(function() {
            var elemFormInputData = $("#formInputData .elem-" + this.id)
            var bool = elemFormInputData.prop("hidden");
            elemFormInputData.prop("hidden", !bool);
        });

        oldData = <?= json_encode(session()->get('_ci_old_input')) ?>;
        if (oldData != null && oldData.post.idFormEdit != null) {
            $("#modal-editData").modal('show');
            $("#formEditData").attr('action', site_url + "/cctv/updateCctv/" + oldData.post.idFormEdit);

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
            $("#formEditData").attr('action', site_url + "/cctv/updateCctv/" + this.id);
            modalView.find(".is-invalid").removeClass("is-invalid");
            modalView.find(".invalid-feedback,.hasil-validasi").hide();

            inputData = new FormData();
            inputData.append("id", this.id);

            $.ajax({
                url: "<?= base_url('cctv/ajaxDataCctv') ?>",
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
                        modalView.find("#modalTitle").append(' ' + data.data.dvr);
                        modalView.find("#idFormEdit").val(data.data.id);
                        modalView.find("#equipment_checklist").val(data.data.equipment_checklist);
                        // modalView.find("#time[value='" + data.data.time + "']").prop('checked', true);
                        modalView.find("#timeValue").val(data.data.time);
                        modalView.find("#date").val(data.data.date);
                        modalView.find("#worker").val(data.data.initial);
                        modalView.find("#location").val(data.data.storeName);
                        // modalView.find("#equipment_checklist option[value=" + data.data.equipment_checklist + "]").prop('selected', true);
                        modalView.find("#hdd_internal[value=" + data.data.hdd_internal + "]").prop('checked', true);
                        modalView.find("#usb_extender[value=" + data.data.usb_extender + "]").prop('checked', true);
                        modalView.find("#hdmi_vga_ext[value=" + data.data.hdmi_vga_ext + "]").prop('checked', true);
                        modalView.find("#jumlah_rekaman").val(data.data.jumlah_rekaman);
                        modalView.find("#camera_jumlah").val(data.data.camera_jumlah);
                        modalView.find("#camera_keterangan").val(data.data.camera_keterangan);
                        modalView.find("#adaptor_power_jumlah").val(data.data.adaptor_power_jumlah);
                        modalView.find("#adaptor_power_keterangan").val(data.data.adaptor_power_keterangan);
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
                        url: "<?= base_url('cctv/deleteCctv') ?>",
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