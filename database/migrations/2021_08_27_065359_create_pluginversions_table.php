<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePluginversionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pluginversions', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("_pluginname_id");
            $table->string("_pluginversion",30);
            $table->string("_pluginversionuseratio",30);
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
        Schema::dropIfExists('pluginversions');
    }
}
