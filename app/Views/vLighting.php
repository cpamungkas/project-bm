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
                        <h3 class="card-title">Lighting</h3>
                    </div>
                    
                    <div class="card-body">
                        <form action="<?php echo base_url('lighting/saveLighting'); ?>" method="post">
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
                                <div class="col-lg-6">
                                    <div class="table-responsive">
                                        <table class="table table-bordered card-table table-vcenter text-nowrap datatable" style="width:100%">
                                            <tbody>
                                                <tr style="border: 0;">
                                                    <td style="border: 0;"></td>
                                                    <td style="border: 0;"></td>
                                                    <td style="border: 0;"></td>
                                                </tr>

                                                <tr>
                                                    <td rowspan="4" style="width: 250px; padding-right: 25px;">
                                                        <select name="area" id="area" class="form-select <?= ($validation->hasError('area')) ? 'is-invalid' : ''; ?>">
                                                            <?php for($i = 1; $i <= 4; $i++): ?>
                                                                <?php
                                                                    $area = 0;
                                                                    foreach($getLightingByStoreDate as $t) {
                                                                        if($t['area'] == $i) {
                                                                            $area = 1;
                                                                            break;
                                                                        }
                                                                    }
                                                                ?>
                                                                <?php if(!$area): ?>
                                                                    <option <?php if(old('area') == $i) { echo('selected'); } ?> value="<?= $i ?>">
                                                                        Area Jual Lantai <?= $i ?>
                                                                    </option>
                                                                <?php endif; ?>
                                                            <?php endfor; ?>
                                                            <?php
                                                                $area = 0;
                                                                foreach($getLightingByStoreDate as $t) {
                                                                    if($t['area'] == 5) {
                                                                        $area = 1;
                                                                        break;
                                                                    }
                                                                }
                                                            ?>
                                                            <?php if(!$area): ?>
                                                                <option <?php if(old('area') == 5) { echo('selected'); } ?> value="5">
                                                                    Back Office
                                                                </option>
                                                            <?php endif; ?>
                                                        </select>
                                                        <?php if($validation->hasError('area')): ?>
                                                            <div class="invalid-feedback" style="white-space: normal;">
                                                                <?= $validation->getError('area'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>Zone 1<br>> 300 LUX</td>
                                                    <td>
                                                        <input id="zone_1" name="zone_1" class="form-control <?= ($validation->hasError('zone_1')) ? 'is-invalid' : ''; ?>" value="<?= old('zone_1'); ?>">
                                                        <?php if($validation->hasError('zone_1')): ?>
                                                            <div class="invalid-feedback" style="white-space: normal;">
                                                                <?= $validation->getError('zone_1'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 8px;">Zone 2<br>> 300 LUX</td>
                                                    <td>
                                                        <input id="zone_2" name="zone_2" class="form-control <?= ($validation->hasError('zone_2')) ? 'is-invalid' : ''; ?>" value="<?= old('zone_2'); ?>">
                                                        <?php if($validation->hasError('zone_2')): ?>
                                                            <div class="invalid-feedback" style="white-space: normal;">
                                                                <?= $validation->getError('zone_2'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 8px;">Zone 3<br>> 300 LUX</td>
                                                    <td>
                                                        <input id="zone_3" name="zone_3" class="form-control <?= ($validation->hasError('zone_3')) ? 'is-invalid' : ''; ?>" value="<?= old('zone_3'); ?>">
                                                        <?php if($validation->hasError('zone_3')): ?>
                                                            <div class="invalid-feedback" style="white-space: normal;">
                                                                <?= $validation->getError('zone_3'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 8px;">Zone 4<br>> 300 LUX</td>
                                                    <td>
                                                        <input id="zone_4" name="zone_4" class="form-control <?= ($validation->hasError('zone_4')) ? 'is-invalid' : ''; ?>" value="<?= old('zone_4'); ?>">
                                                        <?php if($validation->hasError('zone_4')): ?>
                                                            <div class="invalid-feedback" style="white-space: normal;">
                                                                <?= $validation->getError('zone_4'); ?>
                                                            </div>
                                                        <?php endif; ?>
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

                                <div class="col-lg-6">                            
                                    <div class="form-group mb-3" style="padding-top: 20px;">
                                        <div class="row">
                                            <label class="form-label col-4 col-form-label">Jumlah Temuan</label>
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
                                            <label class="form-label row-form-label">Penjelasan</label>
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
                                        <button type="submit" class="btn btn-outline-primary ms-auto" id="btnSubmitLighting" name="btnSubmitLighting">
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
                        <h3 class="card-title">Data Lighting</h3>
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
                                    <?php for($k = 1; $k <= 4; $k++): ?>
                                    <?php for($l = 1; $l <= 4; $l++): ?>
                                        <th>Area Jual Lantai <?= $k ?><br>Zone <?= $l ?><br>> 300 LUX</th>
                                    <?php endfor; ?>
                                    <?php endfor; ?>
                                    <th>Back Office<br>Zone 1</th>
                                    <th>Back Office<br>Zone 2</th>
                                    <th>Back Office<br>Zone 3</th>
                                    <th>Back Office<br>Zone 4</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php 
                                    $n = 1;
                                    $i = 1; 
                                    $skipcount = 0;
                                    $skipcounttmp = 0;
                                ?>
                                <?php foreach($getLightingByStore as $t): ?>
                                    <?php if($skipcount == 0): ?>
                                        <?php
                                            $j = 1;
                                            foreach($getLightingByStore as $a) {
                                                if(($j > $i) && ($a['date'] == $t['date'])) {
                                                    $skipcount++;
                                                }
                                                $j++;
                                            }
                                            $skipcounttmp = $skipcount;
                                        ?>
                                    
                                        <?php
                                            $date = new DateTime($t['date']);                          
                                        ?>

                                        <tr>
                                            <td><?= $n++ ?></td>

                                            <td><?= $t['store_name'] ?></td>
                                            <td><?= $date->format('j F Y') ?></td>
                                            <td><?= $t['worker_name'] ?></td>

                                            <?php for($k = 1; $k <= 5; $k++): ?>
                                                <?php if($t['area'] == $k): ?>
                                                    <td><?= $t['zone_1'] ?></td>
                                                    <td><?= $t['zone_2'] ?></td>
                                                    <td><?= $t['zone_3'] ?></td>
                                                    <td><?= $t['zone_4'] ?></td>
                                                <?php else: ?>
                                                    <?php
                                                        $j = 1;
                                                        $tmp = -1;
                                                        foreach($getLightingByStore as $a) {
                                                            if(($j > $i) && ($a['date'] == $t['date']) && ($a['area'] == $k)) {
                                                                $tmp = $j;
                                                                break;
                                                            }
                                                            $j++;
                                                        }
                                                        if($tmp > 0) {
                                                            $j = 1;
                                                            foreach($getLightingByStore as $a) {
                                                                if($tmp == $j) {
                                                                    echo("<td>" . $a['zone_1'] . "</td>");
                                                                    echo("<td>" . $a['zone_2'] . "</td>");
                                                                    echo("<td>" . $a['zone_3'] . "</td>");
                                                                    echo("<td>" . $a['zone_4'] . "</td>");

                                                                    break;
                                                                }

                                                                $j++;
                                                            }
                                                        }
                                                        else {
                                                            echo "<td>-</td>";
                                                            echo "<td>-</td>";
                                                            echo "<td>-</td>";
                                                            echo "<td>-</td>";
                                                        }
                                                    ?>
                                                <?php endif; ?>
                                            <?php endfor; ?>
                                            
                                            <td class="text-end">
                                                <div class="row g-2 align-items-center mb-n3">
                                                    <div class="col-6 col-sm-4 col-md-2 col-xl-auto mb-3">
                                                        <button href="#myModalEdit<?= $i; ?>" id="btnModalEdit<?= $t['id']; ?>" data-bs-toggle="modal" data-bs-target="#modal-editdata<?= $i; ?>" class="btn btn-outline-success w-100 btn-icon btn-edit">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                                                <path d="M16 5l3 3"></path>
                                                            </svg>
                                                        </button>
                                                    </div>

                                                    <div class="col-6 col-sm-4 col-md-2 col-xl-auto mb-3">
                                                        <button href="#myModalDelete<?= $i; ?>" class="btn btn-outline-danger w-100 btn-icon" aria-label="DeleteData" data-bs-toggle="modal" data-bs-target="#modal-deletedata<?= $i; ?>">
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
                                    <?php else: ?>
                                        <?php $skipcount--; ?>
                                    <?php endif; ?>
                                    
                                    <!-- Modal edit data -->
                                    <div class="modal modal-blur fade" id="modal-editdata<?= $i; ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                                        <form id="editLightingForm" action="<?php echo base_url('lighting/updateLighting/' . $t['id']); ?>" method="post">
                                            <div class="modal-dialog modal-lg modal-dialog-centered" role="dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Lighting Data (<?= $skipcounttmp - $skipcount + 1; ?>/<?= $skipcounttmp + 1; ?>)</h5>
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
                                                                    <label class="form-label">Worker</label>
                                                                    <input type="text" class="form-control" value="<?= $name; ?>*" disabled>
                                                                    <input type="text" class="form-control" id="editworker" name="editworker" value="<?= $id; ?>" hidden>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Checklist</label>
                                                                    <input type="text" class="form-control" value="Monthly" disabled>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-4">
                                                                <div style="padding: 10px; background-color: aliceblue;">
                                                                    <div class="mb-3">
                                                                        <div class='row' style="margin: 0px;">
                                                                            <select name="editarea" id="editarea" class="editarea<?= $t['id'] ?> form-select <?= (($t['id'] == old('editid')) && ($validation->hasError('editarea'))) ? 'is-invalid' : ''; ?>" aria-label="Floating label select example">
                                                                                <?php for($m = 1; $m <= 4; $m++): ?>
                                                                                    <?php
                                                                                        $area = 0;
                                                                                        foreach($getLightingByStore as $tt) {
                                                                                            if(($tt['id'] != $t['id']) && ($tt['date'] == $t['date']) && ($tt['area'] == $m)) {
                                                                                                $area = 1;
                                                                                                break;
                                                                                            }
                                                                                        }
                                                                                    ?>
                                                                                    <?php if(!$area): ?>
                                                                                        <option <?php if($t['area'] == $m) { echo('selected'); } ?> value="<?= $m ?>">
                                                                                            Area Jual Lantai <?= $m ?>
                                                                                        </option>
                                                                                    <?php endif; ?>
                                                                                <?php endfor; ?>
                                                                                <?php
                                                                                    $area = 0;
                                                                                    foreach($getLightingByStore as $tt) {
                                                                                        if(($tt['id'] != $t['id']) && ($tt['date'] == $t['date']) && ($tt['area'] == 5)) {
                                                                                            $area = 1;
                                                                                            break;
                                                                                        }
                                                                                    }
                                                                                ?>
                                                                                <?php if(!$area): ?>
                                                                                    <option <?php if($t['area'] == 5) { echo('selected'); } ?> value="5">
                                                                                        Back Office
                                                                                    </option>
                                                                                <?php endif; ?>
                                                                            </select>
                                                                        </div>
                                                                        <?php if(($t['id'] == old('editid')) && ($validation->hasError('editarea'))): ?>
                                                                            <div style="font-size: 85.71428571%; color: #d63939;">
                                                                                <?= $validation->getError('editarea'); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Zone 1 > 300 LUX</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editzone1'))) ? 'is-invalid' : ''; ?>" id="editzone1" name="editzone1" value="<?= $t['zone_1']; ?>">
                                                                        </div>
                                                                        <?php if(($t['id'] == old('editid')) && ($validation->hasError('editzone1'))): ?>
                                                                            <div style="font-size: 85.71428571%; color: #d63939;">
                                                                                <?= $validation->getError('editzone1'); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Zone 2 > 300 LUX</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editzone2'))) ? 'is-invalid' : ''; ?>" id="editzone2" name="editzone2" value="<?= $t['zone_2']; ?>">
                                                                        </div>
                                                                        <?php if(($t['id'] == old('editid')) && ($validation->hasError('editzone2'))): ?>
                                                                            <div style="font-size: 85.71428571%; color: #d63939;">
                                                                                <?= $validation->getError('editzone2'); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Zone 3 > 300 LUX</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editzone3'))) ? 'is-invalid' : ''; ?>" id="editzone3" name="editzone3" value="<?= $t['zone_3']; ?>">
                                                                        </div>
                                                                        <?php if(($t['id'] == old('editid')) && ($validation->hasError('editzone3'))): ?>
                                                                            <div style="font-size: 85.71428571%; color: #d63939;">
                                                                                <?= $validation->getError('editzone3'); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Zone 4 > 300 LUX</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col <?= (($t['id'] == old('editid')) && ($validation->hasError('editzone4'))) ? 'is-invalid' : ''; ?>" id="editzone4" name="editzone4" value="<?= $t['zone_4']; ?>">
                                                                        </div>
                                                                        <?php if(($t['id'] == old('editid')) && ($validation->hasError('editzone4'))): ?>
                                                                            <div style="font-size: 85.71428571%; color: #d63939;">
                                                                                <?= $validation->getError('editzone4'); ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-4">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Jumlah Temuan</label>
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
                                                                    <label class="form-label">Penjelasan</label>

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

                                                    <div class="modal-footer justify-content-between">
                                                        <div class="row align-items-center">
                                                            <?php if($skipcount < $skipcounttmp): ?>
                                                                <div class="col">
                                                                    <a href="#myModalEdit<?= $i - 1; ?>" class="btn btn-outline-primary w-100 btn-icon" aria-label="ViewData" data-bs-toggle="modal" data-bs-target="#modal-editdata<?= $i - 1; ?>">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                                                                            <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                                                                        </svg>
                                                                    </a>
                                                                </div>
                                                            <?php endif; ?>
                                                            <?php if($skipcount > 0): ?>
                                                                <div class="col">
                                                                    <a href="#myModalEdit<?= $i + 1; ?>" class="btn btn-outline-primary w-100 btn-icon" aria-label="ViewData" data-bs-toggle="modal" data-bs-target="#modal-editdata<?= $i + 1; ?>">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                                                            <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                                                                        </svg>
                                                                    </a>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="row align-items-center">
                                                            <div class="col"></div>
                                                            <div class="col-auto">
                                                                <button type="submit" class="btn btn-outline-primary ms-auto" id="btnUpdateLighting" name="btnUpdateLighting" data-bs-dismiss="modal" data-id="<?= $t['id']; ?>">
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
                                            </div>
                                        </form>
                                    </div>

                                    <!-- Modal delete data -->
                                    <div class="modal modal-blur fade" id="modal-deletedata<?= $i; ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                                        <form id="deleteLightingForm" action="<?php echo base_url('lighting/deleteLighting/' . $t['id']); ?>" method="post">
                                            <div class="modal-dialog modal-lg modal-dialog-centered" role="dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Delete Lighting Data (<?= $skipcounttmp - $skipcount + 1; ?>/<?= $skipcounttmp + 1; ?>)</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-lg-4">
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

                                                            <div class="col-lg-4">
                                                                <div style="padding: 10px; background-color: aliceblue;">
                                                                    <div class="mb-3">
                                                                        <div class='row' style="margin: 0px;">
                                                                            <select class="form-select" aria-label="Floating label select example" disabled>
                                                                                <?php if($t['area'] == 5): ?>
                                                                                    <option selected>Back Office</option>
                                                                                <?php else: ?>
                                                                                    <option selected>Area Jual Lantai <?= $t['area'] ?></option>
                                                                                <?php endif; ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Zone 1 > 300 LUX</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col" value="<?= $t['zone_1']; ?>" disabled>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Zone 2 > 300 LUX</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col" value="<?= $t['zone_2']; ?>" disabled>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Zone 3 > 300 LUX</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col" value="<?= $t['zone_3']; ?>" disabled>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Zone 4 > 300 LUX</label>
                                                                        <div class='row' style="margin: 0px;">
                                                                            <input type="text" class="form-control col" value="<?= $t['zone_4']; ?>" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-4">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Jumlah Temuan</label>
                                                                    <div class='row' style="margin: 0px;">
                                                                        <input type="text" class="form-control col" value="<?= $t['discovery']; ?>" disabled>
                                                                    </div>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Penjelasan</label>

                                                                    <div class='row' style="margin: 0px;">
                                                                        <textarea class="form-control col" rows="3" disabled><?= $t['description']; ?></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer justify-content-between">
                                                        <div class="row align-items-center">
                                                            <?php if($skipcount < $skipcounttmp): ?>
                                                                <div class="col">
                                                                    <a href="#myModalDelete<?= $i - 1; ?>" class="btn btn-outline-primary w-100 btn-icon" aria-label="ViewData" data-bs-toggle="modal" data-bs-target="#modal-deletedata<?= $i - 1; ?>">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                                                                            <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                                                                        </svg>
                                                                    </a>
                                                                </div>
                                                            <?php endif; ?>
                                                            <?php if($skipcount > 0): ?>
                                                                <div class="col">
                                                                    <a href="#myModalDelete<?= $i + 1; ?>" class="btn btn-outline-primary w-100 btn-icon" aria-label="ViewData" data-bs-toggle="modal" data-bs-target="#modal-deletedata<?= $i + 1; ?>">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                                                            <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                                                                        </svg>
                                                                    </a>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="row align-items-center">
                                                            <div class="col"></div>
                                                            <div class="col-auto">
                                                                <button type="submit" class="btn btn-outline-danger ms-auto" id="btnDeleteLighting" name="btnDeleteLighting" data-bs-dismiss="modal" data-id="<?= $t['id']; ?>">
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
                                            </div>
                                        </form>
                                    </div>

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
                                if($s['idEquipment'] > 13) {
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
            $("input[type=checkbox]:not(:disabled):not(:hidden):not(#time)").removeAttr('checked');
            $("input:not([type=checkbox]):not(:disabled):not(:hidden)").attr("value","");

            $("#area option:selected").each(function () {
                $(this).removeAttr('selected');
            });
        });
    })
</script>

<?= $this->endSection(); ?>