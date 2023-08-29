/**
 * 
 * PORTFOLIO JS
 * 
 * template d'affichage des 4 1eres photos
 * 
 * Data sources : 
 * 
 * 1--JSON FILE(tous portfolios) json > portolio-data.json
 * 
 * 2-- Appel de la fonction portfolio(jsonfile)
 * 
 * 
 * 
 * 
 */


// Initialiser le tableau des portfolios
var data_portfolio = [];

//Fetch Json File defaut (tous les portfolios)
const json_File2 = themeDirectoryUri + '/assets/json/portfolio-data.json';
console.log('JSON all portfolio portfolio.js : ', json_File2)
fetch(json_File2)
    .then(response => response.json()) // Décoder le JSON en un objet JavaScript
    .then(data => {


    //     CAT URL ??    // 

    // Obtenir l'URL actuelle
    var currentUrl = window.location.href;

    // Utiliser l'objet URL pour extraire les paramètres de l'URL
    var url = new URL(currentUrl);
    var cat = url.searchParams.get("cat");


    // Si une categorie existe dans l'url alors appeler triater le jsondata par defaut*******************
        
        if (cat !== null) {

            /* console.log("id_post:", id_post); */
            //console.log("categoryNameToSearch:", cat);

    
            portfolioCategorized(cat);



            //produire le data json pour une catégorie donnée
    
            function portfolioCategorized(cat) {


                        const dataCategorized = [];
                
                        data.forEach(item => {
                            const categories = item.category;
                
                            categories.forEach(category => {
                                if (category.name === cat) {

                                    const { thumbnail, thumbnail_mediumlarge, reference, post_title, id_post, tags, category: cat2 } = item;
                
                                    dataCategorized.push({
                                        thumbnail,
                                        thumbnail_mediumlarge,
                                        reference,
                                        post_title,
                                        id_post,
                                        tags,
                                        category: cat2,
                                    });
                                    return; // Sortir de la boucle interne
                                }
                            });
                        });
                        
                
                        portfolio(dataCategorized);
                    
                        //console.log('data caegpories : ', dataCategorized);
            }



    
    } else {//lancer portfolio avec les data par defaut
        
        
        
        data_portfolio = data; // Affecter les données à la variable globale

        

        portfolio(data_portfolio);
        
        //console.log('data portfolio : ', data_portfolio);
        
        //console.log("Data par defaut car les paramètres ne sont pas définis dans l'URL Category, Id_post...");
    }



    })
    .catch(error => {
        // Gérer les erreurs éventuelles
        //console.error('Erreur lors de la récupération du fichier JSON :', error);
    });



function portfolio(data) {


    

    //console.log('dans la function portfolio : ', data);
    const main = document.querySelector('main');
    //console.log(main)

    // Création du contenu HTML
    var startContainerGallery = '<div class="container"><section class="gallery"></section></div>';



    main.insertAdjacentHTML('beforeend', startContainerGallery);   
    
    
    //const container = document.querySelector('.container');
    const sectionGallery = document.querySelector('.gallery');


    

    //console.log('sectiongallery dans portfolio.js : ', sectionGallery)


    const firstFourItems = data.slice(0, 4);

    sectionGallery.innerHTML = "";

    firstFourItems.forEach((item, index) => {

                    const figure = document.createElement('figure');
                    //console.log('dans portfolio.js - figure', figure)

                    // Utilisez la fonction de création de modèle pour générer le contenu de la figure
                    figure.innerHTML = createFigureHTML(item, index);
                    //console.log('dans portfolio.js - figure html : ', figure.innerHTML)

                    // Ajoutez la figure à la galerie
                    sectionGallery.appendChild(figure);
                    //sectionGallery.insertAdjacentHTML('beforeend', figure);   
                   

    });
    
    var loadMoreSection = '<section class="containerLoadMore"><button class="contactImgInfos loadmoreClass" id="btloadMore">Charger +</button></section>';
    sectionGallery.insertAdjacentHTML('afterend', loadMoreSection);




    loadMore(data);//Faire fonctionner le bouton LoadMore

    lightboxDisplay(data);



}// Endof function portfolio(data)


function createFigureHTML(item, i) {


    return `
    <div class="rolloverImg">
            <span class="rolloverImg-category">${item.category[0].name}</span>
            <span class="rolloverImg-reference">${item.tags[0].name}</span>
            <button class="rolloverImg-fullscreen"></button>
            <a href="infos-photo/?postdate=${item.post_date}&id=${item.id_post}&cat=${item.category[0].name}&index=${i}" class="rolloverImg-eye"></a>
    </div>
    <img src="${item.thumbnail_mediumlarge}" class="img-gallery" alt="${item.post_title}" id="${item.id_post}" data-index="${i}" postdate="${item.post_date}">`;

}// Endof function createFigureHTML(item, i)
