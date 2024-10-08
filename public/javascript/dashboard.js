$(document).ready(function () {
    $("#register_nav").trigger("click");
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
    console.log("entro aqui: " + url);

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

    if (response.status) {
        sweetAlert(
            "success",
            "Excelente!",
            "El usuario fue creado de manera exitosa"
        );


        formdata.reset();
    }

    sweetAlert(
        "error",
        "Uuuuups!",
        "El usuario no pudó ser guardado en la base de datos, consulta con el departamento de sistemas"
    );

}

function sweetAlert(icon, title, text) {
    Swal.fire({
        title: title,
        text: text,
        icon: icon,
        confirmButtonText: "OK",
    });
}
