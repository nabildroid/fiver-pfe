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



$allStudies = $student->getStudies($db);

// filter out studies that is not for this year
$studies = array_filter($allStudies, function ($study) {
    return $study->year == date("Y") && ($study->isDone == "0" || $study->isDone == null);
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
    <h1 class="text-2xl font-bold mb-4">جدولة البرامج</h1>
    <form method="GET" class="flex items-end mb-4">
        <div class="mr-4">
            <label for="student" class="font-medium">المتدرب:</label>
            <select id="student" name="<?= isset($_GET['student']) ? "student" : "employee" ?>" class="block w-64 py-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
                <?php foreach ($people as $person) : ?>
                    <option selected="<?= $person["id"] == $student->id ? "true" : "false" ?>" value="<?= $person["id"] ?>"><?= $person["name"] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md">اختيار</button>
    </form>
    <div>
        <h2 class="text-lg font-bold mb-2">بيانات المتدرب</h2>

        <?php if (isset($_GET['student'])) : ?>
            <p><span class="font-medium">الاسم:</span> <?= $student->first_name ?></p>
            <p><span class="font-medium"> ID:</span> <?= $student->id ?></p>
            <p><span class="font-medium">الجامعة:</span> <?= $student->university ?></p>
            <p><span class="font-medium">المديرية:</span> <?= $student->directorate ?></p>
        <?php endif; ?>

        <?php if (!isset($_GET['student'])) : ?>

            <p><span class="font-medium">الاسم:</span> <?= $employee->first_name ?></p>
            <p><span class="font-medium">المهنة:</span> <?= $employee->job_title ?></p>
            <p><span class="font-medium">المديرية:</span> <?= $employee->directorate ?></p>
        <?php endif; ?>
    </div>
</div>
<div class="px-4 py-8">
    <div class="flex items-start space-x-4">
        <h2 class="text-lg font-bold mb-4">البرامج</h2>
        <a href="./assign.php<?= isset($_GET["student"]) ? "?student=" . $student->id : "?employee=" . $employee->id ?>" class="bg-green-500 block text-white py-1 px-2 rounded-md">اضافة</a>
    </div>
    <table class="w-full mb-4 text-left">
        <thead>
            <tr>
                <th class="py-2 px-4 bg-gray-200">اسم البرامج</th>
                <th class="py-2 px-4 bg-gray-200">اختياري</th>
                <th class="py-2 px-4 bg-gray-200"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($studies as $study) : ?>
                <tr>
                    <td class="py-2 px-4">
                        <h2 class="font-medium"><?= $study->program->name ?></h2>
                    </td>
                    <td class="py-2 px-4">
                        <input type="checkbox" name="optional" class="h-4 w-4" <?= $study->isOptional ? "checked" : "" ?>>
                    </td>
                    <td class="py-2 px-4">
                        <a href="uploadCertificat.php?study=<?= $study->id ?>" class="bg-green-500 text-white py-2 px-4 rounded-md">رفع الشهادة</a>
                    </td>
                    <td class="py-2 px-4">
                        <button class="bg-red-500 text-white py-2 px-4 rounded-md">حذف</button>
                    </td>
                </tr>
            <?php endforeach; ?>
            <!-- Additional rows can be added dynamically using JavaScript -->
        </tbody>
    </table>
</div>
</div>
</body>

</html>