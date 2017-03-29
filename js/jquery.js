/**
 * Created by carlo on 20/03/2017.
 */

/**
 * * jquery en lugar de $ ...*/
var jquery = $.noConflict();
jquery(document).ready(function () {
    jquery("#ocultar").click(function () {
        jquery("p:first").hide();
    });
    jquery("#mostrar").click(function () {
        jquery("p").show();
    });
    jquery("p.doble").dblclick(function () {
        jquery(this).hide();
    });
    jquery("p#mouse").mouseenter(function () {
       console.log("Has ingresado al espacio del párrafo");
    });
    jquery("p#mouse").mouseleave(function () {
       console.log("Has abandonado el espacio del párrafo");
    });
    jquery("p.hover").hover(function () {
        console.log(("Estás en hover sobre el elemento"))
    },function () {
        console.log("Te fuiste del hover");
    })
    jquery("input#prueba").focus(function () {
        jquery(this).css("background-color","#cccccc");
    });
    jquery("input#prueba").blur(function () {
        jquery(this).css("background-color","#b8d8d5");
    });;
    jquery("p#parrafo").on({
        mouseenter: function () {
            jquery(this).css("background-color","lightgray");
        },
        mouseleave: function () {
            jquery(this).css("background-color","lightblue");
        },
        click: function () {
            jquery(this).css("background-color","yellow");
        }
    });
    jquery("p#hide_temp").on({
        click: function () {
            jquery(this).hide(1000);
        }
    });
    jquery("button#toggle").on({
       click: function () {
           jquery("p#p_toggle").toggle();
       }
    });
    /*
    fadeIn()
    fadeOut()
    fadeToggle()
    fadeTo(velocidad,opacidad) -> fadeTo("slow",0.3)
    * */
    jquery("button#fade").click(function(){
        jquery("#div1").fadeToggle();
        jquery("#div2").fadeToggle("slow");
        jquery("#div3").fadeToggle(3000);
    });
    /*
     slideDown()
     slideUp()
     slideToggle()
     * */
    jquery("#flip").click(function () {
        jquery("#panel").slideToggle("slow");
    });
    jquery("button#animate").click(function () {
        jquery("div#anima").animate({
            left:'250px',
            opacity: '0.5',
            height: 'toggle',
            width: '+=200px'
        },"slow");
    });
    jquery("button#animate_1").click(function () {
        var div = jquery("div#anima_1");
        div.animate({height:'300px',opacity:'0.4'},"slow");
        div.animate({width:'300px',opacity:'0.8'},"slow");
        div.animate({height:'100px',opacity:'0.4'},"slow");
        div.animate({width:'100px',opacity:'1.0'},"slow");
        div.animate({fontSize: '2em'},"slow");
        div.animate({fontSize: '1em'},"slow");
    });
    jquery("#p1").css("color","red").css("background-color","yellow")
        .slideUp(2000).slideDown(2000).animate({fontSize:'2em'},"slow");
    jquery("#btn_1").click(function () {
        alert("Texto: "+jquery("#test").text());
    });
    jquery("#btn_2").click(function () {
        alert("HTML: "+jquery("#test").html());
    });
    jquery("button#botoncito").click(function () {
       console.log("Valor: "+jquery("#testito").val());
       console.log("Attr: "+jquery("#testito").attr("id"));
    });
    jquery("#btn_3").click(function () {
        jquery("#test2").html("<b>Nuevo texto</b>");
       /*
       .text()
       .val();
       * */
    });
    jquery("#button2").click(function () {
        jquery("#div4").load("demo_test.txt",function (respuesta,estado,xhr) {
            if(estado=="success")
                alert("Contenido cargado correctamente!");
            if(estado=="error")
                alert("Error: "+xhr.status+": "+xhr.statusText);
        });
    })
    jquery("#alerta").click(function () {
        jquery.get("demo_test.asp",function (dato,estado) {
           alert("Datos: "+dato+"\nEstado: "+estado);
       });
    });
    jquery("#alerta2").click(function(){
        jquery.post("demo_test_post.asp", {
            name: "Donald Duck",
            city: "Duckburg"
        },
        function(data, status){
            alert("Data: " + data + "\nStatus: " + status);
        });
    });
});