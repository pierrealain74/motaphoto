/* LightBOX JS */
/* const imgGallery = document.querySelectorAll('.img-gallery') */

const lightboxInfos = document.querySelector('.lightboxInfos');
const btFullscreen = document.querySelector('.rolloverImg-fullscreenInfos');
const btClose = document.querySelector('.lightbox__close');
const imgLightboxInfos = document.querySelector('.imgLightboxInfos');



//Click sur icon fullscreen pour ouvrir l'image dans lightbox

btFullscreen.addEventListener('click', () => {


		//Get l'url de l'image cliquée
		let imgSrcElement = document.querySelector('.imageInfos').getAttribute('src');
	
		console.log('image source dans lightboxInfos: ', imgSrcElement);
		//console.log('imgLightboxInfos : ', imgLightboxInfos);
	







	

		//Afficher l'image cliquée dans lightbox **********************************/
        imgLightboxInfos.setAttribute('src', imgSrcElement);
    
		
		//Afficher la lightbox
		lightboxInfos.classList.add('show');


	})



btClose.addEventListener('click', () => {
    lightboxInfos.classList.remove('show');
})