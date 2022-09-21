<?= $this->extend('template_worker/index'); ?>

<?= $this->section('page-content'); ?>

<div class="page-body">
    <div class="container-xl">
        <div class="row row-deck row-cards">
            <?php if(session("error")) { ?>
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

            <?php if(session("success")) { ?>
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
                        <h3 class="card-title">AC Splitwall, Duck, Cassette, VRV</h3>
                    </div>

                    <div class="card-body">
                        <form action="<?php echo base_url('acsplitwallduckcassettevrv/saveAcSplitWallDuckCassetteVrv'); ?>" method="post">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-4 col-form-label">Location</label>
                                        <div class="col">
                                            <div class="input-icon mb-2">
                                                <input class="form-control" value="<?= $location ?>" disabled >
                                                <input id="location" name="location" class="form-control" value="<?= $idstore; ?>" hidden >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-3 row">
                                        <?php
                                            $time1 = 0;

                                            if(!$getAcSplitWallDuckCassetteVrvByStoreDate) {
                                                $time1 = 1;
                                            }
                                        ?>

                                        <label class="form-label col-4 col-form-label">Date</label>
                                        <div class="col">
                                            <div class="input-icon mb-2">
                                                <input class="form-control <?php if(!$time1) { echo("is-invalid"); } ?>" value="<?= date('d-m-Y'); ?>" disabled>
                                                <input id="date" name="date" class="form-control" value="<?php if($time1) { echo(date('d-m-Y')); } ?>" hidden>
                                                
                                                <?php if(!$time1): ?>
                                                    <div class="invalid-feedback">
                                                        This month checklist has been completed
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-4 col-form-label">Worker</label>
                                        <div class="col">
                                            <div class="input-icon mb-2">
                                                <input class="form-control" value="<?= $name ?>" disabled >
                                                <input id="worker" name="worker" class="form-control" value="<?= $id ?>" hidden >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-4 col-form-label">Checklist</label>
                                        <div class="col">
                                            <div class="input-icon mb-2">
                                                <input class="form-control" value="Monthly" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                            <div style="width: 100%; border-top: 1px solid lightgrey; height: 0; margin-top: 20px; margin-bottom: 20px;"></div>
                        
                            <div class="row">
                                <div class="col">
                                    <div class="form-group" style="padding-top: 20px;">
                                        <div class="mb-3 row">
                                            <label class="form-label col-4 col-form-label">Merk</label>
                                            <div class="col">
                                                <div class="input-icon mb-2">
                                                    <input id="merk" name="merk" class="form-control <?= ($validation->hasError('merk')) ? 'is-invalid' : ''; ?>" value="<?= old('merk'); ?>">
                                                    <?php if($validation->hasError('merk')): ?>
                                                        <div class="invalid-feedback">
                                                            <?= $validation->getError('merk'); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="mb-3 row">
                                            <label class="form-label col-4 col-form-label">Type</label>
                                            <div class="col">
                                                <div class="input-icon mb-2">
                                                    <input id="type" name="type" class="form-control <?= ($validation->hasError('type')) ? 'is-invalid' : ''; ?>" value="<?= old('type'); ?>">
                                                    <?php if($validation->hasError('type')): ?>
                                                        <div class="invalid-feedback">
                                                            <?= $validation->getError('type'); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="mb-3 row">
                                            <label class="form-label col-4 col-form-label">No. Seri Outdoor</label>
                                            <div class="col">
                                                <div class="input-icon mb-2">
                                                    <input id="serial" name="serial" class="form-control <?= ($validation->hasError('serial')) ? 'is-invalid' : ''; ?>" value="<?= old('serial'); ?>">
                                                    <?php if($validation->hasError('serial')): ?>
                                                        <div class="invalid-feedback">
                                                            <?= $validation->getError('serial'); ?>
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
                                                    <td rowspan="2">Lokasi</td>
                                                    <td>Ruang</td>
                                                    <td>
                                                        <input id="room" name="room" class="form-control <?= ($validation->hasError('room')) ? 'is-invalid' : ''; ?>" value="<?= old('room'); ?>">
                                                        <?php if($validation->hasError('room')): ?>
                                                            <div class="invalid-feedback" style="white-space: normal;">
                                                                <?= $validation->getError('room'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 8px;">Lantai</td>
                                                    <td>
                                                        <input id="floor" name="floor" class="form-control <?= ($validation->hasError('floor')) ? 'is-invalid' : ''; ?>" value="<?= old('floor'); ?>">
                                                        <?php if($validation->hasError('floor')): ?>
                                                            <div class="invalid-feedback" style="white-space: normal;">
                                                                <?= $validation->getError('floor'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                                
                                                <tr style="border: 0;">
                                                    <td style="border: 0;"></td>
                                                    <td style="border: 0;"></td>
                                                    <td style="border: 0;"></td>
                                                </tr>

                                                <tr>
                                                    <td rowspan="2">Hasil Ukur Ampere</td>
                                                    <td>Sebelum</td>
                                                    <td>
                                                        <div class="form-group row">
                                                            <div class="col">
                                                                <input id="a_before" name="a_before" class="form-control <?= ($validation->hasError('a_before')) ? 'is-invalid' : ''; ?>" value="<?= old('a_before'); ?>">
                                                                <?php if($validation->hasError('a_before')): ?>
                                                                    <div class="invalid-feedback" style="white-space: normal;">
                                                                        <?= $validation->getError('a_before'); ?>
                                                                    </div>
                                                                <?php endif; ?>
                                                            </div>
                                                            <label class="form-label col-3 col-form-label">A</label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 8px;">Sesudah</td>
                                                    <td>
                                                        <div class="form-group row">
                                                            <div class="col">
                                                                <input id="a_after" name="a_after" class="form-control <?= ($validation->hasError('a_after')) ? 'is-invalid' : ''; ?>" value="<?= old('a_after'); ?>">
                                                                <?php if($validation->hasError('a_after')): ?>
                                                                    <div class="invalid-feedback" style="white-space: normal;">
                                                                        <?= $validation->getError('a_after'); ?>
                                                                    </div>
                                                                <?php endif; ?>
                                                            </div>
                                                            <label class="form-label col-3 col-form-label">A</label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                
                                                <tr style="border: 0;">
                                                    <td style="border: 0;"></td>
                                                    <td style="border: 0;"></td>
                                                    <td style="border: 0;"></td>
                                                </tr>

                                                <tr>
                                                    <td rowspan="3">Refrigerant Suction Pressure</td>
                                                    <td>R22<br>50 - 70 PSI</td>
                                                    <td>
                                                        <div class="form-group row">
                                                            <div class="col">
                                                                <input id="r22" name="r22" class="form-control <?= ($validation->hasError('r22')) ? 'is-invalid' : ''; ?>" value="<?= old('r22'); ?>">
                                                                <?php if($validation->hasError('r22')): ?>
                                                                    <div class="invalid-feedback" style="white-space: normal;">
                                                                        <?= $validation->getError('r22'); ?>
                                                                    </div>
                                                                <?php endif; ?>
                                                            </div>
                                                            <label class="form-label col-3 col-form-label">PSI</label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 8px;">R32<br>115 - 135 PSI</td>
                                                    <td>
                                                        <div class="form-group row">
                                                            <div class="col">
                                                                <input id="r32" name="r32" class="form-control <?= ($validation->hasError('r32')) ? 'is-invalid' : ''; ?>" value="<?= old('r32'); ?>">
                                                                <?php if($validation->hasError('r32')): ?>
                                                                    <div class="invalid-feedback" style="white-space: normal;">
                                                                        <?= $validation->getError('r32'); ?>
                                                                    </div>
                                                                <?php endif; ?>
                                                            </div>
                                                            <label class="form-label col-3 col-form-label">PSI</label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 8px;">R410A<br>115 - 135 PSI</td>
                                                    <td>
                                                        <div class="form-group row">
                                                            <div class="col">
                                                                <input id="r410a" name="r410a" class="form-control <?= ($validation->hasError('r410a')) ? 'is-invalid' : ''; ?>" value="<?= old('r410a'); ?>">
                                                                <?php if($validation->hasError('r410a')): ?>
                                                                    <div class="invalid-feedback" style="white-space: normal;">
                                                                        <?= $validation->getError('r410a'); ?>
                                                                    </div>
                                                                <?php endif; ?>
                                                            </div>
                                                            <label class="form-label col-3 col-form-label">PSI</label>
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

                                <div class="col">
                                    <div class="table-responsive">
                                        <table class="table table-bordered card-table table-vcenter text-nowrap datatable" style="width:100%">
                                            <tbody>
                                                <tr style="border: 0;">
                                                    <td style="border: 0;"></td>
                                                    <td style="border: 0;"></td>
                                                    <td style="border: 0;"></td>
                                                </tr>

                                                <tr>
                                                    <td rowspan="5" style="padding-left: 8px;">Action</td>
                                                    <td>Filter Udara</td>
                                                    <td><input id="action_filter" name="action_filter" type="checkbox" class="actionchecks" value="1"></td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 8px;">Evaporator</td>
                                                    <td><input id="action_evaporator" name="action_evaporator" type="checkbox" class="actionchecks" value="1"></td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 8px;">Condenser</td>
                                                    <td><input id="action_condenser" name="action_condenser" type="checkbox" class="actionchecks" value="1"></td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 8px;">Casing/Cover</td>
                                                    <td><input id="action_cover" name="action_cover" type="checkbox" class="actionchecks" value="1"></td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 8px;">Drainage</td>
                                                    <td><input id="action_drainage" name="action_drainage" type="checkbox" class="actionchecks" value="1"></td>
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
                                        <div class="form-group">
                                            <label class="form-label row-form-label">Spare Part</label>
                                            <div class="row">
                                                <div class="input-icon mb-2">
                                                    <textarea id="spare_part" name="spare_part" class="form-control <?= ($validation->hasError('spare_part')) ? 'is-invalid' : ''; ?>" rows="6"><?= old('spare_part'); ?></textarea>
                                                    <?php if($validation->hasError('spare_part')): ?>
                                                        <div style="font-size: 85.71428571%; color: #d63939; white-space: normal;">
                                                            <?= $validation->getError('spare_part'); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <label class="form-label row-form-label">Keterangan</label>
                                            <div class="row">
                                                <div class="input-icon mb-2">
                                                    <textarea id="description" name="description" class="form-control <?= ($validation->hasError('description')) ? 'is-invalid' : ''; ?>" rows="6"><?= old('description'); ?></textarea>
                                                    <?php if($validation->hasError('description')): ?>
                                                        <div style="font-size: 85.71428571%; color: #d63939; white-space: normal;">
                                                            <?= $validation->getError('description'); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-footer">
                                <div class="row align-items-center">
                                    <div class="col"></div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-outline-primary ms-auto" id="btnSubmitAcSplitWallDuckCassetteVrv" name="btnSubmitAcSplitWallDuckCassetteVrv">
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
                                            Clear
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
                        <h3 class="card-title">AC Splitwall, Duck, Cassette, VRV Data</h3>
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
                                    <th>Date</th>
                                    <th>Worker</th>
                                    <th>Merk</th>
                                    <th>Type</th>
                                    <th>No. Seri Outdoor</th>
                                    <th>LOKASI<br>Ruang</th>
                                    <th>LOKASI<br>Lantai</th>
                                    <th>HASIL UKUR AMPERE<br>Sebelum</th>
                                    <th>HASIL UKUR AMPERE<br>Sesudah</th>
                                    <th>REFRIGERANT SUCTION PRESSURE<br>R22<br>50 - 70 PSI</th>
                                    <th>REFRIGERANT SUCTION PRESSURE<br>R32<br>115 - 135 PSI</th>
                                    <th>REFRIGERANT SUCTION PRESSURE<br>R410A<br>115 - 135 PSI</th>
                                    <th>ACTION<br>Filter Udara</th>
                                    <th>ACTION<br>Evaporator</th>
                                    <th>ACTION<br>Condenser</th>
                                    <th>ACTION<br>Casing/Cover</th>
                                    <th>ACTION<br>Drainage</th>
                                    <th>Spare Part</th>
                                    <th>Keterangan</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                    $n = 1;
                                ?>
                                <?php foreach($getAcSplitWallDuckCassetteVrvByStore as $t): ?>
                                    <?php
                                        $date = new DateTime($t['date']);                          
                                    ?>

                                    <tr>
                                        <td><?= $n ?></td>

                                        <td><?= $t['store_name'] ?></td>
                                        <td><?= $date->format('j F Y') ?></td>
                                        <td><?= $t['worker_name'] ?></td>
                                        <td><?= $t['merk'] ?></td>
                                        <td><?= $t['type'] ?></td>
                                        <td><?= $t['serial'] ?></td>
                                        <td><?= $t['room'] ?></td>
                                        <td><?= $t['floor'] ?></td>
                                        <td><?= $t['a_before'] ?></td>
                                        <td><?= $t['a_after'] ?></td>
                                        <td><?= $t['r22'] ?></td>
                                        <td><?= $t['r32'] ?></td>
                                        <td><?= $t['r410a'] ?></td>
                                        <td><input type="checkbox" onclick="return false;" <?php if($t['action_filter']) { echo("checked"); } ?>></td>
                                        <td><input type="checkbox" onclick="return false;" <?php if($t['action_evaporator']) { echo("checked"); } ?>></td>
                                        <td><input type="checkbox" onclick="return false;" <?php if($t['action_condenser']) { echo("checked"); } ?>></td>
                                        <td><input type="checkbox" onclick="return false;" <?php if($t['action_cover']) { echo("checked"); } ?>></td>
                                        <td><input type="checkbox" onclick="return false;" <?php if($t['action_drainage']) { echo("checked"); } ?>></td>
                                        <td><?= $t['spare_part'] ?></td>
                                        <td><?= $t['description'] ?></td>
                                        
                                        <td class="text-end">
                                            <div class="row g-2 align-items-center mb-n3">
                                                <div class="col-6 col-sm-4 col-md-2 col-xl-auto mb-3">
                                                    <button href="#myModalEdit<?= $n; ?>" id="btnModalEdit<?= $t['id']; ?>" data-bs-toggle="modal" data-bs-target="#modal-editdata<?= $n; ?>" class="btn btn-outline-success w-100 btn-icon btn-edit">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                                            <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                                            <path d="M16 5l3 3"></path>
                                                        </svg>
                                                    </button>
                                                </div>

                                                <div class="col-6 col-sm-4 col-md-2 col-xl-auto mb-3">
                                                    <button href="#myModalDelete<?= $n; ?>" class="btn btn-outline-danger w-100 btn-icon" aria-label="DeleteData" data-bs-toggle="modal" data-bs-target="#modal-deletedata<?= $n; ?>">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <line x1="4" y1="7" x2="20" y2="7"></line>
                                                            <line x1="10" y1="11" x2="10" y2="17"></line>
                                                            <line x1="14" y1="11" x2="14" y2="17"></line>
                                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Modal edit data -->
                                    <div class="modal modal-blur fade" id="modal-editdata<?= $n; ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                                        <form id="editAcSplitWallDuckCassetteVrvForm" action="<?php echo base_url('acsplitwallduckcassettevrv/updateAcSplitWallDuckCassetteVrv/' . $t['id']); ?>" method="post">
                                            <div class="modal-dialog modal-xl modal-dialog-centered" role="dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit AC Splitwall, Duck, Cassette, VRV Data</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-lg-3">
                                                                <input type="text" class="form-control" id="editid" name="editid" value="<?= $t['id']; ?>" hidden>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Location</label>
                                                                    <input type="text" class="form-control" value="<?= $location ?>" disabled>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Date</label>
                                                                    <input type="text" class="form-control" placeholder="dd-mm-yyyy" value="<?= $t['date']; ?>" disabled>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Worker</label>
                                                                    <input type="text" class="form-control" value="<?= $name; ?>*" disabled>
                                                                    <input type="text" class="form-control" id="editworker" name="editworker" value="<?= $id; ?>" hidden>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Checklist</label>
                                                                    <input type="text" class="form-control" value="Monthly" disabled>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-3">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Merk</label>
                                                                    <div class='row' style="margin: 0px;">
                                                                        <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editmerk'))) ? 'is-invalid' : ''; ?>" id="editmerk" name="editmerk" value="<?= $t['merk']; ?>">
                                                                    </div>
                                                                    <?php if(($t['id'] == old('editid')) && ($validation->hasError('editmerk'))): ?>
                                                                        <div style="font-size: 85.71428571%; color: #d63939; white-space: normal;">
                                                                            <?= $validation->getError('editmerk'); ?>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Type</label>
                                                                    <div class='row' style="margin: 0px;">
                                                                        <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('edittype'))) ? 'is-invalid' : ''; ?>" id="edittype" name="edittype" value="<?= $t['type']; ?>">
                                                                    </div>
                                                                    <?php if(($t['id'] == old('editid')) && ($validation->hasError('edittype'))): ?>
                                                                        <div style="font-size: 85.71428571%; color: #d63939; white-space: normal;">
                                                                            <?= $validation->getError('edittype'); ?>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">No. Seri Outdoor</label>
                                                                    <div class='row' style="margin: 0px;">
                                                                        <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editserial'))) ? 'is-invalid' : ''; ?>" id="editserial" name="editserial" value="<?= $t['serial']; ?>">
                                                                    </div>
                                                                    <?php if(($t['id'] == old('editid')) && ($validation->hasError('editserial'))): ?>
                                                                        <div style="font-size: 85.71428571%; color: #d63939; white-space: normal;">
                                                                            <?= $validation->getError('editserial'); ?>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>

                                                                <div style="padding: 10px; background-color: aliceblue;">
                                                                    <div class="mb-3 text-center">
                                                                        <label class="form-label" style="color: lightsteelblue; font-weight: bold; opacity: 90%;">Lokasi</label>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Ruang</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editroom'))) ? 'is-invalid' : ''; ?>" id="editroom" name="editroom" value="<?= $t['room']; ?>">
                                                                        </div>
                                                                        <?php if(($t['id'] == old('editid')) && ($validation->hasError('editroom'))): ?>
                                                                            <div style="font-size: 85.71428571%; color: #d63939; white-space: normal;">
                                                                                <?= $validation->getError('editroom'); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Lantai</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editfloor'))) ? 'is-invalid' : ''; ?>" id="editfloor" name="editfloor" value="<?= $t['floor']; ?>">
                                                                        </div>
                                                                        <?php if(($t['id'] == old('editid')) && ($validation->hasError('editfloor'))): ?>
                                                                            <div style="font-size: 85.71428571%; color: #d63939; white-space: normal;">
                                                                                <?= $validation->getError('editfloor'); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-3">
                                                                <div style="padding: 10px; background-color: aliceblue;">
                                                                    <div class="mb-3 text-center">
                                                                        <label class="form-label" style="color: lightsteelblue; font-weight: bold; opacity: 90%;">Hasil Ukur Ampere</label>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Sebelum</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editabefore'))) ? 'is-invalid' : ''; ?>" id="editabefore" name="editabefore" value="<?= $t['a_before']; ?>">
                                                                            <label class="form-label col-2" style="margin-top: auto; margin-bottom: auto;">A</label>
                                                                        </div>
                                                                        <?php if(($t['id'] == old('editid')) && ($validation->hasError('editabefore'))): ?>
                                                                            <div style="font-size: 85.71428571%; color: #d63939; white-space: normal;">
                                                                                <?= $validation->getError('editabefore'); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Sesudah</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editaafter'))) ? 'is-invalid' : ''; ?>" id="editaafter" name="editaafter" value="<?= $t['a_after']; ?>">
                                                                            <label class="form-label col-2" style="margin-top: auto; margin-bottom: auto;">A</label>
                                                                        </div>
                                                                        <?php if(($t['id'] == old('editid')) && ($validation->hasError('editaafter'))): ?>
                                                                            <div style="font-size: 85.71428571%; color: #d63939; white-space: normal;">
                                                                                <?= $validation->getError('editaafter'); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>

                                                                <div style="padding: 10px; background-color: aliceblue;">
                                                                    <div class="mb-3 text-center">
                                                                        <label class="form-label" style="color: lightsteelblue; font-weight: bold; opacity: 90%;">Refrigerant Suction Pressure</label>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">R22 50 - 70 PSI</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editr22'))) ? 'is-invalid' : ''; ?>" id="editr22" name="editr22" value="<?= $t['r22']; ?>">
                                                                            <label class="form-label col-2" style="margin-top: auto; margin-bottom: auto;">PSI</label>
                                                                        </div>
                                                                        <?php if(($t['id'] == old('editid')) && ($validation->hasError('editr22'))): ?>
                                                                            <div style="font-size: 85.71428571%; color: #d63939; white-space: normal;">
                                                                                <?= $validation->getError('editr22'); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">R32 115 - 135 PSI</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editr32'))) ? 'is-invalid' : ''; ?>" id="editr32" name="editr32" value="<?= $t['r32']; ?>">
                                                                            <label class="form-label col-2" style="margin-top: auto; margin-bottom: auto;">PSI</label>
                                                                        </div>
                                                                        <?php if(($t['id'] == old('editid')) && ($validation->hasError('editr32'))): ?>
                                                                            <div style="font-size: 85.71428571%; color: #d63939; white-space: normal;">
                                                                                <?= $validation->getError('editr32'); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">R410A 115 - 135 PSI</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editr410a'))) ? 'is-invalid' : ''; ?>" id="editr410a" name="editr410a" value="<?= $t['r410a']; ?>">
                                                                            <label class="form-label col-2" style="margin-top: auto; margin-bottom: auto;">PSI</label>
                                                                        </div>
                                                                        <?php if(($t['id'] == old('editid')) && ($validation->hasError('editr410a'))): ?>
                                                                            <div style="font-size: 85.71428571%; color: #d63939; white-space: normal;">
                                                                                <?= $validation->getError('editr410a'); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-3">
                                                                <div style="padding: 10px; background-color: aliceblue;">
                                                                    <div class="mb-3 text-center">
                                                                        <label class="form-label" style="color: lightsteelblue; font-weight: bold; opacity: 90%;">Action</label>
                                                                    </div>

                                                                    <div class="col">
                                                                        <input <?php if($t['action_filter']) { echo("checked"); } ?> id="editactionfilter" name="editactionfilter" type="checkbox" value="1">
                                                                        <span>Filter Udara</span>
                                                                    </div>
                                                                    
                                                                    <div class="col">
                                                                        <input <?php if($t['action_evaporator']) { echo("checked"); } ?> id="editactionevaporator" name="editactionevaporator" type="checkbox" value="1">
                                                                        <span>Evaporator</span>
                                                                    </div>
                                                                    
                                                                    <div class="col">
                                                                        <input <?php if($t['action_condenser']) { echo("checked"); } ?> id="editactioncondenser" name="editactioncondenser" type="checkbox" value="1">
                                                                        <span>Condenser</span>
                                                                    </div>
                                                                    
                                                                    <div class="col">
                                                                        <input <?php if($t['action_cover']) { echo("checked"); } ?> id="editactioncover" name="editactioncover" type="checkbox" value="1">
                                                                        <span>Casing/Cover</span>
                                                                    </div>
                                                                    
                                                                    <div class="col">
                                                                        <input <?php if($t['action_drainage']) { echo("checked"); } ?> id="editactiondrainage" name="editactiondrainage" type="checkbox" value="1">
                                                                        <span>Drainage</span>
                                                                    </div>
                                                                </div>

                                                                <div class="mb-3" style="margin-top: 15px;">
                                                                    <label class="form-label">Spare Part</label>

                                                                    <div class='row' style="margin: 0px;">
                                                                        <textarea class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editsparepart')))? 'is-invalid' : ''; ?>" id="editsparepart" name="editsparepart" rows="3"><?= $t['spare_part']; ?></textarea>
                                                                    </div>

                                                                    <?php if(($t['id'] == old('editid')) && ($validation->hasError('editsparepart'))): ?>
                                                                        <div style="font-size: 85.71428571%; color: #d63939; white-space: normal;">
                                                                            <?= $validation->getError('editsparepart'); ?>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>

                                                                <div class="mb-3" style="margin-top: 15px;">
                                                                    <label class="form-label">Keterangan</label>

                                                                    <div class='row' style="margin: 0px;">
                                                                        <textarea class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editdescription')))? 'is-invalid' : ''; ?>" id="editdescription" name="editdescription" rows="3"><?= $t['description']; ?></textarea>
                                                                    </div>

                                                                    <?php if(($t['id'] == old('editid')) && ($validation->hasError('editdescription'))): ?>
                                                                        <div style="font-size: 85.71428571%; color: #d63939; white-space: normal;">
                                                                            <?= $validation->getError('editdescription'); ?>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <div class="col-auto">
                                                            <button type="submit" class="btn btn-outline-primary ms-auto" id="btnUpdateAcSplitWallDuckCassetteVrv" name="btnUpdateAcSplitWallDuckCassetteVrv" data-bs-dismiss="modal" data-id="<?= $t['id']; ?>">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-refresh" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                    <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4"></path>
                                                                    <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4"></path>
                                                                </svg>
                                                                Save
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
                                            </div>
                                        </form>
                                    </div>

                                    <!-- Modal delete data -->
                                    <div class="modal modal-blur fade" id="modal-deletedata<?= $n; ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                                        <form id="deleteAcSplitWallDuckCassetteVrvForm" action="<?php echo base_url('acsplitwallduckcassettevrv/deleteAcSplitWallDuckCassetteVrv/' . $t['id']); ?>" method="post">
                                            <div class="modal-dialog modal-xl modal-dialog-centered" role="dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Delete AC Splitwall, Duck, Cassette, VRV Data</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-lg-3">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Location</label>
                                                                    <input type="text" class="form-control" value="<?= $location ?>" disabled>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Date</label>
                                                                    <input type="text" class="form-control" placeholder="dd-mm-yyyy" value="<?= $t['date']; ?>" disabled>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Worker</label>
                                                                    <input type="text" class="form-control" value="<?= $t['worker_name']; ?>" disabled>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Checklist</label>
                                                                    <input type="text" class="form-control" value="Monthly" disabled>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-3">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Merk</label>
                                                                    <div class='row' style="margin: 0px;">
                                                                        <input class="form-control" type="text" value="<?= $t['merk']; ?>" disabled>
                                                                    </div>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Type</label>
                                                                    <div class='row' style="margin: 0px;">
                                                                        <input class="form-control" type="text" value="<?= $t['type']; ?>" disabled>
                                                                    </div>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">No. Seri Outdoor</label>
                                                                    <div class='row' style="margin: 0px;">
                                                                        <input class="form-control" type="text" value="<?= $t['serial']; ?>" disabled>
                                                                    </div>
                                                                </div>

                                                                <div style="padding: 10px; background-color: aliceblue;">
                                                                    <div class="mb-3 text-center">
                                                                        <label class="form-label" style="color: lightsteelblue; font-weight: bold; opacity: 90%;">Lokasi</label>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Ruang</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input class="form-control" type="text" value="<?= $t['room']; ?>" disabled>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Lantai</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input class="form-control" type="text" value="<?= $t['floor']; ?>" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-3">
                                                                <div style="padding: 10px; background-color: aliceblue;">
                                                                    <div class="mb-3 text-center">
                                                                        <label class="form-label" style="color: lightsteelblue; font-weight: bold; opacity: 90%;">Hasil Ukur Ampere</label>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Sebelum</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input class="form-control col" type="text" value="<?= $t['a_before']; ?>" disabled>
                                                                            <label class="form-label col-2" style="margin-top: auto; margin-bottom: auto;">A</label>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Sesudah</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input class="form-control col" type="text" value="<?= $t['a_after']; ?>" disabled>
                                                                            <label class="form-label col-2" style="margin-top: auto; margin-bottom: auto;">A</label>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div style="padding: 10px; background-color: aliceblue;">
                                                                    <div class="mb-3 text-center">
                                                                        <label class="form-label" style="color: lightsteelblue; font-weight: bold; opacity: 90%;">Refrigerant Suction Pressure</label>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">R22 50 - 70 PSI</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input class="form-control col" type="text" value="<?= $t['r22']; ?>" disabled>
                                                                            <label class="form-label col-2" style="margin-top: auto; margin-bottom: auto;">PSI</label>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">R32 115 - 135 PSI</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input class="form-control col" type="text" value="<?= $t['r32']; ?>" disabled>
                                                                            <label class="form-label col-2" style="margin-top: auto; margin-bottom: auto;">PSI</label>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">R410A 115 - 135 PSI</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input class="form-control col" type="text" value="<?= $t['r410a']; ?>" disabled>
                                                                            <label class="form-label col-2" style="margin-top: auto; margin-bottom: auto;">PSI</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-3">
                                                                <div style="padding: 10px; background-color: aliceblue;">
                                                                    <div class="mb-3 text-center">
                                                                        <label class="form-label" style="color: lightsteelblue; font-weight: bold; opacity: 90%;">Action</label>
                                                                    </div>

                                                                    <div class="col">
                                                                        <input onclick="return false;" <?php if($t['action_filter']) { echo("checked"); } ?> type="checkbox" value="1">
                                                                        <span>Filter Udara</span>
                                                                    </div>
                                                                    
                                                                    <div class="col">
                                                                        <input onclick="return false;" <?php if($t['action_evaporator']) { echo("checked"); } ?> type="checkbox" value="1">
                                                                        <span>Evaporator</span>
                                                                    </div>
                                                                    
                                                                    <div class="col">
                                                                        <input onclick="return false;" <?php if($t['action_condenser']) { echo("checked"); } ?> type="checkbox" value="1">
                                                                        <span>Condenser</span>
                                                                    </div>
                                                                    
                                                                    <div class="col">
                                                                        <input onclick="return false;" <?php if($t['action_cover']) { echo("checked"); } ?> type="checkbox" value="1">
                                                                        <span>Casing/Cover</span>
                                                                    </div>
                                                                    
                                                                    <div class="col">
                                                                        <input onclick="return false;" <?php if($t['action_drainage']) { echo("checked"); } ?> type="checkbox" value="1">
                                                                        <span>Drainage</span>
                                                                    </div>
                                                                </div>

                                                                <div class="mb-3" style="margin-top: 15px;">
                                                                    <label class="form-label">Spare Part</label>
                                                                    <div class='row' style="margin: 0px;">
                                                                        <textarea class="form-control" rows="3" disabled><?= $t['spare_part']; ?></textarea>
                                                                    </div>
                                                                </div>

                                                                <div class="mb-3" style="margin-top: 15px;">
                                                                    <label class="form-label">Keterangan</label>
                                                                    <div class='row' style="margin: 0px;">
                                                                        <textarea class="form-control" rows="3" disabled><?= $t['description']; ?></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <div class="col-auto">
                                                            <button type="submit" class="btn btn-outline-danger ms-auto" id="btnDeleteAcSplitWallDuckCassetteVrv" name="btnDeleteAcSplitWallDuckCassetteVrv" data-bs-dismiss="modal" data-id="<?= $t['id']; ?>">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                    <line x1="4" y1="7" x2="20" y2="7"></line>
                                                                    <line x1="10" y1="11" x2="10" y2="17"></line>
                                                                    <line x1="14" y1="11" x2="14" y2="17"></line>
                                                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                                                </svg>
                                                                Delete
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
                                            </div>
                                        </form>
                                    </div>

                                    <?php $n++; ?>
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
                                if($s['idEquipment'] > 11) {
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

<?= $this->endSection(); ?>

<?= $this->section("scripts"); ?>

<script>
    $(document).ready(function() {
        $("#btnReset").on( "click", function() {
            $("input[type=checkbox]:not(:disabled):not(:hidden)").removeAttr('checked');
            $("input:not([type=checkbox]):not(:disabled):not(:hidden)").attr("value","");
            $("#description").html("");
        });
    })
</script>

<?= $this->endSection(); ?>