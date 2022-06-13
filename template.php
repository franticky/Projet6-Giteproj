<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>
        <?= $title ?>
    </title>
</head>
<body class="bg-danger">
    <header>
        <?php
            require_once "vues/sidebar.php";
        ?>
    </header>

            <div class="container">
                <h1></h1>
            <?= $content  ?>


    <!--$content est appelé et son contenu est dans le routeur index.php-->
    <!--chaque valeur de $content = appel d un fichier php-->
            </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>