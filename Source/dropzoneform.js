Dropzone.autoDiscover = false;
let fromVal = false;

$("#my_dropzone").dropzone({
    paramName: "file",
    dictDefaultMessage: "Cvinizi Sürükle / Bırak Yaparak Seçebilirsiniz",
    maxFiles: 1,
    dictMaxFilesExceeded: "En fazla 1 Dosya Gönderebilirsiniz",
    maxFilesize: 2,
    dictFileTooBig: "Dosya boyutu fazla - Max:5Mb",
    acceptedFiles: ".pdf",
    dictInvalidFileType: "Geçersiz dosya tipi (.pdf) olmalı !",
    addRemoveLinks: true,
    dictRemoveFile: "Dosyayı Kaldır",

    init: function () {

        const dz = this;
        const nextHref = document.getElementById("nextHref");

        dz.on("addedfile", function (file) {

            nextHref.classList.remove("disabled");
            fromVal = true;
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

nextHref.addEventListener("click", function (e) {
    if (fromVal === true) {
        myDropzone.classList.add("d-none");
        nextHref.href = "#step-4";
        nextHref.classList.add("d-none");
        $('#smartwizard').smartWizard("stepState", [2], "disable");

    }


});