$(function(){
    $("#sub-cat1").on("click",chargerCategorie1);
    
});


function chargerCategorie1(){
    var couleur = document.getElementById('couleur').options[document.getElementById('couleur').selectedIndex].value;
    var race = document.getElementById('race').options[document.getElementById('race').selectedIndex].value;
    //alert("couleur : " + couleur + " race : " + race);
    window.location = 'index.php?rub=liste-cochons&couleur='+ couleur+ '&race='+race;
}