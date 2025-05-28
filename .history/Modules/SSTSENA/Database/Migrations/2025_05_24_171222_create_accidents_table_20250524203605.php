<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accidents', function (Blueprint $table) {
            $table->id();
            // Date and time of the accident
            $table->dateTime('date_time');
        
            // Foreign key relationships (as shown in the image)
            
            $table->foreignId('environment_id')->constrained('environments')->onDelete('cascade');
            $table->foreignId('injury_type_id')->constrained('injury_types')->onDelete('cascade');
            $table->foreignId('risk_type_id')->constrained('risk_types')->onDelete('cascade');
            $table->foreignId('accident_type_id')->constrained('accident_types')->onDelete('cascade');
        
            // Text fields
            $table->text('description')->nullable();
            $table->text('evidence')->nullable();
        
            // Enum for severity
            $table->enum('severity', ['minor', 'moderate', 'serious', 'fatal']);
            $table->string('created_by')->nullable();
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
        Schema::dropIfExists('accidents');
    }
}
