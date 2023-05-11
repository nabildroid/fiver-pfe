<?php
include "../services/controller.php";

require "../models/employee.php";
require "../models/student.php";
require "../models/program.php";

if (!isset($_GET['employee']) && !isset($_GET['student'])) {
    header("Location: /");
    exit();
}



if (isset($_GET['student'])) {
    $student = Student::get($_GET['student'], $db);
} else {

    $employee = Employee::get($_GET['employee'], $db);
    $student = Student::fromEmployee($employee, $db);
}

$programs = Program::getAll($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($programs as $program) {
        if (isset($_POST[$program->id])) {
            $student->assignTo($program, $db, false, date("Y"));
            header("Location: profile.php");
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile <?= isset($_GET["student"]) ? $student->first_name : $employee->first_name ?></title>
    <?= Head(); ?>
</head>


<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Assign Student to Program</h1>

        <div class="bg-white p-6 rounded-md shadow-md mb-4">
            <h2 class="text-lg font-bold mb-2">Student Information</h2>

            <?php if (isset($_GET["student"])) : ?>
                <div class="flex flex-col">
                    <span class="mb-2"><strong>Name:</strong> <?php echo $student->first_name; ?></span>
                    <span class="mb-2"><strong>university:</strong> <?php echo $student->university; ?></span>
                    <span class="mb-2"><strong>Major:</strong> Computer Science</span>
                </div>
            <?php endif; ?>

            <?php if (isset($_GET["employee"])) : ?>
                <div class="flex flex-col">
                    <span class="mb-2"><strong>Name:</strong> <?php echo $employee->first_name; ?></span>
                    <span class="mb-2"><strong>Student ID:</strong> <?php echo $employee->nationID; ?></span>
                    <span class="mb-2"><strong>Major:</strong> Computer Science</span>
                </div>
            <?php endif; ?>

        </div>

        <form method="POST" class="bg-white p-6 rounded-md shadow-md">
            <h2 class="text-lg font-bold mb-2">Programs</h2>
            <ul>
                <?php foreach ($programs as $program) : ?>

                    <li class="flex items-center justify-between py-2">
                        <span class="mr-4">Program ID: <?= $program->id ?></span>
                        <span class="mr-4">Program Title: <?= $program->name ?></span>
                        <button type="submit" name="<?= $program->id ?>" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">Assign</button>
                    </li>
                <?php endforeach; ?>

            </ul>
        </form>
    </div>
</body>

</html>