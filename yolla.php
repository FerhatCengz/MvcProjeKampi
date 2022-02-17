<?php
include "baglan.php";

if ($_GET["islem"] == "sil") {

    $id = $_POST["UrunId"];


    $sepetisilme = <<<SQL
    
    delete from tbl_anliksprs WHERE UrunId = ?
    
    SQL;

    $sepetisilmeislemi = $vt->prepare($sepetisilme);
    $sepetisilmeislemi->execute(array(
        $id
    ));
}





if ($_GET["islem"] == "ekle") {
    $UrunId = $_POST["UrunId"];
    $UrunAdi = $_POST["UrunAdi"];
    $UrunFiyat = $_POST["UrunFiyat"];
    $UrunResmi = $_POST["UrunResmi"];
    $UrunAdet = $_POST["UrunAdet"];
    $MasaId = $_REQUEST["masaId"];

    $eklemeSorgusuMysql = <<<SQL
INSERT INTO tbl_anliksprs SET
    UrunId=?,
    UrunAdi=?,
    UrunFiyat=?, 
    UrunResmi=?,
    UrunAdet=?,
    MasaId=?
SQL;


    $sorguCalistir = $vt->prepare($eklemeSorgusuMysql);
    $sorguCalistir->execute(array(
        $UrunId,
        $UrunAdi,
        $UrunFiyat,
        $UrunResmi,
        $UrunAdet,
        $MasaId,
    ));
}
