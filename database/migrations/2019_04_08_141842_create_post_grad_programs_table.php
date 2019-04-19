<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostGradProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_grad_programs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('program_id')->unique();
            $table->string('title');
            $table->string('organised_by_id');
            $table->string('department');
            $table->text('programs'); //serialized array
            $table->text('requirements'); // serialized array
            $table->timestamp('application_closing_date_time')->useCurrent = true;
            $table->float('registration_fees');
            $table->float('firstYear_fees');
            $table->float('secondYear_fees');
            $table->string('brochure_url');
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
        Schema::dropIfExists('post_grad_programs');
    }
}
