//  variable tableau pour stocker les photo
 var images=[];
     images[0]="images/img_acceuil/acc1.png";
     images[1]="images/img_acceuil/acc6.jpg";
     images[2]="images/img_acceuil/acc3.jpeg";
     images[3]="images/img_acceuil/acc3.jpg";

//  initialiser variable i
var i=0;

// variable de temps de transition
var timer=3000;

// fonction pour changer les photos
 function changeimages(){
     document.getElementById('section1').style.backgroundImage="url("+images[i]+")";
         if(i<3){
             i++;
         }else{
            i=0;
          }
             setTimeout("changeimages()", timer);
 }
 window.onload=changeimages;

//  fonction pour envoyer une alert pour les pages d'activités
document.getElementById('alert').addEventListener('click', function() {
    alert("Info covid 19!  A cause de la nouvelle situation on vous informons que notre site prend pas de resérvation pour le moment , vous pouvez nous contactez pour plus d'information");
  });

/* Jquery Code */ 
$(document).ready(function() {
    $(".ligne").click(function() {
       $('.links').slideToggle();
    });
    $(window).resize(function() {
       if ($(window).width() > 768) {
          $('.links').show();
       } else {
          $('.links').hide();
       }
    });
});