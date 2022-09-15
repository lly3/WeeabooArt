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
        Schema::create('reward_codes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Reward::class);
            $table->string('code');
            $table->foreignIdFor(\App\Models\User::class)->nullable();
            $table->timestamp('redeemed_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reward_codes');
    }
};
