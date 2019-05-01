<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('trainee_id');
            $table->string('program_id');
            $table->string('recommendation');
            $table->string('type');
            $table->string('created_by');
            $table->string('updated_by')->nullable();
            $table->timestamps();

//            $table->foreign('trainee_id')->references('id')->on('trainees');
//            $table->foreign('local_program_id')->references('programId')->on('local_programs');
//            $table->foreign('foreign_program_id')->references('programId')->on('foreign_programs');
//            $table->foreign('inhouse_program_id')->references('programId')->on('in_house_programs');
//            $table->foreign('post_grad_program_id')->references('programId')->on('post_grad_programs');

            $table->foreign('created_by')->references('email')->on('users');
            $table->foreign('updated_by')->references('email')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('programs');
    }
}
