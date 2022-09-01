<?= $this->extend('template_worker/index'); ?>
<?= $this->section('page-content'); ?>

<!-- <div class="container-xl"> -->
<!-- Page title -->
<!-- <div class="page-header d-print-none"> -->
<!-- <div class="row g-2 align-items-center">
            <div class="col"> -->
<!-- <h2 class="page-title">
                    Empty page
                </h2> -->
<!-- </div>
        </div> -->
<!-- <div class="row g-2 align-items-center"> -->
<!-- <div class="col"> -->
<!-- Page pre-title -->
<!-- <div class="page-pretitle">
                    Dashboard
                </div>
                <h2 class="page-title">
                    <?= $roleuser; ?>
                </h2> -->
<!-- </div> -->
<!-- Page title actions -->
<!-- <div class="col-12 col-md-auto ms-auto d-print-none"> -->
<!-- <div class="btn-list"> -->
<!-- <span class="d-none d-sm-inline"> -->
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
<!-- </span> -->
<!-- <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-create-store">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-building-store" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <line x1="3" y1="21" x2="21" y2="21"></line>
                            <path d="M3 7v1a3 3 0 0 0 6 0v-1m0 1a3 3 0 0 0 6 0v-1m0 1a3 3 0 0 0 6 0v-1h-18l2 -4h14l2 4"></path>
                            <line x1="5" y1="21" x2="5" y2="10.85"></line>
                            <line x1="19" y1="21" x2="19" y2="10.85"></line>
                            <path d="M9 21v-4a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v4"></path>
                        </svg>
                        Create new store
                    </a> -->
<!-- <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#modal-report" aria-label="Create new report">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <line x1="12" y1="5" x2="12" y2="19" />
                            <line x1="5" y1="12" x2="19" y2="12" />
                        </svg>
                    </a> -->
