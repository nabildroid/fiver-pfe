<?php
include "../services/controller.php";

include "../models/employee.php";


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




<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-8">Training Management</h1>

        <!-- Filters -->
        <div class="mb-8 flex items-end space-x-4">
            <div class="flex items-center ">
                <label for="name" class=" font-medium">Name:</label>
                <input type="text" id="name" name="name" class="border border-gray-300 rounded-md py-2 px-4 focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="flex items-center ">
                <label for="qualification" class=" font-medium">Qualification:</label>
                <select id="qualification" name="qualification" class="border border-gray-300 rounded-md py-2 px-4 focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
                    <option value="">All</option>
                    <option value="Bachelor's Degree">Bachelor's Degree</option>
                    <option value="Master's Degree">Master's Degree</option>
                    <option value="PhD">PhD</option>
                </select>
            </div>
            <div class="flex items-center">
                <label for="directory" class=" font-medium">Directory:</label>
                <select id="directory" name="directory" class="border border-gray-300 rounded-md py-2 px-4 focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
                    <option value="">All</option>
                    <option value="Technology">Technology</option>
                    <option value="Operations">Operations</option>
                    <option value="Finance">Finance</option>
                </select>
            </div>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-1 px-4 rounded-md ml-4">
                    Filter
                </button>
        </div>

        <!-- Table -->
        <table class="w-full bg-white border border-gray-300 rounded-md">

            <thead>
                <tr class="bg-gray-200">
                    <th class="py-2 px-4">ID</th>
                    <th class="py-2 px-4">Name</th>
                    <th class="py-2 px-4">Nation ID</th>
                    <th class="py-2 px-4">Birthday</th>
                    <th class="py-2 px-4">Qualification</th>
                    <th class="py-2 px-4">Type</th>
                    <th class="py-2 px-4">Year in Degree</th>
                    <th class="py-2 px-4">Professional Title</th>
                    <th class="py-2 px-4">Directory</th>
                    <th class="py-2 px-4">Section</th>
                    <th class="py-2 px-4">Type of Degree</th>
                    <th class="py-2 px-4"></th>
                    <th class="py-2 px-4"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="py-2 px-4">1</td>
                    <td class="py-2 px-4">John Doe</td>
                    <td class="py-2 px-4">1234567890</td>
                    <td class="py-2 px-4">1990-01-01</td>
                    <td class="py-2 px-4">Bachelor's Degree</td>
                    <td class="py-2 px-4">Type A</td>
                    <td class="py-2 px-4">4</td>
                    <td class="py-2 px-4">Software Engineer</td>
                    <td class="py-2 px-4">Technology</td>
                    <td class="py-2 px-4">Development</td>
                    <td class="py-2 px-4">Type X</td>
                    <td class="py-2 px-4">
                        <button class="bg-blue-500 text-white py-1 px-2 rounded-md">Completed Courses</button>
                    </td>
                    <td class="py-2 px-4">
                        <button class="bg-blue-500 text-white py-1 px-2 rounded-md">Current Planning</button>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</body>
