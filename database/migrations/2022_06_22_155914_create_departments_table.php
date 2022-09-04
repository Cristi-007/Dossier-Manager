<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('departments', function (Blueprint $table) {
            $table->id('departments_id');
            $table->foreignId('subdivision_id')->constrained('subdivisions', 'subdivisions_id');
            $table->string('department') -> nullable();
            $table->char('abbreviation', 20) -> nullable();
            $table->tinyInteger('active', 2) ->default(1);
            $table->timestamps();           
        });

        // ? in the database create a unique index for columns --- name + subdivision_id
        // ? it works and don't delete or replace foreign key
        //! first register should be DEFAULT (with NULLs)
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departments');
    }
};
