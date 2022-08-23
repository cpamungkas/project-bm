<?= $this->extend('template_worker/index'); ?>
<?= $this->section('page-content'); ?>

<!-- <div class="container-xl"> -->
<!-- Page title -->
<!-- <div class="page-header d-print-none"> -->
<!-- <div class="row g-2 align-items-center">
                        <div class="col">
                            <h2 class="page-title">
                                Empty page
                            </h2>
                        </div>
                    </div> -->
<!-- <div class="row g-2 align-items-center">
            <div class="col"> -->
<!-- Page pre-title -->
<!-- <div class="page-pretitle">
                    Dashboard
                </div>
                <h2 class="page-title">
                    < ?= $roleuser; ?>
                </h2>
            </div> -->
<!-- Page title actions -->
<!-- <div class="col-12 col-md-auto ms-auto d-print-none">
                <div class="btn-list">
                    <span class="d-none d-sm-inline">
                        <a href="#" class="btn btn-white">
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
                        </a>
                    </span>
                    <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-report">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-report" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M8 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h5.697"></path>
                            <path d="M18 14v4h4"></path>
                            <path d="M18 11v-4a2 2 0 0 0 -2 -2h-2"></path>
                            <rect x="8" y="3" width="6" height="4" rx="2"></rect>
                            <circle cx="18" cy="18" r="4"></circle>
                            <path d="M8 11h4"></path>
                            <path d="M8 15h3"></path>
                        </svg>
                        Create new report
                    </a>
                    <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#modal-report" aria-label="Create new report">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <line x1="12" y1="5" x2="12" y2="19" />
                            <line x1="5" y1="12" x2="19" y2="12" />
                        </svg>
                    </a>
                </div>
            </div> -->
<!-- </div> -->
<!-- </div> -->
<!-- </div> -->
<div class="page-body">
    <div class="container-xxl">
        <div class="row row-cards">
            <div class="col-md-6 col-xl-3">
                <a class="card card-link" href="store">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-auto">
                                <!-- <span class="avatar rounded" style="background-image: url(./static/avatars/001f.jpg)"></span> -->
                                <span class="avatar rounded"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-building-store" width="36" height="36" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <line x1="3" y1="21" x2="21" y2="21"></line>
                                        <path d="M3 7v1a3 3 0 0 0 6 0v-1m0 1a3 3 0 0 0 6 0v-1m0 1a3 3 0 0 0 6 0v-1h-18l2 -4h14l2 4"></path>
                                        <line x1="5" y1="21" x2="5" y2="10.85"></line>
                                        <line x1="19" y1="21" x2="19" y2="10.85"></line>
                                        <path d="M9 21v-4a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v4"></path>
                                    </svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">Store</div>
                                <div class="text-muted"><?= $totalstore; ?> Store</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-xl-3">
                <a class="card card-link" href="employee">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-auto">
                                <span class="avatar rounded">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="36" height="36" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <circle cx="9" cy="7" r="4"></circle>
                                        <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                        <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                                    </svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">Employee</div>
                                <div class="text-muted"><?= $totaluser; ?> Employee</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-xl-3">
                <a class="card card-link" href="#">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-auto">
                                <span class="avatar rounded">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-basket" width="36" height="36" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <polyline points="7 10 12 4 17 10"></polyline>
                                        <path d="M21 10l-2 8a2 2.5 0 0 1 -2 2h-10a2 2.5 0 0 1 -2 -2l-2 -8z"></path>
                                        <circle cx="12" cy="15" r="2"></circle>
                                    </svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">Store Equipment</div>
                                <div class="text-muted"><?= $totalequipment; ?> Store Equipment</div>
                            </div>

                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-xl-3">
                <a class="card card-link" href="#">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-auto">
                                <span class="avatar rounded">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-replace" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <rect x="3" y="3" width="6" height="6" rx="1"></rect>
                                        <rect x="15" y="15" width="6" height="6" rx="1"></rect>
                                        <path d="M21 11v-3a2 2 0 0 0 -2 -2h-6l3 3m0 -6l-3 3"></path>
                                        <path d="M3 13v3a2 2 0 0 0 2 2h6l-3 -3m0 6l3 -3"></path>
                                    </svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">Maintenance</div>
                                <div class="text-muted"><?= $totalmaintenance; ?> on progress</div>
                            </div>

                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-6 col-xl-3">
                <a class="card card-link" href="#">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-auto">
                                <!-- <span class="avatar rounded" style="background-image: url(./static/avatars/001f.jpg)"></span> -->
                                <span class="avatar rounded">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-truck-delivery" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <circle cx="7" cy="17" r="2"></circle>
                                        <circle cx="17" cy="17" r="2"></circle>
                                        <path d="M5 17h-2v-4m-1 -8h11v12m-4 0h6m4 0h2v-6h-8m0 -5h5l3 5"></path>
                                        <line x1="3" y1="9" x2="7" y2="9"></line>
                                    </svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">Operational</div>
                                <div class="text-muted"><?= $totaloperational; ?> Operated</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-xl-3">
                <a class="card card-link" href="#">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-auto">
                                <span class="avatar rounded">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-message" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M4 21v-13a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v6a3 3 0 0 1 -3 3h-9l-4 4"></path>
                                        <line x1="8" y1="9" x2="16" y2="9"></line>
                                        <line x1="8" y1="13" x2="14" y2="13"></line>
                                    </svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">Complaint Handling</div>
                                <div class="text-muted"><?= $totalcomplaint; ?> on progress handling</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-xl-3">
                <a class="card card-link" href="#">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-auto">
                                <span class="avatar rounded">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-analytics" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                        <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                                        <line x1="9" y1="17" x2="9" y2="12"></line>
                                        <line x1="12" y1="17" x2="12" y2="16"></line>
                                        <line x1="15" y1="17" x2="15" y2="14"></line>
                                    </svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">Report</div>
                                <div class="text-muted"><?= $totalreport; ?> Report</div>
                            </div>

                        </div>
                    </div>
                </a>
            </div>
            <!-- <div class="col-md-6 col-xl-3">
                <a class="card card-link" href="#">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-auto">
                                <span class="avatar rounded">BL</span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">Blank</div>
                                <div class="text-muted">0 on progress</div>
                            </div>

                        </div>
                    </div>
                </a>
            </div> -->
        </div>
    </div>
</div>

<?= $this->endSection(); ?>