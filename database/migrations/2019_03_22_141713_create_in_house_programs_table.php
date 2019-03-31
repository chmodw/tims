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
            $table->string('programId')->unique();
            $table->string('title');
            $table->string('content'); //serialized array
            $table->string('targetGroup');
            $table->string('organisedBy');
            $table->string('venue');
            $table->timestamp('startDateTime')->useCurrent = true;
            $table->timestamp('endDateTime')->useCurrent = true;
            $table->timestamp('applicationClosingDateTime')->useCurrent = true;
            $table->string('keyPerson');
            $table->string('keyPersonDesignation');
            $table->float('registrationCost');
            $table->float('nonRegistrationCost');
            $table->float('headCost');
            $table->float('lecturerCost');
            $table->integer('hours');
            $table->string('createdBy');
            $table->string('updatedBy')->nullable();
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
        Schema::dropIfExists('in_house_programs');
    }
}
