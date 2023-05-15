<?php




$loginPage = true;

include "../services/controller.php";




// if session exists redirect to index.php



if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];


    $user = User::login($email, $password, $db);
    if ($user) {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_name'] = $user->name;
        $_SESSION['user_role'] = $user->role;
        header("Location: ./index.php");
        exit;
    } else {
        echo "Invalid credentials";
    }
} else {
    session_decode("user_id");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <?= Head(); ?>

</head>

<body dir="rtl">




    <form action="" method="POST" class="">
        <div class=" flex flex-col items-center justify-center min-h-screen py-2">
            <div class="p-10 xs:p-0 mx-auto md:w-full md:max-w-md ">

                <img src="../logo.png" alt="Logo" class="h-16 mx-auto">
                <div class="bg-white shadow w-full rounded-lg divide-y divide-gray-200">
                    <div class="px-5 py-7">
                        <label class="font-semibold text-sm text-gray-600 pb-1 block">اسم المستخدم</label>
                        <input type="text" name="email" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full" />
                        <label class="font-semibold text-sm text-gray-600 pb-1 block">كلمة المرور</label>
                        <input type="password" name="password" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full" />
                        <button type="submit" name="login" class="transition duration-200 bg-slate-500 hover:bg-blue-600 focus:bg-blue-700 focus:shadow-sm focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50 rounded text-white px-3 py-2">دخول</button>
                    </div>

                </div>
            </div>
        </div>

</body>

</html>