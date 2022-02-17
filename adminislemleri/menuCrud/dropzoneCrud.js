Dropzone.autoDiscover = false;
$(document).ready(function () {
  var _dz = new Dropzone(".dropzone", {
    autoProcessQueue: false, // Dosyalar dropzone alanına bırakıldığı anda yüklemeye başlar, false olarak ayarlanırsa elle tetiklemek gerekir.
    parallelUploads: 10, // Aynı anda kaç dosya yüklenecek. Her hangi bir ayar belirtilmezse varsayılan 2'dir.
    timeout: 0,
    dictDefaultMessage: "Yüklemek istediğiniz dosyaları buraya bırakın",
    dictFallbackMessage:
      "Tarayıcınız sürükle bırak yüklemelerini desteklemiyor",
    dictFileTooBig:
      "Dosya boyutu çok büyük ({{filesize}} Mb). Yükleyebileceğiniz en büyük dosya boyutu: {{maxFilesize}} Mb.",
    dictResponseError: "Sunucu hatası. Hata kodu : {{statusCode}}",
    dictCancelUpload: "Yüklemeyi İptal Et",
    dictUploadCanceled: "Yükleme iptal edildi",
    dictCancelUploadConfirmation:
      "Bu yüklemeyip iptal etmek istediğinizden emin misiniz ?",
    dictRemoveFile: "Dosyayı Sil",
    acceptedFiles: ".jpg,.png",
    dictInvalidFileType: "Geçersiz dosya tipi (.png ve .jpg) olmalı !",
    dictMaxFilesExceeded: "Başka dosya yükleyemezsiniz.",
    maxFilesize: 5, // MB
    url: "Menucrud.php", // Yükleme işlemini yapacak sunucu dosyası
    removedfile: function (file) {
      //var name = file.name;
      var _ref;
      return (_ref = file.previewElement) != null
        ? _ref.parentNode.removeChild(file.previewElement)
        : void 0;
    },
    success: function (file, response, data) {
      console.log(file.upload.filename);
      console.log(file.size);
      _dz.removeFile(file); //Upload edilen dosya dropzone alanından silinir.
    },
    error: function (file, response) {
      file.previewElement.classList.add("dz-error");
    },

    init: function () {
      const dz = this;
      let urunAdi = document.getElementById("menu_urunAdi");
      let urunFiyat = document.getElementById("menu_urunFiyat");
      let menu_ktgr = document.getElementById("menu_ktgr");

      this.on("sending", function (image, xhr, formData) {
        formData.append("UrunAdi", urunAdi.value);
        formData.append("UrunFiyat", urunFiyat.value);
        formData.append("Menu_ktgr", menu_ktgr.value);
      });

      $(document).on("click", "#btn_Ekle", function (e) {
          dz.processQueue();
      });

      dz.on("error", function (file) {
        window.location.reload();
      });

      dz.on("success", function (file) {
        Swal.fire({
          icon: "success",
          title: "Resminiz Başarılı Bir Şekilde Yüklendi !",
          confirmButtonText: "Tamam",
        });
      });
    },
  });
});
