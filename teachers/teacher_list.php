<?php
$conn = new PDO("mysql:host=localhost;dbname=students", 'root', '');

$stmt = $conn->query("SELECT subjects.*, teachers.name as teacher_name FROM subjects LEFT JOIN teachers ON subjects.teacher_id = teachers.id ORDER BY subjects.id DESC");
$subjects = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subjects List</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-200 p-8">

    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Subjects List</h1>

        <div class="flex justify-between mb-6">
            <a href="add-subjects.php" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 transition duration-200">Add Subjects</a>
            <a href="../index.php" class="bg-purple-500 text-white px-4 py-2 rounded-md hover:bg-purple-600 transition duration-200">Home Page</a>
        </div>

        <table class="min-w-full bg-white border border-gray-200 rounded-lg overflow-hidden shadow-md">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="py-3 px-4 text-left">ID</th>
                    <th class="py-3 px-4 text-left">Subject Name</th>
                    <th class="py-3 px-4 text-left">Teacher</th>
                    <th class="py-3 px-4 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($subjects as $subject) { ?>
                    <tr class="border-b border-gray-200 hover:bg-gray-100 transition duration-200">
                        <td class="py-3 px-4"><?php echo $subject['id'] ?></td>
                        <td class="py-3 px-4"><?php echo $subject['name'] ?></td>
                        <td class="py-3 px-4"><?php echo $subject["teacher_name"] ?></td>
                        <td class="py-3 px-4">
                            <a href="edit.php?id=<?php echo $subject['id'] ?>" class="text-blue-500 hover:text-blue-700 mr-4 transition duration-200">Edit</a>
                            <a href="delete.php?id=<?php echo $subject['id'] ?>" class="text-red-500 hover:text-red-700 transition duration-200">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</body>

</html>