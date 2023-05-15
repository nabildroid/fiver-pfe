<?php
include "../services/controller.php";


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

<body class="bg-gray-100 font-sans">

    <div class="container mx-auto my-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Training Management</h1>

        <!-- Filter by date range -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold text-gray-800">Training Programs</h2>
            <div class="flex items-center">
                <label class="mr-2 font-semibold text-gray-700">Filter by date range:</label>
                <input class="border border-gray-400 p-1 rounded-md" type="date" name="from_date" />
                <label class="mx-2 font-semibold text-gray-700">to</label>
                <input class="border border-gray-400 p-1 rounded-md" type="date" name="to_date" />
                <button class="bg-slate-500 hover:bg-blue-700 text-white font-semibold py-1 px-4 rounded-md ml-4">
                    Filter
                </button>
            </div>
        </div>

        <!-- Table of employee training programs -->
        <div class="bg-white rounded-lg overflow-hidden shadow-md">
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap font-semibold p-2 border-b border-gray-200">ID</th>
                        <th class="whitespace-nowrap font-semibold p-2 border-b border-gray-200">Name</th>
                        <th class="whitespace-nowrap font-semibold p-2 border-b border-gray-200">
                            Professional Title
                        </th>
                        <th class="whitespace-nowrap font-semibold p-2 border-b border-gray-200">Directory</th>
                        <th class="whitespace-nowrap font-semibold p-2 border-b border-gray-200">Section</th>
                        <th class="whitespace-nowrap font-semibold p-2 border-b border-gray-200">Program</th>
                        <th class="whitespace-nowrap font-semibold p-2 border-b border-gray-200">From</th>
                        <th class="whitespace-nowrap font-semibold p-2 border-b border-gray-200">To</th>
                        <th class="whitespace-nowrap font-semibold p-2 border-b border-gray-200">PDF</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="p-2 border-b border-gray-200">1</td>
                        <td class="p-2 border-b border-gray-200">John Doe</td>
                        <td class="p-2 border-b border-gray-200">Software Developer</td>
                        <td class="p-2 border-b border-gray-200">IT Department</td>
                        <td class="p-2 border-b border-gray-200">Section A</td>
                        <td class="p-2 border-b border-gray-200">Training Program X</td>
                        <td class="p-2 border-b border-gray-200">2023-05-01</td>
                        <td class="p-2 border-b border-gray-200">2023-05-10</td>
                        <td class="p-2 border-b border-gray-200">
                            <a href="path/to/program_x_certificate.pdf" target="_blank">Certificate</a>
                        </td>

                    </tr>

                </tbody>
            </table>
        </div>
    </div>

</body>

</html>