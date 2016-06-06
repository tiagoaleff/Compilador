<?php

class AnalyzerLexoController
{
    private $model;
    private $textFile;

    public function __construct()
    {
        include "../model/AnalyzerLexoModel.php";
        include "../model/ReadFileModel.php";

        $this->file = new ReadFileModel();
        $this->textFile = $this->file->readFile();
        $this->model = new AnalyzerLexoModel();
    }

    public function getResult()
    {
        return $this->model->run($this->textFile);
    }
}
