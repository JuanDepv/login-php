const URL = "/proyectos-juan/login-php"
const URL2 = "/login-php"

$(document).ready(function () {
    mostrarUsuarioForm()
    roles()
})    

// eventos
$("#mostrarUsuarios").on("click", function (event) {
    let user_id = $("#usuarioselect").val();
    let estado = $("#estado").val();
    event.preventDefault();
    $(".usuario").show();
    listarUsuarios(user_id, estado);
})

$("#actualizarusuario").on("submit", function (event) {
    event.preventDefault()
    const id_usuario = $('#id_u').val()
    const username = $("#name").val()
    const email = $("#email").val()
    const rol = $("#rolnuevo").val()

    if(username.trim() === '' || email.trim() === '' || rol.trim() === '') {
        $.alert({
            title: 'Campos',
            content: 'Hay campos vacios'
        });
        // toastr.danger('los campos estan vacios')
        return false
    } else {
        $.confirm({
            title: 'Actualizar!',
            content: 'desea actualizar el usuario!',
            type: 'dark',
            buttons: {
                confirm: function () {
                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        url: `${URL}/Gestor/updateUser`,
                        data: {
                            id_usuario: id_usuario,
                            username: username,
                            email: email,
                            rol: rol,
                        },
                        success: function(response) {
                            console.log(response);
                            if(response.success) {
                                $("#modal-editar").modal("hide")
                                listarUsuarios()
                            }
                        }
                    })

                    $.alert({
                        title: 'Usuario',
                        content: 'Usuario actaulizado'
                    });
                }, 
                cancel: function() {

                }
            }
        });
    }

})

$("#subirimagen").on("submit", function (event) {
    event.preventDefault()
    const image = $("#image-rol").get(0).files[0]
    const id_usuario = $('#id_k').val()
    const data = new FormData()
    data.append("profile", image)
    data.append("id_usuario", id_usuario)
    $.ajax({
        url:`${URL}/Gestor/uploadImageProfile`,
        type: 'POST',
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        success: function (response) {
            if(response.success) {
                $.alert({
                    title: 'Perfil',
                    content: 'Imagen actualizada, cierra sesion e ingresa nuevamente',
                    type: 'dark'
                });
            }
        }

    })
})


// funciones
function mostrarUsuarioForm() {
    $.get(`${URL}/Gestor/getName`, function (response) {
        let data = JSON.parse(response);
        $.each(data, function (index, result) {
            $("#usuarioselect").append(
                '<option value="' + result.id_usuario + '">' + result.username + "</option>"
            );
        });
    });
}

function listarUsuarios(id, estado) {
    if (!$.fn.DataTable.isDataTable("#ud_user")) {
        dtable = $("#ud_user").DataTable({
            responsive: true,
            ajax: {
                url: `${URL}/Gestor/getUsers`,
                type: "POST",
                data: {
                    id: id,
                    estado: estado,
                },
                dataSrc: ""
            },
            language: {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Límite de usuarios por página: _MENU_",
                "sZeroRecords": "No se encontraron resultados.",
                "sEmptyTable": "Ningún usuario disponible en esta tabla.",
                "sInfo": "Mostrando del _START_ al _END_ de un total de _TOTAL_",
                "sInfoEmpty": "Mostrando del 0 al 0 de un total de 0",
                "sInfoFiltered": "(Filtrado de un total de _MAX_).",
                "sInfoPostFix": "",
                "sSearch": "Buscar:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente.",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente."
                }
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
                    targets: 4,
                    data: 'estado',
                    render: function (data, type, row) {

                        if(row["estado"] == 0) {
                            return (
                                `<span id="ii" class="usuario-er" onclick="estado(${row['id_usuario']}, ${data})">
                                    <i class="fas fa-times-circle" ></i>
                                </span>`
                            );
                        } else {
                            return (
                                `<span id="ia" class="usuario-ev" onclick="estado(${row['id_usuario']}, ${data})">
                                    <i class="fas fa-check-circle"></i>
                                </span>`
                            );
                        }
                    }
                },

                {
                    targets: 5,
                    data: '',
                    render: function (data, type, row) {
                        return (
                            `<button type="button" class="btn btn-info" onclick="ver(${data})">
                                <span class="">
                                <i class="fas fa-edit"></i>
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
}

function roles() {
    $.get(`${URL}/Gestor/getRol`, function (response) {
        let data = JSON.parse(response);
        $.each(data, function (index, result) {
            $("#rolnuevo").append(
                '<option value="' + result.id_rol + '">' + result.rol_usuario + "</option>"
            );
        });
    });
}

function ver(id) {
    $("#modal-editar").modal("show")
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: `${URL}/Gestor/getUser`,
        data: {
            id: id
        },
        success: function(response) {
            const id = $('#id_u').val(response.id_usuario)
            const username = $("#name").val(response.username)
            const email = $("#email").val(response.email)
            const rol = $("#rol").val(response.rol_usuario)
            const estado =  $("#estadou").val(response.estado)
            const fcreacion = $("#fcreacion").val(response.registro)

        }
    })
}

function estado(id, estado) {

    $.confirm({
        title: 'Estado',
        content: 'Desea Cambiar el estado!',
        type: 'dark',
        buttons: {
            confirm: function () {
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: `${URL}/Gestor/updataState`,
                    data: {
                        id: id,
                        estado: estado
                    },
                    success: function(response) {
                        if(response.success) {
                            listarUsuarios()
                        }
                    }
                })

                $.alert({
                    title: 'Estado',
                    content: 'Estado Actualizado'
                });
            }, 
            cancel: function() {
                
            }
        }
    });


}
