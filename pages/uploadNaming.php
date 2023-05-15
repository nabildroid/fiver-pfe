<?php
include "../services/controller.php";

include "../models/employee.php";
include "../models/study.php";


// scan the uploads folder for files that starts with "a.naming.pdf" and return the file names

$studyID = $_GET["employee"];


$files = array_filter(scandir("../uploads"), function ($file) {
    global $studyID;
    return strpos($file, $studyID . ".naming") === 0;
});

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the study ID from the URL

    // Handle the file upload
    $targetDir = "../uploads/";
    // fileName with random string
    $fileName = $studyID . ".naming." . uniqid() . ".pdf";
    $targetPath = $targetDir . $fileName;

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetPath)) {
        // File uploaded successfully
        echo "File uploaded successfully.";

        header("Location: ./");
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
    <title>رفع كتاب التسمية</title>
    <?= Head(); ?>
</head>

<?= skeleton() ?>
<h1 class="text-3xl text-center font-bold text-gray-800 mb-4">رفع كتاب التسمية</h1>

<div class="flex justify-center items-center">
    <div class="w-1/2">
        <?php
        ?>
        <h2 class="text-xl font-semibold text-gray-800 mb-2">رفع كتاب التسمية</h2>
        <form method="POST" enctype="multipart/form-data">
            <input type="file" name="file" class="mb-4">
            <input type="submit" value="Upload" class="bg-slate-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        </form>
    </div>

    <div class="w-1/2">
        <?php
        ?>
        <h2 class="text-xl font-semibold text-gray-800 mb-2">جميع كتب التسمية</h2>
        <ul>
            <?php
            foreach ($files as $file) {
                echo "<li><a href='/uploads/$file'>$file</a></li>";
            }
            ?>
        </ul>
    </div>

    </body>

</html>