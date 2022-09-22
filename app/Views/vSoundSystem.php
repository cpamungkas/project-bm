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
                        <h3 class="card-title">Sound System</h3>
                    </div>

                    <div class="card-body">
                        <form id="formInputData" action="<?php echo base_url('soundsystem/saveSoundSystem'); ?>" method="post">
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
                                            <td class="col-3" rowspan="6">Mains Utility</td>
                                            <td class="col-4" style="padding-left: 8px;">Amplifier</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('amplifier') == "1") {
                                                                echo ("checked");
                                                            } ?> id="amplifier" name="amplifier" type="checkbox" class="checkamplifier <?= ($validation->hasError('amplifier')) ? 'is-invalid' : ''; ?>" onclick="checkamplifier(this.value);" value="1">
                                                    Berfungsi<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('amplifier') == "0") {
                                                                echo ("checked");
                                                            } ?> id="amplifier" name="amplifier" type="checkbox" class="checkamplifier <?= ($validation->hasError('amplifier')) ? 'is-invalid' : ''; ?>" onclick="checkamplifier(this.value);" value="0">
                                                    Tidak
                                                </div>
                                                <?php if ($validation->hasError('amplifier')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('amplifier'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkamplifier(b) {
                                                    var x = document.getElementsByClassName('checkamplifier');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Mixer</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('mixer') == "1") {
                                                                echo ("checked");
                                                            } ?> id="mixer" name="mixer" type="checkbox" class="checkmixer <?= ($validation->hasError('mixer')) ? 'is-invalid' : ''; ?>" onclick="checkmixer(this.value);" value="1">
                                                    Berfungsi<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('mixer') == "0") {
                                                                echo ("checked");
                                                            } ?> id="mixer" name="mixer" type="checkbox" class="checkmixer <?= ($validation->hasError('mixer')) ? 'is-invalid' : ''; ?>" onclick="checkmixer(this.value);" value="0">
                                                    Tidak
                                                </div>
                                                <?php if ($validation->hasError('mixer')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('mixer'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkmixer(b) {
                                                    var x = document.getElementsByClassName('checkmixer');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Radio FM</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('radio_fm') == "1") {
                                                                echo ("checked");
                                                            } ?> id="radio_fm" name="radio_fm" type="checkbox" class="checkradio_fm <?= ($validation->hasError('radio_fm')) ? 'is-invalid' : ''; ?>" onclick="checkradio_fm(this.value);" value="1">
                                                    Berfungsi<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('radio_fm') == "0") {
                                                                echo ("checked");
                                                            } ?> id="radio_fm" name="radio_fm" type="checkbox" class="checkradio_fm <?= ($validation->hasError('radio_fm')) ? 'is-invalid' : ''; ?>" onclick="checkradio_fm(this.value);" value="0">
                                                    Tidak
                                                </div>
                                                <?php if ($validation->hasError('radio_fm')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('radio_fm'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkradio_fm(b) {
                                                    var x = document.getElementsByClassName('checkradio_fm');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">CD/MP3 Player</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('cd_mp3_player') == "1") {
                                                                echo ("checked");
                                                            } ?> id="cd_mp3_player" name="cd_mp3_player" type="checkbox" class="checkcd_mp3_player <?= ($validation->hasError('cd_mp3_player')) ? 'is-invalid' : ''; ?>" onclick="checkcd_mp3_player(this.value);" value="1">
                                                    Berfungsi<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('cd_mp3_player') == "0") {
                                                                echo ("checked");
                                                            } ?> id="cd_mp3_player" name="cd_mp3_player" type="checkbox" class="checkcd_mp3_player <?= ($validation->hasError('cd_mp3_player')) ? 'is-invalid' : ''; ?>" onclick="checkcd_mp3_player(this.value);" value="0">
                                                    Tidak
                                                </div>
                                                <?php if ($validation->hasError('cd_mp3_player')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('cd_mp3_player'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkcd_mp3_player(b) {
                                                    var x = document.getElementsByClassName('checkcd_mp3_player');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Switch Zone</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('switch_zone') == "1") {
                                                                echo ("checked");
                                                            } ?> id="switch_zone" name="switch_zone" type="checkbox" class="checkswitch_zone <?= ($validation->hasError('switch_zone')) ? 'is-invalid' : ''; ?>" onclick="checkswitch_zone(this.value);" value="1">
                                                    Berfungsi<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('switch_zone') == "0") {
                                                                echo ("checked");
                                                            } ?> id="switch_zone" name="switch_zone" type="checkbox" class="checkswitch_zone <?= ($validation->hasError('switch_zone')) ? 'is-invalid' : ''; ?>" onclick="checkswitch_zone(this.value);" value="0">
                                                    Tidak
                                                </div>
                                                <?php if ($validation->hasError('switch_zone')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('switch_zone'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkswitch_zone(b) {
                                                    var x = document.getElementsByClassName('checkswitch_zone');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Mic Announcer</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('mic_announcer') == "1") {
                                                                echo ("checked");
                                                            } ?> id="mic_announcer" name="mic_announcer" type="checkbox" class="checkmic_announcer <?= ($validation->hasError('mic_announcer')) ? 'is-invalid' : ''; ?>" onclick="checkmic_announcer(this.value);" value="1">
                                                    Berfungsi<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('mic_announcer') == "0") {
                                                                echo ("checked");
                                                            } ?> id="mic_announcer" name="mic_announcer" type="checkbox" class="checkmic_announcer <?= ($validation->hasError('mic_announcer')) ? 'is-invalid' : ''; ?>" onclick="checkmic_announcer(this.value);" value="0">
                                                    Tidak
                                                </div>
                                                <?php if ($validation->hasError('mic_announcer')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('mic_announcer'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkmic_announcer(b) {
                                                    var x = document.getElementsByClassName('checkmic_announcer');
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
                                            <td class="col-3" rowspan="2">Speaker</td>
                                            <td style="padding-left: 8px;" colspan="2">
                                                <div class="form-group mb-3 row">
                                                    <label class="form-label col-3 col-form-label">Jumlah</label>
                                                    <div class="col">
                                                        <input type="text" class="form-control <?= ($validation->hasError('speaker_jumlah')) ? 'is-invalid' : ''; ?>" id="speaker_jumlah" name="speaker_jumlah" placeholder="Jumlah Temuan" value="<?= old('speaker_jumlah'); ?>">
                                                        <?php if ($validation->hasError('speaker_jumlah')) : ?>
                                                            <div class="invalid-feedback">
                                                                <?= $validation->getError('speaker_jumlah'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding-left: 8px;" colspan="2">
                                                <div class="form-group mb-3 row">
                                                    <label class="form-label col-3 col-form-label">Keterangan</label>
                                                    <div class="col">
                                                        <textarea name="speaker_keterangan" id="speaker_keterangan" class="form-control <?= ($validation->hasError('speaker_keterangan')) ? 'is-invalid' : ''; ?>" rows="6"><?= old('speaker_keterangan'); ?></textarea>
                                                        <?php if ($validation->hasError('speaker_keterangan')) : ?>
                                                            <div class="invalid-feedback">
                                                                <?= $validation->getError('speaker_keterangan'); ?>
                                                            </div>
                                                        <?php endif; ?>
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
                                            <td class="col-3" rowspan="2">Features</td>
                                            <td class="col-4" style="padding-left: 8px;">Car Call</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('car_call') == "1") {
                                                                echo ("checked");
                                                            } ?> id="car_call" name="car_call" type="checkbox" class="checkcar_call <?= ($validation->hasError('car_call')) ? 'is-invalid' : ''; ?>" onclick="checkcar_call(this.value);" value="1">
                                                    Berfungsi<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('car_call') == "0") {
                                                                echo ("checked");
                                                            } ?> id="car_call" name="car_call" type="checkbox" class="checkcar_call <?= ($validation->hasError('car_call')) ? 'is-invalid' : ''; ?>" onclick="checkcar_call(this.value);" value="0">
                                                    Tidak
                                                </div>
                                                <?php if ($validation->hasError('car_call')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('car_call'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkcar_call(b) {
                                                    var x = document.getElementsByClassName('checkcar_call');
                                                    var i;

                                                    for (i = 0; i < x.length; i++) {
                                                        if (x[i].value != b) x[i].checked = false;
                                                    }
                                                }
                                            </script>
                                        </tr>
                                        <tr>
                                            <td class="col-4" style="padding-left: 8px;">Emergency Evac System</td>
                                            <td>
                                                <div style="padding-top: 10px; padding-bottom: 5px;">
                                                    <input <?php if (old('emergency_evac_system') == "1") {
                                                                echo ("checked");
                                                            } ?> id="emergency_evac_system" name="emergency_evac_system" type="checkbox" class="checkemergency_evac_system <?= ($validation->hasError('emergency_evac_system')) ? 'is-invalid' : ''; ?>" onclick="checkemergency_evac_system(this.value);" value="1">
                                                    Berfungsi<br>
                                                </div>
                                                <div style="padding-top: 5px; padding-bottom: 10px;">
                                                    <input <?php if (old('emergency_evac_system') == "0") {
                                                                echo ("checked");
                                                            } ?> id="emergency_evac_system" name="emergency_evac_system" type="checkbox" class="checkemergency_evac_system <?= ($validation->hasError('emergency_evac_system')) ? 'is-invalid' : ''; ?>" onclick="checkemergency_evac_system(this.value);" value="0">
                                                    Tidak
                                                </div>
                                                <?php if ($validation->hasError('emergency_evac_system')) : ?>
                                                    <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                        <?= $validation->getError('emergency_evac_system'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function checkemergency_evac_system(b) {
                                                    var x = document.getElementsByClassName('checkemergency_evac_system');
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
                        <h3 class="card-title">Sound System</h3>
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
                                    <th>Amplifier</th>
                                    <th>Mixer</th>
                                    <th class="text-center">Radio<br>FM</th>
                                    <th class="text-center">CD/MP3<br>Player</th>
                                    <th class="text-center">Switch<br>Zone</th>
                                    <th class="text-center">Mic<br>Announcer</th>
                                    <th class="text-center">Speaker<br>Jumlah</th>
                                    <th class="text-center">Speaker<br>Keterangan</th>
                                    <th class="text-center">Car<br>Call</th>
                                    <th class="text-center">Emergency<br>Evac System</th>
                                    <th>Keterangan</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $i = 1 ?>
                                <?php foreach ($getDataTableSoundSystem as $ts) : ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $ts['storeName']; ?></td>
                                        <td><?= dateView($ts['date']); ?></td>
                                        <td><?= $ts['initial']; ?></td>
                                        <td><?= berfungsiTidak($ts['amplifier']); ?></td>
                                        <td><?= berfungsiTidak($ts['mixer']); ?></td>
                                        <td><?= berfungsiTidak($ts['radio_fm']); ?></td>
                                        <td><?= berfungsiTidak($ts['cd_mp3_player']); ?></td>
                                        <td><?= berfungsiTidak($ts['switch_zone']); ?></td>
                                        <td><?= berfungsiTidak($ts['mic_announcer']); ?></td>
                                        <td><?= $ts['speaker_jumlah']; ?></td>
                                        <td><?= $ts['speaker_keterangan']; ?></td>
                                        <td><?= berfungsiTidak($ts['car_call']); ?></td>
                                        <td><?= berfungsiTidak($ts['emergency_evac_system']); ?></td>
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
                <h5 class="modal-title">Edit Data Sound System</h5>
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
                                    <td class="col-3" rowspan="6">Mains Utility</td>
                                    <td class="col-4" style="padding-left: 8px;">Amplifier</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('amplifier') == "1") {
                                                        echo ("checked");
                                                    } ?> id="amplifier" name="amplifier" type="checkbox" class="checkamplifierEdit <?= ($validation->hasError('amplifier')) ? 'is-invalid' : ''; ?>" onclick="checkamplifierEdit(this.value);" value="1">
                                            Berfungsi<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('amplifier') == "0") {
                                                        echo ("checked");
                                                    } ?> id="amplifier" name="amplifier" type="checkbox" class="checkamplifierEdit <?= ($validation->hasError('amplifier')) ? 'is-invalid' : ''; ?>" onclick="checkamplifierEdit(this.value);" value="0">
                                            Tidak
                                        </div>
                                        <?php if ($validation->hasError('amplifier')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('amplifier'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkamplifierEdit(b) {
                                            var x = document.getElementsByClassName('checkamplifierEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Mixer</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('mixer') == "1") {
                                                        echo ("checked");
                                                    } ?> id="mixer" name="mixer" type="checkbox" class="checkmixerEdit <?= ($validation->hasError('mixer')) ? 'is-invalid' : ''; ?>" onclick="checkmixerEdit(this.value);" value="1">
                                            Berfungsi<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('mixer') == "0") {
                                                        echo ("checked");
                                                    } ?> id="mixer" name="mixer" type="checkbox" class="checkmixerEdit <?= ($validation->hasError('mixer')) ? 'is-invalid' : ''; ?>" onclick="checkmixerEdit(this.value);" value="0">
                                            Tidak
                                        </div>
                                        <?php if ($validation->hasError('mixer')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('mixer'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkmixerEdit(b) {
                                            var x = document.getElementsByClassName('checkmixerEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Radio FM</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('radio_fm') == "1") {
                                                        echo ("checked");
                                                    } ?> id="radio_fm" name="radio_fm" type="checkbox" class="checkradio_fmEdit <?= ($validation->hasError('radio_fm')) ? 'is-invalid' : ''; ?>" onclick="checkradio_fmEdit(this.value);" value="1">
                                            Berfungsi<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('radio_fm') == "0") {
                                                        echo ("checked");
                                                    } ?> id="radio_fm" name="radio_fm" type="checkbox" class="checkradio_fmEdit <?= ($validation->hasError('radio_fm')) ? 'is-invalid' : ''; ?>" onclick="checkradio_fmEdit(this.value);" value="0">
                                            Tidak
                                        </div>
                                        <?php if ($validation->hasError('radio_fm')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('radio_fm'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkradio_fmEdit(b) {
                                            var x = document.getElementsByClassName('checkradio_fmEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">CD/MP3 Player</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('cd_mp3_player') == "1") {
                                                        echo ("checked");
                                                    } ?> id="cd_mp3_player" name="cd_mp3_player" type="checkbox" class="checkcd_mp3_playerEdit <?= ($validation->hasError('cd_mp3_player')) ? 'is-invalid' : ''; ?>" onclick="checkcd_mp3_playerEdit(this.value);" value="1">
                                            Berfungsi<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('cd_mp3_player') == "0") {
                                                        echo ("checked");
                                                    } ?> id="cd_mp3_player" name="cd_mp3_player" type="checkbox" class="checkcd_mp3_playerEdit <?= ($validation->hasError('cd_mp3_player')) ? 'is-invalid' : ''; ?>" onclick="checkcd_mp3_playerEdit(this.value);" value="0">
                                            Tidak
                                        </div>
                                        <?php if ($validation->hasError('cd_mp3_player')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('cd_mp3_player'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkcd_mp3_playerEdit(b) {
                                            var x = document.getElementsByClassName('checkcd_mp3_playerEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Switch Zone</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('switch_zone') == "1") {
                                                        echo ("checked");
                                                    } ?> id="switch_zone" name="switch_zone" type="checkbox" class="checkswitch_zoneEdit <?= ($validation->hasError('switch_zone')) ? 'is-invalid' : ''; ?>" onclick="checkswitch_zoneEdit(this.value);" value="1">
                                            Berfungsi<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('switch_zone') == "0") {
                                                        echo ("checked");
                                                    } ?> id="switch_zone" name="switch_zone" type="checkbox" class="checkswitch_zoneEdit <?= ($validation->hasError('switch_zone')) ? 'is-invalid' : ''; ?>" onclick="checkswitch_zoneEdit(this.value);" value="0">
                                            Tidak
                                        </div>
                                        <?php if ($validation->hasError('switch_zone')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('switch_zone'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkswitch_zoneEdit(b) {
                                            var x = document.getElementsByClassName('checkswitch_zoneEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Mic Announcer</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('mic_announcer') == "1") {
                                                        echo ("checked");
                                                    } ?> id="mic_announcer" name="mic_announcer" type="checkbox" class="checkmic_announcerEdit <?= ($validation->hasError('mic_announcer')) ? 'is-invalid' : ''; ?>" onclick="checkmic_announcerEdit(this.value);" value="1">
                                            Berfungsi<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('mic_announcer') == "0") {
                                                        echo ("checked");
                                                    } ?> id="mic_announcer" name="mic_announcer" type="checkbox" class="checkmic_announcerEdit <?= ($validation->hasError('mic_announcer')) ? 'is-invalid' : ''; ?>" onclick="checkmic_announcerEdit(this.value);" value="0">
                                            Tidak
                                        </div>
                                        <?php if ($validation->hasError('mic_announcer')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('mic_announcer'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkmic_announcerEdit(b) {
                                            var x = document.getElementsByClassName('checkmic_announcerEdit');
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
                                    <td class="col-3" rowspan="2">Speaker</td>
                                    <td style="padding-left: 8px;" colspan="2">
                                        <div class="form-group mb-3 row">
                                            <label class="form-label col-3 col-form-label">Jumlah</label>
                                            <div class="col">
                                                <input type="text" class="form-control <?= ($validation->hasError('speaker_jumlah')) ? 'is-invalid' : ''; ?>" id="speaker_jumlah" name="speaker_jumlah" placeholder="Jumlah Temuan" value="<?= old('speaker_jumlah'); ?>">
                                                <?php if ($validation->hasError('speaker_jumlah')) : ?>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('speaker_jumlah'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-left: 8px;" colspan="2">
                                        <div class="form-group mb-3 row">
                                            <label class="form-label col-3 col-form-label">Keterangan</label>
                                            <div class="col">
                                                <textarea name="speaker_keterangan" id="speaker_keterangan" class="form-control <?= ($validation->hasError('speaker_keterangan')) ? 'is-invalid' : ''; ?>" rows="6"><?= old('speaker_keterangan'); ?></textarea>
                                                <?php if ($validation->hasError('speaker_keterangan')) : ?>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('speaker_keterangan'); ?>
                                                    </div>
                                                <?php endif; ?>
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
                                    <td class="col-3" rowspan="2">Features</td>
                                    <td class="col-4" style="padding-left: 8px;">Car Call</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('car_call') == "1") {
                                                        echo ("checked");
                                                    } ?> id="car_call" name="car_call" type="checkbox" class="checkcar_callEdit <?= ($validation->hasError('car_call')) ? 'is-invalid' : ''; ?>" onclick="checkcar_callEdit(this.value);" value="1">
                                            Berfungsi<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('car_call') == "0") {
                                                        echo ("checked");
                                                    } ?> id="car_call" name="car_call" type="checkbox" class="checkcar_callEdit <?= ($validation->hasError('car_call')) ? 'is-invalid' : ''; ?>" onclick="checkcar_callEdit(this.value);" value="0">
                                            Tidak
                                        </div>
                                        <?php if ($validation->hasError('car_call')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('car_call'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkcar_callEdit(b) {
                                            var x = document.getElementsByClassName('checkcar_callEdit');
                                            var i;

                                            for (i = 0; i < x.length; i++) {
                                                if (x[i].value != b) x[i].checked = false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <tr>
                                    <td class="col-4" style="padding-left: 8px;">Emergency Evac System</td>
                                    <td>
                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                            <input <?php if (old('emergency_evac_system') == "1") {
                                                        echo ("checked");
                                                    } ?> id="emergency_evac_system" name="emergency_evac_system" type="checkbox" class="checkemergency_evac_systemEdit <?= ($validation->hasError('emergency_evac_system')) ? 'is-invalid' : ''; ?>" onclick="checkemergency_evac_systemEdit(this.value);" value="1">
                                            Berfungsi<br>
                                        </div>
                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                            <input <?php if (old('emergency_evac_system') == "0") {
                                                        echo ("checked");
                                                    } ?> id="emergency_evac_system" name="emergency_evac_system" type="checkbox" class="checkemergency_evac_systemEdit <?= ($validation->hasError('emergency_evac_system')) ? 'is-invalid' : ''; ?>" onclick="checkemergency_evac_systemEdit(this.value);" value="0">
                                            Tidak
                                        </div>
                                        <?php if ($validation->hasError('emergency_evac_system')) : ?>
                                            <div class="hasil-validasi" style="font-size: 85.71428571%; color: #d63939;">
                                                <?= $validation->getError('emergency_evac_system'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <script>
                                        function checkemergency_evac_systemEdit(b) {
                                            var x = document.getElementsByClassName('checkemergency_evac_systemEdit');
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

        let urlUpdate = site_url + '/soundsystem/updateSoundSystem/';
        let urlAjaxData = site_url + '/soundsystem/ajaxDataSoundSystem/';
        let urlDelete = site_url + '/soundsystem/deleteSoundSystem/';
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
                        modalView.find("#amplifier[value=" + data.data.amplifier + "]").prop('checked', true);
                        modalView.find("#mixer[value=" + data.data.mixer + "]").prop('checked', true);
                        modalView.find("#radio_fm[value=" + data.data.radio_fm + "]").prop('checked', true);
                        modalView.find("#cd_mp3_player[value=" + data.data.cd_mp3_player + "]").prop('checked', true);
                        modalView.find("#switch_zone[value=" + data.data.switch_zone + "]").prop('checked', true);
                        modalView.find("#mic_announcer[value=" + data.data.mic_announcer + "]").prop('checked', true);
                        modalView.find("#car_call[value=" + data.data.car_call + "]").prop('checked', true);
                        modalView.find("#emergency_evac_system[value=" + data.data.emergency_evac_system + "]").prop('checked', true);
                        modalView.find("#speaker_jumlah").val(data.data.speaker_jumlah);
                        modalView.find("#speaker_keterangan").val(data.data.speaker_keterangan);
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