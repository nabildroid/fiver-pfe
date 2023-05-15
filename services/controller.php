<?php

session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);


require_once '../models/user.php';
require_once '../services/db.php';



if (isset($_SESSION['user_id'])) {
    $user = User::get($_SESSION['user_id'], $db);
} else if (!isset($loginPage)) {
    header("Location: /pfe/pages/login.php");
    exit;
}


function Head()
{

    echo '
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.tailwindcss.com"></script>
';
}






function skeleton()
{

    global $user;

    $userName = $_SESSION['user_name'];

    $role = $user->getRole() == "RH" ? "موارد بشرية" : ($user->getRole() == "RH_SPECIAL" ? "موارد بشرية خاصة" : ($user->getRole() == "Trainer" ? "مدرب" : "متدرب"));



?>

    <style>
        body {
            font-family: 'Noto Naskh Arabic', sans-serif;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Naskh+Arabic:wght@400;700&display=swap" rel="stylesheet">


    <body class="bg-gray-100" dir="rtl">
        <div class="flex min-h-screen items-stretch">
            <!-- Left Side (Actions) -->
            <div class="w-1/5 bg-slate-700  py-12 sticky top-0 shadow-lg h-screen overflow-hidden">
                <ul class="space-y-4 ">

                    <?php if ($user->getRole() == "Employee") { ?>
                        <li><a href="/pfe/pages/profile.php?id=3" class="block w-full p-4 pb-2  text-white bg-slate-800/75 border-b-2 border-slate-500 hover:border-slate-300 hover:text-blue-100">ملف الشخصي</a></li>
                    <?php } ?>

                    <?php if ($user->getRole() == "RH") { ?>
                        <li><a href="/pfe/pages/addProgram.php" class="block w-full p-4 pb-2  text-white bg-slate-800/75 border-b-2 border-slate-500 hover:border-slate-300 hover:text-blue-100">اضافة برنامج تدريبي</a></li>
                        <li><a href="/pfe/pages/rh.php" class="block w-full p-4 pb-2  text-white bg-slate-800/75 border-b-2 border-slate-500 hover:border-slate-300 hover:text-blue-100">الموظفين</a></li>
                        <li><a href="/pfe/pages/addTrainee.php" class="block w-full p-4 pb-2  text-white bg-slate-800/75 border-b-2 border-slate-500 hover:border-slate-300 hover:text-blue-100">اضافة متدرب</a></li>
                        <li><a href="/pfe/pages/addTrainer.php" class="block w-full p-4 pb-2  text-white bg-slate-800/75 border-b-2 border-slate-500 hover:border-slate-300 hover:text-blue-100">اضافة جهة تدريبية</a></li>
                        <li><a href="/pfe/pages/rhTrainee.php" class="block w-full p-4 pb-2  text-white bg-slate-800/75 border-b-2 border-slate-500 hover:border-slate-300 hover:text-blue-100">تدريب حديثي التخرج وطلاب الجامعات</a></li>
                    <?php } ?>

                    <?php if ($user->getRole() == "RH_SPECIAL") { ?>
                        <li><a href="/pfe/pages/rh.php" class="block w-full p-4 pb-2  text-white bg-slate-800/75 border-b-2 border-slate-500 hover:border-slate-300 hover:text-blue-100">الموظفين</a></li>

                    <?php } ?>
                    <?php if ($user->getRole() == "Trainer") { ?>
                        <li><a href="/pfe/pages/trainees.php" class="block w-full p-4 pb-2  text-white bg-slate-800/75 border-b-2 border-slate-500 hover:border-slate-300 hover:text-blue-100">المتدربين</a></li>
                    <?php } ?>
                    <li><a href="/pfe/pages/changePassward.php" class="block w-full p-4 pb-2  text-white bg-slate-800/75 border-b-2 border-slate-500 hover:border-slate-300 hover:text-blue-100">تغيير كلمة مرور</a></li>
                    <li><a href="/pfe/pages/login.php" class="block w-full p-4 pb-2  text-white bg-slate-800/75 border-b-2 border-slate-500 hover:border-slate-300 hover:text-blue-100">خروج</a></li>
                </ul>
            </div>

            <!-- Right Section (Content) -->
            <div class="flex-1 bg-white  overflow-hidden">
                <!-- Top Bar -->
                <div class="flex justify-between items-center mb-4 shadow p-4">
                    <div>
                        <span class="text-lg font-semibold"><?= $userName ?> </span>
                        <span class="text-gray-500"><?= $role ?></span>
                    </div>
                    <img src="../logo.png" alt="Logo" class="h-12">
                </div>

                <!-- Main Content -->
                <div class="container mx-auto p-4 w-full ">

                <?php
            }




            function footer()
            {
                echo '
                </div>
                </div>
                </body>
                </html>
                ';
            }
