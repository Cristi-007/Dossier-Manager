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
        Schema::create('case_officers', function (Blueprint $table) {
            $table->id('case_officers_id');
            $table->foreignId('department_id')->constrained('departments', 'departments_id');
            $table->string('officer_name');
            $table->string('officer_surname');
            $table->timestamps();
        });

        // NOTE: in the database create a unique index for columns --- name + surname + department_id
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('case_officers');
    }
};
