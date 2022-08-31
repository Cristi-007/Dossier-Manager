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
        Schema::create('experts', function (Blueprint $table) {
            $table->id('experts_id');
            $table->string('expert_name');
            $table->string('expert_surname');
            $table->foreignId('user_id')->constrained('users');
            $table->boolean('active');
            $table->string('function');
            $table->boolean('novice'); // stagiar
            $table->timestamps();
        });


        // NOTE: in the database create a unique index for columns --- name + surname
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('experts');
    }
};
