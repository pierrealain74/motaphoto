/**
 * 
 * 
 * LightBOX JS 
 *
 * 
 *  
 */ 
////Click sur icon fullscreen pour ouvrir l'image dans lightbox

function lightboxDisplay(data) {


    const imgGallery = document.querySelectorAll('.img-gallery')
    const btClose = document.querySelectorAll('.lightbox__close');
    const lightboxContainer = document.querySelector('.lightbox-container');
    const lightboxCategory = document.querySelector('.lightbox-category');
    const lightboxReference = document.querySelector('.lightbox-reference');
    const imgLightbox = document.getElementById('imgLightboxContainer');
    const arrowLeft = document.querySelector('.lightbox__prev');
    const arrowRight = document.querySelector('.lightbox__next');
    const lightbox = document.querySelector('.lightbox');    
    const btFullscreen = document.querySelectorAll('.rolloverImg-fullscreen');
        

    /* const imgGallery = document.querySelectorAll('.img-gallery') */
    /* console.log('dans le lightbox data : ', data); */

    //Click sur Bouton Close
    btClose.forEach(function (element) {

        element.addEventListener('click', () => {
            lightbox.classList.remove('show');
        })

    });

    
    // Fonction pour trouver le thumbnail à partir de l'id_post
    function findThumbnailById(id) {

        const element = data.find(item => item.id_post === id);

        return element ? element.thumbnail : null;

    }
    //Varible pour stocker l'id de l'image en cours	
    let imgId
    //Varible pour stocker l'index de l'image courante	
    let currentImageIndex

    // Fonction pour afficher l'image précédente dans la lightbox
    function showPrevImage() {
        currentImageIndex--;
        if (currentImageIndex < 0) {
            currentImageIndex = data.length - 1;
        }
        imgLightbox.src = data[currentImageIndex].thumbnail;
        lightboxCategory.innerText = data[currentImageIndex].category[0].name;
        lightboxReference.innerText = data[currentImageIndex].reference[0];

    }
    
    // Fonction pour afficher l'image précédente dans la lightbox
    function showNextImage() {
        currentImageIndex++;
        if (currentImageIndex === data.length) {
            currentImageIndex = 0;
        }
        imgLightbox.src = data[currentImageIndex].thumbnail;
        lightboxCategory.innerText = data[currentImageIndex].category[0].name;
        lightboxReference.innerText = data[currentImageIndex].reference[0];
    }


    //Click sur la fleche de gauche
    arrowLeft.addEventListener('click', showPrevImage);

    //Click sur la fleche de droite
    arrowRight.addEventListener('click', showNextImage);

    
    btFullscreen.forEach(function (element) {

        //console.log(btFullscreen);

        element.addEventListener('click', (event) => {


            //console.log('dans le lightbox click fullscreen data : ', data);

            //Get l'url de l'image cliquée
            const imgElement = element.closest('figure').querySelector('.img-gallery');

            //console.log('imgElement : ', imgElement);


            //console.log(imgElement.src);
            currentImageIndex = imgElement.getAttribute('data-index');
            //console.log(currentImageIndex)

            //Afficher l'image cliquée dans lightbox **********************************/
            imgLightbox.src = data[currentImageIndex].thumbnail;// Prendre la phot fullsize
        
            //Afficher la lightbox
            lightbox.classList.add('show');


            //Affcher les categories et ref de l'image cliquée
            //const category = data_portfolio[currentImageIndex].category[0].name;
            //const ref = data_portfolio[currentImageIndex].reference[0];
            //console.log(category);
            lightboxCategory.innerText = data[currentImageIndex].category[0].name;
            lightboxReference.innerText = data[currentImageIndex].reference[0];

            //console.log(imgElement);


        })
    });
    }
