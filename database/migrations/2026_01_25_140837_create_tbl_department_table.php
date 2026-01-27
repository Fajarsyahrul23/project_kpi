<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_department', function (Blueprint $table) {
            $table->id('id_department');
            $table->string('dept_code');
            $table->string('dept_name');
            $table->integer('pin');
            $table->integer('created_by')->nullable(); // Adding created_by as per spec
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_department');
    }
};
