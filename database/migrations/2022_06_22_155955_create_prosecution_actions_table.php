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
        Schema::create('prosecution_actions', function (Blueprint $table) {
            $table->id('prosecution_actions_id');
            $table->foreignId('case_officer_id')->constrained('case_officers', 'case_officers_id');
            $table->foreignId('object_id')->constrained('objects', 'objects_id');
            $table->foreignId('adress_id')->constrained('addresses', 'addresses_id');
            $table->string('action_type') -> nullable();
            $table->string('request_number');
            $table->smallInteger('objects_number', false, 100) -> nullable();
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
        Schema::dropIfExists('prosecution_actions');
    }
};
