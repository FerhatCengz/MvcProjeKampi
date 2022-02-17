// $(".btnCikar").hide(0);
// let menuSayac;
// let adet = $("#adet").val();

// for (let i = 1; i <= adet; i++) {
//   $("#btn_Ekle_" + i).click((e) => {
//     let siparis_adi = $(e.target).attr("value");
//     let siparis_fiyat = $(e.target).attr("fiyat");
//     let siparis_resim = $(e.target).attr("hreff");

//     $("#id_UrunAdi").val(siparis_adi);
//     $("#id_UrunFiyat").val(siparis_fiyat);
//     $("#id_UrunResmi").val(siparis_resim);
//     $("#id_UrunId").val($(e.target).attr("toggle"));

//     let valuees = $("#formSepeteEkle").serialize();

//     $.ajax({
//       url: "yolla.php?islem=ekle",
//       type: "POST",
//       data: valuees,
//     });

//     menuSayac = document.getElementById("menuSayac").textContent;
//     menuSayac++;
//     document.getElementById("menuSayac").textContent = menuSayac;

//     if (menuSayac > 0) {
//       $("#btn_Cikar_" + i).show(0);
//       $("#btn_Ekle_" + i).hide(0);
//     }
//   });

//   $("#btn_Cikar_" + i).click((e) => {
//     menuSayac = document.getElementById("menuSayac").textContent;
//     menuSayac--;
//     $("#btn_Cikar_" + i).hide(0);
//     $("#btn_Ekle_" + i).show(0);
//     document.getElementById("menuSayac").textContent = menuSayac;

//     $("#id_UrunId").val($(e.target).attr("toggle"));

//     let formDegeleri = $("#formSepeteEkle").serialize();

//     $.ajax({
//       url: "yolla.php?islem=sil",
//       type: "POST",
//       data: formDegeleri,
//     });

//     console.log(formDegeleri);
//   });
// }
