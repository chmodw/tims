<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foreign_programs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('programId');
            $table->string('title');
            $table->string('organisedBy');
            $table->string('notifiedBy');
            $table->string('targetGroup');
            $table->date('startDate');
            $table->date('endDate');
            $table->string('applicationClosingDateTime');
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
        Schema::dropIfExists('foreign_programs');
    }
}
