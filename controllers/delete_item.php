<?php
session_start();
include 'database/connection.php';

$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM menu_items WHERE id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();

header('Location: admin_panel.php');
?>
