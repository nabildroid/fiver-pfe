<?php
include "../services/controller.php";

include "../models/employee.php";



$isEdit = isset($_GET['edit']);

if ($isEdit) {
    $oldEmp = Employee::get($_GET['edit'], $db);
}

// handle form submission
if (isset($_POST['submit'])) {

    $employee = new Employee();

    $employee->setFirstName($_POST['first_name'])
        ->setLastName($_POST['last_name'])
        ->setNationID($_POST['nationID'])
        ->setBirthday($_POST['birthday'])
        ->setEducationalQualification($_POST['educational_qualification'])
        ->setDateHire($_POST['date_hire'])
        ->setJobTitle($_POST['job_title'])
        ->setCategory($_POST['category'])
        ->setJobGrade($_POST['job_grade'])
        ->setYearGrade($_POST['year_grade'])
        ->setDirectorate($_POST['directorate'])
        ->setDepartment($_POST['department'])
        ->setPromotion($_POST['Promotion'])
        ->setPhone($_POST['phone'])
        ->setEmail($_POST['email']);


    $employee->insert($db);

    User::generateEmployee($employee->first_name, $employee->id, $db);

    if (isset($_POST['success'])) {
        $employee->updateSuccess($_POST['success'], $db);
    }
}



$isAllowedToSuccess = $user->getRole() == "RH_SPECIAL";

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

<h1 class="text-3xl font-bold text-gray-800 mb-4">Add New Employee</h1>
<form method="POST" class="bg-white rounded-lg overflow-hidden shadow-md p-8">

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2" for="first_name">First Name</label>
            <input <?= $isAllowedToSuccess ? "disabled" : "" ?> value="<?= $isEdit ? $oldEmp->first_name : '' ?>" class="border border-gray-400 rounded-md py-2 px-3 w-full" type="text" id="first_name" name="first_name">
        </div>
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2" for="last_name">Last Name</label>
            <input <?= $isAllowedToSuccess ? "disabled" : "" ?> value="<?= $isEdit ? $oldEmp->last_name : '' ?>" class="border border-gray-400 rounded-md py-2 px-3 w-full" type="text" id="last_name" name="last_name">
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4 mt-4">
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2" for="nationID">National ID</label>
            <input <?= $isAllowedToSuccess ? "disabled" : "" ?> value="<?= $isEdit ? $oldEmp->nationID : '' ?>" class="border border-gray-400 rounded-md py-2 px-3 w-full" type="text" id="nationID" name="nationID">
        </div>
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2" for="birthday">Birthday</label>
            <input <?= $isAllowedToSuccess ? "disabled" : "" ?> value="<?= $isEdit ? $oldEmp->birthday : '' ?>" class="border border-gray-400 rounded-md py-2 px-3 w-full" type="date" id="birthday" name="birthday">
        </div>
    </div>

    <div class="mt-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="educational_qualification">Educational Qualification</label>
        <input <?= $isAllowedToSuccess ? "disabled" : "" ?> value="<?= $isEdit ? $oldEmp->educational_qualification : '' ?>" class="border border-gray-400 rounded-md py-2 px-3 w-full" type="text" id="educational_qualification" name="educational_qualification">
    </div>

    <div class="mt-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="date_hire">Date of Hire</label>
        <input <?= $isAllowedToSuccess ? "disabled" : "" ?> value="<?= $isEdit ? $oldEmp->date_hire : '' ?>" class="border border-gray-400 rounded-md py-2 px-3 w-full" type="date" id="date_hire" name="date_hire">
    </div>

    <div class="mt-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="job_title">Job Title</label>
        <input <?= $isAllowedToSuccess ? "disabled" : "" ?> value="<?= $isEdit ? $oldEmp->job_title : '' ?>" class="border border-gray-400 rounded-md py-2 px-3 w-full" type="text" id="job_title" name="job_title">
    </div>
    <div class="mt-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="category">Category</label>
        <input <?= $isAllowedToSuccess ? "disabled" : "" ?> value="<?= $isEdit ? $oldEmp->category : '' ?>" class="border border-gray-400 rounded-md py-2 px-3 w-full" type="text" id="category" name="category">
    </div>
    <div class="grid grid-cols-2 gap-4 mt-4">
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2" for="job_grade">Job Grade</label>
            <input <?= $isAllowedToSuccess ? "disabled" : "" ?> value="<?= $isEdit ? $oldEmp->job_grade : '' ?>" class="border border-gray-400 rounded-md py-2 px-3 w-full" type="text" id="job_grade" name="job_grade">
        </div>
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2" for="year_grade">Year in Grade</label>
            <input <?= $isAllowedToSuccess ? "disabled" : "" ?> value="<?= $isEdit ? $oldEmp->year_grade : '' ?>" class="border border-gray-400 rounded-md py-2 px-3 w-full" type="text" id="year_grade" name="year_grade">
        </div>
    </div>
    <div class="mt-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="directorate">Directorate</label>
        <input <?= $isAllowedToSuccess ? "disabled" : "" ?> value="<?= $isEdit ? $oldEmp->directorate : '' ?>" class="border border-gray-400 rounded-md py-2 px-3 w-full" type="text" id="directorate" name="directorate">
    </div>
    <div class="mt-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="department">Department</label>
        <input <?= $isAllowedToSuccess ? "disabled" : "" ?> value="<?= $isEdit ? $oldEmp->department : '' ?>" class="border border-gray-400 rounded-md py-2 px-3 w-full" type="text" id="department" name="department">
    </div>
    <div class="mt-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="Promotion">Promotion</label>
        <input <?= $isAllowedToSuccess ? "disabled" : "" ?> value="<?= $isEdit ? $oldEmp->Promotion : '' ?>" class="border border-gray-400 rounded-md py-2 px-3 w-full" type="text" id="Promotion" name="Promotion">
    </div>
    <div class="mt-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">Phone</label>
        <input <?= $isAllowedToSuccess ? "disabled" : "" ?> value="<?= $isEdit ? $oldEmp->phone : '' ?>" class="border border-gray-400 rounded-md py-2 px-3 w-full" type="text" id="phone" name="phone">
    </div>
    <div class="mt-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email</label>
        <input <?= $isAllowedToSuccess ? "disabled" : "" ?> value="<?= $isEdit ? $oldEmp->email : '' ?>" class="border border-gray-400 rounded-md py-2 px-3 w-full" type="email" id="email" name="email">
    </div>

    <?php if ($isAllowedToSuccess) { ?>
        <div class="mt-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="success">Success</label>
            <input class="border border-gray-400 rounded-md py-2 px-3 w-full" type="text" id="success" name="sucess">
        </div>
    <?php } ?>

    <div class="mt-8">
        <button name="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">
            <?= $isEdit ? "Update" : "Add" ?> Employee
        </button>
    </div>
</form>
</div>
</body>

</html>