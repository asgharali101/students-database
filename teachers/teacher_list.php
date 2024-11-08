<?php
$conn = new PDO("mysql:host=localhost;dbname=students", 'root', '');

$stmt = $conn->query("SELECT teachers.*, teachers.name as teacher_name FROM subjects LEFT JOIN teachers ON subjects.teacher_id = teachers.id ORDER BY subjects.id DESC");
$teacherList = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subjects List</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 px-40 w-full  flex  justify-center">

    <div class="w-full">
        <!-- Buttons -->
        <div class="flex mb-6 space-x-6 flex justify-between">
            <a href="add-teachers.php" class="inline-block px-8 py-3 bg-gradient-to-r from-blue-500 to-blue-700 text-white text-lg font-semibold rounded-xl shadow-lg hover:from-blue-600 hover:to-blue-800 transition duration-300 transform hover:scale-105 min-w-max">
                Add Teacher
            </a>
            <a href="../index.php" class="inline-block px-8 py-3 bg-gradient-to-r from-gray-600 to-gray-800 text-white text-lg font-semibold rounded-xl shadow-lg hover:from-gray-700 hover:to-gray-900 transition duration-300 transform hover:scale-105 min-w-max">
                Home Page
            </a>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto bg-white rounded-lg shadow-lg">
            <table class="min-w-full table-auto border-collapse">
                <thead class="bg-gray-200 text-gray-800">
                    <tr>
                        <th class="py-3 px-6 text-left text-lg font-medium border-b border-gray-300">ID</th>
                        <th class="py-3 px-6 text-left text-lg font-medium border-b border-gray-300">Name</th>
                        <th class="py-3 px-6 text-left text-lg font-medium border-b border-gray-300">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    <?php foreach ($teacherList as $teacher) { ?>
                        <tr class="hover:bg-gray-50 border-b border-gray-200">
                            <td class="py-3 px-6"><?php echo $teacher['id'] ?></td>
                            <td class="py-3 px-6"><?php echo $teacher['teacher_name'] ?></td>
                            <td class="py-3 px-6">
                                <a href="edit.php?id=<?php echo $teacher['id'] ?>" class="inline-block px-4 py-2 text-sm text-white bg-green-500 rounded-lg hover:bg-green-600 transition duration-300">
                                    Edit
                                </a>
                                <a href="delete.php?id=<?php echo $teacher['id'] ?>" class="inline-block px-4 py-2 text-sm text-white bg-red-500 rounded-lg hover:bg-red-600 ml-4 transition duration-300">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>