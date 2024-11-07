<?php

require_once '../database_connection.php';
$id = $_GET["id"];
$subjectsInRow = $conn->exec("DELETE FROM teachers  WHERE id =$id");
header("location:teacher-list.php");
