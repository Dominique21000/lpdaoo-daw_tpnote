$(function(){
    $("#categorie1-tab").on("click",chargerOnglet1);
    $("#categorie2-tab").on("click",chargerOnglet2);
});


function chargerOnglet1(){
    $.ajax({
    type: 'POST',
    url: 'index.php?rub=onglet-1',
    dataType: 'html',
    cache: false,
    success: function(data){
        $('#categorie1').html(data);
        }
    });
}

function chargerOnglet2(){
    $.ajax({
    type: 'POST',
    url: 'index.php?rub=onglet-2',
    dataType: 'html',
    cache: false,
    success: function(data){
        $('#categorie2').html(data);
        }
    });
}