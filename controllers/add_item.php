<?php
session_start();
include 'database/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Subir imagen
    $image = $_FILES['image']['name'];
    $target = "assets/images/" . basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'], $target);

    // Insertar en la base de datos
    $stmt = $conn->prepare("INSERT INTO menu_items (name, description, price, image) VALUES (:name, :description, :price, :image)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':image', $image);
    $stmt->execute();

    header('Location: admin_panel.php');
}
?>

<?php include 'templates/header.php'; ?>
<div class="container">
    <h2>Agregar Nuevo Elemento</h2>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Precio</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Imagen</label>
            <input type="file" class="form-control" id="image" name="image" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
<?php include 'templates/footer.php'; ?>
