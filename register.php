<?php include 'templates/header.php'; ?>
<div class="container">
    <h2>Registro</h2>
    <form method="POST" action="controllers/register_controller.php">
        <div class="mb-3">
            <label for="username" class="form-label">Usuario</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Registrar</button>
    </form>
</div>
<?php include 'templates/footer.php'; ?>
