<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTraineeVersionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainee_version', function (Blueprint $table) {
            $table->integer('ref_id')->primary();
            $table->integer('version');
            $table->string('epf_no');
            $table->string('title');
            $table->string('name_with_initials');
            $table->string('full_name');
            $table->string('office_email');
            $table->string('personal_email');
            $table->string('mobile');
            $table->string('telephone');
            $table->date('birthday');
            $table->string('grade');
            $table->integer('designation_id');
            $table->integer('section_id');
            $table->string('nic');
            $table->string('passport_no');
            $table->string('passport_issued_on');
            $table->string('passport_expire_on');
            $table->string('meal_pref');
            $table->string('nature_of_employment');
            $table->date('date_of_employment');
            $table->date('date_of_appointment');
            $table->timestamp('updated_at');
            $table->timestamp('deleted_at')->useCurrent = true;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trainee_versions');
    }
}
