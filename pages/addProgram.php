<?php
include "../services/controller.php";


require_once '../models/program.php';
require_once '../models/trainer.php';




$trainers = Trainer::getAll($db);

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Create a new Program object
    $program = new Program();

    // Set the values of the program properties
    $program->setName($_POST['programName'])
        ->setType($_POST['programType'])
        ->setInstitution($_POST['institutionName'])
        ->setInternalOrExternal($_POST['internalOrExternal'])
        ->setLocation($_POST['location'])
        ->setNumberOfHours($_POST['numberOfHours'])
        ->setNumberOfDays($_POST['numberOfDays'])
        ->setEnd($_POST['end'])
        ->setStart($_POST['start']);




    $trainer = new Trainer($_POST['trainerID'], "");

    $program->insert($trainer, $db);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>new Program</title>
    <?= Head(); ?>
</head>

<?= skeleton(); ?>
<form method="POST" class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-8">اضافة برنامج</h1>

    <div class="grid grid-cols-2 gap-6">
        <div class="col-span-2 md:col-span-1">
            <div class="bg-white p-6 rounded-md shadow-md">
                <div class="mb-4">
                    <label for="programName" class="block text-gray-700 font-medium mb-2">اسم البرنامج:</label>
                    <input type="text" id="programName" name="programName" class="border border-gray-300 rounded-md py-2 px-4 focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="programType" class="block text-gray-700 font-medium mb-2">نوع البرنامج:</label>
                    <input type="text" id="programType" name="programType" class="border border-gray-300 rounded-md py-2 px-4 focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="institutionName" class="block text-gray-700 font-medium mb-2">اسم المؤسسة:</label>
                    <input type="text" id="institutionName" name="institutionName" class="border border-gray-300 rounded-md py-2 px-4 focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="internalOrExternal" class="block text-gray-700 font-medium mb-2">خارجي او داخلي:</label>
                    <select id="internalOrExternal" name="internalOrExternal" class="border border-gray-300 rounded-md py-2 px-4 focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
                        <option value="Internal">Internal</option>
                        <option value="External">External</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-span-2 md:col-span-1">
            <div class="bg-white p-6 rounded-md shadow-md">
                <div class="mb-4">
                    <label for="location" class="block text-gray-700 font-medium mb-2">الموقع:</label>
                    <input type="text" id="location" name="location" class="border border-gray-300 rounded-md py-2 px-4 focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="numberOfHours" class="block text-gray-700 font-medium mb-2">عدد الساعات</label>
                    <input type="number" id="numberOfHours" name="numberOfHours" class="border border-gray-300 rounded-md py-2 px-4 focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="numberOfDays" class="block text-gray-700 font-medium mb-2">عدد الايام:</label>
                    <input type="number" id="numberOfDays" name="numberOfDays" class="border border-gray-300 rounded-md py-2 px-4 focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="numberOfDays" class="block text-gray-700 font-medium mb-2">يبدأ من:</label>
                    <input type="date" id="numberOfDays" name="start" class="border border-gray-300 rounded-md py-2 px-4 focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="numberOfDays" class="block text-gray-700 font-medium mb-2">ينتهي عند:</label>
                    <input type="date" id="numberOfDays" name="end" class="border border-gray-300 rounded-md py-2 px-4 focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
                </div>


                <div class="mb-4">
                    <label for="trainer" class="block text-gray-700 font-medium mb-2">المدرب</label>
                    <select id="trainer" name="trainerID" class="border border-gray-300 rounded-md py-2 px-4 focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
                        <?php foreach ($trainers as $trainer) : ?>
                            <option value="<?= $trainer->id ?>"><?= $trainer->name ?></option>
                        <?php endforeach; ?>
                    </select>


                </div>

            </div>
        </div>
    </div>

    <div class="flex justify-end mt-6">
        <button type="submit" class="bg-slate-500 text-white py-2 px-4 rounded-md">حفظ</button>
    </div>
</form>
</body>