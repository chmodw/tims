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
            $table->string('program_type');
            $table->string('organised_by_id');
            $table->string('notified_by');
            $table->date('notified_on');
            $table->string('target_group');
            $table->string('nature_of_the_employment');
            $table->string('employee_category');
            $table->string('venue');
            $table->enum('currency',['usd', 'euro', 'gbp', 'lkr']);
            $table->float('program_fee')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->string('application_closing_date_time');
            $table->string('duration');
            $table->string('brochure_url')->nullable();
            $table->string('created_by');
            $table->string('updated_by')->nullable();
            $table->timestamps();

            $table->foreign('organised_by_id')->references('organisation_id')->on('organisations');
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
        Schema::dropIfExists('foreign_programs');
    }
}
