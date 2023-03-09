<?php
require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_real_escape_string($conexion, $_POST['email']);
    $password = mysqli_real_escape_string($conexion, $_POST['password']);

    // Obtener la salt del usuario a partir del email
    $query = "SELECT salt FROM users WHERE email='$email'";
    $result = mysqli_query($conexion, $query);
    $row = mysqli_fetch_assoc($result);
    $salt = $row['salt'];

    // Hash de la contraseña con SHA3 y la salt
    $hashed_password = hash('sha3-512', $password . $salt);

    // Comprobar si la contraseña coincide con la almacenada en la base de datos
    $query = "SELECT * FROM users WHERE email='$email' AND password='$hashed_password'";
    $result = mysqli_query($conexion, $query);
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        session_start();
        $_SESSION['email'] = $email;
        header("Location: admin.php");
    } else {
        echo "Email o contraseña incorrectos.";
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
          crossorigin="anonymous">
    <!-- CSS personalizado -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Iniciar Sesión</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="">
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña:</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Iniciar sesión" class="btn btn-primary btn-block">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-/5NjqoKTdNLpLvx6OzN0r4H+LkU5lW6E9LRiZzR5mvRdiBtRwE2QxvJjF3U6JbI6" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js" integrity="sha512-qW8B1LsGHsCJFv+70/hOw8MceG2bPzh28Tl7BNX+g8dJ0rMW1+d//H1E/cGAlwF+V7aK06A/6ex0o89ZQcLrmw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.2/js/bootstrap.min.js" integrity="sha512-A9XoJvQlAfeRHY/VmzZmFVyQkQ2bNUdCF5K5O5X9Xq3C/fpOgY0wDbwkNjz6YZbI6WTPr0c/2kf2/Y32+n/B/w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>
</html>