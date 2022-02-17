<?php
include "baglan.php";
//   SELECT DISTINCT UrunAdi , UrunResmi , UrunFiyat  , UrunAdet FROM tbl_anliksprs
$siparisVerileriMysql = <<<SQL
SELECT SiparisId ,UrunAdi , UrunResmi , UrunFiyat , COUNT(UrunAdet) as UrunAdet , UrunId , MasaId FROM tbl_anliksprs WHERE MasaId = ? GROUP BY UrunAdi 
SQL;

$listelemeIslemi = $vt->prepare($siparisVerileriMysql);
$listelemeIslemi->execute(array($_GET["masaId"]));
$listeSonucu = $listelemeIslemi->fetchAll(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body>
    <div class="d-flex justify-content-center" id="sepetUrunAdeti">
        <button class="btn btn-sm btn-danger mb-3" id="btnClear">Tümünü Temizle</button>
    </div>
    <div class="row">
        <div class="col-12">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Resim</th>
                        <th scope="col">Sipariş</th>
                        <th scope="col">Fiyat</th>
                        <th scope="col">Adet</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i = 0; $i < count($listeSonucu); $i++) { ?>

                        <tr>
                            <td scope="row">
                                <img src="adminislemleri/menuCrud/<?php echo $listeSonucu[$i]["UrunResmi"]; ?>" style="width: 100px;">
                            </td>
                            <td scope="row"><?php echo $listeSonucu[$i]["UrunAdi"]; ?></td>
                            <td scope="row"><?php echo $listeSonucu[$i]["UrunFiyat"]; ?> TL </td>
                            <td scope="row"><input type="button" class="btn btn-sm btn-danger mt-1 ml-1" value="-" id="<?php echo $listeSonucu[$i]["SiparisId"]; ?>">&nbsp;<b class="ml-2"><?php echo $listeSonucu[$i]["UrunAdet"]; ?></b>
                                &nbsp;<input toggle="<?php echo $listeSonucu[$i]["UrunId"];  ?>" type="button" class="btn btn-sm btn-info mt-1 ml-1" value="+" valuead="<?php echo $listeSonucu[$i]["UrunAdi"]; ?>" resim="<?php echo $listeSonucu[$i]["UrunResmi"]; ?>" fiyat="<?php echo $listeSonucu[$i]["UrunFiyat"]; ?>" resim="<?php echo $listeSonucu[$i]["UrunFiyat"]; ?>">
                                <i class="ml-2 mt-5 fas fa-trash listedenCikar" val="<?php echo $listeSonucu[$i]["UrunId"]; ?>" style="cursor: pointer;">

                                </i>

                            </td>
                        </tr>

                </tbody>
            <?php } ?>
            </table>
        </div>
    </div>








    <?php
    $totalMoneyQuery = <<< SQL
                SELECT
                    COUNT( UrunAdet ) UrunAdet,
                    UrunAdi,
                    UrunFiyat 
                FROM
                    tbl_anliksprs Where masaId = ?
                GROUP BY
                    UrunAdi
                SQL;
    $totalMoneyQueryExecute = $vt->prepare($totalMoneyQuery);
    $totalMoneyQueryExecute->execute(array($_GET["masaId"]));
    $totalMoneyQueryExecuteResult = $totalMoneyQueryExecute->fetchAll(PDO::FETCH_ASSOC);
    $totalFiyat = 0;
    $totalAdet = 0;
    $hesap = 0;
    for ($i = 0; $i < count($totalMoneyQueryExecuteResult); $i++) {
        $totalAdet = $totalMoneyQueryExecuteResult[$i]["UrunAdet"];
        $totalFiyat = $totalMoneyQueryExecuteResult[$i]["UrunFiyat"];
        $hesap += ($totalAdet * $totalFiyat);
    }

    ?>
    <input type="hidden" id="siparisTotalFiyat" value="<?php echo $hesap; ?>">
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>

    <script>
        $(document).ready(() => {
            $("#btnClear").click((e) => {
                $("#sepetUrunAdeti").load("islemPhp/crud.php?masaId=" + <?php echo $_GET["masaId"]; ?>);
            });



            $(".btn-danger").click((e) => {
                let siparistekiId = $(e.target).attr("id");
                $("#sepetUrunAdeti").load("islemPhp/sepetAdetIslemleri.php?adetId=" + siparistekiId + "&masaId=" + <?php echo $_GET["masaId"]; ?>);
            });

            $(".btn-info").click((e) => {
                let urunAd = e.target.getAttribute("valuead");
                let urunId = $(e.target).attr("toggle");
                let siparisAdi = $(e.target).attr("valueadvalue");
                let siparisResmi = $(e.target).attr("resim");
                let siparisFiyat = $(e.target).attr("fiyat");
                $.ajax({
                    url: "islemPhp/sepetAdetIslemleri.php?islem=adetArti&siparisResmi=" + siparisResmi + "&siparisFiyat=" + siparisFiyat + "&urunId=" + urunId + "&masaId=" + <?php echo $_GET["masaId"]; ?>,
                    type: "POST",
                    data: "UrunAdi=" + urunAd
                });

            });


            $(".listedenCikar").click((e) => {
                let listedenCikarId = $(e.target).attr("val");
                console.log(listedenCikarId);
                $("#sepetUrunAdeti").load("islemPhp/sepetAdetIslemleri.php?islem=hepsiniSil&LstId=" + listedenCikarId + "&masaId=" + <?php echo $_GET["masaId"]; ?>);
            });
        });
    </script>


</body>

</html>