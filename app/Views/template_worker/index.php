<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Header -->
    <?= $this->include('template_worker/header'); ?>
    <!-- End of Header -->
</head>

<body>
    <div id="cover-spin"></div>
    <div class="page">
        <!-- Header Navbar -->
        <?= $this->include('template_worker/navbar'); ?>
        <!-- End of Header Navbar -->
        <div class="page-wrapper">

            <!-- Sidebar -->
            <!-- < ?= $this->include('template_worker/sidebar'); ?> -->
            <!-- End of Sidebar -->

            <!-- /.main-content -->
            <div class="main-content">
                <?= $this->renderSection('page-content'); ?>
            </div>
            <!-- end main-content -->

            <!-- Footercopyright -->
            <?= $this->include('template_worker/footer_copyright'); ?>
            <!-- End of Footercopyright -->
        </div>
    </div>

    <!-- /.main-container -->


    <!-- Footer -->
    <?= $this->include('template_worker/footer'); ?>
    <!-- End of Footer -->

    <?= $this->renderSection('scripts'); ?>

</body>

</html>