<link rel="stylesheet" href="../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">


<?php
include "../baglan.php";
include "girisKontrol2.php";

$beklenenSiparisQuery = <<< SQL
             SELECT 
                COUNT(*) 
             AS
                BEKLENENSPRS
            FROM
                tbl_kasasiparis 
            WHERE Durum = 0
            SQL;

$beklenenSiparisQueryExecute = $vt->prepare($beklenenSiparisQuery);
$beklenenSiparisQueryExecute->execute();
$beklenenSiparisQueryExecuteEnd = $beklenenSiparisQueryExecute->fetchAll(PDO::FETCH_ASSOC);
echo $beklenenSiparisQueryExecuteEnd[0]["BEKLENENSPRS"];


?>


<script src="../plugins/sweetalert2/sweetalert2.min.js"></script>
