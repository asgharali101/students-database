<?php

require_once '../database_connection.php';
$id = $_GET["id"];
if (isset($_POST["teacher_id"])) {
    $teachers_id = $_POST["teacher_id"] ?? null;

    $teachersInRow = $conn->exec("UPDATE teachers set name='$teachers_id'  WHERE id =$id");
    header("location:teacher_list.php");
}


// $teacherstmt = $conn->query("SELECT * from teachers");
// $teachers = $teacherstmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $conn->query("select * from teachers WHERE id =$id");
$currentteacher = $stmt->fetch(PDO::FETCH_ASSOC);


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
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Edit Teacher</h2>

        <form method="post" class="space-y-4">
            <input type="text" name="teacher_id" value="<?php echo $currentteacher["name"] ?>" placeholder="Enter class name" required
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">

            <input type="submit" value="Add Teacher"
                class="w-full py-2 bg-blue-500 text-white font-semibold rounded-md hover:bg-blue-600 transition duration-200 cursor-pointer">
        </form>
    </div>

</body>

</html>