<?php
include "../services/controller.php";

include "../models/employee.php";
include "../models/student.php";



$isEdit = isset($_GET['edit']);

if ($isEdit) {
    $oldEmp = Student::get($_GET['edit'], $db);
}

// handle form submission
if (isset($_POST['submit'])) {

    $student = new Student();

    $student->setFirstName($_POST['first_name'])
        ->setLastName($_POST['last_name'])
        ->setDirectorate($_POST['directorate'])
        ->setDepartment($_POST['department'])
        ->setEmail($_POST['email'])
        ->setUniversity($_POST['university'])
        ->setPartneringEntity($_POST['partnering_entity'])
        ->setSpecialization($_POST['specialization']);

    $student->insert($db);
}



$isAllowedToSuccess = $_SESSION['user_role'] == 1;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <?= Head(); ?>
</head>

<?= skeleton() ?>
<h1 class="text-3xl font-bold text-gray-800 mb-4">Add New Trainee</h1>
<form method="POST" class="bg-white rounded-lg overflow-hidden shadow-md p-8">

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2" for="first_name">First Name</label>
            <input value="<?= $isEdit ? $oldEmp->first_name : '' ?>" class="border border-gray-400 rounded-md py-2 px-3 w-full" type="text" id="first_name" name="first_name">
        </div>
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2" for="last_name">Last Name</label>
            <input value="<?= $isEdit ? $oldEmp->last_name : '' ?>" class="border border-gray-400 rounded-md py-2 px-3 w-full" type="text" id="last_name" name="last_name">
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4 mt-4">
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2" for="nationID">specialization</label>
            <input value="<?= $isEdit ? $oldEmp->specialization : '' ?>" class="border border-gray-400 rounded-md py-2 px-3 w-full" type="text" id="nationID" name="specialization">
        </div>
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2" for="birthday">university</label>
            <input value="<?= $isEdit ? $oldEmp->university : '' ?>" class="border border-gray-400 rounded-md py-2 px-3 w-full" type="text" id="birthday" name="university">
        </div>
    </div>

    <div class="mt-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="date_hire">partnering_entity</label>
        <input value="<?= $isEdit ? $oldEmp->partnering_entity : '' ?>" class="border border-gray-400 rounded-md py-2 px-3 w-full" type="text" id="date_hire" name="partnering_entity">
    </div>


    <div class="mt-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="directorate">Directorate</label>
        <input value="<?= $isEdit ? $oldEmp->directorate : '' ?>" class="border border-gray-400 rounded-md py-2 px-3 w-full" type="text" id="directorate" name="directorate">
    </div>
    <div class="mt-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="department">Department</label>
        <input value="<?= $isEdit ? $oldEmp->department : '' ?>" class="border border-gray-400 rounded-md py-2 px-3 w-full" type="text" id="department" name="department">
    </div>

    <div class="mt-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email</label>
        <input value="<?= $isEdit ? $oldEmp->email : '' ?>" class="border border-gray-400 rounded-md py-2 px-3 w-full" type="email" id="email" name="email">
    </div>


    <div class="mt-8">
        <button name="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">
            <?= $isEdit ? "Update" : "Add" ?> trainee
        </button>
    </div>
</form>
</div>
</body>

</html>