<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secret Santa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white shadow-lg rounded-lg p-6 w-full max-w-lg text-center">
        <h1 class="text-2xl font-bold text-red-500 mb-4">🎅 Secret Santa Management 🎁</h1>

        @if(session('success'))
            <p class="bg-green-100 text-green-700 px-4 py-2 rounded mb-2">{{ session('success') }}</p>
        @endif
        @if(session('error'))
            <p class="bg-red-100 text-red-700 px-4 py-2 rounded mb-2">{{ session('error') }}</p>
        @endif

        <!-- Import Employees -->
        <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data" class="mb-4">
            @csrf
            <label class="block text-gray-700 font-semibold mb-2">Upload Employee List (CSV)</label>
            <input type="file" name="csv_file" required class="w-full border p-2 rounded-lg mb-3">
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition">📂 Import Employees</button>
        </form>

        <!-- Generate Secret Santa -->
        <form action="{{ route('generate') }}" method="POST" class="mb-4">
            @csrf
            <button type="submit" class="w-full bg-green-500 text-white py-2 rounded-lg hover:bg-green-600 transition">🎲 Generate Secret Santa</button>
        </form>

        <!-- Download Assignments -->
        <a href="{{ route('export') }}" class="inline-block bg-gray-800 text-white py-2 px-4 rounded-lg hover:bg-gray-900 transition">📥 Download Assignments</a>
    </div>

</body>
</html>

