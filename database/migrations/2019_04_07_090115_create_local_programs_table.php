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





//SQLSTATE[23000]: [Microsoft][ODBC Driver 13 for SQL Server][SQL Server]Cannot insert the value NULL into column 'program_id', table 'TIMS.dbo.local_programs'; column does not allow nulls. INSERT fails. (SQL: insert into [local_programs] ([program_title], [organised_by], [target_group], [start_date], [end_date], [venue], [nature_of_the_appointment], [employee_category], [course_fee], [duration], [non_member_fee], [member_fee], [student_fee], [updated_at], [created_at]) values (sns, dndn, ndnd, 2019-04-12 00:00:00, 2019-04-12 00:00:00, jdj, permanent, non-tech, 77, 77, 00, 00, 00, 2019-04-08 15:33:46.920, 2019-04-08 15:33:46.920))
