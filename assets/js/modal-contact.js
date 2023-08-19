/**DOM ************************************************************************/

// Get the modal
const modal = document.getElementById('myModal');

// Get the <span> element that closes the modal
const span = document.getElementsByClassName("close")[0];

//Get "Contact" boutons menu or menu responsive
const btContact = document.querySelector(".btContact");
const menuwpContact = document.querySelector('.menuwp-contact a'); // Bouton contact dans le menu header
const menuwpContactResponsive = document.querySelector('.menu-fullscreen .menuwp-contact a');





/**LOGIC **********************************************************************/

// Fonction d'ouverture de modal contact commune des 2 boutons
const openContactModal = () => {
    modal.style.display = "block"; // Afficher le modal de contact
    console.log('menu header contact cliqué : ', modal);
};

// Ajouter l'événement aux deux sélecteurs
menuwpContact.addEventListener('click', openContactModal);
menuwpContactResponsive.addEventListener('click', openContactModal);



// Ouverture modal contcat sur le bouton contact à coté du mini-slider (page infos-img.php)
if (btContact !== null) {

    btContact.onclick = function () {

        modal.style.display = "block";//to display modal contact

        //console.log('menu header contact cliké : ', modal)
	
        let ref = document.querySelector('.ref').textContent;//get the actual REF displayed in html page
        ref = ref.replace("Reference : ", "");//Trunck "reference : bf001" for "bf001"
        document.querySelector('.cf7ref').value = ref;//display REF in the wpform7 contact form REF input field

    }
}   

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}