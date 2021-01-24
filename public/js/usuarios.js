const URL = "/proyectos-juan/login-php"
const URL2 = "/login-php"

$(document).ready(function () {
    mostrarUsuarioForm();
});

// eventos
$("#mostrarUsuarios").on("click", function (event) {
    let user_id = $("#usuarioselect").val();
    let estado = $("#estado").val();
    event.preventDefault();
    $(".usuario").show();
    listarUsuarios(user_id, estado);
    console.log("consultando..." + user_id + " " + estado);
});


// funciones
function mostrarUsuarioForm() {
    $.get(`${URL}/Gestor/getName`, function (data) {
        result = JSON.parse(data);
        $.each(result, function (i, value) {
            $("#usuarioselect").append(
                '<option value="' + value.id_usuario + '">' + value.username + "</option>"
            );
        });
    });
}

function listarUsuarios(id, estado) {
    if (!$.fn.DataTable.isDataTable("#ud_user")) {
        dtable = $("#ud_user").DataTable({
            ajax: {
                url: `${URL}/Gestor/getUsers`,
                type: "POST",
                data: {
                    id: id,
                    estado: estado,
                },
                dataSrc: ""
            },
            columns: [
                { data: "id_usuario" },
                { data: "username" },
                { data: "email" },
                { data: "rol_usuario" },
                { data: "estado" },
                { data: "id_usuario" },
            ],
            columnDefs: [
                {
                    targets: 5,
                    data: '',
                    render: function (data, type, row) {

                        console.log("data: "+data);
                        console.log("type: "+type);
                        console.log("row: "+row);
                        return (
                            `<button type="button" class="btn btn-info" onclick="editar(${data})">
                                <span class="">
                                    Ver
                                </span>
                            </button>
                            <button type="button" class="btn    btn-danger" onclick="${data}">
                                <span class="">
                                    Editar
                                </span>
                            </button>`
                        );
                    }
                }
            ]
        });
    } else {
        dtable.destroy();
        listarUsuarios(id, estado);
    }

    // $.ajax({
    //     url: '/proyectos-juan/proyecto-uno/Gestor/getUsuarios',
    //     data: {
    //         username: username,
    //         estado: estado
    //     },
    //     type: 'POST',
    //     // contentType: "application/json",
    //     dataType: 'json',
    //     success: function(response) {
    //         $('#ud_user').DataTable({})

    //         // $(response).each(function(i, usuario){

    //         //     $('#ud_user').DataTable().row.add([
    //         //         i,
    //         //         usuario.username,
    //         //         usuario.email,
    //         //         usuario.rol_usuario,
    //         //         usuario.estado === "1" ? `<span class="euser"><i class="far fa-check-circle"></i><span>`: `<span class="eusero"><i class="far fa-times-circle"></i><span>`,
    //         //         `<div class="td-space">
    //         //             <button type="button" class="btn btn-info"                   data-toggle="modal"
    //         //             data-target="#" data-iduser="${usuario.id_usuario}">
    //         //                 <span class="glyphicon glyphicon-eye-open">
    //         //                     Ver
    //         //                 </span>
    //         //             </button>
    //         //             <button type="button" class="btn btn-warning" data-toggle="modal"
    //         //             data-target="#" data-id_user="${usuario.id_usuario}">
    //         //                 <span class="glyphicon glyphicon-edit">
    //         //                     Editar
    //         //                 </span>
    //         //             </button>
    //         //         </div>`
    //         //     ]).draw();
    //         // });
    //     }
    // });
}

function editar(id) {
    $("#modal-editar").modal("show")
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: `${URL}/Gestor/getUser`,
        data: {
            id: id
        },
        success: function(response) {
            const username = $("#name").val(response.username)
            const email = $("#email").val(response.email)
            const rol = $("#rol").val(response.rol_usuario)
        }
    })
}
