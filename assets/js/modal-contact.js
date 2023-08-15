// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btContact = document.querySelector(".btContact");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];


const menuwpContact = document.querySelector('.menuwp-contact a');
menuwpContact.addEventListener('click', () => {
    
    //console.log('click');
    modal.style.display = "block";//to display modal contact	
    


});


// When the user clicks the button, open the modal 
if (btContact !== null) {

    btContact.onclick = function () {

        modal.style.display = "block";//to display modal contact	
	
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