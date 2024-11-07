<?php
require_once('database_connection.php');
require_once('helpers.php');
session_start();
if (isset($_POST["email"])) {
    $email = $_POST["email"] ?? null;
    $password = $_POST["password"] ?? null;

    $emailVal = $conn->query("SELECT * FROM login WHERE email='$email'");
    $emailResult = $emailVal->fetch(PDO::FETCH_OBJ);

    if ($emailResult  && password_verify($password, $emailResult->password)) {
        $_SESSION["authentic_user"] = [
            'name' => $emailResult->name,
            'email' => $emailResult->password,
        ];
        header("location:index.php");
    } else {
        $errors["email"] = "incorrect password OR email";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Login</h2>

        <?php if (isset($errors["email"])): ?>
            <div class="text-red-600 mb-4 text-center"><?php echo $errors["email"]; ?></div>
        <?php endif; ?>

        <form method="post" class="space-y-4">
            <input type="email" name="email" placeholder="Enter email" required
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">

            <input type="password" name="password" placeholder="Enter password" required
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">

            <input type="submit" value="Login"
                class="w-full py-2 bg-blue-500 text-white font-semibold rounded-md hover:bg-blue-600 transition duration-200 cursor-pointer">
        </form>
    </div>
</body>

</html>