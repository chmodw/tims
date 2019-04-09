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
            $table->string('organised_by');
            $table->string('target_group');
            $table->timestamp('start_date')->useCurrent = true;
            $table->timestamp('end_date')->useCurrent = true;
            $table->timestamp('application_closing_date_time')->useCurrent = true;
            $table->enum('nature_of_the_appointment',['permanent', 'fixed', 'contract']);
            $table->enum('employee_category',['technical', 'non-technical', 'both']);
            $table->string('venue');
            $table->boolean('is_long_term')->default(false);
            $table->float('course_fee')->nullable();
            $table->integer('duration');
            $table->float('non_member_fee')->nullable();
            $table->float('member_fee')->nullable();
            $table->float('student_fee')->nullable();
            $table->string('brochure_url')->nullable();
            $table->string('created_by');
            $table->string('updated_by')->nullable();
            $table->timestamps();

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
        Schema::dropIfExists('local_programs');
    }
}
