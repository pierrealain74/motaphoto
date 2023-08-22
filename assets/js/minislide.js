/** Minislider *********************************** 
 * 
 * Affiche un mini carrousel sous la photo principale figure > img : 
 * le minislider affiche l'image suivante de l'image principale
 * 
 * JS appelé dans infos-img.php
 * _imgInfos.scss
 * 
*/

/*************************************Ouvrir JSON */
// Chemin vers le fichier JSON
const json_File = themeDirectoryUri + '/assets/json/portfolio-data.json';

//Initialiser le tableau des portfolio
var data_portfolio = [];

// Utiliser fetch pour récupérer le contenu du fichier JSON
fetch(json_File)
  .then(response => response.json()) // Décoder le JSON en un objet JavaScript
  .then(data => {
	  
	  data_portfolio = data;
	  
  })
  .catch(error => {
    // Gérer les erreurs éventuelles
    console.error('Erreur lors de la récupération du fichier JSON :', error);
  });



var figureImg = document.querySelector('figure img');// Photo principale
var minisliderImg = document.querySelector('.minislider img');//Photo minislider

var cat; // declare category pour accessible partout


const arrowblackNext = document.querySelector('.arrowblackNext');
const arrowblackPrev = document.querySelector('.arrowblackPrev');
/*  */

arrowblackNext.addEventListener('click', (event) => {

  //Récupere l'index dans le html inscrit en html via php
  let dataindex = parseInt(figureImg.getAttribute('data-index'));
  dataindex++;

  if (dataindex >= data_portfolio.length) {
      dataindex = 0;
  }

  /**Img pricnipale */
  figureImg.setAttribute('data-index', dataindex);
  figureImg.setAttribute('src', data_portfolio[dataindex].thumbnail);

  let minisliderIndex = dataindex + 1; // index suivant pour le minislider

  if (minisliderIndex >= data_portfolio.length) {
      minisliderIndex = 0;
  }
  /**Img minislider */
  minisliderImg.setAttribute('src', data_portfolio[minisliderIndex].thumbnail);

  //Display Title, reference, type, format,...of main photos
  displayImgInfo(dataindex);


 

});

arrowblackPrev.addEventListener('click', (event) => {

  let dataindex = parseInt(figureImg.getAttribute('data-index')); 
  dataindex--; 

  if (dataindex < 0) {

    dataindex = data_portfolio.length - 1;
    
  }

  figureImg.setAttribute('data-index', dataindex); 
  figureImg.setAttribute('src', data_portfolio[dataindex].thumbnail);

  let minisliderIndex = dataindex - 1;

  if (minisliderIndex < 0) {
    minisliderIndex = data_portfolio.length - 1;
  }

  //Affiche ll'image suivante
  minisliderImg.setAttribute('src', data_portfolio[minisliderIndex].thumbnail);

  //Display Title, reference, type, format,...of main photos
  displayImgInfo(dataindex);


  
  //displayLike(dataindex);//affiche les photos dans 'Vous aimerez aussi'

})


function displayImgInfo(dataindex) {

    /**TXT */
    var taxonomyimgInfos = document.querySelector('.taxonomyimgInfos');
    var taxonomyimgInfosTitle = document.querySelector('.titleimgInfos');
  

    /**Datas img : category, reference format,... */
    let titre = data_portfolio[dataindex].post_title;
    var ref = data_portfolio[dataindex].reference;
    cat = data_portfolio[dataindex].category[0].name;
    let tag = data_portfolio[dataindex].tags[0].name;
    let type = data_portfolio[dataindex].type[0];
    taxonomyimgInfosTitle.innerHTML = titre;
  
  taxonomyimgInfos.innerHTML = '<span class="ref">Reference : ' + ref + '</span><br />Catégorie : ' + cat + '<br />Format : ' + tag + '<br />Type : ' + type + '<br />Année : 2021';

  //console.log('cat dans fonc displayInfo : ', cat);


    var url = ajax_object.ajax_url + "?action=get_portfolio_items&category=" + cat;
    urlSort = url;
    //var url = ajax_object.ajax_url.replace('/wp-admin/admin-ajax.php', '/portfolio.php')
    //console.log('url cat :', url) http://motaphoto.local/wp-admin/admin-ajax.php?action=get_portfolio_items&category=T%C3%A9l%C3%A9vision


  fetch(url)//lis le array json dans l'url : http://motaphoto.local/wp-admin/admin-ajax.php?action=get_portfolio_items&category=Mariage
    .then(response => response.json())
    .then(data => {


      var container = document.querySelector(".container");
      container.remove();

      //console.log('gallery dans input select : ', gallery)
      //container.innerHTML = ""; // Efface le contenu existant

      //console.log('json categories dans input select : ', data)

      portfolio(data);

    });



 

  return taxonomyimgInfos.innerHTML;


  
}

//Crée un tableau de data via la catégory de la photo principale
//pour afficher dans la section "vous aimerez aussi" via Portfolio.js
function displayLike(cat) {
  
  var container = document.querySelector(".container");
  
  const dataCategorized = [];//juste declarer le tableau pour l'utiliser apres

  data_portfolio.forEach(item => {

      const categories = item.category;//prendre chaque catégories du json et la comparer avec la cat donnée

    categories.forEach(category => {

      if (category.name === cat) {//si une catégorie match avec la catégorie donnée
  
        dataCategorized.push({

          id_post: item.id_post,
          post_title: item.post_title,
          post_date: item.post_date,
          thumbnail: item.thumbnail,
          category: item.category,
          tags: item.tags,
          type: item.type,
          reference: item.reference

        });


      };
    });
  });
  //console.log('data categorize dans minislide', dataCategorized);
  //return dataCategorized;

  container.remove();
  //portfolio(dataCategorized);
}
