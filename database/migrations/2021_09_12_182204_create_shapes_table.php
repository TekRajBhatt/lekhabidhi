<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShapesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shapes', function (Blueprint $table) {
            $table->id();

            $table->string('bg')->nullable();
            $table->string('first_bg')->nullable();
            $table->string('second_bg')->nullable();
            $table->string('third_bg')->nullable();
            $table->string('fourth_bg')->nullable();
            $table->string('fiifth_bg')->nullable();
            $table->string('pattern')->nullable();
            $table->string('first_pattern')->nullable();
            $table->string('footer')->nullable();
            $table->string('shape')->nullable();
            $table->string('first_shape')->nullable();
            $table->string('second_shape')->nullable();
            $table->string('third_shape')->nullable();
            $table->string('fourth_shape')->nullable();
            $table->string('fifth_shape')->nullable();
            $table->string('sixth_shape')->nullable();
            $table->string('seventh_shape')->nullable();
            $table->string('eighth_shape')->nullable();
            $table->string('nineth_shape')->nullable();
            $table->enum('publish_status', ['0', '1'])->default(1);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('updated_by')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shapes');
    }
}
