$(document).ready(function(){

    $( "#register_nav" ).trigger( "click" );

})
console.log("hola")

async function register_user(){


    $.ajax({

        url: '/reloj/public/registerUser',
        type: 'GET',
        dataType: 'json'
    }).done(function(res){

        if(res.status){

            console.log("entro aqui a depurar el status")
            let element_container = document.getElementById("container_menu");
            console.log("respuesta: "+res.html)
            element_container.innerHTML = res.html;
    

        }

    })
}


function income_report(){







}