document.addEventListener('DOMContentLoaded', function () {

    var span = document.getElementsByClassName('close-btn')[0];
    var form = document.getElementsByClassName('wpcf7-form')[0];
    var contactButtons = document.querySelectorAll('.contact-button');

    // Ouvrir la modale lorsque l'utilisateur clique sur le bouton

    contactButtons.forEach(function (button) {
        button.addEventListener('click', openContactModal);
    });

    function openContactModal(e) {

        form.reset(); // Réinitialiser tous les champs du formulaire  
        contactModal.classList.remove('fadeOut'); // Supprimer l'animation en fermeture si elle existe  
        e.preventDefault();

        // Lire la valeur de référence à partir de l'attribut de données
        var reference = this.getAttribute('data-reference');
        if (reference) {
            refPhoto.value = reference;
        }
        contactModal.style.display = 'block';

    }

    // Fermer la modale lorsque l'utilisateur clique sur <span> (x)
    span.onclick = function () {

        contactModal.classList.add('fadeOut'); // Animation en fermeture     

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

