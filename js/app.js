//====================================== ACCORDION FAQ=============================================
var accordions = document.getElementsByClassName("accordion");
var panels = document.getElementsByClassName("panel");
  
for (var i = 0; i < accordions.length; i++) {
  accordions[i].addEventListener("click", function() {
    var currentPanel = this.nextElementSibling;
      

    for (var j = 0; j < panels.length; j++) {
      if (panels[j] !== currentPanel) {
        panels[j].style.maxHeight = null;
        accordions[j].classList.remove("active");
      }
    }
  
    this.classList.toggle("active");
  
    if (currentPanel.style.maxHeight) {
      currentPanel.style.maxHeight = null;
    } else {
      currentPanel.style.maxHeight = currentPanel.scrollHeight + "px";
    }
  });
}

//====================================== AJAX POPUP============================================= 
document.getElementById("logout-button").addEventListener("click", function() {
  document.getElementById("logout-button").style.display = "none";

  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {

      document.getElementById("logout-popup").innerHTML = xhr.responseText;


      document.getElementById("logout-popup").style.display = "block";
    }
  };
  xhr.open("GET", "../popup/popup_logout.php", true); // Caminho atualizado
  xhr.send();
});

document.getElementById("logout-popup").addEventListener("click", function(event) {
  if (event.target.id === "confirm-logout") {

    document.getElementById("logout-form").submit();
  } else if (event.target.id === "cancel-logout") {

    document.getElementById("logout-popup").style.display = "none";
    
    document.getElementById("logout-button").style.display = "block";
  }
  
});

//====================================== ACCORDION DEPARTMENTS=============================================
function initAccordion() {
  var accordionHeaders = document.querySelectorAll('.accordion-header');

  accordionHeaders.forEach(function(header) {
    header.addEventListener('click', function() {

      this.classList.toggle('active');
      var accordionContent = this.nextElementSibling;
      if (accordionContent.style.display === 'block') {
        accordionContent.style.display = 'none';
      } else {
        accordionContent.style.display = 'block';
      }
    });
  });
}

document.addEventListener('DOMContentLoaded', function() {
  initAccordion();
});
