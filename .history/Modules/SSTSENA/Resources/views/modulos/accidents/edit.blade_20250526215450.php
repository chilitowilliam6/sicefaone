
 // $table->dateTime('date_time');
 //       
 //           // Foreign key relationships (as shown in the image)
 //           $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
 //           $table->foreignId('environment_id')->constrained('environments')->onDelete('cascade');
 //           $table->foreignId('injury_type_id')->constrained('injury_types')->onDelete('cascade');
 //           $table->foreignId('risk_type_id')->constrained('risk_types')->onDelete('cascade');
 //           $table->foreignId('accident_type_id')->constrained('accident_types')->onDelete('cascade');
 //       
 //           // Text fields
 //           $table->text('description')->nullable();
 //           $table->text('evidence')->nullable();
 //       
 //           // Enum for severity
 //           $table->enum('severity', ['minor', 'moderate', 'serious', 'fatal']);


@extends ('sstsena::layouts.master')
@section('content')

