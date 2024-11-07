<?php

require_once '../database_connection.php';
$id = $_GET["id"];
$subjectsInRow = $conn->exec("DELETE FROM subjects  WHERE id =$id");
header("location:subjects-list.php");
