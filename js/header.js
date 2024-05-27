
// Positionnement d'un event listener sur l'icone burger
// Au click, on ajoute ou enleve
//  -  la classe header__nav--open ce qui ouvre  le menu burger
//  -  la classe body--no-scroll qui active ou supprime le scrolling du body


icons.addEventListener("click", () => {
    headerNav.classList.toggle("header__nav--open");  
    document.body.classList.toggle('body--no-scroll');
});

// Selection de tous les liens du menus et positionnement d'un event listener qui 
//  -  supprime la classe header__nav--open pour fermer le menu burger
//  -  supprime la classe body--no-scroll pour réactiver le scrolling du body
//
const links = document.querySelectorAll('nav li');
links.forEach((link) => {
    link.addEventListener("click", () => {
        headerNav.classList.remove("header__nav--open");
        document.body.classList.remove('body--no-scroll');
    });
});


