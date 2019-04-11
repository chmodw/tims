<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foreign_programs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('program_id')->unique()->index();
            $table->string('program_title');
            $table->string('organised_by');
            $table->string('notified_by');
            $table->string('target_group');
            $table->enum('nature_of_the_appointment',['permanent', 'fixed', 'contract']);
            $table->enum('employee_category',['technical', 'non-technical', 'both']);
            $table->string('venue');
            $table->enum('currency',['usd', 'non-euro', 'gbp', 'lkr']);
            $table->float('course_fee')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->string('application_closing_date_time');
            $table->integer('duration');
            $table->string('brochure_url');
            $table->string('created_by');
            $table->string('updated_by')->nullable();
            $table->timestamps();

            $table->foreign('organised_by')->references('id')->on('organisations');
            //Possible default value


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('foreign_programs');
    }
}
