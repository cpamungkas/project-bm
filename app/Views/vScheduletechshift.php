<?= $this->extend('template_worker/index'); ?>
<?= $this->section('page-content'); ?>

<div class="page-body">
    <div class="container-xl">
        <div class="row row-deck row-cards">
            <?php
            if (session("error")) { ?>
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

            <?php
            if (session("success")) { ?>
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
                        <h3 class="card-title">New Shift</h3>
                    </div>
                    <div class="card-body">
                        <form id="FormShift" action="<?= base_url('techshift/saveTechShift') ?>" method="post">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-3 col-form-label">Date</label>
                                        <div class="col">
                                            <!-- <input type="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email">
                                            <small class="form-hint">We'll never share your email with anyone else.</small> -->
                                            <div class="input-icon mb-2">
                                                <input class="form-control <?= ($validation->hasError('date')) ? 'is-invalid' : ''; ?>" placeholder="Select a date" id="date" name="date" value="<?php echo old('date') !== null ? old('date') : date('d-m-Y'); ?>" required>
                                                <?php if ($validation->hasError('date')) { ?>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('date'); ?>
                                                    </div>
                                                <?php } else { ?>
                                                    <span class="input-icon-addon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <rect x="4" y="5" width="16" height="16" rx="2"></rect>
                                                            <line x1="16" y1="3" x2="16" y2="7"></line>
                                                            <line x1="8" y1="3" x2="8" y2="7"></line>
                                                            <line x1="4" y1="11" x2="20" y2="11"></line>
                                                            <line x1="11" y1="15" x2="12" y2="15"></line>
                                                            <line x1="12" y1="15" x2="12" y2="18"></line>
                                                        </svg>
                                                    </span>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-3 col-form-label">Store</label>
                                        <div class="col">
                                            <input type="text" class="form-control" id="store" name="store" placeholder="Store" value="<?= $location; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-3 col-form-label">Name</label>
                                        <div class="col">
                                            <div class="form-floating">
                                                <select class="form-select <?= ($validation->hasError('name')) ? 'is-invalid' : ''; ?>" id="name" name="name" required>

                                                </select>
                                                <label for="floatingSelect">Select the worker</label>
                                                <?php if ($validation->hasError('name')) : ?>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('name'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="form-label col-3 col-form-label pt-0">Shift</label>
                                        <div class="col">
                                            <div class="form-floating">
                                                <select class="form-select <?= ($validation->hasError('select_shift')) ? 'is-invalid' : ''; ?>" id="select_shift" name="select_shift" aria-label="Floating label select example" required>
                                                    <?= old('select_shift') !== NULL ?: '<option value="" selected="">Select the shift</option>'; ?>
                                                    <?php foreach ($getDataShift as $shift) {
                                                        if ($shift['idShift'] == old('select_shift')) {
                                                            echo '<option selected value="' . $shift['idShift'] . '">' . $shift['shift'] . ' - ' . $shift['description'] . '</option>';
                                                        } else {
                                                            echo '<option value="' . $shift['idShift'] . '">' . $shift['shift'] . ' - ' . $shift['description'] . '</option>';
                                                        }
                                                    ?>
                                                    <?php } ?>
                                                </select>
                                                <label for="select_shift">Select the shift</label>
                                                <?php if ($validation->hasError('select_shift')) : ?>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('select_shift'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Description </label>
                                        <textarea class="form-control <?= ($validation->hasError('description')) ? 'is-invalid' : ''; ?>" name="description" id="description" rows="6" placeholder="Description"><?= old('description') ?></textarea>
                                        <?php if ($validation->hasError('description')) : ?>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('description'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
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
                                            Add shift
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
                        <h3 class="card-title">Store Shift</h3>
                    </div>
                    <div class="clearfix">
                        <div class="pull-right tableTools-container"></div>
                    </div>
                    <div class="table-responsive">
                        <table id="dynamic-table" class="table card-table table-vcenter text-nowrap datatable" style="width:100%">
                            <thead>
                                <tr>
                                    <!-- <th class="w-1"><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select all invoices"></th> -->
                                    <th class="w-1">No.
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-dark icon-thick" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <polyline points="6 15 12 9 18 15" />
                                        </svg>
                                    </th>
                                    <th>Name</th>
                                    <th>Initial</th>
                                    <th>Store</th>
                                    <?php
                                    $y = 1;
                                    for ($y = 1; $y <= 31; $y++) {
                                        echo "<th style='width:150px;'> <input class='form-check-input m-0 align-middle' type='checkbox' aria-label='Select all'> " . $y . " Mei 2022</th>";
                                    }
                                    ?>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($getDataTableShift as $ts) : ?>
                                    <tr>
                                        <!-- <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td> -->
                                        <td><?= $i; ?></td>
                                        <td><?= $ts['name']; ?></td>
                                        <td><?= $ts['initial']; ?></td>
                                        <td><?= $ts['StoreName']; ?></td>
                                        <?php
                                        $o = 1;
                                        // TODO bikin fungsi buat output shift harianny
                                        for ($o = 1; $o <= 31; $o++) {
                                            echo "<td class='text-center'>" . coloredShift($ts['shift']) . "</td>";
                                        }
                                        ?>
                                        <td><?= $ts['description']; ?></td>
                                        <td class="text-end">
                                            <div class="row g-2 align-items-center mb-n3">
                                                <div class="col-6 col-sm-4 col-md-2 col-xl-auto mb-1">
                                                    <a class="btn-outline-primary" aria-label="ViewData" data-bs-toggle="modal" data-bs-target="#modal-viewdata<?= $i; ?>">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <circle cx="10" cy="10" r="7"></circle>
                                                            <line x1="7" y1="10" x2="13" y2="10"></line>
                                                            <line x1="10" y1="7" x2="10" y2="13"></line>
                                                            <line x1="21" y1="21" x2="15" y2="15"></line>
                                                        </svg>
                                                    </a>
                                                    <!-- </div>

                                                <div class="col-6 col-sm-4 col-md-2 col-xl-auto mb-3"> -->
                                                    <a class="btn-outline-success btn-edit" aria-label="EditData" data-bs-toggle="modal" data-bs-target="#modal-editTechShift<?= $i; ?>">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                                            <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                                            <path d="M16 5l3 3"></path>
                                                        </svg>
                                                    </a>
                                                    <!-- </div>
                                                <div class="col-6 col-sm-4 col-md-2 col-xl-auto mb-3"> -->
                                                    <a class="btn-outline-danger" aria-label="DeleteData" data-bs-toggle="modal" data-bs-target="#modal-deletedata<?= $i; ?>">
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
                    </div>
                    <!-- Modal view data -->
                    <div class="modal modal-blur fade" id="modal-viewdata<?= $i; ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">View data Shift</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group mb-3 row">
                                                <label class="form-label col-3 col-form-label">Date</label>
                                                <div class="col">

                                                    <div class="input-icon mb-2">
                                                        <input class="form-control " placeholder="Select a date" id="date" name="date" value="<?php echo convertDate($ts['date']); ?>" disabled>
                                                        <span class="input-icon-addon">
                                                            <!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                <rect x="4" y="5" width="16" height="16" rx="2"></rect>
                                                                <line x1="16" y1="3" x2="16" y2="7"></line>
                                                                <line x1="8" y1="3" x2="8" y2="7"></line>
                                                                <line x1="4" y1="11" x2="20" y2="11"></line>
                                                                <line x1="11" y1="15" x2="12" y2="15"></line>
                                                                <line x1="12" y1="15" x2="12" y2="18"></line>
                                                            </svg>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group mb-3 row">
                                                <label class="form-label col-3 col-form-label">Store</label>
                                                <div class="col">
                                                    <input type="text" class="form-control" id="store" name="store" placeholder="Store" value="<?= $location; ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group mb-3 row">
                                                <label class="form-label col-3 col-form-label">Name</label>
                                                <div class="col">
                                                    <div class="form-floating">
                                                        <select disabled class="form-select <?= ($validation->hasError('name')) ? 'is-invalid' : ''; ?>" id="name" name="name" required>
                                                            <?= '<option value="' . $ts['id'] . '">' . $ts['name'] . '</option>' ?>
                                                        </select>
                                                        <label for="floatingSelect">Select the worker</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group row">
                                                <label class="form-label col-3 col-form-label pt-0">Shift</label>
                                                <div class="col">
                                                    <div class="form-floating">
                                                        <select disabled class="form-select" id="select_shift" name="select_shift" aria-label="Floating label select example" required>
                                                            <?= '<option value="' . $ts['idShift'] . '">' . $ts['shift'] . ' - ' . $ts['shiftDescription'] . '</option>' ?>
                                                        </select>
                                                        <label for="select_shift">Select the shift</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label class="form-label">Description </label>
                                                <textarea disabled class="form-control" name="description" id="description" rows="6" placeholder="Description"><?= $ts['description']; ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="modal-footer">
                                    <button class="btn btn-outline-primary ms-auto" id="btnClose" name="btnClose" data-bs-dismiss="modal">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-door-exit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M13 12v.01"></path>
                                            <path d="M3 21h18"></path>
                                            <path d="M5 21v-16a2 2 0 0 1 2 -2h7.5m2.5 10.5v7.5"></path>
                                            <path d="M14 7h7m-3 -3l3 3l-3 3"></path>
                                        </svg>
                                        Close
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Edit Data -->
                    <div class="modal modal-blur fade" id="modal-editTechShift<?= $i; ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                        <form action="<?= base_url('techshift/editTechShift/' . $ts['id']) ?>" method="post">
                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit data Shift</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group mb-3 row">
                                                    <label class="form-label col-3 col-form-label">Date</label>
                                                    <div class="col">

                                                        <div class="input-icon mb-2">
                                                            <input class="form-control <?= ($validation->hasError('date')) ? 'is-invalid' : ''; ?>" placeholder="Select a date" id="date" name="date" value="<?php echo old('date') !== null ? old('date') : convertDate($ts['date']); ?>" required>
                                                            <?php if ($validation->hasError('date')) { ?>
                                                                <div class="invalid-feedback">
                                                                    <?= $validation->getError('date'); ?>
                                                                </div>
                                                            <?php } else { ?>
                                                                <span class="input-icon-addon">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                        <rect x="4" y="5" width="16" height="16" rx="2"></rect>
                                                                        <line x1="16" y1="3" x2="16" y2="7"></line>
                                                                        <line x1="8" y1="3" x2="8" y2="7"></line>
                                                                        <line x1="4" y1="11" x2="20" y2="11"></line>
                                                                        <line x1="11" y1="15" x2="12" y2="15"></line>
                                                                        <line x1="12" y1="15" x2="12" y2="18"></line>
                                                                    </svg>
                                                                </span>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group mb-3 row">
                                                    <label class="form-label col-3 col-form-label">Store</label>
                                                    <div class="col">
                                                        <input type="text" class="form-control" id="store" name="store" placeholder="Store" value="<?= $location; ?>" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group mb-3 row">
                                                    <label class="form-label col-3 col-form-label">Name</label>
                                                    <div class="col">
                                                        <div class="form-floating">
                                                            <!-- TODO -	Nama yang sudah dipilih, tidak akan muncul kembali dalam combobox dalam 1 tanggal yang sama -->
                                                            <select class="form-select <?= ($validation->hasError('name')) ? 'is-invalid' : ''; ?>" id="name" name="name" required>
                                                                <?php if (old('select_shift') !== null) { ?>
                                                                    <?php foreach ($getDataWorkerByStore as $worker) {
                                                                        if ($worker['id'] == old('name')) {
                                                                            echo '<option selected value="' . $worker['id'] . '">' . $worker['name'] . '</option>';
                                                                        } else {
                                                                            echo '<option value="' . $worker['id'] . '">' . $worker['name'] . '</option>';
                                                                        }
                                                                    } ?>
                                                                <?php } else { ?>
                                                                    <?php foreach ($getDataWorkerByStore as $worker) : ?>
                                                                        <?php
                                                                        if ($worker['id'] == $ts['idUser']) {
                                                                            echo '<option selected value="' . $worker['id'] . '">' . $worker['name'] . '</option>';
                                                                        } else {
                                                                            echo '<option value="' . $worker['id'] . '">' . $worker['name'] . '</option>';
                                                                        }
                                                                        ?>
                                                                    <?php endforeach; ?>
                                                                <?php } ?>
                                                            </select>
                                                            <label for="floatingSelect">Select the worker</label>
                                                            <?php if ($validation->hasError('name')) : ?>
                                                                <div class="invalid-feedback">
                                                                    <?= $validation->getError('name'); ?>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group row">
                                                    <label class="form-label col-3 col-form-label pt-0">Shift</label>
                                                    <div class="col">
                                                        <div class="form-floating">
                                                            <select class="form-select <?= ($validation->hasError('select_shift')) ? 'is-invalid' : ''; ?>" id="select_shift" name="select_shift" aria-label="Floating label select example" required>
                                                                <?php if (old('select_shift') !== null) { ?>
                                                                    <?php foreach ($getDataShift as $shift) {
                                                                        if ($shift['idShift'] == old('select_shift')) {
                                                                            echo '<option selected value="' . $shift['idShift'] . '">' . $shift['shift'] . ' - ' . $shift['description'] . '</option>';
                                                                        } else {
                                                                            echo '<option value="' . $shift['idShift'] . '">' . $shift['shift'] . ' - ' . $shift['description'] . '</option>';
                                                                        }
                                                                    } ?>
                                                                <?php } else { ?>
                                                                    <?php foreach ($getDataShift as $shift) : ?>
                                                                        <?php
                                                                        if ($shift['idShift'] == $ts['idShift']) {
                                                                            echo '<option selected value="' . $shift['idShift'] . '">' . $shift['shift'] . ' - ' . $shift['description'] . '</option>';
                                                                        } else {
                                                                            echo '<option value="' . $shift['idShift'] . '">' . $shift['shift'] . ' - ' . $shift['description'] . '</option>';
                                                                        }
                                                                        ?>
                                                                    <?php endforeach; ?>
                                                                <?php } ?>
                                                            </select>
                                                            <label for="select_shift">Select the shift</label>
                                                            <?php if ($validation->hasError('select_shift')) : ?>
                                                                <div class="invalid-feedback">
                                                                    <?= $validation->getError('select_shift'); ?>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-3">
                                                    <label class="form-label">Description </label>
                                                    <textarea class="form-control <?= ($validation->hasError('description')) ? 'is-invalid' : ''; ?>" name="description" id="description" rows="6" placeholder="Description"><?php echo old('description') !== null ? old('description') : $ts['description']; ?></textarea>
                                                    <?php if ($validation->hasError('description')) : ?>
                                                        <div class="invalid-feedback">
                                                            <?= $validation->getError('description'); ?>
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
                                                <button type="submit" class="btn btn-outline-primary ms-auto" id="btnUpdate" name="btnUpdate" data-bs-dismiss="modal">
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
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Modal delete data -->
                    <div class="modal modal-blur fade" id="modal-deletedata<?= $i; ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                        <form action="<?= base_url('techshift/deleteTechShift/' . $ts['id']) ?>" method="post">
                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Delete data Shift</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group mb-3 row">
                                                    <label class="form-label col-3 col-form-label">Date</label>
                                                    <div class="col">

                                                        <div class="input-icon mb-2">
                                                            <input class="form-control " placeholder="Select a date" id="date" name="date" value="<?php echo convertDate($ts['date']); ?>" disabled>
                                                            <span class="input-icon-addon">
                                                                <!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                    <rect x="4" y="5" width="16" height="16" rx="2"></rect>
                                                                    <line x1="16" y1="3" x2="16" y2="7"></line>
                                                                    <line x1="8" y1="3" x2="8" y2="7"></line>
                                                                    <line x1="4" y1="11" x2="20" y2="11"></line>
                                                                    <line x1="11" y1="15" x2="12" y2="15"></line>
                                                                    <line x1="12" y1="15" x2="12" y2="18"></line>
                                                                </svg>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group mb-3 row">
                                                    <label class="form-label col-3 col-form-label">Store</label>
                                                    <div class="col">
                                                        <input type="text" class="form-control" id="store" name="store" placeholder="Store" value="<?= $location; ?>" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group mb-3 row">
                                                    <label class="form-label col-3 col-form-label">Name</label>
                                                    <div class="col">
                                                        <div class="form-floating">
                                                            <select disabled class="form-select <?= ($validation->hasError('name')) ? 'is-invalid' : ''; ?>" id="name" name="name" required>
                                                                <?= '<option value="' . $ts['id'] . '">' . $ts['name'] . '</option>' ?>
                                                            </select>
                                                            <label for="floatingSelect">Select the worker</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group row">
                                                    <label class="form-label col-3 col-form-label pt-0">Shift</label>
                                                    <div class="col">
                                                        <div class="form-floating">
                                                            <select disabled class="form-select" id="select_shift" name="select_shift" aria-label="Floating label select example" required>
                                                                <?= '<option value="' . $ts['idShift'] . '">' . $ts['shift'] . ' - ' . $ts['shiftDescription'] . '</option>' ?>
                                                            </select>
                                                            <label for="select_shift">Select the shift</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-3">
                                                    <label class="form-label">Description </label>
                                                    <textarea disabled class="form-control" name="description" id="description" rows="6" placeholder="Description"><?= $ts['description']; ?></textarea>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="modal-footer">
                                        <div class="row align-items-center">
                                            <div class="col"></div>
                                            <div class="col-auto">
                                                <button type="submit" class="btn btn-outline-danger ms-auto" id="btnDelete" name="btnDelete" data-bs-dismiss="modal">
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
    </div>
</div>


<?= $this->endSection(); ?>

<?= $this->section("scripts") ?>
<script>
    $(document).ready(function() {
        var tanggal = $("#date");
        var old_name = "<?= old('name') ?>";

        // Litepicker for admins
        const picker = new Litepicker({
            element: document.getElementById('date'),
            buttonText: {
                previousMonth: `
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="15 6 9 12 15 18" /></svg>`,
                nextMonth: `
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="9 6 15 12 9 18" /></svg>`,
            },
            format: 'DD-MM-YYYY'
        });
        // End of Litepicker for admins

        form = new FormData();
        form.append("date", tanggal.val());

        //? data worker dinamis dg ajax 
        $.ajax({
            url: "<?= base_url('techshift/checkWorkerShiftAjax') ?>",
            type: "POST",
            data: form,
            processData: false,
            contentType: false,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            success: function(data) {
                if (data != null) {
                    $("#name").find("option").remove().end();

                    if (old_name != null) {
                        $("#name").append(
                            '<option value="">Select the worker</option>'
                        );
                        data.worker.forEach(element => {
                            if (element.id == old_name) {
                                $("#name").append(
                                    `<option selected value=` +
                                    element.id +
                                    `>` +
                                    element.name +
                                    `</option>`
                                );
                            } else {
                                $("#name").append(
                                    `<option value=` +
                                    element.id +
                                    `>` +
                                    element.name +
                                    `</option>`
                                );
                            }
                        });

                    } else {
                        $("#name").append(
                            '<option value="" selected>Select the worker</option>'
                        );
                        data.worker.forEach(element => {
                            $("#name").append(
                                `<option value=` +
                                element.id +
                                `>` +
                                element.name +
                                `</option>`
                            );
                        });
                    }
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error loading worker data');
            }
        });

        picker.on('selected', function() {
            let isiForm = new FormData();

            isiForm.append("date", tanggal.val());
            $.ajax({
                url: "<?= base_url('techshift/checkWorkerShiftAjax') ?>",
                type: "POST",
                data: isiForm,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                // dataType: "JSON",
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data != null) {
                        $("#name").find("option").remove().end();
                        $("#name").append(
                            '<option value="" selected>Select the worker</option>'
                        );
                        data.worker.forEach(element => {
                            $("#name").append(
                                `<option value=` +
                                element.id +
                                `>` +
                                element.name +
                                `</option>`
                            );
                        });
                    }

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error adding / update data');
                }
            });
        });
    })
</script>
<?= $this->endSection() ?>