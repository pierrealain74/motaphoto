/* LightBOX JS */
/* const imgGallery = document.querySelectorAll('.img-gallery') */

const lightbox = document.querySelector('.lightbox');
const btFullscreen = document.querySelector('.btFullScreen');
const btClose = document.querySelector('.lightbox__close');
const lightboxContainer = document.querySelector('.lightbox-container');

//Click sur icon fullscreen pour ouvrir l'image dans lightbox

btFullscreen.addEventListener('click', () => {

		//Get l'url de l'image cliquée
		const imgSrcElement = document.querySelector('.imgSrc').getAttribute('src');
		//console.log('image source: ', imgSrcElement);


		//Afficher l'image cliquée dans lightbox **********************************/
        document.querySelector('.imgLightboxContainer').setAttribute('src', imgSrcElement);
    
		
		//Afficher la lightbox
		lightbox.classList.add('show');


	})



btClose.addEventListener('click', () => {
    lightbox.classList.remove('show');
})