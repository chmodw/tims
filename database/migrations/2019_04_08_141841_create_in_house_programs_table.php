<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInHouseProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('in_house_programs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('program_id')->unique();
            $table->text('program_title');
            $table->string('target_group');
            $table->string('organised_by_id');
            $table->string('nature_of_the_employment');
            $table->string('employee_category');
            $table->string('venue');
            $table->timestamp('start_date')->useCurrent = true;
            $table->time('end_time')->useCurrent = true;
            $table->timestamp('application_closing_date_time')->useCurrent = true;
            $table->float('no_show_fee')->nullable();
            $table->float('per_person_fee')->nullable();
            $table->text('resource_person'); //person name, designation, and cost
            $table->text('other_costs')->nullable();

            $table->float('hours')->nullable();;
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
        Schema::dropIfExists('in_house_programs');
    }
}
