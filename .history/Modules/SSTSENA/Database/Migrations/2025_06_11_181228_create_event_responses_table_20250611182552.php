<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_responses', function (Blueprint $table) {
            $table->id();
            $table->text('response')->nullable();
            $table->text('actions_taken')->nullable();
            $table->enum('status', ['investigation', 'finalized'])->default('investigacion');
            $table->enum('severity', ['minor', 'moderate', 'serious', 'fatal']);
            $table->dateTime('da');
            $table->unsignedBigInteger('respondido_por');
            $table->foreign('respondido_por')->references('id')->on('users')->onDelete('cascade');
            $table->morphs('responseable');
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
        Schema::dropIfExists('event_responses');
    }
}
