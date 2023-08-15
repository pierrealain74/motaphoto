/**
 * AJAX Button Select Category, Format, Sort Date
 * 
 * 
 */
document.addEventListener("DOMContentLoaded", function() {
  var categorySelect = document.getElementById("categorySelect");
  var gallery = document.querySelector(".gallery");
  //var btloadMore = document.getElementById("btloadMore");
  //btloadMore.style.display = 'none';

  categorySelect.addEventListener("change", function() {
    
    var selectedCategory = categorySelect.value;
    var url = ajax_object.ajax_url + "?action=get_portfolio_items&category=" + selectedCategory;
    
    console.log(url)

      fetch(url)
          .then(response => response.json())
          .then(data => {
            gallery.innerHTML = ""; // Efface le contenu existant

            data.forEach(item => {
                
                    //Template Portfolio.js

                    //console.log(item[i])
                    const figure = document.createElement('figure');

                    //Utiliser fonction de creation de template
                    //la fonction createFigureHTML est dans /js/portfolio.js
                    figure.innerHTML = createFigureHTML(item);

                    gallery.appendChild(figure);

              });
          })
          .catch(error => {
              console.error("Une erreur s'est produite lors de la requête AJAX :", error);
          });
  }); 
});


/* Charger le script pour bouton charger + */
var scriptElement = document.createElement('script');

// Définir l'attribut src du script en utilisant PHP pour obtenir le chemin complet
scriptElement.src = themeDirectoryUri + '/assets/js/loadMore.js';

// Ajouter l'élément script au <head> de la page
document.head.appendChild(scriptElement);




