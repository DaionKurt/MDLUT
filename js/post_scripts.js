/**
 * Created by carlo on 26/03/2017.
 */
$('a[href*="#"]:not([href="#"])').click(function() {
    if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && location.hostname === this.hostname) {
        var target = $(this.hash);
        target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
        if (target.length) {
            $('html, body').animate({
                scrollTop: target.offset().top
            }, 650);
            return false;
        }
    }
});

function abrir_panel() {

    document.getElementById("panel_lateral").style.display = "block";
    document.getElementById("contenido").style.display = "block";
}
function cerrar_panel() {
    document.getElementById("panel_lateral").style.display = "none";
    document.getElementById("contenido").style.display = "none";
}
function cambia_panel(event,identificador) {
    var x,enlaces;
    x = document.getElementsByClassName("contenedor");
    for(var i=0,j=x.length;i<j;i++){
        x[i].style.display = "none";
    }
    enlaces = document.getElementsByClassName("enlace");
    for(i=0,j=x.length;i<j;i++){
        enlaces[i].className = enlaces[i].className.replace(" w3-border-red","");
    }
    document.getElementById(identificador).style.display = "block";
    event.currentTarget.firstElementChild.className+=" w3-border-red";
}

var elemento;
function carga() {
    elemento = setTimeout(muestra_contenido, 1000);
}
function muestra_contenido() {
    document.getElementById("loader").style.display = "none";
    document.getElementById("contenido_web").style.display = "block";
}
function buscar(busqueda,tabla){
    var input, filter, table, tr, td, i;
    input = document.getElementById(busqueda);
    filter = input.value.toUpperCase();
    table = document.getElementById(tabla);
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
            if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}