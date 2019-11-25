<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\JobPosition;
class CreateJobPositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_positions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description');
            $table->integer('salary');
            $table->string('location');
            $table->string('status')->default(JobPosition::ON);
            $table->integer('departement_id')->unsigned();
            $table->timestamps();

            $table->foreign('departement_id')->references('id')->on('departements');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_positions');
    }
}
