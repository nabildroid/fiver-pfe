<?php
include "../services/controller.php";

include "../models/employee.php";

require_once "../models/student.php";

$employees = Employee::getAll($db);


if (isset($_GET["remove"])) {
    $employee = Employee::get($_GET["remove"], $db);

    if(!$employee){
        header("Location: /");
        exit();
    }
    $student = Student::fromEmployee($employee, $db);

    $student->delete($db);
    $employee->delete($db);

    header("Location: /");
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

<h1 class="text-3xl text-center font-bold text-gray-800 mb-4">Human Resources</h1>

<div class="flex flex-col mt-8 overflow-hidden">
    <div class="w-full mb-4">
        <div class="flex justify-end items-end p-4">

            <div>
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    <a href="addEmployee.php">Add Employee</a>
            </div>
            <div class="flex-1"></div>
           
        </div>

        <div class="overflow-x-auto">
            <table class="w-full table-auto">
                <thead class="text-left">
                    <tr>
                        <th class="px-4 py-2 shrink-0">ID</th>
                        <th class="px-4 py-2 shrink-0">Name</th>
                        <th class="px-4 py-2 shrink-0">National ID</th>
                        <th class="px-4 py-2 shrink-0">Birthday</th>
                        <th class="px-4 py-2 shrink-0">Qualification</th>
                        <th class="px-4 py-2 shrink-0">Type</th>
                        <th class="px-4 py-2 shrink-0">Degree</th>
                        <th class="px-4 py-2 shrink-0">Year in Degree</th>
                        <th class="px-4 py-2 shrink-0">Professional Name</th>
                        <th class="px-4 py-2 shrink-0">Directory</th>
                        <th class="px-4 py-2 shrink-0">Section</th>
                        <th class="px-4 py-2 shrink-0">Type of Degree</th>
                        <th class="px-4 py-2 shrink-0"></th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($employees as $employee) { ?>

                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= $employee->id ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"> <?= $employee->first_name ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"> <?= $employee->nationID ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"> <?= $employee->birthday ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"> <?= $employee->educational_qualification ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"> <?= $employee->Promotion ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"> <?= $employee->job_grade ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"> <?= $employee->year_grade ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"> <?= $employee->job_title ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"> <?= $employee->directorate ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"> <?= $employee->department ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"> <?= $employee->job_title ?></td>

                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <a href="./trainingHistory.php?employee=<?= $employee->id ?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">All Programs</a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <a href="./trainingPlanning.php?employee=<?= $employee->id ?>" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Current Programs</a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <a href="./addEmployee.php?edit=<?= $employee->id ?>" class="bg-red-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Edit</a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <a href="./rh.php?remove=<?= $employee->id ?>" class="bg-red-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Delete</a>
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