<?= $this->extend('template_worker/index'); ?>
<?= $this->section('page-content'); ?>

<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- <h2 class="page-title">
                    Empty page
                </h2> -->
            </div>
        </div>
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <!-- <div class="page-pretitle">
                    Dashboard
                </div>
                <h2 class="page-title">
                    <?= $roleuser; ?>
                </h2> -->
            </div>
            <!-- Page title actions -->
            <div class="col-12 col-md-auto ms-auto d-print-none">
                <div class="btn-list">
                    <span class="d-none d-sm-inline">
                        <!-- <a href="#" class="btn btn-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-viewfinder" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <circle cx="12" cy="12" r="9"></circle>
                                <line x1="12" y1="3" x2="12" y2="7"></line>
                                <line x1="12" y1="21" x2="12" y2="18"></line>
                                <line x1="3" y1="12" x2="7" y2="12"></line>
                                <line x1="21" y1="12" x2="18" y2="12"></line>
                                <line x1="12" y1="12" x2="12" y2="12.01"></line>
                            </svg>
                            New view
                        </a> -->
                        <!-- <a href="#" class="btn" data-bs-toggle="modal" data-bs-target="#modal-report">
                            Modal with form
                        </a> -->
                    </span>
                    <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-report">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <rect x="4" y="5" width="16" height="16" rx="2"></rect>
                            <line x1="16" y1="3" x2="16" y2="7"></line>
                            <line x1="8" y1="3" x2="8" y2="7"></line>
                            <line x1="4" y1="11" x2="20" y2="11"></line>
                            <line x1="10" y1="16" x2="14" y2="16"></line>
                            <line x1="12" y1="14" x2="12" y2="18"></line>
                        </svg>
                        Create new shift
                    </a>
                    <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#modal-report" aria-label="Create new report">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <line x1="12" y1="5" x2="12" y2="19" />
                            <line x1="5" y1="12" x2="19" y2="12" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
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
                        <form>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-3 col-form-label">Date</label>
                                        <div class="col">
                                            <!-- <input type="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email">
                                            <small class="form-hint">We'll never share your email with anyone else.</small> -->
                                            <div class="input-icon mb-2">
                                                <input class="form-control " placeholder="Select a date" id="datepicker-icon" value="<?= date('d-m-Y'); ?>" required>
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
                                                <select class="form-select" id="floatingSelect" aria-label="Floating label select example" required>
                                                    <option value="" selected="">Select the worker</option>
                                                    <?php foreach ($getDataWorkerByStore as $worker) : ?>
                                                        <?= '<option value="' . $worker['id'] . '">' . $worker['name'] . '</option>' ?>
                                                    <?php endforeach; ?>
                                                </select>
                                                <label for="floatingSelect">Select the worker</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="form-label col-3 col-form-label pt-0">Shift</label>
                                        <div class="col">
                                            <div class="form-floating">
                                                <select class="form-select" id="floatingSelect" aria-label="Floating label select example" required>
                                                    <option value="" selected="">Select the shift</option>
                                                    <?php foreach ($getDataShift as $shift) : ?>
                                                        <?= '<option value="' . $shift['idShift'] . '">' . $shift['shift'] . ' - ' . $shift['description'] . '</option>' ?>
                                                    <?php endforeach; ?>
                                                </select>
                                                <label for="floatingSelect">Select the shift</label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Description </label>
                                        <textarea class="form-control" name="example-textarea-input" rows="6" placeholder="Content.."></textarea>
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
                                    <th class="w-1"><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select all invoices"></th>
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
                                        echo "<th style='width:150px;'> <input class='form-check-input m-0 align-middle' type='checkbox' aria-label='Select all invoices'> " . $y . " Mei 2022</th>";
                                    }
                                    ?>
                                    <th class="text-end">Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($getDataTableStore as $ts) : ?>
                                    <tr>
                                        <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                                        <td><?= $i; ?></td>
                                        <td><?= $ts['StoreName']; ?></td>
                                        <td><?= $ts['StoreCode']; ?></td>
                                        <td><?= $ts['StoreName']; ?></td>
                                        <?php
                                        $o = 1;
                                        for ($o = 1; $o <= 31; $o++) {
                                            echo "<td>" . $ts['KWHMeter2'] . "</td>";
                                        }
                                        ?>

                                        <td class="text-end">
                                            <div class="row g-2 align-items-center mb-n3">
                                                <div class="col-3 col-sm-2 col-md-2 col-xl-auto mb-2"><a href="#myModalView<?= $i; ?>" class="btn btn-outline-primary w-100 btn-icon" aria-label="ViewData" data-bs-toggle="modal" data-bs-target="#modal-viewdata<?= $i; ?>">link</a>
                                                </div>
                                                <div class="col-3 col-sm-2 col-md-2 col-xl-auto mb-2">
                                                    <a href="#myModalEdit<?= $i; ?>" class="btn btn-outline-success w-100 btn-icon" aria-label="EditData" data-bs-toggle="modal" data-bs-target="#modal-editdata<?= $i; ?>">link</a>
                                                </div>
                                            </div>
                                            <!-- <div class="row g-2 align-items-center mb-n3">
                                                <div class="col-6 col-sm-4 col-md-2 col-xl-auto mb-3">
                                                    <a href="#myModalView<?= $i; ?>" class="btn btn-outline-primary w-100 btn-icon" aria-label="ViewData" data-bs-toggle="modal" data-bs-target="#modal-viewdata<?= $i; ?>">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <circle cx="10" cy="10" r="7"></circle>
                                                            <line x1="7" y1="10" x2="13" y2="10"></line>
                                                            <line x1="10" y1="7" x2="10" y2="13"></line>
                                                            <line x1="21" y1="21" x2="15" y2="15"></line>
                                                        </svg>
                                                    </a>
                                                </div>
                                                <div class="col-6 col-sm-4 col-md-2 col-xl-auto mb-3">
                                                    <a href="#myModalEdit<?= $i; ?>" class="btn btn-outline-success w-100 btn-icon" aria-label="EditData" data-bs-toggle="modal" data-bs-target="#modal-editdata<?= $i; ?>">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                                            <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                                            <path d="M16 5l3 3"></path>
                                                        </svg>
                                                    </a>
                                                </div>
                                                <div class="col-6 col-sm-4 col-md-2 col-xl-auto mb-3">
                                                    <a href="#myModalDelete<?= $i; ?>" class="btn btn-outline-danger w-100 btn-icon" aria-label="Delete" data-bs-toggle="modal" data-bs-target="#modal-deletedata<?= $i; ?>">
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
                                            </div> -->
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

