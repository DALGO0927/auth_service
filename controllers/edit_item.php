<?php
session_start();
include 'database/connection.php';

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM menu_items WHERE id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();
$item = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Actualizar en la base de datos
    $stmt = $conn->prepare("UPDATE menu_items SET name = :name, description = :description, price = :price WHERE id = :id");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    header('Location: admin_panel.php');
}
?>

<?php include 'templates/header.php'; ?>
<div class="container">
    <h2>Editar Elemento</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $item['name']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea class="form-control" id="description" name="description" required><?php echo $item['description']; ?></textarea>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Precio</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price" value="<?php echo $item['price']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>
</div>
<?php include 'templates/footer.php'; ?>
