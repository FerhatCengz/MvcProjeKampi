        <?php include "baglan.php" ?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>FC CAFE | INDEX </title>

            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
            <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
            <link rel="stylesheet" href="dist/css/adminlte.min.css">

            <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

            <link rel="stylesheet" href="plugins/toastr/toastr.min.css">

            <link rel="stylesheet" href="dist/css/adminlte.min.css?v=3.2.0">
            <link rel="stylesheet" href="CSS/style.css">
            <link rel="shortcut icon" href="#" />

        </head>

        <body class="hold-transition sidebar-mini" id="bbbd">
            <nav class="navbar navbar-expand navbar-white navbar-light">
                <div class="container">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="index.php?masaId=<?php echo $_GET["masaId"]; ?>"><img src="img/simge.png" style="width: 100px;"></a>
                        </li>
                    </ul>
                </div>

                <ul class="navbar-nav ml-auto position-fixed" style="z-index: 1000; margin-top: 100px;">
                    <li class="nav-item">
                        <button type="button" id="fa-shopping-basket" class="btn" data-toggle="modal" data-target="#exampleModal">
                            <i class="fas fa-shopping-basket text-warning" style="font-size: 34px;"></i>
                        </button>
                        <div class="navbar-search-block mt-5" style="height: 100%;">
                            <form class="form-inline">
                            </form>
                        </div>
                    </li>
                </ul>

                </div>
            </nav>

            <p class="text-center display-4 mt-5 font-degistir">MENÜLER</p>
            <div class="cizgi"></div>



            <?php


            $verileriListele = <<<SQL
            SELECT * from tbl_menu WHERE MenuKategorisi = ?
            SQL;


            $menuElemanlari = $vt->prepare($verileriListele);
            $menuElemanlari->execute(array($_GET['ktgr']));
            $sonuc = $menuElemanlari->fetchAll(PDO::FETCH_ASSOC);
            ?>

            <?php for ($i = 0; $i < count($sonuc); $i++) {  ?>
                <div class="d-flex justify-content-center mt-5 ml-3 mr-3" id="selam">
                    <input type="hidden" id="adet" value="<?php echo count($sonuc); ?>">
                    <div class="card mb-3 bg-dark" style="max-width: 540px;">

                        <h5 class="card-header text-center"><?php echo $sonuc[$i]["UrunAdi"] ?></h5>
                        <div class="row g-0 d-flex">
                            <div class="col-12">
                                <img src="adminislemleri/menuCrud/<?php echo $sonuc[$i]["UrunResmi"] ?>" class="img-fluid rounded-start">
                            </div>

                            <button toggle="<?php echo $sonuc[$i]["UrunId"]; ?>" class="btn btn-sm btn-danger btnCikar" id="btn_Cikar_<?php echo $i + 1 ?>">
                                <b>X</b>
                            </button>
                            <div class="card-body text-center">
                                <p class="card-text">Fiyat : <span id="urunFiyati"><?php echo $sonuc[$i]["UrunFiyat"] ?></spani> TL </p>
                            </div>
                        </div>
                        <div class="card-footer" id="urunSiparisAdeti_<?php echo $i + 1; ?>">
                            <div class="d-flex justify-content-center">
                                <a toggle="<?php echo $sonuc[$i]["UrunId"]; ?>" hreff="<?php echo $sonuc[$i]["UrunResmi"]; ?>" value="<?php echo $sonuc[$i]["UrunAdi"]; ?>" fiyat="<?php echo $sonuc[$i]["UrunFiyat"]; ?>" class="btn mt-3 btn-success btnEkle" id="btn_Ekle_<?php echo $i + 1 ?>">
                                    Ekle
                                </a>
                            </div>
                        </div>

                    </div>
                </div>

            <?php } ?>


            <form method="post" id="formSepeteEkle">
                <input type="hidden" value="" id="id_UrunId" name="UrunId">
                <input type="hidden" value="" id="id_UrunAdi" name="UrunAdi">
                <input type="hidden" value="" id="id_UrunFiyat" name="UrunFiyat">
                <input type="hidden" value="" id="id_UrunResmi" name="UrunResmi">
                <input type="hidden" value="1" id="id_UrunResmi" name="UrunAdet">
            </form>


            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header text-center">
                            <h5 class="modal-title font-degistir" id="exampleModalLabel">SİPARİŞLERİM</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" id="menuList">

                        </div>
                        <div class="modal-footer">
                            <div style="margin:auto;">
                                <input type="button" class="btn" disabled style="font-size: 34px;" id="siparisiVer" value="">
                                <span class="text-muted display-4">₺</span>
                            </div>
                            <button id="btn_siparisVer" class="btn btn-success" data-toggle="modal" data-target="#exampleModal2">ONAYLA</button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="exampleModal2" aria-labelledby="exampleModalLabel">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-degistir w-100 text-center">SİPARİŞ ONAYI</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <!-- BurADA ! -->

                        <div class="modal-body text-center">
                            <?php
                            $siparisMenuleriQuery = <<<SQL
                                    SELECT
                                    	SiparisId,
                                    	UrunAdi,
                                    	UrunResmi,
                                    	UrunFiyat,
                                    	COUNT( UrunAdet ) AS UrunAdet,
                                    	UrunId,
                                    	MasaId 
                                    FROM
                                    	tbl_anliksprs 
                                    WHERE
                                    	MasaId = ? 
                                    GROUP BY
                                    	UrunAdi
                                    SQL;

                            $siparisMenuleriResult = $vt->prepare($siparisMenuleriQuery);
                            $siparisMenuleriResult->execute(array($_GET["masaId"]));
                            $sonucSiparisi = $siparisMenuleriResult->fetchAll(PDO::FETCH_ASSOC);

                            ?>
                            <?php for ($i = 0; $i < count($sonucSiparisi); $i++) { ?>
                                <form method="POST" id="kasayaGonder_<?php echo $i + 1; ?>">
                                    <input type="hidden" name="UrunAdi" value="<?php echo $sonucSiparisi[$i]["UrunAdi"] ?>">
                                    <input type="hidden" name="UrunResmi" value="<?php echo $sonucSiparisi[$i]["UrunResmi"] ?>">
                                    <input type="hidden" name="UrunAdet" value="<?php echo $sonucSiparisi[$i]["UrunAdet"] ?>">
                                    <input type="hidden" name="UrunFiyat" value="<?php echo $sonucSiparisi[$i]["UrunFiyat"] ?>">
                                </form>
                            <?php } ?>
                            <input type="hidden" name="UrunFiyat" id="SPRSUrunFiyat" value="">

                            <div id="sepetDenemedeneme">

                            </div>




                            <input type="button" class="btn" disabled style="font-size: 34px;" id="siparisiVer2" value="">
                            <span class="text-muted display-4">₺</span>
                        </div>
                        <div class="modal-footer ml-5 mr-5 justify-content-around">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Vazgeç</button>
                            <button type="button" class="btn btn-success" id="btn_siparisOnay">Onayla</button>

                        </div>
                    </div>
                </div>
            </div>


            <script src="plugins/jquery/jquery.min.js"></script>
            <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
            <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
            <script src="plugins/toastr/toastr.min.js"></script>
            <script src="dist/js/adminlte.min.js?v=3.2.0"></script>




            <script>
                let sepetInterval;
                $('#exampleModal').on('show.bs.modal', function(e) {
                    sepetInterval = setInterval(() => {
                        $("#menuList").load("menuList.php?masaId=" + <?php echo $_GET["masaId"]; ?>);
                        let siparisTotalMoney = $("#siparisTotalFiyat").val();
                        $("#siparisiVer").val(siparisTotalMoney);
                        $("#siparisiVer2").val(siparisTotalMoney);
                        $("#SPRSUrunFiyat").val(siparisTotalMoney);
                        let siparisUcret = $("#siparisiVer").val();
                        siparisUcret > 0 ? $("#btn_siparisVer").show() : $("#btn_siparisVer").hide();
                        siparisUcret > 0 ? $("#btn_siparisOnay").show() : $("#btn_siparisOnay").hide();

                        $("#sepetDenemedeneme").load("selam.php?masaId=" + <?php echo $_GET["masaId"] ?>);
                    }, 700);
                });


                $('#exampleModal').on('hidden.bs.modal', function(e) {
                    clearInterval(sepetInterval);
                });
            </script>
            <script>
                $(".btnCikar").hide(0);
                let adet = $("#adet").val();

                for (let i = 1; i <= adet; i++) {
                    $("#btn_Ekle_" + i).click((e) => {
                        let gidecekId = $(e.target).attr("toggle");
                        let siparis_adi = $(e.target).attr("value");
                        let siparis_fiyat = $(e.target).attr("fiyat");
                        let siparis_resim = $(e.target).attr("hreff");

                        $("#id_UrunAdi").val(siparis_adi);
                        $("#id_UrunFiyat").val(siparis_fiyat);
                        $("#id_UrunResmi").val(siparis_resim);
                        $("#id_UrunId").val($(e.target).attr("toggle"));

                        let valuees = $("#formSepeteEkle").serialize();

                        $.ajax({
                            url: "yolla.php?islem=ekle&masaId=" + <?php echo $_GET["masaId"] ?>,
                            type: "POST",
                            data: valuees,
                        });



                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 1500,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer);
                                toast.addEventListener('mouseleave', Swal.resumeTimer);
                            }
                        });

                        Toast.fire({
                            icon: 'success',
                            title: siparis_adi + ' Sepete Eklendi !'
                        });
                    });

                    $("#btn_Cikar_" + i).click((e) => {
                        $("#btn_Cikar_" + i).hide(0);
                        $("#btn_Ekle_" + i).show(0);

                        $("#id_UrunId").val($(e.target).attr("toggle"));

                        let formDegeleri = $("#formSepeteEkle").serialize();

                        $.ajax({
                            url: "yolla.php?islem=sil",
                            type: "POST",
                            data: formDegeleri,
                        });

                        console.log(formDegeleri);
                    });
                }

                $("#btn_siparisOnay").click(() => {
                    let kontrol = false;
                    for (let index = 1; index <= <?php echo count($sonucSiparisi) ?>; index++) {
                        let gonderimRequest = $("#kasayaGonder_" + index).serialize();
                        $.ajax({
                            url: "islemPhp/crud.php?islem=kasa&masaId=" + <?php echo $_GET["masaId"]; ?>,
                            type: "POST",
                            data: gonderimRequest,
                            success: function(data) {
                                kontrol = true;
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Siparişiniz Alındı',
                                });
                                setTimeout(() => {
                                    location.reload();
                                }, 4000);
                            },
                        });
                    }
                    if (kontrol == false) {
                        let timerInterval;
                        Swal.fire({
                            icon: 'warning',
                            title: 'Hazırlık Bitince Sepeti Tekrar ONAYLAYINIZ !!',
                            html: 'Siparişiniz Hazırlanıyor <b></b>',
                            timer: 10000,
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading()
                                const b = Swal.getHtmlContainer().querySelector('b')
                                timerInterval = setInterval(() => {
                                    b.textContent = Swal.getTimerLeft()
                                }, 100)
                            },
                            willClose: () => {
                                clearInterval(timerInterval)
                            }
                        });
                        setTimeout(() => {
                            location.reload();
                        }, 10000);

                    }
                });
            </script>
        </body>

        </html>