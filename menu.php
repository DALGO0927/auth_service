<?php include 'templates/header.php'; ?>
<div class="container mt-5">
    <h2 class="text-center">Nuestro Menú</h2>
    <div class="row mt-4">
        <?php
        include 'database/connection.php';
        $stmt = $conn->query("SELECT * FROM menu_items");
        $menu_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($menu_items as $item):
        ?>
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="assets/images/<?php echo $item['image']; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($item['name']); ?>">
                <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($item['name']); ?></h5>
                    <p class="card-text"><?php echo htmlspecialchars($item['description']); ?></p>
                    <p class="card-text"><strong>$<?php echo $item['price']; ?></strong></p>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<?php include 'templates/footer.php'; ?>
