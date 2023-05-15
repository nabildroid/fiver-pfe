<?php
include "../services/controller.php";

include "../models/employee.php";
include "../models/trainer.php";
include "../models/student.php";
include "../models/program.php";




$trainer = new Trainer($user->trainer, "");
$students = Student::getAllByTrainer($trainer, $db);



$programs = Program::getByTrainer($trainer, $db);


$noPrograms = false;

if (empty($programs)) {
    $noPrograms = true;
} else {
    $program = $programs[0];
}




?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>trainees</title>
    <?= Head(); ?>
</head>


<?= skeleton(); ?>

<h1 class="text-3xl text-center font-bold text-gray-800 mb-4">الملتحقين بالدورات التدريبية</h1>


<?php if ($noPrograms) { ?>
    <div class="flex justify-center items-center h-64">
        <div class="text-center">
            <h1 class="text-3xl text-gray-800 font-bold mb-4">لا يوجد برامج او متدربيين</h1>
            <p class="text-gray-600">ليس لديك تمدربيين الان.</p>
        </div>
    </div>
<?php } else { ?>
    <div class="flex flex-col mt-8 overflow-hidden">
        <div class="w-full mb-4">
            

            <div class="overflow-x-auto">
                <table class="w-full table-auto">
                    <thead class="text-left">
                        <tr>
                            <th class="whitespace-nowrap px-4 py-2 shrink-0">ID</th>
                            <th class="whitespace-nowrap px-4 py-2 shrink-0">الاسم</th>
                            <th class="whitespace-nowrap px-4 py-2 shrink-0">الجامعة</th>
                            <th class="whitespace-nowrap px-4 py-2 shrink-0">البريد الاليكتوني</th>
                            <th class="whitespace-nowrap px-4 py-2 shrink-0">القسم</th>
                            <th class="whitespace-nowrap px-4 py-2 shrink-0">التخصص</th>

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
                                    <a href="./trainingHistory.php?student=<?= $student->id ?>" class="bg-slate-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">جميع البرامج</a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <a href="./trainingPlanning.php?student=<?= $student->id ?>" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">البرنامج الحالية</a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <a href="./addTrainee.php?edit=<?= $student->id ?>" class="bg-red-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">تعديل</a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <button class="bg-red-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">حذف</button>
                                </td>
                            </tr>
                        <?php } ?>




                    </tbody>
                </table>
            </div>

        </div>
    </div>
<?php } ?>