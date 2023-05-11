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

if (!$student) {
    header("Location: /");
    exit();
}

$allStudies = $student->getStudies($db);

$completedStudies = array_filter($allStudies, function ($study) {
    return $study->year != date("Y") || $study->isDone == "1";
});


$people = Student::getAll($db);

// iterate over people["employee"] an people["student"] and create a new array with the following structure: id,name
$people = array_map(function ($person) {
    return [
        "id" => $person->id,
        "name" => $person->first_name . " " . $person->last_name
    ];
}, array_merge(isset($_GET["student"]) ? [] : $people["employees"], $people["students"]));

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RH</title>
    <?= Head(); ?>
</head>


<?= skeleton(); ?>
<div class="pb-8 px-4 py-8 bg-slate-200">
    <h1 class="text-2xl font-bold mb-4">Training History</h1>
    <form method="GET" class="flex items-end mb-4">
        <div class="mr-4">
            <label for="student" class="font-medium">Student:</label>
            <select id="student" name="<?= isset($_GET['student']) ? "student" : "employee" ?>" class="block w-64 py-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
                <?php foreach ($people as $person) : ?>
                    <option selected="<?= $person["id"] == $student->id ? "true" : "false" ?>" value="<?= $person["id"] ?>"><?= $person["name"] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md">Select</button>
    </form>
    <div>
        <h2 class="text-lg font-bold mb-2">Student Information</h2>

        <?php if (isset($_GET['student'])) : ?>
            <p><span class="font-medium">Name:</span> <?= $student->first_name ?></p>
            <p><span class="font-medium">Student ID:</span> <?= $student->id ?></p>
            <p><span class="font-medium">Job Title:</span> <?= $student->university ?></p>
            <p><span class="font-medium">Directorate:</span> <?= $student->directorate ?></p>
            <p><span class="font-medium">Department:</span> Development</p>
        <?php endif; ?>

        <?php if (!isset($_GET['student'])) : ?>

            <p><span class="font-medium">Name:</span> <?= $employee->first_name ?></p>
            <p><span class="font-medium">Job Title:</span> <?= $employee->job_title ?></p>
            <p><span class="font-medium">Directorate:</span> <?= $employee->directorate ?></p>
            <p><span class="font-medium">Department:</span> Development</p>
        <?php endif; ?>

    </div>
</div>
<div class="px-4 py-8">
    <div class="flex items-start space-x-4">
        <h2 class="text-lg font-bold mb-4">Program Assignment</h2>
        <a href="./assign.php<?= isset($_GET["student"]) ? "?student=" . $student->id : "?employee=" . $employee->id ?>" class="bg-green-500 block text-white py-1 px-2 rounded-md">Add</a>

    </div>
    <table class="w-full bg-white border border-gray-300 rounded-md">

        <thead>
            <tr class="bg-gray-200">
                <th class="py-2 px-4">ID</th>
                <th class="py-2 px-4">Name</th>
                <th class="py-2 px-4">Institution</th>
                <th class="py-2 px-4">Internal/External</th>
                <th class="py-2 px-4">location</th>
                <th class="py-2 px-4">number of hours</th>
                <th class="py-2 px-4">number of days</th>
                <th class="py-2 px-4"></th>
                <th class="py-2 px-4"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($completedStudies as $study) : ?>

                <tr>
                    <td class="py-2 px-4"><?= $study->program->id ?></td>
                    <td class="py-2 px-4"><?= $study->program->name ?></td>
                    <td class="py-2 px-4"><?= $study->program->institution_name ?></td>
                    <td class="py-2 px-4"><?= $study->program->internal_or_external ?></td>
                    <td class="py-2 px-4"><?= $study->program->location ?></td>
                    <td class="py-2 px-4"><?= $study->program->number_of_hours ?></td>
                    <td class="py-2 px-4"><?= $study->program->number_of_days ?></td>
                    <td class="py-2 px-4">
                        <button class="bg-blue-500 text-white py-1 px-2 rounded-md">Naming Book</button>
                    </td>
                    <td class="py-2 px-4">
                        <a href="../uploads/<?= $study->id ?>.pdf" class="bg-blue-500 text-white py-1 px-2 rounded-md">Certification</a>
                    </td>
                </tr>
            <?php endforeach; ?>


        </tbody>
    </table>

</div>
</div>
</body>

</html>