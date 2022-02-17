Dropzone.autoDiscover = false;
let boolVal = false;
$("#mydropzone").dropzone({
    paramName: "file",
    dictDefaultMessage: "Fotoğrafınızı Sürükle / Bırak Yaparak Seçebilirsiniz",
    maxFiles: 1,
    dictMaxFilesExceeded: "En fazla 1 Dosya Gönderebilirsiniz",
    maxFilesize: 2,
    dictFileTooBig: "Dosya boyutu fazla - Max:2Mb",
    acceptedFiles: ".jpg,.png",
    dictInvalidFileType: "Geçersiz dosya tipi (.png ve .jpg) olmalı !",
    addRemoveLinks: true,
    dictRemoveFile: "Dosyayı Kaldır",

    init: function () {

        const dz = this;
        const nextHref = document.getElementById("nextHref");

        dz.on("addedfile", function (file) {

            nextHref.classList.remove("disabled");
            nextHref.href = "#step-3"
            boolVal = true;

        });

        dz.on("error", function (file) {
            $("#mydropzone").prop("disabled", false);
            setTimeout(() => {
                this.removeFile(file);
            }, 1500);
        });


        dz.on("removedfile", function (file) {
            nextHref.classList.add("disabled");
        });


        dz.on("maxfilesexceeded", function (file) {
            alert("Lütfen Yanyana Dosya koymayınız buttonun aktif hale gelmesi için tekrardan dosyayı kaldırıp deneyiniz");
        });
    }
});


let drpVal = document.getElementById("mydropzone");
let myDropzone = document.getElementById("my_dropzone");
nextHref.addEventListener("click", function (e) {
    if (boolVal == true) {
        drpVal.classList.add("d-none");
        $('#smartwizard').smartWizard("stepState", [1], "disable");
        myDropzone.classList.remove("d-none");
    }
});