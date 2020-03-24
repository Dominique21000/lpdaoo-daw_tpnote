function traiterFormulaireContact(){
    //var themes = document.getElementById('themes').options[document.getElementById('themes').selectedIndex].value;
    //console.log("themes : " + themes);
    var themes = [];
    var str = "";
    var theme_total = "";
 
	$("#themes option:selected").each(function(i, item){
		str = $(item).val();
        //theme_total += str + " |  " ;
        themes.push(str);
	});
 
    var msg = document.getElementById("message").value.replace("\n","\r\n"); 
    //alert(document.getElementById("message").value);
    //alert(themes.join("\n"));
    window.location.href = "mailto:dominique21000@gmail.com?subject="+themes+"&body="+msg;
    
    

}