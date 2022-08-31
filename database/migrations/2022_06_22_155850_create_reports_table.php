<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id('reports_id');
            $table->foreignId('report_type_id')->constrained('report_types', 'report_types_id');
            $table->foreignId('examination_type_id')->constrained('examination_types', 'examination_types_id');
            $table->foreignId('expert_novice_id')->constrained('experts', 'experts_id');
            $table->integer('price') -> default(0);
            $table->integer('report_number');
            $table->date('report_date');
            $table->integer('objects_number');
            $table->boolean('archived') -> nullable();
            $table->integer('no_dossier_divizare') -> nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
};
