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
            $table->integer('trainee_id');
            $table->string('local_program_id')->nullable();
            $table->string('foreign_program_id')->nullable();
            $table->string('inhouse_program_id')->nullable();
            $table->string('post_grad_program_id')->nullable();
            $table->timestamps();

            $table->foreign('trainee_id')->references('id')->on('Trainee');
            $table->foreign('local_program_id')->references('programId')->on('LocalProgram');
            $table->foreign('foreign_program_id')->references('programId')->on('ForeignProgram');
            $table->foreign('inhouse_program_id')->references('programId')->on('InHouseProgram');
            $table->foreign('post_grad_program_id')->references('programId')->on('PostGradProgram');
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
