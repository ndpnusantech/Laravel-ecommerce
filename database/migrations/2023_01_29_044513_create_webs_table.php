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
        Schema::create('webs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_web', 50)->nullable()->default('text');
            $table->string('inis_web', 10)->nullable()->default('text');
            $table->longText('desk_web')->nullable()->default('text');
            $table->longText('logo_web')->nullable()->default('text');
            $table->string('copy_web', 30)->nullable()->default('text');
            $table->integer('year_web')->unsigned()->nullable()->default(12);
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
        Schema::dropIfExists('webs');
    }
};
