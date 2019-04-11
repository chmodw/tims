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
            $table->string('title');
            $table->string('content'); //serialized array
            $table->string('target_group');
            $table->integer('organised_by')->unsigned();
            $table->string('venue');
            $table->timestamp('start_date_time')->useCurrent = true;
            $table->timestamp('endDate_time')->useCurrent = true;
            $table->timestamp('application_closing_date_time')->useCurrent = true;
            $table->string('key_person');
            $table->string('key_person_designation');
            $table->float('registration_cost');
            $table->float('non_registration_cost');
            $table->float('head_cost');
            $table->float('lecturer_cost');
            $table->integer('hours');
            $table->string('created_by');
            $table->string('updated_by')->nullable();
            $table->timestamps();

            $table->foreign('organised_by')->references('id')->on('organisations');
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
