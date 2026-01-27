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
        Schema::create('tbl_kpis', function (Blueprint $table) {
            $table->id('id_kpi');
            $table->unsignedBigInteger('id_bpd');
            $table->text('definition')->nullable();
            $table->date('periode')->nullable();
            $table->decimal('com_target', 10, 2)->nullable();
            $table->decimal('com_actual', 10, 2)->nullable();
            $table->string('target')->nullable();
            $table->string('actual')->nullable();
            $table->text('note')->nullable();
            $table->integer('created_by')->nullable();
            $table->timestamps();

            $table->foreign('id_bpd')->references('id_bpd')->on('tbl_bpds')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_kpis');
    }
};
