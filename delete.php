<?php
// Iniciar sesión
session_start();

// Incluir el archivo de configuración de la base de datos
require_once 'config.php';

// Verificar si hay una sesión iniciada
if (!isset($_SESSION['email'])) {
  // No hay sesión iniciada, redirigir al usuario a la página de inicio de sesión
  header('Location: login.php');
  exit();
}

// Obtener el ID del artículo a eliminar
if (!isset($_GET['id'])) {
  // Si no se ha proporcionado un ID, redirigir al usuario a la página de inicio
  header('Location: index.php');
  exit();
}
$post_id = $_GET['id'];

// Obtener el artículo de la base de datos
$stmt = $conexion->prepare('SELECT * FROM posts WHERE id = :id');
$stmt->execute(['id' => $post_id]);
$post = $stmt->fetch();

// Verificar si el artículo existe
if (!$post) {
  // Si el artículo no existe, redirigir al usuario a la página de inicio
  header('Location: index.php');
  exit();
}

// Eliminar el artículo de la base de datos
$stmt = $conexion->prepare('DELETE FROM posts WHERE id = :id');
$stmt->execute(['id' => $post_id]);

// Eliminar el archivo HTML correspondiente
$filename = $post['link'] . '.html';
if (file_exists($filename)) {
    unlink($filename);
}

// Redirigir al usuario a la página de inicio
header('Location: admin.php');
exit();
?>
