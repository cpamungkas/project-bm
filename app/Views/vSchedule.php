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
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-building-store" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <line x1="3" y1="21" x2="21" y2="21"></line>
                            <path d="M3 7v1a3 3 0 0 0 6 0v-1m0 1a3 3 0 0 0 6 0v-1m0 1a3 3 0 0 0 6 0v-1h-18l2 -4h14l2 4"></path>
                            <line x1="5" y1="21" x2="5" y2="10.85"></line>
                            <line x1="19" y1="21" x2="19" y2="10.85"></line>
                            <path d="M9 21v-4a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v4"></path>
                        </svg>
                        Create new store
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
                        <h3 class="card-title">Setup New Store</h3>
                    </div>
                    <div class="card-body">
                        <form id="storeForm" action="<?php echo base_url('store/saveStore'); ?>" method="post">
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


                            <div class="form-footer">
                                <div class="row align-items-center">
                                    <div class="col"></div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-outline-primary ms-auto" id="btnSubmit" name="btnSubmit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                            </svg>
                                            Add store
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
                        <h3 class="card-title">Store Table</h3>
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
                                    <th>Store Name</th>
                                    <th>Store Code</th>
                                    <th>KWH Meter 1</th>
                                    <th>ID PLN 1</th>
                                    <th>KWH Meter 2</th>
                                    <th>ID PLN 2</th>
                                    <th>Action</th>
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
                                        <td><?= $ts['KWHMeter1']; ?></td>
                                        <td><?= $ts['idPLN1']; ?></td>
                                        <td><?= $ts['KWHMeter2']; ?></td>
                                        <td><?= $ts['idPLN2']; ?></td>
                                        <td class="text-end">
                                            <div class="row g-2 align-items-center mb-n3">
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
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Modal -->
                                    <div class="modal modal-blur fade" id="modal-viewdata<?= $i; ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">View data store <?= $ts['StoreName']; ?></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Store code</label>
                                                        <input type="text" class="form-control" name="storecode" id="storecode" placeholder="Store Code" size="10" value="<?= $ts['StoreCode']; ?>" disabled>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Store name</label>
                                                        <input type="text" class="form-control" name="storename" id="storename" placeholder="Store Name" value="<?= $ts['StoreName']; ?>" disabled>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">KWH Meter 1</label>
                                                                <select class="form-select" id="kwhmeter1" name="kwhmeter1" disabled>
                                                                    <option value="">Select KWH Meter 1</option>
                                                                    <?php foreach ($getKWHMeter1 as $kwh1) : ?>
                                                                        <?= '<option value="' . $kwh1['idkwhmeter1'] . '">' . $kwh1['kwhmeter1'] . ' KVA</option>' ?>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">ID PLN 1</label>
                                                                <input type="number" class="form-control <?= ($validation->hasError('idpln1')) ? 'is-invalid' : ''; ?>" name="idpln1" id="idpln1" placeholder="ID PLN 1" maxlength="12" max="999999999999" value="<?= $ts['idPLN1']; ?>" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">KWH Meter 2</label>
                                                                <select class="form-select" id="kwhmeter2" name="kwhmeter2" disabled>
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
                                                                <input type="number" class="form-control" name="idpln2" id="idpln2" placeholder="ID PLN 2" maxlength="12" max="999999999999" value="<?= $ts['idPLN2']; ?>" disabled>
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
                                    <div class="modal modal-blur fade" id="modal-editdata<?= $i; ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                            <form id="storeForm" action="<?php echo base_url('store/updateStore/' . $ts['idStore']); ?>" method="post" class="needs-validation" novalidate>
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit data store <?= $ts['StoreName']; ?></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label class="form-label">Store code</label>
                                                            <input type="text" class="form-control <?= ($validation->hasError('modalstorecode')) ? 'is-invalid' : ''; ?>" name="modalstorecode" id="modalstorecode" placeholder="Store Code" size="10" value="<?= $ts['StoreCode']; ?>" required>
                                                            <!-- Error -->
                                                            <?php if ($validation->hasError('modalstorecode')) : ?>
                                                                <div class="invalid-feedback">
                                                                    <?= $validation->getError('modalstorecode'); ?>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Store name</label>
                                                            <input type="text" class="form-control <?= ($validation->hasError('modalstorename')) ? 'is-invalid' : ''; ?>" name="modalstorename" id="modalstorename" placeholder="Store Name" value="<?= $ts['StoreName']; ?>" required>
                                                            <!-- Error -->
                                                            <?php if ($validation->hasError('modalstorename')) : ?>
                                                                <div class="invalid-feedback">
                                                                    <?= $validation->getError('modalstorename'); ?>
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
                                                                    <?php if (session('errormodalkwhmeter1')) { ?>
                                                                        <div class="invalid-feedback">
                                                                            <?= session("errormodalkwhmeter1") ?>
                                                                        </div>
                                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label">ID PLN 1</label>
                                                                    <input type="number" class="form-control <?= ($validation->hasError('modalidpln1')) ? 'is-invalid' : ''; ?>" name="modalidpln1" id="modalidpln1" placeholder="ID PLN 1" maxlength="12" max="999999999999" value="<?= $ts['idPLN1']; ?>" required>
                                                                    <?php if ($validation->hasError('modalidpln1')) : ?>
                                                                        <div class="invalid-feedback">
                                                                            <?= $validation->getError('modalidpln1'); ?>
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
                                                                    <input type="number" class="form-control" name="idpln2" id="idpln2" placeholder="ID PLN 2" maxlength="12" max="999999999999" value="<?= $ts['idPLN2']; ?>" disabled>
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
                                                                <button class="btn btn-outline-secondary ms-auto" id="btnClose" name="btnClose" data-bs-dismiss="modal">
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
                                            </form>
                                        </div>
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