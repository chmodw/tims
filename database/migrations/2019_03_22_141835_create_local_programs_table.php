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
            $table->string('programId')->unique();
            $table->string('title');
            $table->string('organisedBy');
            $table->string('targetGroup');
            $table->timestamp('startDate')->useCurrent = true;
            $table->timestamp('endDate')->useCurrent = true;
            $table->timestamp('applicationClosingDateTime')->useCurrent = true;
            $table->float('nonMemberFee');
            $table->float('memberFee');
            $table->float('studentFee');
            $table->string('brochureUrl');
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
        Schema::dropIfExists('local_programs');
    }
}
