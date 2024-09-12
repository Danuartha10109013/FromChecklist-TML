<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormSubmissionsTable extends Migration
{
    public function up()
    {
        Schema::create('form_submissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('form_id');
            $table->text('form_fields_id'); // Column to store the concatenated form field IDs
            $table->text('values');         // Column to store the concatenated form values
            $table->timestamps();
        
            // Foreign key to reference the form
            $table->foreign('form_id')->references('id')->on('forms')->onDelete('cascade');
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('form_submissions');
    }
}
