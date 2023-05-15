<?php
include "../services/controller.php";

include "../models/employee.php";
include "../models/student.php";





if (isset($_GET["remove"])) {
    $student = Student::get($_GET["remove"], $db);

    $student->delete($db);

    header("Location: /");
}


$students = Student::getAll($db)["students"];




if (isset($_GET["field"]) && isset($_GET["search"])) {
    $field = $_GET["field"];
    $search = $_GET["search"];

    $students = array_filter($students, function ($student) use ($field, $search) {
        return strpos($student->$field, $search) !== false;
    });
}

// get the Study and Program models for each student by calling student getStudies
$students = array_map(function ($student) use ($db) {
    $student->study = $student->getStudies($db)[0] ?? null;
    return $student;
}, $students);


if (isset($_GET["dates"])) {
    $dates = $_GET["dates"]; // is one date either the start or the end 
    $search = $_GET["search"];

    $students = array_filter($students, function ($student) use ($dates, $search) {
        if (!$student->study) return false;
        return $student->study->program->$dates == $search;
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

<h1 class="text-3xl text-center font-bold text-gray-800 mb-4">تدريب حديثي التخرج وطلاب الجامعات</h1>

<div class="flex flex-col mt-8 overflow-hidden">
    <div class="w-full mb-4">
        <div class="flex justify-end items-end p-4">

            <div>
                <button class="bg-slate-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    <a href="addTrainee.php">اضف متدرب</a>
                </button>
            </div>
            <div class="flex-1"></div>

        </div>

        <div class="flex items-end my-4 justify-around">
            <form action="./rhTrainee.php" method="GET" class="rounded-md border-2 border-blue-300 ring-blue-500 focus-within:ring-2 overflow-hidden flex flex-col">
                <select name="field" class="px-4 py-1 outline-none">
                    <option value="name">الاسم</option>
                    <option value="university">الجهة الشريكة</option>
                </select>
                <div class="flex items-center">
                    <input type="text" name="search" class="outline-none bg-blue-100 px-4 text-right py-1 block" placeholder="Search">
                    <button type="submit" class="  bg-slate-500 text-white px-4 py-1 block">Search</button>
                </div>
            </form>


            <form action="./rhTrainee.php" method="GET" class="rounded-md border-2 border-blue-300 ring-blue-500 focus-within:ring-2 overflow-hidden flex flex-col">
                <select name="dates" class="px-4 py-1 outline-none">
                    <option value="start">تاريخ بدأ التدريب</option>
                </select>
                <div class="flex items-center">
                    <input type="date" name="search" class="outline-none bg-blue-100 px-4 text-right py-1 block" placeholder="Search">
                    <button type="submit" class="  bg-slate-500 text-white px-4 py-1 block">Search</button>

                </div>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full table-auto">
                <thead class="text-left">
                    <tr>
                        <th class="whitespace-nowrap px-4 py-2 shrink-0">ID</th>
                        <th class="whitespace-nowrap px-4 py-2 shrink-0">الاسم</th>
                        <th class="whitespace-nowrap px-4 py-2 shrink-0">الجهة الشريكة</th>
                        <th class="whitespace-nowrap px-4 py-2 shrink-0">البريد الاليكتوني</th>
                        <th class="whitespace-nowrap px-4 py-2 shrink-0">القسم</th>
                        <th class="whitespace-nowrap px-4 py-2 shrink-0">التخصص</th>
                        <th class="whitespace-nowrap px-4 py-2 shrink-0">من </th>
                        <th class="whitespace-nowrap px-4 py-2 shrink-0">الى</th>

                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($students as $student) { ?>

                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= $student->id ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"> <?= $student->first_name ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"> <?= $student->university ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"> <?= $student->email ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"> <?= $student->department ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"> <?= $student->specialization ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"> <?= $student->study ? $student->study->program->start : "" ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"> <?= $student->study ? $student->study->program->end : "" ?></td>


                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <a href="./trainingHistory.php?student=<?= $student->id ?>" class="bg-slate-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">جميع البرامج</a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <a href="./trainingPlanning.php?student=<?= $student->id ?>" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">البرامج في الخطة</a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <a href="../uploads/<?= $student->id ?>.from.pdf" class="bg-slate-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">كتاب الجهة</a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <a href="../uploads/<?= $student->id ?>.accept.pdf" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">كتاب الموافقة</a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <a href="./addTrainee.php?edit=<?= $student->id ?>" class="bg-red-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">تعديل</a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <a href="./rhTrainee.php?remove=<?= $student->id ?>" class="bg-red-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">خذف</a>
                            </td>
                        </tr>
                    <?php } ?>




                </tbody>
            </table>
        </div>

        <!-- <div class="flex justify-end mt-4">
                <div class="inline-flex rounded-md shadow">
                    <a href="#" class="px-4 py-2 bg-white border border-gray-300 text-sm font-medium text-gray-700 hover:bg-gray-50">
                        Previous
                    </a>
                </div>
                <div class="inline-flex ml-3 rounded-md shadow">
                    <a href="#" class="px-4 py-2 bg-white border border-gray-300 text-sm font-medium text-gray-700 hover:bg-gray-50">
                        1
                    </a>
                </div>
                <div class="inline-flex ml-3 rounded-md shadow">
                    <a href="#" class="px-4 py-2 bg-white border border-gray-300 text-sm font-medium text-gray-700 hover:bg-gray-50">
                        2
                    </a>
                </div>
                <div class="inline-flex ml-3 rounded-md shadow">
                    <a href="#" class="px-4 py-2 bg-white border border-gray-300 text-sm font-medium text-gray-700 hover:bg-gray-50">
                        3
                    </a>
                </div>
                <div class="inline-flex ml-3 rounded-md shadow">
                    <a href="#" class="px-4 py-2 bg-white border border-gray-300 text-sm font-medium text-gray-700 hover:bg-gray-50">
                        Next
                    </a>
                </div>
            </div> -->
    </div>