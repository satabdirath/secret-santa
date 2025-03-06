<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecretSantaAssignment extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id', 'secret_child_id', 'year'];

    // Relationship: The person giving the gift
    public function giver()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    // Relationship: The person receiving the gift
    public function receiver()
    {
        return $this->belongsTo(Employee::class, 'secret_child_id');
    }
}
