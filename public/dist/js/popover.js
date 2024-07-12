document.addEventListener("DOMContentLoaded", function () {
    
    var arquivoElement = document.getElementById("arquivo");

    if (arquivoElement) {

        arquivoElement.addEventListener("change", function (event) {

            var input = event.target;

            var fileName = input.files[0].name;

            var label = document.querySelector(".custom-file-label");

            label.textContent = fileName;
            
        });

    }

    document.querySelectorAll("[data-toggle='popover']").forEach(function (element) {
        
        element.addEventListener("click", function (event) {

            event.preventDefault();

            $(this).popover('toggle');

        });

    });


    $('[data-toggle="popover"]').popover();

});