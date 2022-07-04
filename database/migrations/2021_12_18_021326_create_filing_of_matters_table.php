<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilingOfMattersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filing_of_matters', function (Blueprint $table) {
            $table->id();
            $table->text('icon');
            $table->string('name');
            $table->string('name_rek');
            $table->string('rek');
            $table->double('price');
            $table->longtext('description');
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
        Schema::dropIfExists('filing_of_matters');
    }
}
