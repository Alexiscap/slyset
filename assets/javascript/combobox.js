function showInfo() {
if( document.getElementById('list_albums').style.visibility == "visible")
{
 document.getElementById('list_albums').style.visibility = "hidden";
}
else
{
 document.getElementById('list_albums').style.visibility = "visible";

}
}
function selectalbum(e) {

   document.getElementById('album_select').value = e.target.innerHTML;

}

function selectalbumcreate(e) {

   document.getElementById('album_select').value = document.getElementById('create').value 

}
    

