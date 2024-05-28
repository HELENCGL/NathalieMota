document.addEventListener('DOMContentLoaded', function () {

    var span = document.getElementsByClassName('close-btn')[0];
    var form = document.getElementsByClassName('wpcf7-form')[0];

    // Ouvrir la modale lorsque l'utilisateur clique sur le bouton
    contactButton.onclick = function (e) {
        // Suppression de l'animation en fermeture si elle existe    
        contactModal.classList.remove('fadeOut');
        e.preventDefault();
        contactModal.style.display = 'block';
        form.reset(); // Réinitialise tous les champs du formulaire
    }

    // Fermer la modale lorsque l'utilisateur clique sur <span> (x)
    span.onclick = function () {
        // Animation en fermeture          
        contactModal.classList.add('fadeOut');

        setTimeout(function () {
            contactModal.style.display = 'none';
        }, 500); // Correspond à la durée de l'animation

    }

    // Fermer la modale lorsque l'utilisateur clique en dehors de celle-ci
    window.onclick = function (event) {
        if (event.target == contactModal) {
            contactModal.classList.add('fadeOut');
            setTimeout(function () {
                contactModal.style.display = 'none';
            }, 500); // Correspond à la durée de l'animation

        }
    }
});

