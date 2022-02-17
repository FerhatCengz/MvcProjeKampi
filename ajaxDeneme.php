<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <form method="post" id="form1">
        <input type="text" id="id_UrunAdi" name="UrunAdi" placeholder="Ürün Adı">
        <input type="text" id="id_UrunFiyat" name="UrunFiyat" placeholder="Ürün Fiyatı">
        <input type="text" id="id_MenuKategorisi" name="MenuKategorisi" placeholder="Menu Kategorisi">
        <input type="text" id="id_UrunResmi" name="UrunResmi" placeholder="Urun Resmi">
        <a id="btn_Ekle">Ekle</a>
    </form>



</body>

<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>

<script>
    $(document).ready(() => {

        $("#btn_Ekle").click(() => {

            var values = $("#form1").serialize();
            console.log(values);

            $.ajax({
                url: "yolla.php",
                type: "POST",
                data: values,
            });

            alert("veri tabanına bak");
        });



    });
</script>

</html>