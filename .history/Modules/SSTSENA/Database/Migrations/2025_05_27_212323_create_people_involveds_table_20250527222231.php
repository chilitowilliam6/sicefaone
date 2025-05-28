<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeopleInvolvedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people_involveds', function (Blueprint $table) {
            $table->id();
            $table->enum('document_type', ['CC', 'TI', 'CE', 'PAS','OTRO']);
            $table->string('document_number');
            $table->string('name');
            $table->date('birth_date');
            $table->string('gender');
            $table->foreignId('person_type_id')->constrained('person_types')->onDelete('cascade');
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->foreignId('accident_id')->constrained('accidents')->onDelete('cascade');
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
        Schema::dropIfExists('people_involveds');
    }
}
