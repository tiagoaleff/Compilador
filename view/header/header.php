<?php

include '../controller/AnalyzerSyntacticController.php';
include '../controller/CompiladorController.php';
include '../controller/AnalyzerLexoController.php';
include '../model/MatrizAnalizeSintatica.php';
include '../model/ProducaoCodificacaoModel.php';
include '../controller/OpenFileController.php';

$sysntactic = new AnalyzerSyntacticController();
$compilador = new CompiladorController();
$resultLexo = $compilador->getResultLexo();
$resultSintatico = $compilador->getResultSystactic();
$resultSemantic = $compilador->getSemantic();
$errorMessage = $compilador->getErrorMessage();
$file = new OpenFileController();
$file = $file->getFileString();


$resultErrorSemantic = $compilador->getErroSemantico();




?>

<?php

$teste = new MatrizAnalizeSintatica();



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Compilador</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/start.css">
</head>
<body>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Zeus</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="../download/manual.docx" >Ajuda</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>



