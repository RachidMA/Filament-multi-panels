<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-lg p-8 bg-white shadow-md rounded-lg">
        <h1 class="text-2xl font-semibold mb-6">Create New User</h1>
        <form action="{{ route('employees.store') }}" method="POST">
            @csrf
            <!-- Name Input -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" id="name" name="name" 
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    required>
            </div>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <!-- Email Input -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" 
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    required>
            </div>

            <!-- Password Input -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" name="password"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    required>
            </div>

            <!-- Password Confirmation Input -->
            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    required>
            </div>

            <!-- Company Sector Select -->
            <div class="mb-4">
                <label for="userable_type" class="block text-sm font-medium text-gray-700">Company Sector</label>
                <select id="userable_type" name="userable_type" 
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    onchange="updateUserableOptions()">
                    <option value="" disabled selected>Select Company Sector</option>
                    <option value="headquater">Headquater</option>
                    <option value="company">Company</option>
                </select>
            </div>

            <!-- Dynamic Name Select -->
            <div class="mb-8 mt-4">
                <label for="userable_id" class="block text-sm font-medium text-gray-700">Name</label>
                <select id="userable_id" name="userable_id" 
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <!-- Options will be populated dynamically -->
                </select>
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit"
                    class="w-full bg-indigo-600 text-white py-2 px-4 border border-transparent rounded-md shadow-sm text-base font-medium hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Create User
                </button>
            </div>
        </form>
    </div>

    <script>
        
        // Function to update userable_id options based on userable_type
        function updateUserableOptions() {
            const type = document.getElementById('userable_type').value;
            const userableSelect = document.getElementById('userable_id');
            
            // Fetch options based on selected type
            fetch(`/get-userable-options?type=${type}`)
                .then(response => response.json())
                .then(data => {
                    userableSelect.innerHTML = ''; // Clear existing options
                    //DATA RETURN IS AN OJBECT 
                    //THIS IS HOW TO CONVERT TO ARRAY
                    Object.values(data).forEach(item => {
                        const option = document.createElement('option');
                        option.value = item.id;
                        option.textContent = item.name;
                        userableSelect.appendChild(option);
                    });
                });
        }
    </script>
</body>
</html>
