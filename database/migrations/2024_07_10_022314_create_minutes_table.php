<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('minutes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('meeting_id')->constrained('meetings');
            $table->string('basis', 600)->comment('dasar');
            $table->string('chairperson')->comment('pimpinan rapat');
            $table->string('minute_taker')->comment('notulis');
            $table->string('method')->comment('metode');
            $table->text('outcome')->comment('hasil');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('minutes');
    }
};