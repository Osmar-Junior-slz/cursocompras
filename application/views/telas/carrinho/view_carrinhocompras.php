<link rel="stylesheet" href="../assets/css/bootstrap/bootstrap.min.css">
<link rel="stylesheet" href="../assets/datatables/dataTables.bootstrap.css">
<link rel="stylesheet" href="../assets/plugins/daterangepicker/daterangepicker.css">

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
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                                        Finalizar Compra
                                    </button>
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



        <!-- Modal -->
        <form role="form"  method="post">
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" style="font-size: 25px;" id="exampleModalLongTitle">Forma de Pagamento</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="col-sm-12 form-group">
                                <label>Data do Pagamento</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Data do pagamento" value="<?php echo set_value('email'); ?>">
                            </div>


                            <div class="col-sm-12 form-group">
                                <label>Forma de Pagt</label>
                                <select class="form-control select2" id="pagt" name="pagt">

                                    <option>Dinheiro</option>
                                    <option>Cartão Crédito</option>
                                    <option>Cartão de Débito</option>
                                </select>
                            </div>

                            <div class="col-sm-12 form-group">
                                <label>Total da compra:</label>
                                <input type="text" value="<?php echo $total ?>" readonly="true" class="form-control" id="email" name="email" placeholder="Data do pagamento" value="<?php echo set_value('email'); ?>">
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
</div>

<script src="../assets/js/jquery/jquery-2.2.3.min.js"></script>
<script src="../assets/js/bootstrap/bootstrap.min.js"></script>
<script src="../assets/datatables/jquery.dataTables.min.js"></script>
<script src="../assets/datatables/dataTables.bootstrap.min.js"></script>