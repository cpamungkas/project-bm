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
    <?php if ($url == 'store' or $url = 'employee' or $url == 'techshift'  or $url == 'techjobout' or $url == 'techjobin' or $url == 'level' or $url == 'troubleshift' or $url == 'troublejobout' or $url == 'troublejobin') { ?>
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
        <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/litepicker/dist/css/litepicker.css" /> -->
    <?php } ?>

    <!--Custom Sweetalert for this alert-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.10/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.10/dist/sweetalert2.css">
    <style>
        .wrapper {
            position: relative;
            white-space: nowrap;
        }

        .wrapper .blurred-text,
        .wrapper .scanner .scanned-text {
            /* color: #ffffff; */
            color: #000;
            text-transform: uppercase;
            letter-spacing: 2px;
            font: bold 65px Arial;
        }

        .wrapper .blurred-text {
            filter: blur(2px);
            opacity: .2;
        }

        .wrapper .scanner {
            position: absolute;
            top: 0;
            left: 0;
            width: 120px;
            clip: rect(0, 120px, 80px, 0);
            background: linear-gradient(#000, #000 0) no-repeat,
                linear-gradient(to right, #000, #000 0) no-repeat,
                linear-gradient(to right, #000, #000 0) bottom left no-repeat,
                linear-gradient(to right, #000, #000 0) bottom left no-repeat,
                linear-gradient(to right, #000, #000 0) bottom right no-repeat,
                linear-gradient(to right, #000, #000 0) bottom right no-repeat,
                linear-gradient(to right, #000, #000 0) top right no-repeat,
                linear-gradient(to right, #000, #000 0) top right no-repeat;
            background-size: 10px 2px, 2px 10px;
            animation: scanner 3.5s ease-in-out infinite alternate;
        }

        .wrapper .scanner .scanned-text {
            animation: blurrer 3.5s ease-in-out infinite alternate;
        }

        @keyframes scanner {
            to {
                transform: translateX(820px);
            }
        }

        @keyframes blurrer {
            to {
                transform: translateX(-820px);
            }
        }


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

        /* start backdrop spinner */
        #cover-spin {
            position: fixed;
            width: 100%;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
            background-color: rgba(255, 255, 255, 0.7);
            z-index: 9999;
            display: none;
        }

        @-webkit-keyframes spin {
            from {
                -webkit-transform: rotate(0deg);
            }

            to {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        #cover-spin::after {
            content: "";
            display: block;
            position: absolute;
            left: 48%;
            top: 40%;
            width: 40px;
            height: 40px;
            border-style: solid;
            border-color: black;
            border-top-color: transparent;
            border-width: 4px;
            border-radius: 50%;
            -webkit-animation: spin 0.8s linear infinite;
            animation: spin 0.8s linear infinite;
        }

        /* end backdrop spinner */
    </style>
</head>