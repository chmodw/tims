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
            $table->string('programId')->unique();
            $table->string('title');
            $table->string('institute');
            $table->string('department');
            $table->text('programs'); //serialized array
            $table->text('requirements'); // serialized array
            $table->timestamp('applicationClosingDateTime')->useCurrent = true;
            $table->float('registrationFees');
            $table->float('firstYearFees');
            $table->float('secondYearFees');
            $table->string('brochureURL');
            $table->string('createdBy');
            $table->timestamps();
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
