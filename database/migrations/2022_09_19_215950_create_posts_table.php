<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->boolean('is_saleable');
            $table->double('price');
            $table->integer('favorite_count');
            $table->integer('view_count');
//            $table->foreignIdFor(Tag);
//            $table->foreignIdFor(Comment);
//            $table->foreignIdFor(Image);
//            $table->foreignIdFor(User);
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
        Schema::dropIfExists('post_models');
    }
};
