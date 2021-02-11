<link rel="stylesheet" href="../assets/css/bootstrap/bootstrap.min.css">
<link rel="stylesheet" href="../assets/datatables/dataTables.bootstrap.css">

<div class="content-wrapper">
    <section class="content-header">
        <h1>Carrinho de Compras</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Cursos</li>
            <li class="active">carrinho de compras</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-lg-12">
                <div class="box box-warning">

                    <?php
                    if (isset($msg)) {
                        echo '<div class="box-header with-border">' . $msg . '</div>';
                    }
                    ?>
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Lista Carrinho Compras</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width="5%;">&nbsp</th>
                                        <th width="45%;">Curso</th>
                                        <th width="30%;">Preco</th>
                                        <th width="10%;"> Imagem</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    if (isset($resultadoCarrinho)) {
                                        $total = 0;

                                        foreach ($resultadoCarrinho as $usuarios) {
                                            $total = $total +  $usuarios->preco;
                                    ?>
                                            <tr>
                                                <td><a href="deletarCarrinho?id=<?php echo $usuarios->id; ?>"><i class="fa fa-trash"></i></a></td>
                                                <td><?php echo $usuarios->nomecurso; ?></td>
                                                <td><?php echo $usuarios->preco; ?></td>
                                                <td><img width="100px" height="80px" src="<?php echo $usuarios->url; ?>"> </td>

                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <div class="form-group" style="margin-top: 2%;">
                                <div class="col-xs-12 col-sm-9 col-lg-9">
                                    <button type="submit" class="btn btn-primary" style="width: 100%">Finalizar Compra</button>
                                </div>
                                <div class="col-xs-12 col-sm-3 col-lg-3">
                                    <label for="preco" style="font-size: 18px;" class="control-label"> Total da Compra R$ <?php echo $total ?></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="../assets/js/jquery/jquery-2.2.3.min.js"></script>


<script src="../assets/js/bootstrap/bootstrap.min.js"></script>
<script src="../assets/datatables/jquery.dataTables.min.js"></script>
<script src="../assets/datatables/dataTables.bootstrap.min.js"></script>

<!-- page script -->
<script>
    var base_url = '<?php echo base_url() ?>';
    $(document).ready(function() {

    });
    $(function() {
        $('#example1').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });
</script>