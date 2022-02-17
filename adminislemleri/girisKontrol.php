<?php
session_start();
include "../baglan.php";
$KULAD = $_POST["KULAD"];
$PASS = $_POST["PASS"];

$userKontrolQuery = <<<SQL
    SELECT 
        *
    FROM
        tbl_mudur 
    WHERE 
         KULAD  = ?
    and 
         PASS   = ? 
SQL;

$userKontrolEXECUTE = $vt -> prepare($userKontrolQuery);
$userKontrolEXECUTE -> execute(array($KULAD,$PASS));
$userKontrol_RESULT = $userKontrolEXECUTE -> fetchAll(PDO::FETCH_ASSOC);

if (count($userKontrol_RESULT) > 0) {
    $_SESSION["ss_kulad"] = $KULAD;
    header("Location:indexUser.php");

}
else {
    header("Location:giris.php");
    session_destroy();
}
