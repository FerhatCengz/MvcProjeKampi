<?php
include "../baglan.php";
include "girisKontrol2.php";
if (array_key_exists("SiparisMasasi", $_POST) && array_key_exists("siparisAl",$_GET) == false) {
    $masaUpdateQuery = <<< SQL
        UPDATE 
            tbl_kasasiparis
        SET
            Durum = 1
        Where SiparisMasasi = ?
    SQL;

    $masaUpdateExecute = $vt->prepare($masaUpdateQuery);
    $masaUpdateExecute->execute(array($_POST["SiparisMasasi"]));
    header("Location:beklenensiparisler.php");
}


if (array_key_exists("siparisAl", $_GET)) {
    $masaUpdateQuery = <<< SQL
        UPDATE 
            tbl_kasasiparis
        SET
            OnayHesabi = 1
        Where SiparisMasasi = ?
    SQL;

    $masaUpdateExecute = $vt->prepare($masaUpdateQuery);
    $masaUpdateExecute->execute(array($_POST["SiparisMasasi"]));
    header("Location:beklenensiparisler.php");
}
