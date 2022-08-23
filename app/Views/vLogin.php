<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In | B.M Apps &copy; Gramedia ' <?= date('Y'); ?></title>
    <!-- favicon -->
    <link rel="shortcut icon" href="<?= base_url('images/favicon.ico'); ?>">

    <!-- Fontawesome Icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!--Custom Sweetalert for this alert-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.10/dist/sweetalert2.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.10/dist/sweetalert2.all.min.js"></script>

    <!-- CSS file Login -->
    <link rel="stylesheet" href="<?= base_url('css/login.css'); ?>">
</head>

<body>

    <div class="main">
        <div class="left-side">
            <img src="<?= base_url('images/logo/logobm.png'); ?>" alt="Logo BM Apps">
        </div>
        <div class="right-side">
            <h1>Login Account</h1>
            <!-- <?php if (session()->getFlashdata('error')) : ?>
                <p class="text-danger font-weight-bold"> <?= session()->getFlashdata('error') ?></p>
            <?php endif; ?> -->
            <form action="<?= base_url('login'); ?>" method="post">
                <div class="form-group">
                    <i class="fas fa-user"></i>
                    <input type="text" placeholder="Enter your NIK" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <i class="fas fa-key"></i>
                    <input type="password" placeholder="Enter your Password" id="password" name="password" required>
                    <span class="show-btn">
                        <i class="fas fa-eye" id="eye" onclick="showHide()"></i>
                    </span>
                </div>
                <div class="form-group">
                    <?php echo $captcha ?>
                </div>
                <div class="form-group">
                    <i>*Masukan kode Captcha di atas</i>
                    <input type="text" id="captcha_real" name="captcha_real" required>
                    <input type="hidden" id="captcha" name="captcha" value="<?php echo $captcha ?>">
                </div>
                <!-- < ?php if (session()->getFlashdata('error')) : ?>
                    <p class="text-danger font-weight-bold"> < ?= session()->getFlashdata('error') ?></p>
                < ?php endif; ?> -->
                <button type="submit">Log In</button>
            </form>
            <script type="text/javascript">
                const password = document.getElementById('password');
                const toggle = document.getElementById('eye');

                function showHide() {
                    if (password.type === 'password') {
                        password.setAttribute('type', 'text');
                        //toggle.classList.add('hide')
                        toggle.classList.remove('fa-eye')
                        toggle.classList.add('fa-eye-slash')
                        toggle.style.color = "#5887ef";
                    } else {
                        password.setAttribute('type', 'password');
                        //toggle.classList.remove('hide')
                        toggle.classList.remove('fa-eye-slash')
                        toggle.classList.add('fa-eye')
                        toggle.style.color = "#7a797e";
                    }
                }

                // var state = false;

                // function toggle() {
                //     if (state) {                        
                //         document.getElementById("password").setAttribute("type", "password");
                //         document.getElementById("eye").style.color = "#7a797e";
                //         state = false;
                //     } else {
                //         document.getElementById("password").setAttribute("type", "text");
                //         document.getElementById("eye").style.color = "#5887ef";                        
                //         state = true;
                //     }
                // }
            </script>
            <!-- <div class="login-with">
                <p>or</p>
                <i class="fab fa-facebook-f"></i>
                <i class="fab fa-instagram"></i>
                <i class="fab fa-twitter"></i>
                <i class="fab fa-google"></i>
            </div> -->
        </div>
        <!-- </div> -->

        <!-- Custom Sweetalert scripts for Alert-->
        <script type="text/javascript">
            $(document).ready(function() {
                <?php if (session()->getFlashdata('error')) : ?>
                    Swal.fire({
                        position: 'center-top',
                        icon: 'error',
                        title: 'Oops...',
                        text: "<?php echo session()->getFlashdata('error'); ?>"
                    })
                <?php endif; ?>
                <?php if (session()->getFlashdata('logoutmsg')) : ?>
                    Swal.fire({
                        // position: 'center-top',
                        icon: 'success',
                        title: 'Logout',
                        text: "<?php echo session()->getFlashdata('logoutmsg'); ?>",
                        showConfirmButton: false,
                        timer: 2000
                    })
                <?php endif; ?>

                <?php if (session()->getFlashdata('registersuccess')) : ?>
                    Swal.fire({
                        // position: 'center-top',
                        icon: 'success',
                        title: 'Registered',
                        text: "<?php echo session()->getFlashdata('registersuccess'); ?>",
                        showConfirmButton: false,
                        timer: 2000
                    })
                <?php endif; ?>
            });
        </script>

</body>

</html>