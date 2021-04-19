<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAditionalFieldsIntoUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->date('birth_date');
            $table->boolean('is_admin')->default(false);  
            $table->string('city');
            $table->string('phone'); 
            $table->string('state'); 
            $table->string('street'); 
            $table->string('zip_code',30); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('birth_date');
            $table->dropColumn('is_admin');
            $table->dropColumn('city');
            $table->dropColumn('state');
            $table->dropColumn('zip_code');
        });
    }
}
