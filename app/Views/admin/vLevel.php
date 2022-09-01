<?= $this->extend('template_worker/index'); ?>
<?= $this->section('page-content'); ?>
<div class="page-body">
    <div class="container-xl">
        <?php if (session("error")) { ?>
            <div class="alert alert-warning alert-dismissible fade show text-danger" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alert-triangle" width="36" height="36" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M12 9v2m0 4v.01"></path>
                    <path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75"></path>
                </svg>
                <strong>Error!</strong> <?= session("error") ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>

        <?php
        if (session("warning")) { ?>
            <div class="alert alert-warning alert-dismissible fade show text-warning" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alert-triangle" width="36" height="36" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M12 9v2m0 4v.01"></path>
                    <path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75"></path>
                </svg>
                <strong>Warning!</strong> <?= session("warning") ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>

        <?php
        if (session("success")) { ?>
            <div class="alert alert-success alert-dismissible fade show text-success" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-checks" width="36" height="36" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M7 12l5 5l10 -10"></path>
                    <path d="M2 12l5 5m5 -5l5 -5"></path>
                </svg>
                <strong>Success!</strong> <?= session("success") ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>

        <div class="col-xl">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Setup Level</h3>
                </div>
                <div class="card-body">
                    <form id="createLevelForm" action="<?php echo base_url('level/saveLevel'); ?>" method="post">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Level</label>
                                    <input type="text" class="form-control <?= ($validation->hasError('level')) ? 'is-invalid' : ''; ?>" name="level" id="level" placeholder="Level" value="<?= old('level'); ?>" required>
                                    <?php if ($validation->hasError('level')) : ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('level'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-footer">
                            <div class="row align-items-center">
                                <div class="col"></div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-outline-primary ms-auto" id="btnSubmitLevel" name="btnSubmitLevel">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <line x1="12" y1="5" x2="12" y2="19"></line>
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                        </svg>
                                        Add Level
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
                    <script type="text/javascript">
                        //<![CDATA[
                        var _getForm = document.getElementById("createLevelForm");
                        _getForm.addEventListener('reset', function() {
                            document.getElementById("level").focus()
                        })
                        //]]>
                    </script>
                </div>
            </div>

        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Level Table</h3>
                </div>
                <div class="clearfix">
                    <div class="pull-right tableTools-container"></div>
                </div>
                <div class="table-responsive">
                    <table id="dynamic-table" class="table card-table table-vcenter text-nowrap datatable" style="width:100%">
                        <thead>
                            <tr>
                                <!-- <th class="w-1"><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select all invoices"></th> -->
                                <th class="w-1">No
                                    <!-- <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-dark icon-thick" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <polyline points="6 15 12 9 18 15" />
                                        </svg> -->
                                </th>
                                <th>Level</th>
                                <th>Access Menu</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($getDataLevel as $emp) : ?>
                                <tr>
                                    <!-- <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td> -->
                                    <td><?= $i; ?></td>
                                    <td><?= $emp['level']; ?></td>
                                    <td><?= $emp['menu_access']; ?></td>

                                    <td class="text-end">
                                        <div class="row g-2 align-items-center mb-n3">
                                            <div class="col-4 col-sm-4 col-md-2 col-lg-auto mb-1">
                                                <a href="#" class="btn-outline-primary btn-view-level" data-id="<?= $emp['idLevel']; ?>" data-level="<?= $emp['level']; ?>" data-menuaccess="<?= $emp['menu_access']; ?>" data-tooltips="tooltip" data-placement="top" title="View Data">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-zoom-in" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <circle cx="10" cy="10" r="7"></circle>
                                                        <line x1="7" y1="10" x2="13" y2="10"></line>
                                                        <line x1="10" y1="7" x2="10" y2="13"></line>
                                                        <line x1="21" y1="21" x2="15" y2="15"></line>
                                                    </svg>
                                                </a>
                                            </div>
                                            <div class="col-4 col-sm-4 col-md-2 col-lg-auto mb-1">
                                                <a href="#myModalEdit<?= $emp['idLevel']; ?>" id="btnModalEditLevel<?= $emp['idLevel']; ?>" name="btnModalEditLevel<?= $emp['idLevel']; ?>" class="btn-outline-success btn-edit-level" data-id="<?= $emp['idLevel']; ?>" data-level="<?= $emp['level']; ?>" data-menuaccess="<?= $emp['menu_access']; ?>" data-tooltips="tooltip" data-placement="top" title="Edit Data">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                                        <path d="M16 5l3 3"></path>
                                                    </svg>
                                                </a>
                                            </div>
                                            <div class="col-4 col-sm-4 col-md-2 col-lg-auto mb-1">
                                                <a href="#" class="btn-outline-danger btn-delete-level" data-id="<?= $emp['idLevel']; ?>" data-level="<?= $emp['level']; ?>" data-menuaccess="<?= $emp['menu_access']; ?>" data-tooltips="tooltip" data-placement="top" title="Delete Data">
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
                                        <!-- <div class="row g-2 align-items-center mb-n3">
                                            <div class="col-4 col-sm-4 col-md-2 col-lg-auto mb-3">
                                                <button href="#myModalView<?= $i; ?>" id="btnModalViewLevel<?= $emp['idLevel']; ?>" name="btnModalViewLevel<?= $emp['idLevel']; ?>" class="btn btn-outline-primary w-100 btn-icon btn-view-level" data-id="<?= $emp['idLevel']; ?>" data-level="<?= $emp['level']; ?>" data-menuaccess="<?= $emp['menu_access']; ?>">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-zoom-in" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <circle cx="10" cy="10" r="7"></circle>
                                                        <line x1="7" y1="10" x2="13" y2="10"></line>
                                                        <line x1="10" y1="7" x2="10" y2="13"></line>
                                                        <line x1="21" y1="21" x2="15" y2="15"></line>
                                                    </svg>
                                                </button>
                                            </div>
                                            <div class="col-4 col-sm-4 col-md-2 col-lg-auto mb-3">
                                                <button href="#myModalEdit<?= $i; ?>" id="btnModalEditLevel<?= $emp['idLevel']; ?>" name="btnModalEditLevel<?= $emp['idLevel']; ?>" class="btn btn-outline-success w-100 btn-icon btn-edit-level" data-id="<?= $emp['idLevel']; ?>" data-level="<?= $emp['level']; ?>" data-menuaccess="<?= $emp['menu_access']; ?>">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                                        <path d="M16 5l3 3"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                            <div class="col-4 col-sm-4 col-md-2 col-lg-auto mb-3">
                                                <button href="#myModalDelete<?= $i; ?>" id="btnModalDeleteLevel<?= $emp['idLevel']; ?>" name="btnModalDeleteLevel<?= $emp['idLevel']; ?>" class="btn btn-outline-danger w-100 btn-icon btn-delete-level" data-id="<?= $emp['idLevel']; ?>" data-level="<?= $emp['level']; ?>" data-menuaccess="<?= $emp['menu_access']; ?>">
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


<!--Modal: modalView-->
<div class="modal modal-blur fade show" id="modal-view-level" tabindex="-1" style="display: none; padding-right: 17px;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <h5 class="modal-title">View Level</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-status bg-success"></div>
            </div>
            <!--Body-->
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Level</label>
                            <input type="text" class="form-control" name="viewidlevel" id="viewidlevel" style="display: none;">
                            <input type="text" class="form-control" name="viewlevel" id="viewlevel" value="<?= old('viewlevel'); ?>" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <!--Footer-->
            <div class="modal-footer">
                <div class="row align-items-center">
                    <div class="col"></div>
                    <div class="col-auto">
                        <a class="btn btn-outline-danger waves-effect ms-auto" id="btnCloseLevel" name="btnCloseLevel" data-bs-dismiss="modal" onclick="javascript:window.location.reload()">
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
        <!--/.Content-->
    </div>
</div>
<!--Modal: modalView-->

<!--Modal: modalEdit-->
<div class="modal modal-blur fade show" id="modal-edit-level" tabindex="-1" style="display: none; padding-right: 17px;" aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form id="editlevelmodalForm" onsubmit="return setAction(this)">
                <div class="modal-header">
                    <h5 class="modal-title">Edit level</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Level</label>
                                <input type="text" class="form-control" name="editidlevel" id="editidlevel" style="display: none;">
                                <input type="text" class="form-control <?= ($validation->hasError('editlevel')) ? 'is-invalid' : ''; ?>" name="editlevel" id="editlevel" placeholder="Level" required>
                                <?php if ($validation->hasError('editlevel')) : ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('editlevel'); ?>
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
                            <button type="submit" class="btn btn-outline-primary ms-auto" id="btnUpdateLevel" name="btnUpdateLevel">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-refresh" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4"></path>
                                    <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4"></path>
                                </svg>
                                Update
                            </button>
                            <a class="btn btn-outline-secondary ms-auto" id="btnCloseLevel" name="btnCloseLevel" data-bs-dismiss="modal" onclick="javascript:window.location.reload()">
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
<!--Modal: modalEdit-->

<!--Modal: modalConfirmDelete-->
<div class="modal modal-blur fade show" id="modal-delete-level" tabindex="-1" style="display: none; padding-right: 17px;" aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
        <!--Content-->
        <div class="modal-content text-center">
            <form id="deletelevelmodalForm" onsubmit="return setAction(this)">
                <!--Header-->
                <div class="modal-header flex-center text-white" style="background-color: #ff3547;">
                    <h5 class="modal-title">Delete level</h5>
                </div>

                <!--Body-->
                <div class="modal-body">
                    <p> Are you sure delete this data?</p>
                    <input type="text" class="form-control" name="modaldelidlevel" id="modaldelidlevel" style="display: none;">
                    <input type="text" class="form-control" name="modaldellevel" id="modaldellevel" style="display: none;" readonly>
                    <i class="fas fa-times fa-4x animated rotateIn text-danger"></i>

                </div>

                <!--Footer-->
                <div class="modal-footer flex-center">
                    <button type="submit" class="btn btn-outline-danger" id="btnDeleteLevelYes">Yes</button>
                    <a type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal" onclick="javascript:window.location.reload()">No</a>
                </div>
            </form>
        </div>
        <!--/.Content-->
    </div>
</div>
<!--Modal: modalConfirmDelete-->

<?= $this->endSection(); ?>