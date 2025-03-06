<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Secret Santa Management 🎅') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if(session('success'))
                        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Import Employees -->
                        <div class="bg-gray-100 dark:bg-gray-900 p-4 rounded-lg shadow-md">
                            <h3 class="text-lg font-semibold mb-2">📂 Import Employees</h3>
                            <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="csv_file" required class="w-full border border-gray-300 dark:border-gray-600 p-2 rounded-lg mb-3">
                                <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition">
                                    Upload CSV
                                </button>
                            </form>
                        </div>

                        <!-- Generate Secret Santa -->
                        <div class="bg-gray-100 dark:bg-gray-900 p-4 rounded-lg shadow-md">
                            <h3 class="text-lg font-semibold mb-2">🎲 Generate Secret Santa</h3>
                            <form action="{{ route('generate') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full bg-green-500 text-white py-2 rounded-lg hover:bg-green-600 transition">
                                    Assign Random Pairs
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Download Assignments -->
                    <div class="mt-6 text-center">
                        <a href="{{ route('export') }}" class="inline-block bg-gray-800 text-white py-2 px-4 rounded-lg hover:bg-gray-900 transition">
                            📥 Download Assignments
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>



