<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}


include 'database/connection.php';

// Verificar si el usuario está autenticado y es admin
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit();
}

// Obtener los elementos del menú
$stmt = $conn->query("SELECT * FROM menu_items");
$menu_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include 'templates/header.php'; ?>
<div class="container">
    <h2>Panel de Administración</h2>
    <a href="add_item.php" class="btn btn-success mb-3">Agregar Nuevo Elemento</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($menu_items as $item): ?>
            <tr>
                <td><?php echo $item['id']; ?></td>
                <td><?php echo $item['name']; ?></td>
                <td><?php echo $item['description']; ?></td>
                <td>$<?php echo $item['price']; ?></td>
                <td>
                    <a href="edit_item.php?id=<?php echo $item['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                    <a href="delete_item.php?id=<?php echo $item['id']; ?>" class="btn btn-danger btn-sm">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php include 'templates/footer.php'; ?>
