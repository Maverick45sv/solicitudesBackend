<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de solicitudes</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/bootstrap/css/bootstrap.min.css');?>" >
     
</head>

<body class="bg-light">

    <section class="vh-100" style="background-color: #9A616D;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">

                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="<?= base_url('img/image2.png') ?>" alt="login form"
                                    class="img-fluid" style="border-radius: 1rem 0 0 1rem;" width="408"
                                    height="613" />
                            </div>

                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">

                                    <form action="ingresar" method="post">
                                        <?= csrf_field() ?>
                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                                            <span class="h1 fw-bold mb-0"></span>
                                        </div>

                                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Iniciar Sesión</h5>

                                        <div class="form-outline mb-4">
                                            <label for="user" class="form-label">Usuario</label>
                                            <input type="text" class="form-control" id="user" name="user" required>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label for="pass" class="form-label">Contraseña</label>
                                            <input type="password" class="form-control" id="pass" name="pass" required>
                                        </div>

                                        <div class="g-signin2" data-onsuccess="onSignIn"></div>

                                        <div class="pt-1 mb-4">
                                            <button class="btn btn-dark btn-lg btn-block" type="submit">Ingresar</button>
                                        </div>

                                        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                                            <form>
                                                <p class="mt-3">Ejemplo: admin/12345</p>
                                            </form>
                                        </div>
                                        <div class="mb-4">
                                            <!-- Facebook login button -->
                                            <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
                                            </fb:login-button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS and other scripts -->
    <script src="<?= base_url('public/js/jquery3_7_1.js') ?>"></script>
    <script src="<?= base_url('public/bootstrap/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('public/datatable/datatables.min.js') ?>"></script>
    <script src="<?= base_url('public/js/table.js') ?>"></script>
    <script src="<?= base_url('public/sweetalert/sweet.js') ?>"></script>

    <!-- Facebook and Google login scripts -->
    <script>
        // Facebook SDK initialization
        window.fbAsyncInit = function () {
            FB.init({
                appId: 'your-app-id',
                autoLogAppEvents: true,
                xfbml: true,
                version: 'v12.0'
            });
        };
    </script>

    <script>
        // Google login handler
        function onSignIn(googleUser) {
            var profile = googleUser.getBasicProfile();
            // Handle the user profile
            console.log(profile);
        }
    </script>

</body>

</html>
