<?php
include "../../baglan.php";
include "../girisKontrol2.php";
$menuleriListeleQuery = <<<SQL
    SELECT
    A.UrunId as UrunId , A.UrunAdi , A.MenuKategorisi AS MenuKategorisi, A.UrunFiyat , B.MenuAdi AS MenuAdi, A.UrunResmi 
    FROM
     tbl_menu A
    JOIN
     tbl_kategori B 
     on 
     A.MenuKategorisi = B.KategoriID
SQL;
$menuleriListeleExecute = $vt->prepare($menuleriListeleQuery);
$menuleriListeleExecute->execute();
$menuleriListeleExecuteFetch = $menuleriListeleExecute->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | DataTables</title>


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


    <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">


    <script>
        (function(w, d) {
            ! function(a, e, t, r, z) {
                a.zarazData = a.zarazData || {}, a.zarazData.executed = [], a.zarazData.tracks = [], a.zaraz = {
                    deferred: []
                };
                var s = e.getElementsByTagName("title")[0];
                s && (a.zarazData.t = e.getElementsByTagName("title")[0].text), a.zarazData.w = a.screen.width, a.zarazData.h = a.screen.height, a.zarazData.j = a.innerHeight, a.zarazData.e = a.innerWidth, a.zarazData.l = a.location.href, a.zarazData.r = e.referrer, a.zarazData.k = a.screen.colorDepth, a.zarazData.n = e.characterSet, a.zarazData.o = (new Date).getTimezoneOffset(), a.dataLayer = a.dataLayer || [], a.zaraz.track = (e, t) => {
                    for (key in a.zarazData.tracks.push(e), t) a.zarazData["z_" + key] = t[key]
                }, a.zaraz._preSet = [], a.zaraz.set = (e, t, r) => {
                    a.zarazData["z_" + e] = t, a.zaraz._preSet.push([e, t, r])
                }, a.dataLayer.push({
                    "zaraz.start": (new Date).getTime()
                }), a.addEventListener("DOMContentLoaded", (() => {
                    var t = e.getElementsByTagName(r)[0],
                        z = e.createElement(r);
                    // z.defer = !0, z.src = "/cdn-cgi/zaraz/s.js?z=" + btoa(encodeURIComponent(JSON.stringify(a.zarazData))), t.parentNode.insertBefore(z, t)
                }))
            }(w, d, 0, "script");
        })(window, document);
    </script>
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
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">MENÜ LİSTESİ</h3>
        </div>

        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>RESİM</th>
                        <th>Ürün Adı</th>
                        <th>Ürün Fiyat</th>
                        <th>Menu Kategorisi</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php for ($i = 0; $i < count($menuleriListeleExecuteFetch); $i++) { ?>
                        <tr>

                            <td scope="row">
                                <img src="<?php echo $menuleriListeleExecuteFetch[$i]["UrunResmi"]; ?>" style="width: 100px;">
                            </td>
                            <td><span id="spn_urunAdi_<?php echo $i; ?>"><?php echo $menuleriListeleExecuteFetch[$i]["UrunAdi"]; ?></span></td>
                            <td><span id="spn_urunFiyat_<?php echo $i; ?>" class="tag tag-success"><?php echo $menuleriListeleExecuteFetch[$i]["UrunFiyat"]; ?></span> TL</td>
                            <td><span id="spn_MenuAdi_<?php echo $i; ?>"><?php echo $menuleriListeleExecuteFetch[$i]["MenuAdi"]; ?></span></td>
                            <td>
                                <div class="d-flex justify-content-around">
                                    <button btngetir=<?php echo $i; ?> btntasi="<?php echo $menuleriListeleExecuteFetch[$i]["MenuKategorisi"]; ?>" class="btn btn-warning text-white" data-toggle="modal" data-target="#exampleModal" id="<?php echo $menuleriListeleExecuteFetch[$i]["UrunId"]; ?>">Güncelle</button>
                                    <a href="Menucrud.php?islemCrud=delete&UrunId=<?php echo $menuleriListeleExecuteFetch[$i]["UrunId"]; ?>" class="btn btn-danger">Sil</a>
                                </div>
                            </td>
                        </tr>

                    <?php } ?>
                </tbody>

            </table>
        </div>

    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
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
                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Verileri Günceleyin
                                    </button>
                                </h2>
                            </div>
                            <input style="display: none;" type="text" class="form-control" id="text_Id" disabled>

                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body">
                                    <form method="POST" id="form_serilaze">
                                        <input type="text" class="form-control mt-3 w-75 m-auto" name="UrunAdi" id="menu_urunAdi" placeholder="Ürün Adını Giriniz">
                                        <br>
                                        <input type="text" class="form-control mt-3  w-75 m-auto" name="UrunFiyat" id="menu_urunFiyat" placeholder="Ürün Fiyatını Giriniz">
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
                                        <a id="btn_EkleGonder" type="button" class="btn btn-primary">Kaydet</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-header" id="headingTwo">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Resmi Günceleyin
                                </button>
                            </h2>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="dropzone w-75 m-auto text-info border border-primary">
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-info text-white btn-sm mt-3" id="btn_Guncelle">Resmi Güncelleyin</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</body>


<script src="../../plugins/jquery/jquery.min.js"></script>

<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../plugins/jszip/jszip.min.js"></script>
<script src="../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="../../dist/js/adminlte.min.js?v=3.2.0"></script>
<script src="../../plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="../../dropzone/dropzone.js"></script>
<script src="dropzoneUpdate.js"></script>
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            "pageLength": "1000",
            "language": {
                "sInfo": "Toplam _TOTAL_ Kayıttan _START_ ile _END_ Arasında Ki Kayıtlar Gözüküyor",
                "sSearch": "Aranacak Kelime:",
                "sInfoThousands": ",",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "İleri",
                    "sPrevious": "Geri"
                },
            }
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>

<script>
    $(document).ready(() => {
        $(".btn-warning").click((e) => {
            $("#text_Id").val(e.target.id);
            let degeriAL = e.target.getAttribute("btngetir");
            let deneme = $("#spn_urunAdi_" + degeriAL).text();
            $("#menu_urunAdi").val($("#spn_urunAdi_" + degeriAL).text());

            $("#menu_urunFiyat").val($("#spn_urunFiyat_" + degeriAL).text());

            let slct_value = e.target.getAttribute("btntasi");

            $("select").val(slct_value);


        });
        $("#btn_EkleGonder").click((e) => {
            let menuUrunAdi = $("#menu_urunAdi").val();
            let menuUrunFiyat = $("#menu_urunFiyat").val();
            let menuKtgr = $("#menu_ktgr").val();
            let urunId = $("#text_Id").val();
            e.target.href = "Menucrud.php?islemCrud=guncelle&UrunAdi=" + menuUrunAdi + "&UrunFiyat=" + menuUrunFiyat + "&MenuKategorisi=" + menuKtgr + "&UrunId=" + urunId;
            console.log(e.target.href);
        });
    });
</script>
</body>

</html>