<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB; 

class CreatePermissionRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return    void
     */
    public function up()
    {
        Schema::create('permission_roles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id')->comment("Roles Table Id ");
            $table->unsignedBigInteger('permission_id')->comment("Permissions Table Id ");
            $table->timestamps();
    
            $table->foreign('role_id')
                ->references('id')
                ->on('roles')
                ->onUpdate('cascade')
                ->onDelete('cascade');
    
            $table->foreign('permission_id')
                ->references('id')
                ->on('permissions')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return    void
     */
    public function down()
    {
        Schema::dropIfExists('permission_roles');
    }
};