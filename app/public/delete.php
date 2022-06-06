<?php

$pdo = require '../database/database.php';

$id = $_GET['id'] ?? null;

$statement = $pdo->prepare('DELETE FROM champions WHERE id = :id');
$statement->bindValue(':id', $id);
$statement->execute();

header('Location: list.php');