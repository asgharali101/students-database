<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Data Page</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #eef2f3, #8e9eab);
        }
    </style>
</head>

<body class="flex flex-col items-center p-6 w-full">

    <?php

    session_start();
    require_once './database_connection.php';

    if (!isset($_SESSION['authentic_user'])) { ?>
        <h2>Please sign in or sign up</h2>
        <div style="display: flex; gap: 30px;">
            <a href="login-page.php" class="px-4 py-2 bg-blue-600 text-white rounded shadow hover:bg-blue-700 transition">Sign In</a>
            <a href="signup-page.php" class="px-4 py-2 bg-green-600 text-white rounded shadow hover:bg-green-700 transition">Sign Up</a>
        </div>
    <?php exit;
    }

    $searchBox = $_GET['search'] ?? '';
    $indexData = "
        SELECT students.*,
        classes.name AS class_name,
        teachers.name AS teacher_name,
        subjects.name AS subjects
        FROM students
        LEFT JOIN classes ON students.class_id = classes.id
        LEFT JOIN teachers ON students.teacher_id = teachers.id
        LEFT JOIN subjects ON students.subject_id = subjects.id
    ";

    if (! empty($searchBox)) {
        $indexData .= "WHERE students.name like '%$searchBox%' OR
     students.surname like '%$searchBox%' OR
     students.email like '%$searchBox%' OR
     students.teacher_id like '%$searchBox%' OR
     students.class_id like '%$searchBox%' OR
     students.subject_id like '%$searchBox%'";
    }
    $indexData .= " ORDER BY students.id DESC";
    $stmt = $conn->query($indexData);
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    ?>

    <div class="flex items-center space-x-10 w-full">
        <div class="flex space-x-2 w-full">
            <a href="add.php" class="px-4 py-2 bg-blue-500 text-white rounded shadow hover:bg-blue-600 transition">Add User</a>
            <a href="./classes/class-list.php" class="px-4 py-2 bg-green-500 text-white rounded shadow hover:bg-green-600 transition">Add Class</a>
            <a href="./teachers/teacher_list.php" class="px-4 py-2 bg-purple-500 text-white rounded shadow hover:bg-purple-600 transition">Teachers</a>
            <a href="./subjects/subjects-list.php" class="px-4 py-2 bg-yellow-500 text-white rounded shadow hover:bg-yellow-600 transition">Subjects</a>
            <a href="./school.php" class="px-4 py-2 bg-pink-500 text-white rounded shadow hover:bg-pink-600 transition">Add School</a>
        </div>
        <form class="flex my-4 w-full">
            <input type="search" name="search" placeholder="Search..."
                class="w-full border border-gray-300 rounded-full px-4 py-2 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 hover:ring-2 hover:ring-blue-400 transition">
            <input type="submit" value="Search"
                class="ml-2 px-4 py-2 bg-blue-500 text-white rounded shadow hover:bg-blue-600 transition">
        </form>
        <a href="logout-page.php" class="px-4 py-2 bg-red-500 text-white rounded shadow hover:bg-red-600 transition">Logout</a>
    </div>

    <div class="w-full  bg-gray-100 rounded-lg shadow-lg">
        <table class="w-full border-collapse table-fixed">
            <thead class="bg-gradient-to-r from-gray-600 to-gray-800 text-white text-lg font-semibold">
                <tr>
                    <th class="w-4 py-4 px-6 border-b text-center">ID</th>
                    <th class="w-1/4 py-4 px-6 border-b text-left">Name</th>
                    <th class="w-1/4 py-4 px-6 border-b text-left">Email</th>
                    <th class="w-1/6 py-4 px-6 border-b text-left">Surname</th>
                    <th class="w-1/6 py-4 px-6 border-b text-left">Class</th>
                    <th class="w-1/5 py-4 px-6 border-b text-left">Teacher</th>
                    <th class="w-1/6 py-4 px-6 border-b text-left">Subjects</th>
                    <th class="w-1/5 py-4 px-6 border-b text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-800 text-sm font-medium">
                <?php foreach ($users as $user) { ?>
                    <tr class="bg-white hover:bg-gray-50 transition-all border-b">
                        <td class="py-3 px-6 text-center"><?php echo $user['id']; ?></td>
                        <td class="py-3 px-6"><?php echo $user['name']; ?></td>
                        <td class="py-3 px-6"><?php echo $user['email']; ?></td>
                        <td class="py-3 px-6"><?php echo $user['surname']; ?></td>
                        <td class="py-3 px-6"><?php echo $user['class_name']; ?></td>
                        <td class="py-3 px-6"><?php echo $user['teacher_name']; ?></td>
                        <td class="py-3 px-6"><?php echo $user['subjects']; ?></td>
                        <td class="py-3 px-6 text-center flex items-center justify-center">
                            <a href="edit.php?id=<?php echo $user['id']; ?>"
                                class="px-4 py-1 bg-green-500 text-white rounded shadow hover:bg-green-600 transition">
                                Edit
                            </a>
                            <a href="delete.php?id=<?php echo $user['id']; ?>"
                                class="px-4 py-1 bg-red-500 text-white rounded shadow hover:bg-red-600 transition ml-2">
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