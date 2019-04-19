<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocalProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('local_programs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('program_id')->unique();
            $table->string('program_title');
            $table->string('organised_by_id');
            $table->string('target_group');
            $table->timestamp('start_date')->useCurrent = true;
            $table->integer('duration');
            $table->timestamp('application_closing_date_time')->useCurrent = true;
            $table->string('nature_of_the_employment');//['permanent', 'fixed', 'contract']
            $table->string('employee_category');//,['technical', 'non-technical', 'both']
            $table->string('venue');
            $table->boolean('is_long_term')->default(false);
            $table->float('program_fee')->nullable();
            $table->float('non_member_fee')->nullable();
            $table->float('member_fee')->nullable();
            $table->float('student_fee')->nullable();
            $table->string('brochure_url')->nullable();
            $table->string('created_by');
            $table->string('updated_by')->nullable();
            $table->timestamps();

            $table->foreign('organised_by_id')->references('organisation_id')->on('organisations');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('local_programs');
    }
}
