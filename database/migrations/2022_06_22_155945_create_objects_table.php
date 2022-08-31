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
        Schema::create('objects', function (Blueprint $table) {
            $table->id('objects_id');
            $table->foreignId('object_type_id')->constrained('object_types','object_types_id');
            $table->foreignId('brand_id')->constrained('brands', 'brands_id');
            $table->foreignId('report_id')->constrained('reports', 'reports_id');
            $table->string('model') -> nullable();
            $table->integer('capacity') -> default(0);
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
        Schema::dropIfExists('objects');
    }
};
