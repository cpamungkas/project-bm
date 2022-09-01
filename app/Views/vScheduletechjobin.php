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
                        <h3 class="card-title">Store Job Assignment - IN</h3>
                    </div>
                    <div class="clearfix">
                        <div class="pull-right tableTools-container"></div>
                    </div>
                    <div class="table-responsive">
                        <table id="dynamic-table" class="table card-table table-vcenter text-nowrap datatable" style="width:100%">
                            <thead>
                                <tr>
                                    <!-- <th class="w-1"><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select all invoices"></th> -->
                                    <th class="w-1">No</th>
                                    <th>Name</th>
                                    <th>Initial</th>
                                    <th>From Store</th>
                                    <?php
                                    $y = 1;
                                    for ($y = 1; $y <= 31; $y++) {
                                        echo "<th style='width:150px;'> <input class='form-check-input m-0 align-middle' type='checkbox' aria-label='Select all invoices'> " . $y . " Mei 2022</th>";
                                    }
                                    ?>
                                    <th>Keterangan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($getDataTableTechJobIn as $ts) : ?>
                                    <tr>
                                        <!-- <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td> -->
                                        <td><?= $i; ?></td>
                                        <td><?= $ts['name']; ?></td>
                                        <td><?= $ts['initial']; ?></td>
                                        <td><?= $ts['nameStoreFrom']; ?></td>
                                        <?php
                                        $o = 1;
                                        // TODO bikin fungsi buat output job out harianny
                                        for ($o = 1; $o <= 31; $o++) {
                                            echo "<td>" . $ts['nameStoreTo'] . "</td>";
                                        }
                                        ?>
                                        <td><?= $ts['description']; ?></td>
                                        <td class="text-end">
                                            <div class="row g-2 align-items-center mb-n3">
                                                <div class="col-6 col-sm-4 col-md-2 col-xl-auto mb-1">
                                                    <a onclick="viewTechJobIn(<?= $i - 1 ?>)" class="btn btn-outline-primary w-10 btn-icon" aria-label="ViewData" data-bs-toggle="modal" data-bs-target="#modal-viewdata<?= $i; ?>">
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
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Detail Job Assignment - IN</h3>
                    </div>
                    <div class="card-body">
                        <?php if ($getDataTableTechJobIn != NULL) : ?>
                            <form id="formSubmitTechJobIn" action="<?= base_url('techjobin/submitTechJobIn/' . $getDataTableTechJobIn[0]['id']); ?>" method="post">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3 row">
                                            <label class="form-label col-3 col-form-label">Start Date</label>
                                            <div class="col">
                                                <div class="input-icon mb-2">
                                                    <input readonly class="form-control <?= ($validation->hasError('start_date')) ? 'is-invalid' : ''; ?>" placeholder="Select a date" id="start_date" name="start_date" value="<?php echo old('start_date') !== null ? old('start_date') : convertDate($getDataTableTechJobIn[0]['start_date']); ?>" required>
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
                                            <label class="form-label col-3 col-form-label">From Store</label>
                                            <div class="col">
                                                <input type="text" class="form-control" id="from_store" name="from_store" placeholder="From Store" value="<?= $getDataTableTechJobIn[0]['nameStoreFrom']; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group mb-3 row">
                                            <label class="form-label col-3 col-form-label">Name</label>
                                            <div class="col">
                                                <input type="text" class="form-control" id="name" name="name" placeholder="" value="<?= $getDataTableTechJobIn[0]['name'] ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3 row">
                                            <label class="form-label col-3 col-form-label">End Date</label>
                                            <div class="col">
                                                <div class="input-icon mb-2">
                                                    <input readonly class="form-control " placeholder="Select a date" id="end_date" name="end_date" value="<?php echo old('end_date') !== null ? old('end_date') : convertDate($getDataTableTechJobIn[0]['end_date']); ?>" required>
                                                    <?php if ($validation->hasError('end_date')) { ?>
                                                        <div class="invalid-feedback">
                                                            <?= $validation->getError('end_date'); ?>
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
                                            <label class="form-label col-3 col-form-label">To Store</label>
                                            <div class="col">
                                                <input type="text" class="form-control" id="to_store" name="to_store" placeholder="To Store" value="<?= $location; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label">Description</label>
                                            <textarea class="form-control <?= ($validation->hasError('description')) ? 'is-invalid' : ''; ?>" id="description" name="description" rows="6" placeholder="Description" readonly><?= $getDataTableTechJobIn[0]['description'] ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-footer">
                                    <div class="row align-items-center">
                                        <div class="col"></div>
                                        <div class="col-auto">
                                            <button class="btn btn-outline-primary ms-auto" id="btnApproveTechJobIn" name="btnApproveTechJobIn">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M5 12l5 5l10 -10"></path>
                                                </svg>
                                                Approve
                                            </button>
                                            <button class="btn btn-outline-danger ms-auto" id="btnRejectTechJobIn" name="btnRejectTechJobIn">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                                </svg>
                                                Reject
                                            </button>
                                            <button type="submit" class="btn btn-outline-secondary ms-auto" id="btnSubmitTechJobIn" name="btnSubmitTechJobIn" value="APPROVED">
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
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section("scripts") ?>
<script>
    $(document).ready(function() {
        var valueDesc = $("#description").val();

        $("#btnRejectTechJobIn").click(function(e) {
            valueDesc = $("#description").val();
            e.preventDefault();
            $("#description").removeAttr("readonly");
            $("#btnSubmitTechJobIn").val("REJECTED");
        });

        $("#btnApproveTechJobIn").click(function(e) {
            valueDesc = $("#description").val();
            e.preventDefault();
            $("#description").attr("readonly", true).val(valueDesc);
            $("#btnSubmitTechJobIn").val("APPROVED");
        });
    });

    function viewTechJobIn(id) {
        // TODO rubah ke ajax?
        let dataTechJobIn = <?= json_encode($getDataTableTechJobIn) ?>;
        $("#formSubmitTechJobIn").attr('action', "<?= base_url('techjobin/submitTechJobIn/') ?>/" + dataTechJobIn[id]['id']);
        $("#start_date").val(convertDate(dataTechJobIn[id]['start_date']));
        $("#end_date").val(convertDate(dataTechJobIn[id]['end_date']));
        $("#name").val(dataTechJobIn[id]['name']);
        $("#btnSubmitTechJobIn").val("APPROVED");
        $("#description").val(dataTechJobIn[id]['description']);
    }

    function convertDate(date) {
        var data = date.split("-");
        tanggal = data.reverse();
        return tanggal[0] + '-' + tanggal[1] + '-' + tanggal[2]
    }
</script>
<?= $this->endSection() ?>