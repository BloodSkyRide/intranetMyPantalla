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
            element_container.innerHTML = res.html;

        }

    })
}



async function sendUser(url){


    let formdata = document.getElementById("formdata");
    let form = new formdata(formdata);
    let response = await fetch(url,{
        method: "POST",
        headers:{

            "Content-Typer": "application/json"
        },

        body: JSON.stringify({



        })
    })

}
