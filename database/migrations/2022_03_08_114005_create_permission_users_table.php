<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB; 

class CreatePermissionUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return    void
     */
    public function up()
    {
        Schema::create('permission_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('permission_id')->comment("Permissions Table Id ");
            $table->unsignedBigInteger('user_id')->comment("Users Table Id ");
            $table->timestamps();
    
            $table->foreign('permission_id')
                ->references('id')
                ->on('permissions')
                ->onUpdate('cascade')
                ->onDelete('cascade');
    
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('permission_users');
    }
};