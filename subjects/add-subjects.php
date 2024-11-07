<?php

require_once '../database_connection.php';
if (isset($_POST["submit"])) {
    $subjects = $_POST["subjectsName"] ?? null;
    $selectTeacher = $_POST["teacher_id"] ?? null;

    $subjectsInRow = $conn->exec("INSERT into subjects(name,teacher_id) VALUES('$subjects','$selectTeacher')");
    header("location:subjects-list.php");
}

$stmt = $conn->query('SELECT id, name from teachers');
$teachers = $stmt->fetchAll(PDO::FETCH_ASSOC);





?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Subject</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md mx-auto">
        <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Add New Subject</h1>

        <form method="post" class="space-y-4">
            <div>
                <label for="subjectsName" class="block text-gray-700 font-semibold mb-2">Subject Name</label>
                <input type="text" name="subjectsName" id="subjectsName" placeholder="Enter subject name"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="teacher_id" class="block text-gray-700 font-semibold mb-2">Select Teacher</label>
                <select name="teacher_id" id="teacher_id"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Select Teacher</option>
                    <?php foreach ($teachers as $teacher) { ?>
                        <option value="<?php echo $teacher["id"] ?? null ?>">
                            <?php echo $teacher["name"] ?? null; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="text-center">
                <button type="submit" name="submit"
                    class="w-full bg-blue-500 text-white py-2 rounded-md font-semibold hover:bg-blue-600 transition duration-200">
                    Submit
                </button>
            </div>
        </form>
    </div>
</body>

</html>