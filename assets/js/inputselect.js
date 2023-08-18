/**
 * Logic AJAX INPUT SELECT
 * 
 * 
 */
document.addEventListener("DOMContentLoaded", function () {
  

  var categorySelect = document.getElementById("categorySelect");
  //console.log('categorySelect dans input select : ', categorySelect)

  //const sectionGallery = document.querySelector('.gallery');  
  //console.log('sectionGallery dans input select : ', sectionGallery)
  

        categorySelect.addEventListener("change", function() {
                    
                var selectedCategory = categorySelect.value;
                var url = ajax_object.ajax_url + "?action=get_portfolio_items&category=" + selectedCategory;
                //var url = ajax_object.ajax_url.replace('/wp-admin/admin-ajax.php', '/portfolio.php')

                //console.log(url)

                fetch(url)//lis le array json dans l'url : http://motaphoto.local/wp-admin/admin-ajax.php?action=get_portfolio_items&category=Mariage
                      .then(response => response.json())
                      .then(data => {
                        

                        var container = document.querySelector(".container");
                        //console.log('gallery dans input select : ', gallery)
                        container.innerHTML = ""; // Efface le contenu existant
                        
                        //console.log('json categories dans input select : ', data)

                        portfolio(data);

                            
                            
                        /* localStorage.setItem('data', JSON.stringify(data)); */

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

