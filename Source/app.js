$(document).ready(function(){
 

    // SmartWizard initialize
    $('#smartwizard').smartWizard({
        theme : 'arrows', 

        transition: {
            animation: 'slide-vertical', // Effect on navigation, none/fade/slide-horizontal/slide-vertical/slide-swing
            // speed: '100', // Transion animation speed
            // easing:'100' // Transition animation easing. Not supported without a jQuery easing plugin
        },
        

        toolbarSettings: {
            showNextButton: false, // İleri Buttonunu Gösterme İşlemi
            showPreviousButton: false, // Geri Buttonunu Gösterme İşlemi 
            toolbarButtonPosition: 'center',
        },

        // Klavye İle Kontrol Ettirme İşlemi
        keyboardSettings: {
            keyNavigation: false,
        },

        // Button Düğmelerini Adlandırma İşlemi
        lang: { // Language variables for button
            next: 'Sonraki Adım',
            previous: 'Önceki Adım'
        },

    });
   
   });






   // İnputların Kontrol İşlemi
let Ad = document.getElementById("Ad");
let Soyad = document.getElementById("Soyad");
let mailAdress = document.getElementById("mailAdress");
let dogumTarih = document.getElementById("dogumTarih");
let nextHref = document.getElementById("nextHref");
let dropZoneVal = document.getElementById("mydropzone"); 
// let boolAd = false , boolSoyad = false , boolMail = false , boolDgmTarih = false;

Ad.addEventListener("keyup",function(e)
{
    if (e.target.value.length >= 3)
    {
        Ad.classList.add("is-valid");
        Ad.classList.remove("is-invalid");
        Soyad.removeAttribute("disabled");
    }
    
    else
    {
        Ad.classList.add("is-invalid");
        Ad.classList.remove("is-valid");

    }
});


Soyad.addEventListener("keyup",function(e)
{
    if (e.target.value.length >= 3)
    {
        Soyad.classList.add("is-valid");
        Soyad.classList.remove("is-invalid");
        mailAdress.removeAttribute("disabled");
        

    }
    
    else
    {
        Soyad.classList.add("is-invalid");
        Soyad.classList.remove("is-valid");
    }
});

mailAdress.addEventListener("keyup",function(e)
{
    if (e.target.value.length >= 8)
    {
        mailAdress.classList.remove("is-invalid");
        mailAdress.classList.add("is-valid");
        dogumTarih.removeAttribute("disabled");


    
    }
    
    else
    {
        mailAdress.classList.add("is-invalid");
        mailAdress.classList.remove("is-valid");

    }
});

let tt = false;
dogumTarih.addEventListener("change",function(e)
{
    
    dogumTarih.classList.remove("is-invalid");
    dogumTarih.classList.add("is-valid");    
    nextHref.classList.remove("disabled");
    tt = true;

});




window.addEventListener('DOMContentLoaded', (event) => {
    window.location.href = "#step-1";
});