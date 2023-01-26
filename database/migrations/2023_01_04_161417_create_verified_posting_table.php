<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVerifiedPostingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verified_posting', function (Blueprint $table) {
            $table->id();
            $table->string('caption');
            $table->string('verified')->default('Non-Verified')->nullable();
            $table->integer('donation_amount');
            $table->string('documents')->nullable();
            $table->string('image')->nullable();
            $table->string('videos')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('verified_posting');
    }
}
