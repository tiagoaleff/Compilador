<?php include_once 'header/header.php'; ?>

    <div class="container">
    <h1>Resultado da Análise</h1>
    <a href="/Compilador/view/">Voltar</a>
    <hr>
    <div>
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Analisador Lexo</a></li>
            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Analisador Sintático</a></li>
            <li role="presentation"class="active"  ><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Analisador Semântico</a></li>
            <li role="presentation"><a href="#codefont" aria-controls="codefont" role="tab" data-toggle="tab">Código Fonte</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane" id="home">

                <table  border="0" class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Linha</th>
                        <th>Código</th>
                        <th>Entrada</th>
                        <th>Saída</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (!empty($resultLexo)) :
                        foreach ($resultLexo as $value) : ?>
                            <tr>
                                <td><?php echo $value->getLine(); ?></td>
                                <td><?php echo $value->getCode(); ?></td>
                                <td><?php echo $value->getText(); ?></td>
                                <td><?php echo $value->getNote(); ?></td>
                            </tr>
                            <?php
                        endforeach;
                    endif; ?>
                </table>
            </div>

            <div role="tabpanel" class="tab-pane" id="profile">

                <?php if (!empty($errorMessage)) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $errorMessage; ?>
                    </div>
                <?php endif; ?>
                <table  border="0" class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Status da Pilha</th>
                        <th>Valores na Pilha</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (!empty($resultSintatico)) :
                        foreach ($resultSintatico as $value) : ?>
                            <tr>
                                <td><?php echo $value->getStatus(); ?></td>
                                <td><?php echo $value->getArrayStack(); ?></td>
                            </tr>
                            <?php
                        endforeach;
                    endif; ?>
                </table>

            </div>

            <div role="tabpanel" class="tab-pane active" id="messages">

                <table  border="0" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nome Variavel</th>
                            <th>Categoria</th>
                            <th>Nivel</th>
                            <th>Aritmetico</th>
                            <th>Quantidade de parametros</th>

                        </tr>
                    </thead>
                    <tbody>
                    <?php



                    if (!empty($resultSemantic)) :
                        foreach ($resultSemantic as $value) : ?>
                            <tr>
                                <td><?php echo $value->getNameVariable(); ?></td>
                                <td><?php echo $value->getCategory();//$category [$value->getCategory()]; ?></td>
                                <td><?php echo $value->getLevel(); ?></td>
                                <td><?php echo ($value->getAritmetico() == false ? 'false' : 'true'); ?></td>
                                <td><?php echo $value->getCountParameters(); ?></td>
                            </tr>
                            <?php
                        endforeach;
                    endif; ?>
                </table>
                <?php if (!empty($resultErrorSemantic)) :
                    foreach ($resultErrorSemantic as $value) : ?>

                    <div class="alert alert-danger" role="alert">
                        <?php echo $value; ?>
                    </div>

                        <?php
                    endforeach;
                endif; ?>


            </div>
            <div role="tabpanel" class="tab-pane" id="settings">...</div>

            <div role="tabpanel" class="tab-pane" id="codefont">
                <div>
                    <textarea name="texto" class="form-control custom-control" rows="10" disabled><?php echo (!empty($file) ? ($file) : '');  ?></textarea>
                </div>
            </div>



        </div>
        <input type="submit" class="btn btn-primary center" value="Voltar" onclick="location.href='index.php'">
    </div>
<?php include 'footer/footer.php';?>