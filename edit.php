<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
}

require_once('config.php');

if (isset($_GET['link'])) {
    $link = $_GET['link'];

    // Cargar el contenido del archivo HTML del artículo
    $article_file = $link;
    if (!file_exists($article_file)) {
        echo "El archivo no existe.";
        exit();
    }
    $article_content = file_get_contents($article_file);
} else {
    echo "El enlace no se proporcionó.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Actualizar el contenido del archivo HTML del artículo
    $new_content = $_POST['content'];
    file_put_contents($article_file, $new_content);

    // Actualizar la entrada del artículo en la base de datos
    $sql = "UPDATE posts SET updated_at = NOW() WHERE link = '$link'";
    mysqli_query($conexion, $sql);

    // Actualizar la meta etiqueta og_updated_time en el archivo HTML del artículo
    $og_updated_time = date("Y-m-d\TH:i:s\Z");
    $article_html = file_get_contents($article_file);
    $article_html = preg_replace('/<meta property="og:updated_time" content=".*" \/>/', '<meta property="og:updated_time" content="' . $og_updated_time . '" />', $article_html);
    file_put_contents($article_file, $article_html);

    header("Location: admin.php");
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Editar artículo</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        body {
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Editar artículo</h1>
                <form method="POST">
                    <div class="form-group">
                        <textarea class="form-control" name="content" rows="10"><?php echo $article_content; ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    <a href="admin.php" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
