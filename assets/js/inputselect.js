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
  var urlSort = '';
  //console.log('categorySelect dans input select : ', categorySelect)

  //const sectionGallery = document.querySelector('.gallery');  
  //console.log('sectionGallery dans input select : ', sectionGallery)
  
  
  

  /** AJOUT DES SELECT FORMAT ET SORT */
 

  

        categorySelect.addEventListener("change", function() {
                    
                var selectedCategory = categorySelect.value;
                var url = ajax_object.ajax_url + "?action=get_portfolio_items&category=" + selectedCategory;
                urlSort = url;
                //var url = ajax_object.ajax_url.replace('/wp-admin/admin-ajax.php', '/portfolio.php')
                //console.log('url cat :', url)// http://motaphoto.local/wp-admin/admin-ajax.php?action=get_portfolio_items&category=T%C3%A9l%C3%A9vision
                

                fetch(url)//lis le array json dans l'url : http://motaphoto.local/wp-admin/admin-ajax.php?action=get_portfolio_items&category=Mariage
                      .then(response => response.json())
                      .then(data => {
                        

                        console.log('category data :', data)
                        

                        var container = document.querySelector(".container");
                        container.remove();
                        
                        //console.log('gallery dans input select : ', gallery)
                        //container.innerHTML = ""; // Efface le contenu existant
                        
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
          urlSort = url;
          //console.log('url format :', url) http://motaphoto.local/wp-admin/admin-ajax.php?action=get_portfolio_items&format=portrait


                fetch(url)//lis le array json dans l'url : http://motaphoto.local/wp-admin/admin-ajax.php?action=get_portfolio_items&category=Mariage
                      .then(response => response.json())
                      .then(data => {
                        
                        console.log('format data :', data)


                        var container = document.querySelector(".container");
                        //console.log('gallery dans input select : ', gallery)
                        container.remove();
                        
                        //console.log('json categories dans input select : ', data)

                        portfolio(data);

                            
                            
                        /* localStorage.setItem('data', JSON.stringify(data)); */

                      })
                      .catch(error => {
                          console.error("Une erreur s'est produite lors de la requête AJAX :", error);
                      });

        });
      
        sortSelect.addEventListener("change", function () {
                
                      var selectedSort = sortSelect.value;//Récupere la valeur : Ancien ou Récent
                      //console.log('sort selectionne : ', selectedSort)
                      var url = '';
                    
          
                      if (urlSort == '') {
                                                
                        url = themeDirectoryUri + '/assets/json/portfolio-data.json';

                      } else url = urlSort; 
                      //console.log('url sort :', url)

          
                fetch(url)            
                .then(response => response.json())
                .then(data => {
                              
                  console.log('sort data :', data);
                  
                  if (selectedSort == 'recent') {//sort du plus Recent au plus Ancien les index_date

                    
                    data.sort(function(a, b) {
                      var dateA = new Date(a.post_date);
                      var dateB = new Date(b.post_date);
                      return dateB - dateA;
                    });



                  } else if (selectedSort == 'ancien') {//sort du plus Ancien au plus Recent les index_date


                    data.sort(function(a, b) {
                      var dateA = new Date(a.post_date);
                      var dateB = new Date(b.post_date);
                      return dateA - dateB;
                    });


                    /* data.sort((a, b) => b.post_date - a.post_date); */



                  }

                  var container = document.querySelector(".container");
                  //console.log('gallery dans input select : ', gallery)
                  container.remove();

                  //console.log('json categories dans input select : ', data



                  
                  portfolio(data);



                  /* localStorage.setItem('data', JSON.stringify(data));*/

                  })
                  .catch(error => {
                      console.error("Une erreur s'est produite lors de la requête AJAX :", error);
                  });
        
        
        });
      
});//EnfOf : document.addEventListener("DOMContentLoaded"
