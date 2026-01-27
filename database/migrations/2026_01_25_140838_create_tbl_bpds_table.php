<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_bpds', function (Blueprint $table) {
            $table->id('id_bpd');
            $table->unsignedBigInteger('id_department');
            $table->string('no_bpd')->unique();
            $table->string('objective');
            $table->integer('created_by')->nullable();
            $table->timestamps();

            $table->foreign('id_department')->references('id_department')->on('tbl_department')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_bpds');
    }
};
