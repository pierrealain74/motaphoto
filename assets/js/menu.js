const menuToggle = document.getElementById('menuToggle');
const fullscreenMenu = document.querySelector('.menu-fullscreen');


menuToggle.addEventListener('click', () => {


    
     if (menuToggle.classList.contains('active')) { // Pour le burger button

        menuToggle.classList.remove('active');
        menuToggle.classList.add('inactive');
    } else {
        console.log('ajout active')
        menuToggle.classList.remove('inactive');
        menuToggle.classList.add('active');
    }
    fullscreenMenu.classList.toggle('active');// Pour l'ecran menu à 100% 


});

/* const menuLinks = document.querySelectorAll("#menu-fullscreen ul li a");

menuLinks.forEach((link) => {
    link.addEventListener('click', () => {
        menuToggle.classList.remove('active');//Rendre activ le burger button
        menuToggle.classList.add('inactive');
        fullscreenMenu.classList.remove('active');//Cacher l'écran 100%
    });
}); */