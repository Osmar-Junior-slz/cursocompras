<div class="content-wrapper">
    <section class="content-header">
        <h1>Detalhes do curso</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Usu&aacute;rios</li>
            <li class="active">Informações do Curso</li>
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
                    <div class="box-body">
                        <form role="form" action="cadastrocarrinho" method="post" class="form-horizontal">
                            <div class="box-body">
                                <?php
                               
                                $categoria = '';
                                $nome_cursos = '';
                                $preco = '';
                                $url_imagem = '';

                                if (isset($resultadoUsuarioEspecifico)) {

                                    foreach ($resultadoUsuarioEspecifico as $user) {
                                        $id = $user->id;
                                        $nome_cursos = $user->nome_cursos;
                                        $categoria = $user->categoria;
                                        $preco = $user->preco;
                                        $url_imagem = $user->url_imagem;
                                    }
                                }
                                ?>
                                <div class="col-lg-2">
                                <img  width="100%" height="100%" src="<?php echo $url_imagem; ?>" >
                                </div>
                                <div class="col-lg-10">
                                    <div class="form-group">
                                        <label for="nome" class="col-sm-2 control-label">Nome</label>
                                        <input type="hidden" name="id" id="id" value="<?php echo set_value('id', $id); ?>" readonly="readonly">
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="nome_cursos" name="nome_cursos" readonly="true" placeholder="Informe do curso" value="<?php echo set_value('nome_cursos', $nome_cursos); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="categoria" class="col-sm-2 control-label">Categoria</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="categoria" readonly="true" name="categoria" value="<?php echo set_value('categoria', $categoria); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="preco" class="col-sm-2 control-label">Preço</label>

                                        <div class="col-sm-10">
                                            <input type="preco" class="form-control" id="preco" readonly="true" name="preco" placeholder="Informe o e-mail de contato" value="<?php echo set_value('preco', $preco); ?>">
                                        </div>

                                    </div>
                                    <div class="form-group">
                                    <div class="col-xs-12 col-sm-9 col-lg-2">&nbsp;</div>
                                    <div class="col-xs-12 col-sm-3 col-lg-3">
                                        <button type="submit" class="btn btn-primary" style="width: 100%">Adicionar no carrinho</button>
                                    </div>
                                </div>
                                </div>
                                
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="../assets/js/jquery/jquery-2.2.3.min.js"></script>