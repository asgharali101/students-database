<?php
$conn = new PDO('mysql:host=localhost;dbname=students', 'root', '');

if (isset($_POST["school"])) {
    $school = $_POST["school"];
    $teachers = $_POST["teacher_id"];
    $students_id = $_POST["student_id"];
    // $new = $conn->query('SELECT schools.*,classes.name as class_name from schools LEFT JOIN classes ON schools.class_id=classes.id');
    $addschools = $conn->exec("INSERT into schools(name,teacher_id,student_id) VALUES('$school',$teachers,$students_id)");
    header('location:school.php');
}
$teacherstmt = $conn->query("SELECT * from teachers");
$teachers = $teacherstmt->fetchAll(PDO::FETCH_ASSOC);

$schoolstmt = $conn->query("SELECT schools.*,
teachers.name as teacher_name,
 students.name as student_id
  FROM schools
   left JOIN teachers ON schools.teacher_id=teachers.id
   left JOIN students ON schools.student_id=students.id
    ORDER BY id DESC");
$schools = $schoolstmt->fetchAll(PDO::FETCH_ASSOC);

$studentsstmt = $conn->query("SELECT id,name FROM students");
$students = $studentsstmt->fetchAll(PDO::FETCH_ASSOC);

?>

<form method="post">
    <input type="text" name="school" id="">
    <select name="student_id">
        <option>Select students</option>
        <?php foreach ($students as $student) { ?>
            <option value="<?php echo $student["id"] ?>">
                <?php echo $student["name"] ?>
            </option>
        <?php } ?>
    </select>
    <select name="teacher_id">
        <option>Select Teacher</option>
        <?php foreach ($teachers as $teacher) { ?>
            <option value="<?php echo $teacher["id"]; ?>">
                <?php echo $teacher["name"]; ?>
            </option>
        <?php } ?>
    </select>
    <input type="submit">
</form>


<table border="1" width="100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>teachers</th>
            <th>student</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($schools as $schoolresult) { ?>
            <tr>
                <td><?php echo $schoolresult['id'] ?></td>
                <td><?php echo $schoolresult['name'] ?></td>
                <td><?php echo $schoolresult["teacher_name"] ?></td>
                <td><?php echo $schoolresult["student_id"] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>