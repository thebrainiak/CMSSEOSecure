<?php
// Verificar que se han enviado los datos del formulario
require_once('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Obtener los valores de los campos del formulario

  // Generar la URL del archivo HTML

  $title = $_POST["title"];
  $link = preg_replace('/[^a-zA-Z0-9]+/', '-', strtolower($title)) . '.html';
  $content = $_POST["content"];
  $description = $_POST["description"];
  $canonical = $_POST["canonical"];
  $locale = $_POST["locale"];
  $updated_time = date("c");
  $og_title = $_POST["og_title"];
  $og_description = $_POST["og_description"];
  $og_url = $_POST["og_url"];
  $og_site_name = $_POST["og_site_name"];
  $twitter_title = $_POST["twitter_title"];
  $twitter_description = $_POST["twitter_description"];
  $twitter_site = $_POST["twitter_site"];
  $twitter_creator = $_POST["twitter_creator"];
  $twitter_label1 = $_POST["twitter_label1"];
  $twitter_data1 = $_POST["twitter_data1"];
  $twitter_label2 = $_POST["twitter_label2"];
  $twitter_data2 = $_POST["twitter_data2"];
  $schema = $_POST["schema"];

  // Crear el contenido del archivo HTML
  $html_content = <<<EOD
<!DOCTYPE html>
<html>
<head>
  <title>$title</title>
  <meta name="description" content="$description">
  <meta name="robots" content="follow, index, max-snippet:-1, max-video-preview:-1, max-image-preview:large">
  <link rel="canonical" href="$canonical">
  <meta property="og:locale" content="$locale">
  <meta property="og:type" content="website">
  <meta property="og:title" content="$og_title">
  <meta property="og:description" content="$og_description">
  <meta property="og:url" content="$og_url">
  <meta property="og:site_name" content="$og_site_name">
  <meta property="og:updated_time" content="$updated_time" />
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="$twitter_title">
  <meta name="twitter:description" content="$twitter_description">
  <meta name="twitter:site" content="$twitter_site">
  <meta name="twitter:creator" content="$twitter_creator">
  <meta name="twitter:label1" content="$twitter_label1">
  <meta name="twitter:data1" content="$twitter_data1">
  <meta name="twitter:label2" content="$twitter_label2">
  <meta name="twitter:data2" content="$twitter_data2">
  <script type="application/ld+json" class="schema">$schema</script>
</head>
<body>
  <div class="container">
    <h1>$title</h1>
    <div class="content">$content</div>
  </div>
</body>
</html>
EOD;

  // Generar el nombre del archivo HTML
  $filename = preg_replace('/[^a-zA-Z0-9]+/', '-', strtolower($title)) . '.html';

  // Guardar el contenido en el archivo
  file_put_contents($filename, $html_content);

  $sql = "INSERT INTO posts (title, link) VALUES ('$title', '$link')";

  if (mysqli_query($conexion, $sql)) {
    // Redirigir al usuario al archivo generado
    header("Location: $link");
    exit();
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
  }

  // Cerrar la conexión a la base de datos
  mysqli_close($conexion);
} else {
  // Redirigir al usuario al formulario para generar un nuevo post
  header("Location: /dashboard/new_post.php");
  exit();
}

?>

