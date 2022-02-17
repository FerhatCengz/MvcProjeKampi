<?php
include "../baglan.php";
include "girisKontrol2.php";
?>
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




    <?php
    $masaSiparisleriQuery = <<< SQL
        SELECT 
            DISTINCT SiparisMasasi
        FROM
            tbl_kasasiparis 
        Where 
            Durum = 0
        ORDER BY
             SiparisMasasi
    SQL;

    $masaSiparisleriQueryExecute = $vt->prepare($masaSiparisleriQuery);
    $masaSiparisleriQueryExecute->execute();
    $masaSiparisleriQueryExecuteEnd = $masaSiparisleriQueryExecute->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <?php
    $masaHesabi = <<<SQL
    SELECT 
        DISTINCT SiparisMasasi
    FROM 
        tbl_kasasiparis
    Where 
        Durum = 1 
            and
        OnayHesabi = 0
    ORDER BY
        SiparisMasasi
SQL;
    $masaHesabiExecute = $vt->prepare($masaHesabi);
    $masaHesabiExecute->execute();
    $masaHesabiExecuteEnd = $masaHesabiExecute->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <link rel="stylesheet" href="../CSS/style.css">
    <div class="container">
        <div class="d-flex justify-content-end mt-3">
            <button class="btn btn-info" data-toggle="modal" data-target="#exampleModal">HESAPLARI GÖRÜNTÜLE</button>
        </div>
        <h3 class="text-center mt-3"> <span class="badge badge-danger" id="siparisAdeti_H"></span> BEKLENEN SİPARİŞ ADETİ</h3>
        <div class="mt-5">
            <select style="font-size: 20px;" class="form-control text-center bg-dark" name="" id="select_masaSiparis">
                <option>MASA NUMARASI SEÇİNİZ</option>
                <?php
                for ($i = 0; $i < count($masaSiparisleriQueryExecuteEnd); $i++) { ?>
                    <option id="denemeOption" value="<?php echo $masaSiparisleriQueryExecuteEnd[$i]["SiparisMasasi"]; ?>"><?php echo $masaSiparisleriQueryExecuteEnd[$i]["SiparisMasasi"]; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div id="masaSiparisleriDiv"></div>


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title font-degistir" id="exampleModalLabel">MASA HESAPLARI</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <select name="" id="Masa_OnayNoSec" class="form-control">
                        <option value="">MASA NUMARASI SEÇİNİZ</option>
                        <?php for ($i = 0; $i < count($masaHesabiExecuteEnd); $i++) { ?>
                            <option value="<?php echo $masaHesabiExecuteEnd[$i]["SiparisMasasi"] ?>"><?php echo $masaHesabiExecuteEnd[$i]["SiparisMasasi"] ?></option>
                        <?php } ?>
                    </select>
                    <p id="hesapTablosu">

                    </p>
                </div>
                <div class="modal-footer">
                    <div style="margin:auto;">
                        <input type="button" class="btn" disabled style="font-size: 34px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="../plugins/jquery/jquery.min.js"></script>

<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="../dist/js/adminlte.min.js?v=3.2.0"></script>
<script>
    $(document).ready(() => {
        $("#select_masaSiparis").change((e) => {
            let siparisMasasi = e.target.value;
            $("#masaSiparisleriDiv").load("masaSiparisleri.php?masaNo=" + siparisMasasi);

        });

        $("#masaNoSec").change((e) => {
            let siparisMasasi = e.target.value;
            console.log(siparisMasasi);

        });

        setInterval(() => {
            $("#siparisAdeti_H").load("siparisAdeti.php");
        }, 1000);

        $("#Masa_OnayNoSec").change((e) => {
            let siparisMasasiOnay = e.target.value;
            $("#hesapTablosu").load("masaSiparisleri.php?islem=hesapGetir&masaNo=" + siparisMasasiOnay);

        });
    });
</script>