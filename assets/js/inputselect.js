/**
 * Logic AJAX INPUT SELECT
 * 
 * 
 */
document.addEventListener("DOMContentLoaded", function () {
  
  //Recupere le DOM des 3 SELECT
  var categorySelect = document.getElementById("categorySelect");
  var formatSelect = document.getElementById("formatSelect");
  var sortSelect = document.getElementById("sortSelect");

  //console.log('categorySelect dans input select : ', categorySelect)

  //const sectionGallery = document.querySelector('.gallery');  
  //console.log('sectionGallery dans input select : ', sectionGallery)
  
  
  

  /** RAJOUT DES SELECT FORMAT ET SIORT */
 

  

        categorySelect.addEventListener("change", function() {
                    
                var selectedCategory = categorySelect.value;
                var url = ajax_object.ajax_url + "?action=get_portfolio_items&category=" + selectedCategory;
                //var url = ajax_object.ajax_url.replace('/wp-admin/admin-ajax.php', '/portfolio.php')

                console.log(url)

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
  
        formatSelect.addEventListener("change", function() {
         
          var selectedFormat = formatSelect.value;
          console.log('format selectione :', selectedFormat)

          var url = ajax_object.ajax_url + "?action=get_portfolio_items&format=" + selectedFormat;
          console.log('url format :', url)


                fetch(url)//lis le array json dans l'url : http://motaphoto.local/wp-admin/admin-ajax.php?action=get_portfolio_items&category=Mariage
                      .then(response => response.json())
                      .then(data => {
                        
                        console.log('format data :', data)


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
      
        sortSelect.addEventListener("change", function() {
          var selectedSort = sortSelect.value;
          var url = ajax_object.ajax_url + "?action=get_portfolio_items&sort=" + selectedSort;
      
          // ... Votre code de gestion pour le tri
        });
      
});
