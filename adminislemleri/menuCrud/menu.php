<?php
include "../../baglan.php";
include "../girisKontrol2.php";
$menuKtgrGetir = <<<SQL
SELECT 
    *
FROM
    tbl_kategori
SQL;
$menuKtgrGetirExecute = $vt->prepare($menuKtgrGetir);
$menuKtgrGetirExecute->execute();
$menuKtgrGetirExecuteEnd = $menuKtgrGetirExecute->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FC CAFE | INDEX </title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">

    <link rel="stylesheet" href="../../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

    <link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">

    <link rel="stylesheet" href="../../dist/css/adminlte.min.css?v=3.2.0">
    <link rel="stylesheet" href="../../dropzone/dropzone.css">
    <link rel="stylesheet" href="../../dropzone/cropper.css">
    <link rel="stylesheet" href="../../CSS/style.css">
    <link rel="shortcut icon" href="#" />

</head>

<body>

    <nav class="navbar navbar-expand navbar-primary navbar-dark mb-4">

        <ul class="navbar-nav ml-auto">

            <li class="nav-item dropdown">
                <a href="../cikis.php" class="btn text-white">Çıkış Yap</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>

        </ul>
    </nav>
    <div class="d-flex justify-content-end">
        <button class="btn btn-info mr-5" data-toggle="modal" data-target="#exampleModal">MENÜ KATEGORİSİ EKLE</button>
    </div>


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <input type="text" class="form-control" placeholder="Menüde Gözükecek Kategori Adını Giriniz" name="MenuAdi" id="text_menuAdi">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Pencereyi Kapat</button>
                    <button type="button" class="btn btn-primary" id="btn_ktgrEkle">Kaydet</button>
                </div>
            </div>
        </div>
    </div>


    <form class="ml-5 mt-5 mr-5" method="POST" id="infoMenu">
        <h3 class="font-degistir text-center mb-3">MENÜYE EKLE</h3>
        <input type="text" class="form-control mt-3 w-75 m-auto" name="UrunAdi" placeholder="Adi" id="menu_urunAdi" required>
        <br>
        <input type="text" class="form-control mt-3  w-75 m-auto" name="UrunFiyat" placeholder="Fiyat" id="menu_urunFiyat" required>
        <br>
        <select id="menu_ktgr" name="MenuKategorisi" class="m-auto form-control mt-3 w-75">
            <option value="0">Seçiniz</option>
            <?php
            for ($i = 0; $i < count($menuKtgrGetirExecuteEnd); $i++) {  ?>
                <option value="<?php echo $menuKtgrGetirExecuteEnd[$i]["KategoriID"]; ?>">
                    <?php echo $menuKtgrGetirExecuteEnd[$i]["MenuAdi"]; ?>
                </option>
            <?php } ?>
        </select>
        <br>
    </form>

    <div class="dropzone w-75 m-auto text-info border border-primary">
    </div>
    <div class="d-flex justify-content-center">
        <a id="btn_Ekle" class="btn btn-success mt-4">Kaydet</a>
    </div>

    <div class="d-flex justify-content-end">
        <a href="menuDuzenle.php" class="btn btn-info mr-5">Düzenle</a>
    </div>
</body>
<script src="../../plugins/jquery/jquery.min.js"></script>
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="../../plugins/toastr/toastr.min.js"></script>
<script src="../../dist/js/adminlte.min.js?v=3.2.0"></script>
<script src="../../dropzone/dropzone.js"></script>
<script src="dropzoneCrud.js"></script>
<script>
    $("#btn_ktgrEkle").click(() => {
        let MenuAdi = $("#text_menuAdi").val();
        $.ajax({
            url: "Menucrud.php?ekle=true&menuAdi=" + MenuAdi,
            method: "POST",
        });
        Swal.fire({
            icon: "success",
            title: "Ekleme İşlemi Başarılı",
            confirmButtonText: "Tamam",
        });
        setInterval(() => {
            window.location.reload();
        }, 3000);
    });
</script>



</html>