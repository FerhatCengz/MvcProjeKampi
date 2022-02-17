<?php
session_start();
if (array_key_exists("ss_kulad", $_SESSION)) { ?>

    <!DOCTYPE html>
    <html lang="tr">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>AdminLTE 3 | Log in</title>

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

        <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">

        <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">

        <link rel="stylesheet" href="../dist/css/adminlte.min.css?v=3.2.0">
        <link rel="stylesheet" href="../CSS/style.css">

    </head>

    <body>
        <nav class="navbar navbar-expand navbar-primary navbar-dark">

            <ul class="navbar-nav ml-auto">

                <li class="nav-item dropdown">
                    <a href="cikis.php" class="btn text-white">Çıkış Yap</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>

            </ul>
        </nav>


        <div class="col-12 mt-5 mb-5 p-5">

            <div class="small-box bg-dark">
                <div class="inner">
                    <h1 class="text-center font-degistir">BEKLENEN SİPARİŞLER</h1>
                    <div class="d-flex justify-content-center">
                        <h3 class="badge badge-danger" id="beklenenSiparis"></h3>
                    </div>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="beklenensiparisler.php" class="small-box-footer">SİPARİŞLERE BAKIN &nbsp;<i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-12 mt-5 mb-5 p-5">

            <div class="small-box bg-warning">
                <div class="inner">
                    <h1 class="text-center font-degistir">MENÜYE YENİ BİR KATKIDA BULUN</h1>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="menuCrud/menu.php" class="small-box-footer">Devam Et &nbsp;<i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        </div>

    </body>



    <script src="../plugins/jquery/jquery.min.js"></script>

    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="../dist/js/adminlte.min.js?v=3.2.0"></script>
    <script>
        setInterval(() => {
            $("#beklenenSiparis").load("siparisAdeti.php");
        }, 1000);
    </script>
    </body>





















<?php } else {
    header("Location:giris.php");
}
?>