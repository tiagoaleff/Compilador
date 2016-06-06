<?php

/**
 * Created by PhpStorm.
 * User: tiagoaleff
 * Date: 18/04/16
 * Time: 18:19
 */
class FileController
{
    public function saveText()
    {
        if (isset($_POST['texto'])) {

            file_put_contents('../file/code.txt', $_POST['texto']);
            header('Location:../view/result.php');

        }
    }
}

$file = new FileController();
$file->saveText();
