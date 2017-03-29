/**
 * Created by carlo on 26/03/2017.
 */
window.onscroll = function() {scroll()};
function scroll() {
    var navbar = document.getElementById("navegacion");
    try{
        if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
            navbar.className = "w3-bar" + " w3-card-4" + " w3-white";
        } else {
            navbar.className = navbar.className.replace(" w3-card-4 w3-white", "");
        }
    }catch (error){}
}
function toggleFunction() {
    var x = document.getElementById("menor");
    if (x.className.indexOf("w3-show") === -1) {
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", "");
    }
}
