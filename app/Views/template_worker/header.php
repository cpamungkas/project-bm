<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta10
* @link https://tabler.io
* Copyright 2018-2022 The Tabler Authors
* Copyright 2018-2022 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title><?= $title; ?></title>
    <!-- CSS files -->
    <link href="./css/tabler.min.css" rel="stylesheet" />
    <link href="./css/tabler-vendors.min.css" rel="stylesheet" />
    <link href="./css/demo.min.css" rel="stylesheet" />
    <?php if ($url == 'worker') { ?>
        <link href="./css/tabler-flags.min.css" rel="stylesheet" />
        <link href="./css/tabler-payments.min.css" rel="stylesheet" />
    <?php } ?>
    <?php if ($url == 'store' or $url = 'employee' or $url == 'techshift' or $url == 'troubleshift' or $url == 'troublejobout' or $url == 'troublejobin' or $url == 'trafocubicle' or $url == 'kwhmeter' or $url == 'panellvmdp' or $url == 'panelcapacitorbank' or preg_match('/^genset[1-2]$/', $url) or $url == 'dieselhydrant' or $url == 'acchiller' or $url == 'accoolingtower' or $url == 'acahu' or $url == 'acsplitwallduckcassettevrv' or $url == 'temperature' or $url == 'lighting' or $url == 'escalator' or $url == 'elevator' or $url == 'dumbwaiter' or $url == 'sanitary') { ?>
        <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous"> -->
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.jqueryui.min.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.jqueryui.min.css" />
        <link rel="stylesheet" href="https://nightly.datatables.net/responsive/css/responsive.dataTables.css?_=0733d80df58ca2854b640850303e9ae6.css" type="text/css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />


        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/select/1.4.0/css/select.dataTables.min.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.1.2/css/dataTables.dateTime.min.css" />
        <link rel="stylesheet" href="https://editor.datatables.net/extensions/Editor/css/editor.dataTables.min.css" />
        <!-- <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/4.1.0/css/fixedColumns.dataTables.min.css" /> -->
    <?php } ?>

    <!--Custom Sweetalert for this alert-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.10/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.10/dist/sweetalert2.css">
    <style>
        .animated {
            -webkit-animation-duration: 1s;
            animation-duration: 1s;
            -webkit-animation-fill-mode: both;
            animation-fill-mode: both;
        }

        @-webkit-keyframes rotateIn {
            0% {
                -webkit-transform-origin: center center;
                -webkit-transform: rotate(-200deg);
                opacity: 0;
            }

            100% {
                -webkit-transform-origin: center center;
                -webkit-transform: rotate(0);
                opacity: 1;
            }
        }

        @keyframes rotateIn {
            0% {
                transform-origin: center center;
                transform: rotate(-200deg);
                opacity: 0;
            }

            100% {
                transform-origin: center center;
                transform: rotate(0);
                opacity: 1;
            }
        }

        .rotateIn {
            -webkit-animation-name: rotateIn;
            animation-name: rotateIn;
        }

        .blank {
            display: none;
        }
    </style>
</head>