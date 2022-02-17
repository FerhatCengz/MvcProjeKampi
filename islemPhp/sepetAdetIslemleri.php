<?php
include "../baglan.php";


if (array_key_exists("islem", $_GET) == true) {

    if ($_GET["islem"] == "hepsiniSil") {

        $deleteQuery = <<<SQL
    DELETE FROM tbl_anliksprs Where UrunId = ? and MasaId = ?
    SQL;
        $deleteResult = $vt->prepare($deleteQuery);
        $deleteResult->execute(array(
            $_GET["LstId"],
            $_GET["masaId"]       
        ));
    }
}




if (array_key_exists("islem", $_GET) == true) {
    if ($_GET["islem"] == "adetArti") {
        $UrunAdi = $_POST["UrunAdi"];
        $UrunFiyat = $_GET["siparisFiyat"];
        $UrunResmi = $_GET["siparisResmi"];
        $UrunAdet = 1;
        $UrunId = $_GET["urunId"];
        $MasaId = $_GET["masaId"];

        $eklemeSorgusuMysql = <<<SQL
            INSERT INTO 
                tbl_anliksprs
            SET
                 UrunAdi=?
                ,UrunFiyat=?
                ,UrunResmi=?
                ,UrunAdet=?
                ,UrunId=?
                ,MasaId=?
SQL;

        $sorguCalistir = $vt->prepare($eklemeSorgusuMysql);
        $sorguCalistir->execute(array(
            $UrunAdi,
            $UrunFiyat,
            $UrunResmi,
            $UrunAdet,
            $UrunId,
            $MasaId
            
        ));
    }
} else {
    $adetAzaltmaSorgusu = <<<SQL
     DELETE FROM tbl_anliksprs Where SiparisId = ? and MasaId = ?
 SQL;
    $adetAzaltmaSorgusuExecute = $vt->prepare($adetAzaltmaSorgusu);
    $adetAzaltmaSorgusuExecute->execute(array($_GET["adetId"],$_GET["masaId"]));
}
