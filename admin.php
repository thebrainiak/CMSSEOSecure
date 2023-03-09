<?php
session_start();

require_once('config.php');

$ip_address = $_SERVER['REMOTE_ADDR'];
if ($ip_address === '::1') {
    $ip_address = 'localhost';
}

ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_reporting(E_ALL);

// Obtener el país del visitante
$country = "Unknown";
try {
    $country = file_get_contents('http://ipinfo.io/'.$_SERVER['REMOTE_ADDR'].'/country');
} catch(Exception $e) {
    // No hacer nada si falla la obtención del país
}

$country = file_get_contents("http://ipinfo.io/{$ip_address}/country");
$visit_time = date('Y-m-d H:i:s');
$insert_query = "INSERT INTO visitors (ip_address, country, visit_time) VALUES ('$ip_address', '$country', '$visit_time')";
mysqli_query($conexion, $insert_query);

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
}

// Obtener las últimas 10 visitas
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 10;
$offset = ($page - 1) * $limit;
$query_visitors = "SELECT * FROM visitors ORDER BY visit_time DESC LIMIT $limit OFFSET $offset";
$result_visitors = mysqli_query($conexion, $query_visitors);
$visitors = mysqli_fetch_all($result_visitors, MYSQLI_ASSOC);

$query_users = "SELECT username, email, role FROM users";
$result_users = mysqli_query($conexion, $query_users);
$users = mysqli_fetch_all($result_users, MYSQLI_ASSOC);

$query_posts = "SELECT id, title, link FROM posts";
$result_posts = mysqli_query($conexion, $query_posts);
$posts = mysqli_fetch_all($result_posts, MYSQLI_ASSOC);


$query_users = "SELECT username, email, role FROM users";
$result_users = mysqli_query($conexion, $query_users);
$users = mysqli_fetch_all($result_users, MYSQLI_ASSOC);

$query_posts = "SELECT id, title, link FROM posts";
$result_posts = mysqli_query($conexion, $query_posts);
$posts = mysqli_fetch_all($result_posts, MYSQLI_ASSOC);



?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Panel de administración</title>
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
            <div class="col-md-8">
                <h1>Bienvenido, <?php echo $_SESSION['email']; ?>.</h1>
            </div>
            <div class="col-md-4 text-right">
                <a href="new.php" class="btn btn-primary">Crear nuevo artículo</a>
                <a href="logout.php" class="btn btn-danger">Cerrar Sesión</a>

            </div>
        </div>
        <hr>
        <h2>Usuarios registrados:</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nombre de usuario</th>
                    <th>Email</th>
                    <th>Rol</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo $user['username']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td><?php echo $user['role']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <hr>
        <h2>Artículos del blog:</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Enlace</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($posts as $post): ?>
                    <tr>
                        <td><?php echo $post['title']; ?></td>
                        <td><?php echo $post['link']; ?></td>
                        <td>
                            <a href="edit.php?link=<?php echo $post['link']; ?>" class="btn btn-primary">Editar</a>
							<a href="<?php echo $post['link']; ?>" class="btn btn-primary" target="_blank">Ver</a>
                            <a href="delete.php?link=<?php echo $post_id; ?>" class="btn btn-danger" target="_blank">Eliminar</a>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
		<hr>

		<h2>Últimos accesos al panel:</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>IP</th>
                <th>País</th>
                <th>Hora de la visita</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($visitors as $visitor): ?>
                <tr>
                    <td><?php echo $visitor['ip_address']; ?></td>
                    <td><?php echo $visitor['country']; ?></td>
                    <td><?php echo $visitor['visit_time']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <hr>
</table>
    </div>
</body>
</html>
