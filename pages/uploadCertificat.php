<?php
include "../services/controller.php";

include "../models/employee.php";
include "../models/study.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the study ID from the URL
    $studyID = $_GET["study"];

    // Handle the file upload
    $targetDir = "../uploads/";
    $fileName = $studyID . ".pdf";
    $targetPath = $targetDir . $fileName;

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetPath)) {
        // File uploaded successfully
        echo "File uploaded successfully.";

        Study::finish($studyID, $db);
        header("Location: /");
    } else {
        // Error uploading file
        echo "Error uploading file.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>رفع الشهادة</title>
    <?= Head(); ?>
</head>

<?= skeleton() ?>
<h1 class="text-3xl text-center font-bold text-gray-800 mb-4">رفع الشهادة</h1>

<div class="flex justify-center items-center">
    <div class="w-1/2">
        <?php
        ?>
        <h2 class="text-xl font-semibold text-gray-800 mb-2">رفع الشهادة</h2>
        <form method="POST" enctype="multipart/form-data">
            <input type="file" name="file" class="mb-4">
            <input type="submit" value="رفع" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        </form>
    </div>
</div>

</body>

</html>