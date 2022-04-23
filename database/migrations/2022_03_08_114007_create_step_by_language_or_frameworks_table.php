<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB; 

class CreateStepByLanguageOrFrameworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return    void
     */
    public function up()
    {
        Schema::create('step_by_language_or_frameworks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('language_id')->comment("Language Id");
            $table->unsignedBigInteger('framework_id')->comment("Framework Id ");
            $table->unsignedBigInteger('step')->comment("Step for Show How make Project");
            $table->string('name',255)->nullable()->comment("Name's English");
            $table->mediumText('description')->nullable()->comment("Description Of Step");
            $table->string('photo',255)->nullable()->comment("Name's Spanish");
            $table->mediumText('ref_urls')->nullable()->comment("Reference of URL");
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
        Schema::dropIfExists('step_by_language_or_frameworks');
    }
};