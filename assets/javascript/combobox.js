
function showInfo() {
if( document.getElementById('test_one').style.visibility == "hidden")
{
 document.getElementById('test_one').style.visibility = "visible";
}
else
{
 document.getElementById('test_one').style.visibility = "hidden";

}
}
function selectalbum(e) {

   document.getElementById('album_select').value = e.target.innerHTML;

}

function selectalbumcreate(e) {

   document.getElementById('album_select').value = document.getElementById('create').value 

}
    

