<?php

include_once 'header/header.php'; ?>

    <div class="container">
        <h1>Compilador</h1>
        <hr>
        <form action="../controller/FileController.php" method="post">
            <div>
                <textarea name="texto" class="form-control custom-control" rows="10"><?php echo (!empty($file) ? ($file) : '');  ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary center">Compilar</button>
        </form>
    </div>

<?php include 'footer/footer.php';?>