
$(document).ready(function () {
    $("#register_nav").trigger("click");

        
    $('.select2').select2();
    $('.select2bs4').select2({
        theme: 'bootstrap4'
      })


});
console.log("hola");

async function register_user() {
    $.ajax({
        url: "/reloj/public/registerUser",
        type: "GET",
        dataType: "json",
    }).done(function (res) {
        if (res.status) {
            console.log("entro aqui a depurar el status");
            let element_container = document.getElementById("container_menu");
            element_container.innerHTML = res.html;
        }
    });
}

async function sendUser(url) {




    

    let formdata = document.getElementById("formdata");
    let form = new FormData(formdata);
    let jsonObject = {};


    form.forEach((value, key) => {
        jsonObject[key] = value;
    });



    let response = await fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },

        body: JSON.stringify(jsonObject),

    });

    if (response.ok) {

        let data =  await response.json();

        if(data.status){

            // sweetAlert(
            //     "success",
            //     "Excelente!",
            //     "El usuario fue creado de manera exitosa"
            // );

            Swal.fire({
                title: "Excelente!",
                text: "El usuario fue creado de manera exitosa",
                icon: "success"
              });
            
             //formdata.reset();
        }else{


            Swal.fire({
                title: "Uuuuups!",
                text: "El usuario no pudó ser guardado en la base de datos, por favor revisa que todos los campos esten bien formados, recuerda que el nacimiento debe ser mayor a 18 años consulta con el departamento de sistemas",
                icon: "error"
              });

        //  sweetAlert(
        //         "error",
        //         "Uuuuups!",
        //         "El usuario no pudó ser guardado en la base de datos, por favor revisa que todos los campos esten bien formados, recuerda que el nacimiento debe ser mayor a 18 años consulta con el departamento de sistemas"
        //     );

        }


    }

}

 async function showManageLabor(url){

    
    let response = await fetch(url,{

        method: "GET",
        headers:{
            "Content-Type": "application/json"
        }
    })


    if(response.status){

        let data = await response.json();
        let element_container = document.getElementById("container_menu");

        element_container.innerHTML = data.html;
    }

}

function sweetAlert(icon, title, text) {



}
