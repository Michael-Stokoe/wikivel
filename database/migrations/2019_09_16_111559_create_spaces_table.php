<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spaces', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->index()->max(40);
            $table->longText('content')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('wiki_id');
            $table->string('slug');

            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('wiki_id')->references('id')->on('wikis');
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
        Schema::dropIfExists('spaces');
    }
}
