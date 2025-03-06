<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['Employee_Name', 'Employee_EmailID', 'year'];

    // Relationship to Employee (The giver)
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    // Relationship to Employee (The secret child)
    public function secretChild()
    {
        return $this->belongsTo(Employee::class, 'secret_child_id');
    }
}
