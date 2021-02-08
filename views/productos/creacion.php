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
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Creacion Productos</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                Footer
            </div>
            <!-- /.card-footer -->
        </div>
        <!-- /.card -->
    </div>
</div>
<!-- </div> -->
<!-- </section> -->
<!-- /.content -->


<div class="modal fade bd-example-modal-lg" id="modal-editar">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-dark">
            <div class="modal-header">
                <h4 class="modal-title">Editar / Modificar</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="actualizarusuario">
                    <div class="row">
                        <div class="input-group form-group col-md-6">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" name="name" id="name" class="form-control" placeholder="usuario">
                        </div>

                        <div class="input-group form-group col-md-6">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input type="text" name="email" id="email" class="form-control" placeholder="email">
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-group form-group col-md-6">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-users"></i></span>
                            </div>
                            <input type="text" disabled="true" name="rol" id="rol" class="form-control" placeholder="rol">
                        </div>

                        <div class="input-group form-group col-md-6">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user-plus"></i></span>
                            </div>
                            <select name="rolnuevo" id="rolnuevo" class="form-control">
                                <option value="">Selecione el nuevo rol</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-group form-group col-md-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="text" disabled="true" name="estado" id="estadou" class="form-control" placeholder="estado">
                        </div>
                    </div>

                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">
                            Cerrar
                        </button>
                        <button type="submit" class="btn btn-outline-light">
                            Actualizar
                        </button>
                    </div>
                </form>
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