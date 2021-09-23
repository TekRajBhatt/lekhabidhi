<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable(true);
            $table->string('slug')->nullable(true);
            $table->text('job_title')->nullable(true);
            $table->string('email')->nullable(true);
            $table->bigInteger('phone_number')->nullable(true);
            $table->string('address')->nullable(true);
            $table->string('description')->nullable(true);
            $table->string('image')->nullable(true);
            $table->string('facebook')->nullable(true);
            $table->string('whatsapp')->nullable(true);
            $table->string('twitter')->nullable(true);
            $table->string('youtube')->nullable(true);
            $table->string('linkedin')->nullable(true);
            $table->enum('publish_status', ['0', '1'])->default(1);
            $table->enum('display_home', ['0', '1'])->nullable();
            $table->text('meta_title')->nullable();
            $table->text('meta_keyword')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keyphrase')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('RESTRICT');
            $table->foreign('updated_by')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('RESTRICT');
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
        Schema::dropIfExists('teams');
    }
}
