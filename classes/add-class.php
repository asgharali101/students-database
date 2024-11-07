<?php
require_once '../database_connection.php';

if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $numberOfRowsAdded = $conn->exec("INSERT into classes (name) VALUES ('$name')");
    if ($numberOfRowsAdded > 0) {
        header('location: class-list.php');
    } else {
        echo 'Invalid data';
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Class</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-sm bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Add Class</h2>

        <form method="post" class="space-y-4">
            <input type="text" name="name" placeholder="Enter class name" required
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">

            <input type="submit" value="Add Class"
                class="w-full py-2 bg-blue-500 text-white font-semibold rounded-md hover:bg-blue-600 transition duration-200 cursor-pointer">
        </form>
    </div>

</body>

</html>