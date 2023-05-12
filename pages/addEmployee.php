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

    if (isset($_POST['success'])) {
        $employee->id = $_GET['edit'];
        $employee->updateSuccess($_POST['success'], $db);
        header("Location: ./addEmployee.php?edit=" . $employee->id);
        exit();
    }


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



    if ($isEdit) {
        $employee->id = $_GET['edit'];
        $employee->update($db);
        header("Location: ./employee.php?edit=" . $employee->id);
        exit();
    }

    $employee->insert($db);

    User::generateEmployee($employee->first_name, $employee->id, $db);

    
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

<h1 class="text-3xl font-bold text-gray-800 mb-4">اضافة موظف</h1>
<form method="POST" class="bg-white rounded-lg overflow-hidden shadow-md p-8">

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2" for="first_name">الاسم الاول</label>
            <input <?= $isAllowedToSuccess ? "disabled" : "" ?> value="<?= $isEdit ? $oldEmp->first_name : '' ?>" class="border border-gray-400 rounded-md py-2 px-3 w-full" type="text" id="first_name" name="first_name">
        </div>
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2" for="last_name">اسم العائلة</label>
            <input <?= $isAllowedToSuccess ? "disabled" : "" ?> value="<?= $isEdit ? $oldEmp->last_name : '' ?>" class="border border-gray-400 rounded-md py-2 px-3 w-full" type="text" id="last_name" name="last_name">
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4 mt-4">
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2" for="nationID">رقم التعريف</label>
            <input <?= $isAllowedToSuccess ? "disabled" : "" ?> value="<?= $isEdit ? $oldEmp->nationID : '' ?>" class="border border-gray-400 rounded-md py-2 px-3 w-full" type="text" id="nationID" name="nationID">
        </div>
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2" for="birthday">تاريخ الميلاد</label>
            <input <?= $isAllowedToSuccess ? "disabled" : "" ?> value="<?= $isEdit ? $oldEmp->birthday : '' ?>" class="border border-gray-400 rounded-md py-2 px-3 w-full" type="date" id="birthday" name="birthday">
        </div>
    </div>

    <div class="mt-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="educational_qualification">المؤهل العلمي</label>
        <input <?= $isAllowedToSuccess ? "disabled" : "" ?> value="<?= $isEdit ? $oldEmp->educational_qualification : '' ?>" class="border border-gray-400 rounded-md py-2 px-3 w-full" type="text" id="educational_qualification" name="educational_qualification">
    </div>

    <div class="mt-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="date_hire">تاريخ التعيين</label>
        <input <?= $isAllowedToSuccess ? "disabled" : "" ?> value="<?= $isEdit ? $oldEmp->date_hire : '' ?>" class="border border-gray-400 rounded-md py-2 px-3 w-full" type="date" id="date_hire" name="date_hire">
    </div>

    <div class="mt-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="job_title">المهنة</label>
        <input <?= $isAllowedToSuccess ? "disabled" : "" ?> value="<?= $isEdit ? $oldEmp->job_title : '' ?>" class="border border-gray-400 rounded-md py-2 px-3 w-full" type="text" id="job_title" name="job_title">
    </div>
    <div class="mt-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="category">نوع الموظف</label>
        <input <?= $isAllowedToSuccess ? "disabled" : "" ?> value="<?= $isEdit ? $oldEmp->category : '' ?>" class="border border-gray-400 rounded-md py-2 px-3 w-full" type="text" id="category" name="category">
    </div>
    <div class="grid grid-cols-2 gap-4 mt-4">
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2" for="job_grade">الدرجة</label>
            <input <?= $isAllowedToSuccess ? "disabled" : "" ?> value="<?= $isEdit ? $oldEmp->job_grade : '' ?>" class="border border-gray-400 rounded-md py-2 px-3 w-full" type="text" id="job_grade" name="job_grade">
        </div>
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2" for="year_grade">عام الدرجة</label>
            <input <?= $isAllowedToSuccess ? "disabled" : "" ?> value="<?= $isEdit ? $oldEmp->year_grade : '' ?>" class="border border-gray-400 rounded-md py-2 px-3 w-full" type="text" id="year_grade" name="year_grade">
        </div>
    </div>
    <div class="mt-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="directorate">المديرية</label>
        <input <?= $isAllowedToSuccess ? "disabled" : "" ?> value="<?= $isEdit ? $oldEmp->directorate : '' ?>" class="border border-gray-400 rounded-md py-2 px-3 w-full" type="text" id="directorate" name="directorate">
    </div>
    <div class="mt-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="department">القسم</label>
        <input <?= $isAllowedToSuccess ? "disabled" : "" ?> value="<?= $isEdit ? $oldEmp->department : '' ?>" class="border border-gray-400 rounded-md py-2 px-3 w-full" type="text" id="department" name="department">
    </div>
    <div class="mt-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="Promotion">دفعة</label>
        <input <?= $isAllowedToSuccess ? "disabled" : "" ?> value="<?= $isEdit ? $oldEmp->Promotion : '' ?>" class="border border-gray-400 rounded-md py-2 px-3 w-full" type="text" id="Promotion" name="Promotion">
    </div>
    <div class="mt-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">رقم الهاتف</label>
        <input <?= $isAllowedToSuccess ? "disabled" : "" ?> value="<?= $isEdit ? $oldEmp->phone : '' ?>" class="border border-gray-400 rounded-md py-2 px-3 w-full" type="text" id="phone" name="phone">
    </div>
    <div class="mt-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="email">البريد الاليكتوني</label>
        <input <?= $isAllowedToSuccess ? "disabled" : "" ?> value="<?= $isEdit ? $oldEmp->email : '' ?>" class="border border-gray-400 rounded-md py-2 px-3 w-full" type="email" id="email" name="email">
    </div>

    <?php if ($isAllowedToSuccess) { ?>
        <div class="mt-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="success">التعاقب الوظيفي</label>
            <input class="border border-gray-400 rounded-md py-2 px-3 w-full" type="text" value="<?= $isEdit ? $oldEmp->success : '' ?>" id="success" name="success">
        </div>
    <?php } ?>

    <div class="mt-8">
        <button name="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">
            <?= $isEdit ? "تحديث" : "اضافة" ?> الموضف
        </button>
    </div>
</form>
</div>
</body>

</html>