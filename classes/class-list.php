<?php
require_once '../database_connection.php';

$stmt = $conn->query('SELECT * from classes ORDER BY id DESC');
$classes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class List</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-200 p-8">

    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Class List</h1>

        <div class="flex justify-between mb-6">
            <a href="add-class.php" class="bg-green-500 text-white px-6 py-3 rounded-md hover:bg-green-600 transition duration-200">Add Class</a>
            <a href="../index.php" class="bg-purple-500 text-white px-6 py-3 rounded-md hover:bg-purple-600 transition duration-200">Home Page</a>
        </div>

        <table class="min-w-full bg-white border border-gray-200 rounded-lg overflow-hidden shadow-md">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="py-3 px-4 text-left">ID</th>
                    <th class="py-3 px-4 text-left">Name</th>
                    <th class="py-3 px-4 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($classes as $class) { ?>
                    <tr class="border-b border-gray-200 hover:bg-gray-100 transition duration-200">
                        <td class="py-3 px-4"><?php echo $class['id'] ?></td>
                        <td class="py-3 px-4"><?php echo $class['name'] ?></td>
                        <td class="py-3 px-4">
                            <a href="edit.php?id=<?php echo $class['id'] ?>" class="text-blue-600 hover:text-blue-800 mr-4 transition duration-200">Edit</a>
                            <a href="delete.php?id=<?php echo $class['id'] ?>" class="text-red-600 hover:text-red-800 transition duration-200">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</body>

</html>