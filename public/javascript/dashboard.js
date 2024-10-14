$(document).ready(function () {
    $("#register_nav").trigger("click");
});
async function register_user(url) {
    $.ajax({
        url: url,
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
        let data = await response.json();

        if (data.status) {
            // sweetAlert(
            //     "success",
            //     "Excelente!",
            //     "El usuario fue creado de manera exitosa"
            // );

            Swal.fire({
                title: "Excelente!",
                text: "El usuario fue creado de manera exitosa",
                icon: "success",
            });

            formdata.reset();
        } else {
            Swal.fire({
                title: "Uuuuups!",
                text: "El usuario no pudó ser guardado en la base de datos, por favor revisa que todos los campos esten bien formados, recuerda que el nacimiento debe ser mayor a 18 años consulta con el departamento de sistemas",
                icon: "error",
            });

            //  sweetAlert(
            //         "error",
            //         "Uuuuups!",
            //         "El usuario no pudó ser guardado en la base de datos, por favor revisa que todos los campos esten bien formados, recuerda que el nacimiento debe ser mayor a 18 años consulta con el departamento de sistemas"
            //     );
        }
    }
}

async function showManageLabor(url) {
    console.log("ruta" + url);

    let response = await fetch(url, {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
        },
    });

    if (response.status) {
        let data = await response.json();
        let element_container = document.getElementById("container_menu");

        element_container.innerHTML = data.html;
        $(".select2").select2();
        $(".select2bs4").select2({
            theme: "bootstrap4",
        });

        initializeDataTable();
    }
}

function sweetAlert(icon, title, text) {}

function addSubLabors() {
    let item = document.getElementById("item_labor").value.trim();

    console.log("viendo el item cogido es: " + item + "/");

    document.getElementById("item_labor").value = "";

    let parent_nodo = document.getElementById("add_labors");

    let id_flaf = 1;

    if (!parent_nodo.hasChildNodes()) {
        parent_nodo.innerHTML = `<button onclick=(deleteItem(this.id)) id='item${id_flaf}'style='padding: 0; border: none; background-color: inherit;' class='m-1'><span class='badge badge-warning'>${item}</span></button>`;
    } else {
        let num_childs = parent_nodo.childNodes.length;

        parent_nodo.innerHTML += `<button onclick=(deleteItem(this.id)) id='item${
            id_flaf + num_childs
        }'style='padding: 0; border: none; background-color: inherit;' class='m-1'><span class='badge badge-warning'>${item}</span></button>`;
    }
}

function deleteItem(id) {
    let item = document.getElementById(id);

    item.remove();
}

async function sendSubLabors(url) {
    let parent_nodo = document.getElementById("add_labors");

    let elements = parent_nodo.querySelectorAll("button > span");
    let texts = [];

    elements.forEach((element) => {
        texts.push(element.textContent);
    });
    let sub_labors_string = parent_nodo.textContent;

    console.log("string: " + sub_labors_string);

    let id_labor_principal = document.getElementById("select_labor").value;

    let response = await fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            id_labor_principal,
            texts,
        }),
    });

    if (response.status) {
        let data = await response.json();
        console.log("el tipo es: " + typeof data);

        let element_container = document.getElementById("container_menu");

        element_container.innerHTML = data.html;

        initializeDataTable();
    }
}

function deleteSubLaborsDashborad() {
    let parent_nodo = document.getElementById("add_labors");

    parent_nodo.innerHTML = "";
}

async function delteSubLaborTable(url) {
    console.log("hola");
    let column_subgroups = document.querySelectorAll(
        `td > div.div_checknox > input[type="checkbox"]:checked`
    );

    let array = [];

    column_subgroups.forEach((node) => {
        array.push(node.value);
    });

    console.log(column_subgroups);

    let response = await fetch(url, {
        method: "DELETE",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            ids_deletes: array,
        }),
    });

    if (response.status) {
        let data = await response.json();
        console.log("el tipo es: " + typeof data);

        let element_container = document.getElementById("container_menu");

        element_container.innerHTML = data.html;

        initializeDataTable();
    }
}

async function createLabor(url) {
    let name_labor = document.getElementById("name_labor").value;

    let response = await fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },

        body: JSON.stringify({
            name_labor,
        }),
    });

    if (response.status) {
        let data = await response.json();
        console.log("el tipo es: " + typeof data);

        let element_container = document.getElementById("container_menu");

        element_container.innerHTML = data.html;
        initializeDataTable();
    }
}

function initializeDataTable() {
    $("#table_labors").DataTable({
        responsive: true,
        lengthChange: false,
        autoWidth: false,
        buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
        language: {
            search: "Buscar en la tabla:",
            lengthMenu: "Mostrar _MENU_ registros",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            paginate: {
                first: "Primero",
                last: "Último",
                next: "Siguiente",
                previous: "Anterior",
            },
            emptyTable: "No hay datos disponibles",
        },
    });
}

async function getShowLabors(url) {

    const token = localStorage.getItem('access_token');
    console.log("recupero token*: "+token)
    let response = await fetch(url, {
        method: "GET",
        headers: {
            "Content-type": "application/json",
            "Authorization": `Bearer ${token}`,
        },
    });

    if (response.status) {
        let data = await response.json();
        console.log("el tipo es: " + typeof data);

        let element_container = document.getElementById("container_menu");

        element_container.innerHTML = data.html;
    }
}

async function getShowAssists(url){


    let response = await fetch(url,{

        headers: {
            "Content-Type" : "application/json"
        }
    });


    if(response.status){




    }

}
