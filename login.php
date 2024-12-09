<?php
session_start();
include 'database/connection.php';

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Buscar el usuario en la base de datos
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Credenciales válidas
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        // Redirigir según el rol del usuario
        if ($user['role'] == 'admin') {
            header('Location: admin_panel.php');
        } else {
            header('Location: menu.php');
        }
        exit();
    } else {
        $error = "Usuario o contraseña incorrectos";
    }
}
?>

<?php include 'templates/header.php'; ?>
<div class="container">
    <h2>Iniciar Sesión</h2>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    <form method="POST">
        <div class="mb-3">
            <label for="username" class="form-label">Usuario</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
    </form>
</div>
<?php include 'templates/footer.php'; ?>

