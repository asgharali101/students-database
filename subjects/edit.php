<?php

require_once '../database_connection.php';

$id = $_GET["id"];

if (isset($_POST["name"])) {
    $name = $_POST["name"];
    $teacher_id = $_POST["teacher_id"];

    $subjectsInRow = $conn->exec("UPDATE subjects SET name='$name', teacher_id=$teacher_id WHERE id =$id");
    header("location:subjects-list.php");
}

$stmt = $conn->query('SELECT * FROM teachers');
$teachers = $stmt->fetchAll(PDO::FETCH_ASSOC);

$subjectstmt = $conn->query("SELECT * FROM subjects WHERE id = $id");
$currentSubject = $subjectstmt->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Subject</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md mx-auto">
        <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Edit Subject</h1>

        <form method="post" class="space-y-6">
            <div>
                <label for="name" class="block text-gray-700 font-semibold mb-2">Subject Name</label>
                <input type="text" name="name" id="name" value="<?= $currentSubject['name'] ?>"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="teacher_id" class="block text-gray-700 font-semibold mb-2">Select Teacher</label>
                <select name="teacher_id" id="teacher_id"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Select Teacher</option>
                    <?php foreach ($teachers as $teacher) { ?>
                        <option value="<?= $teacher['id'] ?>"
                            <?php if ($teacher['id'] === $currentSubject['teacher_id']) echo 'selected'; ?>>
                            <?= $teacher['name']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="text-center">
                <button type="submit"
                    class="w-full bg-blue-500 text-white py-2 rounded-md font-semibold hover:bg-blue-600 transition duration-200">
                    Submit
                </button>
            </div>
        </form>
    </div>
</body>

</html>