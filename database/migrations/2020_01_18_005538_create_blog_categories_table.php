<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_categories', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('parent_id')->unsigned()->default(1);

            $table->string('slug')->unique(); //уникальное название категории
            $table->string('title');
            $table->text('description')->nullable(); //текстовое поле

            $table->timestamps();
            $table->softDeletes(); // deleted_at поле, при удалении
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_categories');
    }
}
