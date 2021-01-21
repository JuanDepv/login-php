$(document).ready(function() {
    console.log("iniciando jquery");
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
$('#form-login').submit(function(event) {
    event.preventDefault();
    //console.log("enviando...");
    let name = $('#name').val();
    let pass = $('#pass').val();
    
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: '/proyectos-juan/proyecto-uno/App/signIn',
        data:{
            name,
            pass,
        },
        success:(response) => {
            console.log(response);
            if(response.status) {
                toastr.success('Usuario Logueado Correctamente!');
                setTimeout(() => {
                    // window.location.href = '/proyectos-juan/proyecto-uno/Login/acceso';
                    $(location).attr('href', '/proyectos-juan/proyecto-uno/Admin/inicio')
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
$('#form-registro').submit(function(event) {
    event.preventDefault();
    console.log("enviando...");

    let name = $('#name').val();
    let correo = $('#correo').val();
    let pass = $('#pass').val();

    console.log(name, pass);
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: '/proyectos-juan/proyecto-uno/App/signUp',
        data: {
            name: name,
            correo: correo,
            password: pass,
        },
        success:(response) => {
            if (response.error) {
                toastr.error(response.error);
            }else {
                console.log(response);
                toastr.success(response.success);
                setTimeout(() => {
                    // window.location.href = '/proyectos-juan/proyecto-uno/Login/acceso';
                    $(location).attr('href', '/proyectos-juan/proyecto-uno/Admin/inicio');
                }, 3000);
            }
        }
    })
});

// envio del recover passwords
$('#form-recover').submit(function(event) {
    event.preventDefault();
    console.log("enviando...");

    let email = $('#email_recover').val();

    console.log(email);

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: '/proyectos-juan/proyecto-uno/App/enviarCambioPassword',
        data: {
            email: email,
        },
        success:(response) => {
            console.log(response);
            toastr.success(response.message);
            setTimeout(() => {
                 // window.location.href = '/proyectos-juan/proyecto-uno/Login/acceso';
                    $(location).attr('href', '/proyectos-juan/proyecto-uno/App/acceso');
            }, 3000);
        }
    })
});

// cambio de contraseña
$('#form-password').submit(function(event) {
    event.preventDefault();
    let id_user = $('#id_user').val();
    let pass    = $('#pass_recover').val();
    let pass_confirm    = $('#pass_recover_confirm').val();

    if (pass === pass_confirm && pass.length === pass_confirm.length) {

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '/proyectos-juan/proyecto-uno/App/UpdatePass',
            data: {
                id_user: id_user,
                pass: pass
            },
            success:(response) => {
                if (response.status) {
                    toastr.success(`${response.response}, password cambiada correctamente!`);
                    setTimeout(() => {
                        // window.location.href = '/proyectos-juan/proyecto-uno/Login/acceso';
                        $(location).attr('href', '/proyectos-juan/proyecto-uno/App/acceso');
                    }, 3000);
                }
            }
        })
    } else{
        toastr.error('Las contraseñas son erroneas');
    }

});