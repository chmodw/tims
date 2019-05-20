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
            $table->string('program_title');
            $table->string('organised_by_id');
            $table->string('department');
            $table->text('requirements');
            $table->text('target_group');
            $table->timestamp('start_date');
            $table->string('duration'); //months
            $table->timestamp('application_closing_date_time')->useCurrent = true;
            $table->float('registration_fees')->nullable();;
            $table->text('other_costs')->nullable();;
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
        Schema::dropIfExists('post_grad_programs');
    }
}
