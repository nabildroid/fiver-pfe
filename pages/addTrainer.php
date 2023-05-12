<?php
include "../services/controller.php";


require_once '../models/program.php';
require_once '../models/trainer.php';



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $trainer = new Trainer("", $_POST['name']);
    $trainer->insert($db);

    User::generateTrainer($trainer->name, $trainer->id, $db);
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
<h1 class="text-3xl font-bold text-center mb-4">اضافة مدرب</h1>

<div class="max-w-md mx-auto bg-white p-6 rounded shadow">
    <form method="POST">
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-semibold mb-2">الاسم</label>
            <input type="text" id="name" name="name" class="w-full border border-gray-400 px-4 py-2 rounded focus:outline-none focus:border-blue-500" required>
        </div>

        <div class="text-center">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">اضف مدرب</button>
        </div>
    </form>

</div>