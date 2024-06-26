
document.addEventListener('DOMContentLoaded', function () {

    const mediaQuery = window.matchMedia('(max-width: 782px)');

    // Fonction d'ajustement de la hauteur de la div Photo
    function adjustElementHeight() {
        if (!mediaQuery.matches) {
            const viewportHeight = window.innerHeight;
            const divPhotoTop = divPhoto.getBoundingClientRect().top;
            const availableHeight = viewportHeight - divPhotoTop;
            const imgHeight = availableHeight - 118;

            divPhoto.style.height = availableHeight + 'px';
            divPhotoImg.style.height = imgHeight + 'px';
        }
    }

    // Ajuster la hauteur de la div Photo au chargement de la page
    adjustElementHeight();


    // Réajuster la hauteur de la div Photo lors du redimensionnement de la fenêtre
    window.addEventListener('resize', adjustElementHeight);

    
})