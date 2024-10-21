$(document).ready(function () {
    $("#register_nav").trigger("click");
});
async function register_user(url) {

    const token = localStorage.getItem("access_token");
    $.ajax({
        url: url,
        type: "GET",
        dataType: "json",
        headers:{

            "Content-Type" : "application/json",
            "Authorization": `Bearer ${token}`
        }
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

    const token = localStorage.getItem("access_token");

    form.forEach((value, key) => {
        jsonObject[key] = value;
    });

    let response = await fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "Authorization": `Bearer ${token}`
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

    document.getElementById("item_labor").value = "";

    let parent_nodo = document.getElementById("add_labors");

    let id_flaf = 1;

    if (!parent_nodo.hasChildNodes()) {
        parent_nodo.innerHTML = `<button onclick=(deleteItem(this.id)) id='item${id_flaf}'style='padding: 0; border: none; background-color: inherit;' class='m-1'><span class='badge badge-info'>${item}</span></button>`;
    } else {
        let num_childs = parent_nodo.childNodes.length;

        parent_nodo.innerHTML += `<button onclick=(deleteItem(this.id)) id='item${
            id_flaf + num_childs
        }'style='padding: 0; border: none; background-color: inherit;' class='m-1'><span class='badge badge-info'>${item}</span></button>`;
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

    const token = localStorage.getItem("access_token");

    elements.forEach((element) => {
        texts.push(element.textContent);
    });

    
    let sub_labors_string = parent_nodo.textContent;
    
    let id_labor_principal = document.getElementById("select_labor").value;

    if(texts.length > 0 && id_labor_principal !== "selected"){
    
        let response = await fetch(url, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                Authorization: `Bearer ${token}`,
            },
            body: JSON.stringify({
                id_labor_principal,
                texts,
            }),
        });
    
        if (response.status) {
            let data = await response.json();
    
            let element_container = document.getElementById("container_menu");
    
            element_container.innerHTML = data.html;
    
            initializeDataTable();

            Swal.fire({
                title: "¡Excelente!",
                text: "¡¡ Se añadió de manera exitosa el grupo de sub labores!!",
                icon: "succes",
            });


        }

    }else{

        Swal.fire({
            title: "¡Uuuuups!",
            text: "¡¡ verifica que hayas cargado sub labores en la tabla ó no has seleccionado una labor a la cual asignar el grupo de sublabores!!",
            icon: "error",
        });


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

    const token = localStorage.getItem("access_token");

    let response = await fetch(url, {
        method: "DELETE",
        headers: {
            "Content-Type": "application/json",
            Authorization: `Bearer ${token}`,
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
    const token = localStorage.getItem("access_token");

    let response = await fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            Authorization: `Bearer ${token}`,
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
    const token = localStorage.getItem("access_token");
    console.log("recupero token*: " + token);
    let response = await fetch(url, {
        method: "GET",
        headers: {
            "Content-type": "application/json",
            Authorization: `Bearer ${token}`,
        },
    });

    if (response.status) {
        let data = await response.json();
        console.log("el tipo es: " + typeof data);

        let element_container = document.getElementById("container_menu");

        element_container.innerHTML = data.html;
    }
}

async function getShowAssists(url) {
    const token = localStorage.getItem("access_token");

    let response = await fetch(url, {
        headers: {
            "Content-Type": "application/json",
            Authorization: `Bearer ${token}`,
        },
    });

    if (response.status) {
        let data = await response.json();
        console.log("el tipo es: " + typeof data);

        let element_container = document.getElementById("container_menu");

        element_container.innerHTML = data.html;

        $("#report_table").DataTable({
            responsive: true,
            order: [[7, "desc"]],
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
}

function sendDataSet(state) {
    let bridge = document.getElementById("bridge");

    bridge.dataset.dataState = state;

    let modal_message = document.getElementById("security");

    modal_message.innerHTML = `seguro de: ${state}`;
}

async function sendModalAccept(url) {
    let data = document.getElementById("bridge").dataset.dataState;

    const token = localStorage.getItem("access_token");

    let response = await fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            Authorization: `Bearer ${token}`,
        },
        body: JSON.stringify({
            estado: data,
        }),
    });

    if (response.status) {
        let data = await response.json();
        console.log("el tipo es: " + typeof data);

        let element_container = document.getElementById("container_menu");

        element_container.innerHTML = data.html;

        $("#exampleModal").modal("hide");
    }
}

async function verifyHomeWorks(url) {
    let result = document.querySelectorAll(
        `td.column_sub_labor > div.icheck-primary > input[type="checkbox"]:checked`
    );

    let checked = [];

    const token = localStorage.getItem("access_token");

    result.forEach((node, index) => {
        checked.push(node.value);
        console.log("depuracion" + node.value);
    });

    let response = await fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            Authorization: `Bearer ${token}`,
        },
        body: JSON.stringify({
            checked,
        }),
    });

    if (response.status) {
        let data = await response.json();
        console.log("el tipo es: " + typeof data);

        let element_container = document.getElementById("container_menu");

        element_container.innerHTML = data.html;
    }
}

async function rechargeSubLabors(url) {
    let column_subgroups = document.querySelectorAll(
        `td > div.div_checknox > input[type="checkbox"]:checked`
    );


    if(column_subgroups.length > 0){

        let array = [];

        column_subgroups.forEach((node) => {
            array.push(node.value);
        });
    
        const token = localStorage.getItem("access_token");
        let response = await fetch(url, {
            method: "PUT",
            headers: {
                "Content-Type": "application/json",
                Authorization: `Bearer ${token}`,
            },
    
            body: JSON.stringify({
                checked: array,
            }),
        });
    
        if (response.status) {
            Swal.fire({
                title: "Excelente!",
                text: "¡¡Se han renovado las sub labores seleccionadas!!",
                icon: "success",
            });
    
            column_subgroups.forEach((node) => {
                node.checked = false;
            });
        } else {
            Swal.fire({
                title: "Uuuuups!",
                text: "¡¡No se han renovado las sub labores, consulta con el departamento de sistemas!!",
                icon: "error",
            });
        }

    }else{


        Swal.fire({
            title: "Uuuuups!",
            text: "¡¡Recuerda seleccionar las sub labores a las cuales quieres renovar!!",
            icon: "error",
        });


    }

   
}

async function getViewHistoryLabors(url) {
    const token = localStorage.getItem("access_token");
    let response = await fetch(url, {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
            Authorization: `Bearer ${token}`,
        },
    });

    if (response.status) {
        let data = await response.json();

        console.log("el tipo es: " + typeof response);

        let element_container = document.getElementById("container_menu");

        element_container.innerHTML = data.html;
        $("#reservation").daterangepicker();

        $(".select2").select2();
        $(".select2bs4").select2({
            theme: "bootstrap4",
        });

        $("#history_table_searcher").DataTable({
            responsive: true,
            order: [[4, "desc"]],
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
}

function getRangeDatePicker() {
    let range = document.getElementById("reservation").value;

    return range;
}

async function searchForRange(url) {
    let range = getRangeDatePicker();
    const token = localStorage.getItem("access_token");

    let response = await fetch(`${url}?range=${range}`, {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
            Authorization: `Bearer ${token}`,
        },
    });

    let data = await response.json();

    if (data.status) {
        console.log("el tipo es: " + typeof response);

        let element_container = document.getElementById("container_menu");

        element_container.innerHTML = data.html;
        $("#reservation").daterangepicker();

        $(".select2").select2();
        $(".select2bs4").select2({
            theme: "bootstrap4",
        });

        $("#reservation").val(range);

        $("#history_table_searcher").DataTable({
            responsive: true,
            order: [[4, "desc"]],
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
}

async function searcherText(url) {
    let range = getRangeDatePicker();
    let searcher = document.getElementById("labor_select").value;

    const token = localStorage.getItem("access_token");

    let response = await fetch(`${url}?range=${range}&text=${searcher}`, {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
            Authorization: `Bearer ${token}`,
        },
    });

    let data = await response.json();

    if (data.status) {
        console.log("el tipo es: " + typeof response);

        let element_container = document.getElementById("container_menu");

        element_container.innerHTML = data.html;
        $("#reservation").daterangepicker();

        document.getElementById("labor_select").value = searcher;
        $(".select2").select2();
        $(".select2bs4").select2({
            theme: "bootstrap4",
        });

        $("#reservation").val(range);

        $("#history_table_searcher").DataTable({
            responsive: true,
            order: [[4, "desc"]],
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
}

async function collectSubLabors(url) {
    $("#modal_confirm").modal("hide");

    const token = localStorage.getItem("access_token");

    let response = await fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            Authorization: `Bearer ${token}`,
        },
    });

    let data = await response.json();

    if (data.status) {
        Swal.fire({
            title: "¡Excelente!",
            text: "¡¡Excelente las sub labores han sido recogidas de manera exitosa!!",
            icon: "success",
        });
    } else {
        Swal.fire({
            title: "¡Uuups!",
            text: "¡¡hubó un error, consulta con el departamento de sistemas si el error persiste!!",
            icon: "error",
        });
    }
}

async function getShowReportAssists(url) {
    const token = localStorage.getItem("access_token");

    let response = await fetch(url, {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
            Authorization: `Bearer ${token}`,
        },
    });

    let data = await response.json();

    if (data.status) {
        let element_container = document.getElementById("container_menu");

        element_container.innerHTML = data.html;
    }
}

async function getShowAdminUsers(url) {
    const token = localStorage.getItem("access_token");

    console.log("el token es" + token);

    let response = await fetch(url, {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
            Authorization: `Bearer ${token}`,
        },
    });

    let data = await response.json();

    if (data.status) {
        let element_container = document.getElementById("container_menu");

        element_container.innerHTML = data.html;

        $("#table_userss").DataTable({
            responsive: true,
            order: [[9, "desc"]],
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
}

async function openModalUser(cedula, url) {
    $("#modal_edit").modal("show");

    document.getElementById("button_save").dataset.dataId = cedula;

    const token = localStorage.getItem("access_token");

    let response = await fetch(`${url}?cedula=${cedula}`, {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
            Authorization: `Bearer ${token}`,
        },
    });

    let data = await response.json();

    if (data.status) {
        $("#title_modal").text(
            `Editar al usuario ${data.datos[0].nombre.toUpperCase()} ${data.datos[0].apellido.toUpperCase()}`
        );

        document.getElementById("title_modal").style.fontWeight = "bold";

        $(".select2").select2();
        $(".select2bs4").select2({
            theme: "bootstrap4",
        });

        $("#select_labor_edit")
            .val(data.datos[0].id_labor)
            .trigger("change.select2");

        document.getElementById("selector_rol").value = data.datos[0].rol;

        $("#nombre_form").val(data.datos[0].nombre);
        $("#apellido_form").val(data.datos[0].apellido);
        $("#nombre_emergencia_form").val(data.datos[0].nombre_contacto);
        $("#email_form").val(data.datos[0].email);
        $("#direccion_form").val(data.datos[0].direccion);
        $("#form_num_emergencia").val(data.datos[0].contacto_emergencia);
        $("#my_numero").val(data.datos[0].telefono);
    }
}

async function modifyUser(url) {
    let id = document.getElementById("button_save").dataset.dataId;

    let formdata = document.getElementById("new_form");

    let formu = new FormData(formdata);

    formu.append("cedula", id);

    let jsonObject = {};

    formu.forEach((value, key) => {
        jsonObject[key] = value;
    });

    const token = localStorage.getItem("access_token");
    let response = await fetch(url, {
        method: "PUT",

        headers: {
            "Content-Type": "application/json",
            Authorization: `Bearer ${token}`,
        },

        body: JSON.stringify(jsonObject),
    });

    let data = await response.json();

    if (data.status) {
        $("#modal_edit").modal("hide");

        let element_container = document.getElementById("container_menu");
        element_container.innerHTML = data.html;
        

        $("#table_userss").DataTable({
            responsive: true,
            order: [[9, "desc"]],
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

        Swal.fire({
            title: "¡Excelente!",
            text: "¡¡Excelente el usuario fué modificado de manera exitosa!!",
            icon: "success",
        });

        


    } else {
        Swal.fire({
            title: "¡UUuups!",
            text: "¡¡El usuario no pudó ser modificado, intentalo nuevamente, si no es posible solucionarlo, remite el inconveniente al departamento de sistemas!!",
            icon: "error",
        });
    }
}

async function deleteUser(url) {
    let cedula = document.getElementById("button_save").dataset.dataId;

    const token = localStorage.getItem("access_token");

    let response = await fetch(`${url}?cedula=${cedula}`, {
        method: "DELETE",
        headers: {
            "Content-Type": "application/json",
            Authorization: `Bearer ${token}`,
        },
    });

    let data = await response.json();

    if (data.status) {
        $("#modal_edit").modal("hide");
        Swal.fire({
            title: "¡Excelente!",
            text: "¡¡El usuario fue eliminado de la base de datos!!",
            icon: "success",
        });


        let element_container = document.getElementById("container_menu");
        element_container.innerHTML = data.html;

        $("#table_userss").DataTable({
            responsive: true,
            order: [[9, "desc"]],
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
    } else {
        Swal.fire({
            title: "¡UUuups!",
            text: "¡¡El usuario no pudó ser eliminado, intentalo nuevamente, si no es posible solucionarlo, remite el inconveniente al departamento de sistemas!!",
            icon: "error",
        });
    }
}

async function logout(url) {
    const token = localStorage.getItem("access_token");

    let response = await fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            Authorization: `Bearer ${token}`,
        },
    });

    let data = await response.json();

    if (data.status) {
        Swal.fire({
            position: "top-end",
            icon: "success",
            title: "¡Tu sesión fué cerrada con éxito!",
            showConfirmButton: false,
            timer: 1500,
        });

        localStorage.removeItem("access_token");

        window.location.href = "./";
    }
}

async function editNamLabor(url) {
    const token = localStorage.getItem("access_token");

    let name = document.getElementById("edit_name_labor").value;

    let id_labor = document.getElementById("select_labor").value;

    let response = await fetch(url, {
        method: "PUT",
        headers: {
            "Content-Type": "application/json",
            Authorization: `Bearer ${token}`,
        },

        body: JSON.stringify({
            id_labor: id_labor,
            nombre_nuevo: name,
        }),
    });

    let data = await response.json();

    if (data.status) {
        let element_container = document.getElementById("container_menu");
        element_container.innerHTML = data.html;

        Swal.fire({
            title: "¡Excelente!",
            text: "¡¡La labor fue modificada correctamente!!",
            icon: "success",
        });
    } else {
        Swal.fire({
            title: "¡Uuuuups!",
            text: "¡¡La labor no pudó ser modificada correctamente, si el error persiste por favor comunicarte con el departamento de sistemas!!",
            icon: "error",
        });
    }
}

