<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centered Form</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f3f4f6;
            /* Light gray background */
        }
    </style>
</head>

<body>

    <?php
    require_once('database_connection.php');
    require_once('helpers.php');

    $classesstmt = $conn->query("SELECT * FROM classes ORDER BY id DESC");
    $classes = $classesstmt->fetchAll(pdo::FETCH_ASSOC);

    $teachersstmt = $conn->query("SELECT * FROM teachers ORDER BY id DESC");
    $teachers = $teachersstmt->fetchAll(pdo::FETCH_ASSOC);

    $subjectsstmt = $conn->query("SELECT * FROM subjects ORDER BY id DESC");
    $subjects = $subjectsstmt->fetchAll(pdo::FETCH_ASSOC);



    // exit;

    if (isset($_POST["name"])) {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $surname = $_POST["surname"];
        $class_id = $_POST["class_id"];
        $teacher_id = $_POST["teacher_id"];
        $subject_id = $_POST["subject_id"];

        $nameCount = $conn->query("SELECT * from students where name='$name'");
        $nameResult = $nameCount->fetch(PDO::FETCH_OBJ);

        if ($nameResult->name > 0) {
            $errors["name"] = "name already be used try another name";
        }

        if (strlen($name) >= 20) {
            $errors["name"] = "name must be less than 20 characters";
        }

        $emailstmt = $conn->query("SELECT count(*) as email_count FROM students WHERE  email='$email'");
        $emailResult = $emailstmt->fetch(PDO::FETCH_OBJ);

        if ($emailResult->email_count > 0) {
            $errors["email"] = "email already be used try another email";
        }

        if (strlen($email) >= 30) {
            $errors["email"] = "email must be less than 30 characters";
        }

        $surnamestmt = $conn->query("SELECT count(*) as surname_count FROM students WHERE surname='$surname'");
        $surnameResult = $surnamestmt->fetch(PDO::FETCH_OBJ);

        if ($surnameResult->surname_count > 0) {
            $errors["surname"] = "surname already be used try another email";
        }

        if (strlen($surname) >= 30) {
            $errors["surname"] = "surname must be less than 30 characters";
        }


        $classIds = array_column($classes, "id");
        if (! in_array($_POST["class_id"], $classIds)) {
            $errors["class_id"] = "unknow class try to added";
        }

        // print_r($_POST["class_id"]);
        // print_r($classIds);
        // exit;


        $teacherIds = array_column($teachers, "id");
        if (! in_array($_POST["teacher_id"], $teacherIds)) {
            $errors["teacher_id"] = "unknow teacher try to added";
        }

        $subjectsIds = array_column($subjects, "id");
        if (! in_array($_POST["subject_id"], $subjectsIds)) {
            $errors["subjects_id"] = "unknow subject try to added";
        }


        if (count($errors) === 0) {
            $addedStudentsRow = $conn->exec("INSERT INTO students(name,email,surname,class_id,teacher_id,subject_id) VALUES('$name','$email','$surname',$class_id,$teacher_id,$subject_id)");
            if ($addedStudentsRow > 0) {
                header('location:index.php');
            } else {
                echo "invalid data";
            }
        }
    }



    ?>


    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md mx-auto">
        <form method="post" class="space-y-4">
            <h2 class="text-2xl font-semibold text-center mb-6">Add Student</h2>

            <!-- Name Input -->
            <div>
                <input type="text" name="name" placeholder="Name" value="<?php old('name') ?>"
                    class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <?php error("name"); ?>
            </div>

            <!-- Email Input -->
            <div>
                <input type="text" name="email" placeholder="Email" value="<?php old('email') ?>"
                    class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <?php error("email"); ?>
            </div>

            <!-- Surname Input -->
            <div>
                <input type="text" name="surname" placeholder="Surname" value="<?php old('surname') ?>"
                    class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <?php error("surname"); ?>
            </div>

            <!-- Class Selection -->
            <div>
                <select name="class_id" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">Select Class</option>
                    <?php foreach ($classes as $class) { ?>
                        <option value="<?php echo $class["id"]; ?>"><?php echo $class["name"] ?></option>
                    <?php } ?>
                </select>
                <?php error("class_id"); ?>
            </div>

            <!-- Teacher Selection -->
            <div>
                <select name="teacher_id" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">Select Teacher</option>
                    <?php foreach ($teachers as $teacher) { ?>
                        <option value="<?php echo $teacher["id"]; ?>"><?php echo $teacher["name"] ?></option>
                    <?php } ?>
                </select>
                <?php error("teacher_id"); ?>
            </div>

            <!-- Subject Selection -->
            <div>
                <select name="subject_id" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Select Subject</option>
                    <?php foreach ($subjects as $subject) { ?>
                        <option value="<?php echo $subject["id"]; ?>"><?php echo $subject["name"] ?></option>
                    <?php } ?>
                </select>
                <?php error("subject_id"); ?>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">Submit</button>
        </form>
    </div>

</body>

</html>