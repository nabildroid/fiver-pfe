<?php
include "../services/controller.php";

include "../models/employee.php";
include "../models/trainer.php";
include "../models/student.php";
include "../models/program.php";




$trainer = new Trainer($user->id, "");
$students = Student::getAllByTrainer($trainer, $db);



$program = Program::getByTrainer($trainer, $db)[0];
if (isset($_POST['note'])) {
    $program->note = $_POST['note'];
    $program->update($db);
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

<h1 class="text-3xl text-center font-bold text-gray-800 mb-4">Trainees</h1>

<div class="flex flex-col mt-8 overflow-hidden">
    <div class="w-full mb-4">
        <div class="flex justify-center items-end p-4">
            <form method="POST" class="w-full md:w-3/4 space-y-2">
                <label class="block font-semibold text-gray-600 mb-2">Course Note:</label>
                <textarea name="note" class="block w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 rounded shadow leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter course note"></textarea>
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save Note</button>
            </form>
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
                                <button class="bg-red-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                            </td>
                        </tr>
                    <?php } ?>




                </tbody>
            </table>
        </div>

    </div>