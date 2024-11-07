<?php

require_once './database_connection.php';

$id = $_GET['id'];

$numberOfRowsDeleted = $conn->exec("DELETE from students WHERE id = $id");

if ($numberOfRowsDeleted > 0) {
    header('location: index.php');
} else {
    echo 'Could not delete student';
}
