

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Change Password</h1>

        <div class="bg-white p-6 rounded-md shadow-md">
            <form action="#" method="POST">
                <div class="mb-4">
                    <label for="newPassword" class="block text-gray-700 font-medium mb-2">New Password:</label>
                    <input type="password" id="newPassword" name="newPassword" class="border border-gray-300 rounded-md py-2 px-4 focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="confirmPassword" class="block text-gray-700 font-medium mb-2">Confirm Password:</label>
                    <input type="password" id="confirmPassword" name="confirmPassword" class="border border-gray-300 rounded-md py-2 px-4 focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="flex justify-end mt-6">
                    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">Change Password</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
