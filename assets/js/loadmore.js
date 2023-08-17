/* 
document.addEventListener("DOMContentLoaded", function () {

    /*  var item = JSON.parse(localStorage.getItem('data')); */
         
    /* if (typeof dataSelect !== 'undefined' && dataSelect !== null && Object.keys(dataSelect).length > 0) {
        console.log(' variable json dataSelect ok : ', dataSelect)
    } else {
        console.log(' variable json dataSelect VIDE : ', dataSelect)
    }
     */
    //var data = item;
    //Afficher les 4 premiers images////////////////////////////////

    //gallery.innerHTML = ""; // Efface le contenu existant du portoflio en php*/
            
      //const firstFourItems = data.slice(0, 4);
    
/*} */
function loadMore(data) {

    //console.log('startIndex : ', startIndex)
    //console.log('data : ', data)
    var startIndex = 4;
    var itemsPerPage = 4;
    var gallery = document.querySelector(".gallery");
    var loadMoreButton = document.getElementById("btloadMore");

            loadMoreButton.addEventListener("click", function () {


                            for (var i = startIndex; i < startIndex + itemsPerPage; i++) {// i=4, i < 4 + 4, i+1

                                var itemLength = data.length; // Obtenir la longueur du tableau

                                if (i < itemLength) {

                                    //console.log(item[i])
                                    const figure = document.createElement('figure');
                                
                                    figure.innerHTML = createFigureHTML(data[i], i);// la fonction template juste en bas

                                    gallery.appendChild(figure);
                                        
                                }
                            }

                            startIndex += itemsPerPage;

                            //End of array : hide button Load More
                            if(startIndex >= itemLength){

                                loadMoreButton.style.display = "none"; // Cacher le bouton fin de array
                                startIndex = 0;

                            }

                            //attachLightboxEvents();

            });

}//Endof function loadMore(data)

/* function createFigureHTML(item, i) {
    return `
    <div class="rolloverImg">
            <span class="rolloverImg-category">${item.category[0].name}</span>
            <span class="rolloverImg-reference">${item.tags[0].name}</span>
            <button class="rolloverImg-fullscreen"></button>
            <a href="infos-photo/?id=${item.id_post}&cat=${item.category[0].name}&index=0" class="rolloverImg-eye"></a>
    </div>
    <img src="${item.thumbnail}" class="img-gallery" alt="${item.post_title}" id="${item.id_post}" data-index="${i}">`;
}
 */
