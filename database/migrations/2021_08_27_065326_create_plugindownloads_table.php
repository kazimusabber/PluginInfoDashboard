<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlugindownloadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plugindownloads', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("_pluginname_id");
            $table->date("_download_date");
            $table->integer("_totaldownload");
            $table->timestamps();
        });
<<<<<<< HEAD
        
=======
>>>>>>> 3fc9c98114250d75f12ec490340af184578b2c96
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plugindownloads');
    }
}
