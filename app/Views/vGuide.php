<?= $this->extend('template_worker/index'); ?>
<?= $this->section('page-content'); ?>

<div class="page-body">
    <div class="container-xl">
        <div class="row row-deck row-cards">
            <?php if(session("error")) { ?>
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

            <?php if(session("warning")) { ?>
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

            <?php if (session("success")) { ?>
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

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">User Guide</h3>
                    </div>

                    <div class='card-body'>
                        <div class="clearfix">
                            <div class="pull-right tableTools-container"></div>
                        </div>

                        <div class="table-responsive" style="overflow: auto; height: 450px;">
                            <table id="dynamic-table" class="table card-table table-vcenter table-bordered text-nowrap datatable" style="width:100%;">
                                <thead class='text-center' style="position: sticky; top: 0; z-index: 1; box-shadow: inset 0 200px 0 #e6e7e9, 200px 0 0 #e6e7e9, inset -200px 0 0 #e6e7e9;">
                                    <tr>
                                        <th class="w-1" rowspan="2" style="padding: 8px;">No</th>
                                        <th rowspan="2" style="padding: 8px;">Equipment</th>
                                        <th colspan="4" style="padding: 8px;">Daily</th>
                                        <th colspan="2" style="padding: 8px;">Weekly</th>
                                        <th rowspan="2" style="padding: 8px;">Monthly</th>
                                    </tr>
                                    <tr>
                                        <th style="padding: 8px;">08.00</th>
                                        <th style="padding: 8px;">10.00</th>
                                        <th style="padding: 8px;">13.00</th>
                                        <th style="padding: 8px;">19.00</th>
                                        <th style="padding: 8px;">10.00</th>
                                        <th style="padding: 8px;">19.00</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $i = 1;
                                        $j = 1;
                                        $k = 1;
                                        $currCat = -1;
                                        $currSubCat = -1;
                                        $count = 0;
                                    ?>
                                    <?php foreach($getUserGuide as $guide): ?>
                                        <tr>
                                            <?php
                                                if($guide['category_id'] != $currCat) {
                                                    $j = 1;
                                                    $count = 0;
                                                    foreach($getUserGuide as $g) {
                                                        if($g['category_id'] == $guide['category_id']) {
                                                            $count++;
                                                        }
                                                    }
                                                }
                                            ?>

                                            <?php if($guide['category_id'] != $currCat): ?>
                                                <td colspan="9" class="text-center text-uppercase table-primary"><?= $guide['category_name']; ?></td>
                                                </tr><tr>
                                                <td rowspan="<?= $count ?>" class='text-center' style="padding: 8px;"><?= $i++; ?></td>
                                            <?php endif; ?>

                                            <?php $currCat = $guide['category_id'] ?>

                                            <td style="white-space: normal; word-wrap: break-word; padding: 8px;">
                                                <?php
                                                    if(($guide['sub_category_id'] != 0) && ($guide['sub_category_id'] != $currSubCat)) {
                                                        $k = 1;
                                                        $currSubCat = $guide['sub_category_id'];
                                                        echo(($i - 1) . "." . ($j - 1) . "." . $k++);
                                                    }
                                                    else {
                                                        if(($guide['sub_category_id'] != 0) && ($guide['sub_category_id'] == $currSubCat)) {
                                                            echo(($i - 1) . "." . ($j - 1) . "." . $k++);
                                                        }
                                                        else {
                                                            echo(($i - 1) . "." . $j++);
                                                        }
                                                    }
                                                ?>
                                                <?= $guide['equipment']; ?>
                                            </td>

                                            <td class='text-center'>
                                                <?php if($guide['daily_08']) {
                                                    echo('
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M5 12l5 5l10 -10"></path>
                                                        </svg>
                                                    ');
                                                } ?>
                                            </td>
                                            <td class='text-center'>
                                                <?php if($guide['daily_10']) {
                                                    echo('
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M5 12l5 5l10 -10"></path>
                                                        </svg>
                                                    ');
                                                } ?>
                                            </td>
                                            <td class='text-center'>
                                                <?php if($guide['daily_13']) {
                                                    echo('
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M5 12l5 5l10 -10"></path>
                                                        </svg>
                                                    ');
                                                } ?>
                                            </td>
                                            <td class='text-center'>
                                                <?php if($guide['daily_19']) {
                                                    echo('
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M5 12l5 5l10 -10"></path>
                                                        </svg>
                                                    ');
                                                } ?>
                                            </td>
                                            <td class='text-center'>
                                                <?php if($guide['weekly_10']) {
                                                    echo('
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M5 12l5 5l10 -10"></path>
                                                        </svg>
                                                    ');
                                                } ?>
                                            </td>
                                            <td class='text-center'>
                                                <?php if($guide['weekly_19']) {
                                                    echo('
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M5 12l5 5l10 -10"></path>
                                                        </svg>
                                                    ');
                                                } ?>
                                            </td>
                                            <td class='text-center' style="padding: 8px;">
                                                <?php if($guide['monthly']) {
                                                    echo('
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M5 12l5 5l10 -10"></path>
                                                        </svg>
                                                    ');
                                                } ?>
                                            </td>
                                        </tr>
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

<?= $this->endSection(); ?>