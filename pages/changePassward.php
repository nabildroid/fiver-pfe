<?php
include "../services/controller.php";

include "../models/employee.php";
include "../models/student.php";






if (isset($_POST['newPassword'])) {
    $user->setPassword($_POST['newPassword']);
    $user->update($db);
    header("Location: /pfe/pages");
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

        <h1 class="text-2xl font-bold mb-4">تغيير كلمة السر</h1>

        <div class="bg-white p-6 rounded-md shadow-md">
            <form action="#" method="POST">
                <div class="mb-4">
                    <label for="newPassword" class="block text-gray-700 font-medium mb-2">كلمة السر الجديدة:</label>
                    <input type="password" id="newPassword" name="newPassword" class="border border-gray-300 rounded-md py-2 px-4 focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="confirmPassword" class="block text-gray-700 font-medium mb-2">اعادة كلمة السر:</label>
                    <input type="password" id="confirmPassword" name="confirmPassword" class="border border-gray-300 rounded-md py-2 px-4 focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="flex justify-end mt-6">
                    <button type="submit" class="bg-slate-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">تغيير</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
