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
        Schema::create('subdivisions', function (Blueprint $table) {
            $table->id('subdivisions_id');
            $table->string('subdivision') -> unique();
            $table->char('abbreviation', 15) -> nullable();
            $table->tinyInteger('active', 2) ->default(1);
            $table->timestamps();

            //! first register should be DEFAULT (with NULLs)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subdivisions');
    }
};
