<?php
include "../services/controller.php";

require_once "../models/employee.php";
require_once "../models/student.php";
require_once "../models/program.php";


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


if (isset($_GET["field"])) {
    $field = $_GET["field"];
    $search = $_GET["search"];

    $completedStudies = array_filter($completedStudies, function ($study) use ($field, $search) {
        return strpos($study->program->$field, $search) !== false;
    });
}

if (isset($_GET["dates"])) {
    $dates = $_GET["dates"]; // is one date either the start or the end 
    $search = $_GET["search"];

    $completedStudies = array_filter($completedStudies, function ($study) use ($dates, $search) {
        return $study->program->$dates == $search;
    });
}




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
        <button type="submit" class="bg-slate-500 text-white py-2 px-4 rounded-md">اختيار</button>
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
<div class="px-4 py-8 w-full overflow-hidden">
    <div class="flex items-start space-x-4">
        <h2 class="text-lg font-bold mb-4">تعيين البرامج</h2>
        <a href="./assign.php<?= isset($_GET["student"]) ? "?student=" . $student->id : "?employee=" . $employee->id ?>" class="bg-green-500 block text-white py-1 px-2 rounded-md">Add</a>
    </div>

    <div class="flex items-end my-4 justify-around">
        <form action="./trainingHistory.php" method="GET" class="rounded-md border-2 border-blue-300 ring-blue-500 focus-within:ring-2 overflow-hidden flex flex-col">
            <input type="hidden" name="<?= isset($_GET['student']) ? "student" : "employee" ?>" value="<?= isset($_GET['student']) ? $_GET['student'] : $_GET['employee'] ?>">
            <select name="field" class="px-4 py-1 outline-none">
                <option value="name">اسم البرنامج</option>
                <option value="institution_name">المؤسسة</option>
                <option value="location">الموقع</option>
            </select>
            <div class="flex items-center">
                <input type="text" name="search" class="outline-none bg-blue-100 px-4 text-right py-1 block" placeholder="Search">
                <button type="submit" class="  bg-slate-500 text-white px-4 py-1 block">Search</button>
            </div>
        </form>


        <form action="./trainingHistory.php" method="GET" class="rounded-md border-2 border-blue-300 ring-blue-500 focus-within:ring-2 overflow-hidden flex flex-col">
            <input type="hidden" name="<?= isset($_GET['student']) ? "student" : "employee" ?>" value="<?= isset($_GET['student']) ? $_GET['student'] : $_GET['employee'] ?>">
            <select name="dates" class="px-4 py-1 outline-none">

                <option value="start">من تاريخ</option>
                <option value="end">الى تاريخ</option>
            </select>
            <div class="flex items-center">
                <input type="date" name="search" class="outline-none bg-blue-100 px-4 text-right py-1 block" placeholder="Search">
                <button type="submit" class="  bg-slate-500 text-white px-4 py-1 block">Search</button>

            </div>
        </form>
    </div>

    <div class="overflow-x-auto w-full">

        <table class="bg-white  border border-gray-300 rounded-md shadow">

            <thead>
                <tr class="bg-gray-200">
                    <th class=" whitespace-nowrap py-2 px-4">ID</th>
                    <th class=" whitespace-nowrap py-2 px-4">اسم البرامج</th>
                    <th class=" whitespace-nowrap py-2 px-4">المؤسسة</th>
                    <th class=" whitespace-nowrap py-2 px-4">خارجي او داخلي</th>
                    <th class=" whitespace-nowrap py-2 px-4">الموقع</th>
                    <th class=" whitespace-nowrap py-2 px-4">عدد الساعات</th>
                    <th class=" whitespace-nowrap py-2 px-4">عدد الايام</th>
                    <th class=" whitespace-nowrap py-2 px-4"> من تاريخ </th>
                    <th class=" whitespace-nowrap py-2 px-4">الى تاريخ</th>
                    <th class=" whitespace-nowrap py-2 px-4"></th>
                    <th class=" whitespace-nowrap py-2 px-4"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($completedStudies as $study) : ?>

                    <tr>
                        <td class="whitespace-nowrap py-2 px-4"><?= $study->program->id ?></td>
                        <td class="whitespace-nowrap py-2 px-4"><?= $study->program->name ?></td>
                        <td class="whitespace-nowrap py-2 px-4"><?= $study->program->institution_name ?></td>
                        <td class="whitespace-nowrap py-2 px-4"><?= $study->program->internal_or_external ?></td>
                        <td class="whitespace-nowrap py-2 px-4"><?= $study->program->location ?></td>
                        <td class="whitespace-nowrap py-2 px-4"><?= $study->program->number_of_hours ?></td>
                        <td class="whitespace-nowrap py-2 px-4"><?= $study->program->number_of_days ?></td>
                        <td class="whitespace-nowrap py-2 px-4"><?= $study->program->start ?></td>
                        <td class="whitespace-nowrap py-2 px-4"><?= $study->program->end ?></td>

                        <?php if (isset($_GET["employee"])) : ?>
                            <td class="whitespace-nowrap py-2 px-4">
                                <a href="./uploadNaming.php?employee=<?= $_GET["employee"] ?>" class="bg-slate-500 text-white py-1 px-2 rounded-md">كتاب التسمية</a>
                            </td>
                        <?php endif; ?>
                        <td class="whitespace-nowrap py-2 px-4">
                            <a href="../uploads/<?= $study->id ?>.pdf" class="bg-slate-500 text-white py-1 px-2 rounded-md">الشهادة</a>
                        </td>
                    </tr>
                <?php endforeach; ?>


            </tbody>
        </table>
    </div>

</div>
</div>
</body>

</html>