<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('filing_of_matter_id')->constrained()->cascadeOnUpdate()->cascadeOnUpdate();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('number')->default('001');
            //Bukti Pembayaran
            $table->text('proof_of_payment')->nullable();

            //Jadwal Sidang
            $table->date('timetable')->nullable();
            $table->time('time')->nullable();
            $table->foreignId('room_id')->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();

            // General
            $table->string('father_name')->nullable();
            $table->string('defendant_name')->nullable();

            // Saksi
            $table->string('saksi_1')->nullable();
            $table->string('saksi_2')->nullable();
            $table->string('saksi_3')->nullable();

            $table->enum('status', ['proses', 'reject', 'payment', 'scheduling', 'success'])->default('proses');
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
        Schema::dropIfExists('submissions');
    }
}
