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

<h1 class="text-3xl text-center font-bold text-gray-800 mb-4">Trainees</h1>

<div class="flex flex-col mt-8 overflow-hidden">
    <div class="w-full mb-4">
        <div class="flex justify-end items-end p-4">

            <div>
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    <a href="addTrainee.php">Add Trainee</a>
                </button>
            </div>
            <div class="flex-1"></div>
            
        </div>

        <div class="overflow-x-auto">
            <table class="w-full table-auto">
                <thead class="text-left">
                    <tr>
                        <th class="px-4 py-2 shrink-0">ID</th>
                        <th class="px-4 py-2 shrink-0">Name</th>
                        <th class="px-4 py-2 shrink-0">university</th>
                        <th class="px-4 py-2 shrink-0">email</th>
                        <th class="px-4 py-2 shrink-0">department</th>
                        <th class="px-4 py-2 shrink-0">specialization</th>

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


                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <a href="./trainingHistory.php?student=<?= $student->id ?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">All Programs</a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <a href="./trainingPlanning.php?student=<?= $student->id ?>" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Current Programs</a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <a href="./addTrainee.php?edit=<?= $student->id ?>" class="bg-red-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Edit</a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <a href="./rhTrainee.php?remove=<?= $student->id ?>" class="bg-red-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Delete</a>
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