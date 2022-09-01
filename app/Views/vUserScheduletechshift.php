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
                        <h3 class="card-title">Filter Shift</h3>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url('techshift') ?>" method="post">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-3 col-form-label">Start Date</label>
                                        <div class="col">
                                            <div class="input-icon mb-2">
                                                <input id="user_start_date" name="start_date" class="form-control <?= ($validation->hasError('start_date')) ? 'is-invalid' : ''; ?>" placeholder="Select a date" value="<?php echo old('start_date') !== null ? old('start_date') : (isset($oldInput) ? $oldInput['start_date'] : date('d-m-Y')); ?>" required>
                                                <?php if ($validation->hasError('start_date')) { ?>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('start_date'); ?>
                                                    </div>
                                                <?php } else { ?>
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
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-3 col-form-label">End Date</label>
                                        <div class="col">
                                            <div class="input-icon mb-2">
                                                <input id="user_end_date" name="end_date" class="form-control <?= ($validation->hasError('end_date')) ? 'is-invalid' : ''; ?>" placeholder="Select a date" value="<?php echo old('end_date') !== null ? old('end_date') : (isset($oldInput) ? $oldInput['end_date'] : date('d-m-Y', strtotime('7 day'))); ?>" required>
                                                <?php if ($validation->hasError('end_date')) { ?>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('end_date'); ?>
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

                            </div>
                            <div class="form-footer">
                                <div class="row align-items-center">
                                    <div class="col"></div>
                                    <div class="col-auto">
                                        <a href="<?= base_url('techshift') ?>" class="btn btn-outline-secondary ms-auto">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4"></path>
                                                <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4"></path>
                                            </svg>
                                            Reset Filter
                                        </a>
                                        <button type="submit" class="btn btn-outline-primary ms-auto" id="btnSubmitShift" name="btnSubmitShift">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                            </svg>
                                            Submit
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
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($getDataTableShift as $ts) : ?>
                                    <tr>
                                        <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                                        <td><?= $i; ?></td>
                                        <td><?= $ts['name']; ?></td>
                                        <td><?= $ts['initial']; ?></td>
                                        <td><?= $ts['StoreName']; ?></td>
                                        <?php
                                        $o = 1;
                                        // TODO bikin fungsi buat output shift harianny
                                        for ($o = 1; $o <= 31; $o++) {
                                            echo "<td>" . $ts['shift'] . "</td>";
                                        }
                                        ?>
                                        <td><?= $ts['description']; ?></td>
                                        <td class="text-end">
                                            <div class="row g-2 align-items-center mb-n3">
                                                <div class="col-6 col-sm-4 col-md-2 col-xl-auto mb-3">
                                                    <a class="btn btn-outline-primary w-100 btn-icon" aria-label="ViewData" data-bs-toggle="modal" data-bs-target="#modal-viewdata<?= $i; ?>">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <circle cx="10" cy="10" r="7"></circle>
                                                            <line x1="7" y1="10" x2="13" y2="10"></line>
                                                            <line x1="10" y1="7" x2="10" y2="13"></line>
                                                            <line x1="21" y1="21" x2="15" y2="15"></line>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

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

                                    <?php $i++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col-6">
                            <div class="form-group row">
                                <label class="form-label col-3 col-form-label text-center">Shift Info</label>
                                <div class="col">
                                    <div class="form-floating">
                                        <select class="form-select" id="select_shift" name="select_shift" aria-label="Floating label select example">
                                            <?php foreach ($getDataShift as $shift) {
                                                echo '<option value="' . $shift['idShift'] . '">' . $shift['shift'] . ' - ' . $shift['description'] . '</option>';
                                            ?>
                                            <?php } ?>
                                        </select>
                                        <label for="select_shift">Shift Info</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>

<?=$this->section("scripts")?>
<script>
    $(document).ready(function () {
        // Litepicker for workers
        const userStartDate = new Litepicker({
                    element: document.getElementById('user_start_date'),
                    buttonText: {
                        previousMonth: `
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="15 6 9 12 15 18" /></svg>`,
                        nextMonth: `
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="9 6 15 12 9 18" /></svg>`,
                    },
                    format: 'DD-MM-YYYY'
                });
                const userEndDate = new Litepicker({
                    element: document.getElementById('user_end_date'),
                    buttonText: {
                        previousMonth: `
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="15 6 9 12 15 18" /></svg>`,
                        nextMonth: `
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="9 6 15 12 9 18" /></svg>`,
                    },
                    format: 'DD-MM-YYYY'
                });
                // End of Litepicker for workers
    })
</script>
<?=$this->endSection()?>