$(document).ready( function () {
    mostrarUsuarioForm()
});

$("#mostrarUsuarios").on("click", function(event) {
    let user = $('#username').val()
    let estado = $('#estadou').val() 
    event.preventDefault()
    // $(".usuario").show()
    // listarUsuarios(user, estado)
    console.log("consultando..."+  user + estado);
})


function mostrarUsuarioForm() {
    $.get("/proyectos-juan/proyecto-uno/Gestor/getName", function(data) {
        result = JSON.parse(data)
        $.each(result, function(id_usuario, value) {
            $("#usuarioselect").append('<option value="'+id_usuario+'">'+value.username+'</option>'); 
        })
    })
}

function listarUsuarios(username, estado) {

    $('#ud_user').DataTable({
        "order": [[0, "asc"]],
        language: {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Límite: _MENU_",
            "sZeroRecords": "No hay ningún resultado.",
            "sEmptyTable": "Ningún usuario.",
            "sInfo": "Mostrando del _START_ al _END_ de un total de _TOTAL_ ",
            "sInfoEmpty": "Mostrando del 0 al 0 de un total de 0",
            "sInfoFiltered": "(Filtrado de un total de _MAX_ ).",
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
            },
            "columns": [

            ]
        },
    });

    $.ajax({
        url: '/proyectos-juan/proyecto-uno/Gestor/getUsuarios',
        data: {
            username: username,
            estado: estado
        },
        type: 'POST',
        // contentType: "application/json",
        dataType: 'json',
        success: function(response) {
            $('#ud_user').DataTable().clear().draw();
            $(response).each(function(i, usuario){

                $('#ud_user').DataTable().row.add([
                    i,
                    usuario.username,
                    usuario.email,
                    usuario.rol_usuario,
                    usuario.estado === "1" ? `<span class="euser"><i class="far fa-check-circle"></i><span>`: `<span class="eusero"><i class="far fa-times-circle"></i><span>`,
                    `<div class="td-space">
                        <button type="button" class="BtnVerSocio btn btn-info"                   data-toggle="modal"
                        data-target="#VerSocio" data-iduser="${usuario.id_usuario}">
                            <span class="glyphicon glyphicon-eye-open">
                                Ver
                            </span>
                        </button>
                        <button type="button" class="BtnEditarSocio btn btn-warning" data-toggle="modal"
                        data-target="#RASocio" data-id_user="${usuario.id_usuario}">
                            <span class="glyphicon glyphicon-edit">
                                Editar
                            </span> 
                        </button>
                    </div>`
                ]).draw();
            });
        }
    });

}