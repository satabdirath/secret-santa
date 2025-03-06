<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\SecretSantaAssignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Exception;

class SecretSantaController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function importEmployees(Request $request)
    {
        try {
            $request->validate([
                'csv_file' => 'required|mimes:csv,txt|max:2048',
            ]);

            $file = $request->file('csv_file');
            if (!$file) {
                return back()->with('error', 'No file uploaded.');
            }

            $data = array_map('str_getcsv', file($file));

            if (count($data) < 2) {
                return back()->with('error', 'Invalid or empty CSV format.');
            }

            array_shift($data); // Remove header row

            foreach ($data as $row) {
                if (count($row) < 2) {
                    continue; // Skip malformed rows
                }

                Employee::updateOrCreate(
                    ['Employee_EmailID' => trim($row[1])],
                    ['Employee_Name' => trim($row[0])]
                );
            }

            return back()->with('success', 'Employees imported successfully.');
        } catch (Exception $e) {
            Log::error('Error importing employees: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while importing employees.');
        }
    }

    public function generateSecretSanta()
    {
        try {
            $employees = Employee::all()->shuffle();

            if ($employees->count() < 2) {
                return back()->with('error', 'At least 2 employees are required for Secret Santa.');
            }

            $previousAssignments = SecretSantaAssignment::where('year', now()->year - 1)->get();

            $assignments = [];
            $available = $employees->pluck('id')->toArray();

            foreach ($employees as $giver) {
                $possibleReceivers = array_diff($available, [$giver->id]);

                $previousReceiver = $previousAssignments->firstWhere('employee_id', $giver->id)?->secret_child_id;
                if ($previousReceiver) {
                    $possibleReceivers = array_diff($possibleReceivers, [$previousReceiver]);
                }

                if (empty($possibleReceivers)) {
                    return back()->with('error', 'Could not generate unique Secret Santa assignments. Try again.');
                }

                $receiverId = $possibleReceivers[array_rand($possibleReceivers)];
                $assignments[] = [
                    'employee_id' => $giver->id,
                    'secret_child_id' => $receiverId,
                    'year' => now()->year
                ];
                $available = array_diff($available, [$receiverId]);
            }

            SecretSantaAssignment::insert($assignments);

            return back()->with('success', 'Secret Santa assignments generated successfully.');
        } catch (Exception $e) {
            Log::error('Error generating Secret Santa: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while generating Secret Santa.');
        }
    }

    public function exportAssignments()
    {
        try {
            $assignments = SecretSantaAssignment::with(['giver', 'receiver'])
                ->where('year', now()->year)
                ->get();

            if ($assignments->isEmpty()) {
                return back()->with('error', 'No Secret Santa assignments found for export.');
            }

            $csvFileName = 'secret_santa_' . now()->year . '.csv';
            $csvPath = storage_path("app/public/{$csvFileName}");

            $csvContent = "Employee_Name,Employee_EmailID,Secret_Child_Name,Secret_Child_EmailID\n";

            foreach ($assignments as $assignment) {
                if (!$assignment->giver || !$assignment->receiver) {
                    continue; // Skip invalid records
                }

                $csvContent .= "{$assignment->giver->Employee_Name},{$assignment->giver->Employee_EmailID},"
                    . "{$assignment->receiver->Employee_Name},{$assignment->receiver->Employee_EmailID}\n";
            }

            file_put_contents($csvPath, $csvContent);

            if (!file_exists($csvPath)) {
                return back()->with('error', 'Failed to generate CSV file.');
            }

            return response()->download($csvPath)->deleteFileAfterSend(true);
        } catch (Exception $e) {
            Log::error('Error exporting Secret Santa assignments: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while exporting Secret Santa assignments.');
        }
    }
}
