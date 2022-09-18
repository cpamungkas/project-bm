<?= $this->extend('template_worker/index'); ?>
<?= $this->section('page-content'); ?>
<?= $validation->listErrors() ?>

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
                        <h3 class="card-title">Set Up Store Equipment</h3>
                    </div>
                    <div class="card-body">
                        <form id="formStoreEquip" action="<?= base_url('storeEquipment/saveStoreEquipment') ?>" method="post">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-3 col-form-label">Store Name</label>
                                        <div class="col">
                                            <div class="form-floating">
                                                <select class="form-select <?= ($validation->hasError('storeName')) ? 'is-invalid' : ''; ?>" id="storeName" name="storeName" required>
                                                    <?php if (old('storeName') != null) { ?>
                                                        <option value="">Select storer</option>
                                                        <?php foreach ($getStore as $store => $value) {
                                                            if ($value['idStore'] == old('storeName')) {
                                                                echo '<option selected value="' . $value['idStore'] . '">' . $value['StoreName'] . '</option>';
                                                            } else {
                                                                echo '<option value="' . $value['idStore'] . '">' . $value['StoreName'] . '</option>';
                                                            }
                                                        } ?>
                                                    <?php } else { ?>
                                                        <option value="" selected="">Select store</option>
                                                    <?php
                                                        foreach ($getStore as $store => $value) {
                                                            echo '<option value="' . $value['idStore'] . '">' . $value['StoreName'] . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <label for="storeName">Select store</label>
                                                <?php if ($validation->hasError('storeName')) : ?>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('storeName'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>



                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-3 col-form-label">Store Code</label>
                                        <div class="col">
                                            <input type="text" class="form-control" id="storeCode" name="storeCode" placeholder="Store Code" value="" readonly>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-lg-2 col-md-12 col-form-label">Equipment</label>
                                        <?php
                                        foreach ($equipBox as $key => $value) {
                                            echo '<div class="col-lg-3 col-md-6">';
                                            foreach ($value as $p => $q) {
                                                echo '<div class="input-group">';
                                                echo '<div class="form-check">';
                                                echo '<input class="form-check-input" type="checkbox" value="' . $q['id'] . '" id="' . $q['equipment'] . '" name="' . $q['equipment'] . '">';
                                                echo '<label class="form-check-label" for="' . $q['equipment'] . '">';
                                                echo $q['equipment_name'];
                                                echo '</label>';

                                                //? hidden dropdown untuk checklist
                                                echo '<select class="form-select" hidden name="checklist_' . $q['equipment'] . '" id="checklist_' . $q['equipment'] . '">';
                                                echo '<option ' . ($q['default_checklist'] == "DAILY" ? 'selected' : '') . ' value="DAILY">DIALY</option>';
                                                echo '<option ' . ($q['default_checklist'] == "WEEKLY" ? 'selected' : '') . ' value="WEEKLY">WEEKLY</option>';
                                                echo '<option ' . ($q['default_checklist'] == "MONTHLY" ? 'selected' : '') . ' value="MONTHLY">MONTHLY</option>';
                                                echo '</select>';
                                                echo '</div>';
                                                echo '</div>';
                                            }
                                            echo '</div>';
                                        }
                                        ?>

                                    </div>

                                </div>
                            </div>
                            <div class="form-footer">
                                <div class="row align-items-center">
                                    <div class="col"></div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-outline-primary ms-auto" id="btnSubmitStoreEquip">
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
                        <h3 class="card-title">Store Equipment</h3>
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
                                    <?php
                                    foreach ($getEquipment as $key => $value) {
                                        echo "<th>" . $value['equipment_name'] . "</th>";
                                    }
                                    ?>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1 ?>
                                <?php foreach ($getDataTableStoreEquip as $ts) : ?>
                                    <tr>
                                        <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                                        <td><?= $i ?></td>
                                        <td><?= $ts['storeName']; ?></td>
                                        <td><?= $ts['storeCode']; ?></td>
                                        <?php
                                        foreach ($getEquipment as $key => $value) {
                                            echo "<td>" . yesIcon($ts[$value['equipment']]) . "</td>";
                                        }
                                        ?>
                                        <td class="text-end">
                                            <div class="row g-2 align-items-center mb-n3">
                                                <div class="col-6 col-sm-4 col-md-2 col-xl-auto mb-3">
                                                    <a class="btn btn-outline-primary btn-icon view-icon" id="<?= $ts['idStore']; ?>" aria-label="ViewData" data-bs-toggle="modal" data-bs-target="#modal-viewStoreEquip">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <circle cx="10" cy="10" r="7"></circle>
                                                            <line x1="7" y1="10" x2="13" y2="10"></line>
                                                            <line x1="10" y1="7" x2="10" y2="13"></line>
                                                            <line x1="21" y1="21" x2="15" y2="15"></line>
                                                        </svg>
                                                    </a>
                                                    <a class="btn btn-outline-success btn-icon edit-icon" id="<?= $ts['idStore']; ?>" aria-label="EditData" data-bs-toggle="modal" data-bs-target="#modal-editStoreEquip">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                                            <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                                            <path d="M16 5l3 3"></path>
                                                        </svg>
                                                    </a>
                                                    <a class="btn btn-outline-danger btn-icon delete-icon" id="<?= $ts['idStore']; ?>" aria-label="DeleteData">
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


    <!-- Modal view data -->
    <div class="modal modal-blur fade modal-edit" id="modal-viewStoreEquip" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">View Store Equipment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-3 row">
                                <label class="form-label col-3 col-form-label">Store Name</label>
                                <div class="col">
                                    <input disabled type="text" class="form-control" id="storeName" name="storeName" placeholder="Store Name">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3 row">
                                <label class="form-label col-3 col-form-label">Store Code</label>
                                <div class="col">
                                    <input disabled type="text" class="form-control" id="storeCode" name="storeCode" placeholder="Store Code" value="" readonly>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group mb-3 row">
                                <label class="form-label col-lg-2 col-md-12 col-form-label">Equipment</label>
                                <?php
                                foreach ($equipBox as $key => $value) {
                                    echo '<div class="col-lg-3 col-md-6">';
                                    foreach ($value as $p => $q) {
                                        echo '<div class="input-group">';
                                        echo '<div class="form-check">';
                                        echo '<input disabled class="form-check-input" type="checkbox" value="' . $q['id'] . '" id="' . $q['equipment'] . '" name="' . $q['equipment'] . '">';
                                        echo '<label class="form-check-label" for="' . $q['equipment'] . '">';
                                        echo $q['equipment_name'];
                                        echo '</label>';

                                        //? hidden dropdown untuk checklist
                                        echo '<select disabled class="form-select" hidden name="checklist_' . $q['equipment'] . '" id="checklist_' . $q['equipment'] . '">';
                                        echo '<option value="DAILY">DIALY</option>';
                                        echo '<option value="WEEKLY">WEEKLY</option>';
                                        echo '<option value="MONTHLY">MONTHLY</option>';
                                        echo '</select>';
                                        echo '</div>';
                                        echo '</div>';
                                    }
                                    echo '</div>';
                                }
                                ?>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <div class="row align-items-center">
                        <div class="col"></div>
                        <div class="col-auto">
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
    </div>

    <!-- Modal edit data -->
    <div class="modal modal-blur fade modal-edit" id="modal-editStoreEquip" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Store Equipment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formEditStoreEquip" action="<?= base_url('storeEquipment/editStoreEquipment') ?>" method="post">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group mb-3 row">
                                    <label class="form-label col-3 col-form-label">Store Name</label>
                                    <div class="col">
                                        <div class="form-floating">
                                            <select disabled class="form-select <?= ($validation->hasError('storeName')) ? 'is-invalid' : ''; ?>" id="storeNameDisplay" name="storeNameDisplay">
                                                <?php if (old('storeName') != null) { ?>
                                                    <?php foreach ($getStore as $store => $value) {
                                                        if ($value['idStore'] == old('storeName')) {
                                                            echo '<option selected value="' . $value['idStore'] . '">' . $value['StoreName'] . '</option>';
                                                        } else {
                                                            echo '<option value="' . $value['idStore'] . '">' . $value['StoreName'] . '</option>';
                                                        }
                                                    } ?>
                                                <?php } else { ?>
                                                <?php
                                                    foreach ($getStore as $store => $value) {
                                                        echo '<option value="' . $value['idStore'] . '">' . $value['StoreName'] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <input hidden readonly type="text" name="storeName" id="storeName">
                                            <label for="storeName">Select store</label>
                                            <?php if ($validation->hasError('storeName')) : ?>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('storeName'); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>



                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3 row">
                                    <label class="form-label col-3 col-form-label">Store Code</label>
                                    <div class="col">
                                        <input type="text" class="form-control" id="storeCode" name="storeCode" placeholder="Store Code" value="" readonly>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-3 row">
                                    <label class="form-label col-lg-2 col-md-12 col-form-label">Equipment</label>
                                    <?php
                                    foreach ($equipBox as $key => $value) {
                                        echo '<div class="col-lg-3 col-md-6">';
                                        foreach ($value as $p => $q) {
                                            echo '<div class="input-group">';
                                            echo '<div class="form-check">';
                                            echo '<input class="form-check-input" type="checkbox" value="' . $q['id'] . '" id="' . $q['equipment'] . '" name="' . $q['equipment'] . '">';
                                            echo '<label class="form-check-label" for="' . $q['equipment'] . '">';
                                            echo $q['equipment_name'];
                                            echo '</label>';

                                            //? hidden dropdown untuk checklist
                                            echo '<select class="form-select" hidden name="checklist_' . $q['equipment'] . '" id="checklist_' . $q['equipment'] . '">';
                                            echo '<option value="DAILY">DIALY</option>';
                                            echo '<option value="WEEKLY">WEEKLY</option>';
                                            echo '<option value="MONTHLY">MONTHLY</option>';
                                            echo '</select>';
                                            echo '</div>';
                                            echo '</div>';
                                        }
                                        echo '</div>';
                                    }
                                    ?>
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

    <?= $this->section("scripts") ?>
    <script>
        $(document).ready(function() {
            var myTable = $('#dynamic-table')
            var table = $('#dynamic-table').DataTable({
                lengthChange: true,
                lengthMenu: [
                    [5, 10, 25, 50, -1],
                    ['5', '10', '25', '50', 'Show all']
                ],
                // responsive: true,
                // dom: 'bfrtip',
                // paging: true,
                // "info": true,
                // "iDisplayLength": 10,
                // fixedColumns: true,
                // scrollY: 300,
                scrollX: true,
                // scrollCollapse: true,

                select: true,
                // {
                //     style: 'multi'
                // },
                buttons: [{
                        "extend": "colvis",
                        "text": "<i class='fa fa-eye bigger-110 blue'></i> <span class='hidden'>Show/hide columns</span>",
                        "className": "btn-outline-primary",
                        columns: ':not(:first):not(:last)'
                    },
                    {
                        "extend": "copy",
                        "text": "<i class='fa fa-copy bigger-110 pink'></i> <span class='hidden'>Copy to clipboard</span>",
                        "className": "btn btn-primary btn-outline-*"
                    },
                    {
                        "extend": "print",
                        "text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
                        "className": "btn btn-white btn-primary btn-bold",
                        autoPrint: false,
                        message: 'This print was produced using the Print button for DataTables'
                    },
                    // {
                    //     "extend": "pdf",
                    //     "text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span class='hidden'>Export to PDF</span>",
                    //     "className": "btn btn-white btn-primary btn-bold"
                    // },
                    {
                        "extend": "excel",
                        "text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Export to Excel</span>",
                        "className": "btn btn-white btn-primary btn-bold"
                    },
                    {
                        "extend": "csv",
                        "text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Export to CSV</span>",
                        "className": "btn btn-white btn-primary btn-bold"
                    },
                    {
                        "text": "<i class='fa fa-file-text-o bigger-110 green'></i> <span class='hidden'>Export to JSON</span>",
                        "className": "btn btn-white btn-primary btn-bold",
                        action: function(e, dt, button, config) {
                            var data = dt.buttons.exportData();

                            $.fn.dataTable.fileSave(
                                new Blob([JSON.stringify(data)]),
                                'Export.json'
                            );
                        }
                    },
                    // "selectRows",
                    "selectColumns",
                    "selectCells",
                    "selectNone"
                ]
            });

            $.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';

            new $.fn.dataTable.Buttons(table, {
                buttons: [{
                        "extend": "colvis",
                        "text": "<i class='fa fa-search bigger-110 blue'></i> <span class='hidden'>Show/hide columns</span>",
                        "className": "btn-outline-primary",
                        columns: ':not(:first):not(:last)'
                    },
                    {
                        "extend": "copy",
                        "text": "<i class='fa fa-copy bigger-110 pink'></i> <span class='hidden'>Copy to clipboard</span>",
                        "className": "btn btn-primary btn-outline-*"
                    },
                    {
                        "extend": "excel",
                        "text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Export to Excel</span>",
                        "className": "btn btn-white btn-primary btn-bold"
                    },
                    {
                        "extend": "pdf",
                        "text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span class='hidden'>Export to PDF</span>",
                        "className": "btn btn-white btn-primary btn-bold"
                    },
                    {
                        "extend": "print",
                        "text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
                        "className": "btn btn-white btn-primary btn-bold",
                        autoPrint: false,
                        message: 'This print was produced using the Print button for DataTables'
                    },
                    {
                        "extend": "csv",
                        "text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Export to CSV</span>",
                        "className": "btn btn-white btn-primary btn-bold"
                    }

                ]
            });

            // table.buttons().container().insertBefore('#dynamic-table_filter');

            table.buttons().container().appendTo($('.tableTools-container'));


            let dataStore = <?php echo json_encode($getStore); ?>;
            var store = $('#storeName');
            var storeCode = $("#storeCode");

            //? merubah store code sesuai dengan store yg dipilih
            store.change(function() {
                var selectedStore = dataStore.find(item => item.idStore === store.val())

                if (selectedStore != null) {
                    storeCode.val(selectedStore.StoreCode);
                } else {
                    storeCode.val('');
                }
            });

            //? modal view
            $(".view-icon").click(function() {
                var modalViewEquip = $("#modal-viewStoreEquip");
                modalViewEquip.find("input:text").val("");
                modalViewEquip.find("input:checkbox").prop('checked', false);
                modalViewEquip.find("select").prop('hidden', true);

                inputData = new FormData();
                inputData.append("idStore", this.id);

                $.ajax({
                    url: "<?= base_url('storeEquipment/ajaxDataStoreEquipment') ?>",
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
                            data.equip.forEach(eq => {
                                data.data.forEach(element => {
                                    if (eq.id == element.idEquipment) {
                                        modalViewEquip.find("#storeName").val(element.storeName);
                                        modalViewEquip.find("#storeCode").val(element.storeCode);
                                        modalViewEquip.find("#" + eq.equipment).prop("checked", true);
                                        modalViewEquip.find("#checklist_" + eq.equipment).prop('hidden', false);
                                        modalViewEquip.find("#checklist_" + eq.equipment + " option[value=" + element.checklist + "]").attr('selected', 'selected');
                                    }
                                });
                            });

                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error loading worker data');
                    }
                });
            });

            //? modal edit
            $(".edit-icon").click(function() {
                var modalViewEquip = $("#modal-editStoreEquip");
                modalViewEquip.find("input:text").val("");
                modalViewEquip.find("input:checkbox").prop('checked', false);
                modalViewEquip.find("select").prop('hidden', true);
                modalViewEquip.find("#storeNameDisplay").prop('hidden', false);


                inputData = new FormData();
                inputData.append("idStore", this.id);

                $.ajax({
                    url: "<?= base_url('storeEquipment/ajaxDataStoreEquipment') ?>",
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
                            data.equip.forEach(eq => {
                                modalViewEquip.find("#checklist_" + eq.equipment + " option[value=" + eq.default_checklist + "]").attr('selected', 'selected');
                                data.data.forEach(element => {
                                    if (eq.id == element.idEquipment) {
                                        modalViewEquip.find("#storeNameDisplay option[value=" + element.idStore + "]").attr('selected', 'selected');
                                        modalViewEquip.find("#storeName").val(element.idStore);
                                        modalViewEquip.find("#storeCode").val(element.storeCode);
                                        modalViewEquip.find("#" + eq.equipment).prop("checked", true);
                                        modalViewEquip.find("#checklist_" + eq.equipment).prop('hidden', false);
                                        modalViewEquip.find("#checklist_" + eq.equipment + " option:selected").removeAttr('selected');
                                        modalViewEquip.find("#checklist_" + eq.equipment + " option[value=" + element.checklist + "]").attr('selected', 'selected');

                                    }
                                });
                            });

                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error loading worker data');
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

                        deleteData.append('idStore', this.id);
                        $.ajax({
                            url: "<?= base_url('storeEquipment/deleteStoreEquipment') ?>",
                            type: "POST",
                            data: deleteData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            // dataType: "JSON",
                            processData: false,
                            contentType: false,
                            success: function(data) {
                                location.reload();
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                alert('Error loading worker data');
                            }
                        });
                    }
                })
            });

            //? munculin cheklist
            $("#formStoreEquip").find("input:checkbox").change(function() {
                if (this.checked) {
                    $("#formStoreEquip").find("#checklist_" + this.id).attr('hidden', false);
                } else {
                    $("#formStoreEquip").find("#checklist_" + this.id).attr('hidden', true);
                }
            });

            $("#modal-editStoreEquip").find("input:checkbox").change(function() {
                if (this.checked) {
                    $("#modal-editStoreEquip").find("#checklist_" + this.id).attr('hidden', false);
                } else {
                    $("#modal-editStoreEquip").find("#checklist_" + this.id).attr('hidden', true);
                }
            });
        });
    </script>
    <?= $this->endSection() ?>