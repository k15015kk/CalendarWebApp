<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSamplesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $dbname = DB::table('users') -> where('userid','k15015kk') -> value('userid');

        $dbname .= 'Schedule';
        Schema::create($dbname, function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('startTime');
            $table->dateTIme('endTime');
            $table->text('plan');
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
        Schema::dropIfExists('samples');
    }
}
