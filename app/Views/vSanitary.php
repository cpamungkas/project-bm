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
                        <h3 class="card-title">Sanitary</h3>
                    </div>

                    <div class="card-body">
                        <form action="<?php echo base_url('sanitary/saveSanitary'); ?>" method="post">
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
                                        <label class="form-label col-4 col-form-label">Date</label>
                                        <div class="col">
                                            <div class="input-icon mb-2">
                                                <input class="form-control" value="<?= date('d-m-Y'); ?>" disabled>
                                                <input id="date" name="date" class="form-control" value="<?= date('d-m-Y'); ?>" hidden>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-4">Time</label>
                                        <div class="col">
                                            <div>
                                                <?php
                                                    $time1 = 0;

                                                    foreach($getSanitaryByStoreDate as $t) {
                                                        if(strval($t['time']) == "10:00:00") {
                                                            $time1 = 1;
                                                        }
                                                    }
                                                ?>

                                                <input onclick="return false;" <?php if($time1 == 1) { echo("disabled"); } ?>checked id="time" name="time" type="checkbox" value="10:00:00" class="<?= ($validation->hasError('time')) ? 'is-invalid' : ''; ?>">
                                                <span <?php if($time1 == 1) { echo("style='opacity: 50%;'"); } ?>>10.00</span>

                                                <?php if($validation->hasError('time')): ?>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('time'); ?>
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
                                                <input class="form-control" value="Weekly" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                            <div style="width: 100%; border-top: 1px solid lightgrey; height: 0; margin-top: 20px; margin-bottom: 20px;"></div>
                        
                            <div class="row">
                                <div class="col">
                                    <div class="form-group mb-3" style="padding-top: 20px;">
                                        <div class="row">
                                            <label class="form-label col-4 col-form-label">Lantai</label>
                                            <div class="col">
                                                <div class="input-icon mb-2">
                                                    <input id="floor" name="floor" class="form-control <?= ($validation->hasError('floor')) ? 'is-invalid' : ''; ?>" value="<?= old('floor'); ?>">
                                                    <?php if($validation->hasError('floor')): ?>
                                                        <div class="invalid-feedback">
                                                            <?= $validation->getError('floor'); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <div class="row">
                                            <label class="form-label col-4 col-form-label">Ruang</label>
                                            <div class="col">
                                                <div class="input-icon mb-2">
                                                    <input id="room" name="room" class="form-control <?= ($validation->hasError('room')) ? 'is-invalid' : ''; ?>" value="<?= old('room'); ?>">
                                                    <?php if($validation->hasError('room')): ?>
                                                        <div class="invalid-feedback">
                                                            <?= $validation->getError('room'); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col"></div>
                            </div>
                            
                            <div class="row">
                                <div class="col">
                                    <div class="table-responsive">
                                        <table class="table table-bordered card-table table-vcenter text-nowrap datatable" style="width:100%">
                                            <tbody>
                                                <tr style="border: 0;">
                                                    <td style="border: 0;"></td>
                                                    <td style="border: 0;"></td>
                                                    <td style="border: 0;"></td>
                                                    <td style="border: 0;"></td>
                                                </tr>

                                                <tr>
                                                    <td rowspan="6">Toilet</td>
                                                    <td rowspan="4">Closet Duduk</td>
                                                    <td>Instalasi</td>
                                                    <td>
                                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                                            <input <?php if(old('closet_instalation') == "1") { echo("checked"); } ?> id="closet_instalation" name="closet_instalation" type="checkbox" class="closetinstalationchecks <?= ($validation->hasError('closet_instalation')) ? 'is-invalid' : ''; ?>" onClick="checkClosetInstalation(this.value);" value="1">
                                                            Baik<br>
                                                        </div>
                                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                                            <input <?php if(old('closet_instalation') == "0") { echo("checked"); } ?> id="closet_instalation" name="closet_instalation" type="checkbox" class="closetinstalationchecks <?= ($validation->hasError('closet_instalation')) ? 'is-invalid' : ''; ?>" onClick="checkClosetInstalation(this.value);" value="0">
                                                            Rusak
                                                        </div>
                                                        <?php if($validation->hasError('closet_instalation')): ?>
                                                            <div style="font-size: 85.71428571%; color: #d63939; white-space: normal;">
                                                                <?= $validation->getError('closet_instalation'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                    <script>
                                                        function checkClosetInstalation(b){
                                                            var x = document.getElementsByClassName('closetinstalationchecks');
                                                            var i;
                                                            for (i = 0; i < x.length; i++) {
                                                                if(x[i].value != b) x[i].checked = false;
                                                            }
                                                        }
                                                    </script>
                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 8px;">Jet Washer</td>
                                                    <td>
                                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                                            <input <?php if(old('closet_washer') == "1") { echo("checked"); } ?> id="closet_washer" name="closet_washer" type="checkbox" class="closetwasherchecks <?= ($validation->hasError('closet_washer')) ? 'is-invalid' : ''; ?>" onClick="checkClosetWasher(this.value);" value="1">
                                                            Baik<br>
                                                        </div>
                                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                                            <input <?php if(old('closet_washer') == "0") { echo("checked"); } ?> id="closet_washer" name="closet_washer" type="checkbox" class="closetwasherchecks <?= ($validation->hasError('closet_washer')) ? 'is-invalid' : ''; ?>" onClick="checkClosetWasher(this.value);" value="0">
                                                            Rusak
                                                        </div>
                                                        <?php if($validation->hasError('closet_washer')): ?>
                                                            <div style="font-size: 85.71428571%; color: #d63939; white-space: normal;">
                                                                <?= $validation->getError('closet_washer'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                    <script>
                                                        function checkClosetWasher(b){
                                                            var x = document.getElementsByClassName('closetwasherchecks');
                                                            var i;
                                                            for (i = 0; i < x.length; i++) {
                                                                if(x[i].value != b) x[i].checked = false;
                                                            }
                                                        }
                                                    </script>
                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 8px;">Pelampung Closet</td>
                                                    <td>
                                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                                            <input <?php if(old('closet_float') == "1") { echo("checked"); } ?> id="closet_float" name="closet_float" type="checkbox" class="closetfloatchecks <?= ($validation->hasError('closet_float')) ? 'is-invalid' : ''; ?>" onClick="checkClosetFloat(this.value);" value="1">
                                                            Baik<br>
                                                        </div>
                                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                                            <input <?php if(old('closet_float') == "0") { echo("checked"); } ?> id="closet_float" name="closet_float" type="checkbox" class="closetfloatchecks <?= ($validation->hasError('closet_float')) ? 'is-invalid' : ''; ?>" onClick="checkClosetFloat(this.value);" value="0">
                                                            Rusak
                                                        </div>
                                                        <?php if($validation->hasError('closet_float')): ?>
                                                            <div style="font-size: 85.71428571%; color: #d63939; white-space: normal;">
                                                                <?= $validation->getError('closet_float'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                    <script>
                                                        function checkClosetFloat(b){
                                                            var x = document.getElementsByClassName('closetfloatchecks');
                                                            var i;
                                                            for (i = 0; i < x.length; i++) {
                                                                if(x[i].value != b) x[i].checked = false;
                                                            }
                                                        }
                                                    </script>
                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 8px;">Kran Tembok</td>
                                                    <td>
                                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                                            <input <?php if(old('closet_faucet') == "1") { echo("checked"); } ?> id="closet_faucet" name="closet_faucet" type="checkbox" class="closetfaucetchecks <?= ($validation->hasError('closet_faucet')) ? 'is-invalid' : ''; ?>" onClick="checkClosetFaucet(this.value);" value="1">
                                                            Baik<br>
                                                        </div>
                                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                                            <input <?php if(old('closet_faucet') == "0") { echo("checked"); } ?> id="closet_faucet" name="closet_faucet" type="checkbox" class="closetfaucetchecks <?= ($validation->hasError('closet_faucet')) ? 'is-invalid' : ''; ?>" onClick="checkClosetFaucet(this.value);" value="0">
                                                            Rusak
                                                        </div>
                                                        <?php if($validation->hasError('closet_faucet')): ?>
                                                            <div style="font-size: 85.71428571%; color: #d63939; white-space: normal;">
                                                                <?= $validation->getError('closet_faucet'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                    <script>
                                                        function checkClosetFaucet(b){
                                                            var x = document.getElementsByClassName('closetfaucetchecks');
                                                            var i;
                                                            for (i = 0; i < x.length; i++) {
                                                                if(x[i].value != b) x[i].checked = false;
                                                            }
                                                        }
                                                    </script>
                                                </tr>
                                                <tr>
                                                    <td rowspan="2" style="padding-left: 8px;">Urinoir</td>
                                                    <td style="padding-left: 8px;">Kran Flush</td>
                                                    <td>
                                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                                            <input <?php if(old('urinoir_faucet') == "1") { echo("checked"); } ?> id="urinoir_faucet" name="urinoir_faucet" type="checkbox" class="urinoirfaucetchecks <?= ($validation->hasError('urinoir_faucet')) ? 'is-invalid' : ''; ?>" onClick="checkUrinoirFaucet(this.value);" value="1">
                                                            Baik<br>
                                                        </div>
                                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                                            <input <?php if(old('urinoir_faucet') == "0") { echo("checked"); } ?> id="urinoir_faucet" name="urinoir_faucet" type="checkbox" class="urinoirfaucetchecks <?= ($validation->hasError('urinoir_faucet')) ? 'is-invalid' : ''; ?>" onClick="checkUrinoirFaucet(this.value);" value="0">
                                                            Rusak
                                                        </div>
                                                        <?php if($validation->hasError('urinoir_faucet')): ?>
                                                            <div style="font-size: 85.71428571%; color: #d63939; white-space: normal;">
                                                                <?= $validation->getError('urinoir_faucet'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                    <script>
                                                        function checkUrinoirFaucet(b){
                                                            var x = document.getElementsByClassName('urinoirfaucetchecks');
                                                            var i;
                                                            for (i = 0; i < x.length; i++) {
                                                                if(x[i].value != b) x[i].checked = false;
                                                            }
                                                        }
                                                    </script>
                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 8px;">Instalasi</td>
                                                    <td>
                                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                                            <input <?php if(old('urinoir_instalation') == "1") { echo("checked"); } ?> id="urinoir_instalation" name="urinoir_instalation" type="checkbox" class="urinoirinstalationchecks <?= ($validation->hasError('urinoir_instalation')) ? 'is-invalid' : ''; ?>" onClick="checkUrinoirInstalation(this.value);" value="1">
                                                            Baik<br>
                                                        </div>
                                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                                            <input <?php if(old('urinoir_instalation') == "0") { echo("checked"); } ?> id="urinoir_instalation" name="urinoir_instalation" type="checkbox" class="urinoirinstalationchecks <?= ($validation->hasError('urinoir_instalation')) ? 'is-invalid' : ''; ?>" onClick="checkUrinoirInstalation(this.value);" value="0">
                                                            Rusak
                                                        </div>
                                                        <?php if($validation->hasError('urinoir_instalation')): ?>
                                                            <div style="font-size: 85.71428571%; color: #d63939; white-space: normal;">
                                                                <?= $validation->getError('urinoir_instalation'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                    <script>
                                                        function checkUrinoirInstalation(b){
                                                            var x = document.getElementsByClassName('urinoirinstalationchecks');
                                                            var i;
                                                            for (i = 0; i < x.length; i++) {
                                                                if(x[i].value != b) x[i].checked = false;
                                                            }
                                                        }
                                                    </script>
                                                </tr>
                                                
                                                <tr style="border: 0;">
                                                    <td style="border: 0;"></td>
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
                                                    <td rowspan="2">Washtafel</td>
                                                    <td>Kran Tembok</td>
                                                    <td>
                                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                                            <input <?php if(old('washtafel_faucet') == "1") { echo("checked"); } ?> id="washtafel_faucet" name="washtafel_faucet" type="checkbox" class="washtafelfaucetchecks <?= ($validation->hasError('washtafel_faucet')) ? 'is-invalid' : ''; ?>" onClick="checkWashtafelFaucet(this.value);" value="1">
                                                            Baik<br>
                                                        </div>
                                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                                            <input <?php if(old('washtafel_faucet') == "0") { echo("checked"); } ?> id="washtafel_faucet" name="washtafel_faucet" type="checkbox" class="washtafelfaucetchecks <?= ($validation->hasError('washtafel_faucet')) ? 'is-invalid' : ''; ?>" onClick="checkWashtafelFaucet(this.value);" value="0">
                                                            Rusak
                                                        </div>
                                                        <?php if($validation->hasError('washtafel_faucet')): ?>
                                                            <div style="font-size: 85.71428571%; color: #d63939; white-space: normal;">
                                                                <?= $validation->getError('washtafel_faucet'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                    <script>
                                                        function checkWashtafelFaucet(b){
                                                            var x = document.getElementsByClassName('washtafelfaucetchecks');
                                                            var i;
                                                            for (i = 0; i < x.length; i++) {
                                                                if(x[i].value != b) x[i].checked = false;
                                                            }
                                                        }
                                                    </script>
                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 8px;">Instalasi</td>
                                                    <td>
                                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                                            <input <?php if(old('washtafel_instalation') == "1") { echo("checked"); } ?> id="washtafel_instalation" name="washtafel_instalation" type="checkbox" class="washtafelinstalationchecks <?= ($validation->hasError('washtafel_instalation')) ? 'is-invalid' : ''; ?>" onClick="checkWashtafelInstalation(this.value);" value="1">
                                                            Baik<br>
                                                        </div>
                                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                                            <input <?php if(old('washtafel_instalation') == "0") { echo("checked"); } ?> id="washtafel_instalation" name="washtafel_instalation" type="checkbox" class="washtafelinstalationchecks <?= ($validation->hasError('washtafel_instalation')) ? 'is-invalid' : ''; ?>" onClick="checkWashtafelInstalation(this.value);" value="0">
                                                            Rusak
                                                        </div>
                                                        <?php if($validation->hasError('washtafel_instalation')): ?>
                                                            <div style="font-size: 85.71428571%; color: #d63939; white-space: normal;">
                                                                <?= $validation->getError('washtafel_instalation'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                    <script>
                                                        function checkWashtafelInstalation(b){
                                                            var x = document.getElementsByClassName('washtafelinstalationchecks');
                                                            var i;
                                                            for (i = 0; i < x.length; i++) {
                                                                if(x[i].value != b) x[i].checked = false;
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
                                                    <td>Grease Trap</td>
                                                    <td>Filtrasi</td>
                                                    <td>
                                                        <div style="padding-top: 10px; padding-bottom: 5px;">
                                                            <input <?php if(old('filtration') == "1") { echo("checked"); } ?> id="filtration" name="filtration" type="checkbox" class="filtrationchecks <?= ($validation->hasError('filtration')) ? 'is-invalid' : ''; ?>" onClick="checkFiltration(this.value);" value="1">
                                                            Baik<br>
                                                        </div>
                                                        <div style="padding-top: 5px; padding-bottom: 10px;">
                                                            <input <?php if(old('filtration') == "0") { echo("checked"); } ?> id="filtration" name="filtration" type="checkbox" class="filtrationchecks <?= ($validation->hasError('filtration')) ? 'is-invalid' : ''; ?>" onClick="checkFiltration(this.value);" value="0">
                                                            Rusak
                                                        </div>
                                                        <?php if($validation->hasError('filtration')): ?>
                                                            <div style="font-size: 85.71428571%; color: #d63939; white-space: normal;">
                                                                <?= $validation->getError('filtration'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                    <script>
                                                        function checkFiltration(b){
                                                            var x = document.getElementsByClassName('filtrationchecks');
                                                            var i;
                                                            for (i = 0; i < x.length; i++) {
                                                                if(x[i].value != b) x[i].checked = false;
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

                                    <div class="form-group mb-3" style="padding-top: 10px;">
                                        <div class="row">
                                            <label class="form-label col-4 col-form-label">Temuan</label>
                                            <div class="col">
                                                <div class="input-icon mb-2">
                                                    <input id="discovery" name="discovery" class="form-control <?= ($validation->hasError('discovery')) ? 'is-invalid' : ''; ?>" value="<?= old('discovery'); ?>">
                                                    <?php if($validation->hasError('discovery')): ?>
                                                        <div class="invalid-feedback">
                                                            <?= $validation->getError('discovery'); ?>
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
                                        <button type="submit" class="btn btn-outline-primary ms-auto" id="btnSubmitSanitary" name="btnSubmitSanitary">
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
                        <h3 class="card-title">Sanitary Data</h3>
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
                                    <th>Time</th>
                                    <th>Worker</th>
                                    <th>Lantai</th>
                                    <th>Ruang</th>
                                    <th>CLOSET DUDUK<br>Instalasi</th>
                                    <th>CLOSET DUDUK<br>Jet Washer</th>
                                    <th>CLOSET DUDUK<br>Pelampung Closet</th>
                                    <th>CLOSET DUDUK<br>Kran Tembok</th>
                                    <th>URINOIR<br>Kran Flush</th>
                                    <th>URINOIR<br>Instalasi</th>
                                    <th>WASHTAFEL<br>Kran Tembok</th>
                                    <th>WASHTAFEL<br>Instalasi</th>
                                    <th>GREASE TAP<br>Filtrasi</th>
                                    <th>Temuan</th>
                                    <th>Keterangan</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                    $n = 1;
                                ?>
                                <?php foreach($getSanitaryByStore as $t): ?>
                                    <?php
                                        $date = new DateTime($t['date']);
                                        $time = new DateTime($t['time']);                          
                                    ?>

                                    <tr>
                                        <td><?= $n ?></td>

                                        <td><?= $t['store_name'] ?></td>
                                        <td><?= $date->format('j F Y') ?></td>
                                        <td><?= $time->format('H.i') ?></td>
                                        <td><?= $t['worker_name'] ?></td>
                                        <td><?= $t['floor'] ?></td>
                                        <td><?= $t['room'] ?></td>
                                        <td><?php if($t['closet_instalation']) { echo("Baik"); } else { echo("Rusak"); } ?></td>
                                        <td><?php if($t['closet_washer']) { echo("Baik"); } else { echo("Rusak"); } ?></td>
                                        <td><?php if($t['closet_float']) { echo("Baik"); } else { echo("Rusak"); } ?></td>
                                        <td><?php if($t['closet_faucet']) { echo("Baik"); } else { echo("Rusak"); } ?></td>
                                        <td><?php if($t['urinoir_faucet']) { echo("Baik"); } else { echo("Rusak"); } ?></td>
                                        <td><?php if($t['urinoir_instalation']) { echo("Baik"); } else { echo("Rusak"); } ?></td>
                                        <td><?php if($t['washtafel_faucet']) { echo("Baik"); } else { echo("Rusak"); } ?></td>
                                        <td><?php if($t['washtafel_instalation']) { echo("Baik"); } else { echo("Rusak"); } ?></td>
                                        <td><?php if($t['filtration']) { echo("Baik"); } else { echo("Rusak"); } ?></td>
                                        <td><?= $t['discovery'] ?></td>
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
                                        <form id="editSanitaryForm" action="<?php echo base_url('sanitary/updateSanitary/' . $t['id']); ?>" method="post">
                                            <div class="modal-dialog modal-lg modal-dialog-centered" role="dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Sanitary Data</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-lg-4">
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
                                                                    <label class="form-label">Time</label>
                                                                    
                                                                    <input checked id="edittime" name="edittime" type="checkbox" onclick="return false;" value="10:00:00">
                                                                    <span>10.00</span>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Worker</label>
                                                                    <input type="text" class="form-control" value="<?= $name; ?>*" disabled>
                                                                    <input type="text" class="form-control" id="editworker" name="editworker" value="<?= $id; ?>" hidden>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Checklist</label>
                                                                    <input type="text" class="form-control" value="Weekly" disabled>
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
                                                            </div>

                                                            <div class="col-lg-4">
                                                                <div style="padding: 10px; background-color: aliceblue;">
                                                                    <div class="mb-3 text-center">
                                                                        <label class="form-label" style="color: lightsteelblue; font-weight: bold; opacity: 90%;">Toilet: Closet Duduk</label>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Instalasi</label>

                                                                        <input <?php if($t['closet_instalation']) { echo("checked"); } ?> id="editclosetinstalation" name="editclosetinstalation" type="checkbox" class="editclosetinstalationchecks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editclosetinstalation')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditClosetInstalation' . $n . '(this.value)' ?>;" value="1">
                                                                        <span>Baik</span>                                                                        
                                                                        <span style="padding-left: 20px;"></span>                                                                        
                                                                        <input <?php if(!$t['closet_instalation']) { echo("checked"); } ?> id="editclosetinstalation" name="editclosetinstalation" type="checkbox" class="editclosetinstalationchecks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editclosetinstalation')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditClosetInstalation' . $n . '(this.value)' ?>;" value="0">
                                                                        <span>Rusak</span>                                                                        
                                                                        <?php if($validation->hasError('editclosetinstalation')): ?>
                                                                            <div class="invalid-feedback" style="white-space: normal;">
                                                                                <?= $validation->getError('editclosetinstalation'); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                        <script>
                                                                            function checkEditClosetInstalation<?= $n ?>(b){
                                                                                var x = document.getElementsByClassName('editclosetinstalationchecks<?= $n ?>');
                                                                                var i;
                                                                                for(i = 0; i < x.length; i++) {
                                                                                    if(x[i].value != b) x[i].checked = false;
                                                                                }
                                                                            }
                                                                        </script>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Jet Washer</label>

                                                                        <input <?php if($t['closet_washer']) { echo("checked"); } ?> id="editclosetwasher" name="editclosetwasher" type="checkbox" class="editclosetwasherchecks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editclosetwasher')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditClosetWasher' . $n . '(this.value)' ?>;" value="1">
                                                                        <span>Baik</span>                                                                        
                                                                        <span style="padding-left: 20px;"></span>                                                                        
                                                                        <input <?php if(!$t['closet_washer']) { echo("checked"); } ?> id="editclosetwasher" name="editclosetwasher" type="checkbox" class="editclosetwasherchecks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editclosetwasher')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditClosetWasher' . $n . '(this.value)' ?>;" value="0">
                                                                        <span>Rusak</span>                                                                        
                                                                        <?php if($validation->hasError('editclosetwasher')): ?>
                                                                            <div class="invalid-feedback" style="white-space: normal;">
                                                                                <?= $validation->getError('editclosetwasher'); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                        <script>
                                                                            function checkEditClosetWasher<?= $n ?>(b){
                                                                                var x = document.getElementsByClassName('editclosetwasherchecks<?= $n ?>');
                                                                                var i;
                                                                                for(i = 0; i < x.length; i++) {
                                                                                    if(x[i].value != b) x[i].checked = false;
                                                                                }
                                                                            }
                                                                        </script>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Pelampung Closet</label>

                                                                        <input <?php if($t['closet_float']) { echo("checked"); } ?> id="editclosetfloat" name="editclosetfloat" type="checkbox" class="editclosetfloatchecks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editclosetfloat')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditClosetFloat' . $n . '(this.value)' ?>;" value="1">
                                                                        <span>Baik</span>                                                                        
                                                                        <span style="padding-left: 20px;"></span>                                                                        
                                                                        <input <?php if(!$t['closet_float']) { echo("checked"); } ?> id="editclosetfloat" name="editclosetfloat" type="checkbox" class="editclosetfloatchecks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editclosetfloat')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditClosetFloat' . $n . '(this.value)' ?>;" value="0">
                                                                        <span>Rusak</span>                                                                        
                                                                        <?php if($validation->hasError('editclosetfloat')): ?>
                                                                            <div class="invalid-feedback" style="white-space: normal;">
                                                                                <?= $validation->getError('editclosetfloat'); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                        <script>
                                                                            function checkEditClosetFloat<?= $n ?>(b){
                                                                                var x = document.getElementsByClassName('editclosetfloatchecks<?= $n ?>');
                                                                                var i;
                                                                                for(i = 0; i < x.length; i++) {
                                                                                    if(x[i].value != b) x[i].checked = false;
                                                                                }
                                                                            }
                                                                        </script>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Kran Tembok</label>

                                                                        <input <?php if($t['closet_faucet']) { echo("checked"); } ?> id="editclosetfaucet" name="editclosetfaucet" type="checkbox" class="editclosetfaucetchecks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editclosetfaucet')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditClosetFaucet' . $n . '(this.value)' ?>;" value="1">
                                                                        <span>Baik</span>                                                                        
                                                                        <span style="padding-left: 20px;"></span>                                                                        
                                                                        <input <?php if(!$t['closet_faucet']) { echo("checked"); } ?> id="editclosetfaucet" name="editclosetfaucet" type="checkbox" class="editclosetfaucetchecks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editclosetfaucet')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditClosetFaucet' . $n . '(this.value)' ?>;" value="0">
                                                                        <span>Rusak</span>                                                                        
                                                                        <?php if($validation->hasError('editclosetfaucet')): ?>
                                                                            <div class="invalid-feedback" style="white-space: normal;">
                                                                                <?= $validation->getError('editclosetfaucet'); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                        <script>
                                                                            function checkEditClosetFaucet<?= $n ?>(b){
                                                                                var x = document.getElementsByClassName('editclosetfaucetchecks<?= $n ?>');
                                                                                var i;
                                                                                for(i = 0; i < x.length; i++) {
                                                                                    if(x[i].value != b) x[i].checked = false;
                                                                                }
                                                                            }
                                                                        </script>
                                                                    </div>
                                                                </div>

                                                                <div style="padding: 10px; background-color: aliceblue;">
                                                                    <div class="mb-3 text-center">
                                                                        <label class="form-label" style="color: lightsteelblue; font-weight: bold; opacity: 90%;">Toilet: Urinoir</label>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Kran Flush</label>

                                                                        <input <?php if($t['urinoir_faucet']) { echo("checked"); } ?> id="editurinoirfaucet" name="editurinoirfaucet" type="checkbox" class="editurinoirfaucetchecks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editurinoirfaucet')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditUrinoirFaucet' . $n . '(this.value)' ?>;" value="1">
                                                                        <span>Baik</span>                                                                        
                                                                        <span style="padding-left: 20px;"></span>                                                                        
                                                                        <input <?php if(!$t['urinoir_faucet']) { echo("checked"); } ?> id="editurinoirfaucet" name="editurinoirfaucet" type="checkbox" class="editurinoirfaucetchecks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editurinoirfaucet')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditUrinoirFaucet' . $n . '(this.value)' ?>;" value="0">
                                                                        <span>Rusak</span>                                                                        
                                                                        <?php if($validation->hasError('editurinoirfaucet')): ?>
                                                                            <div class="invalid-feedback" style="white-space: normal;">
                                                                                <?= $validation->getError('editurinoirfaucet'); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                        <script>
                                                                            function checkEditUrinoirFaucet<?= $n ?>(b){
                                                                                var x = document.getElementsByClassName('editurinoirfaucetchecks<?= $n ?>');
                                                                                var i;
                                                                                for(i = 0; i < x.length; i++) {
                                                                                    if(x[i].value != b) x[i].checked = false;
                                                                                }
                                                                            }
                                                                        </script>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Instalasi</label>

                                                                        <input <?php if($t['urinoir_instalation']) { echo("checked"); } ?> id="editurinoirinstalation" name="editurinoirinstalation" type="checkbox" class="editurinoirinstalationchecks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editurinoirinstalation')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditUrinoirInstalation' . $n . '(this.value)' ?>;" value="1">
                                                                        <span>Baik</span>                                                                        
                                                                        <span style="padding-left: 20px;"></span>                                                                        
                                                                        <input <?php if(!$t['urinoir_instalation']) { echo("checked"); } ?> id="editurinoirinstalation" name="editurinoirinstalation" type="checkbox" class="editurinoirinstalationchecks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editurinoirinstalation')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditUrinoirInstalation' . $n . '(this.value)' ?>;" value="0">
                                                                        <span>Rusak</span>                                                                        
                                                                        <?php if($validation->hasError('editurinoirinstalation')): ?>
                                                                            <div class="invalid-feedback" style="white-space: normal;">
                                                                                <?= $validation->getError('editurinoirinstalation'); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                        <script>
                                                                            function checkEditUrinoirInstalation<?= $n ?>(b){
                                                                                var x = document.getElementsByClassName('editurinoirinstalationchecks<?= $n ?>');
                                                                                var i;
                                                                                for(i = 0; i < x.length; i++) {
                                                                                    if(x[i].value != b) x[i].checked = false;
                                                                                }
                                                                            }
                                                                        </script>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-4">
                                                                <div style="padding: 10px; background-color: aliceblue;">
                                                                    <div class="mb-3 text-center">
                                                                        <label class="form-label" style="color: lightsteelblue; font-weight: bold; opacity: 90%;">Washtafel</label>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Kran Tembok</label>

                                                                        <input <?php if($t['washtafel_faucet']) { echo("checked"); } ?> id="editwashtafelfaucet" name="editwashtafelfaucet" type="checkbox" class="editwashtafelfaucetchecks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editwashtafelfaucet')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditWashtafelFaucet' . $n . '(this.value)' ?>;" value="1">
                                                                        <span>Baik</span>                                                                        
                                                                        <span style="padding-left: 20px;"></span>                                                                        
                                                                        <input <?php if(!$t['washtafel_faucet']) { echo("checked"); } ?> id="editwashtafelfaucet" name="editwashtafelfaucet" type="checkbox" class="editwashtafelfaucetchecks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editwashtafelfaucet')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditWashtafelFaucet' . $n . '(this.value)' ?>;" value="0">
                                                                        <span>Rusak</span>                                                                        
                                                                        <?php if($validation->hasError('editwashtafelfaucet')): ?>
                                                                            <div class="invalid-feedback" style="white-space: normal;">
                                                                                <?= $validation->getError('editwashtafelfaucet'); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                        <script>
                                                                            function checkEditWashtafelFaucet<?= $n ?>(b){
                                                                                var x = document.getElementsByClassName('editwashtafelfaucetchecks<?= $n ?>');
                                                                                var i;
                                                                                for(i = 0; i < x.length; i++) {
                                                                                    if(x[i].value != b) x[i].checked = false;
                                                                                }
                                                                            }
                                                                        </script>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Instalasi</label>

                                                                        <input <?php if($t['washtafel_instalation']) { echo("checked"); } ?> id="editwashtafelinstalation" name="editwashtafelinstalation" type="checkbox" class="editwashtafelinstalationchecks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editwashtafelinstalation')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditWashtafelInstalation' . $n . '(this.value)' ?>;" value="1">
                                                                        <span>Baik</span>                                                                        
                                                                        <span style="padding-left: 20px;"></span>                                                                        
                                                                        <input <?php if(!$t['washtafel_instalation']) { echo("checked"); } ?> id="editwashtafelinstalation" name="editwashtafelinstalation" type="checkbox" class="editwashtafelinstalationchecks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editwashtafelinstalation')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditWashtafelInstalation' . $n . '(this.value)' ?>;" value="0">
                                                                        <span>Rusak</span>                                                                        
                                                                        <?php if($validation->hasError('editwashtafelinstalation')): ?>
                                                                            <div class="invalid-feedback" style="white-space: normal;">
                                                                                <?= $validation->getError('editwashtafelinstalation'); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                        <script>
                                                                            function checkEditWashtafelInstalation<?= $n ?>(b){
                                                                                var x = document.getElementsByClassName('editwashtafelinstalationchecks<?= $n ?>');
                                                                                var i;
                                                                                for(i = 0; i < x.length; i++) {
                                                                                    if(x[i].value != b) x[i].checked = false;
                                                                                }
                                                                            }
                                                                        </script>
                                                                    </div>
                                                                </div>

                                                                <div style="padding: 10px; background-color: aliceblue;">
                                                                    <div class="mb-3 text-center">
                                                                        <label class="form-label" style="color: lightsteelblue; font-weight: bold; opacity: 90%;">Grease Trap</label>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Filtrasi</label>

                                                                        <input <?php if($t['filtration']) { echo("checked"); } ?> id="editfiltration" name="editfiltration" type="checkbox" class="editfiltrationchecks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editfiltration')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditFiltration' . $n . '(this.value)' ?>;" value="1">
                                                                        <span>Baik</span>                                                                        
                                                                        <span style="padding-left: 20px;"></span>                                                                        
                                                                        <input <?php if(!$t['filtration']) { echo("checked"); } ?> id="editfiltration" name="editfiltration" type="checkbox" class="editfiltrationchecks<?= $n; ?> <?= (($t['id'] == old('editid')) && ($validation->hasError('editfiltration')))? 'is-invalid' : ''; ?>" onclick="<?= 'checkEditFiltration' . $n . '(this.value)' ?>;" value="0">
                                                                        <span>Rusak</span>                                                                        
                                                                        <?php if($validation->hasError('editfiltration')): ?>
                                                                            <div class="invalid-feedback" style="white-space: normal;">
                                                                                <?= $validation->getError('editfiltration'); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                        <script>
                                                                            function checkEditFiltration<?= $n ?>(b){
                                                                                var x = document.getElementsByClassName('editfiltrationchecks<?= $n ?>');
                                                                                var i;
                                                                                for(i = 0; i < x.length; i++) {
                                                                                    if(x[i].value != b) x[i].checked = false;
                                                                                }
                                                                            }
                                                                        </script>
                                                                    </div>
                                                                </div>

                                                                <div class="mb-3" style="margin-top: 20px;">
                                                                    <label class="form-label">Temuan</label>
                                                                    <div class='row' style="margin: 0px;">
                                                                        <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editdiscovery'))) ? 'is-invalid' : ''; ?>" id="editdiscovery" name="editdiscovery" value="<?= $t['discovery']; ?>">
                                                                    </div>
                                                                    <?php if(($t['id'] == old('editid')) && ($validation->hasError('editdiscovery'))): ?>
                                                                        <div style="font-size: 85.71428571%; color: #d63939; white-space: normal;">
                                                                            <?= $validation->getError('editdiscovery'); ?>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>

                                                                <div class="mb-3">
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
                                                            <button type="submit" class="btn btn-outline-primary ms-auto" id="btnUpdateSanitary" name="btnUpdateSanitary" data-bs-dismiss="modal" data-id="<?= $t['id']; ?>">
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
                                        <form id="deleteSanitaryForm" action="<?php echo base_url('sanitary/deleteSanitary/' . $t['id']); ?>" method="post">
                                            <div class="modal-dialog modal-lg modal-dialog-centered" role="dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Delete Sanitary Data</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-lg-4">
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
                                                                    <label class="form-label">Time</label>
                                                                    
                                                                    <input checked id="edittime" name="edittime" type="checkbox" onclick="return false;" value="10:00:00">
                                                                    <span>10.00</span>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Worker</label>
                                                                    <input type="text" class="form-control" value="<?= $t['worker_name']; ?>" disabled>
                                                                    <input type="text" class="form-control" id="editworker" name="editworker" value="<?= $id; ?>" hidden>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Checklist</label>
                                                                    <input type="text" class="form-control" value="Weekly" disabled>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Lantai</label>
                                                                    <div class='row' style="margin: 0px;">
                                                                        <input disabled type="text" class="form-control col" value="<?= $t['floor']; ?>">
                                                                    </div>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Ruang</label>
                                                                    <div class='row' style="margin: 0px;">
                                                                        <input disabled type="text" class="form-control col" value="<?= $t['room']; ?>">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-4">
                                                                <div style="padding: 10px; background-color: aliceblue;">
                                                                    <div class="mb-3 text-center">
                                                                        <label class="form-label" style="color: lightsteelblue; font-weight: bold; opacity: 90%;">Toilet: Closet Duduk</label>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Instalasi</label>

                                                                        <input <?php if($t['closet_instalation']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                        <span>Baik</span>                                                                        
                                                                        <span style="padding-left: 20px;"></span>                                                                        
                                                                        <input <?php if(!$t['closet_instalation']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                        <span>Rusak</span>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Jet Washer</label>

                                                                        <input <?php if($t['closet_washer']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                        <span>Baik</span>                                                                        
                                                                        <span style="padding-left: 20px;"></span>                                                                        
                                                                        <input <?php if(!$t['closet_washer']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                        <span>Rusak</span>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Pelampung Closet</label>

                                                                        <input <?php if($t['closet_float']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                        <span>Baik</span>                                                                        
                                                                        <span style="padding-left: 20px;"></span>                                                                        
                                                                        <input <?php if(!$t['closet_float']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                        <span>Rusak</span>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Kran Tembok</label>

                                                                        <input <?php if($t['closet_faucet']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                        <span>Baik</span>                                                                        
                                                                        <span style="padding-left: 20px;"></span>                                                                        
                                                                        <input <?php if(!$t['closet_faucet']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                        <span>Rusak</span>
                                                                    </div>
                                                                </div>

                                                                <div style="padding: 10px; background-color: aliceblue;">
                                                                    <div class="mb-3 text-center">
                                                                        <label class="form-label" style="color: lightsteelblue; font-weight: bold; opacity: 90%;">Toilet: Urinoir</label>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Kran Flush</label>

                                                                        <input <?php if($t['urinoir_faucet']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                        <span>Baik</span>                                                                        
                                                                        <span style="padding-left: 20px;"></span>                                                                        
                                                                        <input <?php if(!$t['urinoir_faucet']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                        <span>Rusak</span>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Instalasi</label>

                                                                        <input <?php if($t['urinoir_instalation']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                        <span>Baik</span>                                                                        
                                                                        <span style="padding-left: 20px;"></span>                                                                        
                                                                        <input <?php if(!$t['urinoir_instalation']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                        <span>Rusak</span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-4">
                                                                <div style="padding: 10px; background-color: aliceblue;">
                                                                    <div class="mb-3 text-center">
                                                                        <label class="form-label" style="color: lightsteelblue; font-weight: bold; opacity: 90%;">Washtafel</label>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Kran Tembok</label>

                                                                        <input <?php if($t['washtafel_faucet']) { echo("checked"); } ?> type="checkbox"  onclick="return false;">
                                                                        <span>Baik</span>                                                                        
                                                                        <span style="padding-left: 20px;"></span>                                                                        
                                                                        <input <?php if(!$t['washtafel_faucet']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                        <span>Rusak</span>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Instalasi</label>

                                                                        <input <?php if($t['washtafel_instalation']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                        <span>Baik</span>                                                                        
                                                                        <span style="padding-left: 20px;"></span>                                                                        
                                                                        <input <?php if(!$t['washtafel_instalation']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                        <span>Rusak</span>
                                                                    </div>
                                                                </div>

                                                                <div style="padding: 10px; background-color: aliceblue;">
                                                                    <div class="mb-3 text-center">
                                                                        <label class="form-label" style="color: lightsteelblue; font-weight: bold; opacity: 90%;">Grease Trap</label>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Filtrasi</label>

                                                                        <input <?php if($t['filtration']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                        <span>Baik</span>                                                                        
                                                                        <span style="padding-left: 20px;"></span>                                                                        
                                                                        <input <?php if(!$t['filtration']) { echo("checked"); } ?> type="checkbox" onclick="return false;">
                                                                        <span>Rusak</span>
                                                                    </div>
                                                                </div>

                                                                <div class="mb-3" style="margin-top: 20px;">
                                                                    <label class="form-label">Temuan</label>
                                                                    <div class='row' style="margin: 0px;">
                                                                        <input type="text" class="form-control col" value="<?= $t['discovery']; ?>" disabled>
                                                                    </div>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Keterangan</label>
                                                                    <div class='row' style="margin: 0px;">
                                                                        <textarea class="form-control col" rows="3" disabled><?= $t['description']; ?></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <div class="col-auto">
                                                            <button type="submit" class="btn btn-outline-danger ms-auto" id="btnDeleteSanitary" name="btnDeleteSanitary" data-bs-dismiss="modal" data-id="<?= $t['id']; ?>">
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
                                if($i == count($getStoreEquipmentByStore)){
                                    echo($getStoreEquipmentByStore[0]['url']);
                                    break;
                                }

                                if($s['idEquipment'] > 17) {
                                    echo($s['url']);
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
            $("input[type=checkbox]:not(:disabled):not(:hidden):not(#time)").removeAttr('checked');
            $("input:not([type=checkbox]):not(:disabled):not(:hidden)").attr("value","");
            $("#description").html("");
        });
    })
</script>

<?= $this->endSection(); ?>