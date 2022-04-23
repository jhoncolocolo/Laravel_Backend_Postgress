<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB; 

class CreateLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return    void
     */
    public function up()
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string('name_en',255)->nullable()->comment("Name's English");
            $table->string('name_es',255)->nullable()->comment("Name's Spanish");
            $table->mediumText('meaning_name_en')->nullable()->comment("Meaning 0f The Name in English");
            $table->mediumText('meaning_name_es')->nullable()->comment("Meaning 0f The Name in Spanish");
            $table->timestamps();
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return    void
     */
    public function down()
    {
        Schema::dropIfExists('languages');
    }
};