/* vérification    */
identifiant = document.getElementById("identifiant");
identifiant.addEventListener("onClick", verfirMdp);

function verfirMdp() {
    alert();
}

function Afficher(){
    var sexe = document.getElementById('sexe').options[document.getElementById('sexe').selectedIndex].value;
    var ordre = document.getElementById('ordre').options[document.getElementById('ordre').selectedIndex].value;
    var sens = document.getElementById('sens').options[document.getElementById('sens').selectedIndex].value;
    var nb_elements = document.getElementById('nb-elements').options[document.getElementById('nb-elements').selectedIndex].value;
    //console.log("nb elements : " + nb_elements);
    window.location = 'index.php?rub=admin_pig-list&sexe='+ sexe+ '&ordre='+ordre+'&sens='+sens+'&nb_elements='+nb_elements;
}