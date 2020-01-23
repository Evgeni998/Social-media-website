// create references to the modal...
var modal = document.getElementById('myModal');
// to all images -- I am using a class(very important damn it)!
var images = document.getElementsByClassName('img-upload');
// the image in the modal
var modalImg = document.getElementById("img01");
// and the caption in the modal(in case i need to have a caption under the image)
var captionText = document.getElementById("caption");

// Go through all of the images in the  class
for (var i = 0; i < images.length; i++) {
  var img = images[i];
  // and attach the click listener for this image.
  img.onclick = function(evt) {
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
  }
}
//make the modal dissapear when you click on it
window.onclick = function(event) {
  if (event.target == modal) {
      modal.style.display = "none";
  }
}


var span = document.getElementsByClassName("close")[0];
span.onclick = function() {
  modal.style.display = "none";
}
/*
var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById("myImg");
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
  img.onclick = function(){
  modal.style.display = "block";
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
  modal.style.display = "none";
}


// ---------------------------------------------------------------------------------------------TEST
<script>
     var modal = document.getElementById("myModal");
                // Get the image and insert it inside the modal - use its "alt" text as a caption
                var img = document.querySelector("#myImg");
                var modalImg = document.getElementById("img01");
                var rootElement = document.querySelector('#img-div')
                rootElement.addEventListener('click', clickHandler, true);
                function clickHandler() {
                    let targetElement = event.taget;
                    let selector = img;
                    modal.style.display = "block";
                    modalImg.src = this.src;
                    captionText.innerHTML = this.alt;
                }

                // Get the <span> element that closes the modal
                var span = document.getElementsByClassName("close")[0];

                // When the user clicks on <span> (x), close the modal
                span.onclick = function() { 
                modal.style.display = "none";
                }
----------------------------------------------------------------------------------------------------------------------
                var modal = document.getElementById("myModal");
var rootElement = document.querySelector("#img-div");
// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById('myImg');
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");

function addLiveEventListeners(selector, event, handler){  
    rootElement.addEventListener('click',function(evt) {
    var target = evt.target;
    while (target != null){
        var isMatch = target.matches(selector);
        if (isMatch){
            handler(evt);
            return;
        }
        target = target.parentElement;
   
    }
    }, true
    );
}
addLiveEventListeners("#img-div", "click", function(evt){ console.log(evt); });
*/