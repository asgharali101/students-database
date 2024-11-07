<?php
session_start();
// $password =  password_hash($POst['passsword'], PASSWORD_DEFAULT);
require_once './database_connection.php';
require_once './helpers.php';

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->query("SELECT * from users WHERE email = '$email'");
    $result = $stmt->fetch(PDO::FETCH_OBJ);

    if (is_object($result) && $result->id) {
        if (password_verify($password, $result->password)) {
            $_SESSION['auth_user'] = [
                'name' => $result->name,
                'email' => $result->email,
            ];

            header('location: index.php');
        }
    }

    $errors['email'] = 'Login failed!';
}

?>
<form method="post">
    <input type="text" name="email" required id=""><br>
    <?php error('email'); ?>

    <input type="password" name="password" required id=""><br>
    <button type="submit">Login</button>
</form>