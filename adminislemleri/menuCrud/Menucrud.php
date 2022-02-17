<?php
include "../../baglan.php";
include "../girisKontrol2.php";


if (array_key_exists("islemCrud", $_GET)) {
    $degeriAl = $_GET["islemCrud"];
    $urunId = $_GET["UrunId"];

    if ($degeriAl == 'delete') {
        $deleteQuery = <<<SQL
                DELETE FROM
                    tbl_menu
                Where UrunId = ?
            SQL;
        $deleteExecute = $vt->prepare($deleteQuery);
        $deleteExecute->execute(array(
            $urunId
        ));

        header("Location:menuDuzenle.php");
    } else {

        echo  $urunAdi = $_GET["UrunAdi"];
        echo  $urunFiyat = $_GET["UrunFiyat"];
        echo  $menuKategorisi = $_GET["MenuKategorisi"];
        echo  $urunId = $_GET["UrunId"];

        if ($menuKategorisi != 0) {
            $menuGuncelle = <<<SQL
        UPDATE
            tbl_menu
        SET
             UrunAdi          = ?
            ,UrunFiyat        = ?
            ,MenuKategorisi   = ?
        Where UrunId = ?
    SQL;

            $menuGuncelleExecute = $vt->prepare($menuGuncelle);
            $menuGuncelleExecute->execute(array(
                $urunAdi,
                $urunFiyat,
                $menuKategorisi,
                $urunId
            ));
        }
        header("Location:menuDuzenle.php");
    }
}


if (array_key_exists("ekle", $_GET)) {
    $MenuAdi = $_GET["menuAdi"];
    $mysqlInsertQuery = <<<SQL
        INSERT INTO
            tbl_kategori
        SET
            MenuAdi = ?   
    SQL;

    $mysqlInsertQueryExecute = $vt->prepare($mysqlInsertQuery);
    $mysqlInsertQueryExecute->execute(array(
        $MenuAdi
    ));
}


$target_dir = "UploadedFiles/";

$UrunAdi = $_POST["UrunAdi"];
$UrunFiyat = $_POST["UrunFiyat"];
$MenuKategorisi = $_POST["MenuKategorisi"];







if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir . $_FILES['file']['name'])) {

    if (array_key_exists("islemCrud", $_GET) == false) {
        $totalUrl = $target_dir . $_FILES['file']['name'];
        $eklemeSorgusu = <<<SQL
    INSERT INTO
        tbl_menu
    SET
           UrunAdi           =   ?
          ,UrunFiyat         =   ?
          ,MenuKategorisi    =   ?
          ,UrunResmi         =   ?
    SQL;

        $dataExecute =  $vt->prepare($eklemeSorgusu);
        $dataExecute->execute(array(
            $_REQUEST['UrunAdi'],
            $_REQUEST['UrunFiyat'],
            $_REQUEST['Menu_ktgr'],
            $target_dir . $_FILES['file']['name']
        ));


        $status = 1;
    }

    if (array_key_exists("resimGuncelle", $_GET)) {
        $totalUrl = $target_dir . $_FILES['file']['name'];
        $eklemeSorgusu = <<<SQL
        
        UPDATE
            tbl_menu
        SET
              UrunResmi    =   ?
              Where UrunId = ?
        SQL;

        $dataExecute =  $vt->prepare($eklemeSorgusu);
        $dataExecute->execute(array(
            $target_dir . $_FILES['file']['name'],
            $_REQUEST['UrunId'],

        ));


        $status = 1;
    }
}
