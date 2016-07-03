<?php namespace James\Versions\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateVersionsTable extends Migration
{

    public function up()
    {
        Schema::create('james_versions_versions', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->index();
            $table->integer('software_id')->unsigned();
            $table->string('version');
            $table->timestamps();
            $table->index(['software_id']);
            $table->foreign('software_id')->references('id')->on('james_versions_softwares')->onDelete('cascade');
        });

        Schema::create('james_versions_post_versions', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('version_id')->unsigned()->nullable()->default(null);
            $table->integer('post_id')->unsigned()->nullable()->default(null);
            $table->index(['version_id', 'post_id']);
            $table->foreign('version_id')->references('id')->on('james_versions_versions')->onDelete('cascade');
            $table->foreign('post_id')->references('id')->on('rainlab_blog_posts')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('james_versions_post_versions');
        Schema::dropIfExists('james_versions_versions');
    }

}
