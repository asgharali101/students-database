<?php

require_once '../database_connection.php';
$id = $_GET["id"];
$subjectsInRow = $conn->exec("DELETE FROM classes  WHERE id =$id");
header("location:class-list.php");
