<?php
include "../services/controller.php";

include "../models/employee.php";

require_once "../models/student.php";

$employees = Employee::getAll($db);


if (isset($_GET["remove"])) {
    $employee = Employee::get($_GET["remove"], $db);

    if (!$employee) {
        header("Location: /");
        exit();
    }
    $student = Student::fromEmployee($employee, $db);

    $student->delete($db);
    $employee->delete($db);

    header("Location: /");
}


if (isset($_GET["field"]) && isset($_GET["search"])) {
    $field = $_GET["field"];
    $search = $_GET["search"];

    $employees = array_filter($employees, function ($employee) use ($field, $search) {
        return strpos($employee->$field, $search) !== false;
    });
}


if (isset($_GET["dates"])) {
    $dates = $_GET["dates"]; // is one date either the start or the end 
    $search = $_GET["search"];

    $employees = array_filter($employees, function ($employee) use ($dates, $search) {
        return $employee->$dates == $search;
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

<h1 class="text-3xl text-center font-bold text-gray-800 mb-4">الموظفين</h1>

<div class="flex flex-col mt-8 overflow-hidden">
    <div class="w-full mb-4">
        <div class="flex justify-end items-end p-4">

            <div>
                <button class="bg-slate-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    <a href="addEmployee.php">اضافة موظف</a>
            </div>
            <div class="flex-1"></div>

        </div>

        <div class="flex items-end my-4 justify-around">
            <form action="./rh.php" method="GET" class="rounded-md border-2 border-blue-300 ring-blue-500 focus-within:ring-2 overflow-hidden flex flex-col">
                <select name="field" class="px-4 py-1 outline-none">
                    <option value="first_name">الاسم</option>
                    <option value="directorate">المديرية</option>
                    <option value="Promotion">الدرجة</option>


                </select>
                <div class="flex items-center">
                    <input type="text" name="search" class="outline-none bg-blue-100 px-4 text-right py-1 block" placeholder="Search">
                    <button type="submit" class="  bg-slate-500 text-white px-4 py-1 block">Search</button>
                </div>
            </form>


            <form action="./rh.php" method="GET" class="rounded-md border-2 border-blue-300 ring-blue-500 focus-within:ring-2 overflow-hidden flex flex-col">
                <select name="dates" class="px-4 py-1 outline-none">
                    <option value="date_hire">تاريخ التعيين</option>
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
                        <th class="whitespace-nowrap px-4 py-2 shrink-0">الرقم الوطني</th>
                        <th class="whitespace-nowrap px-4 py-2 shrink-0">تاريخ الميلاد</th>
                        <th class="whitespace-nowrap px-4 py-2 shrink-0">تاريخ التعيين</th>
                        <th class="whitespace-nowrap px-4 py-2 shrink-0">المؤهلات</th>
                        <th class="whitespace-nowrap px-4 py-2 shrink-0">الفئة</th>
                        <th class="whitespace-nowrap px-4 py-2 shrink-0">الدرجة</th>
                        <th class="whitespace-nowrap px-4 py-2 shrink-0">عام الدرجة</th>
                        <th class="whitespace-nowrap px-4 py-2 shrink-0">المسمى الوظيفي</th>
                        <th class="whitespace-nowrap px-4 py-2 shrink-0">المديرية</th>
                        <th class="whitespace-nowrap px-4 py-2 shrink-0">القسم</th>
                        <th class="whitespace-nowrap px-4 py-2 shrink-0"></th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($employees as $employee) { ?>

                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= $employee->id ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"> <?= $employee->first_name ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"> <?= $employee->nationID ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"> <?= $employee->birthday ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"> <?= $employee->date_hire ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"> <?= $employee->educational_qualification ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"> <?= $employee->Promotion ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"> <?= $employee->job_grade ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"> <?= $employee->year_grade ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"> <?= $employee->job_title ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"> <?= $employee->directorate ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"> <?= $employee->department ?></td>

                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <a href="./trainingHistory.php?employee=<?= $employee->id ?>" class="bg-slate-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">جميع البرامج</a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <a href="./trainingPlanning.php?employee=<?= $employee->id ?>" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">البرامج في الخطة</a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <a href="./uploadNaming.php?employee=<?= $employee->id ?>" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">كتاب التسمية</a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <a href="./addEmployee.php?edit=<?= $employee->id ?>" class="bg-red-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">تعديل</a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <a href="./rh.php?remove=<?= $employee->id ?>" class="bg-red-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">حذف</a>
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