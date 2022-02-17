<?php
include "baglan.php";
?>

<?php
$siparisMenuleriQuery2 = <<<SQL
                                    SELECT
                                    	SiparisId,
                                    	UrunAdi,
                                    	UrunResmi,
                                    	UrunFiyat,
                                    	COUNT( UrunAdet ) AS UrunAdet,
                                    	UrunId,
                                    	MasaId 
                                    FROM
                                    	tbl_anliksprs 
                                    WHERE
                                    	MasaId = ? 
                                    GROUP BY
                                    	UrunAdi
                                    SQL;

$siparisMenuleriResult2 = $vt->prepare($siparisMenuleriQuery2);
$siparisMenuleriResult2->execute(array($_GET["masaId"]));
$sonucSiparisi2 = $siparisMenuleriResult2->fetchAll(PDO::FETCH_ASSOC);

?>
<div>
    <?php for ($i = 0; $i < count($sonucSiparisi2); $i++) { ?>
        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <?php echo $sonucSiparisi2[$i]["UrunAdi"]; ?>
                <span class="badge badge-danger badge-pill" id="siparisOzetiUl_<?php echo $i + 1 ?>">
                    <?php echo $sonucSiparisi2[$i]["UrunAdet"] . " Adet"; ?>
                </span>
            </li>
        </ul>
    <?php } ?>
</div>