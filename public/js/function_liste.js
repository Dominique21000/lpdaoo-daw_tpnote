function Afficher(page){
    var sexe = document.getElementById('sexe').options[document.getElementById('sexe').selectedIndex].value;
    var ordre = document.getElementById('ordre').options[document.getElementById('ordre').selectedIndex].value;
    var sens = document.getElementById('sens').options[document.getElementById('sens').selectedIndex].value;
    var nb_epp = document.getElementById('nb_epp').options[document.getElementById('nb_epp').selectedIndex].value;
    //console.log("nb elements : " + nb_elements);
    window.location = 'index.php?rub=admin_pig-list&sexe='+ sexe+ '&ordre='+ordre+'&sens='+sens+'&nb_epp='+nb_epp+'&page='+page;
}

