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
            $table->boolean('is_saleable')->default(false);
            $table->double('price')->default(0);
            $table->integer('favorite_count')->default(0);
            $table->integer('view_count')->default(0);
            $table->foreignIdFor(\App\Models\Tag::class);
            $table->foreignIdFor(\App\Models\Image::class);
//            $table->foreignIdFor(\App\Models\User::class); // foreign key is `user_id`
            $table->foreignIdFor(\App\Models\Comment::class);
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
