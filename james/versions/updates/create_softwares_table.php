<?php namespace James\Versions\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateSoftwaresTable extends Migration
{

    public function up()
    {
        Schema::create('james_versions_softwares', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->index();
            $table->string('name');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('james_versions_softwares');
    }

}