<!-- </div> -->
<!-- </div> -->
<!-- </div> -->
<!-- </div> -->
<!-- </div> -->
<div class="page-body">
    <div class="container-xxl">
        <div class="row row-deck row-cards">
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

            <div class="col-xxl">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Setup New Worker (Employee)</h3>
                    </div>
                    <div class="card-body">
                        <form id="createstoreForm" action="<?php echo base_url('employee/saveEmployee'); ?>" method="post">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label class="form-label">NIK</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('nik')) ? 'is-invalid' : ''; ?>" name="nik" id="nik" placeholder="NIK" maxlength="6" max="999999" onkeypress="return isNumeric(event)" oninput="maxLengthCheck(this)" value="<?= old('nik'); ?>" required>
                                        <?php if ($validation->hasError('nik')) : ?>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('nik'); ?>
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
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('nameworker')) ? 'is-invalid' : ''; ?>" name="nameworker" id="nameworker" placeholder="Name Worker" value="<?= old('nameworker'); ?>" required>
                                        <?php if ($validation->hasError('nameworker')) : ?>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('nameworker'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label class="form-label">Initial</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('initial')) ? 'is-invalid' : ''; ?>" name="initial" id="initial" placeholder="Initial" value="<?= old('initial'); ?>" required>
                                        <?php if ($validation->hasError('initial')) : ?>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('initial'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" name="email" id="email" placeholder="Email" value="<?= old('email'); ?>" required>
                                        <?php if ($validation->hasError('email')) : ?>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('email'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Username</label>
                                        <input type="text" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" name="username" id="username" placeholder="Username" value="<?= old('username'); ?>" required>
                                        <?php if ($validation->hasError('username')) : ?>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('username'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" name="password" id="password" placeholder="Password" value="<?= old('password'); ?>" required>
                                        <?php if ($validation->hasError('password')) : ?>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('password'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control <?= ($validation->hasError('confirmpassword')) ? 'is-invalid' : ''; ?>" name="confirmpassword" id="confirmpassword" placeholder="Confirm Password" value="<?= old('confirmpassword'); ?>" required>
                                        <?php if ($validation->hasError('confirmpassword')) : ?>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('confirmpassword'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label class="form-label">Employee Role</label>
                                        <select class="form-select" id="employeerole" name="employeerole" value="<?= old('employeerole'); ?>" required>
                                            <option value="">Select the role</option>
                                            <?php foreach ($getDataRole as $role) : ?>
                                                <option value="<?= $role['role_id']; ?>" <?php if (old('employeerole') == $role['role_id']) {
                                                                                                echo 'selected';
                                                                                            } ?>><?= $role['role']; ?> </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php if (session('errorrole')) { ?>
                                            <div class="invalid-feedback">
                                                <?= session("errorrole") ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label class="form-label">Superior Role</label>
                                        <select class="form-select superiorrole" id="superiorrole" name="superiorrole" value="<?= old('superiorrole'); ?>" required>
                                            <option value="">Select Superior Role</option>
                                            <?php foreach ($getDataRole as $pic) : ?>
                                                <option value="<?= $pic['role_id']; ?>" <?php if (old('superiorrole') == $pic['role_id']) {
                                                                                            echo 'selected';
                                                                                        } ?>><?= $pic['role']; ?> </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php if (session('errorsuperiorrole')) { ?>
                                            <div class="invalid-feedback">
                                                <?= session("errorsuperiorrole") ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label class="form-label">Superior Name</label>
                                        <select class="form-select superiorname" id="superiorname" name="superiorname" value="<?= old('superiorname'); ?>" required>
                                            <option value="">Select Superior Name</option>
                                            <?php if (old('superiorrole') != '') { ?>
                                                <?php foreach ($getDataSuperiorName as $name) : ?>
                                                    <option value="<?= $name['idSuperior']; ?>" <?php if (old('superiorname') == $name['idSuperior']) {
                                                                                                    echo 'selected';
                                                                                                } ?>><?= $name['SuperiorName']; ?> </option>
                                                <?php endforeach; ?>
                                            <?php } ?>
                                        </select>
                                        <?php if (session('errorsuperiorname')) { ?>
                                            <div class="invalid-feedback">
                                                <?= session("errorsuperiorname") ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label class="form-label">Level</label>
                                        <select class="form-select" id="level" name="level" value="<?= old('level'); ?>" required>
                                            <option value="">Select the level</option>
                                            <?php foreach ($getDataLevel as $lv) : ?>
                                                <option value="<?= $lv['idLevel']; ?>" <?php if (old('level') == $lv['idLevel']) {
                                                                                            echo 'selected';
                                                                                        } ?>><?= $lv['Level']; ?> </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php if (session('errorlevel')) { ?>
                                            <div class="invalid-feedback">
                                                <?= session("errorlevel") ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Location</label>
                                        <select class="form-select" id="location" name="location" value="<?= old('location'); ?>" required>
                                            <option value="">Select the location</option>
                                            <?php foreach ($getDataLocation as $loc) : ?>
                                                <option value="<?= $loc['idStore']; ?>" <?php if (old('location') == $loc['idStore']) {
                                                                                            echo 'selected';
                                                                                        } ?>><?= $loc['StoreCode'] . ' - ' . $loc['StoreName']; ?> </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php if (session('errorlocation')) { ?>
                                            <div class="invalid-feedback">
                                                <?= session("errorlocation") ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-footer">
                                <div class="row align-items-center">
                                    <div class="col"></div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-outline-primary ms-auto" id="btnSubmitEmployee" name="btnSubmitEmployee">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                            </svg>
                                            Add Worker
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
                            var _getForm = document.getElementById("createstoreForm");
                            _getForm.addEventListener('reset', function() {
                                document.getElementById("nik").focus()
                                document.getElementById("superiorname").val();
                            })
                            //]]>
                        </script>
                    </div>
                </div>

            </div>
            <div class="col-xxl">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Employee Table</h3>
                        </div>
                        <div class="clearfix">
                            <div class="pull-right tableTools-container" style="width:100%"></div>
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
                                        <th>NIK</th>
                                        <th>Username</th>
                                        <th>Initial</th>
                                        <th>Role</th>
                                        <th>Superior Role</th>
                                        <th>Superior Name</th>
                                        <th>Level</th>
                                        <th>Location</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($getDataEmployee as $emp) : ?>
                                        <tr>
                                            <!-- <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td> -->
                                            <td><?= $i; ?></td>
                                            <td><?= $emp['nik']; ?></td>
                                            <td><?= $emp['username']; ?></td>
                                            <td><?= $emp['initial']; ?></td>
                                            <td><?= $emp['roleuser']; ?></td>
                                            <td><?= $emp['rolesuperior']; ?></td>
                                            <td><?= $emp['SuperiorName']; ?></td>
                                            <td><?= $emp['levelname']; ?></td>
                                            <td><?= $emp['storename']; ?></td>
                                            <td>
                                                <!-- <div class="row g-2 align-items-center mb-n3"> -->
                                                <!-- <div class="col-4 col-sm-4 col-md-2 col-lg-auto mb-1"> -->
                                                <a href="#view" id="btnModalViewEmployee<?= $emp['id']; ?>" name="btnModalViewEmployee<?= $emp['id']; ?>" class="btn-outline-primary btn-view-employee" data-id="<?= $emp['id']; ?>" data-nik="<?= $emp['nik']; ?>" data-name="<?= $emp['name']; ?>" data-username="<?= $emp['username']; ?>" data-initial="<?= $emp['initial']; ?>" data-email="<?= $emp['email']; ?>" data-roleuser="<?= $emp['roleuser']; ?>" data-rolesuperior="<?= $emp['rolesuperior']; ?>" data-superiorname="<?= $emp['SuperiorName']; ?>" data-level="<?= $emp['levelname']; ?>" data-location="<?= $emp['storename']; ?>" data-imguser="<?= $emp['image']; ?>">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-zoom-in" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <circle cx="10" cy="10" r="7"></circle>
                                                        <line x1="7" y1="10" x2="13" y2="10"></line>
                                                        <line x1="10" y1="7" x2="10" y2="13"></line>
                                                        <line x1="21" y1="21" x2="15" y2="15"></line>
                                                    </svg>
                                                </a>
                                                <!-- </div>
                                                <div class="col-4 col-sm-4 col-md-2 col-lg-auto mb-1"> -->
                                                <a href="#edit" id="btnModalEditEmployee<?= $emp['id']; ?>" name="btnModalEditEmployee<?= $emp['id']; ?>" class="btn-outline-success btn-edit-employee" data-id="<?= $emp['id']; ?>" data-nik="<?= $emp['nik']; ?>" data-name="<?= $emp['name']; ?>" data-username="<?= $emp['username']; ?>" data-initial="<?= $emp['initial']; ?>" data-email="<?= $emp['email']; ?>" data-roleuser="<?= $emp['role_id']; ?>" data-rolesuperior="<?= $emp['superior_role_id']; ?>" data-superiorname="<?= $emp['superior_name_id']; ?>" data-level="<?= $emp['level']; ?>" data-location="<?= $emp['location']; ?>">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                                        <path d="M16 5l3 3"></path>
                                                    </svg>
                                                </a>
                                                <!-- </div>
                                                <div class="col-4 col-sm-4 col-md-2 col-lg-auto mb-1"> -->
                                                <a href="#delete" id="btnModalDeleteEmployee<?= $emp['id']; ?>" name="btnModalDeleteEmployee<?= $emp['id']; ?>" class="btn-outline-danger btn-delete-employee" data-id="<?= $emp['id']; ?>" data-nik="<?= $emp['nik']; ?>" data-name="<?= $emp['name']; ?>">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <line x1="4" y1="7" x2="20" y2="7"></line>
                                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                                    </svg>
                                                </a>
                                                <!-- </div> -->
                                                <!-- </div> -->


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
</div>
</div>


<!-- <div class="modal modal-blur fade" id="modal-create-employee" tabindex="-1" style="display: none;" aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form id="createstoremodalForm" action="<?php echo base_url('store/saveStore'); ?>" method="post" class="needs-validation" novalidate>
                <div class="modal-header">
                    <h5 class="modal-title">New store</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Store code</label>
                        <input type="text" class="form-control <?= ($validation->hasError('modalstorecode')) ? 'is-invalid' : ''; ?>" name="modalstorecode" id="modalstorecode" placeholder="Store Code" size="10" maxlength="5" max="99999" onkeypress="return isNumeric(event)" oninput="maxLengthCheck(this)" value="<?= old('modalstorecode'); ?>" required>
                        <?php if ($validation->hasError('modalstorecode')) : ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('modalstorecode'); ?>
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
                        <input type="text" class="form-control <?= ($validation->hasError('modalstorename')) ? 'is-invalid' : ''; ?>" name="modalstorename" id="modalstorename" placeholder="Store Name" value="<?= old('modalstorename'); ?>" required>
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
                                <select class="form-select" id="modalkwhmeter1" name="modalkwhmeter1" required>
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
                                <input type="number" class="form-control <?= ($validation->hasError('modalidpln1')) ? 'is-invalid' : ''; ?>" name="modalidpln1" id="modalidpln1" placeholder="ID PLN 1" maxlength="12" max="999999999999" value="<?= old('idpln1'); ?>" required>
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
                                <select class="form-select" id="modalkwhmeter2" name="modalkwhmeter2">
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
                                <input type="number" class="form-control" name="modalidpln2" id="modalidpln2" placeholder="ID PLN 2" maxlength="12" max="999999999999" value="<?= old('modalidpln2'); ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal" id="btnModalCancelCreate" name="btnModalCancelCreate">
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-primary ms-auto" id="btnModalSubmitCreate" name="btnModalSubmitCreate">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        Add store
                    </button>

                </div>
            </form>
        </div>
    </div>
</div> -->
<!-- <div class="modal modal-blur fade" id="modal-view-employee" tabindex="-1" style="display: none;" aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-full-width modal-dialog-centered">
        <div class="modal-content">
            <form id="viewemployeemodalForm" onsubmit="return setAction(this)">
                <div class="modal-header">
                    <h5 class="modal-title">View data employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-2">
                            <div class="mb-3">
                                <label class="form-label">NIK</label>
                                <input type="text" class="form-control" name="viewid" id="viewid" style="display: none;">
                                <input type="text" class="form-control <?= ($validation->hasError('viewnik')) ? 'is-invalid' : ''; ?>" name="viewnik" id="viewnik" placeholder="NIK" maxlength="6" max="999999" onkeypress="return isNumeric(event)" oninput="maxLengthCheck(this)" readonly>
                                <?php if ($validation->hasError('viewnik')) : ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('viewnik'); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control <?= ($validation->hasError('viewname')) ? 'is-invalid' : ''; ?>" name="viewname" id="viewname" placeholder="Name" readonly>
                                <?php if ($validation->hasError('viewname')) : ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('viewname'); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="mb-3">
                                <label class="form-label">Initial</label>
                                <input type="text" class="form-control <?= ($validation->hasError('viewinitial')) ? 'is-invalid' : ''; ?>" name="viewinitial" id="viewinitial" placeholder="Initial" readonly>
                                <?php if ($validation->hasError('viewinitial')) : ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('viewinitial'); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="text" class="form-control <?= ($validation->hasError('viewemail')) ? 'is-invalid' : ''; ?>" name="viewemail" id="viewemail" placeholder="Email" readonly>
                                <?php if ($validation->hasError('viewemail')) : ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('viewemail'); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" class="form-control <?= ($validation->hasError('viewusername')) ? 'is-invalid' : ''; ?>" name="viewusername" id="viewusername" placeholder="Username" readonly>
                                <?php if ($validation->hasError('viewusername')) : ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('viewusername'); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" name="viewpassword" id="viewpassword" placeholder="Password" readonly>
                                <div>
                                    <p class="text-danger">leave blank if you don't want to change the password</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label">Superior Role</label>
                                <select class="form-select superiorrole" id="viewsuperiorrole" name="viewsuperiorrole" disabled>
                                    <option value="">Select Superior Role</option>
                                    <?php foreach ($getDataRole as $pic) : ?>
                                        <option value="<?= $pic['role_id']; ?>" <?php if (old('viewsuperiorrole') == $pic['role_id']) {
                                                                                    echo 'selected';
                                                                                } ?>><?= $pic['role']; ?> </option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (session('errorviewsuperiorrole')) { ?>
                                    <div class="invalid-feedback">
                                        <?= session("errorviewsuperiorrole") ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label">Superior Name</label>
                                <select class="form-select superiorname" id="viewsuperiorname" name="viewsuperiorname" disabled>
                                    <option value="">Select Superior Name</option>
                                    <?php if (old('viewsuperiorname') != '') { ?>
                                        <?php foreach ($getDataSuperiorName as $name) : ?>
                                            <option value="<?= $name['idSuperior']; ?>" <?php if (old('viewsuperiorname') == $name['idSuperior']) {
                                                                                            echo 'selected';
                                                                                        } ?>><?= $name['SuperiorName']; ?> </option>
                                        <?php endforeach; ?>
                                    <?php } ?>
                                </select>
                                <?php if (session('errorviewsuperiorname')) { ?>
                                    <div class="invalid-feedback">
                                        <?= session("errorviewsuperiorname") ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label">Employee Role</label>
                                <select class="form-select" id="viewemployeerole" name="viewemployeerole" disabled>
                                    <option value="">Select the role</option>
                                    <?php foreach ($getDataRole as $role) : ?>
                                        <option value="<?= $role['role_id']; ?>" <?php if (old('viewemployeerole') == $role['role_id']) {
                                                                                        echo 'selected';
                                                                                    } ?>><?= $role['role']; ?> </option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (session('errorviewemployeerole')) { ?>
                                    <div class="invalid-feedback">
                                        <?= session("errorviewemployeerole") ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label">Level</label>
                                <select class="form-select" id="viewlevel" name="viewlevel" disabled>
                                    <option value="">Select the level</option>
                                    <?php foreach ($getDataLevel as $lv) : ?>
                                        <option value="<?= $lv['idLevel']; ?>" <?php if (old('viewlevel') == $lv['idLevel']) {
                                                                                    echo 'selected';
                                                                                } ?>><?= $lv['Level']; ?> </option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (session('errorviewlevel')) { ?>
                                    <div class="invalid-feedback">
                                        <?= session("errorviewlevel") ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label">Location</label>
                                <select class="form-select" id="viewlocation" name="viewlocation" disabled>
                                    <option value="">Select the location</option>
                                    <?php foreach ($getDataLocation as $loc) : ?>
                                        <option value="<?= $loc['idStore']; ?>" <?php if (old('viewlocation') == $loc['idStore']) {
                                                                                    echo 'selected';
                                                                                } ?>><?= $loc['StoreCode'] . ' - ' . $loc['StoreName']; ?> </option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (session('errorviewlocation')) { ?>
                                    <div class="invalid-feedback">
                                        <?= session("errorviewlocation") ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row align-items-center">
                        <div class="col"></div>
                        <div class="col-auto">
                            <a class="btn btn-outline-secondary ms-auto" id="btnCloseEmployee" name="btnCloseEmployee" data-bs-dismiss="modal">
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
</div> -->

<!--Modal: modalView-->
<div class="modal modal-blur fade show" id="modal-view-employee" tabindex="-1" style="display: none; padding-right: 17px;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <h5 class="modal-title">View Profile User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-status bg-success"></div>
            </div>
            <!--Body-->
            <div class="modal-body">
                <div class="row">
                    <div class="col-3 text-center">
                        <img id="imguser" src="https://mdbootstrap.com/img/Photos/Avatars/img%20(1).webp" alt="" class="img-fluid z-depth-1-half rounded-circle">
                        <div style="height: 10px"></div>
                    </div>

                    <div class="col-9">
                        <h4 class="m-t-0 m-b-0 detail_nikname"></h4>

                        <span class="job_post"></span>
                        <p class="location"></p>

                        <span class="m-t-0 m-b-0"><strong><u>Superior</u></strong></span>
                        <p class="superiorrole"></p>

                        <div>
                            <a class="btn btn-outline-primary btn-round waves-effect mailuser">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail" width="36" height="36" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <rect x="3" y="5" width="18" height="14" rx="2"></rect>
                                    <polyline points="3 7 12 13 21 7"></polyline>
                                </svg>
                                Mail
                            </a>
                            <button class="btn btn-outline-primary btn-round waves-effect">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-phone" width="36" height="36" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2"></path>
                                </svg>
                                Call
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!--Footer-->
            <div class="modal-footer">
                <div class="row align-items-center">
                    <div class="col"></div>
                    <div class="col-auto">
                        <a class="btn btn-outline-danger waves-effect ms-auto" id="btnCloseEmployee" name="btnCloseEmployee" data-bs-dismiss="modal" onclick="javascript:window.location.reload()">
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
<div class="modal modal-blur fade show" id="modal-edit-employee" tabindex="-1" style="display: none;" aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-full-width modal-dialog-centered">
        <div class="modal-content">
            <form id="editemployeemodalForm" onsubmit="return setAction(this)">
                <div class="modal-header">
                    <h5 class="modal-title">Edit data employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-2">
                            <div class="mb-3">
                                <label class="form-label">NIK</label>
                                <input type="text" class="form-control" name="editid" id="editid" style="display: none;">
                                <input type="text" class="form-control <?= ($validation->hasError('editnik')) ? 'is-invalid' : ''; ?>" name="editnik" id="editnik" placeholder="NIK" maxlength="6" max="999999" onkeypress="return isNumeric(event)" oninput="maxLengthCheck(this)" value="<?= old('editnik'); ?>" readonly>
                                <?php if ($validation->hasError('editnik')) : ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('editnik'); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control <?= ($validation->hasError('editname')) ? 'is-invalid' : ''; ?>" name="editname" id="editname" placeholder="Name" required>
                                <?php if ($validation->hasError('editname')) : ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('editname'); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="mb-3">
                                <label class="form-label">Initial</label>
                                <input type="text" class="form-control <?= ($validation->hasError('editinitial')) ? 'is-invalid' : ''; ?>" name="editinitial" id="editinitial" placeholder="Initial" required>
                                <?php if ($validation->hasError('editinitial')) : ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('editinitial'); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="text" class="form-control <?= ($validation->hasError('editemail')) ? 'is-invalid' : ''; ?>" name="editemail" id="editemail" placeholder="Email" required>
                                <?php if ($validation->hasError('editemail')) : ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('editemail'); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" class="form-control <?= ($validation->hasError('editusername')) ? 'is-invalid' : ''; ?>" name="editusername" id="editusername" placeholder="Username" required>
                                <?php if ($validation->hasError('editusername')) : ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('editusername'); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" name="editpassword" id="editpassword" placeholder="Password">
                                <div>
                                    <p class="text-danger">leave blank if you don't want to change the password</p>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" class="form-control <?= ($validation->hasError('editconfirmpassword')) ? 'is-invalid' : ''; ?>" name="editconfirmpassword" id="editconfirmpassword" placeholder="Confirm Password" value="<?= old('editconfirmpassword'); ?>" required>
                                <?php if ($validation->hasError('editconfirmpassword')) : ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('editconfirmpassword'); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div> -->
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label">Superior Role</label>
                                <select class="form-select superiorrole" id="editsuperiorrole" name="editsuperiorrole" required>
                                    <option value="">Select Superior Role</option>
                                    <?php foreach ($getDataRole as $pic) : ?>
                                        <option value="<?= $pic['role_id']; ?>" <?php if (old('editsuperiorrole') == $pic['role_id']) {
                                                                                    echo 'selected';
                                                                                } ?>><?= $pic['role']; ?> </option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (session('erroreditsuperiorrole')) { ?>
                                    <div class="invalid-feedback">
                                        <?= session("erroreditsuperiorrole") ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label">Superior Name</label>
                                <select class="form-select superiorname" id="editsuperiorname" name="editsuperiorname" required>
                                    <option value="">Select Superior Name</option>
                                    <?php if (old('superiorrole') != '') { ?>
                                        <?php foreach ($getDataSuperiorName as $name) : ?>
                                            <option value="<?= $name['idSuperior']; ?>" <?php if (old('editsuperiorname') == $name['idSuperior']) {
                                                                                            echo 'selected';
                                                                                        } ?>><?= $name['SuperiorName']; ?> </option>
                                        <?php endforeach; ?>
                                    <?php } ?>
                                </select>
                                <?php if (session('erroreditsuperiorname')) { ?>
                                    <div class="invalid-feedback">
                                        <?= session("erroreditsuperiorname") ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label">Employee Role</label>
                                <select class="form-select" id="editemployeerole" name="editemployeerole" required>
                                    <option value="">Select the role</option>
                                    <?php foreach ($getDataRole as $role) : ?>
                                        <option value="<?= $role['role_id']; ?>" <?php if (old('editemployeerole') == $role['role_id']) {
                                                                                        echo 'selected';
                                                                                    } ?>><?= $role['role']; ?> </option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (session('erroreditemployeerole')) { ?>
                                    <div class="invalid-feedback">
                                        <?= session("erroreditemployeerole") ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label">Level</label>
                                <select class="form-select" id="editlevel" name="editlevel" required>
                                    <option value="">Select the level</option>
                                    <?php foreach ($getDataLevel as $lv) : ?>
                                        <option value="<?= $lv['idLevel']; ?>" <?php if (old('editlevel') == $lv['idLevel']) {
                                                                                    echo 'selected';
                                                                                } ?>><?= $lv['Level']; ?> </option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (session('erroreditlevel')) { ?>
                                    <div class="invalid-feedback">
                                        <?= session("erroreditlevel") ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label">Location</label>
                                <select class="form-select" id="editlocation" name="editlocation" required>
                                    <option value="">Select the location</option>
                                    <?php foreach ($getDataLocation as $loc) : ?>
                                        <option value="<?= $loc['idStore']; ?>" <?php if (old('editlocation') == $loc['idStore']) {
                                                                                    echo 'selected';
                                                                                } ?>><?= $loc['StoreCode'] . ' - ' . $loc['StoreName']; ?> </option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (session('erroreditlocation')) { ?>
                                    <div class="invalid-feedback">
                                        <?= session("erroreditlocation") ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row align-items-center">
                        <div class="col"></div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-outline-primary ms-auto" id="btnUpdateEmployee" name="btnUpdateEmployee">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-refresh" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4"></path>
                                    <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4"></path>
                                </svg>
                                Update
                            </button>
                            <a class="btn btn-outline-secondary ms-auto" id="btnCloseEmployee" name="btnCloseEmployee" data-bs-dismiss="modal" onclick="javascript:window.location.reload()">
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
<div class="modal modal-blur fade show" id="modalConfirmDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
        <!--Content-->
        <div class="modal-content text-center">
            <form id="deleteemployeemodalForm" onsubmit="return setAction(this)">
                <!--Header-->
                <div class="modal-header flex-center text-white" style="background-color: #ff3547;">
                    <h5 class="modal-title">Delete employee</h5>
                </div>

                <!--Body-->
                <div class="modal-body">
                    <p> Are you sure delete this data?</p>
                    <input type="text" class="form-control" name="modaldelid" id="modaldelid" style="display: none;">
                    <input type="text" class="form-control" name="modaldelnik" id="modaldelnik" style="display: none;" readonly>
                    <input type="text" class="form-control" name="modaldelname" id="modaldelname" style="display: none;" readonly>
                    <i class="fas fa-times fa-4x animated rotateIn text-danger"></i>

                </div>

                <!--Footer-->
                <div class="modal-footer flex-center">
                    <button type="submit" class="btn btn-outline-danger" id="btnDeleteYes">Yes</button>
                    <a type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal" onclick="javascript:window.location.reload()">No</a>
                </div>
            </form>
        </div>
        <!--/.Content-->
    </div>
</div>
<!--Modal: modalConfirmDelete-->

<?= $this->endSection(); ?>