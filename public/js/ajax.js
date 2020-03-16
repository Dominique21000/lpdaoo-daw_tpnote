$(function(){
    $("#categorie1-tab").on("click",chargeOnglet1);
    $("#categorie2-tab").on("click",chargeOnglet2);
});


function chargeOnglet1(){
    
    $.ajax({
    type: 'POST',
    url: 'index.php?rub=onglet-1',
    dataType: 'html',
    cache: false,
    success: function(data){
        $('#categorie1').html(data);
        //console.log("succes");
        }
    });
}

function chargeOnglet2(){
    
    $.ajax({
    type: 'POST',
    url: 'index.php?rub=onglet-2',
    dataType: 'html',
    cache: false,
    success: function(data){
        $('#categorie2').html(data);
        //console.log("succes");
        }
    });
}