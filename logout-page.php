<?php
session_start();
if (isset($_SESSION["authentic_user"])) {
    unset($_SESSION["authentic_user"]);
    header("Location: index.php");
}
