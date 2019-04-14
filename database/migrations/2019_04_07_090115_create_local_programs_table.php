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
        //        {"_token":"b7r2Oh0I9ekPpGC5TvIWnJjmXhdWTxwXJcitTb59","program_type":"LocalProgram","program_title":"title","organised_by":"org","target_group":"targ","start_date":"2019-04-11","start_time":"00:00","venue":"j","employment_fixed_contract":"fixed contract","employee_category":"non-technical","course_fee":"44","is_long_term":"Long Term","duration":"5","application_closing_date":"2019-04-30","application_closing_time":"00:00","member_fee":"44","non_member_fee":"77","student_fee":"88","_submit":"reload_page","program_brochure":{}}

        Schema::create('local_programs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('program_id')->unique();
            $table->string('program_title');
            $table->string('organised_by_id')->unique();
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
