<?php include "baglan.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FC CAFE | INDEX </title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">

    <link rel="stylesheet" href="plugins/fullcalendar/main.css">

    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="stylesheet" href="CSS/style.css">
</head>

<body class="hold-transition sidebar-mini">
    <nav class="navbar navbar-expand navbar-white navbar-light">

        <div class="container">


            <ul class="navbar-nav">
                <li class="nav-item">
                    <img src="img/simge.png" style="width: 100px;">
                </li>
            </ul>
        </div>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                    <i class="fas fa-search"></i>
                </a>
                <div class="navbar-search-block mt-5" style="height: 100%;">
                    <form class="form-inline">
                        <div class="input-group input-group-sm">
                            <input class="form-control form-control-navbar" type="search" placeholder="İsteğiniz Nedir ? " aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-navbar" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>
        </ul>

        </div>
    </nav>

    <p class="text-center display-4 mt-5 font-degistir">MENÜLER</p>
    <div class="cizgi"></div>


    <?php
    $sql_menuKategori = <<<SQL
    SELECT * FROM tbl_kategori
    SQL;

    $query_MenuList = $vt->prepare($sql_menuKategori);
    $query_MenuList->execute();
    $sonuc = $query_MenuList->fetchAll(PDO::FETCH_ASSOC);


    ?>


    <div class="container mt-5" id="menuKategorisi">
        <div class="mr-5 ml-5 row row-cols-1 row-cols-md-2 g-4">
            <?php for ($i = 0; $i < count($sonuc); $i++) {  ?>
                <a href="menuIndex.php?ktgr=<?php echo $sonuc[$i]["KategoriID"] . "&masaId=" . $_GET["masaId"]; ?>">
                    <div class="col">
                        <div class="card menuKtgr">
                            <p class="card-title text-center font-degistir mt-2 text-white">
                                <?php echo mb_strtoupper($sonuc[$i]["MenuAdi"]); ?>
                            </p>
                            <i class="<?php echo $sonuc[$i]["KategoriIconu"]; ?> mt-5 mb-5 text-white" style="font-size: 100px; margin: auto;"></i>
                        </div>
                    </div>
                </a>


            <?php } ?>


        </div>







        <script src="plugins/jquery/jquery.min.js"></script>

        <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

        <script src="plugins/jquery-ui/jquery-ui.min.js"></script>

        <script src="dist/js/adminlte.min.js"></script>

        <script src="plugins/moment/moment.min.js"></script>
        <script src="plugins/fullcalendar/main.js"></script>

</body>

</html>