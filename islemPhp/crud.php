<?php
include "../baglan.php";

if (array_key_exists("islem",$_GET)) {
    $UrunAdi = $_POST["UrunAdi"];
    $UrunResmi = $_POST["UrunResmi"];
    $UrunAdet = $_POST["UrunAdet"];
    $UrunFiyat = $_POST["UrunFiyat"];
    $SiparisMasasi = $_GET["masaId"];

    $kasaSiparisSorgusu = <<<SQL
        INSERT INTO
            tbl_kasasiparis
        SET
             UrunAdi       =   ?
            ,UrunResmi     =   ?
            ,UrunAdet      =   ?
            ,UrunFiyat     =   ?
            ,SiparisMasasi =   ?
            ,Durum = 0

    SQL;

    $kasaSiparisSorgusuResult = $vt -> prepare($kasaSiparisSorgusu);
    $kasaSiparisSorgusuResult -> execute(array(
        $UrunAdi,
        $UrunResmi,
        $UrunAdet,
        $UrunFiyat,
        $SiparisMasasi,
    ));
}

//Sepetteki Ürünleri Silme İşlemi 
$sorguDelete = <<<SQL
Delete From tbl_anliksprs Where MasaId = ?
SQL;

$sorguExec = $vt->prepare($sorguDelete);
$sorguExec->execute(array($_GET["masaId"]));



//Sepetteki Urunun Adetini Azalatma İşlemi 






?>
