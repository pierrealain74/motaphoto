/**
 * 
 * PORTFOLIO JS
 * 
 * template d'affichage des 4 1eres photos
 * 
 * Data sources : 
 * 
 * 1--J SON FILE(tous portfolios) json > portolio-data.json
 * 
 * 2-- Appel de la fonction portfolio(jsonfile)
 * 
 * 
 * 
 * 
 */


// Initialiser le tableau des portfolio
var data_portfolio = [];

//Fetch Json File defaut (tous les portfolios)
const json_File = themeDirectoryUri + '/assets/json/portfolio-data.json';
fetch(json_File)
    .then(response => response.json()) // Décoder le JSON en un objet JavaScript
    .then(data => {






        
        data_portfolio = data; // Affecter les données à la variable globale
        portfolio(data_portfolio);







    })
    .catch(error => {
        // Gérer les erreurs éventuelles
        console.error('Erreur lors de la récupération du fichier JSON :', error);
    });


function portfolio(data) {
    
    //console.log('dans la function portfolio : ', data);



    const main = document.querySelector('main');
    console.log(main)
    // Création du contenu HTML
    var startContainerGallery = '<div class="container"><section class="gallery"></section></div><section class="containerLoadMore"><button class="contactImgInfos loadmoreClass" id="btloadMore">Charger +</button></section>';
    main.insertAdjacentHTML('beforeend', startContainerGallery);   
    const sectionGallery = document.querySelector('.gallery');




    const firstFourItems = data.slice(0, 4);

    firstFourItems.forEach((item, index) => {

                    const figure = document.createElement('figure');
                    //console.log(figure)

                    // Utilisez la fonction de création de modèle pour générer le contenu de la figure
                    figure.innerHTML = createFigureHTML(item, index);

                    //console.log(figure.innerHTML)

                    // Ajoutez la figure à la galerie
                    sectionGallery.appendChild(figure);
                   

    });

    loadMore(data);//Faire fonctionner le bouton LoadMore



}// Endof function portfolio(data)


function createFigureHTML(item, i) {


    return `
    <div class="rolloverImg">
            <span class="rolloverImg-category">${item.category[0].name}</span>
            <span class="rolloverImg-reference">${item.tags[0].name}</span>
            <button class="rolloverImg-fullscreen"></button>
            <a href="infos-photo/?id=${item.id_post}&cat=${item.category[0].name}&index=0" class="rolloverImg-eye"></a>
    </div>
    <img src="${item.thumbnail}" class="img-gallery" alt="${item.post_title}" id="${item.id_post}" data-index="${i}">`;

}// Endof function createFigureHTML(item, i)
