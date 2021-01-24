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
    <div class="col-12">
        <!-- Default box -->
        <div class="card" style="border: 1px solid black;">
            <div class="card-header">
                <h3 class="card-title">Gestor</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <form action="#">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="usuarios">usuarios</label>
                                <select name="usuario" id="usuarioselect" class="form-control">
                                    <option value="">Selecione Un Usuario</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="estado">estado</label>
                                <select name="estado" id="estado" class="form-control">
                                    <option value="">Selecione estado</option>
                                    <option value="1">activo</option>
                                    <option value="0">inactivo</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <button id="mostrarUsuarios" type="submit" class="btn btn-dark btn-block">buscar</button>
                </form>
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


<!-- <div class="container-fluid"> -->
<div class="usuario">
    <div class="row">
        <div class="col-12">
            <!-- Default box -->
            <div class="card" style="border: 1px solid black;">
                <!-- <div class="card-header">
                <h3 class="card-title">Gestor de usuarios</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div> -->
                <div class="card-body">
                    <table id="ud_user" class="table">
                        <thead>
                            <tr class="bg-dark text-white text-center">
                                <th>N*</th>
                                <th>nombre</th>
                                <th>email</th>
                                <th>rol</th>
                                <th>estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                        </tbody>
                    </table>
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
</div>


<div class="modal fade" id="modal-editar">
    <div class="modal-dialog">
        <div class="modal-content bg-dark">
            <div class="modal-header">
                <h4 class="modal-title">Editar / Modificar</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" name="name" id="name" class="form-control" placeholder="usuario">
                    </div>

                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="text" name="email" id="email" class="form-control" placeholder="email">
                    </div>

                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="text" disabled="true" name="rol" id="rol" class="form-control" placeholder="rol">
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-outline-light">Guardar Cambios</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- </div> -->
<!-- </section> -->
<!-- /.content -->

<!-- Footer -->


<?php require_once 'views/dashboard/footer.admin.php' ?>