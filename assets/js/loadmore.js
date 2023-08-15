// loadMore.js
document.addEventListener("DOMContentLoaded", function() {

    var startIndex = 4;
    var itemsPerPage = 4;
    var gallery = document.querySelector(".gallery");
    var loadMoreButton = document.getElementById("btloadMore");

    loadMoreButton.addEventListener("click", function() {


        for (var i = startIndex; i < startIndex + itemsPerPage; i++) {

            var itemLength = item.length; // Obtenir la longueur du tableau

            if (i < itemLength) {

                //console.log(item[i])
                const figure = document.createElement('figure');
            
                //Utiliser fonction de creation de template
                //la fonction createFigureHTML est dans /js/portfolio.js
                figure.innerHTML = createFigureHTML(item[i]);

                gallery.appendChild(figure);
                    
            }
        }

        startIndex += itemsPerPage;

        //End of array : hide button Load More
        if(startIndex >= itemLength){

            loadMoreButton.style.display = "none"; // Cacher le bouton fin de array

        }
    });
});
