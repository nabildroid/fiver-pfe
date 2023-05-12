<?php
include "../services/controller.php";

require "../models/employee.php";
require "../models/student.php";
require "../models/program.php";





$employee = Employee::get($user->employee, $db);

$student = Student::fromEmployee($employee, $db);

$allStudies = $student->getStudies($db);

$studies = array_filter($allStudies, function ($study) {
    return $study->year == date("Y") && ($study->isDone == "0" || $study->isDone == null);
});

$completedStudies = array_filter($allStudies, function ($study) {
    return $study->year != date("Y") || ($study->isDone == "1");
});

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile <?php echo $employee->first_name; ?></title>
    <?= Head(); ?>
</head>

<?= skeleton(); ?>
<!-- Employee ID -->
<h1 class="text-3xl font-bold text-gray-800 mb-4">رقم الموظف: <?php echo $employee->id; ?></h1>

<!-- Personal Information -->
<h2 class="text-2xl font-bold text-gray-800 mb-4">بيانات الشخصية</h2>

<div class="bg-white rounded-lg overflow-hidden shadow-md mb-8">
    <table class="w-full">
        <tbody>
            <tr>
                <td class="font-semibold p-2 border-b border-gray-200">الاسم</td>
                <td class="p-2 border-b border-gray-200"><?php echo $employee->first_name; ?></td>
            </tr>
            <tr>
                <td class="font-semibold p-2 border-b border-gray-200">اسم العائلة</td>
                <td class="p-2 border-b border-gray-200"><?php echo $employee->last_name; ?></td>
            </tr>
            <tr>
                <td class="font-semibold p-2 border-b border-gray-200">تعريف الوطني</td>
                <td class="p-2 border-b border-gray-200"><?php echo $employee->nationID; ?></td>
            </tr>
            <tr>
                <td class="font-semibold p-2 border-b border-gray-200">تاريخ الميلاد</td>
                <td class="p-2 border-b border-gray-200"><?php echo $employee->birthday; ?></td>
            </tr>
        </tbody>
    </table>
</div>

<!-- Contact Information -->
<h2 class="text-2xl font-bold text-gray-800 mb-4">بيانات الاتصال</h2>

<div class="bg-white rounded-lg overflow-hidden shadow-md mb-8">
    <table class="w-full">
        <tbody>
            <tr>
                <td class="font-semibold p-2 border-b border-gray-200">رقم الهاتف</td>
                <td class="p-2 border-b border-gray-200"><?php echo $employee->phone; ?></td>
            </tr>
            <tr>
                <td class="font-semibold p-2 border-b border-gray-200">البريد الاليكتوني</td>
                <td class="p-2 border-b border-gray-200"><?php echo $employee->email; ?></td>
            </tr>
        </tbody>
    </table>
</div>

<!-- Qualifications and Professional Title -->
<h2 class="text-2xl font-bold text-gray-800 mb-4">المؤهلات</h2>

<div class="flex  mb-8">

    <!-- Qualifications -->
    <div class="bg-white rounded-lg overflow-hidden shadow-md w-full md:w-1/2 mr-4 mb-4 md:mb-0">
        <table class="w-full">
            <tbody>
                <tr>
                    <td class="font-semibold p-2 border-b border-gray-200">المؤهل العلمي</td>
                    <td class="p-2 border-b border-gray-200"><?php echo $employee->educational_qualification; ?></td>
                </tr>
                <tr>
                    <td class="font-semibold p-2 border-b border-gray-200">الوظيفة</td>
                    <td class="p-2 border-b border-gray-200"><?php echo $employee->job_title; ?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Professional Title, Department and Section -->
    <div class="bg-white rounded-lg overflow-hidden shadow-md w-full md:w-1/2 mb-4 md:mb-0">
        <table class="w-full">
            <tbody>
                <tr>
                    <td class="font-semibold p-2 border-b border-gray-200">القسم</td>
                    <td class="p-2 border-b border-gray-200"><?php echo $employee->department; ?></td>
                </tr>
                <tr>
                    <td class="font-semibold p-2 border-b border-gray-200">المديرية</td>
                    <td class="p-2 border-b border-gray-200"><?php echo $employee->directorate; ?></td>
                </tr>
            </tbody>
        </table>
    </div>

</div>

<!-- Completed Programs -->
<h2 class="text-2xl font-bold text-gray-800 mb-4">البرنامج المنجزة</h2>

<div class="bg-white rounded-lg overflow-hidden shadow-md mb-8">
    <!-- <div class="flex flex-wrap items-center justify-between border-b border-gray-200 px-4 py-3">
        <h3 class="font-semibold text-lg">Filters</h3>
        <div class="flex flex-wrap items-center">
            <label for="from-date" class="mr-2">From:</label>
            <input type="date" id="from-date" name="from-date" class="border border-gray-400 px-2 py-1 rounded-lg mr-2">
            <label for="to-date" class="mr-2">To:</label>
            <input type="date" id="to-date" name="to-date" class="border border-gray-400 px-2 py-1 rounded-lg mr-2">
            <button class="bg-blue-500 text-white rounded-lg px-4 py-1">Apply</button>
        </div>
    </div> -->
    <table class="w-full">
        <thead>
            <tr>
                <th class="text-left font-semibold p-2 border-b border-gray-200">اسم البرنامج</th>
                <th class="text-left font-semibold p-2 border-b border-gray-200">الجهة</th>
                <th class="text-left font-semibold p-2 border-b border-gray-200">من</th>
                <th class="text-left font-semibold p-2 border-b border-gray-200">الى</th>
                <th class="text-left font-semibold p-2 border-b border-gray-200">عدد الساعات</th>
                <th class="text-left font-semibold p-2 border-b border-gray-200">الشهادة</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($completedStudies as $study) : ?>

                <tr>
                    <td class="p-2 border-b border-gray-200"><?= $study->program->name ?></td>
                    <td class="p-2 border-b border-gray-200"><?= $study->program->institution_name ?></td>
                    <td class="p-2 border-b border-gray-200">01/01/2022</td>
                    <td class="p-2 border-b border-gray-200">05/01/2022</td>
                    <td class="p-2 border-b border-gray-200">40</td>
                    <td class="p-2 border-b border-gray-200"><a <a href="../uploads/<?= $study->id ?>.pdf">Certification</a></td>
                </tr>
            <?php endforeach; ?>

        </tbody>

    </table>
</div>
<!-- This Year's Programs -->
<div class="bg-white rounded-lg overflow-hidden shadow-md w-full md:w-1/2">
    <h3 class="font-semibold p-2 bg-gray-200 text-gray-800 border-b border-gray-200">برامج الحالية</h3>
    <table class="w-full text-left">
        <thead>
            <tr>
                <th class="font-semibold p-2 border-b border-gray-200">ID</th>
                <th class="font-semibold p-2 border-b border-gray-200">اسم البرنامج</th>
                <th class="font-semibold p-2 border-b border-gray-200">اجباري</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($studies as $study) : ?>
                <tr>
                    <td class="p-2 border-b border-gray-200"><?= $study->program->id ?></td>
                    <td class="p-2 border-b border-gray-200"><?= $study->program->name ?></td>
                    <td class="p-2 border-b border-gray-200"><?= $study->isOptional ? "no" : "yes" ?></td>
                </tr>
            <?php endforeach; ?>


        </tbody>
    </table>
</div>
</div>
</div>
</body>

</html>