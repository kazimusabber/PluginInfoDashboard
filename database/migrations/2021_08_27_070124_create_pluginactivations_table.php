<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePluginactivationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pluginactivations', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("_pluginname_id")->unsigned();
            $table->date("_active_date",30);
            $table->string("_totalactivation",30);
            $table->string("_totalinactivation",30);
            $table->timestamps();
        });
        Schema::table('pluginactivations', function (Blueprint $table) {
            $table->foreign("_pluginname_id")->references("id")->on("pluginnames")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pluginactivations');
    }
}
