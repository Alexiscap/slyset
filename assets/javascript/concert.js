function showInfo(lien, divid) {
    var div = document.getElementById(divid);
    
    if(divid.style.display=='none') { 
        divid.style.display = 'block'; 
        lien.innerHTML = "Cacher les informations"; 
    } else { 
        divid.style.display = 'none'; 
        lien.innerHTML = "Voir plus d'informations";
    }
}