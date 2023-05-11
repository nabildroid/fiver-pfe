<?php
include "../services/controller.php";


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .placeholder-image {
            background-image: url('placeholder-image.jpg');
            background-size: cover;
            width: 100%;
            height: 400px;
        }
    </style>
</head>

<?=skeleton()?>
                <div class="placeholder-image"></div>
                <p class="text-center mt-4">Welcome to the Home Page!</p>
            </div>
        </div>
    </div>
</body>

</html>