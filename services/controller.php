<?php

session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);


require_once '../models/user.php';
require_once '../services/db.php';



if (isset($_SESSION['user_id'])) {
    $user = User::get($_SESSION['user_id'], $db);
}else if(!isset($loginPage)){
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

    $role = $user->getRole() == "RH"? "موارد بشرية": ($user->getRole() == "RH_SPECIAL"? "موارد بشرية خاصة": ($user->getRole() == "Trainer"? "مدرب": "متدرب"));



?>



    <body class="bg-gray-100" dir="rtl">
        <div class="flex min-h-full">
            <!-- Left Side (Actions) -->
            <div class="w-1/5 bg-gray-200  py-12 sticky-panel">
                <ul class="space-y-4 divide-y-2 divide-gray-300">

                    <?php if ($user->getRole() == "Employee") { ?>
                        <li><a href="/pfe/pages/profile.php?id=3" class="block w-full p-4 pb-2  text-blue-500 hover:text-blue-700">ملف الشخصي</a></li>
                    <?php } ?>

                    <?php if ($user->getRole() == "RH") { ?>
                        <li><a href="/pfe/pages/addProgram.php" class="block w-full p-4 pb-2  text-blue-500 hover:text-blue-700">اضافة برنامج</a></li>
                        <li><a href="/pfe/pages/rh.php" class="block w-full p-4 pb-2  text-blue-500 hover:text-blue-700">موارد بشرية</a></li>
                        <li><a href="/pfe/pages/addTrainee.php" class="block w-full p-4 pb-2  text-blue-500 hover:text-blue-700">اضافة متدرب</a></li>
                        <li><a href="/pfe/pages/addTrainer.php" class="block w-full p-4 pb-2  text-blue-500 hover:text-blue-700">اضافة مدرب</a></li>
                        <li><a href="/pfe/pages/rhTrainee.php" class="block w-full p-4 pb-2  text-blue-500 hover:text-blue-700">موارد بشرية لمتدربين الخارجيين</a></li>
                    <?php } ?>

                    <?php if ($user->getRole() == "RH_SPECIAL") { ?>
                        <li><a href="/pfe/pages/rh.php" class="block w-full p-4 pb-2  text-blue-500 hover:text-blue-700">موارد بشرية</a></li>

                    <?php } ?>
                    <?php if ($user->getRole() == "Trainer") { ?>
                        <li><a href="/pfe/pages/trainees.php" class="block w-full p-4 pb-2  text-blue-500 hover:text-blue-700">المتدربين</a></li>
                    <?php } ?>
                    <li><a href="/pfe/pages/changePassward.php" class="block w-full p-4 pb-2  text-blue-500 hover:text-blue-700">تغيير كلمة مرور</a></li>
                    <li><a href="/pfe/pages/login.php" class="block w-full p-4 pb-2  text-blue-500 hover:text-blue-700">خروج</a></li>
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
                <div class="container mx-auto p-4">


                <?php
            }




            function footer()
            {
                echo '
                </div>
                </div>
                </div>
                </body>
                </html>
                ';
            }