<form id="storeForm" action="<?php echo base_url('store/saveStore'); ?>" method="post" class="needs-validation">
    <div class="modal modal-blur fade" id="modal-report" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New store</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Store code</label>
                        <input type="text" class="form-control <?= ($validation->hasError('storecode')) ? 'is-invalid' : ''; ?>" name="storecode" id="storecode" placeholder="Store Code" size="10" maxlength="5" max="99999" onkeypress="return isNumeric(event)" oninput="maxLengthCheck(this)" value="<?= old('storecode'); ?>" required>
                        <!-- Error -->
                        <?php if ($validation->hasError('storecode')) : ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('storecode'); ?>
                            </div>
                        <?php endif; ?>
                        <script>
                            function maxLengthCheck(object) {
                                if (object.value.length > object.maxLength)
                                    object.value = object.value.slice(0, object.maxLength)
                            }

                            function isNumeric(evt) {
                                var theEvent = evt || window.event;
                                var key = theEvent.keyCode || theEvent.which;
                                key = String.fromCharCode(key);
                                var regex = /[0-9]|\./;
                                if (!regex.test(key)) {
                                    theEvent.returnValue = false;
                                    if (theEvent.preventDefault) theEvent.preventDefault();
                                }
                            }
                        </script>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Store name</label>
                        <input type="text" class="form-control <?= ($validation->hasError('storename')) ? 'is-invalid' : ''; ?>" name="storename" id="storename" placeholder="Store Name" value="<?= old('storename'); ?>" required>
                        <!-- Error -->
                        <?php if ($validation->hasError('storename')) : ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('storename'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">KWH Meter 1</label>
                                <select class="form-select" id="kwhmeter1" name="kwhmeter1" required>
                                    <option value="">Select KWH Meter 1</option>
                                    <?php foreach ($getKWHMeter1 as $kwh1) : ?>
                                        <?= '<option value="' . $kwh1['idkwhmeter1'] . '">' . $kwh1['kwhmeter1'] . ' KVA</option>' ?>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (session('errorkwhmeter1')) { ?>
                                    <div class="invalid-feedback">
                                        <?= session("errorkwhmeter1") ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">ID PLN 1</label>
                                <input type="number" class="form-control <?= ($validation->hasError('idpln1')) ? 'is-invalid' : ''; ?>" name="idpln1" id="idpln1" placeholder="ID PLN 1" maxlength="12" max="999999999999" value="<?= old('idpln1'); ?>" required>
                                <!-- Error -->
                                <?php if ($validation->hasError('idpln1')) : ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('idpln1'); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">KWH Meter 2</label>
                                <select class="form-select" id="kwhmeter2" name="kwhmeter2">
                                    <option value="0">Select KWH Meter 2</option>
                                    <?php foreach ($getKWHMeter2 as $kwh2) : ?>
                                        <?= '<option value="' . $kwh2['idkwhmeter2'] . '">' . $kwh2['kwhmeter2'] . ' KVA</option>' ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">ID PLN 2</label>
                                <input type="number" class="form-control" name="idpln2" id="idpln2" placeholder="ID PLN 2" maxlength="12" max="999999999999" value="<?= old('idpln2'); ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-primary ms-auto" id="btnSubmit" name="btnSubmit">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        Add store
                    </button>

                </div>
            </div>
        </div>
    </div>
</form>
<?= $this->endSection(); ?>