const URL = "/proyectos-juan/login-php"
const URL2 = "/login-php"
const guardarDatos = $("#datos")

$(document).ready(function () {
    console.log("iniciando jquery");
    ObtenerDatosLocalStorage()
});

toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": true,
    "progressBar": true,
    "positionClass": "toast-top-center",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "2000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
}

// login
$('#form-login').submit(function (event) {
    event.preventDefault();
    //console.log("enviando...");
    let name = $('#name').val();
    let pass = $('#pass').val();

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: `${URL}/App/signIn`,
        data: {
            name,
            pass,
        },
        success: (response) => {
            console.log(response);
            if (response.status) {
                toastr.success('Usuario Logueado Correctamente!');
                setTimeout(() => {
                    // window.location.href = '/proyectos-juan/proyecto-uno/Login/acceso';
                    $(location).attr('href', `${URL}/Admin/inicio`)
                }, 3000)

            } else if (response.errorinputs) {
                toastr.warning(response.errorinputs);
            } else {
                toastr.error(response.error);
            }


        }
    })


});

// registrar
$('#form-registro').submit(function (event) {
    event.preventDefault();
    console.log("enviando...");

    let name = $('#name').val();
    let correo = $('#correo').val();
    let pass = $('#pass').val();

    console.log(name, pass);
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: `${URL}/App/signUp`,
        data: {
            name: name,
            correo: correo,
            password: pass,
        },
        success: (response) => {
            if (response.error) {
                toastr.error(response.error);
            } else {
                console.log(response);
                toastr.success(response.success);
                setTimeout(() => {
                    // window.location.href = '/proyectos-juan/proyecto-uno/Login/acceso';
                    $(location).attr('href', `${URL}/Admin/inicio`);
                }, 3000);
            }
        }
    })
});

// envio del recover passwords
$('#form-recover').submit(function (event) {
    event.preventDefault();
    console.log("enviando...");

    let email = $('#email_recover').val();

    console.log(email);

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: `${URL}/App/enviarCambioPassword`,
        data: {
            email: email,
        },
        success: (response) => {
            console.log(response);
            toastr.success(response.message);
            setTimeout(() => {
                // window.location.href = '/proyectos-juan/proyecto-uno/Login/acceso';
                $(location).attr('href', `${URL}/App/acceso`);
            }, 3000);
        }
    })
});

// cambio de contraseña
$('#form-password').submit(function (event) {
    event.preventDefault();
    let id_user = $('#id_user').val();
    let pass = $('#pass_recover').val();
    let pass_confirm = $('#pass_recover_confirm').val();

    if (pass === pass_confirm && pass.length === pass_confirm.length) {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: `${URL}/App/UpdatePass`,
            data: {
                id_user: id_user,
                pass: pass
            },
            success: (response) => {
                if (response.status) {
                    toastr.success(`${response.response}, password cambiada correctamente!`);
                    setTimeout(() => {
                        // window.location.href = '/proyectos-juan/proyecto-uno/Login/acceso';
                        $(location).attr('href', `${URL}/App/acceso`);
                    }, 3000);
                }
            }
        })
    } else {
        toastr.error('Las contraseñas son erroneas');
    }

});

$('#datos').change(function (event) {
    recordarDatosLogin()
})


// funciones
function recordarDatosLogin() {
    const storage = localStorage
    if (guardarDatos.is(':checked')) {
        const data = {
            nombre: $("#name").val(),
            password: $("#pass").val(),
            check: $('#datos').val()
        }
        storage.setItem("datos", JSON.stringify(data))
        toastr.success("datos guardados!")

    } else if(!guardarDatos.is(':checked')) {
        storage.removeItem("datos")
        toastr.success("datos removidos!")
    }
}

function ObtenerDatosLocalStorage() {
    const storage = localStorage
    const nombre = $("#name")
    const password = $("#pass")
    const checkeds = $("#datos")

    if(storage.getItem("datos") != null) {
        let datos = JSON.parse(storage.getItem("datos"))
        nombre.val(datos.nombre)
        nombre.focus()
        password.val(datos.password)
        password.focus()

        if(datos.check === 'on') {
            checkeds.attr("checked", true)
        } else {
            checkeds.attr("checked", false)
        }
    }
}