<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f3f4f6;
        }
    </style>
</head>

<body>

    <?php
    require_once './database_connection.php';

    $id = $_GET['id'];

    if (isset($_POST['name'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $surname = $_POST['surname'];
        $class_id = $_POST['class_id'];
        $teacher_id = $_POST["teacher_id"];
        $subject_id = $_POST["subject_id"];

        $id = $_POST['id'];

        $numberOfRowsUpdated = $conn->exec("UPDATE students SET name='$name', email='$email', surname='$surname', class_id = $class_id,teacher_id=$teacher_id,subject_id =$subject_id WHERE id = $id");

        if ($numberOfRowsUpdated > 0) {
            header('location:index.php');
        } else {
            echo 'Invalid data';
            exit;
        }
    }

    if (isset($_GET['id'])) {
        $stmt = $conn->query("SELECT * from students WHERE id = $id");
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    $stmt = $conn->query('SELECT * from classes');
    $classes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $teacherstmt = $conn->query("SELECT * from teachers");
    $teachers = $teacherstmt->fetchAll(PDO::FETCH_ASSOC);

    $subjectstmt = $conn->query("SELECT * from subjects");
    $subjects = $subjectstmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md mx-auto">
        <form method="post" class="space-y-4">
            <h2 class="text-2xl font-semibold text-center mb-6">Edit Student</h2>

            <!-- Hidden ID -->
            <input type="hidden" name="id" value="<?php echo $user['id'] ?>">

            <!-- Name Input -->
            <div>
                <input type="text" name="name" placeholder="Name" value="<?php echo $user['name'] ?>"
                    class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Email Input -->
            <div>
                <input type="email" name="email" placeholder="Email" value="<?php echo $user['email'] ?>"
                    class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Surname Input -->
            <div>
                <input type="text" name="surname" placeholder="Surname" value="<?php echo $user['surname'] ?>"
                    class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Class Selection -->
            <div>
                <select name="class_id" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option>Select Class</option>
                    <?php foreach ($classes as $class) { ?>
                        <option value="<?= $class['id'] ?>" <?= $user['class_id'] == $class['id'] ? 'selected' : '' ?>>
                            <?= $class['name'] ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <!-- Teacher Selection -->
            <div>
                <select name="teacher_id" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option>Select Teacher</option>
                    <?php foreach ($teachers as $teacher) { ?>
                        <option value="<?= $teacher['id'] ?>" <?= $user['teacher_id'] == $teacher['id'] ? 'selected' : '' ?>>
                            <?= $teacher['name'] ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <!-- Subject Selection -->
            <div>
                <select name="subject_id" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option>Select Subject</option>
                    <?php foreach ($subjects as $subject) { ?>
                        <option value="<?= $subject['id'] ?>" <?= $user['subject_id'] == $subject['id'] ? 'selected' : '' ?>>
                            <?= $subject['name'] ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">Save Changes</button>
        </form>
    </div>

</body>

</html>