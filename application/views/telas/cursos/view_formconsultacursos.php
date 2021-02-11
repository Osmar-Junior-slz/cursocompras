<div class="content-wrapper">
      <section class="content-header">
            <h1>Consultar cursos por nome</h1>
            <ol class="breadcrumb">
                  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li>Usu&aacute;rios</li>
                  <li class="active">Adicionar o curso no carrinho</li>
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
                                    <form role="form" method="post"
                                          class="form-horizontal">
                                          <div class="box-body">
                                            <?php 
                                            $nome = '';
                                            
                                            ?>
                                                <div class="form-group">
                                                      <label for="nome" class="col-sm-2 control-label">Nome</label>
                                                      <div class="col-sm-10">
                                                            <input type="text" class="form-control" id="nome" name="nome"
                                                                   placeholder="Informe o nome curso" value="<?php echo set_value('nome', $nome); ?>">
                                                      </div>
                                                </div>
                                          </div>
                                          <div class="form-group">
                                                <div class="col-xs-12 col-sm-9 col-lg-2">&nbsp;</div>
                                                <div class="col-xs-12 col-sm-3 col-lg-3">
                                                      <button type="submit" class="btn btn-primary"
                                                              style="width: 100%">Consultar</button>
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