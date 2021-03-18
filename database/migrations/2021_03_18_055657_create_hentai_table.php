<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHentaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hentai', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name', 255)->unique();
            $table->string('language', 255)->default('japanese');
            $table->string('origin', 255)->default('japan');
            $table->string('code', 255)->unique()->nullable();
            $table->boolean('anime')->default(true);
            $table->boolean('doujin')->default(false);
            $table->boolean('3d')->default(false);
            $table->text('note')->nullable();
            $table->json('extra')->nullable();
            $table->boolean('favorite')->default(false);
            $table->unsignedBigInteger('artist_id')->nullable();
            $table->foreign('artist_id')->references('id')->on('artists')->onDelete('set null')->onUpdate('cascade');
            $table->unsignedBigInteger('studio_id')->nullable();
            $table->foreign('studio_id')->references('id')->on('studios')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hentai');
    }
}
