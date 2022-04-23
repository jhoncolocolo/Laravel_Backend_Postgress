<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB; 

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return    void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name',255)->comment("Table Permision's Name");
            $table->string('route',255)->nullable()->comment("Table Permision's Route name, expecific the route in the app");
            $table->string('path',255)->nullable()->comment("Path");
            $table->mediumText('description')->comment("Table Permision's Describe Route of app");
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
        Schema::dropIfExists('permissions');
    }
};