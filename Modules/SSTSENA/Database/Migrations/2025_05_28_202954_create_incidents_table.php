<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidents', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date_time');

            // Relaciones foráneas
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->foreignId('environment_id')->constrained('environments')->onDelete('cascade');
            $table->foreignId('risk_type_id')->constrained('risk_types')->onDelete('cascade');
            $table->foreignId('incident_type_id')->constrained('incident_types')->onDelete('cascade');

            // Campos adicionales
            $table->text('description')->nullable();
            $table->text('evidence')->nullable();

            // Enum para la severidad
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
        Schema::dropIfExists('incidents');
    }
}
