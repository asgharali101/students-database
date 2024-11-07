<?php

require_once './database_connection.php';
require_once './helpers.php';

$stmt = $conn->query('SELECT * from classes');
$classes = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $surname = $_POST['surname'];
    $class_id = $_POST['class_id'];
    $teacher_id = $_POST["teacher_id"];
    $subject_id = $_POST["subject_id"];

    $stmt = $conn->query("SELECT COUNT(*) as students_count from students WHERE email = '$email'");
    $result = $stmt->fetch(PDO::FETCH_OBJ);



    if ($result->students_count > 0) {
        $errors['email'] = 'Email is already taken';
    }
    if (strlen($email) > 20) {
        $errors['email'] = 'email can not be greater than 20 characters.';
    }

    if (strlen($surname) > 20) {
        $errors['surname'] = 'Surname can not be greater than 20 characters.';
    }



    $classIds = array_column($classes, 'id');
    if (! in_array($_POST['class_id'], $classIds)) {
        $errors['class_id'] = 'Class does not exist.';
    }

    if (count($errors) === 0) {
        $numberOfRowsAdded = $conn->exec("INSERT into students (name, email, surname, class_id, teacher_id,subject_id) VALUES ('$name', '$email', '$surname', $class_id,$teacher_id,$subject_id)");

        if ($numberOfRowsAdded > 0) {
            header('location:index.php');
        } else {
            echo 'Invalid data';
            exit;
        }
    }
}



$teacherstmt = $conn->query("SELECT * from teachers");
$teachers = $teacherstmt->fetchAll(PDO::FETCH_ASSOC);

$subjectstmt = $conn->query("SELECT * from subjects");
$subjects = $subjectstmt->fetchAll(PDO::FETCH_ASSOC);
?>
<style>
    p {
        margin: 0;
        padding: 0;
    }
</style>
<form method="post">
    <input type="text" name="name" placeholder="name" value="<?php old('name') ?>" id=""><br>
    <input type="text" name="email" placeholder="email" id="" value="<?php old('email') ?>"><br>
    <?php error('email') ?>
    <input type="text" name="surname" placeholder="surname" id="" value="<?php old('surname') ?>"><br>
    <?php error('surname') ?>
    <select name="class_id" required>
        <optio value="">Select Class</optio>
        <?php foreach ($classes as $class) { ?>
            <option value="<?= $class['id'] ?>">
                <?= $class['name'] ?>
            </option>
        <?php } ?>
    </select><br>
    <?php error('class_id') ?>

    <select name="teacher_id" required>
        <option value="">Select Teacher</option>
        <?php foreach ($teachers as $teacher) { ?>
            <option value="<?php echo $teacher["id"]; ?>">
                <?php echo $teacher["name"]; ?>
            </option>
        <?php } ?>
    </select>

    <select name="subject_id">
        <option>Select subjects</option>
        <?php foreach ($subjects as $subject) { ?>
            <option value="<?php echo $subject["id"]; ?>">
                <?php echo $subject["name"]; ?>
            </option>
        <?php } ?>
    </select>


    <button type="submit">Submit</button>
</form>