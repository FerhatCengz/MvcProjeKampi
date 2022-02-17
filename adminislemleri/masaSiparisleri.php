<?php
include "../baglan.php";
include "girisKontrol2.php";

$masasiparisleriQuery = <<<SQL
    SELECT
        *
    FROM
        tbl_kasasiparis Where SiparisMasasi = ? and Durum = 0
SQL;

$masasiparisleriQueryExecute = $vt->prepare($masasiparisleriQuery);
$masasiparisleriQueryExecute->execute(array($_GET["masaNo"]));
$masasiparisleriQueryExecuteEnd = $masasiparisleriQueryExecute->fetchAll(PDO::FETCH_ASSOC);

if (array_key_exists("islem", $_GET) == false) { ?>
    <div class="row">
        <div class="col-12">
            <div class="card mt-5">
                <div class="card-header d-flex justify-content-center">
                    <h1 class="card-title"><b><?php echo "MASA " . $_GET["masaNo"]; ?> SİPARİŞİ</b></h1>
                    <div class="d-flex justify-content-center w-75">
                        <form action="siparisEnd.php" method="POST">
                            <input type="hidden" value="<?php echo $_GET["masaNo"]; ?>" name="SiparisMasasi">
                            <button type="submit" class="btn btn-success" id="btn_siparisTeslimi"><i class="fa fa-bell"></i> SİPARİŞ TESLİM ET </button>
                        </form>

                    </div>
                </div>
                <div class="card-body table-responsive p-0" style="height: 300px;">
                    <table class="table table-head-fixed text-nowrap">
                        <thead class="text-center">
                            <tr>
                                <th>RESİM</th>
                                <th>ADET</th>
                                <th>SİPARİŞ</th>
                                <th>FİYAT</th>
                                <th>TOTAL FİYAT</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php for ($i = 0; $i < count($masasiparisleriQueryExecuteEnd); $i++) { ?>
                                <tr>
                                    <td scope="row">
                                        <img src="menuCrud/<?php echo $masasiparisleriQueryExecuteEnd[$i]["UrunResmi"]; ?>" style="width: 100px;">
                                    </td>
                                    <td><?php echo $masasiparisleriQueryExecuteEnd[$i]["UrunAdet"]; ?></td>
                                    <td><?php echo $masasiparisleriQueryExecuteEnd[$i]["UrunAdi"]; ?></td>
                                    <td><span class="tag tag-success"><?php echo $masasiparisleriQueryExecuteEnd[$i]["UrunFiyat"]; ?></span> TL</td>
                                    <td><?php echo $masasiparisleriQueryExecuteEnd[$i]["UrunAdet"] * $masasiparisleriQueryExecuteEnd[$i]["UrunFiyat"]; ?><span> TL</span></td>
                                    <?php @$totalHesap += $masasiparisleriQueryExecuteEnd[$i]["UrunAdet"] * $masasiparisleriQueryExecuteEnd[$i]["UrunFiyat"]; ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
    <h1 class="text-center"><?php echo $totalHesap; ?> ₺</h1>

<?php } else {
    $masasiparisleriQuery_2 = <<<SQL
    SELECT
        *
    FROM
        tbl_kasasiparis Where SiparisMasasi = ? and Durum = 1 and OnayHesabi = 0
SQL;

    $masasiparisleriQueryExecute_2 = $vt->prepare($masasiparisleriQuery_2);
    $masasiparisleriQueryExecute_2->execute(array($_GET["masaNo"]));
    $masasiparisleriQueryExecuteEnd_2 = $masasiparisleriQueryExecute_2->fetchAll(PDO::FETCH_ASSOC); ?>

    <div class="row">
        <div class="col-12">
            <div class="card mt-5">
                <div class="card-header d-flex justify-content-center">
                    <h1 class="card-title"><b><?php echo "MASA " . $_GET["masaNo"]; ?> HESABI</b></h1>
                    <div class="d-flex justify-content-center w-75">
                        <form action="siparisEnd.php?siparisAl=true" method="POST">
                            <input type="hidden" value="<?php echo $_GET["masaNo"]; ?>" name="SiparisMasasi">
                            <button class="btn btn-success" id="masayiKapat">MASAYI KAPAT</button>
                        </form>

                    </div>
                </div>
                <div class="card-body table-responsive p-0" style="height: 300px;">
                    <table class="table table-head-fixed text-nowrap">
                        <thead class="text-center">
                            <tr>
                                <th>RESİM</th>
                                <th>ADET</th>
                                <th>SİPARİŞ</th>
                                <th>FİYAT</th>
                                <th>TOTAL FİYAT</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php for ($i = 0; $i < count($masasiparisleriQueryExecuteEnd_2); $i++) { ?>
                                <tr>
                                    <td scope="row">
                                        <img src="menuCrud/<?php echo $masasiparisleriQueryExecuteEnd_2[$i]["UrunResmi"]; ?>" style="width: 100px;">
                                    </td>
                                    <td><?php echo $masasiparisleriQueryExecuteEnd_2[$i]["UrunAdet"]; ?></td>
                                    <td><?php echo $masasiparisleriQueryExecuteEnd_2[$i]["UrunAdi"]; ?></td>
                                    <td><span class="tag tag-success"><?php echo $masasiparisleriQueryExecuteEnd_2[$i]["UrunFiyat"]; ?></span> TL</td>
                                    <td><?php echo $masasiparisleriQueryExecuteEnd_2[$i]["UrunAdet"] * $masasiparisleriQueryExecuteEnd_2[$i]["UrunFiyat"]; ?><span> TL</span></td>
                                    <?php @$totalHesap += $masasiparisleriQueryExecuteEnd_2[$i]["UrunAdet"] * $masasiparisleriQueryExecuteEnd_2[$i]["UrunFiyat"]; ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>

    <h1 class="text-center"><?php echo @$totalHesap; ?> ₺</h1>

<?php } ?>