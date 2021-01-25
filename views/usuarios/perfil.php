<!-- Navbar -->
<?php require_once 'views/dashboard/header.admin.php' ?>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<?php require_once 'views/dashboard/sidebar.admin.php' ?>

<!-- Content Wrapper. Contains page content -->
<?php require_once 'views/dashboard/container.admin.php' ?>
<!-- /.content-wrapper -->

<!-- Main content -->
<!-- <section class="content"> -->

<!-- <div class="container-fluid"> -->
<div class="row">
    <div class="col-4">
        <!-- Default box -->
        <div class="card">
            <div class="card-body">
                <div class="usuario-perfil">
                    <div class="img-circle">
                        <a href=""><img src="http://trovacamporella.com/img/trovacamporella-fiat500.png" />
                    </div></a>
                    <div class="usuario-nombres">
                        <span>Nombre: </span>
                        <span>Correo: </span>
                    </div>
                </div>
            </div>
            <!-- /.card-body
            <div class="card-footer">
                Footer
            </div>
            /.card-footer -->
        </div>
        <!-- /.card -->
    </div>

    <div class="col-8">
        <!-- Default box -->
        <div class="card">

            <div class="card-body">
                <div>
                    <h3>Datos</h3>
                    <form id="form-login">
                        <div class="row">
                            <div class="input-group form-group col-6">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" name="name" id="name" class="form-control" placeholder="rol" disabled="true" />

                            </div>
                            <div class="input-group form-group col-6">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-atom"></i></span>
                                </div>
                                <input type="password" name="pass" id="pass" class="form-control" placeholder="estado" disabled="true" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.card-body
            <div class="card-footer">
                Footer
            </div>
            /.card-footer -->
        </div>
        <!-- /.card -->
    </div>
</div>
<!-- </div> -->
<!-- </section> -->
<!-- /.content -->

<!-- Footer -->
<?php require_once 'views/dashboard/footer.admin.php' ?>