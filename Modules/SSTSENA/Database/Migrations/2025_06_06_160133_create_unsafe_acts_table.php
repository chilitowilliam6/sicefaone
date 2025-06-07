<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnsafeActsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unsafe_acts', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date_time');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('environment_id')->constrained()->onDelete('cascade');
            $table->foreignId('risk_type_id')->constrained()->onDelete('cascade');
            $table->foreignId('unsafe_act_type_id')->constrained()->onDelete('cascade');
            $table->text('description')->nullable();
            $table->text('evidence')->nullable();
            $table->enum('severity', ['minor', 'moderate', 'serious', 'fatal']);
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
        Schema::dropIfExists('unsafe_acts');
    }
}
