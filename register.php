<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de usuarios</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+hkLQ9j8a/6jKvS+qzVxerxuJc+nW4YK4jLi9R" crossorigin="anonymous">
    <style>
        body {
            background-color: #f5f5f5;
        }
        .card {
            margin-top: 50px;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>Registro de usuarios</h2>
            </div>
            <div class="card-body">
                <?php
                require_once('config.php');

                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $username = mysqli_real_escape_string($conexion, $_POST['username']);
                    $email = mysqli_real_escape_string($conexion, $_POST['email']);
                    $password = mysqli_real_escape_string($conexion, $_POST['password']);

                    // Generar salt aleatoria
                    $salt = bin2hex(random_bytes(32));

                    // Hash de la contraseña con SHA3 y la salt
                    $hashed_password = hash('sha3-512', $password . $salt);

                    // Insertar usuario en la base de datos
                    $query = "INSERT INTO users (username, email, password, salt, role)
                              VALUES ('$username', '$email', '$hashed_password', '$salt', 'user')";

                    if (mysqli_query($conexion, $query)) {
                        echo '<div class="alert alert-success" role="alert">Registro completado correctamente.</div>';
                    } else {
                        echo '<div class="alert alert-danger" role="alert">Error al registrar usuario.</div>';
                    }
                }
                ?>
                <form method="post" action="">
                    <div class="form-group">
                        <label for="username">Nombre de usuario:</label>
                        <input type="text" class="form-control" name="username" id="username" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Contraseña:</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Registrar</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

