document.addEventListener('DOMContentLoaded', function () {
    var heroElement = document.querySelector('.hero');

    // URL de l'image définie dynamiquement via une variable PHP
    var randomImageUrl = heroElement.getAttribute('data-background-image');
    heroElement.style.backgroundImage = 'url(' + randomImageUrl + ')';


});