<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('secret_santa_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
            $table->foreignId('secret_child_id')->constrained('employees')->onDelete('cascade');
            $table->year('year');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('secret_santa_assignments');
    }
};
