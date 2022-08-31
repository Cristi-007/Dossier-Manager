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
        Schema::create('dossiers', function (Blueprint $table) {
            $table->id('dossiers_id');
            $table->foreignId('case_officer_id') -> constrained('case_officers', 'case_officers_id');
            $table->foreignId('action_type_id') -> constrained('action_types', 'action_types_id');
            $table->foreignId('report_id') -> constrained('reports', 'reports_id') -> default(1);
            $table->foreignId('expertise_type_id') -> constrained('expertise_types', 'expertise_types_id') -> default(1);  //primara, repetata, in comisie...
            $table->foreignId('expert_id') -> constrained('experts', 'experts_id');
            $table->string('subdivision_code');
            $table->integer('dossier_number');
            $table->date('dossier_date');
            $table->string('request_number');
            $table->date('request_date');
            $table->string('action_number');
            $table->integer('received_packages_number');
            $table->boolean('expertise_deadline') -> default(1);
            $table->string('expertise_department');
            $table->string('dossier_state');
            $table->text('notes') -> nullable();
            $table->string('location') -> nullable();
            $table->string('scanned_request') -> nullable();
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
        Schema::dropIfExists('dossiers');
    }
};
