/**
 * Logic AJAX
 * 
 * 
 */
document.addEventListener("DOMContentLoaded", function () {
  

  var categorySelect = document.getElementById("categorySelect");
  var gallery = document.querySelector(".gallery");



  categorySelect.addEventListener("change", function() {
   
    var selectedCategory = categorySelect.value;
    var url = ajax_object.ajax_url + "?action=get_portfolio_items&category=" + selectedCategory;
    //var url = ajax_object.ajax_url.replace('/wp-admin/admin-ajax.php', '/portfolio.php')

    console.log(url)

    fetch(url)//lis le array json dans l'url : http://motaphoto.local/wp-admin/admin-ajax.php?action=get_portfolio_items&category=Mariage
          .then(response => response.json())
          .then(data => {
            
           
            gallery.innerHTML = ""; // Efface le contenu existant du portoflio en php            */
            const firstFourItems = data.slice(0, 4);

            firstFourItems.forEach((item, index) => {

                    const figure = document.createElement('figure');
                    //console.log(figure)

                    // Utilisez la fonction de création de modèle pour générer le contenu de la figure
                    figure.innerHTML = createFigureHTML(item, index);

                    //console.log(figure.innerHTML)

                    // Ajoutez la figure à la galerie
                    gallery.appendChild(figure);
          });


          })
          .catch(error => {
              console.error("Une erreur s'est produite lors de la requête AJAX :", error);
          });
    
  }); 
});


/* Charger le script pour bouton charger + */
/* var scriptElement = document.createElement('script'); */

// Définir l'attribut src du script en utilisant PHP pour obtenir le chemin complet
/* scriptElement.src = themeDirectoryUri + '/assets/js/loadMore.js'; */

// Ajouter l'élément script au <head> de la page
/* document.head.appendChild(scriptElement); */

